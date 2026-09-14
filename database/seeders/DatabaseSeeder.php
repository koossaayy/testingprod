<?php

namespace Database\Seeders;

use App\Enums\InvoiceStatus;
use App\Models\Client;
use App\Models\InvoiceItem;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Sample client records. This is fixture data, not user interface copy.
     *
     * @var array<int, array{name: string, contact_name: string, email: string, phone: string, billing_address: string, payment_terms_days: int, notes: string}>
     */
    private const SAMPLE_CLIENTS = [
        [
            'name' => 'Northwind Coffee Roasters',
            'contact_name' => 'Dana Whitfield',
            'email' => 'dana@northwindroasters.example',
            'phone' => '+1 415 555 0134',
            'billing_address' => "812 Harrison Street\nSan Francisco, CA 94107",
            'payment_terms_days' => 14,
            'notes' => 'Prefers PDF invoices sent on the first Monday of the month.',
        ],
        [
            'name' => 'Halberd Studios',
            'contact_name' => 'Marcus Oyelaran',
            'email' => 'accounts@halberdstudios.example',
            'phone' => '+44 20 7946 0991',
            'billing_address' => "Unit 4, Perch Yard\nLondon E2 8HD",
            'payment_terms_days' => 30,
            'notes' => 'Purchase order number must appear on every invoice.',
        ],
        [
            'name' => 'Quietwater Bicycles',
            'contact_name' => 'Priya Raman',
            'email' => 'priya@quietwaterbikes.example',
            'phone' => '+1 503 555 0178',
            'billing_address' => "2290 SE Clinton Street\nPortland, OR 97202",
            'payment_terms_days' => 7,
            'notes' => 'Pays by bank transfer, usually within two days.',
        ],
        [
            'name' => 'Ridgeline Analytics',
            'contact_name' => 'Tomas Bergqvist',
            'email' => 'billing@ridgelineanalytics.example',
            'phone' => '+46 8 505 55 012',
            'billing_address' => "Vasagatan 16\n111 20 Stockholm",
            'payment_terms_days' => 30,
            'notes' => 'Finance team reconciles on the 25th of each month.',
        ],
    ];

    /**
     * Sample line items keyed by invoice index. Fixture data, not interface copy.
     *
     * @var array<int, array<int, array{description: string, quantity: float, unit_amount_cents: int}>>
     */
    private const SAMPLE_LINE_ITEMS = [
        [
            ['description' => 'Storefront redesign, discovery phase', 'quantity' => 18.0, 'unit_amount_cents' => 11500],
            ['description' => 'Checkout usability testing', 'quantity' => 6.0, 'unit_amount_cents' => 9500],
        ],
        [
            ['description' => 'Motion graphics for launch reel', 'quantity' => 24.0, 'unit_amount_cents' => 13000],
        ],
        [
            ['description' => 'Inventory sync integration', 'quantity' => 32.5, 'unit_amount_cents' => 10500],
            ['description' => 'On call support retainer', 'quantity' => 1.0, 'unit_amount_cents' => 60000],
        ],
        [
            ['description' => 'Dashboard performance audit', 'quantity' => 12.0, 'unit_amount_cents' => 14500],
        ],
        [
            ['description' => 'Data warehouse migration', 'quantity' => 40.0, 'unit_amount_cents' => 12500],
            ['description' => 'Team training workshop', 'quantity' => 2.0, 'unit_amount_cents' => 45000],
        ],
        [
            ['description' => 'Quarterly reporting templates', 'quantity' => 9.0, 'unit_amount_cents' => 11000],
        ],
    ];

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $clients = collect(self::SAMPLE_CLIENTS)->map(
            fn (array $attributes): Client => $user->clients()->create([
                ...$attributes,
                'company_number' => 'REG-'.random_int(100000, 999999),
                'currency' => 'USD',
                'is_archived' => false,
            ])
        );

        $blueprints = [
            ['status' => InvoiceStatus::Paid, 'issued' => 62, 'due' => 48, 'paid' => 45, 'method' => 'bank transfer', 'tax' => 2000],
            ['status' => InvoiceStatus::Paid, 'issued' => 40, 'due' => 26, 'paid' => 24, 'method' => 'credit card', 'tax' => 0],
            ['status' => InvoiceStatus::Overdue, 'issued' => 34, 'due' => 12, 'paid' => null, 'method' => null, 'tax' => 500],
            ['status' => InvoiceStatus::Sent, 'issued' => 9, 'due' => -5, 'paid' => null, 'method' => null, 'tax' => 2000],
            ['status' => InvoiceStatus::Sent, 'issued' => 4, 'due' => -10, 'paid' => null, 'method' => null, 'tax' => 0],
            ['status' => InvoiceStatus::Draft, 'issued' => 1, 'due' => -20, 'paid' => null, 'method' => null, 'tax' => 500],
        ];

        foreach ($blueprints as $index => $blueprint) {
            $client = $clients[$index % $clients->count()];

            $invoice = $user->invoices()->create([
                'client_id' => $client->id,
                'number' => sprintf('INV-2026-%03d', $index + 1),
                'public_token' => Str::lower(Str::random(32)),
                'status' => $blueprint['status'],
                'issued_on' => now()->subDays($blueprint['issued'])->format('Y-m-d'),
                'due_on' => now()->subDays($blueprint['due'])->format('Y-m-d'),
                'paid_on' => $blueprint['paid'] ? now()->subDays($blueprint['paid'])->format('Y-m-d') : null,
                'payment_method' => $blueprint['method'],
                'tax_rate_basis_points' => $blueprint['tax'],
                'currency' => 'USD',
                'notes' => 'Thanks for the work this month, invoice references project ref '.strtoupper(Str::random(6)).'.',
            ]);

            foreach (self::SAMPLE_LINE_ITEMS[$index] as $position => $item) {
                $invoice->items()->save(new InvoiceItem([
                    ...$item,
                    'position' => $position,
                ]));
            }
        }
    }
}
