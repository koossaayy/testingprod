<?php

namespace Database\Factories;

use App\Models\Invoice;
use App\Models\InvoiceItem;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InvoiceItem>
 */
class InvoiceItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_id' => Invoice::factory(),
            'description' => fake()->randomElement([
                'Frontend implementation',
                'Design review session',
                'API integration work',
                'Monthly retainer',
            ]),
            'quantity' => fake()->randomFloat(2, 1, 20),
            'unit_amount_cents' => fake()->numberBetween(5000, 25000),
            'position' => 0,
        ];
    }
}
