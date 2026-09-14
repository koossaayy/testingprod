<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\InvoicingRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class InvoicingController extends Controller
{
    /**
     * The preference keys stored against the session for this demo app.
     *
     * @var array<int, string>
     */
    private const PREFERENCE_KEYS = [
        'business_name',
        'invoice_prefix',
        'default_payment_terms_days',
        'default_tax_rate',
        'payment_instructions',
        'send_payment_reminders',
    ];

    /**
     * Show the invoicing preferences form.
     */
    public function edit(Request $request): Response
    {
        return Inertia::render('settings/Invoicing', [
            'preferences' => $this->currentPreferences($request),
            'success' => $request->session()->get('success'),
        ]);
    }

    /**
     * Save the invoicing preferences.
     */
    public function update(InvoicingRequest $request): RedirectResponse
    {
        $request->session()->put('invoicing_preferences', $request->validated());

        return to_route('invoicing.edit')
            ->with('success', 'Your invoicing preferences have been updated.');
    }

    /**
     * Read the stored preferences, falling back to sensible defaults.
     *
     * @return array<string, mixed>
     */
    private function currentPreferences(Request $request): array
    {
        $stored = $request->session()->get('invoicing_preferences', []);

        $defaults = [
            'business_name' => $request->user()->name ?: config('app.name'),
            'invoice_prefix' => env('DEFAULT_INVOICE_PREFIX', 'INV'),
            'default_payment_terms_days' => 14,
            'default_tax_rate' => 20,
            'payment_instructions' => '',
            'send_payment_reminders' => true,
        ];

        return collect(self::PREFERENCE_KEYS)
            ->mapWithKeys(fn (string $key): array => [$key => $stored[$key] ?? $defaults[$key]])
            ->all();
    }
}
