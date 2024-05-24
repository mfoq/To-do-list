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
            'title' => fake()->unique()->sentence(6),
            'description' => fake()->text(),
            'due_date' => fake()->dateTimeBetween('now', '+1 month'),
            'status' => fake()->randomElement(['Completed', 'In Progress', 'Pending']),
        ];
    }
}
