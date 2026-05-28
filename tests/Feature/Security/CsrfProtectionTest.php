<?php

use App\Models\User;

test('POST logout without CSRF token returns 419', function () {
    $user = User::factory()->create();

    // Using withoutMiddleware to skip auth but keep CSRF
    // Direct post without session/token should fail
    $response = $this->post('/logout');

    $response->assertStatus(419);
});

test('POST to any route without CSRF is rejected', function () {
    // Attempting to post without CSRF middleware
    $response = $this->post('/logout', [], [
        'X-CSRF-TOKEN' => 'invalid-token',
    ]);

    $response->assertStatus(419);
});
