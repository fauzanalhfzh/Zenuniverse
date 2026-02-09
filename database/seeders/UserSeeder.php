<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Student One',
            'email' => 'student@test.com',
            'role' => 'student',
            'password' => bcrypt('password'),
        ]);
        
        User::factory()->create([
            'name' => 'Teacher One',
            'email' => 'teacher@test.com',
            'role' => 'teacher',
            'password' => bcrypt('password'),
        ]);
    }
}
