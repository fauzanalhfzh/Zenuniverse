<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = $this->faker->sentence();
        return [
            'title' => $title,
            'slug' => \Illuminate\Support\Str::slug($title),
            'excerpt' => $this->faker->paragraph(),
            'content' => $this->faker->paragraphs(3, true),
            'thumbnail' => 'https://picsum.photos/seed/' . $this->faker->word() . '/800/600',
            'published_at' => now(),
            'is_published' => true,
            'author_id' => \App\Models\User::first()?->id ?? \App\Models\User::factory(),
        ];
    }
}
