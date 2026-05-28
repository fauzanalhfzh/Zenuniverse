<?php

namespace Database\Factories;

use App\Models\Badge;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Badge>
 */
class BadgeFactory extends Factory
{
    protected $model = Badge::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $conditionType = fake()->randomElement(['total_xp', 'completed_missions', 'streak_days']);

        $conditionValues = [
            'total_xp' => fake()->randomElement([100, 500, 1000, 2500, 5000]),
            'completed_missions' => fake()->randomElement([1, 5, 10, 25, 50]),
            'streak_days' => fake()->randomElement([3, 7, 14, 30, 60]),
        ];

        return [
            'name' => fake()->unique()->words(2, true),
            'description' => fake()->sentence(),
            'icon' => fake()->randomElement(['🏅', '🎖️', '🥇', '🥈', '🥉', '💎', '🔥', '⚡']),
            'color_theme' => fake()->hexColor(),
            'rarity' => fake()->randomElement(['Umum', 'Tidak Umum', 'Langka', 'Epik', 'Legendaris']),
            'condition_type' => $conditionType,
            'condition_value' => $conditionValues[$conditionType],
        ];
    }
}
