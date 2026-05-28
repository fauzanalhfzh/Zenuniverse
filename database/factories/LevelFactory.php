<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Level>
 */
class LevelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(['Pemula', 'Dasar', 'Menengah', 'Mahir', 'Ahli']),
            'order' => fake()->unique()->numberBetween(1, 100),
            'xp_required' => fake()->numberBetween(0, 5000),
            'icon' => fake()->randomElement(['🌱', '🌿', '🌳', '⭐', '🏆']),
            'color' => fake()->hexColor(),
        ];
    }
}
