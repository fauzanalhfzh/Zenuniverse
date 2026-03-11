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
            $this->createLesson1($course);
            $this->createLesson2($course);
            $this->createLesson3($course);
            $this->createLesson4($course);
            $this->createLesson5($course);
            $this->createLesson6($course);
            $this->createLesson7($course);
            $this->createLesson8($course);
            $this->createLesson9($course);
            $this->createLesson10($course);
        }

        // Get Course "Logika Pemrograman Dasar"
        $logicCourse = Course::where('title', 'Logika Pemrograman Dasar')->first();

        if ($logicCourse) {
            $this->createLogicLesson1($logicCourse); // Algoritma
            $this->createLogicLesson2($logicCourse); // Variabel
            $this->createLogicLesson3($logicCourse); // Kondisional
            $this->createLogicLesson4($logicCourse); // Perulangan
            $this->createLogicLesson5($logicCourse); // Pseudocode
            $this->createLogicLesson6($logicCourse); // Operator Aritmatika
            $this->createLogicLesson7($logicCourse); // Operator Logika
            $this->createLogicLesson8($logicCourse); // Array Dasar
            $this->createLogicLesson9($logicCourse); // Fungsi (Function)
            $this->createLogicLesson10($logicCourse); // Parameter dan Return
            $this->createLogicLesson11($logicCourse); // Perulangan Lanjutan (Nested Loop)
            $this->createLogicLesson12($logicCourse); // Pencarian Dasar
            $this->createLogicLesson13($logicCourse); // Pengurutan Dasar
            $this->createLogicLesson14($logicCourse); // Struktur Data
            $this->createLogicLesson15($logicCourse); // Debugging
        }

        // Get Course "Matematika Dasar"
        $mathCourse = Course::where('title', 'Matematika Dasar')->first();
        if ($mathCourse) {
            $this->createMathLessons($mathCourse);
        }
    }

    private function createLogicLesson1($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'apa-itu-algoritma'],
            [
                'course_id' => $course->id, 'title' => 'Apa itu Algoritma?',
                'content' => 'Langkah-langkah logis penyelesaian masalah.', 'video_url' => null, 'order' => 1, 'xp_reward' => 20,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Definisi Algoritma', 'content' => 'Algoritma adalah urutan langkah-langkah logis untuk menyelesaikan suatu masalah secara sistematis.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa tujuan utama algoritma?', [['id' => 'A', 'text' => 'Membuat kopi', 'correct' => false], ['id' => 'B', 'text' => 'Menyelesaikan masalah', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Resep Masakan', 'content' => 'Algoritma mirip dengan resep masakan: ada bahan (input), proses memasak (langkah), dan hidangan (output).']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Algoritma mirip dengan?', [['id' => 'A', 'text' => 'Resep masakan', 'correct' => true], ['id' => 'B', 'text' => 'Kamus', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Ciri Algoritma', 'content' => 'Algoritma harus jelas, terdefinisi, dan memiliki akhir (berhenti).']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Apakah algoritma boleh tidak berhenti?', [['id' => 'A', 'text' => 'Boleh', 'correct' => false], ['id' => 'B', 'text' => 'Tidak, harus berhenti', 'correct' => true]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Flowchart', 'content' => 'Flowchart adalah diagram yang menggambarkan langkah-langkah algoritma.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Diagram algoritma disebut?', [['id' => 'A', 'text' => 'Instagram', 'correct' => false], ['id' => 'B', 'text' => 'Flowchart', 'correct' => true]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Pentingnya Logika', 'content' => 'Sebelum menulis kode (coding), kita harus menyusun algoritmanya terlebih dahulu.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Urutan yang benar adalah?', [['id' => 'A', 'text' => 'Coding dulu, baru mikir', 'correct' => false], ['id' => 'B', 'text' => 'Algoritma dulu, baru coding', 'correct' => true]]);

        // MINIGAMES SAMPLES -> Order 11, 12, 13
        // 11. Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 11], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Menyeduh Teh ☕',
            'content' => 'Susun langkah-langkah membuat teh manis yang benar dari atas ke bawah!',
            'options' => [
                ['id' => 0, 'text' => 'Siapkan gelas dan kantong teh'],
                ['id' => 1, 'text' => 'Tuang air panas ke dalam gelas'],
                ['id' => 2, 'text' => 'Masukkan gula secukupnya'],
                ['id' => 3, 'text' => 'Aduk hingga gula larut'],
                ['id' => 4, 'text' => 'Teh siap diminum!'],
            ],
            'correct_answer' => null, // validation is by id order
            'explanation' => 'Algoritma harus urut! Jika air panas dituang terakhir, teh tidak akan larut dengan sempurna.',
        ]);

        // 12. Code Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 12], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi Algoritma 📝',
            'content' => 'Lengkapi kalimat algoritma sederhana tentang lampu lalu lintas di bawah ini.',
            'options' => [
                ['type' => 'text', 'value' => 'Jika lampu '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1], // Merah
                ['type' => 'text', 'value' => ' menyala, maka kendaraan harus '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2], // Berhenti
                ['type' => 'text', 'value' => '.\nNamun jika lampu Hijau menyala, kendaraan boleh '],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3], // Jalan
                ['type' => 'text', 'value' => '.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Merah', 'color' => 'red'],
                ['id' => 3, 'text' => 'Jalan', 'color' => 'green'],
                ['id' => 4, 'text' => 'Terbang', 'color' => 'blue'], // distractor
                ['id' => 2, 'text' => 'Berhenti', 'color' => 'purple'],
            ]),
            'explanation' => 'Kondisi lampu merah mengharuskan kita berhenti, sedangkan hijau mengizinkan kita jalan. Ini contoh logika IF-ELSE di dunia nyata.',
        ]);

        // 13. Block Code
        $lesson->slides()->firstOrCreate(['order' => 13], [
            'type' => 'block_code',
            'title' => 'Robot Berjalan 🤖',
            'content' => 'Tarik blok logika dari kiri ke Area Kerja untuk membuat robot maju 2 langkah lalu belok kanan.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'Maju 1 Langkah'],
                ['id' => 2, 'type' => 'action', 'text' => 'Maju 2 Langkah'],
                ['id' => 3, 'type' => 'logic', 'text' => 'Belok Kanan'],
                ['id' => 4, 'type' => 'logic', 'text' => 'Belok Kiri'],
            ],
            'correct_answer' => '2,3',
            'explanation' => 'Robot harus bergerak lurus dahulu (Maju 2 Langkah) sebelum dieksekusi perintah Belok Kanan.',
        ]);
    }

    private function createLogicLesson2($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'variabel-tipe-data'],
            [
                'course_id' => $course->id, 'title' => 'Variabel & Tipe Data',
                'content' => 'Wadah penyimpanan data.', 'video_url' => null, 'order' => 2, 'xp_reward' => 30,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Variabel?', 'content' => 'Variabel adalah "wadah" untuk menyimpan nilai atau data dalam program.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Fungsi variabel adalah?', [['id' => 'A', 'text' => 'Menyimpan data', 'correct' => true], ['id' => 'B', 'text' => 'Menghapus data', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Analogi Kotak', 'content' => 'Bayangkan variabel sebagai kotak kardus yang bisa kita isi barang dan diberi label nama.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Variabel seperti?', [['id' => 'A', 'text' => 'Kotak penyimpanan', 'correct' => true], ['id' => 'B', 'text' => 'Bola lampu', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Integer', 'content' => 'Integer adalah tipe data untuk bilangan bulat (contoh: 5, 10, -3).']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Contoh integer?', [['id' => 'A', 'text' => '3.14', 'correct' => false], ['id' => 'B', 'text' => '100', 'correct' => true]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'String', 'content' => 'String adalah tipe data untuk teks (contoh: "Halo Dunia").']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Tipe data untuk teks?', [['id' => 'A', 'text' => 'Integer', 'correct' => false], ['id' => 'B', 'text' => 'String', 'correct' => true]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Boolean', 'content' => 'Boolean hanya memiliki dua nilai: Benar (True) atau Salah (False).']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Nilai boolean?', [['id' => 'A', 'text' => 'True/False', 'correct' => true], ['id' => 'B', 'text' => 'A/B/C', 'correct' => false]]);
    }

    private function createLogicLesson3($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'logika-if-else'],
            [
                'course_id' => $course->id, 'title' => 'Logika If/Else',
                'content' => 'Pengambilan keputusan.', 'video_url' => null, 'order' => 3, 'xp_reward' => 35,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Percabangan', 'content' => 'Program bisa mengambil keputusan berdasarkan kondisi tertentu menggunakan "If" (Jika).']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'If digunakan untuk?', [['id' => 'A', 'text' => 'Mengulang', 'correct' => false], ['id' => 'B', 'text' => 'Cek kondisi', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Analogi Hujan', 'content' => 'JIKA hujan, MAKA bawa payung. JIKA TIDAK, pakai topi.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Jika hujan maka?', [['id' => 'A', 'text' => 'Bawa payung', 'correct' => true], ['id' => 'B', 'text' => 'Siram tanaman', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Else', 'content' => '"Else" (Lainnya) dijalankan jika kondisi "If" tidak terpenuhi.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Kapan Else jalan?', [['id' => 'A', 'text' => 'Saat kondisi If salah', 'correct' => true], ['id' => 'B', 'text' => 'Saat kondisi If benar', 'correct' => false]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Operator Perbandingan', 'content' => 'Kita menggunakan operator seperti > (lebih besar), < (lebih kecil), == (sama dengan).']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Simbol sama dengan?', [['id' => 'A', 'text' => '==', 'correct' => true], ['id' => 'B', 'text' => '=', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Nested If', 'content' => 'Kita bisa memasukkan If di dalam If (If bersarang) untuk logika kompleks.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'If di dalam If disebut?', [['id' => 'A', 'text' => 'Double If', 'correct' => false], ['id' => 'B', 'text' => 'Nested If', 'correct' => true]]);
    }

    private function createLogicLesson4($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'perulangan-loop'],
            [
                'course_id' => $course->id, 'title' => 'Perulangan (Loop)',
                'content' => 'Melakukan hal berulang.', 'video_url' => null, 'order' => 4, 'xp_reward' => 35,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Kenapa Loop?', 'content' => 'Loop digunakan untuk menjalankan kode yang sama berkali-kali tanpa menulis ulang.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Fungsi loop?', [['id' => 'A', 'text' => 'Mengulang kode', 'correct' => true], ['id' => 'B', 'text' => 'Stop program', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'For Loop', 'content' => 'For Loop digunakan ketika kita tahu pasti berapa kali kita ingin mengulang (misal: 5 kali).']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Loop untuk jumlah pasti?', [['id' => 'A', 'text' => 'For Loop', 'correct' => true], ['id' => 'B', 'text' => 'While Loop', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'While Loop', 'content' => 'While Loop berjalan SELAMA kondisi masih benar (bisa tidak berhenti jika salah logika).']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Loop selama kondisi benar?', [['id' => 'A', 'text' => 'If', 'correct' => false], ['id' => 'B', 'text' => 'While', 'correct' => true]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Infinite Loop', 'content' => 'Hati-hati dengan Infinite Loop, di mana program tidak pernah berhenti berulang!']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Loop tanpa henti disebut?', [['id' => 'A', 'text' => 'Infinite Loop', 'correct' => true], ['id' => 'B', 'text' => 'Mega Loop', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Efisiensi', 'content' => 'Menggunakan Loop membuat kode lebih pendek, rapi, dan mudah diatur.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Manfaat loop?', [['id' => 'A', 'text' => 'Kode lebih pendek', 'correct' => true], ['id' => 'B', 'text' => 'Kode lebih rumit', 'correct' => false]]);
    }

    private function createLogicLesson5($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pseudocode'],
            [
                'course_id' => $course->id, 'title' => 'Pseudocode',
                'content' => 'Kode semu.', 'video_url' => null, 'order' => 5, 'xp_reward' => 40,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Pseudocode?', 'content' => 'Pseudocode adalah "kode semu", deskripsi algoritma yang mirip kode tapi bisa dibaca manusia.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Pseudocode adalah?', [['id' => 'A', 'text' => 'Bahasa mesin', 'correct' => false], ['id' => 'B', 'text' => 'Kode semu', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Tujuan', 'content' => 'Tujuannya untuk merencanakan logika program tanpa memikirkan aturan sintaks bahasa pemrograman tertentu.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Fokus pseudocode?', [['id' => 'A', 'text' => 'Logika', 'correct' => true], ['id' => 'B', 'text' => 'Tanda baca', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Bahasa Bebas', 'content' => 'Pseudocode bisa ditulis dalam bahasa Indonesia atau Inggris, yang penting jelas.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Bahasa pseudocode?', [['id' => 'A', 'text' => 'Harus Inggris', 'correct' => false], ['id' => 'B', 'text' => 'Bebas asal jelas', 'correct' => true]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Struktur', 'content' => 'Meski bebas, biasanya tetap menggunakan kata kunci seperti IF, ELSE, WHILE, PRINT.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Kata kunci umum?', [['id' => 'A', 'text' => 'IF, ELSE', 'correct' => true], ['id' => 'B', 'text' => 'JUMP, RUN', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Jembatan', 'content' => 'Pseudocode adalah jembatan antara bahasa manusia dan bahasa pemrograman.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Pseudocode menjembatani?', [['id' => 'A', 'text' => 'Manusia & Mesin', 'correct' => true], ['id' => 'B', 'text' => 'Laut & Darat', 'correct' => false]]);
    }

    private function createLogicLesson6($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'operator-aritmatika'],
            [
                'course_id' => $course->id, 'title' => 'Operator Aritmatika',
                'content' => 'Kalkulasi dasar matematika dalam pemrograman.', 'video_url' => null, 'order' => 6, 'xp_reward' => 35,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Operator?', 'content' => 'Operator adalah simbol untuk melakukan operasi pada nilai atau variabel.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Fungsi operator aritmatika?', [['id' => 'A', 'text' => 'Menggambar garis', 'correct' => false], ['id' => 'B', 'text' => 'Melakukan perhitungan', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Penjumlahan & Pengurangan', 'content' => 'Gunakan tanda + untuk menambah dan - untuk mengurang.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Berapa 5 + 3?', [['id' => 'A', 'text' => '8', 'correct' => true], ['id' => 'B', 'text' => '7', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Perkalian & Pembagian', 'content' => 'Dalam pemrograman, perkalian menggunakan * dan pembagian menggunakan /.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Simbol perkalian adalah?', [['id' => 'A', 'text' => 'x', 'correct' => false], ['id' => 'B', 'text' => '*', 'correct' => true]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Modulus (Sisa Bagi)', 'content' => 'Modulus menggunakan tanda % dan menghasilkan sisa dari pembagian (misalnya 5 % 2 = 1).']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Berapa hasil dari 4 % 2?', [['id' => 'A', 'text' => '0', 'correct' => true], ['id' => 'B', 'text' => '2', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Prioritas', 'content' => 'Sama seperti matematika, perkalian dan pembagian dilakukan sebelum penjumlahan/pengurangan.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Aturan pengerjaan didahulukan?', [['id' => 'A', 'text' => 'Kali/Bagi', 'correct' => true], ['id' => 'B', 'text' => 'Tambah/Kurang', 'correct' => false]]);

        // 11. Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 11], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Kalkulator 🔢',
            'content' => 'Susun langkah-langkah membuat program perhitungan sederhana.',
            'options' => [
                ['id' => 0, 'text' => 'Ambil angka pertama'],
                ['id' => 1, 'text' => 'Tentukan operator matematika'],
                ['id' => 2, 'text' => 'Ambil angka kedua'],
                ['id' => 3, 'text' => 'Hitung hasilnya'],
                ['id' => 4, 'text' => 'Tampilkan ke layar'],
            ],
            'correct_answer' => null,
            'explanation' => 'Kita harus tahu nilai dan operatornya terlebih dahulu sebelum menghitung dan menampilkannya.',
        ]);

        // 12. Block Code
        $lesson->slides()->firstOrCreate(['order' => 12], [
            'type' => 'block_code',
            'title' => 'Perhitungan Blok 🧮',
            'content' => 'Lengkapi perhitungan agar hasilnya 10. Tarik angka dan operator!',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'Angka 5'],
                ['id' => 2, 'type' => 'logic', 'text' => 'Ditambah (+)'],
                ['id' => 3, 'type' => 'action', 'text' => 'Angka 5'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => '5 ditambah (+) 5 hasilnya adalah 10.',
        ]);
    }

    private function createLogicLesson7($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'operator-logika'],
            [
                'course_id' => $course->id, 'title' => 'Operator Logika',
                'content' => 'Menggabungkan beberapa kondisi.', 'video_url' => null, 'order' => 7, 'xp_reward' => 35,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Lebih Dari Satu Kondisi', 'content' => 'Operator logika membantu kita mengecek lebih dari satu syarat.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Fungsi operator logika?', [['id' => 'A', 'text' => 'Gabung kondisi', 'correct' => true], ['id' => 'B', 'text' => 'Hitung angka', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'AND (Dan)', 'content' => 'Operator AND (&&) menghasilkan True HANYA JIKA semua kondisi benar.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Syarat operator AND?', [['id' => 'A', 'text' => 'Semua harus benar', 'correct' => true], ['id' => 'B', 'text' => 'Salah satu boleh salah', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'OR (Atau)', 'content' => 'Operator OR (||) menghasilkan True JIKA SALAH SATU atau lebih kondisi benar.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Jika salah satu benar, maka hasil OR?', [['id' => 'A', 'text' => 'True', 'correct' => true], ['id' => 'B', 'text' => 'False', 'correct' => false]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'NOT (Tidak)', 'content' => 'Operator NOT (!) membalikkan kebenaran. True menjadi False, dan sebaliknya.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'NOT True sama dengan?', [['id' => 'A', 'text' => 'False', 'correct' => true], ['id' => 'B', 'text' => 'Benar', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Pemakaian Populer', 'content' => 'Digunakan saat login: JIKA username benar AND password benar.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Login butuh operator apa agar aman?', [['id' => 'A', 'text' => 'OR', 'correct' => false], ['id' => 'B', 'text' => 'AND', 'correct' => true]]);

        // 11. Code Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 11], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi Logika 📝',
            'content' => 'Pilih operator logika yang tepat untuk masuk ke bioskop.',
            'options' => [
                ['type' => 'text', 'value' => 'Jika punya tiket '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1], // AND
                ['type' => 'text', 'value' => ' umur sesuai batas minimal, maka boleh masuk.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'AND', 'color' => 'blue'],
                ['id' => 2, 'text' => 'OR', 'color' => 'red'],
                ['id' => 3, 'text' => 'NOT', 'color' => 'gray'], // distractor
            ]),
            'explanation' => 'Kita butuh AND karena kedua syarat (punya tiket dan cukup umur) harus terpenuhi.',
        ]);
    }

    private function createLogicLesson8($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'array-koleksi'],
            [
                'course_id' => $course->id, 'title' => 'Array (Koleksi Data)',
                'content' => 'Menyimpan banyak data dalam satu tempat.', 'video_url' => null, 'order' => 8, 'xp_reward' => 45,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Array?', 'content' => 'Array adalah struktur data yang menyimpan daftar item dalam satu variabel tunggal.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Fungsi utama array?', [['id' => 'A', 'text' => 'Simpan banyak data', 'correct' => true], ['id' => 'B', 'text' => 'Hapus data', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Analogi Lemari', 'content' => 'Array seperti lemari dengan banyak laci. Tiap laci punya nomor urut unik.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Array mirip dengan apa?', [['id' => 'A', 'text' => 'Lemari berlaci', 'correct' => true], ['id' => 'B', 'text' => 'Air mengalir', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Indeks Array', 'content' => 'Nomor laci (indeks) di dalam Array biasanya dimulai dari 0, bukan 1.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Indeks awal array adalah?', [['id' => 'A', 'text' => '0', 'correct' => true], ['id' => 'B', 'text' => '1', 'correct' => false]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Titik Kurung', 'content' => 'Array biasanya ditandai dengan kurung siku [ ]. Contoh: [Apel, Jeruk, Pisang].']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Simbol array pada kodingan?', [['id' => 'A', 'text' => '{ }', 'correct' => false], ['id' => 'B', 'text' => '[ ]', 'correct' => true]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Akses Data', 'content' => 'Jika Buah = [Apel, Jeruk], maka Buah[0] adalah Apel.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Buah[1] pada array [Apel, Jeruk] adalah?', [['id' => 'A', 'text' => 'Jeruk', 'correct' => true], ['id' => 'B', 'text' => 'Apel', 'correct' => false]]);

        // 11. Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 11], [
            'type' => 'code_arrange',
            'title' => 'Daftar Belanja 🛒',
            'content' => 'Buat urutan array daftar belanja yang benar dari indeks 0 sampai 3!',
            'options' => [
                ['id' => 0, 'text' => '[0] Susu'],
                ['id' => 1, 'text' => '[1] Roti'],
                ['id' => 2, 'text' => '[2] Telur'],
                ['id' => 3, 'text' => '[3] Keju'],
            ],
            'correct_answer' => null,
            'explanation' => 'Array selalu berurutan dari indeks 0, 1, 2, dan seterusnya.',
        ]);
    }

    private function createLogicLesson9($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'fungsi-dasar'],
            [
                'course_id' => $course->id, 'title' => 'Fungsi (Function)',
                'content' => 'Membuat blok kode yang bisa dipakai ulang.', 'video_url' => null, 'order' => 9, 'xp_reward' => 45,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Fungsi?', 'content' => 'Fungsi (Function) adalah sekumpulan kode yang diberi nama dan melakukan tugas tertentu.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Fungsi berguna untuk?', [['id' => 'A', 'text' => 'Kode dipakai ulang', 'correct' => true], ['id' => 'B', 'text' => 'Macetkan program', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Mencegah Repetisi', 'content' => 'Daripada menulis 10 baris kode yang sama berulang kali, cukup buat satu fungsi dan panggil namanya.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Kelebihan fungsi?', [['id' => 'A', 'text' => 'Banyak mengetik', 'correct' => false], ['id' => 'B', 'text' => 'Cegah kode berulang', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Definisi vs Panggilan', 'content' => 'Kita \'mendefinisikan\' (membuat) fungsi dulu, baru kemudian bisa \'memanggil\' (menggunakan) fungsi tersebut.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Sebelum dipanggil, fungsi harus?', [['id' => 'A', 'text' => 'Dihapus', 'correct' => false], ['id' => 'B', 'text' => 'Didefinisikan', 'correct' => true]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Penamaan Fungsi', 'content' => 'Nama fungsi biasanya menggunakan kata kerja, seperti SapaPengguna() atau HitungTotal().']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Ide nama fungsi yang baik?', [['id' => 'A', 'text' => 'HitungLuas()', 'correct' => true], ['id' => 'B', 'text' => 'Biru()', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Modularitas', 'content' => 'Fungsi membagi program besar menjadi modul-modul kecil yang rapi dan mudah diatur.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Program besar lebih mudah diatur bila?', [['id' => 'A', 'text' => 'Ditulis 1000 baris acak', 'correct' => false], ['id' => 'B', 'text' => 'Dibagi jadi fungsi-fungsi', 'correct' => true]]);
        
        // 11. Code Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 11], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi Fungsi 📝',
            'content' => 'Lengkapi urutan membuat dan menggunakan fungsi menyapa.',
            'options' => [
                ['type' => 'text', 'value' => 'Pertama, '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1], // Buat fungsi Sapa()
                ['type' => 'text', 'value' => ' berisi perintah "Halo".\nLalu, '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2], // Panggil fungsi Sapa()
                ['type' => 'text', 'value' => ' di tempat yang kita inginkan.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Buat fungsi Sapa()', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Panggil fungsi Sapa()', 'color' => 'purple'],
                ['id' => 3, 'text' => 'Hapus Semua', 'color' => 'red'], // distractor
            ]),
            'explanation' => 'Kita mendeklarasikan atau membuat fungsi lebih dahulu sebelum bisa memanggilnya.',
        ]);
    }

    private function createLogicLesson10($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'parameter-dan-return'],
            [
                'course_id' => $course->id, 'title' => 'Parameter & Return',
                'content' => 'Input dan output dari sebuah Fucntion.', 'video_url' => null, 'order' => 10, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Parameter?', 'content' => 'Parameter adalah data atau variabel yang kita kirimkan (input) ke dalam sebuah fungsi.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Parameter sebutan lain untuk?', [['id' => 'A', 'text' => 'Input fungsi', 'correct' => true], ['id' => 'B', 'text' => 'Nama fungsi', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Contoh Parameter', 'content' => 'Pada fungsi BuatKopi(Gula, Kopi), maka "Gula" dan "Kopi" adalah parameter.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Berapa jumlah parameter pada BuatKopi(Air)?', [['id' => 'A', 'text' => 'Satu', 'correct' => true], ['id' => 'B', 'text' => 'Dua', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Apa itu Return?', 'content' => 'Return digunakan untuk mengembalikan nilai (output) dari sebuah fungsi ke program utama.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Output fungsi menggunakan?', [['id' => 'A', 'text' => 'Return', 'correct' => true], ['id' => 'B', 'text' => 'Break', 'correct' => false]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Beda Print dan Return', 'content' => 'Print sekadar mencetak teks ke layar, sedangkan Return memberikan kembali sebuah nilai yang bisa dihitung lagi.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Apakah Print dan Return itu sama?', [['id' => 'A', 'text' => 'Tidak', 'correct' => true], ['id' => 'B', 'text' => 'Sama persis', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Mesin Pabrik', 'content' => 'Fungsi ibarat mesin. Parameter adalah bahan bakunya, Return adalah produk jadinya.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Parameter adalah?', [['id' => 'A', 'text' => 'Bahan Baku', 'correct' => true], ['id' => 'B', 'text' => 'Sisa limbah', 'correct' => false]]);
    }

    private function createLogicLesson11($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'nested-loop'],
            [
                'course_id' => $course->id, 'title' => 'Nested Loop',
                'content' => 'Perulangan di dalam perulangan.', 'video_url' => null, 'order' => 11, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Loop Bersarang', 'content' => 'Nested Loop adalah kondisi dimana ada perulangan di dalam perulangan lainnya.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa itu Nested Loop?', [['id' => 'A', 'text' => 'Loop dalam Loop', 'correct' => true], ['id' => 'B', 'text' => 'Loop rusak', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Jam Dinding', 'content' => 'Jarum menit berputar 60 kali (loop dalam) untuk setiap 1 jam (loop luar).']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Berapa kali loop dalam berjalan dibanding loop luar?', [['id' => 'A', 'text' => 'Lebih lambat', 'correct' => false], ['id' => 'B', 'text' => 'Lebih banyak', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Pola Bintang', 'content' => 'Nested loop sering digunakan untuk membuat pola 2 dimensi, seperti kotak bintang atau segitiga bintang.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Nested loop berguna untuk membuat?', [['id' => 'A', 'text' => 'Garis lurus', 'correct' => false], ['id' => 'B', 'text' => 'Pola 2D (Kotak/Segitiga)', 'correct' => true]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Cara Kerja', 'content' => 'Loop luar menunggu sampai loop dalam selesai mengulang sepenuhnya, barulah loop luar lanjut ke langkah berikutnya.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Siapa yang selesai lebih dulu?', [['id' => 'A', 'text' => 'Loop Luar', 'correct' => false], ['id' => 'B', 'text' => 'Loop Dalam', 'correct' => true]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Kombinasi Array', 'content' => 'Bisa digunakan untuk mengakses array 2 Dimensi (Matrix). Baris dan Kolom.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Array 2 Dimensi (Matrix) menggunakan?', [['id' => 'A', 'text' => 'Nested Loop', 'correct' => true], ['id' => 'B', 'text' => 'Satu Loop saja', 'correct' => false]]);
    }

    private function createLogicLesson12($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pencarian-dasar'],
            [
                'course_id' => $course->id, 'title' => 'Pencarian (Searching)',
                'content' => 'Menemukan data dalam tumpukan.', 'video_url' => null, 'order' => 12, 'xp_reward' => 55,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Linear Search', 'content' => 'Pencarian paling dasar dengan mengecek item satu persatu dari awal sampai akhir.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Bagaimana cara kerja Linear Search?', [['id' => 'A', 'text' => 'Cek satu persatu', 'correct' => true], ['id' => 'B', 'text' => 'Tebak acak', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Kapan Berhenti?', 'content' => 'Pencarian linier berhenti begitu ia menemukan angka yang dicari atau saat data sudah habis.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Jika data dicari ada di posisi paling awal, prosesnya?', [['id' => 'A', 'text' => 'Lama', 'correct' => false], ['id' => 'B', 'text' => 'Sangat cepat', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Kelemahan', 'content' => 'Mengecek satu persatu sangat lambat jika datanya ribuan atau jutaan.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Kekurangan pencarian satu-persatu?', [['id' => 'A', 'text' => 'Lambat jika data besar', 'correct' => true], ['id' => 'B', 'text' => 'Susah dipahami', 'correct' => false]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Binary Search', 'content' => 'Pencarian membelah dua: mengecek bagian tengah. Syaratnya data harus sudah urut!']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Syarat menggunakan Binary Search?', [['id' => 'A', 'text' => 'Data acak', 'correct' => false], ['id' => 'B', 'text' => 'Data sudah urut', 'correct' => true]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Kamus Kata', 'content' => 'Mencari dengan Binary Search mirip mencari kata di kamus: buka tengah, cek posisinya.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Mencari di kamus memakai logika apa?', [['id' => 'A', 'text' => 'Linear Search', 'correct' => false], ['id' => 'B', 'text' => 'Binary Search (Pilah Tengan)', 'correct' => true]]);

        // 11. Code Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 11], [
            'type' => 'code_fillblank',
            'title' => 'Mencari Angka 3 📝',
            'content' => 'Data = [1, 2, 3, 4]. Lengkapi cara kerja pencarian linier.',
            'options' => [
                ['type' => 'text', 'value' => 'Pertama cek angka 1. Apakah 3? Bukan!\nCek angka 2. Apakah 3? Bukan!\nCek angka '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1], // 3
                ['type' => 'text', 'value' => '. Apakah 3? '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2], // Ya, Berhenti!
                ['type' => 'text', 'value' => ''],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '3', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Ya, Berhenti!', 'color' => 'green'],
                ['id' => 3, 'text' => '4', 'color' => 'red'], // distractor
                ['id' => 4, 'text' => 'Lanjut cek 4', 'color' => 'purple'], // distractor
            ]),
            'explanation' => 'Pencarian linier mengecek dari awal berurutan dan berhenti saat data ditemukan.',
        ]);
    }

    private function createLogicLesson13($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pengurutan-dasar'],
            [
                'course_id' => $course->id, 'title' => 'Pengurutan (Sorting)',
                'content' => 'Mengurutkan data yang acak.', 'video_url' => null, 'order' => 13, 'xp_reward' => 55,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Mengapa Perlu Urut?', 'content' => 'Data yang urut jauh lebih mudah dibaca dan dicari (misal: mencari nomor HP di kontak).']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Manfaat mengurutkan data?', [['id' => 'A', 'text' => 'Membuat memori penuh', 'correct' => false], ['id' => 'B', 'text' => 'Mempermudah pencarian', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Ascending vs Descending', 'content' => 'Ascending artinya urut naik (A-Z / 1-10). Descending artinya urut turun (Z-A / 10-1).']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Urutan A sampai Z disebut?', [['id' => 'A', 'text' => 'Descending', 'correct' => false], ['id' => 'B', 'text' => 'Ascending', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Bubble Sort', 'content' => 'Algoritma urut paling sederhana: menukar dua angka bersebelahan jika salah urut.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Bagaimana Bubble Sort bekerja?', [['id' => 'A', 'text' => 'Ambil dari belakang', 'correct' => false], ['id' => 'B', 'text' => 'Tukar dua angka bersebelahan', 'correct' => true]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Gelembung Naik', 'content' => 'Dinamakan Bubble (gelembung) karena angka terbesar akan perlahan "naik/pindah" ke posisi paling ujung secara bertahap.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Angka terbesar pada Bubble Sort akan?', [['id' => 'A', 'text' => 'Pindah ke ujung kanan', 'correct' => true], ['id' => 'B', 'text' => 'Dihapus', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Efisiensi', 'content' => 'Meskipun mudah dibuat, Bubble Sort sangat lambat untuk mengurutkan jutaan data.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Apakah Bubble Sort cocok untuk data raksasa?', [['id' => 'A', 'text' => 'Ya, sangat cepat', 'correct' => false], ['id' => 'B', 'text' => 'Tidak, terlalu lambat', 'correct' => true]]);
    }

    private function createLogicLesson14($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'struktur-data-konsep'],
            [
                'course_id' => $course->id, 'title' => 'Struktur Data Dasar',
                'content' => 'Antrean (Queue) dan Tumpukan (Stack).', 'video_url' => null, 'order' => 14, 'xp_reward' => 60,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Tumpukan (Stack)', 'content' => 'Kerja Stack seperti tumpukan piring. Yang terakhir ditaruh adalah yang pertama kali diambil (LIFO - Last In First Out).']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Prinsip Stack (Tumpukan)?', [['id' => 'A', 'text' => 'LIFO (Terakhir Masuk, Pertama Keluar)', 'correct' => true], ['id' => 'B', 'text' => 'Random Keluar', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Tombol Undo', 'content' => 'Tombol Undo (Ctrl+Z) di komputer menggunakan sistem Tumpukan (Stack). Ingatan terakhir yang dibatalkan duluan.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Bentuk penerapan Stack adalah?', [['id' => 'A', 'text' => 'Tombol Undo', 'correct' => true], ['id' => 'B', 'text' => 'Layar sentuh', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Antrean (Queue)', 'content' => 'Kerja Queue seperti antrean kasir. Siapa yang datang duluan, ia yang dilayani duluan (FIFO - First In First Out).']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Prinsip Antrean kasir?', [['id' => 'A', 'text' => 'FIFO (Pertama Masuk, Pertama Keluar)', 'correct' => true], ['id' => 'B', 'text' => 'LIFO', 'correct' => false]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Antrean Download', 'content' => 'Sistem download file atau antrean percetakan menggunakan prinsip Queue.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Penerapan Queue (Antrean) adalah?', [['id' => 'A', 'text' => 'Antrean Printer/Download', 'correct' => true], ['id' => 'B', 'text' => 'Bermain game', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Penggabungan', 'content' => 'Dalam satu program kompleks, Stack, Queue, dan Array bisa dipakai bersamaan!']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Bisakah kita pakai banyak struktur data sekaligus?', [['id' => 'A', 'text' => 'Bisa dan Sering', 'correct' => true], ['id' => 'B', 'text' => 'Hanya boleh pilih satu', 'correct' => false]]);
    }

    private function createLogicLesson15($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'debugging-dasar'],
            [
                'course_id' => $course->id, 'title' => 'Debugging Dasar',
                'content' => 'Mencari Kutu (Error) dalam program.', 'video_url' => null, 'order' => 15, 'xp_reward' => 60,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Bug?', 'content' => 'Bug (Kutu) adalah kesalahan, cacat, atau error dalam program sehingga kode tidak berjalan semestinya.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa arti Bug dalam kodingan?', [['id' => 'A', 'text' => 'Error/Kesalahan Program', 'correct' => true], ['id' => 'B', 'text' => 'Virus mematikan', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Sejarah Kata Bug', 'content' => 'Di tahun 1947, Grace Hopper menemukan ngengat (bug) asli menempel di komputer mekanik yang membuatnya mati.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Kenapa disebut Bug?', [['id' => 'A', 'text' => 'Karena ada ngengat sungguhan masuk komputer', 'correct' => true], ['id' => 'B', 'text' => 'Singkatan dari Broken Under Ground', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Syntax Error', 'content' => 'Salah ketik! Lupa titik koma, salah kurung, atau typo kata kunci. Komputer tidak akan mau berjalan.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Lupa titik koma disebut?', [['id' => 'A', 'text' => 'Logic Error', 'correct' => false], ['id' => 'B', 'text' => 'Syntax Error', 'correct' => true]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Logic Error', 'content' => 'Kode jalan dengan baik TANPA error merah, TAPI hasilnya salah (misal: Diskon tapi harganya malah makin mahal).']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Program tidak error, tapi hasilnya salah. Ini adalah?', [['id' => 'A', 'text' => 'Logic Error (Error Logika)', 'correct' => true], ['id' => 'B', 'text' => 'Crash Sistem', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Proses Debugging', 'content' => 'Debugging butuh kesabaran. Baca pesan error dengan teliti karena di sanalah petunjuk utamanya berada.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Kunci utama membasmi bug?', [['id' => 'A', 'text' => 'Hapus semua file', 'correct' => false], ['id' => 'B', 'text' => 'Baca pesan error dengan teliti', 'correct' => true]]);
    }

    private function createLesson1($course)
    {
        // dump('Creating Lesson 1 for course: ' . $course->title);
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'apa-itu-html'],
            [
                'course_id' => $course->id,
                'title' => 'Apa itu HTML?',
                'content' => 'HTML (HyperText Markup Language) adalah bahasa standar untuk membuat halaman web.',
                'video_url' => 'https://www.youtube.com/embed/H1Q_x3z6-aA',
                'order' => 1,
                'xp_reward' => 20,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu HTML?', 'content' => 'HTML adalah singkatan dari HyperText Markup Language.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa kepanjangan dari HTML?', [
            ['id' => 'A', 'text' => 'HyperTech Markup Language', 'correct' => false],
            ['id' => 'B', 'text' => 'HyperText Markup Language', 'correct' => true],
            ['id' => 'C', 'text' => 'HighText Machine Learning', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Sejarah Singkat', 'content' => 'HTML diciptakan oleh Tim Berners-Lee pada tahun 1991.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Siapa penemu HTML?', [
            ['id' => 'A', 'text' => 'Elon Musk', 'correct' => false],
            ['id' => 'B', 'text' => 'Tim Berners-Lee', 'correct' => true],
            ['id' => 'C', 'text' => 'Mark Zuckerberg', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Bukan Bahasa Pemrograman', 'content' => 'HTML adalah bahasa markup, bukan bahasa pemrograman. Ia tidak memiliki logika seperti if/else.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Apakah HTML bahasa pemrograman?', [
            ['id' => 'A', 'text' => 'Ya', 'correct' => false],
            ['id' => 'B', 'text' => 'Tidak, itu bahasa markup', 'correct' => true],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Struktur Web', 'content' => 'HTML digunakan untuk membuat kerangka atau struktur dari sebuah halaman web.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Apa fungsi utama HTML?', [
            ['id' => 'A', 'text' => 'Membuat database', 'correct' => false],
            ['id' => 'B', 'text' => 'Membuat struktur web', 'correct' => true],
            ['id' => 'C', 'text' => 'Mengirim email', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Ekstensi File', 'content' => 'File HTML biasanya disimpan dengan ekstensi .html atau .htm.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Apa ekstensi file HTML?', [
            ['id' => 'A', 'text' => '.exe', 'correct' => false],
            ['id' => 'B', 'text' => '.html', 'correct' => true],
            ['id' => 'C', 'text' => '.doc', 'correct' => false],
        ]);
    }

    private function createLesson2($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'struktur-halaman-html'],
            [
                'course_id' => $course->id,
                'title' => 'Struktur Halaman HTML',
                'content' => 'Setiap halaman HTML memiliki struktur dasar yang terdiri dari tag html, head, dan body.',
                'video_url' => null, 'order' => 2, 'xp_reward' => 30,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Doctype', 'content' => '<!DOCTYPE html> memberi tahu browser bahwa ini adalah dokumen HTML5.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa fungsi <!DOCTYPE html>?', [
            ['id' => 'A', 'text' => 'Deklarasi versi HTML', 'correct' => true],
            ['id' => 'B', 'text' => 'Membuat link', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Tag <html>', 'content' => 'Tag <html> adalah akar (root) dari dokumen HTML.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Elemen apa yang membungkus seluruh konten HTML?', [
            ['id' => 'A', 'text' => '<html>', 'correct' => true],
            ['id' => 'B', 'text' => '<body>', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Tag <head>', 'content' => '<head> berisi meta-data, judul, dan link CSS yang tidak tampil di konten utama.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Di mana kita meletakkan judul halaman?', [
            ['id' => 'A', 'text' => '<body>', 'correct' => false],
            ['id' => 'B', 'text' => '<head>', 'correct' => true],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Tag <body>', 'content' => '<body> berisi semua konten yang terlihat oleh pengguna seperti teks dan gambar.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Konten yang tampil di browser ada di dalam tag?', [
            ['id' => 'A', 'text' => '<head>', 'correct' => false],
            ['id' => 'B', 'text' => '<body>', 'correct' => true],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Case Insensitive', 'content' => 'Tag HTML tidak sensitif huruf besar/kecil, tapi disarankan menggunakan huruf kecil.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Apakah <BODY> valid dalam HTML?', [
            ['id' => 'A', 'text' => 'Ya', 'correct' => true],
            ['id' => 'B', 'text' => 'Tidak', 'correct' => false],
        ]);
    }

    private function createLesson3($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'tag-heading'],
            [
                'course_id' => $course->id, 'title' => 'Tag Heading',
                'content' => 'HTML memiliki 6 tingkatan heading.', 'video_url' => null, 'order' => 3, 'xp_reward' => 25,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Heading?', 'content' => 'Heading digunakan untuk judul dan sub-judul pada halaman web.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Fungsi utama heading?', [['id' => 'A', 'text' => 'Menebalkan teks', 'correct' => false], ['id' => 'B', 'text' => 'Struktur judul', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Tingkatan', 'content' => 'Ada 6 tingkatan: <h1> (terbesar) sampai <h6> (terkecil).']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Berapa banyak tingkatan heading?', [['id' => 'A', 'text' => '4', 'correct' => false], ['id' => 'B', 'text' => '6', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Hierarki', 'content' => 'Gunakan <h1> hanya satu kali per halaman untuk judul utama.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Heading terbesar adalah?', [['id' => 'A', 'text' => '<h1>', 'correct' => true], ['id' => 'B', 'text' => '<h6>', 'correct' => false]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'SEO', 'content' => 'Mesin pencari menggunakan heading untuk memahami struktur konten Anda.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Heading terkecil adalah?', [['id' => 'A', 'text' => '<h1>', 'correct' => false], ['id' => 'B', 'text' => '<h6>', 'correct' => true]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Ukuran Default', 'content' => 'Browser memberikan ukuran font berbeda untuk setiap heading secara default.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Bolehkah ada banyak <h1>?', [['id' => 'A', 'text' => 'Boleh, tapi tidak disarankan', 'correct' => true], ['id' => 'B', 'text' => 'Ilegal', 'correct' => false]]);
    }

    private function createLesson4($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'paragraf-dan-teks'],
            [
                'course_id' => $course->id, 'title' => 'Paragraf dan Teks',
                'content' => 'Formatting teks dasar.', 'video_url' => null, 'order' => 4, 'xp_reward' => 25,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Paragraf', 'content' => 'Tag <p> digunakan untuk membuat paragraf teks.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Tag untuk paragraf?', [['id' => 'A', 'text' => '<p>', 'correct' => true], ['id' => 'B', 'text' => '<para>', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Bold Text', 'content' => 'Tag <b> atau <strong> membuat teks tebal.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Tag untuk teks tebal?', [['id' => 'A', 'text' => '<b>', 'correct' => true], ['id' => 'B', 'text' => '<t>', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Italic Text', 'content' => 'Tag <i> atau <em> membuat teks miring.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Apa fungsi <em>?', [['id' => 'A', 'text' => 'Miring (Emphasis)', 'correct' => true], ['id' => 'B', 'text' => 'Garis bawah', 'correct' => false]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Line Break', 'content' => 'Tag <br> digunakan untuk ganti baris tanpa membuat paragraf baru.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Tag untuk ganti baris?', [['id' => 'A', 'text' => '<lb>', 'correct' => false], ['id' => 'B', 'text' => '<br>', 'correct' => true]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Horizontal Rule', 'content' => 'Tag <hr> membuat garis horizontal pemisah.']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Tag <hr> digunakan untuk?', [['id' => 'A', 'text' => 'Garis Horizontal', 'correct' => true], ['id' => 'B', 'text' => 'Header', 'correct' => false]]);
    }

    private function createLesson5($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'membuat-link'],
            [
                'course_id' => $course->id, 'title' => 'Membuat Link',
                'content' => 'Hyperlink menghubungkan halaman web.', 'video_url' => null, 'order' => 5, 'xp_reward' => 30,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Anchor Tag', 'content' => 'Link dibuat menggunakan tag <a> (anchor).']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Tag untuk membuat link?', [['id' => 'A', 'text' => '<a>', 'correct' => true], ['id' => 'B', 'text' => '<link>', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Atribut Href', 'content' => 'href (Hypertext Reference) menentukan tujuan link.']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Atribut tujuan link?', [['id' => 'A', 'text' => 'src', 'correct' => false], ['id' => 'B', 'text' => 'href', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Target Blank', 'content' => 'target="_blank" membuka link di tab baru.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Membuka di tab baru?', [['id' => 'A', 'text' => 'target="_blank"', 'correct' => true], ['id' => 'B', 'text' => 'new="tab"', 'correct' => false]]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Link Internal', 'content' => 'Link bisa mengarah ke halaman lain dalam satu website.']);
        // 8. Quiz
        $this->createQuiz($lesson, 8, 'Apa arti "a" pada tag <a>?', [['id' => 'A', 'text' => 'Anchor', 'correct' => true], ['id' => 'B', 'text' => 'Attach', 'correct' => false]]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Link Eksternal', 'content' => 'Link bisa mengarah ke website lain (missal google.com).']);
        // 10. Quiz
        $this->createQuiz($lesson, 10, 'Bisakah link berupa gambar?', [['id' => 'A', 'text' => 'Bisa', 'correct' => true], ['id' => 'B', 'text' => 'Tidak', 'correct' => false]]);
    }

    private function createLesson6($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'menambahkan-gambar'],
            [
                'course_id' => $course->id, 'title' => 'Menambahkan Gambar',
                'content' => 'Visualisasi dengan gambar.', 'video_url' => null, 'order' => 6, 'xp_reward' => 30,
            ]);

        // 1.
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Image Tag', 'content' => 'Gambar ditambahkan dengan tag <img>.']);
        // 2.
        $this->createQuiz($lesson, 2, 'Tag untuk gambar?', [['id' => 'A', 'text' => '<image>', 'correct' => false], ['id' => 'B', 'text' => '<img>', 'correct' => true]]);

        // 3.
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Atribut Source', 'content' => 'src menentukan path atau URL gambar.']);
        // 4.
        $this->createQuiz($lesson, 4, 'Atribut lokasi gambar?', [['id' => 'A', 'text' => 'href', 'correct' => false], ['id' => 'B', 'text' => 'src', 'correct' => true]]);

        // 5.
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Alt Text', 'content' => 'alt menyediakan teks alternatif jika gambar gagal dimuat.']);
        // 6.
        $this->createQuiz($lesson, 6, 'Fungsi atribut alt?', [['id' => 'A', 'text' => 'Teks alternatif', 'correct' => true], ['id' => 'B', 'text' => 'Judul gambar', 'correct' => false]]);

        // 7.
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Ukuran', 'content' => 'width dan height bisa mengatur ukuran gambar.']);
        // 8.
        $this->createQuiz($lesson, 8, 'Atribut lebar gambar?', [['id' => 'A', 'text' => 'width', 'correct' => true], ['id' => 'B', 'text' => 'size', 'correct' => false]]);

        // 9.
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Self Closing', 'content' => 'Tag <img> tidak memiliki tag penutup (void element).']);
        // 10.
        $this->createQuiz($lesson, 10, 'Apakah <img> butuh </img>?', [['id' => 'A', 'text' => 'Ya', 'correct' => false], ['id' => 'B', 'text' => 'Tidak', 'correct' => true]]);
    }

    private function createLesson7($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'membuat-list'],
            [
                'course_id' => $course->id, 'title' => 'Membuat List',
                'content' => 'Daftar item.', 'video_url' => null, 'order' => 7, 'xp_reward' => 35,
            ]);

        // 1.
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Ordered List', 'content' => '<ol> membuat daftar berurutan (nomor).']);
        // 2.
        $this->createQuiz($lesson, 2, 'Tag list berurutan?', [['id' => 'A', 'text' => '<ol>', 'correct' => true], ['id' => 'B', 'text' => '<ul>', 'correct' => false]]);

        // 3.
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Unordered List', 'content' => '<ul> membuat daftar tidak berurutan (bullet).']);
        // 4.
        $this->createQuiz($lesson, 4, 'Tag list bullet?', [['id' => 'A', 'text' => '<ol>', 'correct' => false], ['id' => 'B', 'text' => '<ul>', 'correct' => true]]);

        // 5.
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'List Item', 'content' => '<li> digunakan untuk setiap item dalam list.']);
        // 6.
        $this->createQuiz($lesson, 6, 'Tag item list?', [['id' => 'A', 'text' => '<item>', 'correct' => false], ['id' => 'B', 'text' => '<li>', 'correct' => true]]);

        // 7.
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Nesting', 'content' => 'List bisa bersarang (list di dalam list).']);
        // 8.
        $this->createQuiz($lesson, 8, 'Apa kepanjangan <ul>?', [['id' => 'A', 'text' => 'Unordered List', 'correct' => true], ['id' => 'B', 'text' => 'Under List', 'correct' => false]]);

        // 9.
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Tipe Marker', 'content' => 'Kita bisa mengubah tipe bullet/nomor dengan CSS atau atribut type.']);
        // 10.
        $this->createQuiz($lesson, 10, 'Apa kepanjangan <ol>?', [['id' => 'A', 'text' => 'Ordered List', 'correct' => true], ['id' => 'B', 'text' => 'Org List', 'correct' => false]]);
    }

    private function createLesson8($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'tabel-sederhana'],
            [
                'course_id' => $course->id, 'title' => 'Tabel Sederhana',
                'content' => 'Data tabular.', 'video_url' => null, 'order' => 8, 'xp_reward' => 40,
            ]);

        // 1.
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Table Tag', 'content' => '<table> adalah wadah utama tabel.']);
        // 2.
        $this->createQuiz($lesson, 2, 'Tag utama tabel?', [['id' => 'A', 'text' => '<table>', 'correct' => true], ['id' => 'B', 'text' => '<tab>', 'correct' => false]]);

        // 3.
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Table Row', 'content' => '<tr> mendefinisikan baris tabel.']);
        // 4.
        $this->createQuiz($lesson, 4, 'Tag baris tabel?', [['id' => 'A', 'text' => '<td>', 'correct' => false], ['id' => 'B', 'text' => '<tr>', 'correct' => true]]);

        // 5.
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Table Data', 'content' => '<td> mendefinisikan sel data standar.']);
        // 6.
        $this->createQuiz($lesson, 6, 'Tag sel data biasa?', [['id' => 'A', 'text' => '<td>', 'correct' => true], ['id' => 'B', 'text' => '<da>', 'correct' => false]]);

        // 7.
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Table Header', 'content' => '<th> mendefinisikan sel header/judul (biasanya tebal).']);
        // 8.
        $this->createQuiz($lesson, 8, 'Tag sel header?', [['id' => 'A', 'text' => '<th>', 'correct' => true], ['id' => 'B', 'text' => '<head>', 'correct' => false]]);

        // 9.
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Border', 'content' => 'Tabel butuh CSS untuk menampilkan garis batas dengan rapi.']);
        // 10.
        $this->createQuiz($lesson, 10, '<tr> singkatan dari?', [['id' => 'A', 'text' => 'Table Row', 'correct' => true], ['id' => 'B', 'text' => 'Table Right', 'correct' => false]]);
    }

    private function createLesson9($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'formulir-html'],
            [
                'course_id' => $course->id, 'title' => 'Formulir HTML',
                'content' => 'Input pengguna.', 'video_url' => null, 'order' => 9, 'xp_reward' => 45,
            ]);

        // 1.
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Form Tag', 'content' => '<form> membungkus elemen-elemen input.']);
        // 2.
        $this->createQuiz($lesson, 2, 'Tag pembungkus form?', [['id' => 'A', 'text' => '<form>', 'correct' => true], ['id' => 'B', 'text' => '<input>', 'correct' => false]]);

        // 3.
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Input Text', 'content' => '<input type="text"> untuk isian satu baris.']);
        // 4.
        $this->createQuiz($lesson, 4, 'Input teks pendek?', [['id' => 'A', 'text' => '<textarea>', 'correct' => false], ['id' => 'B', 'text' => '<input type="text">', 'correct' => true]]);

        // 5.
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Label', 'content' => '<label> memberikan keterangan pada input.']);
        // 6.
        $this->createQuiz($lesson, 6, 'Memberi nama pada input?', [['id' => 'A', 'text' => '<label>', 'correct' => true], ['id' => 'B', 'text' => '<name>', 'correct' => false]]);

        // 7.
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Button', 'content' => '<button> atau <input type="submit"> untuk mengirim form.']);
        // 8.
        $this->createQuiz($lesson, 8, 'Tombol kirim data?', [['id' => 'A', 'text' => 'Submit', 'correct' => true], ['id' => 'B', 'text' => 'Send', 'correct' => false]]);

        // 9.
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Atribut Action', 'content' => 'action menentukan ke mana data dikirim.']);
        // 10.
        $this->createQuiz($lesson, 10, 'Input password?', [['id' => 'A', 'text' => 'type="secret"', 'correct' => false], ['id' => 'B', 'text' => 'type="password"', 'correct' => true]]);
    }

    private function createLesson10($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'html-semantik'],
            [
                'course_id' => $course->id, 'title' => 'HTML Semantik',
                'content' => 'Makna elemen.', 'video_url' => null, 'order' => 10, 'xp_reward' => 50,
            ]);

        // 1.
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Semantik?', 'content' => 'Semantik berarti "memiliki makna". Elemen semantik menjelaskan artinya kepada browser.']);
        // 2.
        $this->createQuiz($lesson, 2, 'Mengapa pakai semantik?', [['id' => 'A', 'text' => 'SEO & Aksesibilitas', 'correct' => true], ['id' => 'B', 'text' => 'Biar keren', 'correct' => false]]);

        // 3.
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Non-Semantik', 'content' => '<div> dan <span> adalah contoh elemen non-semantik (tidak punya arti khusus).']);
        // 4.
        $this->createQuiz($lesson, 4, 'Contoh non-semantik?', [['id' => 'A', 'text' => '<span>', 'correct' => true], ['id' => 'B', 'text' => '<footer>', 'correct' => false]]);

        // 5.
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => '<header> & <footer>', 'content' => 'Digunakan untuk bagian kepala dan kaki halaman/artikel.']);
        // 6.
        $this->createQuiz($lesson, 6, 'Untuk bagian bawah web?', [['id' => 'A', 'text' => '<bottom>', 'correct' => false], ['id' => 'B', 'text' => '<footer>', 'correct' => true]]);

        // 7.
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => '<nav>', 'content' => 'Digunakan khusus untuk blok navigasi/menu.']);
        // 8.
        $this->createQuiz($lesson, 8, 'Contoh elemen semantik?', [['id' => 'A', 'text' => '<div>', 'correct' => false], ['id' => 'B', 'text' => '<nav>', 'correct' => true]]);

        // 9.
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => '<article>', 'content' => 'Untuk konten mandiri seperti posting blog atau berita.']);
        // 10.
        $this->createQuiz($lesson, 10, 'Untuk artikel blog?', [['id' => 'A', 'text' => '<article>', 'correct' => true], ['id' => 'B', 'text' => '<section>', 'correct' => false]]);
    }

    private function createQuiz($lesson, $order, $question, $options)
    {
        $lesson->slides()->firstOrCreate(
            ['order' => $order],
            [
                'type' => 'quiz',
                'title' => 'Kuis',
                'content' => $question,
                'options' => $options,
            ]);
    }

    private function createMathLessons($course)
    {
        $adventures = [
            [
                'title' => 'Kebun Apel Kakek',
                'story' => 'Hari ini kita membantu Kakek memanen apel merah yang manis di kebun.',
                'trivias' => [
                    'Di pohon pertama, kita menemukan 1 apel besar yang bersinar di bawah matahari!',
                    'Kakek menunjuk dahan lain, oh lihat! Ada 2 apel kembar yang saling berdempetan.',
                    'Angka 3 seperti sayap burung. Kita menemukan 3 apel bersembunyi di balik daun.',
                    'Keranjang kita mulai terisi. 4 apel merah siap dibawa pulang untuk dibuat pai!',
                    'Hore! Kita melengkapi keranjang dengan 5 apel. Angka 5 seperti kail pancing yang melengkung.',
                ],
                'quizzes' => [
                    ['q' => 'Berapa apel yang pertama kali kita temukan di pohon?', 'options' => ['1 apel' => true, '3 apel' => false, '5 apel' => false]],
                    ['q' => 'Dua apel yang saling berdempetan disebut apel apa kata Kakek?', 'options' => ['Apel Raksasa' => false, 'Apel Kembar' => true, 'Apel Jatuh' => false]],
                    ['q' => 'Bentuk angka apa yang mirip dengan sayap burung terbang?', 'options' => ['Angka 1' => false, 'Angka 5' => false, 'Angka 3' => true]],
                    ['q' => 'Setelah ada 3 apel, kakek menambah 1 lagi. Jadi berapa?', 'options' => ['4 apel' => true, '2 apel' => false, '5 apel' => false]],
                    ['q' => 'Berapa total apel di dalam keranjang pai kita?', 'options' => ['10 apel' => false, '5 apel' => true, '3 apel' => false]],
                ],
            ],
            [
                'title' => 'Misi Penyelamatan Bintang',
                'story' => 'Malam ini, ada bintang-bintang kecil yang jatuh dari langit. Misi kita adalah mengumpulkannya!',
                'trivias' => [
                    'Bintang pertama hingga kelima sudah aman. Wah, lihat ada 1 bintang lagi! Sekarang kita punya 6 bintang.',
                    'Angka 7 seperti tongkat kakek sihir. Kita menggunakan tongkat untuk meraih bintang ke-7.',
                    'Dua lingkaran bersusun membentuk angka 8. Kita menemukan 8 bintang membentuk rasi salju.',
                    '9 adalah angka ajaib sebelum sepuluh! Bintang ke-9 bersembunyi di balik awan tebal.',
                    'Hebat Kapten! Kita mengumpulkan 10 bintang bercahaya. 10 adalah 1 dan 0 yang bergandengan!',
                ],
                'quizzes' => [
                    ['q' => 'Berapa bintang yang kita punya setelah menambah 1 pada 5 bintang awal?', 'options' => ['6 Bintang' => true, '7 Bintang' => false, '10 Bintang' => false]],
                    ['q' => 'Angka berapa yang bentuknya seperti tongkat kakek sihir?', 'options' => ['Angka 9' => false, 'Angka 7' => true, 'Angka 6' => false]],
                    ['q' => 'Jika kita punya 7 bintang laut dan menemukan 1 lagi, totalnya menjadi?', 'options' => ['9 bintang' => false, '8 bintang' => true, '10 bintang' => false]],
                    ['q' => 'Di mana bintang ke-9 bersembunyi?', 'options' => ['Di dalam air' => false, 'Di balik bulan' => false, 'Di balik awan tebal' => true]],
                    ['q' => 'Terdiri dari angka berapakah bilangan 10?', 'options' => ['1 dan 0' => true, '1 dan 1' => false, '0 dan 1' => false]],
                ],
            ],
            [
                'title' => 'Toko Permen Manis',
                'story' => 'Selamat datang di Toko Permen! Di sini kita akan belajar menjumlahkan permen-permen lezat.',
                'trivias' => [
                    'Paman Beruang punya 2 permen loli merah bata, lalu Bibi Kelinci memberinya 1 permen biru. Totalnya 3 permen!',
                    'Penjumlahan itu bertambah banyak. Tanda tambah (+) bentuknya seperti palang pintu menyilangkan tangan.',
                    'Jika kita punya 3 permen karet muda dan membeli 2 permen coklat, sekarang kantong kita isinya 5 permen.',
                    'Lihat toples itu! Ada 4 permen kapas di kiri dan 4 permen jahe di kanan. Jika disatukan menjadi 8 permen.',
                    'Jika kita punya 5 marshmallow dan ditambahkan 5 bungkus misis, total menjadi 10! Angka yang sangat sempurna.',
                ],
                'quizzes' => [
                    ['q' => 'Berapa hasil dari 2 permen ditambah 1 permen?', 'options' => ['4 permen' => false, '3 permen' => true, '5 permen' => false]],
                    ['q' => 'Seperti apakah bentuk tanda (+)?', 'options' => ['Garis miring' => false, 'Lingkaran penuh' => false, 'Palang yang menyilang' => true]],
                    ['q' => '3 permen karet + 2 permen coklat = ...?', 'options' => ['5 permen' => true, '6 permen' => false, '4 permen' => false]],
                    ['q' => '4 permen kapas + 4 permen jahe = ...?', 'options' => ['9 permen' => false, '8 permen' => true, '10 permen' => false]],
                    ['q' => 'Berapa jumlah dari 5 + 5?', 'options' => ['10' => true, '9' => false, '15' => false]],
                ],
            ],
            [
                'title' => 'Balon Udara yang Bocor',
                'story' => 'Oh tidak! Balon udara kita kelebihan beban dan beberapa karung pasir harus dibuang ke bawah.',
                'trivias' => [
                    'Pengurangan artinya mengurangi jumlah. Tandanya adalah strip (-) seperti tali tipis panjang.',
                    'Kita membawa 5 karung pasir. Jika 1 karung dibuang, maka balon menjadi ringan dan sisa karung adalah 4.',
                    'Tiba-tiba tiupan angin mematahkan 2 dari 4 tali tiang layar kita. Kini layar hanya diikat oleh 2 tali saja.',
                    'Ada 7 burung camar hinggap di balon. Karena kaget mendengarkan terompet, 3 ekor terbang jauh. Tersisa 4 camar.',
                    'Pengurangan dengan bilangan yang sama akan menghasilkan 0 (NOL). Berarti habis tak tersisa!',
                ],
                'quizzes' => [
                    ['q' => 'Apa lambang dari pengurangan?', 'options' => ['Silang (X)' => false, 'Strip (-)' => true, 'Titik dua (:)' => false]],
                    ['q' => '5 karung dikurang 1 karung hasilnya berapa?', 'options' => ['4 karung' => true, '3 karung' => false, '5 karung' => false]],
                    ['q' => '4 tali layar putus 2, sisa berapa tali yang menahan?', 'options' => ['1 tali' => false, '3 tali' => false, '2 tali' => true]],
                    ['q' => '7 ekor burung camar dikurangi 3 ekor yang terbang sisa berapa?', 'options' => ['4 ekor' => true, '5 ekor' => false, '2 ekor' => false]],
                    ['q' => 'Apa hasil dari perhitungan 5 dikurangi 5 ?', 'options' => ['10' => false, '5' => false, '0' => true]],
                ],
            ],
            [
                'title' => 'Buru Harta Karun Laut',
                'story' => 'Menyelam ke samudra dalam untuk mengumpulkan koin emas peninggalan bajak laut legendaris!',
                'trivias' => [
                    'Setelah 10 adalah belasan! 10 koin emas ditambah 1 koin perak menjadi 11 koin yang berkelip.',
                    'Angka belasan diawali angka 1. Contoh, 10 + 4 = 14 kerang mutiara purba. 14 dinamakan empat belas.',
                    'Kita bertemu 15 kuda laut kecil berbaris-baris. 15 terdiri dari angka 1 dan 5 bersandingan.',
                    'Gurita raksasa menjaga 18 berlian! Wah, 18 adalah jumlah yang besar, delapan belas buah.',
                    'Dua puluhan! Jika kita punya 10 kepiting dan 10 kerang, total kawan laut kita adalah 20 ekor.',
                ],
                'quizzes' => [
                    ['q' => '10 koin emas + 1 koin perak menjadi angka berapa?', 'options' => ['12' => false, '11' => true, '10' => false]],
                    ['q' => 'Bagaimana kita menyebut angka 14?', 'options' => ['Dua Belas' => false, 'Empat Belas' => true, 'Satu Empat' => false]],
                    ['q' => 'Terdiri dari angka apa saja bilangan 15?', 'options' => ['1 dan 5' => true, '5 dan 0' => false, '1 dan 4' => false]],
                    ['q' => 'Berapa jumlah berlian yang dijaga si gurita raksasa?', 'options' => ['18 buah' => true, '19 buah' => false, '20 buah' => false]],
                    ['q' => 'Jika kita memiliki 10 puluhan ditambah 10 puluhan, hasilnya?', 'options' => ['20' => true, '30' => false, '100' => false]],
                ],
            ],
            [
                'title' => 'Peternakan Ayam Ceria',
                'story' => 'Ayam-ayam di peternakan baru saja bertelur. Ayo bantu Paman Peternak menghitungnya!',
                'trivias' => [
                    'Ayam Jago Putih punya 10 telur, lalu Ayam Betina Coklat menetaskan 5 telur lagi. Totalnya 15!',
                    'Menghitung belasan gampang! Simpan angka di otak dan pakai jari. 12 + 3, ucapkan 12, lalu hitung jari 13, 14, 15.',
                    'Di keranjang kiri ada 8 telur, di keranjang kanan 8 telur. Hasilnya 16! Ini namanya penjumlahan ganda.',
                    'Wah, seekor induk menemukan 11 telur emas, temannya memberi 6 telur perak. Totalnya 17 butir.',
                    'Tahukah kapten? 10 telur bebek + 10 telur angsa berarti peternakan menetas secara berlimpah, 20 anak unggas!',
                ],
                'quizzes' => [
                    ['q' => '10 telur putih + 5 telur coklat sama dengan?', 'options' => ['15' => true, '16' => false, '14' => false]],
                    ['q' => 'Trik menjumlahkan 12 + 3 adalah?', 'options' => ['Hitung terus dengan jari dari 12' => true, 'Menghitung dari 1' => false, 'Menebak' => false]],
                    ['q' => 'Jika 8 ditambah 8, hasilnya menjadi bilangan penjumlahan ganda yaitu?', 'options' => ['15' => false, '16' => true, '18' => false]],
                    ['q' => 'Berapakah 11 telur emas ditambah 6 telur perak?', 'options' => ['17' => true, '16' => false, '18' => false]],
                    ['q' => '10 anak bebek ditambah 10 anak angsa menghasilkan berapa anak unggas?', 'options' => ['25' => false, '15' => false, '20' => true]],
                ],
            ],
            [
                'title' => 'Pesta Makan Es Krim',
                'story' => 'Waktunya pesta es krim! Sayangnya es krim cepat meleleh karena matahari.',
                'trivias' => [
                    'Kita punya 15 es krim vanila. Jika 3 meleleh tumpah ke tanah, sisa es krim adalah 12.',
                    'Ada 18 mangkuk sundae. Teman-teman mengambil 8 mangkuk. Tinggal 10 mangkuk yang utuh!',
                    'Pengurangan angka belasan bisa dilakukan dengan mundur. Seperti 14 mundur 2 langkah (13, 12).',
                    'Paman Pinguin menjaga 20 balok es batu mini. Namun 5 telah mencair. Balok es tersisa 15.',
                    'Pengurangan itu mengurangi jumlah aslimu. Semakin banyak dikurangi, angkanya semakin kecil!',
                ],
                'quizzes' => [
                    ['q' => '15 es krim vanila dikurang 3 yang leleh, hasilnya?', 'options' => ['12 es krim' => true, '11 es krim' => false, '10 es krim' => false]],
                    ['q' => '18 sundae dikurangi 8 yang diambil teman. Sisanya?', 'options' => ['10' => true, '8' => false, '12' => false]],
                    ['q' => 'Bagaimana cara mudah mengurangkan angka kecil dari belasan?', 'options' => ['Hitung mundur pada garis bilangan' => true, 'Menambahkan' => false, 'Hilangkan puluhan' => false]],
                    ['q' => '20 balok es batu dikurangi 5 yang cair menyisakan?', 'options' => ['15 balok' => true, '25 balok' => false, '10 balok' => false]],
                    ['q' => 'Coba hitung dengan mundur: 16 - 4 = ?', 'options' => ['13' => false, '12' => true, '14' => false]],
                ],
            ],
            [
                'title' => 'Katak yang Melompat',
                'story' => 'Di tepi rawa biru, ada Katak Hijau yang suka melompat batu ke batu dengan irama berulang.',
                'trivias' => [
                    'Katak melompat dua langkah! Dari 2, ia lompat ke 4, lalu ke 6. Ini lompatan Genap.',
                    'Pola itu seperti aturan pasti. Melompat ditambah 2 terus menerus dinamakan Pola bilangan.',
                    'Di daun Teratai besar, Katak Oranye melompat ganjil: 1, 3, 5! Dia selalu melewati daun di antaranya.',
                    'Ada Katak Super yang lompatnya lima lompatan: 5, 10, 15, lalu mendarat di 20!',
                    'Setiap lompatan katak bernilai selisih konstan. Itulah yang dinamakan pola melompat.',
                ],
                'quizzes' => [
                    ['q' => 'Jika katak ada di batu angka 6 dan lompat 2 bilangan lagi, ia mendarat di mana?', 'options' => ['7' => false, '8' => true, '9' => false]],
                    ['q' => 'Deret 2 - 4 - 6 disebut pola apa?', 'options' => ['Pola Ganjil' => false, 'Teratai' => false, 'Pola Genap (+2)' => true]],
                    ['q' => 'Jika Katak Oranye lompat ganjil (1, 3, 5), batu mana setelah 5?', 'options' => ['7' => true, '8' => false, '6' => false]],
                    ['q' => 'Katak Super lompat (5, 10, 15). Ke mana ia mendarat setelah 15?', 'options' => ['18' => false, '20' => true, '25' => false]],
                    ['q' => 'Apa syarat agar sebuah deret angka disebut Pola Bilangan?', 'options' => ['Lompatan acak' => false, 'Punya selisih teratur yang sama' => true, 'Angkanya besar' => false]],
                ],
            ],
            [
                'title' => 'Mengecat Istana Raja',
                'story' => 'Raja minta kita merapikan dinding kerajaan dengan stiker cat berbentuk geometris!',
                'trivias' => [
                    'Jendela Menara berbentuk Bulat seperti koin. Ini namanya Lingkaran. Ia tidak punya sudut lancip!',
                    'Pintu gerbang berbentuk panjang ke atas dan lebarnya berbeda. Itulah si Persegi Panjang!',
                    'Puncak pilar menara meruncing di atas. Itu adalah Segitiga karena memiliki tiga sudut potong.',
                    'Lantai istana dipasangi ubin dengan ukuran keempat sisi sama persis! Itulah si Persegi utuh.',
                    'Semua bentuk ini dipelajari dalam Geometri. Lingkaran adalah satu-satunya yang gampang bergulir.',
                ],
                'quizzes' => [
                    ['q' => 'Bangun manakah yang mirip dengan koin logam?', 'options' => ['Segitiga' => false, 'Lingkaran' => true, 'Persegi' => false]],
                    ['q' => 'Bentuk pintu yang ukurannya panjang dan lebar berbeda adalah?', 'options' => ['Persegi Panjang' => true, 'Lingkaran Bawah' => false, 'Kotak Sempurna' => false]],
                    ['q' => 'Berapa jumlah titik sudut pada atap pilar Segitiga?', 'options' => ['4 titik' => false, '0 titik' => false, '3 titik' => true]],
                    ['q' => 'Bentuk ubin lantai yang keempat sisi pembatasnya sama persis dinamakan apa?', 'options' => ['Persegi' => true, 'Persegi Panjang' => false, 'Segitiga' => false]],
                    ['q' => 'Siapa yang paling mungkin menggelinding jika dijatuhkan ke bawah bukit?', 'options' => ['Kotak' => false, 'Lingkaran' => true, 'Segitiga' => false]],
                ],
            ],
            [
                'title' => 'Melawan Naga Kalkulator',
                'story' => 'Seekor Naga Perkasa menghalangi jalan. Jawab 5 teka-tekinya dari semua ilmu! Tunjukkan kekuatan perhitunganmu.',
                'trivias' => [
                    'Naga: Berapa 7 pedang ditambah 2 pedang? Ingat Penjumlahan!',
                    'Naga: Berapa 16 tameng jika dipukul hilang 4? Kurangi pelan-pelan ke belakang!',
                    'Naga: Aku menyukai tebak-tebakan. Pola apa ini: 10, 12, 14, __?',
                    'Naga: Dari atas awan, piramida terlihat berbentuk apa?',
                    'Kamu sangat hebat Kapten. Bersiaplah untuk menyerang ujian terakhirku yang menggabungkan tambah dan kurang!',
                ],
                'quizzes' => [
                    ['q' => 'Tantangan 1 Naga: 7 + 2 = ?', 'options' => ['8' => false, '9' => true, '10' => false]],
                    ['q' => 'Tantangan 2 Naga: 16 - 4 = ?', 'options' => ['11' => false, '12' => true, '13' => false]],
                    ['q' => 'Tantangan 3 Naga: Jika polanya 10, 12, 14, berapakah bilangan berikutnya?', 'options' => ['18' => false, '16' => true, '20' => false]],
                    ['q' => 'Tantangan 4 Naga: Bangun apa yang menyerupai bentuk luar Piramida Mesir Kuno?', 'options' => ['Lingkaran' => false, 'Segitiga' => true, 'Bujur Sangkar' => false]],
                    ['q' => 'Tantangan Final: Uang sebanyak 10 koin, dipakai 3 koin, ditambahkan lagi hadiah 1 koin. Berapa sisanya?', 'options' => ['8 koin' => true, '7 koin' => false, '9 koin' => false]],
                ],
            ],
        ];

        foreach ($adventures as $index => $adventure) {
            $lesson = $course->lessons()->updateOrCreate(
                ['title' => $adventure['title']],
                [
                    'slug' => \Illuminate\Support\Str::slug($adventure['title']),
                    'order' => $index + 1,
                    'xp_reward' => 50,
                    'icon' => $course->icon,
                ]
            );

            for ($i = 0; $i < 5; $i++) {
                // Text Slide
                $lesson->slides()->updateOrCreate(
                    ['order' => ($i * 2) + 1],
                    [
                        'type' => 'text',
                        'title' => 'Petunjuk Cerita '.($i + 1),
                        'content' => $adventure['trivias'][$i],
                    ]
                );

                // Quiz Slide
                $quizData = $adventure['quizzes'][$i];
                $options = [];
                $letters = ['A', 'B', 'C', 'D'];
                $optionIndex = 0;
                foreach ($quizData['options'] as $text => $isCorrect) {
                    $options[] = [
                        'id' => $letters[$optionIndex],
                        'text' => (string) $text,
                        'correct' => (bool) $isCorrect,
                    ];
                    $optionIndex++;
                }

                $lesson->slides()->updateOrCreate(
                    ['order' => ($i * 2) + 2],
                    [
                        'type' => 'quiz',
                        'title' => 'Tantangan '.($i + 1),
                        'content' => $quizData['q'],
                        'options' => $options,
                    ]
                );
            }
        }
    }
}
