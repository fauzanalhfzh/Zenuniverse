<?php

use App\Models\Lesson;
use App\Models\User;

test('guest cannot access dashboard', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

test('guest cannot access profile', function () {
    $this->get('/profile')->assertRedirect('/login');
});

test('guest cannot access leaderboard', function () {
    $this->get('/leaderboard')->assertRedirect('/login');
});

test('guest cannot access learning center', function () {
    $this->get('/learning-center')->assertRedirect('/login');
});

test('guest cannot access lesson player', function () {
    $lesson = Lesson::factory()->create();

    $this->get("/lesson/{$lesson->id}")->assertRedirect('/login');
});

test('unverified user cannot access dashboard', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)->get('/dashboard')->assertRedirect('/verify-email');
});

test('unverified user cannot access profile', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)->get('/profile')->assertRedirect('/verify-email');
});

test('unverified user cannot access leaderboard', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)->get('/leaderboard')->assertRedirect('/verify-email');
});

test('unverified user cannot access learning center', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)->get('/learning-center')->assertRedirect('/verify-email');
});

test('authenticated user is redirected from login page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/login')->assertRedirect('/');
});

test('authenticated user is redirected from register page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/register')->assertRedirect('/');
});

test('student cannot access filament admin panel', function () {
    $student = User::factory()->create(['role' => 'student']);

    $this->actingAs($student)->get('/admin')->assertForbidden();
});
