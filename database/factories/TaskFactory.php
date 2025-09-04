<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    protected $model = Task::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,
            'title' => fake()->sentence(),
            'description' => fake()->sentence(),
            'status' => fake()->randomElement([Task::STATUS_TODO, Task::STATUS_IN_PROGRESS, Task::STATUS_DONE]),
            'due_date' => fake()->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
        ];
    }
}
