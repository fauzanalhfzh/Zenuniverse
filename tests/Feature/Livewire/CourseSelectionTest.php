<?php

use App\Livewire\CourseSelection;
use App\Models\Course;
use App\Models\User;
use Livewire\Livewire;

test('courses are listed', function () {
    $user = User::factory()->create();
    $course1 = Course::factory()->create(['title' => 'Python Basics', 'order' => 1]);
    $course2 = Course::factory()->create(['title' => 'JavaScript Intro', 'order' => 2]);

    Livewire::actingAs($user)
        ->test(CourseSelection::class)
        ->assertSee('Python Basics')
        ->assertSee('JavaScript Intro');
});

test('selectCourse updates user active_course_id', function () {
    $user = User::factory()->create(['active_course_id' => null]);
    $course = Course::factory()->create();

    Livewire::actingAs($user)
        ->test(CourseSelection::class)
        ->call('selectCourse', $course->id)
        ->assertRedirect(route('dashboard'));

    $user->refresh();
    expect($user->active_course_id)->toBe($course->id);
});

test('selectCourse redirects to dashboard', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create();

    Livewire::actingAs($user)
        ->test(CourseSelection::class)
        ->call('selectCourse', $course->id)
        ->assertRedirect(route('dashboard'));
});
