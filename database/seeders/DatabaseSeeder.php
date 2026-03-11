<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@zenuniverse.id',
            'password' => bcrypt('password'), // password default
            'role' => 'admin',
            'current_level_id' => 3, // Level Mahir
            'total_xp' => 2000,
        ]);

        $this->call([
            LevelSeeder::class,
            BadgeSeeder::class,
            CourseSeeder::class,
            LessonSeeder::class,
            PostSeeder::class,
        ]);
    }
}
