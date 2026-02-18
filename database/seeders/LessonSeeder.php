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
                'slug' => 'apa-itu-html',
                'content' => 'HTML (HyperText Markup Language) adalah bahasa standar untuk membuat halaman web. HTML menyusun struktur konten pada website.',
                'video_url' => 'https://www.youtube.com/embed/H1Q_x3z6-aA', // Dummy video
                'order' => 1,
                'xp_reward' => 20,
            ]);

            // Slide for Lesson 1
            $lesson1->slides()->create([
                'type' => 'text',
                'title' => 'Apa itu HTML?',
                'content' => 'HTML adalah bahasa markup standar untuk membuat halaman Web. HTML menggambarkan struktur halaman Web menggunakan markup.',
                'order' => 1,
            ]);

            // Quiz for Lesson 1
            $lesson1->slides()->create([
                'type' => 'quiz',
                'title' => 'Kuis Singkat',
                'content' => 'Apa kepanjangan dari HTML?',
                'options' => [
                    ['id' => 'A', 'text' => 'HyperTech Markup Language', 'correct' => false],
                    ['id' => 'B', 'text' => 'HyperText Markup Language', 'correct' => true],
                    ['id' => 'C', 'text' => 'HighText Machine Learning', 'correct' => false],
                    ['id' => 'D', 'text' => 'HyperTool Multi Language', 'correct' => false],
                ],
                'order' => 2,
            ]);

            // Lesson 2
            $lesson2 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'Struktur Halaman HTML',
                'slug' => 'struktur-halaman-html',
                'content' => 'Setiap halaman HTML memiliki struktur dasar yang terdiri dari tag html, head, dan body.',
                'video_url' => null,
                'order' => 2,
                'xp_reward' => 30,
            ]);

            $lesson2->slides()->create([
                'type' => 'text',
                'title' => 'Struktur Dasar',
                'content' => 'Setiap halaman HTML memiliki struktur dasar: <html>, <head>, dan <body>.',
                'order' => 1,
            ]);

            $lesson2->slides()->create([
                'type' => 'quiz',
                'title' => 'Kuis Struktur',
                'content' => 'Tag mana yang berisi konten utama?',
                'options' => [
                    ['id' => 'A', 'text' => '<head>', 'correct' => false],
                    ['id' => 'B', 'text' => '<title>', 'correct' => false],
                    ['id' => 'C', 'text' => '<body>', 'correct' => true],
                    ['id' => 'D', 'text' => '<footer>', 'correct' => false],
                ],
                'order' => 2,
            ]);

            // Lesson 3
            $lesson3 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'Tag Heading',
                'slug' => 'tag-heading',
                'content' => 'HTML memiliki 6 tingkatan heading, dari <h1> sampai <h6>.',
                'video_url' => null,
                'order' => 3,
                'xp_reward' => 25,
            ]);

            $lesson3->slides()->create([
                'type' => 'text',
                'title' => 'Heading HTML',
                'content' => 'Heading HTML didefinisikan dengan tag <h1> hingga <h6>. <h1> mendefinisikan heading paling penting.',
                'order' => 1,
            ]);

            $lesson3->slides()->create([
                'type' => 'quiz',
                'title' => 'Kuis Heading',
                'content' => 'Manakah h1 yang memiliki ukuran paling besar?',
                'options' => [
                    ['id' => 'A', 'text' => '<h6>', 'correct' => false],
                    ['id' => 'B', 'text' => '<h3>', 'correct' => false],
                    ['id' => 'C', 'text' => '<h1>', 'correct' => true],
                    ['id' => 'D', 'text' => '<header>', 'correct' => false],
                ],
                'order' => 2,
            ]);

            // Lesson 4
            $lesson4 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'Paragraf dan Teks',
                'slug' => 'paragraf-dan-teks',
                'content' => 'Gunakan tag <p> untuk membuat paragraf. Tag <b> atau <strong> untuk menebalkan teks.',
                'video_url' => null,
                'order' => 4,
                'xp_reward' => 25,
            ]);

            $lesson4->slides()->create([
                'type' => 'text',
                'title' => 'Paragraf',
                'content' => 'Tag <p> mendefinisikan sebuah paragraf. Browser secara otomatis menambahkan margin sebelum dan sesudah paragraf.',
                'order' => 1,
            ]);

            $lesson4->slides()->create([
                'type' => 'quiz',
                'title' => 'Kuis Paragraf',
                'content' => 'Tag HTML untuk membuat paragraf adalah...',
                'options' => [
                    ['id' => 'A', 'text' => '<para>', 'correct' => false],
                    ['id' => 'B', 'text' => '<p>', 'correct' => true],
                    ['id' => 'C', 'text' => '<pg>', 'correct' => false],
                    ['id' => 'D', 'text' => '<text>', 'correct' => false],
                ],
                'order' => 2,
            ]);

            // Lesson 5
            $lesson5 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'Membuat Link',
                'slug' => 'membuat-link',
                'content' => 'Gunakan tag <a> dengan atribut href untuk membuat link ke halaman lain.',
                'video_url' => null,
                'order' => 5,
                'xp_reward' => 30,
            ]);

            $lesson5->slides()->create([
                'type' => 'text',
                'title' => 'Hyperlink',
                'content' => 'Tag <a> mendefinisikan hyperlink. Atribut href menentukan URL tujuan link.',
                'order' => 1,
            ]);

            $lesson5->slides()->create([
                'type' => 'quiz',
                'title' => 'Kuis Link',
                'content' => 'Atribut apa yang digunakan untuk link?',
                'options' => [
                    ['id' => 'A', 'text' => 'src', 'correct' => false],
                    ['id' => 'B', 'text' => 'link', 'correct' => false],
                    ['id' => 'C', 'text' => 'href', 'correct' => true],
                    ['id' => 'D', 'text' => 'to', 'correct' => false],
                ],
                'order' => 2,
            ]);

            // Lesson 6
            $lesson6 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'Menambahkan Gambar',
                'slug' => 'menambahkan-gambar',
                'content' => 'Gunakan tag <img> dengan atribut src untuk menampilkan gambar.',
                'video_url' => null,
                'order' => 6,
                'xp_reward' => 30,
            ]);

            $lesson6->slides()->create([
                'type' => 'text',
                'title' => 'Gambar HTML',
                'content' => 'Tag <img> digunakan untuk menyematkan gambar dalam halaman HTML. Atribut src menentukan jalur ke gambar.',
                'order' => 1,
            ]);

            $lesson6->slides()->create([
                'type' => 'quiz',
                'title' => 'Kuis Gambar',
                'content' => 'Apakah tag <img> perlu penutup?',
                'options' => [
                    ['id' => 'A', 'text' => 'Ya', 'correct' => false],
                    ['id' => 'B', 'text' => 'Tidak', 'correct' => true],
                    ['id' => 'C', 'text' => 'Kadang', 'correct' => false],
                    ['id' => 'D', 'text' => 'Tergantung', 'correct' => false],
                ],
                'order' => 2,
            ]);

            // Lesson 7
            $lesson7 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'Membuat List',
                'slug' => 'membuat-list',
                'content' => 'Gunakan <ul> untuk list tidak berurutan dan <ol> untuk list berurutan.',
                'video_url' => null,
                'order' => 7,
                'xp_reward' => 35,
            ]);

            $lesson7->slides()->create([
                'type' => 'text',
                'title' => 'List HTML',
                'content' => 'HTML mendukung list berurutan (<ol>), tidak berurutan (<ul>), dan list definisi (<dl>).',
                'order' => 1,
            ]);

            $lesson7->slides()->create([
                'type' => 'quiz',
                'title' => 'Kuis List',
                'content' => 'Tag untuk list bernomor?',
                'options' => [
                    ['id' => 'A', 'text' => '<ul>', 'correct' => false],
                    ['id' => 'B', 'text' => '<dl>', 'correct' => false],
                    ['id' => 'C', 'text' => '<list>', 'correct' => false],
                    ['id' => 'D', 'text' => '<ol>', 'correct' => true],
                ],
                'order' => 2,
            ]);

            // Lesson 8
            $lesson8 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'Tabel Sederhana',
                'slug' => 'tabel-sederhana',
                'content' => 'Tabel dibuat dengan <table>, baris dengan <tr>, dan sel dengan <td>.',
                'video_url' => null,
                'order' => 8,
                'xp_reward' => 40,
            ]);

            $lesson8->slides()->create([
                'type' => 'text',
                'title' => 'Tabel HTML',
                'content' => 'Tabel HTML memungkinkan pengembang web untuk menyusun data ke dalam baris dan kolom.',
                'order' => 1,
            ]);

            $lesson8->slides()->create([
                'type' => 'quiz',
                'title' => 'Kuis Tabel',
                'content' => 'Tag untuk baris tabel?',
                'options' => [
                    ['id' => 'A', 'text' => '<td>', 'correct' => false],
                    ['id' => 'B', 'text' => '<tr>', 'correct' => true],
                    ['id' => 'C', 'text' => '<th>', 'correct' => false],
                    ['id' => 'D', 'text' => '<tb>', 'correct' => false],
                ],
                'order' => 2,
            ]);

            // Lesson 9
            $lesson9 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'Formulir HTML',
                'slug' => 'formulir-html',
                'content' => 'Tag <form> membungkus elemen input seperti text field, checkbox, dan tombol.',
                'video_url' => null,
                'order' => 9,
                'xp_reward' => 45,
            ]);

            $lesson9->slides()->create([
                'type' => 'text',
                'title' => 'Formulir',
                'content' => 'Elemen <form> digunakan untuk mengumpulkan input pengguna. Elemen ini sering dikirim ke server untuk diproses.',
                'order' => 1,
            ]);

            $lesson9->slides()->create([
                'type' => 'quiz',
                'title' => 'Kuis Form',
                'content' => 'Input teks pendek?',
                'options' => [
                    ['id' => 'A', 'text' => '<input type="text">', 'correct' => true],
                    ['id' => 'B', 'text' => '<textarea>', 'correct' => false],
                    ['id' => 'C', 'text' => '<submit>', 'correct' => false],
                    ['id' => 'D', 'text' => '<field>', 'correct' => false],
                ],
                'order' => 2,
            ]);

            // Lesson 10
            $lesson10 = Lesson::create([
                'course_id' => $course->id,
                'title' => 'HTML Semantik',
                'slug' => 'html-semantik',
                'content' => 'Elemen semantik seperti <header>, <nav>, <article>, <footer> memberikan makna pada struktur web.',
                'video_url' => null,
                'order' => 10,
                'xp_reward' => 50,
            ]);

            $lesson10->slides()->create([
                'type' => 'text',
                'title' => 'Semantik',
                'content' => 'Elemen semantik mendeskripsikan maknanya dengan jelas kepada browser dan pengembang.',
                'order' => 1,
            ]);

            $lesson10->slides()->create([
                'type' => 'quiz',
                'title' => 'Kuis Semantik',
                'content' => 'Tag untuk navigasi?',
                'options' => [
                    ['id' => 'A', 'text' => '<div class="nav">', 'correct' => false],
                    ['id' => 'B', 'text' => '<navigation>', 'correct' => false],
                    ['id' => 'C', 'text' => '<nav>', 'correct' => true],
                    ['id' => 'D', 'text' => '<menu>', 'correct' => false],
                ],
                'order' => 2,
            ]);
        }
    }
}
