<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Level 1: Pemula (ID 1)
        Course::create([
            'level_id' => 1,
            'title' => 'Dasar Pemrograman Web',
            'description' => 'Belajar membuat website sederhana dengan HTML dan CSS.',
            'icon' => '🌐',
            'order' => 1,
            'xp_reward' => 100,
        ]);

        Course::create([
            'level_id' => 1,
            'title' => 'Logika Pemrograman Dasar',
            'description' => 'Melatih pola pikir komputasional untuk memecahkan masalah.',
            'icon' => '🧠',
            'order' => 2,
            'xp_reward' => 100,
        ]);
    }
}
