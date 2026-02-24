<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Level;
use Illuminate\Database\Seeder;

class TeacherCourseSeeder extends Seeder
{
    public function run(): void
    {
        $level = Level::where('order', 1)->first() ?? Level::create([
            'name' => 'Pemula',
            'order' => 1,
            'xp_required' => 0,
            'icon' => '🌱',
            'color' => 'success',
        ]);

        $courses = [
            [
                'title' => 'Panduan Mengajar Teknologi',
                'type' => 'teacher',
                'description' => 'Pelajari cara efektif menyampaikan materi pemrograman kepada siswa.',
                'icon' => 'cast_for_education',
                'order' => 1,
                'lessons' => [
                    ['title' => 'Pengantar Mengajar Teknologi', 'icon' => 'school', 'xp_reward' => 50],
                    ['title' => 'Mengenal Gaya Belajar Siswa', 'icon' => 'psychology', 'xp_reward' => 50],
                    ['title' => 'Menyusun Rencana Pembelajaran', 'icon' => 'edit_note', 'xp_reward' => 75],
                    ['title' => 'Teknik Demonstrasi Interaktif', 'icon' => 'present_to_all', 'xp_reward' => 75],
                    ['title' => 'Menggunakan Media Digital', 'icon' => 'devices', 'xp_reward' => 75],
                    ['title' => 'Membuat Materi dengan AI', 'icon' => 'auto_awesome', 'xp_reward' => 100],
                    ['title' => 'Evaluasi & Asesmen Formatif', 'icon' => 'quiz', 'xp_reward' => 75],
                    ['title' => 'Gamifikasi dalam Pembelajaran', 'icon' => 'sports_esports', 'xp_reward' => 100],
                    ['title' => 'Menangani Siswa Beragam', 'icon' => 'diversity_3', 'xp_reward' => 75],
                    ['title' => 'Proyek Akhir: Rencana Mengajar', 'icon' => 'task_alt', 'xp_reward' => 150],
                ],
            ],
            [
                'title' => 'Manajemen Kelas Digital',
                'type' => 'teacher',
                'description' => 'Strategi mengelola kelas interaktif dan menyenangkan.',
                'icon' => 'groups',
                'order' => 2,
                'lessons' => [
                    ['title' => 'Setup Ruang Kelas Digital', 'icon' => 'meeting_room', 'xp_reward' => 50],
                    ['title' => 'Alat Kolaborasi Online', 'icon' => 'handshake', 'xp_reward' => 50],
                    ['title' => 'Platform Belajar Gratis', 'icon' => 'public', 'xp_reward' => 75],
                    ['title' => 'Membuat Kuis Interaktif', 'icon' => 'quiz', 'xp_reward' => 75],
                    ['title' => 'Manajemen Waktu Mengajar', 'icon' => 'schedule', 'xp_reward' => 75],
                    ['title' => 'Komunikasi dengan Orang Tua', 'icon' => 'forum', 'xp_reward' => 75],
                    ['title' => 'Keamanan Digital di Kelas', 'icon' => 'security', 'xp_reward' => 100],
                    ['title' => 'Mengajar dengan Bandwidth Rendah', 'icon' => 'signal_cellular_alt', 'xp_reward' => 100],
                    ['title' => 'Analisis Progres Siswa', 'icon' => 'monitoring', 'xp_reward' => 75],
                    ['title' => 'Proyek Akhir: Simulasi Kelas', 'icon' => 'task_alt', 'xp_reward' => 150],
                ],
            ],
        ];

        foreach ($courses as $courseData) {
            $lessonsData = $courseData['lessons'];
            unset($courseData['lessons']);

            $courseData['level_id'] = $level->id;

            $course = Course::firstOrCreate(
                ['title' => $courseData['title']],
                $courseData
            );

            // Perbarui type jika sudah ada tetapi typenya null/student
            if ($course->type !== 'teacher') {
                $course->update(['type' => 'teacher']);
            }

            foreach ($lessonsData as $index => $lessonData) {
                $lessonData['order'] = $index + 1;
                $lessonData['slug'] = \Illuminate\Support\Str::slug($lessonData['title']);
                
                $lesson = $course->lessons()->updateOrCreate(
                    ['title' => $lessonData['title']],
                    $lessonData
                );

                // Generate 5 Trivia (Text) and 5 Quizzes (Quiz) per lesson
                for ($i = 1; $i <= 5; $i++) {
                    // Text Slide (Trivia)
                    $lesson->slides()->updateOrCreate(
                        ['order' => ($i * 2) - 1], // Orders: 1, 3, 5, 7, 9
                        [
                            'type' => 'text',
                            'title' => "Konsep {$i}: " . $lesson->title,
                            'content' => "Tahap {$i} dalam memahami {$lesson->title}. Dalam konteks {$course->title}, bagian ini sangat penting untuk dikuasai oleh pengajar agar penyampaian materi menjadi lebih efektif dan menarik bagi siswa.",
                        ]
                    );

                    // Quiz Slide
                    $lesson->slides()->updateOrCreate(
                        ['order' => $i * 2], // Orders: 2, 4, 6, 8, 10
                        [
                            'type' => 'quiz',
                            'title' => "Kuis {$i}: " . $lesson->title,
                            'content' => "Berdasarkan materi Konsep {$i} yang baru saja dipelajari, manakah langkah terbaik untuk menerapkan {$lesson->title} di dalam kelas?",
                            'options' => [
                                ['id' => 'A', 'text' => 'Mengabaikan teori andragogi', 'correct' => false],
                                ['id' => 'B', 'text' => 'Menerapkan metode interaktif', 'correct' => true],
                                ['id' => 'C', 'text' => 'Hanya memberikan ceramah satu arah', 'correct' => false],
                            ],
                        ]
                    );
                }
            }
        }
    }
}
