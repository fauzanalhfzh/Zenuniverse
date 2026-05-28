<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lesson>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->sentence(4);

        return [
            'course_id' => Course::factory(),
            'title' => $title,
            'slug' => Str::slug($title) . '-' . fake()->unique()->randomNumber(5),
            'icon' => fake()->randomElement(['📖', '🎬', '✏️', '🧩', '🔑']),
            'content' => fake()->paragraphs(3, true),
            'video_url' => fake()->optional(0.3)->url(),
            'order' => fake()->numberBetween(1, 30),
            'xp_reward' => fake()->randomElement([10, 20, 30, 50]),
        ];
    }
}
