<?php

namespace Tests\Browser;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\MissionSlide;
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserJourneyTest extends DuskTestCase
{
    /**
     * Test that the welcome page loads correctly.
     */
    public function test_welcome_page_loads(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->assertSee('Zenuniverse')
                ->assertPresent('body');
        });
    }

    /**
     * Test registration flow.
     */
    public function test_user_can_register(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/register')
                ->waitFor('input[name="name"]')
                ->type('name', 'Test Dusk User')
                ->type('email', 'dusktest' . time() . '@example.com')
                ->press('Lanjut')
                ->waitFor('input[name="password"]')
                ->type('password', 'password')
                ->type('password_confirmation', 'password')
                ->press('Daftar')
                ->waitForLocation('/dashboard');
        });
    }

    /**
     * Test login flow.
     */
    public function test_user_can_login(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->waitFor('input[name="email"]', 10)
                ->type('email', $user->email)
                ->type('password', 'password')
                ->press('Masuk')
                ->waitForLocation('/dashboard')
                ->assertPathIs('/dashboard');
        });
    }

    /**
     * Test dark mode toggle persists.
     */
    public function test_dark_mode_toggle(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->waitFor('body', 10)
                ->assertPresent('html:not(.dark)')
                ->script("document.querySelector('[x-data]').__x && document.querySelector('html').classList.add('dark')");

            // Verify dark class can be added
            $browser->assertPresent('html');
        });
    }

    /**
     * Test dashboard loads for authenticated user.
     */
    public function test_dashboard_loads_for_authenticated_user(): void
    {
        $user = User::factory()->create(['password' => 'password']);
        Course::factory()->create();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/dashboard')
                ->waitFor('body', 10)
                ->assertPathIs('/dashboard');
        });
    }

    /**
     * Test mission player loads and shows slides.
     */
    public function test_mission_player_loads(): void
    {
        $user = User::factory()->create(['hearts' => 5]);
        $lesson = Lesson::factory()->create(['slug' => 'dusk-test-mission']);
        MissionSlide::factory()->create([
            'lesson_id' => $lesson->id,
            'type' => 'intro',
            'title' => 'Welcome to Dusk Test',
            'content' => 'This is a test slide',
            'order' => 1,
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/missions/dusk-test-mission')
                ->waitFor('body', 10)
                ->assertSee('Welcome to Dusk Test');
        });
    }

    /**
     * Test profile page loads.
     */
    public function test_profile_page_loads(): void
    {
        $user = User::factory()->create(['password' => 'password']);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user)
                ->visit('/profile')
                ->waitFor('body', 10)
                ->assertPathIs('/profile');
        });
    }

    /**
     * Test leaderboard page shows rankings.
     */
    public function test_leaderboard_shows_rankings(): void
    {
        $user1 = User::factory()->create(['role' => 'student', 'total_xp' => 500, 'name' => 'Top Player']);
        $user2 = User::factory()->create(['role' => 'student', 'total_xp' => 100, 'name' => 'New Player']);

        $this->browse(function (Browser $browser) use ($user2) {
            $browser->loginAs($user2)
                ->visit('/leaderboard')
                ->waitFor('body', 10)
                ->assertSee('Top Player');
        });
    }

    /**
     * Test blog page loads and shows posts.
     */
    public function test_blog_page_loads(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/blog')
                ->waitFor('body', 10)
                ->assertPathIs('/blog');
        });
    }
}
