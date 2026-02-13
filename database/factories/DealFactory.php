<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Deal>
 */
class DealFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => fake()->numberBetween(1, 40),
            'amount' => fake()->numberBetween(500, 7500),
            'stage' => fake()->randomElement(['new', 'progress', 'won', 'lost']),
            'expected_close_date' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
