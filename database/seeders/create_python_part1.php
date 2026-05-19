<?php

$lessons = [];

// Lesson 1
$lesson1 = <<<EOT
    private function createPythonLesson1(\$course)
    {
        \$lesson = Lesson::firstOrCreate(
            ['slug' => 'pengenalan-python'],
            [
                'course_id' => \$course->id, 'title' => 'Pengenalan Python',
                'content' => 'Berkenalan dengan ular piton yang ramah.', 'video_url' => null, 'order' => 1, 'xp_reward' => 20,
            ]);

        // 1. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Python?', 'content' => 'Python adalah bahasa pemrograman yang super populer, mudah dibaca seperti bahasa Inggris, dan serba bisa! Mulai dari bikin web, game, AI, hingga robotika.']);
        // 2. Quiz
        \$this->createQuiz(\$lesson, 2, 'Apa keunggulan utama bahasa Python?', [['id' => 'A', 'text' => 'Hanya untuk bikin game', 'correct' => false], ['id' => 'B', 'text' => 'Mudah dibaca dan dipelajari', 'correct' => true]]);

        // 3. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Fungsi print()', 'content' => 'Untuk menyuruh Python berbicara atau menampilkan sesuatu ke layar, kita menggunakan perintah `print()`. Contoh: `print("Halo Dunia!")`']);
        // 4. Quiz
        \$this->createQuiz(\$lesson, 4, 'Perintah apa yang digunakan untuk menampilkan teks ke layar di Python?', [['id' => 'A', 'text' => 'echo()', 'correct' => false], ['id' => 'B', 'text' => 'print()', 'correct' => true]]);

        // 5. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Tanda Kutip', 'content' => 'Teks di dalam perintah print() harus diapit oleh tanda kutip ganda ("") atau tunggal (\'\'). Tanpa tanda kutip, Python akan kebingungan!']);
        // 6. Quiz
        \$this->createQuiz(\$lesson, 6, 'Penulisan print yang benar adalah?', [['id' => 'A', 'text' => 'print(Halo)', 'correct' => false], ['id' => 'B', 'text' => \'print("Halo")\', 'correct' => true]]);

        // 7. Minigame: Code Arrange
        \$lesson->slides()->firstOrCreate(['order' => 7], [
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
        \$lesson->slides()->firstOrCreate(['order' => 8], [
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
        \$lesson->slides()->firstOrCreate(['order' => 9], [
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
EOT;

// Lesson 2
$lesson2 = <<<EOT
    private function createPythonLesson2(\$course)
    {
        \$lesson = Lesson::firstOrCreate(
            ['slug' => 'variabel-tipe-data-python'],
            [
                'course_id' => \$course->id, 'title' => 'Variabel & Tipe Data Dasar',
                'content' => 'Menyimpan data ke dalam kotak memori.', 'video_url' => null, 'order' => 2, 'xp_reward' => 30,
            ]);

        // 1. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Membuat Variabel', 'content' => 'Di Python, membuat variabel sangat mudah! Tidak perlu repot-repot pakai kata kunci "var" atau "int". Cukup ketik namanya, tanda sama dengan (=), dan nilainya. Contoh: `nama = "Budi"`']);
        // 2. Quiz
        \$this->createQuiz(\$lesson, 2, 'Cara membuat variabel umur dengan nilai 15 di Python adalah?', [['id' => 'A', 'text' => 'int umur = 15', 'correct' => false], ['id' => 'B', 'text' => 'umur = 15', 'correct' => true]]);

        // 3. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Tipe Data Dasar', 'content' => "1. **Integer** (Angka bulat): `skor = 100`\\n2. **Float** (Desimal): `berat = 50.5`\\n3. **String** (Teks): `nama = 'Siti'`\\n4. **Boolean** (Benar/Salah): `lulus = True`"]);
        // 4. Quiz
        \$this->createQuiz(\$lesson, 4, 'Tipe data dari `nilai = 8.5` adalah?', [['id' => 'A', 'text' => 'Integer', 'correct' => false], ['id' => 'B', 'text' => 'Float', 'correct' => true]]);

        // 5. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Huruf Kapital pada Boolean', 'content' => 'Hati-hati! Di Python, nilai Boolean harus diawali huruf kapital: `True` dan `False`. Jika kamu menulis `true` atau `false`, Python akan error.']);
        // 6. Quiz
        \$this->createQuiz(\$lesson, 6, 'Penulisan boolean yang BENAR di Python adalah?', [['id' => 'A', 'text' => 'is_playing = True', 'correct' => true], ['id' => 'B', 'text' => 'is_playing = true', 'correct' => false]]);

        // 7. Minigame: Code Arrange
        \$lesson->slides()->firstOrCreate(['order' => 7], [
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
        \$lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Tipe Data yang Tepat! 🧩',
            'content' => 'Lengkapi tipe data berikut.',
            'options' => [
                ['type' => 'text', 'value' => 'uang = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '\\npesan = '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '\\nberhasil = '],
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
        \$lesson->slides()->firstOrCreate(['order' => 9], [
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
EOT;

// Lesson 3
$lesson3 = <<<EOT
    private function createPythonLesson3(\$course)
    {
        \$lesson = Lesson::firstOrCreate(
            ['slug' => 'operator-python'],
            [
                'course_id' => \$course->id, 'title' => 'Operator Matematika & Logika',
                'content' => 'Menghitung dan membandingkan layaknya kalkulator super.', 'video_url' => null, 'order' => 3, 'xp_reward' => 35,
            ]);

        // 1. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Matematika Dasar', 'content' => "Python bisa jadi kalkulator!\\nPenjumlahan: `+`\\nPengurangan: `-`\\nPerkalian: `*`\\nPembagian: `/` (hasilnya Float)\\nSisa Bagi (Modulo): `%`"]);
        // 2. Quiz
        \$this->createQuiz(\$lesson, 2, 'Simbol apa yang digunakan untuk perkalian di Python?', [['id' => 'A', 'text' => 'x', 'correct' => false], ['id' => 'B', 'text' => '*', 'correct' => true]]);

        // 3. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Pangkat dan Modulo', 'content' => 'Untuk memangkatkan angka, gunakan `**` (contoh: `2 ** 3` artinya 2 pangkat 3 = 8). Modulo `%` digunakan untuk mencari sisa pembagian (contoh: `10 % 3` hasilnya 1).']);
        // 4. Quiz
        \$this->createQuiz(\$lesson, 4, 'Berapa hasil dari `5 % 2`?', [['id' => 'A', 'text' => '1', 'correct' => true], ['id' => 'B', 'text' => '2.5', 'correct' => false]]);

        // 5. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Operator Logika', 'content' => 'Di Python, operator logika menggunakan kata bahasa Inggris biasa: `and`, `or`, dan `not`. Ini jauh lebih mudah dibaca daripada simbol `&&` atau `||` di bahasa lain!']);
        // 6. Quiz
        \$this->createQuiz(\$lesson, 6, 'Bagaimana cara menulis "A dan B" di Python?', [['id' => 'A', 'text' => 'A and B', 'correct' => true], ['id' => 'B', 'text' => 'A && B', 'correct' => false]]);

        // 7. Minigame: Code Arrange
        \$lesson->slides()->firstOrCreate(['order' => 7], [
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
        \$lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Hitungan Ajaib! ✨',
            'content' => 'Lengkapi operator untuk menghitung sisa bagi dan pangkat.',
            'options' => [
                ['type' => 'text', 'value' => 'sisa_bagi = 10 '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' 3\\npangkat = 2 '],
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
        \$lesson->slides()->firstOrCreate(['order' => 9], [
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
EOT;

file_put_contents('python_part1.php', "<?php\n\n" . $lesson1 . "\n\n" . $lesson2 . "\n\n" . $lesson3 . "\n");
echo "Part 1 created.";

