<?php

use App\Models\Badge;
use App\Models\Level;
use App\Models\User;

test('database seeder runs without errors', function () {
    $this->seed();

    expect(Level::count())->toBeGreaterThan(0);
    expect(Badge::count())->toBeGreaterThan(0);
});

test('admin user is created after seeding', function () {
    $this->seed();

    $admin = User::where('role', 'admin')->first();
    expect($admin)->not->toBeNull();
});

test('levels are seeded with correct order', function () {
    $this->seed();

    $levels = Level::orderBy('order')->get();
    expect($levels->first()->order)->toBeLessThan($levels->last()->order);
});

test('badges have valid condition types', function () {
    $this->seed();

    $validTypes = ['total_xp', 'completed_missions', 'streak_days', null];
    $badges = Badge::all();

    foreach ($badges as $badge) {
        expect($badge->condition_type)->toBeIn($validTypes);
    }
});
