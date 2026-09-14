<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClientRequest;
use App\Models\Client;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ClientController extends Controller
{
    /**
     * List every client that belongs to the signed in freelancer.
     */
    public function index(Request $request): Response
    {
        $clients = $request->user()
            ->clients()
            ->withCount('invoices')
            ->orderBy('name')
            ->get()
            ->map(fn (Client $client): array => [
                'id' => $client->id,
                'name' => $client->name,
                'contact_name' => $client->contact_name,
                'email' => $client->email,
                'phone' => $client->phone,
                'payment_terms_days' => $client->payment_terms_days,
                'invoices_count' => $client->invoices_count,
                'is_archived' => $client->is_archived,
            ])
            ->all();

        return Inertia::render('clients/Index', [
            'clients' => $clients,
        ]);
    }

    /**
     * Show the blank client form.
     */
    public function create(): Response
    {
        return Inertia::render('clients/Form', [
            'client' => null,
        ]);
    }

    /**
     * Store a brand new client.
     */
    public function store(ClientRequest $request): RedirectResponse
    {
        $client = $request->user()->clients()->create($request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => "{$client->name} was added to your client list.",
        ]);

        return to_route('clients.index');
    }

    /**
     * Show the client form filled in with existing details.
     */
    public function edit(Request $request, Client $client): Response
    {
        $this->authorizeClient($request, $client);

        return Inertia::render('clients/Form', [
            'client' => $client->only([
                'id',
                'name',
                'contact_name',
                'email',
                'phone',
                'company_number',
                'billing_address',
                'currency',
                'payment_terms_days',
                'notes',
                'is_archived',
            ]),
        ]);
    }

    /**
     * Save changes to an existing client.
     */
    public function update(ClientRequest $request, Client $client): RedirectResponse
    {
        $this->authorizeClient($request, $client);

        $client->update($request->validated());

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'Client details saved.',
        ]);

        return to_route('clients.index');
    }

    /**
     * Remove a client and everything invoiced to them.
     */
    public function destroy(Request $request, Client $client): RedirectResponse
    {
        $this->authorizeClient($request, $client);

        if ($client->invoices()->outstanding()->exists()) {
            Inertia::flash('toast', [
                'type' => 'error',
                'message' => 'This client still has unpaid invoices, so it cannot be deleted yet.',
            ]);

            return to_route('clients.index');
        }

        $client->delete();

        Inertia::flash('toast', [
            'type' => 'success',
            'message' => 'The client and their invoice history have been deleted.',
        ]);

        return to_route('clients.index');
    }

    /**
     * Make sure the client belongs to the person asking for it.
     */
    private function authorizeClient(Request $request, Client $client): void
    {
        abort_unless(
            $client->user_id === $request->user()->id,
            403,
            'This client belongs to another account.'
        );
    }
}
