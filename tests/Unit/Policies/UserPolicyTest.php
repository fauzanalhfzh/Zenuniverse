<?php

use App\Models\User;
use App\Policies\UserPolicy;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->policy = new UserPolicy();
});

test('admin can perform all user management actions', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $target = User::factory()->create();

    expect($this->policy->viewAny($admin))->toBeTrue();
    expect($this->policy->view($admin, $target))->toBeTrue();
    expect($this->policy->create($admin))->toBeTrue();
    expect($this->policy->update($admin, $target))->toBeTrue();
    expect($this->policy->delete($admin, $target))->toBeTrue();
    expect($this->policy->restore($admin, $target))->toBeTrue();
    expect($this->policy->forceDelete($admin, $target))->toBeTrue();
});

test('teacher cannot manage users', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);
    $target = User::factory()->create();

    expect($this->policy->viewAny($teacher))->toBeFalse();
    expect($this->policy->view($teacher, $target))->toBeFalse();
    expect($this->policy->create($teacher))->toBeFalse();
    expect($this->policy->update($teacher, $target))->toBeFalse();
    expect($this->policy->delete($teacher, $target))->toBeFalse();
});

test('editor cannot manage users', function () {
    $editor = User::factory()->create(['role' => 'editor']);
    $target = User::factory()->create();

    expect($this->policy->viewAny($editor))->toBeFalse();
    expect($this->policy->create($editor))->toBeFalse();
});

test('student cannot manage users', function () {
    $student = User::factory()->create(['role' => 'student']);
    $target = User::factory()->create();

    expect($this->policy->viewAny($student))->toBeFalse();
    expect($this->policy->view($student, $target))->toBeFalse();
    expect($this->policy->create($student))->toBeFalse();
});
