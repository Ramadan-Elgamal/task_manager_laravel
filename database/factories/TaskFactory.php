<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Task>
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
            'title' => fake()->sentence(4),
            'description' => fake()->paragraph(3),
            'due_date' => fake()->dateTimeBetween('now', '+2 months')->format('Y-m-d'),
            'priority' => fake()->randomElement(['Low', 'Medium', 'High', 'Urgent']),
            'status' => fake()->randomElement(['To Do', 'In Progress', 'Done']),
            'user_id' => User::factory(),
        ];
    }
}
