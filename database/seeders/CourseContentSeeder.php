<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Level;

class CourseContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ensure Level 1 exists
        $level = Level::firstOrCreate(
            ['order' => 1],
            ['name' => 'Pemula', 'xp_required' => 0]
        );

        // --- 1. Coding for Kids ---
        $codingCourse = Course::create([
            'level_id' => $level->id,
            'title' => 'Coding for Kids',
            'description' => 'Belajar dasar pemrograman dengan cara yang menyenangkan!',
            'icon' => 'code',
            'order' => 1,
            'xp_reward' => 500,
        ]);

        $codingLessons = [
            ['title' => 'Apa itu Algoritma?', 'icon' => 'account_tree', 'slug' => 'kids-coding-algorithms'],
            ['title' => 'Mengenal Variable', 'icon' => 'data_object', 'slug' => 'kids-coding-variables'],
            ['title' => 'Looping & Perulangan', 'icon' => 'cached', 'slug' => 'kids-coding-loops'],
        ];

        foreach ($codingLessons as $index => $lesson) {
            Lesson::create([
                'course_id' => $codingCourse->id,
                'title' => $lesson['title'],
                'slug' => $lesson['slug'],
                'icon' => $lesson['icon'],
                'content' => 'Konten belajar ' . $lesson['title'],
                'order' => $index + 1,
                'xp_reward' => 50,
            ]);
        }

        // --- 2. Math Basics ---
        $mathCourse = Course::create([
            'level_id' => $level->id,
            'title' => 'Math Basics',
            'description' => 'Dasar matematika yang seru!',
            'icon' => 'function',
            'order' => 2,
            'xp_reward' => 500,
        ]);

        $mathLessons = [
            ['title' => 'Berhitung 1-10', 'icon' => 'looks_one', 'slug' => 'math-counting-1-10', 'mission_slug' => 'mission.math.counting-adventure'], // Link to real mission
            ['title' => 'Penjumlahan Dasar', 'icon' => 'add', 'slug' => 'math-addition-basics'],
            ['title' => 'Pengurangan Dasar', 'icon' => 'remove', 'slug' => 'math-subtraction-basics'],
        ];

        foreach ($mathLessons as $index => $lesson) {
            Lesson::create([
                'course_id' => $mathCourse->id,
                'title' => $lesson['title'],
                'slug' => $lesson['slug'],
                'icon' => $lesson['icon'],
                'content' => 'Konten belajar ' . $lesson['title'],
                'order' => $index + 1,
                'xp_reward' => 50,
            ]);
        }
        
        $this->command->info('Courses "Coding for Kids" and "Math Basics" seeded successfully!');
    }
}
