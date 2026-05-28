<?php

use App\Models\Post;
use App\Models\User;
use App\Policies\PostPolicy;

uses(\Illuminate\Foundation\Testing\RefreshDatabase::class);

beforeEach(function () {
    $this->policy = new PostPolicy();
    $this->post = Post::factory()->create();
});

test('admin can manage posts', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    expect($this->policy->viewAny($admin))->toBeTrue();
    expect($this->policy->view($admin, $this->post))->toBeTrue();
    expect($this->policy->create($admin))->toBeTrue();
    expect($this->policy->update($admin, $this->post))->toBeTrue();
    expect($this->policy->delete($admin, $this->post))->toBeTrue();
});

test('editor can manage posts', function () {
    $editor = User::factory()->create(['role' => 'editor']);

    expect($this->policy->viewAny($editor))->toBeTrue();
    expect($this->policy->view($editor, $this->post))->toBeTrue();
    expect($this->policy->create($editor))->toBeTrue();
    expect($this->policy->update($editor, $this->post))->toBeTrue();
    expect($this->policy->delete($editor, $this->post))->toBeTrue();
});

test('student cannot manage posts', function () {
    $student = User::factory()->create(['role' => 'student']);

    expect($this->policy->viewAny($student))->toBeFalse();
    expect($this->policy->view($student, $this->post))->toBeFalse();
    expect($this->policy->create($student))->toBeFalse();
    expect($this->policy->update($student, $this->post))->toBeFalse();
    expect($this->policy->delete($student, $this->post))->toBeFalse();
});

test('teacher cannot manage posts', function () {
    $teacher = User::factory()->create(['role' => 'teacher']);

    expect($this->policy->viewAny($teacher))->toBeFalse();
    expect($this->policy->create($teacher))->toBeFalse();
});

test('restore always returns false', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    expect($this->policy->restore($admin, $this->post))->toBeFalse();
});

test('forceDelete always returns false', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    expect($this->policy->forceDelete($admin, $this->post))->toBeFalse();
});
