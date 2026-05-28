<?php

use App\Models\User;

test('welcome page loads for guests', function () {
    $this->get('/')->assertOk();
});

test('welcome page loads for authenticated users', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/')->assertOk();
});
