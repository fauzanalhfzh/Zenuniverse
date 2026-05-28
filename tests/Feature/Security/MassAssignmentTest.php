<?php

use App\Livewire\Auth\Register;
use App\Models\User;
use Livewire\Livewire;

test('cannot register as admin through role field', function () {
    Livewire::test(Register::class)
        ->set('name', 'Hacker')
        ->set('email', 'hack@evil.com')
        ->set('role', 'admin')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register');

    $user = User::where('email', 'hack@evil.com')->first();

    // User should always be 'student' regardless of input
    expect($user)->not->toBeNull();
    expect($user->role)->toBe('student');
});

test('cannot mass assign total_xp through registration', function () {
    Livewire::test(Register::class)
        ->set('name', 'XP Hacker')
        ->set('email', 'xphack@evil.com')
        ->set('role', 'student')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register');

    $user = User::where('email', 'xphack@evil.com')->first();

    expect($user->total_xp)->toBe(0);
    expect($user->hearts)->toBe(5);
});

test('cannot set teacher role through registration', function () {
    Livewire::test(Register::class)
        ->set('name', 'Teacher Fake')
        ->set('email', 'faketeacher@evil.com')
        ->set('role', 'teacher')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register');

    $user = User::where('email', 'faketeacher@evil.com')->first();

    expect($user->role)->toBe('student');
});
