<?php

namespace Database\Factories;

use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MissionSlide>
 */
class MissionSlideFactory extends Factory
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
            'type' => 'intro',
            'title' => fake()->sentence(4),
            'content' => fake()->paragraph(),
            'image' => fake()->optional(0.3)->imageUrl(640, 480),
            'audio_url' => fake()->optional(0.2)->url(),
            'button_text' => fake()->randomElement(['Lanjut', 'Berikutnya', 'Mulai', 'Ayo!']),
            'options' => null,
            'correct_answer' => null,
            'explanation' => null,
            'order' => fake()->numberBetween(1, 20),
        ];
    }

    /**
     * Indicate that the slide is a quiz type.
     */
    public function quiz(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'quiz',
            'options' => [
                ['id' => 1, 'text' => fake()->sentence(3), 'correct' => true],
                ['id' => 2, 'text' => fake()->sentence(3), 'correct' => false],
                ['id' => 3, 'text' => fake()->sentence(3), 'correct' => false],
                ['id' => 4, 'text' => fake()->sentence(3), 'correct' => false],
            ],
            'correct_answer' => null,
            'explanation' => fake()->sentence(),
        ]);
    }

    /**
     * Indicate that the slide is a code_arrange type.
     */
    public function codeArrange(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'code_arrange',
            'options' => [
                ['id' => 0, 'text' => '$variable = "hello";'],
                ['id' => 1, 'text' => 'echo $variable;'],
                ['id' => 2, 'text' => '$variable .= " world";'],
            ],
            'correct_answer' => '0,1,2',
            'explanation' => fake()->sentence(),
        ]);
    }

    /**
     * Indicate that the slide is a code_fillblank type.
     */
    public function codeFillblank(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'code_fillblank',
            'content' => 'function greet($name) { return "Hello, " . ___; }',
            'options' => [
                ['type' => 'text', 'value' => 'return "Hello, " . '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 'A'],
            ],
            'correct_answer' => json_encode([
                ['id' => 'A', 'text' => '$name'],
                ['id' => 'B', 'text' => '$greeting'],
            ]),
            'explanation' => fake()->sentence(),
        ]);
    }

    /**
     * Indicate that the slide is a block_code type.
     */
    public function blockCode(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'block_code',
            'content' => fake()->paragraph(),
            'options' => [
                ['id' => 1, 'text' => 'if ($x > 0)'],
                ['id' => 2, 'text' => '{ echo "positive"; }'],
                ['id' => 3, 'text' => 'else { echo "negative"; }'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => fake()->sentence(),
        ]);
    }
}
