<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserProgress>
 */
class UserProgressFactory extends Factory
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
            'lesson_id' => Lesson::factory(),
            'mission_slug' => fake()->slug(2),
            'status' => fake()->randomElement(['started', 'completed']),
            'xp_earned' => fake()->randomElement([0, 10, 20, 30, 50]),
            'completed_at' => fake()->optional(0.5)->dateTimeBetween('-30 days', 'now'),
        ];
    }

    /**
     * Indicate that the progress is completed.
     */
    public function completed(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'completed',
            'xp_earned' => fake()->randomElement([10, 20, 30, 50]),
            'completed_at' => fake()->dateTimeBetween('-30 days', 'now'),
        ]);
    }

    /**
     * Indicate that the progress is in progress.
     */
    public function inProgress(): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => 'started',
            'xp_earned' => 0,
            'completed_at' => null,
        ]);
    }
}
