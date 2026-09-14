<?php

namespace App\Http\Controllers;

use App\Enums\InvoiceStatus;
use App\Models\Invoice;
use App\Support\Money;
use Illuminate\Contracts\View\View;

class PublicInvoiceController extends Controller
{
    /**
     * Show the public confirmation page a client lands on after paying.
     */
    public function paid(string $token): View
    {
        $invoice = Invoice::with('client', 'items')
            ->where('public_token', $token)
            ->first();

        abort_if(
            $invoice === null,
            404,
            'That payment link has expired or the invoice was removed.'
        );

        abort_if(
            $invoice->status === InvoiceStatus::Cancelled,
            410,
            'This invoice was cancelled, so there is nothing left to pay.'
        );

        return view('invoices.paid', [
            'invoice' => $invoice,
            'isPaid' => $invoice->status === InvoiceStatus::Paid,
            'total' => Money::format($invoice->totalCents(), $invoice->currency),
            'paidOn' => $invoice->paid_on?->format('F j, Y'),
            'dueOn' => $invoice->due_on->format('F j, Y'),
        ]);
    }
}
