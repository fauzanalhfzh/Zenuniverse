<?php

namespace Tests\Feature\Auth;

use App\Livewire\Auth\Register;
use App\Models\User;
use Livewire\Livewire;

test('registration screen can be rendered', function () {
    $response = $this->get('/register');

    $response->assertOk();
});

test('users can complete first step of registration', function () {
    Livewire::test(Register::class)
        ->set('name', 'Test User')
        ->set('email', 'TEST@EXAMPLE.COM') // Test uppercase
        ->set('role', 'student')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->assertSet('step', 2)
        ->assertSet('email', 'test@example.com') // Verify lowercase sync
        ->assertHasNoErrors();
});

test('new users can register', function () {
    Livewire::test(Register::class)
        ->set('name', 'Test User')
        ->set('email', 'test@example.com')
        ->set('role', 'student')
        ->set('age_group', '8-12')
        ->call('nextStep')
        ->set('password', 'password')
        ->set('password_confirmation', 'password')
        ->call('register')
        ->assertRedirect(route('dashboard', absolute: false));

    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', [
        'email' => 'test@example.com',
        'name' => 'Test User',
    ]);
});
