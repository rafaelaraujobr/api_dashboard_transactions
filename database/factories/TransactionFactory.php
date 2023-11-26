<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client' => fake('pt_BR')->company(),
            'region' => fake('pt_BR')->stateAbbr(),
            'user_agent' => fake()->userAgent(),
            'gender' => fake()->randomElement(['male', 'male', 'female', 'female', 'female', 'other']),
            'ip' => fake()->ipv4(),
            'payment_method' => fake()->randomElement(['credit_card', 'credit_card', 'debit_card', 'pix', 'ticket']),
            'payment_status' => fake()->randomElement(['authorized', 'paid', 'paid', 'canceled', 'declined', 'refunded', 'pending']),
            'device' => fake()->randomElement(['mobile', 'mobile', 'mobile', 'tablet', 'desktop']),
            'lat' => fake($min = -55, 6752, $max = -33, 7516)->latitude(), // max and min latitude in Brazil
            'long' => fake($min = -75, 2552, $max = -28, 2552)->longitude(), // max and min longitude in Brazil
            'value' => fake()->randomFloat(2, 80, 1000),
            'quantity' => fake()->numberBetween(1, 6),
            'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
