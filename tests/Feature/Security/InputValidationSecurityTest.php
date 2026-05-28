<?php

use App\Livewire\Auth\Register;
use Livewire\Livewire;

test('extremely long name is rejected', function () {
    $longName = str_repeat('A', 10000);

    Livewire::test(Register::class)
        ->set('name', $longName)
        ->set('email', 'test@example.com')
        ->set('role', 'student')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->assertHasErrors('name');
});

test('invalid email formats are rejected', function () {
    Livewire::test(Register::class)
        ->set('name', 'Test')
        ->set('email', 'not-an-email')
        ->set('role', 'student')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->assertHasErrors('email');
});

test('empty email is rejected', function () {
    Livewire::test(Register::class)
        ->set('name', 'Test')
        ->set('email', '')
        ->set('role', 'student')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->assertHasErrors('email');
});

test('duplicate email is rejected', function () {
    \App\Models\User::factory()->create(['email' => 'existing@test.com']);

    Livewire::test(Register::class)
        ->set('name', 'Test')
        ->set('email', 'existing@test.com')
        ->set('role', 'student')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->assertHasErrors('email');
});

test('email uniqueness is case-insensitive', function () {
    \App\Models\User::factory()->create(['email' => 'user@test.com']);

    Livewire::test(Register::class)
        ->set('name', 'Test')
        ->set('email', 'USER@TEST.COM')
        ->set('role', 'student')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->assertHasErrors('email');
});

test('password too short is rejected', function () {
    Livewire::test(Register::class)
        ->set('name', 'Test')
        ->set('email', 'unique@test.com')
        ->set('role', 'student')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->set('password', '123')
        ->set('password_confirmation', '123')
        ->call('register')
        ->assertHasErrors('password');
});

test('password confirmation mismatch is rejected', function () {
    Livewire::test(Register::class)
        ->set('name', 'Test')
        ->set('email', 'mismatch@test.com')
        ->set('role', 'student')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->set('password', 'password123')
        ->set('password_confirmation', 'different123')
        ->call('register')
        ->assertHasErrors('password');
});
