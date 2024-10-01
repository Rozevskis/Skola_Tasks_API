<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\User; // Import the User model
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'user_id' => User::factory(), // Assign a user to the task
            'title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'completed' => $this->faker->boolean,
        ];
    }
}
