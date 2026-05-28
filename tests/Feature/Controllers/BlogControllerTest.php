<?php

use App\Models\Post;
use App\Models\User;

test('blog index page loads successfully', function () {
    $this->get('/blog')->assertOk();
});

test('only published posts are shown on index', function () {
    $user = User::factory()->create();

    $published = Post::factory()->create([
        'author_id' => $user->id,
        'title' => 'Published Post',
        'is_published' => true,
        'published_at' => now()->subDay(),
    ]);

    $unpublished = Post::factory()->create([
        'author_id' => $user->id,
        'title' => 'Draft Post',
        'is_published' => false,
        'published_at' => now()->subDay(),
    ]);

    $response = $this->get('/blog');

    $response->assertSee('Published Post');
    $response->assertDontSee('Draft Post');
});

test('future-dated posts are not visible', function () {
    $user = User::factory()->create();

    Post::factory()->create([
        'author_id' => $user->id,
        'title' => 'Future Post',
        'is_published' => true,
        'published_at' => now()->addWeek(),
    ]);

    $this->get('/blog')->assertDontSee('Future Post');
});

test('blog show displays correct post by slug', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create([
        'author_id' => $user->id,
        'slug' => 'test-post-slug',
        'title' => 'My Test Post',
        'is_published' => true,
        'published_at' => now()->subDay(),
    ]);

    $this->get('/blog/test-post-slug')
        ->assertOk()
        ->assertSee('My Test Post');
});

test('non-existent slug returns 404', function () {
    $this->get('/blog/nonexistent-post-slug')->assertNotFound();
});

test('unpublished post slug returns 404', function () {
    $user = User::factory()->create();
    $post = Post::factory()->create([
        'author_id' => $user->id,
        'slug' => 'draft-post',
        'is_published' => false,
    ]);

    $this->get('/blog/draft-post')->assertNotFound();
});
