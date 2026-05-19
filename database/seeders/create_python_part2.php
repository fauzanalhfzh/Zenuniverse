<?php

$lessons = [];

// Lesson 4
$lesson4 = <<<EOT
    private function createPythonLesson4(\$course)
    {
        \$lesson = Lesson::firstOrCreate(
            ['slug' => 'struktur-kontrol-if-else'],
            [
                'course_id' => \$course->id, 'title' => 'Struktur Kontrol: If-Else',
                'content' => 'Membuat program yang bisa mengambil keputusan.', 'video_url' => null, 'order' => 4, 'xp_reward' => 40,
            ]);

        // 1. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Percabangan if', 'content' => "Python menggunakan indentasi (spasi menjorok ke dalam) untuk menandai blok kode. Contoh:\\n`if nilai > 80:`\\n`    print(\"Lulus!\")`\\nJangan lupakan titik dua (:) di akhir statement if!"]);
        // 2. Quiz
        \$this->createQuiz(\$lesson, 2, 'Apa tanda yang wajib ada di akhir baris "if" di Python?', [['id' => 'A', 'text' => 'Titik Koma (;)', 'correct' => false], ['id' => 'B', 'text' => 'Titik Dua (:)', 'correct' => true]]);

        // 3. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Indentasi itu WAJIB', 'content' => 'Di bahasa lain, blok if ditandai dengan kurung kurawal `{}`. Di Python, kamu **wajib** menggunakan spasi (biasanya 4 spasi atau 1 tab). Jika salah indentasi, Python akan error (IndentationError).']);
        // 4. Quiz
        \$this->createQuiz(\$lesson, 4, 'Bagaimana cara Python mengenali kode yang ada di dalam blok if?', [['id' => 'A', 'text' => 'Menggunakan Indentasi (spasi/tab)', 'correct' => true], ['id' => 'B', 'text' => 'Menggunakan kurung kurawal {}', 'correct' => false]]);

        // 5. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'elif dan else', 'content' => "Jika ingin mengecek kondisi lain, gunakan `elif` (singkatan dari else if).\\nJika semua kondisi salah, gunakan `else`.\\nContoh:\\n`if nilai == 100:`\\n`    print('Sempurna')`\\n`elif nilai >= 80:`\\n`    print('Bagus')`\\n`else:`\\n`    print('Belajar lagi')`"]);
        // 6. Quiz
        \$this->createQuiz(\$lesson, 6, 'Apa kata kunci untuk "Else If" di Python?', [['id' => 'A', 'text' => 'elseif', 'correct' => false], ['id' => 'B', 'text' => 'elif', 'correct' => true]]);

        // 7. Minigame: Code Arrange
        \$lesson->slides()->firstOrCreate(['order' => 7], [
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
        \$lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi Kondisi! 📝',
            'content' => 'Isi bagian yang kosong untuk membuat logika kelulusan.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' nilai >= 75'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '\\n    print("Lulus")\\n'],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ':\\n    print("Gagal")'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'if', 'color' => 'blue'],
                ['id' => 2, 'text' => ':', 'color' => 'orange'],
                ['id' => 3, 'text' => 'else', 'color' => 'green'],
            ]),
            'explanation' => 'Kata kunci `if`, diikuti titik dua `:`, lalu blok `else` untuk sisanya.',
        ]);

        // 9. Minigame: Block Code
        \$lesson->slides()->firstOrCreate(['order' => 9], [
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
EOT;

// Lesson 5
$lesson5 = <<<EOT
    private function createPythonLesson5(\$course)
    {
        \$lesson = Lesson::firstOrCreate(
            ['slug' => 'struktur-data-list'],
            [
                'course_id' => \$course->id, 'title' => 'Struktur Data: List',
                'content' => 'Menyimpan banyak data dalam satu antrean (Array).', 'video_url' => null, 'order' => 5, 'xp_reward' => 40,
            ]);

        // 1. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu List?', 'content' => 'Di Python, Array disebut **List**. List ditandai dengan kurung siku `[]`.\\nContoh: `buah = ["Apel", "Mangga", "Jeruk"]`\\nList bisa berisi teks, angka, bahkan campuran!']);
        // 2. Quiz
        \$this->createQuiz(\$lesson, 2, 'Kurung apa yang digunakan untuk membuat List di Python?', [['id' => 'A', 'text' => 'Kurung biasa ()', 'correct' => false], ['id' => 'B', 'text' => 'Kurung siku []', 'correct' => true]]);

        // 3. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Indeks dimulai dari 0', 'content' => 'Sama seperti bahasa lain, indeks List di Python dimulai dari 0.\\n`print(buah[0])` akan mencetak "Apel".\\nKerennya, Python bisa pakai indeks minus! `buah[-1]` akan mengambil elemen paling akhir ("Jeruk").']);
        // 4. Quiz
        \$this->createQuiz(\$lesson, 4, 'Apa hasil dari buah[-1] jika buah = ["A", "B", "C"]?', [['id' => 'A', 'text' => 'Error', 'correct' => false], ['id' => 'B', 'text' => '"C"', 'correct' => true]]);

        // 5. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Menambah & Menghapus', 'content' => "Untuk menambah item ke akhir List, gunakan `.append()`.\\n`buah.append(\"Pisang\")`\\nUntuk menghapus item, bisa pakai `.remove(\"Apel\")` atau `.pop()` (menghapus yang terakhir)."]);
        // 6. Quiz
        \$this->createQuiz(\$lesson, 6, 'Bagaimana cara menambahkan "Pisang" ke List buah?', [['id' => 'A', 'text' => 'buah.append("Pisang")', 'correct' => true], ['id' => 'B', 'text' => 'buah.add("Pisang")', 'correct' => false]]);

        // 7. Minigame: Code Arrange
        \$lesson->slides()->firstOrCreate(['order' => 7], [
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
        \$lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Isi List-mu! 📦',
            'content' => 'Lengkapi kode pengelolaan List ini.',
            'options' => [
                ['type' => 'text', 'value' => 'hero = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '"Layla", "Gord"'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '\\nhero.'],
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
        \$lesson->slides()->firstOrCreate(['order' => 9], [
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
EOT;

// Lesson 6
$lesson6 = <<<EOT
    private function createPythonLesson6(\$course)
    {
        \$lesson = Lesson::firstOrCreate(
            ['slug' => 'perulangan-for-loop'],
            [
                'course_id' => \$course->id, 'title' => 'Perulangan: For Loop',
                'content' => 'Mengulang kode tanpa capek.', 'video_url' => null, 'order' => 6, 'xp_reward' => 45,
            ]);

        // 1. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Python For Loop', 'content' => "For loop di Python sangat intuitif, biasanya digunakan untuk menyusuri List (Iterable).\\n`for buah in keranjang:`\\n`    print(buah)`\\nIni akan mencetak semua isi keranjang satu per satu."]);
        // 2. Quiz
        \$this->createQuiz(\$lesson, 2, 'Apa kegunaan utama For Loop di Python?', [['id' => 'A', 'text' => 'Membuat variabel', 'correct' => false], ['id' => 'B', 'text' => 'Mengulangi elemen di dalam List/Koleksi', 'correct' => true]]);

        // 3. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Fungsi range()', 'content' => "Jika kamu ingin mengulang angka (misal: 0 sampai 4), gunakan fungsi `range()`.\\n`for i in range(5):`\\n`    print(i)`\\nIni akan mencetak angka 0, 1, 2, 3, 4. (Berhenti sebelum 5!)"]);
        // 4. Quiz
        \$this->createQuiz(\$lesson, 4, 'Fungsi apa yang digunakan untuk membuat urutan angka di For Loop?', [['id' => 'A', 'text' => 'range()', 'correct' => true], ['id' => 'B', 'text' => 'number()', 'correct' => false]]);

        // 5. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'range(start, stop)', 'content' => "Kamu juga bisa menentukan angka mulai dan selesai.\\n`range(1, 4)` akan menghasilkan angka 1, 2, 3.\\n(Ingat, angka 'stop' tidak pernah diikutkan)."]);
        // 6. Quiz
        \$this->createQuiz(\$lesson, 6, 'Apa hasil dari range(2, 5)?', [['id' => 'A', 'text' => '2, 3, 4', 'correct' => true], ['id' => 'B', 'text' => '2, 3, 4, 5', 'correct' => false]]);

        // 7. Minigame: Code Arrange
        \$lesson->slides()->firstOrCreate(['order' => 7], [
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
        \$lesson->slides()->firstOrCreate(['order' => 8], [
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
                ['type' => 'text', 'value' => '(5):\\n    print(i)'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'for', 'color' => 'blue'],
                ['id' => 2, 'text' => 'in', 'color' => 'orange'],
                ['id' => 3, 'text' => 'range', 'color' => 'green'],
            ]),
            'explanation' => 'Strukturnya adalah: `for` <variabel> `in` <koleksi>:',
        ]);

        // 9. Minigame: Block Code
        \$lesson->slides()->firstOrCreate(['order' => 9], [
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
EOT;

file_put_contents('python_part2.php', "<?php\n\n" . $lesson4 . "\n\n" . $lesson5 . "\n\n" . $lesson6 . "\n");
echo "Part 2 created.";

