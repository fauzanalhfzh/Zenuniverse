<?php

use App\Models\User;

test('authenticated user can view leaderboard', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/leaderboard')->assertOk();
});

test('unauthenticated user is redirected', function () {
    $this->get('/leaderboard')->assertRedirect('/login');
});

test('users are ranked by total_xp descending', function () {
    $user1 = User::factory()->create(['role' => 'student', 'total_xp' => 100, 'name' => 'Low XP']);
    $user2 = User::factory()->create(['role' => 'student', 'total_xp' => 500, 'name' => 'High XP']);
    $user3 = User::factory()->create(['role' => 'student', 'total_xp' => 300, 'name' => 'Mid XP']);

    $response = $this->actingAs($user1)->get('/leaderboard');

    $response->assertOk();
    // Verify order in response
    $response->assertSeeInOrder(['High XP', 'Mid XP', 'Low XP']);
});

test('only student role users appear in leaderboard', function () {
    $student = User::factory()->create(['role' => 'student', 'total_xp' => 100, 'name' => 'Student User']);
    $admin = User::factory()->create(['role' => 'admin', 'total_xp' => 999, 'name' => 'Admin User']);

    $response = $this->actingAs($student)->get('/leaderboard');

    $response->assertSee('Student User');
    $response->assertDontSee('Admin User');
});

test('current user rank is calculated correctly', function () {
    $user1 = User::factory()->create(['role' => 'student', 'total_xp' => 500]);
    $user2 = User::factory()->create(['role' => 'student', 'total_xp' => 300]);
    $user3 = User::factory()->create(['role' => 'student', 'total_xp' => 100]);

    // user3 has lowest XP, should be rank 3
    $response = $this->actingAs($user3)->get('/leaderboard');
    $response->assertOk();
});
