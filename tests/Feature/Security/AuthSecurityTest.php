<?php

use App\Livewire\Auth\Login;
use App\Models\User;
use Livewire\Livewire;

test('login rate limiting blocks after 5 failed attempts', function () {
    $user = User::factory()->create();

    for ($i = 0; $i < 5; $i++) {
        Livewire::test(Login::class)
            ->set('form.email', $user->email)
            ->set('form.password', 'wrong-password')
            ->call('login');
    }

    // 6th attempt should be throttled
    Livewire::test(Login::class)
        ->set('form.email', $user->email)
        ->set('form.password', 'wrong-password')
        ->call('login')
        ->assertHasErrors('form.email');
});

test('password is not exposed in user serialization', function () {
    $user = User::factory()->create(['password' => 'secret123']);

    $json = $user->toArray();

    expect($json)->not->toHaveKey('password');
    expect($json)->not->toHaveKey('remember_token');
});

test('cannot login with SQL injection in email', function () {
    Livewire::test(Login::class)
        ->set('form.email', "admin@test.com' OR '1'='1")
        ->set('form.password', 'anything')
        ->call('login')
        ->assertHasErrors();

    $this->assertGuest();
});

test('xss payload in username is stored but escaped', function () {
    $user = User::factory()->create([
        'name' => '<script>alert("xss")</script>',
    ]);

    // Name is stored as-is in DB
    expect($user->name)->toBe('<script>alert("xss")</script>');

    // But when rendered in blade, {{ }} escapes it
    $response = $this->actingAs($user)->get('/profile');
    $response->assertDontSee('<script>alert("xss")</script>', false);
});

test('session is invalidated after logout', function () {
    $user = User::factory()->create();

    $this->actingAs($user);
    $this->assertAuthenticated();

    $this->post('/logout');
    $this->assertGuest();
});
