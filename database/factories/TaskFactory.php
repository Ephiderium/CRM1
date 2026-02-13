<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
            'assigned_to' => fake()->numberBetween(1, 5),
            'related_type' => 'client',
            'related_id' => 1,
            'due_date' => fake()->dateTimeBetween('-1 month', 'now'),
            'status' => fake()->randomElement(['new', 'progress', 'done', 'overdue']),
        ];
    }
}
