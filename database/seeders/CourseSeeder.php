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

        Course::create([
            'level_id' => 1,
            'title' => 'Matematika Dasar',
            'description' => 'Petualangan angka! Belajar berhitung, tambah, dan kurang dengan cara yang seru.',
            'type' => 'student',
            'icon' => 'calculate',
            'order' => 3,
            'xp_reward' => 100,
        ]);

        Course::create([
            'level_id' => 1,
            'title' => 'Python Development',
            'description' => 'Belajar dasar pemrograman Python dari nol hingga mahir membuat program sederhana.',
            'icon' => '🐍',
            'order' => 4,
            'xp_reward' => 150,
        ]);

        // Level 2: Menengah (ID 2)
        Course::create([
            'level_id' => 2,
            'title' => 'JavaScript Development',
            'description' => 'Belajar membuat website menjadi interaktif dan dinamis dengan JavaScript.',
            'icon' => '⚡',
            'order' => 5,
            'xp_reward' => 200,
        ]);

        Course::create([
            'level_id' => 2,
            'title' => 'Database & SQL',
            'description' => 'Mengenal database relasional dan cara mengelola data dengan bahasa SQL.',
            'icon' => '💾',
            'order' => 6,
            'xp_reward' => 200,
        ]);

        Course::create([
            'level_id' => 2,
            'title' => 'Bahasa Inggris untuk Programmer',
            'description' => 'Kuasai kosakata dan istilah bahasa Inggris penting dalam dunia software engineering.',
            'icon' => '🇬🇧',
            'order' => 7,
            'xp_reward' => 150,
        ]);

        // Level 3: Mahir (ID 3)
        Course::create([
            'level_id' => 3,
            'title' => 'Struktur Data & Algoritma',
            'description' => 'Fondasi Computer Science untuk menulis kode yang lebih cepat dan efisien.',
            'icon' => '🏗️',
            'order' => 8,
            'xp_reward' => 300,
        ]);
    }
}
