<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Question>
 */
class QuestionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lesson_id' => Lesson::factory(),
            'question' => fake()->sentence() . '?',
            'options' => [
                ['id' => 'A', 'text' => fake()->sentence(3)],
                ['id' => 'B', 'text' => fake()->sentence(3)],
                ['id' => 'C', 'text' => fake()->sentence(3)],
                ['id' => 'D', 'text' => fake()->sentence(3)],
            ],
            'correct_answer' => fake()->randomElement(['A', 'B', 'C', 'D']),
            'order' => fake()->numberBetween(1, 20),
        ];
    }
}
