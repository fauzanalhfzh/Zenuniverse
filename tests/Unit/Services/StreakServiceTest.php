<?php

use App\Models\User;
use App\Services\StreakService;
use Carbon\Carbon;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->service = new StreakService();
});

afterEach(function () {
    Carbon::setTestNow();
});

test('increments streak when last activity was yesterday', function () {
    Carbon::setTestNow(Carbon::parse('2024-06-15 10:00:00'));

    $user = User::factory()->create([
        'current_streak' => 3,
        'longest_streak' => 5,
        'last_activity_at' => Carbon::parse('2024-06-14 18:00:00'),
    ]);

    $this->service->recordActivity($user);
    $user->refresh();

    expect($user->current_streak)->toBe(4);
});

test('resets streak to 1 when gap is more than 1 day', function () {
    Carbon::setTestNow(Carbon::parse('2024-06-15 10:00:00'));

    $user = User::factory()->create([
        'current_streak' => 5,
        'longest_streak' => 5,
        'last_activity_at' => Carbon::parse('2024-06-12 18:00:00'), // 3 days ago
    ]);

    $this->service->recordActivity($user);
    $user->refresh();

    expect($user->current_streak)->toBe(1);
});

test('skips if already active today', function () {
    Carbon::setTestNow(Carbon::parse('2024-06-15 15:00:00'));

    $user = User::factory()->create([
        'current_streak' => 3,
        'last_activity_at' => Carbon::parse('2024-06-15 10:00:00'), // Earlier today
    ]);

    $this->service->recordActivity($user);
    $user->refresh();

    expect($user->current_streak)->toBe(3); // Unchanged
});

test('updates longest_streak when current exceeds it', function () {
    Carbon::setTestNow(Carbon::parse('2024-06-15 10:00:00'));

    $user = User::factory()->create([
        'current_streak' => 5,
        'longest_streak' => 5,
        'last_activity_at' => Carbon::parse('2024-06-14 18:00:00'),
    ]);

    $this->service->recordActivity($user);
    $user->refresh();

    expect($user->current_streak)->toBe(6);
    expect($user->longest_streak)->toBe(6);
});

test('does not update longest_streak when current does not exceed it', function () {
    Carbon::setTestNow(Carbon::parse('2024-06-15 10:00:00'));

    $user = User::factory()->create([
        'current_streak' => 2,
        'longest_streak' => 10,
        'last_activity_at' => Carbon::parse('2024-06-14 18:00:00'),
    ]);

    $this->service->recordActivity($user);
    $user->refresh();

    expect($user->current_streak)->toBe(3);
    expect($user->longest_streak)->toBe(10);
});

test('sets last_activity_at to now', function () {
    Carbon::setTestNow(Carbon::parse('2024-06-15 10:00:00'));

    $user = User::factory()->create([
        'current_streak' => 0,
        'last_activity_at' => null,
    ]);

    $this->service->recordActivity($user);
    $user->refresh();

    expect($user->last_activity_at->toDateTimeString())->toBe('2024-06-15 10:00:00');
});

test('starts fresh streak when no previous activity', function () {
    $user = User::factory()->create([
        'current_streak' => 0,
        'longest_streak' => 0,
        'last_activity_at' => null,
    ]);

    $this->service->recordActivity($user);
    $user->refresh();

    expect($user->current_streak)->toBe(1);
    expect($user->longest_streak)->toBe(1);
});
