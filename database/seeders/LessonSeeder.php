<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        // Get Course "Dasar Pemrograman Web"
        $course = Course::where('title', 'Dasar Pemrograman Web')->first();

        if ($course) {
            // Lesson 1
            $lesson1 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'Apa itu HTML?',
                'content' => 'HTML (HyperText Markup Language) adalah bahasa standar untuk membuat halaman web. HTML menyusun struktur konten pada website.',
                'video_url' => 'https://www.youtube.com/embed/H1Q_x3z6-aA', // Dummy video
                'order' => 1,
                'xp_reward' => 20,
            ]);

            // Quiz for Lesson 1
            $lesson1->questions()->create([
                'question' => 'Apa kepanjangan dari HTML?',
                'options' => [
                    'A' => 'HyperTech Markup Language',
                    'B' => 'HyperText Markup Language',
                    'C' => 'HighText Machine Learning',
                    'D' => 'HyperTool Multi Language'
                ],
                'correct_answer' => 'B',
                'order' => 1
            ]);

            // Lesson 2
            $lesson2 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'Struktur Halaman HTML',
                'content' => 'Setiap halaman HTML memiliki struktur dasar yang terdiri dari tag html, head, dan body.',
                'video_url' => null,
                'order' => 2,
                'xp_reward' => 30,
            ]);

            $lesson2->questions()->create([
                'question' => 'Tag mana yang berisi konten utama yang terlihat di browser?',
                'options' => [
                    'A' => '<head>',
                    'B' => '<title>',
                    'C' => '<body>',
                    'D' => '<footer>'
                ],
                'correct_answer' => 'C',
                'order' => 1
            ]);
        }
    }
}
