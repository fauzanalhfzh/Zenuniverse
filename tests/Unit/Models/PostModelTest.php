<?php

use App\Models\Post;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('post belongs to user as author', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create(['author_id' => $user->id]);

    expect($post->author)->toBeInstanceOf(User::class);
    expect($post->author->id)->toBe($user->id);
});

test('published scope returns only published posts', function () {
    $user = User::factory()->create();

    // Published post
    Post::factory()->create([
        'author_id' => $user->id,
        'is_published' => true,
        'published_at' => now()->subDay(),
    ]);

    // Unpublished post
    Post::factory()->create([
        'author_id' => $user->id,
        'is_published' => false,
        'published_at' => now()->subDay(),
    ]);

    // Future post
    Post::factory()->create([
        'author_id' => $user->id,
        'is_published' => true,
        'published_at' => now()->addDay(),
    ]);

    // Null published_at
    Post::factory()->create([
        'author_id' => $user->id,
        'is_published' => true,
        'published_at' => null,
    ]);

    $published = Post::published()->get();

    expect($published)->toHaveCount(1);
});

test('published_at is cast to datetime', function () {
    $post = Post::factory()->create(['published_at' => '2024-01-01 12:00:00']);

    expect($post->published_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
});

test('is_published is cast to boolean', function () {
    $post = Post::factory()->create(['is_published' => 1]);

    expect($post->is_published)->toBeBool();
    expect($post->is_published)->toBeTrue();
});
