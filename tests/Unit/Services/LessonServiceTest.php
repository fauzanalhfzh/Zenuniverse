<?php

use App\Models\Badge;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\User;
use App\Models\UserProgress;
use App\Services\LessonService;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->service = app(LessonService::class);
});

test('completeLesson creates UserProgress record', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create(['xp_reward' => 20]);

    $result = $this->service->completeLesson($user, $lesson);

    expect($result)->toBeTrue();
    expect(UserProgress::where('user_id', $user->id)->where('lesson_id', $lesson->id)->exists())->toBeTrue();
});

test('completeLesson increments current_xp and total_xp', function () {
    $user = User::factory()->create(['current_xp' => 0, 'total_xp' => 0]);
    $lesson = Lesson::factory()->create(['xp_reward' => 25]);

    $this->service->completeLesson($user, $lesson);
    $user->refresh();

    expect($user->current_xp)->toBe(25);
    expect($user->total_xp)->toBe(25);
});

test('completeLesson returns true for new completion', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();

    $result = $this->service->completeLesson($user, $lesson);

    expect($result)->toBeTrue();
});

test('completeLesson returns false if already completed (idempotent)', function () {
    $user = User::factory()->create(['current_xp' => 0, 'total_xp' => 0]);
    $lesson = Lesson::factory()->create(['xp_reward' => 20]);

    $this->service->completeLesson($user, $lesson);
    $initialXp = $user->refresh()->total_xp;

    $result = $this->service->completeLesson($user, $lesson);
    $user->refresh();

    expect($result)->toBeFalse();
    expect($user->total_xp)->toBe($initialXp); // No duplicate XP
});

test('completeMission uses updateOrCreate', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create(['slug' => 'test-mission', 'xp_reward' => 50]);

    $this->service->completeMission($user, $lesson);
    $this->service->completeMission($user, $lesson);

    expect(UserProgress::where('user_id', $user->id)->where('lesson_id', $lesson->id)->count())->toBe(1);
});

test('completeMission accepts xpOverride', function () {
    $user = User::factory()->create(['total_xp' => 0, 'current_xp' => 0]);
    $lesson = Lesson::factory()->create(['xp_reward' => 10]);

    $result = $this->service->completeMission($user, $lesson, 99);

    expect($result['xp_earned'])->toBe(99);
    expect($result['new_total_xp'])->toBe(99);
});

test('completeMission returns gamification data with correct keys', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();

    $result = $this->service->completeMission($user, $lesson);

    expect($result)->toHaveKeys([
        'xp_earned',
        'old_total_xp',
        'new_total_xp',
        'old_current_xp',
        'new_current_xp',
        'new_level',
        'new_badges',
    ]);
});

test('checkLevelUp promotes user when XP threshold met', function () {
    $level1 = Level::factory()->create(['name' => 'Pemula', 'order' => 1, 'xp_required' => 0]);
    $level2 = Level::factory()->create(['name' => 'Menengah', 'order' => 2, 'xp_required' => 100]);

    $user = User::factory()->create([
        'current_level_id' => $level1->id,
        'total_xp' => 0,
        'current_xp' => 0,
    ]);

    $lesson = Lesson::factory()->create(['xp_reward' => 150]);

    $this->service->completeLesson($user, $lesson);
    $user->refresh();

    expect($user->current_level_id)->toBe($level2->id);
});

test('checkLevelUp does NOT promote when insufficient XP', function () {
    $level1 = Level::factory()->create(['name' => 'Pemula', 'order' => 1, 'xp_required' => 0]);
    $level2 = Level::factory()->create(['name' => 'Menengah', 'order' => 2, 'xp_required' => 500]);

    $user = User::factory()->create([
        'current_level_id' => $level1->id,
        'total_xp' => 0,
        'current_xp' => 0,
    ]);

    $lesson = Lesson::factory()->create(['xp_reward' => 10]);

    $this->service->completeLesson($user, $lesson);
    $user->refresh();

    expect($user->current_level_id)->toBe($level1->id);
});

test('checkBadges awards badge for total_xp condition', function () {
    $badge = Badge::factory()->create([
        'condition_type' => 'total_xp',
        'condition_value' => 50,
    ]);

    $user = User::factory()->create(['total_xp' => 0, 'current_xp' => 0]);
    $lesson = Lesson::factory()->create(['xp_reward' => 60]);

    $this->service->completeLesson($user, $lesson);

    expect($user->badges()->pluck('badges.id')->toArray())->toContain($badge->id);
});

test('checkBadges awards badge for completed_missions condition', function () {
    $badge = Badge::factory()->create([
        'condition_type' => 'completed_missions',
        'condition_value' => 1,
    ]);

    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();

    $this->service->completeLesson($user, $lesson);

    expect($user->badges()->pluck('badges.id')->toArray())->toContain($badge->id);
});

test('checkBadges awards badge for streak_days condition', function () {
    $badge = Badge::factory()->create([
        'condition_type' => 'streak_days',
        'condition_value' => 1,
    ]);

    $user = User::factory()->create(['current_streak' => 0]);
    $lesson = Lesson::factory()->create();

    // completeLesson calls streakService->recordActivity which sets streak to 1
    $this->service->completeLesson($user, $lesson);
    $user->refresh();

    expect($user->badges()->pluck('badges.id')->toArray())->toContain($badge->id);
});

test('checkBadges does NOT award duplicate badges', function () {
    $badge = Badge::factory()->create([
        'condition_type' => 'total_xp',
        'condition_value' => 10,
    ]);

    $user = User::factory()->create(['total_xp' => 0, 'current_xp' => 0]);
    $lesson1 = Lesson::factory()->create(['xp_reward' => 20]);
    $lesson2 = Lesson::factory()->create(['xp_reward' => 20]);

    $this->service->completeLesson($user, $lesson1);
    $this->service->completeLesson($user, $lesson2);

    expect($user->badges()->count())->toBe(1);
});
