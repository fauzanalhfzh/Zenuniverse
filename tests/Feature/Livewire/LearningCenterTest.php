<?php

use App\Livewire\Hub\LearningCenter;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use Livewire\Livewire;

test('authenticated user can view learning center', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/learning-center')->assertOk();
});

test('unauthenticated user is redirected', function () {
    $this->get('/learning-center')->assertRedirect('/login');
});

test('unverified user is redirected', function () {
    $user = User::factory()->unverified()->create();

    $this->actingAs($user)->get('/learning-center')->assertRedirect('/verify-email');
});

test('courses with lessons are displayed', function () {
    $user = User::factory()->create();
    $course = Course::factory()->create(['title' => 'Test Course']);
    $lesson = Lesson::factory()->create(['course_id' => $course->id, 'title' => 'First Lesson']);

    Livewire::actingAs($user)
        ->test(LearningCenter::class)
        ->assertSee('Test Course');
});
