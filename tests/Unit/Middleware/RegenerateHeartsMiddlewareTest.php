<?php

use App\Models\User;
use Carbon\Carbon;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

afterEach(function () {
    Carbon::setTestNow();
});

test('does not run for guest users', function () {
    $response = $this->get('/');

    $response->assertOk();
});

test('sets last_heart_replenished_at when null and hearts less than 5', function () {
    $user = User::factory()->create([
        'hearts' => 3,
        'last_heart_replenished_at' => null,
    ]);

    $this->actingAs($user)->get('/dashboard');
    $user->refresh();

    expect($user->last_heart_replenished_at)->not->toBeNull();
});

test('regenerates 1 heart after 300 seconds', function () {
    Carbon::setTestNow(Carbon::parse('2024-06-15 10:10:00'));

    $user = User::factory()->create([
        'hearts' => 3,
        'last_heart_replenished_at' => Carbon::parse('2024-06-15 10:04:00'), // 360 seconds ago
    ]);

    $this->actingAs($user)->get('/dashboard');
    $user->refresh();

    expect($user->hearts)->toBe(4);
});

test('regenerates multiple hearts for longer intervals', function () {
    Carbon::setTestNow(Carbon::parse('2024-06-15 10:20:00'));

    $user = User::factory()->create([
        'hearts' => 2,
        'last_heart_replenished_at' => Carbon::parse('2024-06-15 10:08:00'), // 720 seconds = 2 hearts
    ]);

    $this->actingAs($user)->get('/dashboard');
    $user->refresh();

    expect($user->hearts)->toBe(4);
});

test('caps hearts at maximum 5', function () {
    Carbon::setTestNow(Carbon::parse('2024-06-15 11:00:00'));

    $user = User::factory()->create([
        'hearts' => 3,
        'last_heart_replenished_at' => Carbon::parse('2024-06-15 10:00:00'), // 3600 seconds = 12 hearts
    ]);

    $this->actingAs($user)->get('/dashboard');
    $user->refresh();

    expect($user->hearts)->toBe(5);
});

test('does nothing when hearts are already 5', function () {
    $user = User::factory()->create([
        'hearts' => 5,
        'last_heart_replenished_at' => null,
    ]);

    $this->actingAs($user)->get('/dashboard');
    $user->refresh();

    expect($user->hearts)->toBe(5);
});

test('nulls last_heart_replenished_at when hearts reach 5', function () {
    Carbon::setTestNow(Carbon::parse('2024-06-15 11:00:00'));

    $user = User::factory()->create([
        'hearts' => 4,
        'last_heart_replenished_at' => Carbon::parse('2024-06-15 10:50:00'), // 600 seconds = 2 hearts → 5+
    ]);

    $this->actingAs($user)->get('/dashboard');
    $user->refresh();

    expect($user->hearts)->toBe(5);
    expect($user->last_heart_replenished_at)->toBeNull();
});
