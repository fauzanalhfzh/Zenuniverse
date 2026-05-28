<?php

use App\Livewire\StudentDashboard;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Level;
use App\Models\User;
use App\Models\UserProgress;
use Livewire\Livewire;

test('authenticated verified user can view dashboard', function () {
    $user = User::factory()->create();
    Course::factory()->create();

    $this->actingAs($user)->get('/dashboard')->assertOk();
});

test('unauthenticated user is redirected to login', function () {
    $this->get('/dashboard')->assertRedirect('/login');
});

test('unverified user is redirected', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)->get('/dashboard')->assertRedirect('/verify-email');
});

test('dashboard shows user stats', function () {
    $level = Level::factory()->create(['name' => 'Pemula']);
    $user = User::factory()->create([
        'current_level_id' => $level->id,
        'total_xp' => 250,
        'current_streak' => 3,
        'hearts' => 4,
    ]);
    Course::factory()->create();

    $this->actingAs($user)
        ->get('/dashboard')
        ->assertOk()
        ->assertSee('250')
        ->assertSee('Pemula');
});

test('selectCourse updates selectedCourseId', function () {
    $user = User::factory()->create();
    $course1 = Course::factory()->create(['order' => 1]);
    $course2 = Course::factory()->create(['order' => 2]);

    Livewire::actingAs($user)
        ->test(StudentDashboard::class)
        ->call('selectCourse', $course2->id)
        ->assertSet('selectedCourseId', $course2->id);
});

test('completed lessons are tracked correctly', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create();
    $lesson1 = Lesson::factory()->create(['course_id' => $course->id, 'order' => 1]);
    $lesson2 = Lesson::factory()->create(['course_id' => $course->id, 'order' => 2]);

    UserProgress::factory()->create([
        'user_id' => $user->id,
        'lesson_id' => $lesson1->id,
        'status' => 'completed',
    ]);

    $user->update(['active_course_id' => $course->id]);

    Livewire::actingAs($user)
        ->test(StudentDashboard::class)
        ->assertSee($lesson1->title)
        ->assertSee($lesson2->title);
});

test('mount selects first course when no active course', function () {
    $user = User::factory()->create(['active_course_id' => null]);
    $course = Course::factory()->create(['order' => 1]);

    Livewire::actingAs($user)
        ->test(StudentDashboard::class)
        ->assertSet('selectedCourseId', $course->id);
});
