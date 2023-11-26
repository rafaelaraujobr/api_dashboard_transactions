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
            // 'region' => fake('pt_BR')->stateAbbr(),
            'region' => fake('pt_BR')->randomElement(['SP', 'SP', 'SP', 'RJ', 'RJ', 'MG', 'MG', 'DF', 'DF', 'BA', 'PR', 'RS', 'CE', 'GO', 'AM', 'SC', 'ES', 'MT', 'PA', 'PE', 'MA', 'MS', 'PB', 'RN', 'AL', 'PI', 'SE', 'RO', 'TO', 'AC', 'AP', 'RR']),
            'user_agent' => fake()->userAgent(),
            'gender' => fake()->randomElement(['male', 'male', 'female', 'female', 'female', 'other']),
            'ip' => fake()->ipv4(),
            'payment_method' => fake()->randomElement(['credit_card', 'credit_card', 'debit_card', 'pix', 'ticket']),
            'payment_status' => fake()->randomElement(['authorized', 'paid', 'paid', 'canceled', 'declined', 'refunded', 'pending']),
            'device' => fake()->randomElement(['mobile', 'mobile', 'mobile', 'tablet', 'desktop']),
            'lat' => fake()->latitude($min = -33.7500, $max =  5.2700), // max and min latitude in Brazil
            'long' => fake()->longitude($min = -73.9900, $max = -34.7900), // max and min longitude in Brazil
            'value' => fake()->randomFloat(2, 80, 1000),
            'quantity' => fake()->numberBetween(1, 6),
            'created_at' => fake()->dateTimeBetween('-1 month', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
