<?php

use App\Models\Badge;
use App\Models\Level;
use App\Models\User;
use App\Models\UserProgress;
use Filament\Panel;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

test('user belongs to a level via currentLevel', function () {
    $level = Level::factory()->create();
    $user = User::factory()->create(['current_level_id' => $level->id]);

    expect($user->currentLevel)->toBeInstanceOf(Level::class);
    expect($user->currentLevel->id)->toBe($level->id);
});

test('user has many progress records', function () {
    $user = User::factory()->create();
    $progress = UserProgress::factory()->count(3)->create(['user_id' => $user->id]);

    expect($user->progress)->toHaveCount(3);
    expect($user->progress->first())->toBeInstanceOf(UserProgress::class);
});

test('user belongs to many badges with pivot', function () {
    $user = User::factory()->create();
    $badge = Badge::factory()->create();

    $user->badges()->attach($badge->id, ['unlocked_at' => now()]);

    expect($user->badges)->toHaveCount(1);
    expect($user->badges->first()->pivot->unlocked_at)->not->toBeNull();
});

test('password is automatically hashed', function () {
    $user = User::factory()->create(['password' => 'plaintext']);

    expect($user->password)->not->toBe('plaintext');
    expect(\Illuminate\Support\Facades\Hash::check('plaintext', $user->password))->toBeTrue();
});

test('canAccessPanel returns true for admin role', function () {
    $user = User::factory()->create(['role' => 'admin']);
    $panel = \Mockery::mock(Panel::class);

    expect($user->canAccessPanel($panel))->toBeTrue();
});

test('canAccessPanel returns true for teacher role', function () {
    $user = User::factory()->create(['role' => 'teacher']);
    $panel = \Mockery::mock(Panel::class);

    expect($user->canAccessPanel($panel))->toBeTrue();
});

test('canAccessPanel returns true for editor role', function () {
    $user = User::factory()->create(['role' => 'editor']);
    $panel = \Mockery::mock(Panel::class);

    expect($user->canAccessPanel($panel))->toBeTrue();
});

test('canAccessPanel returns false for student role', function () {
    $user = User::factory()->create(['role' => 'student']);
    $panel = \Mockery::mock(Panel::class);

    expect($user->canAccessPanel($panel))->toBeFalse();
});

test('password and remember_token are hidden', function () {
    $user = User::factory()->create();
    $hidden = $user->getHidden();

    expect($hidden)->toContain('password');
    expect($hidden)->toContain('remember_token');
});

test('dates are properly cast', function () {
    $user = User::factory()->create([
        'email_verified_at' => '2024-01-01 00:00:00',
        'last_activity_at' => '2024-01-01 12:00:00',
        'last_heart_replenished_at' => '2024-01-01 12:00:00',
    ]);

    expect($user->email_verified_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
    expect($user->last_activity_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
    expect($user->last_heart_replenished_at)->toBeInstanceOf(\Illuminate\Support\Carbon::class);
});

test('user has correct default values', function () {
    $user = User::factory()->create();

    expect($user->role)->toBe('student');
    expect($user->hearts)->toBe(5);
    expect($user->total_xp)->toBe(0);
    expect($user->current_xp)->toBe(0);
    expect($user->current_streak)->toBe(0);
    expect($user->longest_streak)->toBe(0);
});
