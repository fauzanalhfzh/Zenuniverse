<?php

namespace Database\Factories;

use App\Models\Level;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'level_id' => Level::factory(),
            'title' => fake()->sentence(3),
            'type' => fake()->randomElement(['mission', 'quiz', 'practice']),
            'description' => fake()->paragraph(),
            'icon' => fake()->randomElement(['📚', '🎯', '💡', '🔬', '🧪']),
            'order' => fake()->numberBetween(1, 50),
            'xp_reward' => fake()->randomElement([50, 100, 150, 200, 250]),
        ];
    }
}
