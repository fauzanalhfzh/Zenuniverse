<?php

use App\Models\Badge;
use App\Models\Level;
use App\Models\User;

test('authenticated user can view profile', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/profile')->assertOk();
});

test('unauthenticated user is redirected', function () {
    $this->get('/profile')->assertRedirect('/login');
});

test('profile shows correct XP and level data', function () {
    $level = Level::factory()->create(['name' => 'Menengah', 'order' => 2, 'xp_required' => 500]);
    $user = User::factory()->create([
        'current_level_id' => $level->id,
        'total_xp' => 750,
    ]);

    $this->actingAs($user)
        ->get('/profile')
        ->assertOk()
        ->assertSee('Menengah')
        ->assertSee('750');
});

test('profile shows badges', function () {
    $user = User::factory()->create();
    $badge = Badge::factory()->create(['name' => 'First Steps Badge']);

    $this->actingAs($user)
        ->get('/profile')
        ->assertOk()
        ->assertSee('First Steps Badge');
});
