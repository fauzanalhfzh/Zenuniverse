<?php

use App\Models\Course;
use App\Models\User;
use App\Policies\CoursePolicy;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->policy = new CoursePolicy();
    $this->course = Course::factory()->create();
});

test('admin can perform all course actions', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    expect($this->policy->viewAny($admin))->toBeTrue();
    expect($this->policy->view($admin, $this->course))->toBeTrue();
    expect($this->policy->create($admin))->toBeTrue();
    expect($this->policy->update($admin, $this->course))->toBeTrue();
    expect($this->policy->delete($admin, $this->course))->toBeTrue();
    expect($this->policy->restore($admin, $this->course))->toBeTrue();
    expect($this->policy->forceDelete($admin, $this->course))->toBeTrue();
});

test('teacher can perform all course actions', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);

    expect($this->policy->viewAny($teacher))->toBeTrue();
    expect($this->policy->view($teacher, $this->course))->toBeTrue();
    expect($this->policy->create($teacher))->toBeTrue();
    expect($this->policy->update($teacher, $this->course))->toBeTrue();
    expect($this->policy->delete($teacher, $this->course))->toBeTrue();
});

test('student cannot perform any course actions', function () {
    $student = User::factory()->create(['role' => 'student']);

    expect($this->policy->viewAny($student))->toBeFalse();
    expect($this->policy->view($student, $this->course))->toBeFalse();
    expect($this->policy->create($student))->toBeFalse();
    expect($this->policy->update($student, $this->course))->toBeFalse();
    expect($this->policy->delete($student, $this->course))->toBeFalse();
});

test('editor cannot perform any course actions', function () {
    $editor = User::factory()->create(['role' => 'editor']);

    expect($this->policy->viewAny($editor))->toBeFalse();
    expect($this->policy->view($editor, $this->course))->toBeFalse();
    expect($this->policy->create($editor))->toBeFalse();
});
