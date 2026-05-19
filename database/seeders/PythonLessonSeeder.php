<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CreatesQuiz;

class PythonLessonSeeder extends Seeder
{
    use CreatesQuiz;

    public function run(): void
    {
        $course = Course::where('title', 'Python Development')->first();
        if (!$course) return;

        $this->createPythonLesson1($course);
        $this->createPythonLesson2($course);
        $this->createPythonLesson3($course);
        $this->createPythonLesson4($course);
        $this->createPythonLesson5($course);
        $this->createPythonLesson6($course);
        $this->createPythonLesson7($course);
        $this->createPythonLesson8($course);
        $this->createPythonLesson9($course);
        $this->createPythonLesson10($course);
        $this->createPythonLesson11($course);
        $this->createPythonLesson12($course);
        $this->createPythonLesson13($course);
        $this->createPythonLesson14($course);
        $this->createPythonLesson15($course);
        $this->createPythonLesson16($course);
        $this->createPythonLesson17($course);
        $this->createPythonLesson18($course);
        $this->createPythonLesson19($course);
        $this->createPythonLesson20($course);
    }

    private function createPythonLesson1($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pengenalan-python'],
            [
                'course_id' => $course->id, 'title' => 'Pengenalan Python',
                'content' => 'Berkenalan dengan ular piton yang ramah.', 'video_url' => null, 'order' => 1, 'xp_reward' => 20,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Python?', 'content' => 'Python adalah bahasa pemrograman yang super populer, mudah dibaca seperti bahasa Inggris, dan serba bisa! Mulai dari bikin web, game, AI, hingga robotika.']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa keunggulan utama bahasa Python?', [['id' => 'A', 'text' => 'Hanya untuk bikin game', 'correct' => false], ['id' => 'B', 'text' => 'Mudah dibaca dan dipelajari', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Fungsi print()', 'content' => 'Untuk menyuruh Python berbicara atau menampilkan sesuatu ke layar, kita menggunakan perintah `print()`. Contoh: `print("Halo Dunia!")`']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Perintah apa yang digunakan untuk menampilkan teks ke layar di Python?', [['id' => 'A', 'text' => 'echo()', 'correct' => false], ['id' => 'B', 'text' => 'print()', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Tanda Kutip', 'content' => 'Teks di dalam perintah print() harus diapit oleh tanda kutip ganda ("") atau tunggal (\'\'). Tanpa tanda kutip, Python akan kebingungan!']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Penulisan print yang benar adalah?', [['id' => 'A', 'text' => 'print(Halo)', 'correct' => false], ['id' => 'B', 'text' => 'print("Halo")', 'correct' => true]]);

        // 7. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 7], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Halo Python 🐍',
            'content' => 'Susun kode untuk mencetak ucapan selamat datang.',
            'options' => [
                ['id' => 0, 'text' => 'print('],
                ['id' => 1, 'text' => '"Selamat datang di dunia Python!"'],
                ['id' => 2, 'text' => ')'],
            ],
            'correct_answer' => null,
            'explanation' => 'Perintah print() diawali nama fungsi, kurung buka, teks dalam kutip, lalu ditutup dengan kurung tutup.',
        ]);

        // 8. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi Kode Print! 📝',
            'content' => 'Isi bagian yang kosong untuk mencetak nama kamu.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '("Nama saya adalah Budi"'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'print', 'color' => 'blue'],
                ['id' => 2, 'text' => ')', 'color' => 'orange'],
                ['id' => 3, 'text' => 'echo', 'color' => 'purple'], // distractor
            ]),
            'explanation' => 'Fungsi print selalu memerlukan tanda kurung.',
        ]);

        // 9. Minigame: Block Code
        $lesson->slides()->firstOrCreate(['order' => 9], [
            'type' => 'block_code',
            'title' => 'Robot Menyapa 🤖',
            'content' => 'Susun blok agar robot menyapa dunia dua kali.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'print("Halo Dunia!")'],
                ['id' => 2, 'type' => 'action', 'text' => 'print("Halo lagi!")'],
                ['id' => 3, 'type' => 'logic', 'text' => 'if benar:'],
            ],
            'correct_answer' => '1,2',
            'explanation' => 'Kode di Python dieksekusi berurutan dari atas ke bawah.',
        ]);
    }

    private function createPythonLesson2($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'variabel-tipe-data-python'],
            [
                'course_id' => $course->id, 'title' => 'Variabel & Tipe Data Dasar',
                'content' => 'Menyimpan data ke dalam kotak memori.', 'video_url' => null, 'order' => 2, 'xp_reward' => 30,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Membuat Variabel', 'content' => 'Di Python, membuat variabel sangat mudah! Tidak perlu repot-repot pakai kata kunci "var" atau "int". Cukup ketik namanya, tanda sama dengan (=), dan nilainya. Contoh: `nama = "Budi"`']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Cara membuat variabel umur dengan nilai 15 di Python adalah?', [['id' => 'A', 'text' => 'int umur = 15', 'correct' => false], ['id' => 'B', 'text' => 'umur = 15', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Tipe Data Dasar', 'content' => "1. **Integer** (Angka bulat): `skor = 100`\n2. **Float** (Desimal): `berat = 50.5`\n3. **String** (Teks): `nama = 'Siti'`\n4. **Boolean** (Benar/Salah): `lulus = True`"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Tipe data dari `nilai = 8.5` adalah?', [['id' => 'A', 'text' => 'Integer', 'correct' => false], ['id' => 'B', 'text' => 'Float', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Huruf Kapital pada Boolean', 'content' => 'Hati-hati! Di Python, nilai Boolean harus diawali huruf kapital: `True` dan `False`. Jika kamu menulis `true` atau `false`, Python akan error.']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Penulisan boolean yang BENAR di Python adalah?', [['id' => 'A', 'text' => 'is_playing = True', 'correct' => true], ['id' => 'B', 'text' => 'is_playing = true', 'correct' => false]]);

        // 7. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 7], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Biodata 📇',
            'content' => 'Susun kode untuk membuat variabel biodata lalu mencetaknya.',
            'options' => [
                ['id' => 0, 'text' => 'nama = "Joko"'],
                ['id' => 1, 'text' => 'umur = 20'],
                ['id' => 2, 'text' => 'print(nama)'],
                ['id' => 3, 'text' => 'print(umur)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Kita harus mendefinisikan (membuat) variabelnya terlebih dahulu sebelum bisa mencetaknya dengan print().',
        ]);

        // 8. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Tipe Data yang Tepat! 🧩',
            'content' => 'Lengkapi tipe data berikut.',
            'options' => [
                ['type' => 'text', 'value' => 'uang = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => "\npesan = "],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => "\nberhasil = "],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '50000', 'color' => 'blue'],
                ['id' => 2, 'text' => '"Halo!"', 'color' => 'green'],
                ['id' => 3, 'text' => 'True', 'color' => 'orange'],
            ]),
            'explanation' => 'Angka tanpa kutip, teks pakai kutip, boolean harus True/False kapital.',
        ]);

        // 9. Minigame: Block Code
        $lesson->slides()->firstOrCreate(['order' => 9], [
            'type' => 'block_code',
            'title' => 'Game Skor 🎮',
            'content' => 'Buat variabel skor, lalu tampilkan!',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'skor = 100'],
                ['id' => 2, 'type' => 'action', 'text' => 'print(skor)'],
                ['id' => 3, 'type' => 'action', 'text' => 'skor = "Seratus"'],
                ['id' => 4, 'type' => 'logic', 'text' => 'True'],
            ],
            'correct_answer' => '1,2',
            'explanation' => 'skor diset menjadi angka 100 (Integer), lalu diprint nilainya.',
        ]);
    }

    private function createPythonLesson3($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'operator-python'],
            [
                'course_id' => $course->id, 'title' => 'Operator Matematika & Logika',
                'content' => 'Menghitung dan membandingkan layaknya kalkulator super.', 'video_url' => null, 'order' => 3, 'xp_reward' => 35,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Matematika Dasar', 'content' => "Python bisa jadi kalkulator!\nPenjumlahan: `+`\nPengurangan: `-`\nPerkalian: `*`\nPembagian: `/` (hasilnya Float)\nSisa Bagi (Modulo): `%`"]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Simbol apa yang digunakan untuk perkalian di Python?', [['id' => 'A', 'text' => 'x', 'correct' => false], ['id' => 'B', 'text' => '*', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Pangkat dan Modulo', 'content' => 'Untuk memangkatkan angka, gunakan `**` (contoh: `2 ** 3` artinya 2 pangkat 3 = 8). Modulo `%` digunakan untuk mencari sisa pembagian (contoh: `10 % 3` hasilnya 1).']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Berapa hasil dari `5 % 2`?', [['id' => 'A', 'text' => '1', 'correct' => true], ['id' => 'B', 'text' => '2.5', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Operator Logika', 'content' => 'Di Python, operator logika menggunakan kata bahasa Inggris biasa: `and`, `or`, dan `not`. Ini jauh lebih mudah dibaca daripada simbol `&&` atau `||` di bahasa lain!']);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Bagaimana cara menulis "A dan B" di Python?', [['id' => 'A', 'text' => 'A and B', 'correct' => true], ['id' => 'B', 'text' => 'A && B', 'correct' => false]]);

        // 7. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 7], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Kalkulator 🧮',
            'content' => 'Susun kode untuk menghitung luas persegi panjang.',
            'options' => [
                ['id' => 0, 'text' => 'panjang = 10'],
                ['id' => 1, 'text' => 'lebar = 5'],
                ['id' => 2, 'text' => 'luas = panjang * lebar'],
                ['id' => 3, 'text' => 'print(luas)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Variabel didefinisikan dulu, lalu dikalikan, hasilnya disimpan di variabel luas, lalu diprint.',
        ]);

        // 8. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Hitungan Ajaib! ✨',
            'content' => 'Lengkapi operator untuk menghitung sisa bagi dan pangkat.',
            'options' => [
                ['type' => 'text', 'value' => 'sisa_bagi = 10 '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' 3\npangkat = 2 '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' 3'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '%', 'color' => 'blue'],
                ['id' => 2, 'text' => '**', 'color' => 'orange'],
                ['id' => 3, 'text' => '/', 'color' => 'purple'], // distractor
            ]),
            'explanation' => '% adalah modulo (sisa bagi), ** adalah eksponen (pangkat).',
        ]);

        // 9. Minigame: Block Code
        $lesson->slides()->firstOrCreate(['order' => 9], [
            'type' => 'block_code',
            'title' => 'Logika True/False ⚖️',
            'content' => 'Susun blok agar program mengevaluasi logika AND.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'a = True'],
                ['id' => 2, 'type' => 'action', 'text' => 'b = False'],
                ['id' => 3, 'type' => 'action', 'text' => 'hasil = a and b'],
                ['id' => 4, 'type' => 'action', 'text' => 'print(hasil)'],
                ['id' => 5, 'type' => 'action', 'text' => 'hasil = a && b'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Python menggunakan kata `and`, bukan `&&`.',
        ]);
    }

    private function createPythonLesson4($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'struktur-kontrol-if-else'],
            [
                'course_id' => $course->id, 'title' => 'Struktur Kontrol: If-Else',
                'content' => 'Membuat program yang bisa mengambil keputusan.', 'video_url' => null, 'order' => 4, 'xp_reward' => 40,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Percabangan if', 'content' => "Python menggunakan indentasi (spasi menjorok ke dalam) untuk menandai blok kode. Contoh:\n`if nilai > 80:`\n`    print(\"Lulus!\")`\nJangan lupakan titik dua (:) di akhir statement if!"]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa tanda yang wajib ada di akhir baris "if" di Python?', [['id' => 'A', 'text' => 'Titik Koma (;)', 'correct' => false], ['id' => 'B', 'text' => 'Titik Dua (:)', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Indentasi itu WAJIB', 'content' => 'Di bahasa lain, blok if ditandai dengan kurung kurawal `{}`. Di Python, kamu **wajib** menggunakan spasi (biasanya 4 spasi atau 1 tab). Jika salah indentasi, Python akan error (IndentationError).']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Bagaimana cara Python mengenali kode yang ada di dalam blok if?', [['id' => 'A', 'text' => 'Menggunakan Indentasi (spasi/tab)', 'correct' => true], ['id' => 'B', 'text' => 'Menggunakan kurung kurawal {}', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'elif dan else', 'content' => "Jika ingin mengecek kondisi lain, gunakan `elif` (singkatan dari else if).\nJika semua kondisi salah, gunakan `else`.\nContoh:\n`if nilai == 100:`\n`    print('Sempurna')`\n`elif nilai >= 80:`\n`    print('Bagus')`\n`else:`\n`    print('Belajar lagi')`"]);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Apa kata kunci untuk "Else If" di Python?', [['id' => 'A', 'text' => 'elseif', 'correct' => false], ['id' => 'B', 'text' => 'elif', 'correct' => true]]);

        // 7. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 7], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Lampu Lalu Lintas 🚦',
            'content' => 'Susun kode if-elif-else ini dengan benar.',
            'options' => [
                ['id' => 0, 'text' => 'if warna == "merah":'],
                ['id' => 1, 'text' => '    print("Berhenti")'],
                ['id' => 2, 'text' => 'elif warna == "kuning":'],
                ['id' => 3, 'text' => '    print("Hati-hati")'],
                ['id' => 4, 'text' => 'else:'],
                ['id' => 5, 'text' => '    print("Jalan")'],
            ],
            'correct_answer' => null,
            'explanation' => 'Perhatikan indentasi di bawah setiap if/elif/else. Mereka menandakan baris tersebut milik kondisi di atasnya.',
        ]);

        // 8. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi Kondisi! 📝',
            'content' => 'Isi bagian yang kosong untuk membuat logika kelulusan.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' nilai >= 75'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => "\n    print(\"Lulus\")\n"],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ':\n    print("Gagal")'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'if', 'color' => 'blue'],
                ['id' => 2, 'text' => ':', 'color' => 'orange'],
                ['id' => 3, 'text' => 'else', 'color' => 'green'],
            ]),
            'explanation' => 'Kata kunci `if`, diikuti titik dua `:`, lalu blok `else` untuk sisanya.',
        ]);

        // 9. Minigame: Block Code
        $lesson->slides()->firstOrCreate(['order' => 9], [
            'type' => 'block_code',
            'title' => 'Batas Umur 🔞',
            'content' => 'Susun logika untuk mengecek apakah umur >= 18.',
            'options' => [
                ['id' => 1, 'type' => 'logic', 'text' => 'if umur >= 18:'],
                ['id' => 2, 'type' => 'action', 'text' => '    print("Boleh masuk")'],
                ['id' => 3, 'type' => 'logic', 'text' => 'else:'],
                ['id' => 4, 'type' => 'action', 'text' => '    print("Tidak boleh")'],
                ['id' => 5, 'type' => 'action', 'text' => 'if umur > 18 {'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Python menggunakan titik dua dan indentasi, bukan kurung kurawal.',
        ]);
    }

    private function createPythonLesson5($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'struktur-data-list'],
            [
                'course_id' => $course->id, 'title' => 'Struktur Data: List',
                'content' => 'Menyimpan banyak data dalam satu antrean (Array).', 'video_url' => null, 'order' => 5, 'xp_reward' => 40,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu List?', 'content' => 'Di Python, Array disebut **List**. List ditandai dengan kurung siku `[]`.\nContoh: `buah = ["Apel", "Mangga", "Jeruk"]`\nList bisa berisi teks, angka, bahkan campuran!']);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Kurung apa yang digunakan untuk membuat List di Python?', [['id' => 'A', 'text' => 'Kurung biasa ()', 'correct' => false], ['id' => 'B', 'text' => 'Kurung siku []', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Indeks dimulai dari 0', 'content' => 'Sama seperti bahasa lain, indeks List di Python dimulai dari 0.\n`print(buah[0])` akan mencetak "Apel".\nKerennya, Python bisa pakai indeks minus! `buah[-1]` akan mengambil elemen paling akhir ("Jeruk").']);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Apa hasil dari buah[-1] jika buah = ["A", "B", "C"]?', [['id' => 'A', 'text' => 'Error', 'correct' => false], ['id' => 'B', 'text' => '"C"', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Menambah & Menghapus', 'content' => "Untuk menambah item ke akhir List, gunakan `.append()`.\n`buah.append(\"Pisang\")`\nUntuk menghapus item, bisa pakai `.remove(\"Apel\")` atau `.pop()` (menghapus yang terakhir)."]);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Bagaimana cara menambahkan "Pisang" ke List buah?', [['id' => 'A', 'text' => 'buah.append("Pisang")', 'correct' => true], ['id' => 'B', 'text' => 'buah.add("Pisang")', 'correct' => false]]);

        // 7. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 7], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: List Belanja 🛒',
            'content' => 'Susun kode untuk membuat list, menambahkan item, dan mencetaknya.',
            'options' => [
                ['id' => 0, 'text' => 'belanja = ["Susu", "Roti"]'],
                ['id' => 1, 'text' => 'belanja.append("Telur")'],
                ['id' => 2, 'text' => 'print(belanja)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Method append() selalu menambahkan elemen baru di posisi paling belakang dari List.',
        ]);

        // 8. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Isi List-mu! 📦',
            'content' => 'Lengkapi kode pengelolaan List ini.',
            'options' => [
                ['type' => 'text', 'value' => 'hero = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '"Layla", "Gord"'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => "\nhero."],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => '("Zilong")'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '[', 'color' => 'blue'],
                ['id' => 2, 'text' => ']', 'color' => 'orange'],
                ['id' => 3, 'text' => 'append', 'color' => 'green'],
            ]),
            'explanation' => 'Gunakan [] untuk List dan append untuk menambah.',
        ]);

        // 9. Minigame: Block Code
        $lesson->slides()->firstOrCreate(['order' => 9], [
            'type' => 'block_code',
            'title' => 'Cetak Item Terakhir 🎯',
            'content' => 'Susun kode untuk mencetak item pertama dan terakhir.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'angka = [10, 20, 30]'],
                ['id' => 2, 'type' => 'action', 'text' => 'print(angka[0])'],
                ['id' => 3, 'type' => 'action', 'text' => 'print(angka[-1])'],
                ['id' => 4, 'type' => 'action', 'text' => 'angka.append()'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => '0 untuk elemen pertama, -1 trik jitu Python untuk elemen terakhir.',
        ]);
    }

    private function createPythonLesson6($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'perulangan-for-loop'],
            [
                'course_id' => $course->id, 'title' => 'Perulangan: For Loop',
                'content' => 'Mengulang kode tanpa capek.', 'video_url' => null, 'order' => 6, 'xp_reward' => 45,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Python For Loop', 'content' => "For loop di Python sangat intuitif, biasanya digunakan untuk menyusuri List (Iterable).\n`for buah in keranjang:`\n`    print(buah)`\nIni akan mencetak semua isi keranjang satu per satu."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa kegunaan utama For Loop di Python?', [['id' => 'A', 'text' => 'Membuat variabel', 'correct' => false], ['id' => 'B', 'text' => 'Mengulangi elemen di dalam List/Koleksi', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Fungsi range()', 'content' => "Jika kamu ingin mengulang angka (misal: 0 sampai 4), gunakan fungsi `range()`.\n`for i in range(5):`\n`    print(i)`\nIni akan mencetak angka 0, 1, 2, 3, 4. (Berhenti sebelum 5!)"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Fungsi apa yang digunakan untuk membuat urutan angka di For Loop?', [['id' => 'A', 'text' => 'range()', 'correct' => true], ['id' => 'B', 'text' => 'number()', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'range(start, stop)', 'content' => "Kamu juga bisa menentukan angka mulai dan selesai.\n`range(1, 4)` akan menghasilkan angka 1, 2, 3.\n(Ingat, angka 'stop' tidak pernah diikutkan)."]);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Apa hasil dari range(2, 5)?', [['id' => 'A', 'text' => '2, 3, 4', 'correct' => true], ['id' => 'B', 'text' => '2, 3, 4, 5', 'correct' => false]]);

        // 7. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 7], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Loop List 🔁',
            'content' => 'Susun kode loop ini untuk mencetak nama-nama teman.',
            'options' => [
                ['id' => 0, 'text' => 'teman = ["Ali", "Budi", "Caca"]'],
                ['id' => 1, 'text' => 'for nama in teman:'],
                ['id' => 2, 'text' => '    print(nama)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Variable `nama` akan mewakili setiap elemen di dalam list `teman` secara bergantian.',
        ]);

        // 8. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi For Loop! 📝',
            'content' => 'Lengkapi kode untuk mencetak angka 0 sampai 4.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' i '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' '],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => '(5):\n    print(i)'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'for', 'color' => 'blue'],
                ['id' => 2, 'text' => 'in', 'color' => 'orange'],
                ['id' => 3, 'text' => 'range', 'color' => 'green'],
            ]),
            'explanation' => 'Strukturnya adalah: `for` <variabel> `in` <koleksi>:',
        ]);

        // 9. Minigame: Block Code
        $lesson->slides()->firstOrCreate(['order' => 9], [
            'type' => 'block_code',
            'title' => 'Hitung Sampai 3 🔢',
            'content' => 'Susun blok agar program mencetak angka 1, 2, 3.',
            'options' => [
                ['id' => 1, 'type' => 'loop', 'text' => 'for x in range(1, 4):'],
                ['id' => 2, 'type' => 'action', 'text' => '    print(x)'],
                ['id' => 3, 'type' => 'action', 'text' => 'for x in range(3):'],
            ],
            'correct_answer' => '1,2',
            'explanation' => 'range(1, 4) artinya mulai dari 1, dan berhenti sebelum 4 (yaitu 3).',
        ]);
    }

    private function createPythonLesson7($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'perulangan-while-loop'],
            [
                'course_id' => $course->id, 'title' => 'Perulangan: While Loop',
                'content' => 'Looping tanpa batas (jika tidak hati-hati).', 'video_url' => null, 'order' => 7, 'xp_reward' => 45,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Python While Loop', 'content' => "For Loop digunakan kalau kita tahu berapa kali harus mengulang. Tapi kalau tidak tahu? Gunakan **While Loop**!\nWhile loop akan berjalan TERUS selama kondisinya True.\n`while nyawa > 0:`\n`    print(\"Main terus!\")`"]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Kapan While Loop akan berhenti?', [['id' => 'A', 'text' => 'Saat kondisinya menjadi False', 'correct' => true], ['id' => 'B', 'text' => 'Saat sudah diulang 10 kali', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Bahaya Infinite Loop', 'content' => "Karena While loop berjalan terus jika kondisi True, kamu HARUS mengubah kondisi di dalam loop-nya, atau dia tidak akan pernah berhenti (Infinite Loop)!\nContoh:\n`angka = 1`\n`while angka < 5:`\n`    print(angka)`\n`    angka = angka + 1` # <-- Sangat penting!"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Apa yang terjadi jika kamu lupa mengubah variabel kondisi di dalam While Loop?', [['id' => 'A', 'text' => 'Program berhenti', 'correct' => false], ['id' => 'B', 'text' => 'Infinite loop (Macam komputer hang)', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Break dan Continue', 'content' => "Ada senjata rahasia di dalam Loop:\n1. **break**: Menghentikan loop secara paksa.\n2. **continue**: Melompati sisa kode di iterasi ini dan lanjut ke putaran loop berikutnya."]);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Perintah apa yang digunakan untuk memaksa Loop berhenti sebelum waktunya?', [['id' => 'A', 'text' => 'stop', 'correct' => false], ['id' => 'B', 'text' => 'break', 'correct' => true]]);

        // 7. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 7], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Hitung Mundur 💣',
            'content' => 'Susun kode while loop ini untuk menghitung mundur dari 3.',
            'options' => [
                ['id' => 0, 'text' => 'waktu = 3'],
                ['id' => 1, 'text' => 'while waktu > 0:'],
                ['id' => 2, 'text' => '    print(waktu)'],
                ['id' => 3, 'text' => '    waktu = waktu - 1'],
            ],
            'correct_answer' => null,
            'explanation' => 'Tentukan nilai awal, buat kondisi, jalankan aksi, lalu kurangi waktunya.',
        ]);

        // 8. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi While-mu! 🔄',
            'content' => 'Isi bagian yang kosong.',
            'options' => [
                ['type' => 'text', 'value' => 'hp = 100\n'],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' hp > 0:\n    print("Berjuang!")\n    hp = hp - 20\n    if hp == 20:\n        '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'while', 'color' => 'blue'],
                ['id' => 2, 'text' => 'break', 'color' => 'orange'],
            ]),
            'explanation' => 'Gunakan while untuk loop kondisi, dan break untuk berhenti paksa saat hp 20.',
        ]);

        // 9. Minigame: Block Code
        $lesson->slides()->firstOrCreate(['order' => 9], [
            'type' => 'block_code',
            'title' => 'Awas Infinite Loop! 🚨',
            'content' => 'Susun blok loop yang AMAN (menghindari infinite loop).',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'x = 0'],
                ['id' => 2, 'type' => 'loop', 'text' => 'while x < 5:'],
                ['id' => 3, 'type' => 'action', 'text' => '    print("Aman!")'],
                ['id' => 4, 'type' => 'math', 'text' => '    x = x + 1'],
                ['id' => 5, 'type' => 'math', 'text' => 'x < 5'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Penting untuk selalu mengubah nilai x agar bisa keluar dari loop.',
        ]);
    }

    private function createPythonLesson8($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'struktur-data-dictionary'],
            [
                'course_id' => $course->id, 'title' => 'Struktur Data: Dictionary',
                'content' => 'Kamus data yang serbaguna.', 'video_url' => null, 'order' => 8, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Dictionary?', 'content' => "Selain List, Python punya struktur data andalan: **Dictionary**. Ditandai dengan kurung kurawal `{}`.\nBedanya dengan List yang pakai nomor urut (Indeks), Dictionary menggunakan sistem **Key-Value** (Kunci dan Nilai)."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Simbol kurung apa yang digunakan Dictionary?', [['id' => 'A', 'text' => 'Kurung kurawal {}', 'correct' => true], ['id' => 'B', 'text' => 'Kurung siku []', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Key-Value Pairs', 'content' => "Contoh:\n`siswa = { 'nama': 'Budi', 'umur': 15, 'lulus': True }`\nDi sini, 'nama', 'umur', dan 'lulus' adalah **Key** (Kunci).\n'Budi', 15, dan True adalah **Value** (Nilainya)."]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Pada `siswa = {"umur": 15}`, bagian "umur" disebut sebagai?', [['id' => 'A', 'text' => 'Value', 'correct' => false], ['id' => 'B', 'text' => 'Key', 'correct' => true]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Mengakses Data', 'content' => "Untuk mengambil data 'umur', kita tidak pakai `siswa[1]` seperti di List, tapi langsung pakai namanya: `siswa['umur']`.\nMaka Python akan mereturn `15`."]);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Bagaimana cara mengambil nilai umur dari Dictionary siswa?', [['id' => 'A', 'text' => 'siswa["umur"]', 'correct' => true], ['id' => 'B', 'text' => 'siswa[1]', 'correct' => false]]);

        // 7. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 7], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Kamus Hewan 🐶',
            'content' => 'Susun kode ini untuk membuat dictionary dan mengaksesnya.',
            'options' => [
                ['id' => 0, 'text' => 'hewan = {'],
                ['id' => 1, 'text' => '    "kucing": "Meong",'],
                ['id' => 2, 'text' => '    "anjing": "Guk guk"'],
                ['id' => 3, 'text' => '}'],
                ['id' => 4, 'text' => 'print(hewan["kucing"])'],
            ],
            'correct_answer' => null,
            'explanation' => 'Format dictionary: key di kiri, value di kanan, dipisah titik dua.',
        ]);

        // 8. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Isi Profilmu! 👤',
            'content' => 'Lengkapi kode Dictionary berikut.',
            'options' => [
                ['type' => 'text', 'value' => 'profil = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => "\n    \"nama\": \"Ali\""],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => "\n    \"skor\": 100\n}\nprint(profil["],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => '])'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '{', 'color' => 'blue'],
                ['id' => 2, 'text' => ',', 'color' => 'orange'],
                ['id' => 3, 'text' => '"nama"', 'color' => 'green'],
            ]),
            'explanation' => 'Dictionary pakai {}, setiap baris dipisah koma, akses data pakai key ("nama").',
        ]);

        // 9. Minigame: Block Code
        $lesson->slides()->firstOrCreate(['order' => 9], [
            'type' => 'block_code',
            'title' => 'Ambil Data Game 🎮',
            'content' => 'Susun blok untuk mengambil level dari sebuah game state.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'game_state = {"hp": 100, "level": 5}'],
                ['id' => 2, 'type' => 'action', 'text' => 'level_sekarang = game_state["level"]'],
                ['id' => 3, 'type' => 'action', 'text' => 'print(level_sekarang)'],
                ['id' => 4, 'type' => 'action', 'text' => 'game_state[1]'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => 'Ambil data berdasarkan nama key "level".',
        ]);
    }

    private function createPythonLesson9($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'fungsi-python'],
            [
                'course_id' => $course->id, 'title' => 'Fungsi (Functions)',
                'content' => 'Blok kode pintar yang bisa dipanggil kapan saja.', 'video_url' => null, 'order' => 9, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Membuat Fungsi', 'content' => "Di Python, fungsi dideklarasikan dengan kata kunci `def`.\nContoh:\n`def sapa():`\n`    print(\"Halo bro!\")`\nIngat titik dua (:) dan indentasinya!"]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa kata kunci untuk membuat fungsi di Python?', [['id' => 'A', 'text' => 'function', 'correct' => false], ['id' => 'B', 'text' => 'def', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Parameter', 'content' => "Fungsi bisa menerima data masuk (parameter).\n`def sapa(nama):`\n`    print(\"Halo \" + nama)`\nJika kita panggil `sapa(\"Budi\")`, maka akan muncul 'Halo Budi'."]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Berdasarkan fungsi di atas, "nama" bertindak sebagai?', [['id' => 'A', 'text' => 'Parameter', 'correct' => true], ['id' => 'B', 'text' => 'Keyword khusus Python', 'correct' => false]]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Return Value', 'content' => "Fungsi tidak hanya print, tapi bisa melempar nilai kembali (Return) pakai `return`.\n`def tambah(a, b):`\n`    return a + b`\n`hasil = tambah(5, 5)`\nSekarang `hasil` bernilai 10!"]);
        // 6. Quiz
        $this->createQuiz($lesson, 6, 'Bagaimana cara mengirim hasil hitungan ke luar fungsi di Python?', [['id' => 'A', 'text' => 'print', 'correct' => false], ['id' => 'B', 'text' => 'return', 'correct' => true]]);

        // 7. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 7], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Fungsi Kali ✖️',
            'content' => 'Susun kode pembuatan fungsi kali() dan cara memanggilnya.',
            'options' => [
                ['id' => 0, 'text' => 'def kali(a, b):'],
                ['id' => 1, 'text' => '    hasil = a * b'],
                ['id' => 2, 'text' => '    return hasil'],
                ['id' => 3, 'text' => 'jawaban = kali(10, 5)'],
                ['id' => 4, 'text' => 'print(jawaban)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Definisikan fungsi dulu (dengan return), baru panggil fungsinya dan simpan nilainya.',
        ]);

        // 8. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Siapkan Fungsinya! 🔧',
            'content' => 'Lengkapi sintaks pembuatan fungsi ini.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' ucap_selamat(nama)'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => "\n    pesan = \"Selamat \" + nama\n    "],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ' pesan'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'def', 'color' => 'blue'],
                ['id' => 2, 'text' => ':', 'color' => 'orange'],
                ['id' => 3, 'text' => 'return', 'color' => 'green'],
            ]),
            'explanation' => 'def nama_fungsi(parameter): kemudian diakhiri dengan return value.',
        ]);

        // 9. Minigame: Block Code
        $lesson->slides()->firstOrCreate(['order' => 9], [
            'type' => 'block_code',
            'title' => 'Bikin Mesin Canggih 🤖',
            'content' => 'Susun blok untuk membuat dan memanggil fungsi pengurangan.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'def kurang(x, y):'],
                ['id' => 2, 'type' => 'math', 'text' => '    return x - y'],
                ['id' => 3, 'type' => 'action', 'text' => 'hasil = kurang(10, 3)'],
                ['id' => 4, 'type' => 'action', 'text' => 'function kurang()'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => 'Python pakai `def`, bukan `function`.',
        ]);
    }

    private function createPythonLesson10($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'mini-project-python'],
            [
                'course_id' => $course->id, 'title' => 'Mini Project: Game Tebak Angka',
                'content' => 'Menggabungkan semua ilmu Python-mu.', 'video_url' => null, 'order' => 10, 'xp_reward' => 100,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Selamat!', 'content' => "Kamu sudah sampai di proyek akhir tingkat dasar!\nKita akan menggabungkan: Variabel, If-Else, dan Loop untuk membuat Game Tebak Angka sederhana."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa saja komponen yang bisa digabungkan untuk membuat program yang kompleks?', [['id' => 'A', 'text' => 'Hanya print saja', 'correct' => false], ['id' => 'B', 'text' => 'Variabel, Struktur Kontrol, dan Loop', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Konsep Game', 'content' => "Alur gamenya:\n1. Tentukan angka rahasia.\n2. Gunakan While loop yang meminta tebakan user (pakai fungsi `input()`).\n3. Jika tebakan benar, loop berhenti (break) dan print 'Menang!'."]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Fungsi Python apa yang digunakan untuk meminta input dari user di terminal?', [['id' => 'A', 'text' => 'input()', 'correct' => true], ['id' => 'B', 'text' => 'ask()', 'correct' => false]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Susun Gamenya! 🎮',
            'content' => 'Susun logika Game Tebak Angka ini.',
            'options' => [
                ['id' => 0, 'text' => 'rahasia = 7'],
                ['id' => 1, 'text' => 'while True:'],
                ['id' => 2, 'text' => '    tebakan = int(input("Tebak angka: "))'],
                ['id' => 3, 'text' => '    if tebakan == rahasia:'],
                ['id' => 4, 'text' => '        print("Benar!")'],
                ['id' => 5, 'text' => '        break'],
            ],
            'correct_answer' => null,
            'explanation' => 'Infinite loop `while True` digunakan untuk terus meminta input, dan hanya berhenti (`break`) jika tebakannya benar.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Tambahkan Petunjuk! 힌트',
            'content' => 'Lengkapi kode dengan else if (elif) agar game memberikan petunjuk terlalu besar/kecil.',
            'options' => [
                ['type' => 'text', 'value' => '    if tebakan == rahasia:\n        print("Benar!")\n        break\n    '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' tebakan > rahasia:\n        print("Terlalu Besar!")\n    '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ':\n        print("Terlalu Kecil!")'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'elif', 'color' => 'blue'],
                ['id' => 2, 'text' => 'else', 'color' => 'orange'],
            ]),
            'explanation' => 'elif untuk kondisi khusus ("apakah lebih besar?"), lalu else untuk semua kemungkinan sisa ("artinya lebih kecil").',
        ]);
    }

    private function createPythonLesson11($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'menangani-error-python'],
            [
                'course_id' => $course->id, 'title' => 'Menangani Error (Try-Except)',
                'content' => 'Agar programmu tidak mudah crash saat ada masalah.', 'video_url' => null, 'order' => 11, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Error itu Wajar', 'content' => "Setiap programmer pasti pernah mengalami Error. Di Python, error biasanya bikin program langsung berhenti (Crash)!\nContoh, jika kamu membagi angka dengan nol: `10 / 0` akan menghasilkan `ZeroDivisionError`."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa yang terjadi jika ada kode yang Error dan tidak ditangani di Python?', [['id' => 'A', 'text' => 'Program tetap berjalan', 'correct' => false], ['id' => 'B', 'text' => 'Program akan Crash (berhenti mendadak)', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Try dan Except', 'content' => "Untuk mencegah crash, kita pakai blok `try` dan `except`.\n`try:`\n`    hasil = 10 / 0`\n`except:`\n`    print(\"Jangan dibagi nol!\")`\nPython akan mencoba blok `try`, jika gagal, dia akan menjalankan `except` tanpa crash!"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Kata kunci apa yang digunakan untuk menangkap error agar program tidak crash?', [['id' => 'A', 'text' => 'catch', 'correct' => false], ['id' => 'B', 'text' => 'except', 'correct' => true]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Amankan Kode 🛡️',
            'content' => 'Susun kode ini agar tidak crash saat user memasukkan huruf (bukan angka).',
            'options' => [
                ['id' => 0, 'text' => 'try:'],
                ['id' => 1, 'text' => '    angka = int(input("Masukkan angka: "))'],
                ['id' => 2, 'text' => '    print(angka * 2)'],
                ['id' => 3, 'text' => 'except ValueError:'],
                ['id' => 4, 'text' => '    print("Itu bukan angka!")'],
            ],
            'correct_answer' => null,
            'explanation' => 'Kita mengurung bagian yang rawan error di dalam `try`, lalu menangani error `ValueError` di dalam `except`.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Cegah Ledakan! 💣',
            'content' => 'Lengkapi struktur try-except ini.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ':\n    pembagian = 100 / 0\n'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' ZeroDivisionError:\n    print("Ups, tidak bisa bagi nol!")'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'try', 'color' => 'blue'],
                ['id' => 2, 'text' => 'except', 'color' => 'orange'],
            ]),
            'explanation' => 'try untuk mencoba, except untuk menangani kegagalan.',
        ]);
    }

    private function createPythonLesson12($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'modul-library-python'],
            [
                'course_id' => $course->id, 'title' => 'Modul dan Library',
                'content' => 'Meminjam kekuatan super dari kode orang lain.', 'video_url' => null, 'order' => 12, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Modul?', 'content' => "Python punya filosofi \"Batteries Included\", artinya banyak fitur canggih yang sudah tersedia, kita hanya perlu memanggilnya pakai perintah `import`.\nContoh: `import math` atau `import random`."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Perintah apa yang dipakai untuk membawa fungsi luar ke dalam program kita?', [['id' => 'A', 'text' => 'include', 'correct' => false], ['id' => 'B', 'text' => 'import', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Menggunakan Modul', 'content' => "Setelah di-import, kita bisa pakai titik (.) untuk memakai isinya.\n`import random`\n`angka = random.randint(1, 10)`\nFungsi di atas akan menghasilkan angka acak dari 1 sampai 10!"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Jika kita `import math`, bagaimana cara memakai fungsi akar kuadrat (sqrt)?', [['id' => 'A', 'text' => 'math.sqrt(9)', 'correct' => true], ['id' => 'B', 'text' => 'sqrt.math(9)', 'correct' => false]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Dadu Acak 🎲',
            'content' => 'Susun kode ini untuk mengocok dadu secara acak.',
            'options' => [
                ['id' => 0, 'text' => 'import random'],
                ['id' => 1, 'text' => 'dadu = random.randint(1, 6)'],
                ['id' => 2, 'text' => 'print("Kamu dapat angka:")'],
                ['id' => 3, 'text' => 'print(dadu)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Selalu import modulnya di baris paling atas, lalu panggil fungsinya.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Panggil Library! 📚',
            'content' => 'Lengkapi kode untuk mencari nilai Pi.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' math\n\nnilai_pi = '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '.pi\nprint(nilai_pi)'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'import', 'color' => 'blue'],
                ['id' => 2, 'text' => 'math', 'color' => 'orange'],
            ]),
            'explanation' => 'Kita meng-import modul `math`, dan mengakses konstantanya dengan `math.pi`.',
        ]);
    }

    private function createPythonLesson13($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'manipulasi-string-python'],
            [
                'course_id' => $course->id, 'title' => 'Manipulasi String',
                'content' => 'Menjadi master pengendali teks.', 'video_url' => null, 'order' => 13, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'String Methods', 'content' => "String (teks) di Python punya banyak 'kekuatan' tersembunyi.\n`.upper()` membuat teks jadi KAPITAL.\n`.lower()` membuat teks jadi huruf kecil.\nContoh: `\"Halo\".upper()` akan menghasilkan `HALO`."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Method apa yang dipakai untuk mengecilkan semua huruf?', [['id' => 'A', 'text' => '.lower()', 'correct' => true], ['id' => 'B', 'text' => '.small()', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Ganti Kata (Replace)', 'content' => "Gunakan `.replace()` untuk menukar kata di dalam kalimat.\n`kalimat = \"Saya suka Kucing\"`\n`print(kalimat.replace(\"Kucing\", \"Ayam\"))`\nOutputnya akan menjadi \"Saya suka Ayam\"!"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Berapa parameter yang dibutuhkan fungsi `.replace()`?', [['id' => 'A', 'text' => '1', 'correct' => false], ['id' => 'B', 'text' => '2 (Yang diganti, Penggantinya)', 'correct' => true]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Sensor Teks 🤫',
            'content' => 'Susun kode ini untuk menyensor kata kasar dan membuatnya kapital.',
            'options' => [
                ['id' => 0, 'text' => 'teks = "dasar bodoh!"'],
                ['id' => 1, 'text' => 'disensor = teks.replace("bodoh", "***")'],
                ['id' => 2, 'text' => 'hasil_akhir = disensor.upper()'],
                ['id' => 3, 'text' => 'print(hasil_akhir)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Bisa juga dirantai (chaining): teks.replace("a","b").upper()',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Rantai Method! ⛓️',
            'content' => 'Ubah teks menjadi kapital dan hitung panjangnya.',
            'options' => [
                ['type' => 'text', 'value' => 'kata = "python"\nkapital = kata.'],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '()\npanjang = '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '(kata)'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'upper', 'color' => 'blue'],
                ['id' => 2, 'text' => 'len', 'color' => 'orange'],
            ]),
            'explanation' => '.upper() untuk huruf besar, dan fungsi built-in len() untuk menghitung panjang.',
        ]);
    }

    private function createPythonLesson14($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'file-handling-python'],
            [
                'course_id' => $course->id, 'title' => 'File Handling',
                'content' => 'Membaca dan menulis data ke dalam file teks.', 'video_url' => null, 'order' => 14, 'xp_reward' => 55,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Buka File', 'content' => "Di Python, kita bisa membuat atau membaca file `.txt` dengan fungsi `open()`.\nMode: `'r'` untuk baca (read), `'w'` untuk tulis (write/timpa), dan `'a'` untuk tambah (append).\nContoh: `file = open('data.txt', 'w')`."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa mode yang digunakan di dalam fungsi open() jika kita HANYA ingin membaca isinya?', [['id' => 'A', 'text' => '\'r\' (read)', 'correct' => true], ['id' => 'B', 'text' => '\'w\' (write)', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Tulis dan Tutup', 'content' => "Setelah file dibuka, kita bisa menulisnya dengan `.write()`.\n`file.write(\"Halo file!\")`\n**PENTING:** Selalu tutup file setelah selesai dengan `.close()` agar memori tidak bocor!"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Apa method yang WAJIB dipanggil setelah selesai bekerja dengan file?', [['id' => 'A', 'text' => 'file.end()', 'correct' => false], ['id' => 'B', 'text' => 'file.close()', 'correct' => true]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Tulis Jurnal 📝',
            'content' => 'Susun kode untuk menulis teks ke dalam file jurnal.txt.',
            'options' => [
                ['id' => 0, 'text' => 'jurnal = open("jurnal.txt", "w")'],
                ['id' => 1, 'text' => 'jurnal.write("Hari ini saya belajar Python!")'],
                ['id' => 2, 'text' => 'jurnal.close()'],
            ],
            'correct_answer' => null,
            'explanation' => 'Buka file dengan mode w (write), tulis pesannya, lalu tutup (close).',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Akses Berkas! 📂',
            'content' => 'Lengkapi kode untuk membaca isi file.',
            'options' => [
                ['type' => 'text', 'value' => 'dokumen = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '("rahasia.txt", "'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '")\nisi = dokumen.read()\nprint(isi)\ndokumen.'],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => '()'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'open', 'color' => 'blue'],
                ['id' => 2, 'text' => 'r', 'color' => 'orange'],
                ['id' => 3, 'text' => 'close', 'color' => 'green'],
            ]),
            'explanation' => 'Gunakan open() mode r, lalu jangan lupa tutup pakai close().',
        ]);
    }

    private function createPythonLesson15($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'oop-dasar-python'],
            [
                'course_id' => $course->id, 'title' => 'Pemrograman Berorientasi Objek (OOP) Dasar',
                'content' => 'Membuat cetakan untuk objek di duniamu.', 'video_url' => null, 'order' => 15, 'xp_reward' => 60,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Class & Object', 'content' => "Dalam OOP, **Class** adalah cetakan (blueprint), sedangkan **Object** adalah barang jadinya.\nMisal Class-nya adalah `Mobil`, maka Object-nya bisa `mobil_ferrari` atau `mobil_honda`."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Dalam konsep OOP, cetakan biru atau desain awal disebut?', [['id' => 'A', 'text' => 'Class', 'correct' => true], ['id' => 'B', 'text' => 'Object', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Membuat Class', 'content' => "Membuat class di Python sangat simpel: gunakan kata kunci `class`.\n`class Kucing:`\n`    pass` (pass artinya lewati/kosong dulu).\nLalu buat objectnya: `oyen = Kucing()`"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Bagaimana cara membuat sebuah object bernama \'putih\' dari Class \'Kucing\'?', [['id' => 'A', 'text' => 'putih = new Kucing()', 'correct' => false], ['id' => 'B', 'text' => 'putih = Kucing()', 'correct' => true]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Buat Robotmu! 🤖',
            'content' => 'Susun kode untuk membuat Class Robot dan instansiasinya.',
            'options' => [
                ['id' => 0, 'text' => 'class Robot:'],
                ['id' => 1, 'text' => '    pass'],
                ['id' => 2, 'text' => 'r2d2 = Robot()'],
                ['id' => 3, 'text' => 'c3po = Robot()'],
            ],
            'correct_answer' => null,
            'explanation' => 'Buat blueprint classnya terlebih dahulu, lalu kamu bebas membuat berapapun object darinya.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Pabrik Objek! 🏭',
            'content' => 'Lengkapi kode untuk membuat sebuah blueprint.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' Monster:\n    pass\n\ngodzilla = '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '()'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'class', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Monster', 'color' => 'orange'],
            ]),
            'explanation' => 'Gunakan class untuk mendefinisikan, dan Monster() untuk membuat instance-nya.',
        ]);
    }

    private function createPythonLesson16($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'method-atribut-oop-python'],
            [
                'course_id' => $course->id, 'title' => 'Method & Atribut',
                'content' => 'Memberi sifat dan keahlian pada Object.', 'video_url' => null, 'order' => 16, 'xp_reward' => 60,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu self?', 'content' => "Di dalam class, kita bisa membuat variabel (disebut **Atribut**) dan fungsi (disebut **Method**).\nSemua method di Python WAJIB memiliki parameter pertama bernama `self`.\n`self` itu mewakili object itu sendiri!"]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Parameter wajib pertama pada setiap fungsi (method) di dalam Class Python adalah?', [['id' => 'A', 'text' => 'self', 'correct' => true], ['id' => 'B', 'text' => 'this', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => '__init__ si Pembangun', 'content' => "Saat sebuah object dibuat, fungsi khusus bernama `__init__` (ditulis dengan 2 underscore) akan otomatis berjalan. Ini sering disebut Constructor.\n`def __init__(self, nama):`\n`    self.nama = nama`"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Fungsi ajaib apa yang otomatis dipanggil saat Object baru dibuat?', [['id' => 'A', 'text' => '__start__', 'correct' => false], ['id' => 'B', 'text' => '__init__', 'correct' => true]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Pet Shop 🐾',
            'content' => 'Susun kode ini untuk membuat Class Hewan yang memiliki nama dan suara.',
            'options' => [
                ['id' => 0, 'text' => 'class Hewan:'],
                ['id' => 1, 'text' => '    def __init__(self, nama):'],
                ['id' => 2, 'text' => '        self.nama = nama'],
                ['id' => 3, 'text' => '    def bersuara(self):'],
                ['id' => 4, 'text' => '        print(self.nama + " bersuara!")'],
            ],
            'correct_answer' => null,
            'explanation' => 'Jangan lupakan parameter self pada setiap method di dalam class.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Bangun Mobilmu! 🏎️',
            'content' => 'Lengkapi method __init__ berikut.',
            'options' => [
                ['type' => 'text', 'value' => 'class Mobil:\n    def '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '('],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ', warna):\n        '],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => '.warna = warna'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '__init__', 'color' => 'blue'],
                ['id' => 2, 'text' => 'self', 'color' => 'orange'],
                ['id' => 3, 'text' => 'self', 'color' => 'green'],
            ]),
            'explanation' => 'Method __init__ digunakan untuk inisialisasi, dan self menunjuk ke atribut object tersebut.',
        ]);
    }

    private function createPythonLesson17($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'inheritance-oop-python'],
            [
                'course_id' => $course->id, 'title' => 'Inheritance (Pewarisan)',
                'content' => 'Menurunkan sifat dan kemampuan ke Object lain.', 'video_url' => null, 'order' => 17, 'xp_reward' => 65,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Inheritance?', 'content' => "Class bisa mewariskan sifatnya ke Class lain (disebut Child Class).\nContoh: Class `Hewan` punya method `makan()`. Class `Kucing` bisa mewarisi `Hewan`, sehingga `Kucing` otomatis punya method `makan()` tanpa perlu ditulis ulang!"]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa keuntungan utama dari Inheritance (Pewarisan)?', [['id' => 'A', 'text' => 'Mencegah penulisan kode yang berulang-ulang', 'correct' => true], ['id' => 'B', 'text' => 'Membuat program lebih lambat', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Cara Mewariskan', 'content' => "Untuk mewariskan class, tulis nama Parent Class di dalam kurung saat membuat Child Class.\n`class Hewan:`\n`    pass`\n\n`class Kucing(Hewan):`\n`    pass`"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Jika `Burung` mewarisi `Hewan`, bagaimana penulisan class-nya?', [['id' => 'A', 'text' => 'class Burung inherits Hewan:', 'correct' => false], ['id' => 'B', 'text' => 'class Burung(Hewan):', 'correct' => true]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Evolusi Hewan 🧬',
            'content' => 'Susun kode ini agar Class Anjing mewarisi Hewan.',
            'options' => [
                ['id' => 0, 'text' => 'class Hewan:'],
                ['id' => 1, 'text' => '    def bernafas(self):'],
                ['id' => 2, 'text' => '        print("Menghirup oksigen")'],
                ['id' => 3, 'text' => 'class Anjing(Hewan):'],
                ['id' => 4, 'text' => '    def menggonggong(self):'],
                ['id' => 5, 'text' => '        print("Guk guk!")'],
            ],
            'correct_answer' => null,
            'explanation' => 'Sekarang object dari Anjing bisa memanggil fungsi bernafas() maupun menggonggong().',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Pewarisan Takhta! 👑',
            'content' => 'Lengkapi kode pewarisan ini.',
            'options' => [
                ['type' => 'text', 'value' => 'class Kendaraan:\n    roda = 0\n\nclass Motor('],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '):\n    roda = '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '\n\nbeat = Motor()\nprint(beat.'],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ')'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Kendaraan', 'color' => 'blue'],
                ['id' => 2, 'text' => '2', 'color' => 'orange'],
                ['id' => 3, 'text' => 'roda', 'color' => 'green'],
            ]),
            'explanation' => 'Motor mewarisi Kendaraan dan memodifikasi nilai roda menjadi 2.',
        ]);
    }

    private function createPythonLesson18($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'list-comprehension-python'],
            [
                'course_id' => $course->id, 'title' => 'List Comprehension',
                'content' => 'Membuat List dengan cara super elegan.', 'video_url' => null, 'order' => 18, 'xp_reward' => 65,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu List Comprehension?', 'content' => "Ini adalah fitur khas Python yang sangat disukai programmer. Kamu bisa membuat List baru menggunakan perulangan (For) hanya dalam SATU BARIS kode!\nBentuk umumnya: `[hasil for item in data]`"]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa keunggulan List Comprehension?', [['id' => 'A', 'text' => 'Menulis For Loop untuk membuat List dalam 1 baris kode', 'correct' => true], ['id' => 'B', 'text' => 'Membuat animasi List', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Contoh Penggunaan', 'content' => "Tanpa List Comprehension:\n`angka = []`\n`for i in range(5):`\n`    angka.append(i)`\n\nDengan List Comprehension:\n`angka = [i for i in range(5)]`\nHasilnya sama-sama: `[0, 1, 2, 3, 4]`!"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Bagaimana cara membuat List berisi angka kuadrat dari 0-4?', [['id' => 'A', 'text' => '[x**2 for x in range(5)]', 'correct' => true], ['id' => 'B', 'text' => '[range(5)**2]', 'correct' => false]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: 1 Baris Ajaib ✨',
            'content' => 'Susun kode untuk membuat list panjang kata dari nama-nama buah.',
            'options' => [
                ['id' => 0, 'text' => 'buah = ["Apel", "Pisang", "Jeruk"]'],
                ['id' => 1, 'text' => 'panjang = [len(x) for x in buah]'],
                ['id' => 2, 'text' => 'print(panjang)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Kita menghitung panjang len() dari masing-masing elemen x di dalam list buah.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'List Super Cepat! ⚡',
            'content' => 'Lengkapi sintaks List Comprehension berikut untuk mengalikan setiap angka dengan 10.',
            'options' => [
                ['type' => 'text', 'value' => 'data = [1, 2, 3]\nhasil = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => 'n * 10 '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' n in data'],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => '\nprint(hasil)'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '[', 'color' => 'blue'],
                ['id' => 2, 'text' => 'for', 'color' => 'orange'],
                ['id' => 3, 'text' => ']', 'color' => 'green'],
            ]),
            'explanation' => 'Sintaks lengkapnya dikurung dalam `[]`. Di dalamnya formatnya: aksi `for` variabel `in` list.',
        ]);
    }

    private function createPythonLesson19($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'lambda-function-python'],
            [
                'course_id' => $course->id, 'title' => 'Lambda Functions',
                'content' => 'Fungsi anonim (tanpa nama) yang kecil dan gesit.', 'video_url' => null, 'order' => 19, 'xp_reward' => 70,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Fungsi Tanpa Nama', 'content' => "Biasanya kita membuat fungsi pakai `def`. Tapi jika fungsinya sangat kecil (hanya 1 baris return), kita bisa pakai fungsi Lambda!\nLambda ditulis tanpa nama dan langsung me-return hasilnya."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Disebut apakah fungsi yang tidak memiliki nama (Anonymous Function) di Python?', [['id' => 'A', 'text' => 'Void Function', 'correct' => false], ['id' => 'B', 'text' => 'Lambda Function', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Sintaks Lambda', 'content' => "Bentuknya:\n`lambda argumen : ekspresi`\n\nContoh mengubah `def tambah(a, b): return a+b` menjadi lambda:\n`tambah = lambda a, b : a + b`\nLalu dipanggil sama seperti fungsi biasa: `tambah(5, 2)`"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Berdasarkan fungsi lambda `kali = lambda x: x * 2`, apa hasil dari `kali(10)`?', [['id' => 'A', 'text' => '20', 'correct' => true], ['id' => 'B', 'text' => '12', 'correct' => false]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Fungsi Singkat ✂️',
            'content' => 'Susun kode lambda untuk menghitung luas persegi.',
            'options' => [
                ['id' => 0, 'text' => 'luas_persegi = lambda sisi : sisi * sisi'],
                ['id' => 1, 'text' => 'hasil = luas_persegi(5)'],
                ['id' => 2, 'text' => 'print(hasil)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Lambda sangat berguna untuk fungsi-fungsi matematika pendek yang tidak butuh banyak baris.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Bikin Lambda-mu! 🧩',
            'content' => 'Lengkapi fungsi Lambda untuk mengurangi nilai darah (HP).',
            'options' => [
                ['type' => 'text', 'value' => 'kurangi_hp = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' hp, damage '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' hp - damage\n\nsisa_hp = kurangi_hp(100, '],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ')\nprint(sisa_hp)'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'lambda', 'color' => 'blue'],
                ['id' => 2, 'text' => ':', 'color' => 'orange'],
                ['id' => 3, 'text' => '20', 'color' => 'green'],
            ]),
            'explanation' => 'Sintaks dasar: `lambda` diikuti nama parameter, titik dua `:`, lalu operasi yang ingin di-return.',
        ]);
    }

    private function createPythonLesson20($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'final-project-python'],
            [
                'course_id' => $course->id, 'title' => 'Final Project: Aplikasi Buku Alamat',
                'content' => 'Selamat! Mari aplikasikan semuanya di projek akhir.', 'video_url' => null, 'order' => 20, 'xp_reward' => 150,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Saatnya Beraksi!', 'content' => "Di projek akhir ini, kita akan membuat aplikasi manajemen Buku Alamat (Contact Book).\nKita akan memakai: Dictionary (simpan kontak), Loop (menu utama), Fungsi (tambah kontak), dan Try-Except (cegah error)."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Struktur data apa yang paling pas untuk menyimpan Kontak (Nama sebagai kunci, Nomor HP sebagai nilai)?', [['id' => 'A', 'text' => 'List', 'correct' => false], ['id' => 'B', 'text' => 'Dictionary', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Alur Program', 'content' => "1. Buat dictionary kosong `kontak = {}`\n2. Buat `while True:` untuk menu pilihan.\n3. Jika user pilih 'Tambah', minta input nama dan nomor, lalu simpan ke dictionary.\n4. Jika pilih 'Lihat', gunakan For Loop untuk menampilkan seluruh isi dictionary."]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Bagaimana cara menambahkan nomor "0812" dengan kunci "Budi" ke dictionary kontak?', [['id' => 'A', 'text' => 'kontak.append("Budi", "0812")', 'correct' => false], ['id' => 'B', 'text' => 'kontak["Budi"] = "0812"', 'correct' => true]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Menu Aplikasi 📱',
            'content' => 'Susun logika Loop untuk Menu Aplikasi ini.',
            'options' => [
                ['id' => 0, 'text' => 'kontak = {}'],
                ['id' => 1, 'text' => 'while True:'],
                ['id' => 2, 'text' => '    pilihan = input("1. Tambah, 2. Keluar : ")'],
                ['id' => 3, 'text' => '    if pilihan == "1":'],
                ['id' => 4, 'text' => '        # Tambah kontak'],
                ['id' => 5, 'text' => '    elif pilihan == "2":'],
                ['id' => 6, 'text' => '        break'],
            ],
            'correct_answer' => null,
            'explanation' => 'Kita mengurung input di dalam infinite loop (While True), lalu break ketika user memilih keluar.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Simpan Data Kontak! 💾',
            'content' => 'Lengkapi kode untuk menyimpan input user ke dalam dictionary kontak.',
            'options' => [
                ['type' => 'text', 'value' => '    elif pilihan == "1":\n        nama = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '("Nama: ")\n        nomor = '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '("Nomor HP: ")\n        '],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => '[nama] = nomor\n        print("Tersimpan!")'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'input', 'color' => 'blue'],
                ['id' => 2, 'text' => 'input', 'color' => 'orange'],
                ['id' => 3, 'text' => 'kontak', 'color' => 'green'],
            ]),
            'explanation' => 'Kita minta input() nama dan nomor, lalu memasukkannya ke dictionary `kontak` dengan nama sebagai kuncinya.',
        ]);
    }
}
