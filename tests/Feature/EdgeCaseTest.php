<?php

use App\Livewire\LessonPlayer;
use App\Livewire\Missions\MissionPlayer;
use App\Livewire\StudentDashboard;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\MissionSlide;
use App\Models\User;
use App\Models\UserProgress;
use App\Services\LessonService;
use Livewire\Livewire;

test('user with 0 hearts is redirected from mission', function () {
    $user = User::factory()->create(['hearts' => 0]);
    $lesson = Lesson::factory()->create(['slug' => 'no-hearts-mission']);
    MissionSlide::factory()->create(['lesson_id' => $lesson->id, 'type' => 'intro']);

    Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'no-hearts-mission'])
        ->assertRedirect(route('dashboard'));
});

test('lesson with no questions auto-completes on startQuiz', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create();
    // No questions

    Livewire::actingAs($user)
        ->test(LessonPlayer::class, ['lesson' => $lesson])
        ->call('startQuiz');

    expect(UserProgress::where('user_id', $user->id)->where('lesson_id', $lesson->id)->exists())->toBeTrue();
});

test('empty course doesnt crash dashboard', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create();
    // No lessons in this course
    $user->update(['active_course_id' => $course->id]);

    Livewire::actingAs($user)
        ->test(StudentDashboard::class)
        ->assertOk();
});

test('user without active course sees first course', function () {
    $user = User::factory()->create(['active_course_id' => null]);
    $course = Course::factory()->create(['order' => 1]);

    Livewire::actingAs($user)
        ->test(StudentDashboard::class)
        ->assertSet('selectedCourseId', $course->id);
});

test('double completion of same lesson does not award double XP', function () {
    $user = User::factory()->create(['total_xp' => 0, 'current_xp' => 0]);
    $lesson = Lesson::factory()->create(['xp_reward' => 30]);

    $service = app(LessonService::class);

    $result1 = $service->completeLesson($user, $lesson);
    $result2 = $service->completeLesson($user, $lesson);

    $user->refresh();

    expect($result1)->toBeTrue();
    expect($result2)->toBeFalse();
    expect($user->total_xp)->toBe(30); // Not 60
});

test('mission with no slides redirects to dashboard', function () {
    $user = User::factory()->create();
    $lesson = Lesson::factory()->create(['slug' => 'empty-slides-mission']);

    Livewire::actingAs($user)
        ->test(MissionPlayer::class, ['slug' => 'empty-slides-mission'])
        ->assertRedirect(route('dashboard'));
});
