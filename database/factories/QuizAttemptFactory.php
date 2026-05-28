<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\QuizAttempt>
 */
class QuizAttemptFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $totalQuestions = fake()->randomElement([5, 10, 15, 20]);
        $score = fake()->numberBetween(0, $totalQuestions);

        return [
            'user_id' => User::factory(),
            'lesson_id' => Lesson::factory(),
            'score' => $score,
            'total_questions' => $totalQuestions,
            'passed' => $score >= ($totalQuestions * 0.7),
        ];
    }

    /**
     * Indicate that the quiz attempt passed.
     */
    public function passed(): static
    {
        return $this->state(function (array $attributes) {
            $total = $attributes['total_questions'] ?? 10;
            $minScore = (int) ceil($total * 0.7);

            return [
                'score' => fake()->numberBetween($minScore, $total),
                'passed' => true,
            ];
        });
    }

    /**
     * Indicate that the quiz attempt failed.
     */
    public function failed(): static
    {
        return $this->state(function (array $attributes) {
            $total = $attributes['total_questions'] ?? 10;
            $maxScore = (int) floor($total * 0.7) - 1;

            return [
                'score' => fake()->numberBetween(0, max(0, $maxScore)),
                'passed' => false,
            ];
        });
    }
}
