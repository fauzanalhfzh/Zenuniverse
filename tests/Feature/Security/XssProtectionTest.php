<?php

use App\Models\Post;
use App\Models\User;

test('xss in username is escaped in dashboard', function () {
    $user = User::factory()->create([
        'name' => '<script>alert("xss")</script>',
    ]);

    $response = $this->actingAs($user)->get('/dashboard');

    // Blade {{ }} should escape the script tag
    $response->assertDontSee('<script>alert("xss")</script>', false);
});

test('xss in blog post title is escaped', function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        'author_id' => $user->id,
        'title' => '<img src=x onerror=alert(1)>',
        'slug' => 'xss-post',
        'is_published' => true,
        'published_at' => now()->subDay(),
    ]);

    $response = $this->get('/blog');

    // Should not see unescaped HTML
    $response->assertDontSee('<img src=x onerror=alert(1)>', false);
});

test('xss in blog post content is escaped on show page', function () {
    $user = User::factory()->create();

    $post = Post::factory()->create([
        'author_id' => $user->id,
        'title' => 'Normal Title',
        'slug' => 'xss-content-post',
        'content' => '<script>document.cookie</script><p>Normal text</p>',
        'is_published' => true,
        'published_at' => now()->subDay(),
    ]);

    $response = $this->get('/blog/xss-content-post');

    $response->assertDontSee('<script>document.cookie</script>', false);
});

test('html entities are properly encoded in profile', function () {
    $user = User::factory()->create([
        'name' => '"><svg onload=alert(1)>',
    ]);

    $response = $this->actingAs($user)->get('/profile');

    $response->assertDontSee('"><svg onload=alert(1)>', false);
});
