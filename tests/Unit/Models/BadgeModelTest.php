<?php

use App\Models\Badge;
use App\Models\User;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('badge belongs to many users with pivot', function () {
    $badge = Badge::factory()->create();
    $user = User::factory()->create();

    $badge->users()->attach($user->id, ['unlocked_at' => now()]);

    expect($badge->users)->toHaveCount(1);
    expect($badge->users->first()->id)->toBe($user->id);
    expect($badge->users->first()->pivot->unlocked_at)->not->toBeNull();
});

test('badge has empty guarded array', function () {
    $badge = new Badge();

    expect($badge->getGuarded())->toBe([]);
});

test('badge can be mass assigned with any attributes', function () {
    $badge = Badge::create([
        'name' => 'Test Badge',
        'description' => 'A test badge',
        'icon' => '🏆',
        'color_theme' => 'gold',
        'rarity' => 'Langka',
        'condition_type' => 'total_xp',
        'condition_value' => 100,
    ]);

    expect($badge)->toBeInstanceOf(Badge::class);
    expect($badge->name)->toBe('Test Badge');
    expect($badge->condition_type)->toBe('total_xp');
});
