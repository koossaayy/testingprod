<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatus;
use App\Http\Requests\InvoiceRequest;
use App\Mail\InvoiceSentMail;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Notifications\InvoicePaidNotification;
use App\Support\Money;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;
use Inertia\Response;

class InvoiceController extends Controller
{
    /**
     * List every invoice, newest first.
     */
    public function index(Request $request): Response
    {
        $invoices = $request->user()
            ->invoices()
            ->with('client', 'items')
            ->orderByDesc('issued_on')
            ->get()
            ->map(fn (Invoice $invoice): array => $invoice->toRowArray())
            ->all();

        return Inertia::render('invoices/Index', [
            'invoices' => $invoices,
            'statuses' => InvoiceStatus::options(),
        ]);
    }

    /**
     * Show the blank invoice form.
     */
    public function create(Request $request): Response
    {
        return Inertia::render('invoices/Form', [
            'invoice' => null,
            'clients' => $this->clientOptions($request),
            'statuses' => InvoiceStatus::options(),
            'suggestedNumber' => $this->nextInvoiceNumber($request),
        ]);
    }

    /**
     * Store a brand new invoice and its line items.
     */
    public function store(InvoiceRequest $request): RedirectResponse
    {
        $data = $request->validated();

        $invoice = $request->user()->invoices()->create([
            ...collect($data)->except('items')->all(),
            'tax_rate_basis_points' => (int) round(($data['tax_rate'] ?? 0) * 100),
        ]);

        $this->syncItems($invoice, $data['items']);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Invoice :number was created as a draft.', ['number' => $invoice->number]),
        ]);

        return to_route('invoices.show', $invoice);
    }

    /**
     * Show a single invoice with its line items and totals.
     */
    public function show(Request $request, Invoice $invoice): Response
    {
        $this->authorizeInvoice($request, $invoice);

        $invoice->load('client', 'items');

        return Inertia::render('invoices/Show', [
            'invoice' => [
                ...$invoice->toRowArray(),
                'notes' => $invoice->notes,
                'currency' => $invoice->currency,
                'tax_rate' => $invoice->tax_rate_basis_points / 100,
                'subtotal' => Money::format($invoice->subtotalCents(), $invoice->currency),
                'tax' => Money::format($invoice->taxCents(), $invoice->currency),
                'public_url' => route('public-invoice.paid', $invoice->public_token),
                'client' => [
                    'id' => $invoice->client->id,
                    'name' => $invoice->client->name,
                    'contact_name' => $invoice->client->contact_name,
                    'email' => $invoice->client->email,
                    'billing_address' => $invoice->client->billing_address,
                ],
                'items' => $invoice->items->map(fn (InvoiceItem $item): array => [
                    'id' => $item->id,
                    'description' => $item->description,
                    'quantity' => $item->quantity,
                    'unit_amount' => Money::format($item->unit_amount_cents, $invoice->currency),
                    'line_total' => Money::format($item->lineTotalCents(), $invoice->currency),
                ])->all(),
            ],
        ]);
    }

    /**
     * Show the invoice form filled in with existing details.
     */
    public function edit(Request $request, Invoice $invoice): Response
    {
        $this->authorizeInvoice($request, $invoice);

        $invoice->load('items');

        return Inertia::render('invoices/Form', [
            'invoice' => [
                'id' => $invoice->id,
                'client_id' => $invoice->client_id,
                'number' => $invoice->number,
                'status' => $invoice->status->value,
                'issued_on' => $invoice->issued_on->format('Y-m-d'),
                'due_on' => $invoice->due_on->format('Y-m-d'),
                'tax_rate' => $invoice->tax_rate_basis_points / 100,
                'currency' => $invoice->currency,
                'notes' => $invoice->notes,
                'items' => $invoice->items->map(fn (InvoiceItem $item): array => [
                    'description' => $item->description,
                    'quantity' => $item->quantity,
                    'unit_amount' => $item->unit_amount_cents / 100,
                ])->all(),
            ],
            'clients' => $this->clientOptions($request),
            'statuses' => InvoiceStatus::options(),
            'suggestedNumber' => $invoice->number,
        ]);
    }

    /**
     * Save changes to an existing invoice.
     */
    public function update(InvoiceRequest $request, Invoice $invoice): RedirectResponse
    {
        $this->authorizeInvoice($request, $invoice);

        abort_if(
            $invoice->status === InvoiceStatus::Paid,
            403,
            __('A paid invoice can no longer be edited. Duplicate it instead.')
        );

        $data = $request->validated();

        $invoice->update([
            ...collect($data)->except('items')->all(),
            'tax_rate_basis_points' => (int) round(($data['tax_rate'] ?? 0) * 100),
        ]);

        $invoice->items()->delete();
        $this->syncItems($invoice, $data['items']);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Your changes to this invoice have been saved.'),
        ]);

        return to_route('invoices.show', $invoice);
    }

    /**
     * Email the invoice to the client and mark it as sent.
     */
    public function send(Request $request, Invoice $invoice): RedirectResponse
    {
        $this->authorizeInvoice($request, $invoice);

        $invoice->load('client', 'items');

        Mail::to($invoice->client->email)->send(new InvoiceSentMail($invoice));

        $invoice->update(['status' => InvoiceStatus::Sent]);

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Invoice :number is on its way to :name.', ['number' => $invoice->number, 'name' => $invoice->client->name]),
        ]);

        return back();
    }

    /**
     * Record a payment against the invoice.
     */
    public function markPaid(Request $request, Invoice $invoice): RedirectResponse
    {
        $this->authorizeInvoice($request, $invoice);

        $invoice->load('client', 'items');

        $invoice->update([
            'status' => InvoiceStatus::Paid,
            'paid_on' => now()->format('Y-m-d'),
            'payment_method' => $request->string('payment_method')->toString() ?: 'bank transfer',
        ]);

        $request->user()->notify(new InvoicePaidNotification($invoice));

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('Nice work. Invoice :number is marked as paid.', ['number' => $invoice->number]),
        ]);

        return back();
    }

    /**
     * Delete a draft invoice.
     */
    public function destroy(Request $request, Invoice $invoice): RedirectResponse
    {
        $this->authorizeInvoice($request, $invoice);

        abort_unless(
            $invoice->status === InvoiceStatus::Draft,
            403,
            __('Only draft invoices can be deleted. Cancel this one instead.')
        );

        $invoice->delete();

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => __('The draft invoice has been deleted.'),
        ]);

        return to_route('invoices.index');
    }

    /**
     * Replace the line items attached to an invoice.
     *
     * @param  array<int, array{description: string, quantity: float, unit_amount: float}>  $items
     */
    private function syncItems(Invoice $invoice, array $items): void
    {
        foreach (array_values($items) as $position => $item) {
            $invoice->items()->create([
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_amount_cents' => (int) round($item['unit_amount'] * 100),
                'position' => $position,
            ]);
        }
    }

    /**
     * Get the clients that can be invoiced, ready for a select input.
     *
     * @return array<int, array{value: int, label: string}>
     */
    private function clientOptions(Request $request): array
    {
        return $request->user()
            ->clients()
            ->where('is_archived', false)
            ->orderBy('name')
            ->get()
            ->map(fn (Client $client): array => [
                'value' => $client->id,
                'label' => $client->name,
            ])
            ->all();
    }

    /**
     * Suggest the next sequential invoice number.
     */
    private function nextInvoiceNumber(Request $request): string
    {
        $count = $request->user()->invoices()->count();

        return sprintf('INV-%s-%03d', now()->format('Y'), $count + 1);
    }

    /**
     * Make sure the invoice belongs to the person asking for it.
     */
    private function authorizeInvoice(Request $request, Invoice $invoice): void
    {
        abort_unless(
            $invoice->user_id === $request->user()->id,
            403,
            __('You do not have permission to open this invoice.')
        );
    }
}
