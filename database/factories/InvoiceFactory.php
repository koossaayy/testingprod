<?php

namespace Database\Factories;

use App\Enums\InvoiceStatus;
use App\Models\Client;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $issuedOn = fake()->dateTimeBetween('-4 months', 'now');

        return [
            'user_id' => User::factory(),
            'client_id' => Client::factory(),
            'number' => 'INV-'.fake()->unique()->numberBetween(1000, 9999),
            'public_token' => Str::lower(Str::random(32)),
            'status' => InvoiceStatus::Draft,
            'issued_on' => $issuedOn->format('Y-m-d'),
            'due_on' => fake()->dateTimeBetween($issuedOn, '+1 month')->format('Y-m-d'),
            'paid_on' => null,
            'payment_method' => null,
            'tax_rate_basis_points' => fake()->randomElement([0, 500, 2000]),
            'currency' => 'USD',
            'notes' => fake()->sentence(),
        ];
    }

    /**
     * Indicate that the invoice has been paid.
     */
    public function paid(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => InvoiceStatus::Paid,
            'paid_on' => now()->subDays(3)->format('Y-m-d'),
            'payment_method' => 'bank transfer',
        ]);
    }

    /**
     * Indicate that the invoice is past its due date.
     */
    public function overdue(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => InvoiceStatus::Overdue,
            'due_on' => now()->subDays(12)->format('Y-m-d'),
        ]);
    }

    /**
     * Indicate that the invoice has been emailed to the client.
     */
    public function sent(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => InvoiceStatus::Sent,
        ]);
    }
}
