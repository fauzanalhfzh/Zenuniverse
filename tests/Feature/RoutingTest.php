<?php

use App\Models\User;

test('public routes return 200', function (string $route) {
    $this->get($route)->assertOk();
})->with(['/', '/contact', '/learning-path', '/blog', '/tracks']);

test('auth routes redirect guests to login', function (string $route) {
    $this->get($route)->assertRedirect('/login');
})->with(['/dashboard', '/profile', '/leaderboard', '/learning-center']);

test('guest-only routes redirect authenticated users', function (string $route) {
    $user = User::factory()->create();

    $this->actingAs($user)->get($route)->assertRedirect('/');
})->with(['/login', '/register']);

test('named routes resolve correctly', function () {
    expect(route('home'))->toContain('/');
    expect(route('dashboard'))->toContain('/dashboard');
    expect(route('login'))->toContain('/login');
    expect(route('register'))->toContain('/register');
    expect(route('blog.index'))->toContain('/blog');
    expect(route('contact'))->toContain('/contact');
    expect(route('leaderboard'))->toContain('/leaderboard');
    expect(route('profile'))->toContain('/profile');
    expect(route('tracks'))->toContain('/tracks');
});

test('blog show route with slug works', function () {
    $post = \App\Models\Post::factory()->create([
        'slug' => 'routing-test-post',
        'is_published' => true,
        'published_at' => now()->subDay(),
    ]);

    $this->get('/blog/routing-test-post')->assertOk();
});

test('lesson route requires authentication', function () {
    $lesson = \App\Models\Lesson::factory()->create();

    $this->get("/lesson/{$lesson->id}")->assertRedirect('/login');
});
