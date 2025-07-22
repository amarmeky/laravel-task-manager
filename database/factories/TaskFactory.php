<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

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
            'user_id' => User::inRandomorder()->first()->id,
            'title' => fake()->sentence,
            'description' => fake()->paragraph,
            'priority' => fake()->randomElement(['high', 'medium', 'low'])
        ];
    }
}
