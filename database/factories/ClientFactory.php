<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'name' => fake()->company(),
            'contact_name' => fake()->name(),
            'email' => fake()->unique()->companyEmail(),
            'phone' => fake()->phoneNumber(),
            'company_number' => fake()->bothify('??-########'),
            'billing_address' => fake()->address(),
            'currency' => 'USD',
            'payment_terms_days' => fake()->randomElement([7, 14, 30]),
            'notes' => fake()->sentence(),
            'is_archived' => false,
        ];
    }

    /**
     * Indicate that the client is no longer active.
     */
    public function archived(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_archived' => true,
        ]);
    }
}
