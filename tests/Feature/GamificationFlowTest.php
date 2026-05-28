<?php

use App\Models\Badge;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\User;
use App\Models\UserProgress;
use App\Services\LessonService;
use App\Services\StreakService;
use Carbon\Carbon;

afterEach(function () {
    Carbon::setTestNow();
});

test('full lesson completion awards XP and levels up', function () {
    $level1 = Level::factory()->create(['name' => 'Pemula', 'order' => 1, 'xp_required' => 0]);
    $level2 = Level::factory()->create(['name' => 'Menengah', 'order' => 2, 'xp_required' => 100]);

    $user = User::factory()->create([
        'current_level_id' => $level1->id,
        'total_xp' => 0,
        'current_xp' => 0,
    ]);

    $lesson = Lesson::factory()->create(['xp_reward' => 150]);

    $service = app(LessonService::class);
    $service->completeLesson($user, $lesson);
    $user->refresh();

    expect($user->total_xp)->toBe(150);
    expect($user->current_level_id)->toBe($level2->id);
});

test('full mission completion returns gamification data', function () {
    $user = User::factory()->create(['total_xp' => 0, 'current_xp' => 0]);
    $lesson = Lesson::factory()->create(['slug' => 'test-mission', 'xp_reward' => 50]);

    $service = app(LessonService::class);
    $result = $service->completeMission($user, $lesson);

    expect($result)->toHaveKeys(['xp_earned', 'old_total_xp', 'new_total_xp', 'new_level', 'new_badges']);
    expect($result['xp_earned'])->toBe(50);
    expect($result['new_total_xp'])->toBe(50);
});

test('streak builds over consecutive days', function () {
    $service = new StreakService();

    $user = User::factory()->create([
        'current_streak' => 0,
        'longest_streak' => 0,
        'last_activity_at' => null,
    ]);

    // Day 1
    Carbon::setTestNow(Carbon::parse('2024-01-01 10:00:00'));
    $service->recordActivity($user);
    $user->refresh();
    expect($user->current_streak)->toBe(1);

    // Day 2
    Carbon::setTestNow(Carbon::parse('2024-01-02 10:00:00'));
    $service->recordActivity($user);
    $user->refresh();
    expect($user->current_streak)->toBe(2);

    // Day 3
    Carbon::setTestNow(Carbon::parse('2024-01-03 10:00:00'));
    $service->recordActivity($user);
    $user->refresh();
    expect($user->current_streak)->toBe(3);
    expect($user->longest_streak)->toBe(3);
});

test('streak resets after missing a day', function () {
    $service = new StreakService();

    Carbon::setTestNow(Carbon::parse('2024-01-05 10:00:00'));

    $user = User::factory()->create([
        'current_streak' => 5,
        'longest_streak' => 5,
        'last_activity_at' => Carbon::parse('2024-01-02 10:00:00'), // 3 days ago
    ]);

    $service->recordActivity($user);
    $user->refresh();

    expect($user->current_streak)->toBe(1); // Reset
    expect($user->longest_streak)->toBe(5); // Preserved
});

test('badge unlocking based on total_xp', function () {
    $badge = Badge::factory()->create(['condition_type' => 'total_xp', 'condition_value' => 100]);
    $user = User::factory()->create(['total_xp' => 0, 'current_xp' => 0]);
    $lesson = Lesson::factory()->create(['xp_reward' => 150]);

    $service = app(LessonService::class);
    $service->completeLesson($user, $lesson);

    expect($user->badges()->pluck('badges.id')->toArray())->toContain($badge->id);
});

test('badge unlocking based on completed_missions', function () {
    $badge = Badge::factory()->create(['condition_type' => 'completed_missions', 'condition_value' => 2]);
    $user = User::factory()->create();
    $lesson1 = Lesson::factory()->create();
    $lesson2 = Lesson::factory()->create();

    $service = app(LessonService::class);
    $service->completeLesson($user, $lesson1);
    $service->completeLesson($user, $lesson2);

    expect($user->badges()->pluck('badges.id')->toArray())->toContain($badge->id);
});

test('no duplicate badge awards', function () {
    $badge = Badge::factory()->create(['condition_type' => 'total_xp', 'condition_value' => 10]);
    $user = User::factory()->create(['total_xp' => 0, 'current_xp' => 0]);
    $lesson1 = Lesson::factory()->create(['xp_reward' => 50]);
    $lesson2 = Lesson::factory()->create(['xp_reward' => 50]);

    $service = app(LessonService::class);
    $service->completeLesson($user, $lesson1);
    $service->completeLesson($user, $lesson2);

    expect($user->badges()->count())->toBe(1);
});

test('double completion does not award double XP', function () {
    $user = User::factory()->create(['total_xp' => 0, 'current_xp' => 0]);
    $lesson = Lesson::factory()->create(['xp_reward' => 30]);

    $service = app(LessonService::class);
    $service->completeLesson($user, $lesson);
    $service->completeLesson($user, $lesson);

    $user->refresh();
    expect($user->total_xp)->toBe(30); // Not 60
});
