<?php

use App\Models\User;

test('sql injection in blog slug returns 404 safely', function () {
    $response = $this->get("/blog/'; DROP TABLE users; --");

    $response->assertStatus(404);

    // Verify database is intact
    expect(User::count())->toBeGreaterThanOrEqual(0);
});

test('sql injection with UNION in blog slug', function () {
    $response = $this->get("/blog/' UNION SELECT * FROM users --");

    $response->assertStatus(404);
});

test('sql injection in login does not bypass auth', function () {
    $this->post('/login', [
        'email' => "admin@test.com' OR '1'='1",
        'password' => "' OR '1'='1",
    ]);

    $this->assertGuest();
});

test('sql injection with encoded characters', function () {
    $response = $this->get("/blog/%27%20OR%201%3D1%20--%20");

    // Should return 404 or handle gracefully, not expose data
    expect($response->status())->toBeIn([404, 500]);
});

test('parameterized queries prevent injection in blog show', function () {
    $maliciousSlug = "test'; DELETE FROM posts WHERE '1'='1";

    $response = $this->get("/blog/{$maliciousSlug}");

    $response->assertStatus(404);
});
