<?php

$lessons = [];

// Lesson 7
$lesson7 = <<<EOT
    private function createPythonLesson7(\$course)
    {
        \$lesson = Lesson::firstOrCreate(
            ['slug' => 'perulangan-while-loop'],
            [
                'course_id' => \$course->id, 'title' => 'Perulangan: While Loop',
                'content' => 'Looping tanpa batas (jika tidak hati-hati).', 'video_url' => null, 'order' => 7, 'xp_reward' => 45,
            ]);

        // 1. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Python While Loop', 'content' => "For Loop digunakan kalau kita tahu berapa kali harus mengulang. Tapi kalau tidak tahu? Gunakan **While Loop**!\\nWhile loop akan berjalan TERUS selama kondisinya True.\\n`while nyawa > 0:`\\n`    print(\"Main terus!\")`"]);
        // 2. Quiz
        \$this->createQuiz(\$lesson, 2, 'Kapan While Loop akan berhenti?', [['id' => 'A', 'text' => 'Saat kondisinya menjadi False', 'correct' => true], ['id' => 'B', 'text' => 'Saat sudah diulang 10 kali', 'correct' => false]]);

        // 3. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Bahaya Infinite Loop', 'content' => "Karena While loop berjalan terus jika kondisi True, kamu HARUS mengubah kondisi di dalam loop-nya, atau dia tidak akan pernah berhenti (Infinite Loop)!\\nContoh:\\n`angka = 1`\\n`while angka < 5:`\\n`    print(angka)`\\n`    angka = angka + 1` # <-- Sangat penting!"]);
        // 4. Quiz
        \$this->createQuiz(\$lesson, 4, 'Apa yang terjadi jika kamu lupa mengubah variabel kondisi di dalam While Loop?', [['id' => 'A', 'text' => 'Program berhenti', 'correct' => false], ['id' => 'B', 'text' => 'Infinite loop (Macam komputer hang)', 'correct' => true]]);

        // 5. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Break dan Continue', 'content' => "Ada senjata rahasia di dalam Loop:\\n1. **break**: Menghentikan loop secara paksa.\\n2. **continue**: Melompati sisa kode di iterasi ini dan lanjut ke putaran loop berikutnya."]);
        // 6. Quiz
        \$this->createQuiz(\$lesson, 6, 'Perintah apa yang digunakan untuk memaksa Loop berhenti sebelum waktunya?', [['id' => 'A', 'text' => 'stop', 'correct' => false], ['id' => 'B', 'text' => 'break', 'correct' => true]]);

        // 7. Minigame: Code Arrange
        \$lesson->slides()->firstOrCreate(['order' => 7], [
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
        \$lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi While-mu! 🔄',
            'content' => 'Isi bagian yang kosong.',
            'options' => [
                ['type' => 'text', 'value' => 'hp = 100\\n'],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' hp > 0:\\n    print("Berjuang!")\\n    hp = hp - 20\\n    if hp == 20:\\n        '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'while', 'color' => 'blue'],
                ['id' => 2, 'text' => 'break', 'color' => 'orange'],
            ]),
            'explanation' => 'Gunakan while untuk loop kondisi, dan break untuk berhenti paksa saat hp 20.',
        ]);

        // 9. Minigame: Block Code
        \$lesson->slides()->firstOrCreate(['order' => 9], [
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
EOT;

// Lesson 8
$lesson8 = <<<EOT
    private function createPythonLesson8(\$course)
    {
        \$lesson = Lesson::firstOrCreate(
            ['slug' => 'struktur-data-dictionary'],
            [
                'course_id' => \$course->id, 'title' => 'Struktur Data: Dictionary',
                'content' => 'Kamus data yang serbaguna.', 'video_url' => null, 'order' => 8, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Dictionary?', 'content' => "Selain List, Python punya struktur data andalan: **Dictionary**. Ditandai dengan kurung kurawal `{}`.\\nBedanya dengan List yang pakai nomor urut (Indeks), Dictionary menggunakan sistem **Key-Value** (Kunci dan Nilai)."]);
        // 2. Quiz
        \$this->createQuiz(\$lesson, 2, 'Simbol kurung apa yang digunakan Dictionary?', [['id' => 'A', 'text' => 'Kurung kurawal {}', 'correct' => true], ['id' => 'B', 'text' => 'Kurung siku []', 'correct' => false]]);

        // 3. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Key-Value Pairs', 'content' => "Contoh:\\n`siswa = { 'nama': 'Budi', 'umur': 15, 'lulus': True }`\\nDi sini, 'nama', 'umur', dan 'lulus' adalah **Key** (Kunci).\\n'Budi', 15, dan True adalah **Value** (Nilainya)."]);
        // 4. Quiz
        \$this->createQuiz(\$lesson, 4, 'Pada `siswa = {"umur": 15}`, bagian "umur" disebut sebagai?', [['id' => 'A', 'text' => 'Value', 'correct' => false], ['id' => 'B', 'text' => 'Key', 'correct' => true]]);

        // 5. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Mengakses Data', 'content' => "Untuk mengambil data 'umur', kita tidak pakai `siswa[1]` seperti di List, tapi langsung pakai namanya: `siswa['umur']`.\\nMaka Python akan mereturn `15`."]);
        // 6. Quiz
        \$this->createQuiz(\$lesson, 6, 'Bagaimana cara mengambil nilai umur dari Dictionary siswa?', [['id' => 'A', 'text' => 'siswa["umur"]', 'correct' => true], ['id' => 'B', 'text' => 'siswa[1]', 'correct' => false]]);

        // 7. Minigame: Code Arrange
        \$lesson->slides()->firstOrCreate(['order' => 7], [
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
        \$lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Isi Profilmu! 👤',
            'content' => 'Lengkapi kode Dictionary berikut.',
            'options' => [
                ['type' => 'text', 'value' => 'profil = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '\\n    "nama": "Ali"'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '\\n    "skor": 100\\n}\\nprint(profil['],
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
        \$lesson->slides()->firstOrCreate(['order' => 9], [
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
EOT;

// Lesson 9
$lesson9 = <<<EOT
    private function createPythonLesson9(\$course)
    {
        \$lesson = Lesson::firstOrCreate(
            ['slug' => 'fungsi-python'],
            [
                'course_id' => \$course->id, 'title' => 'Fungsi (Functions)',
                'content' => 'Blok kode pintar yang bisa dipanggil kapan saja.', 'video_url' => null, 'order' => 9, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Membuat Fungsi', 'content' => "Di Python, fungsi dideklarasikan dengan kata kunci `def`.\\nContoh:\\n`def sapa():`\\n`    print(\"Halo bro!\")`\\nIngat titik dua (:) dan indentasinya!"]);
        // 2. Quiz
        \$this->createQuiz(\$lesson, 2, 'Apa kata kunci untuk membuat fungsi di Python?', [['id' => 'A', 'text' => 'function', 'correct' => false], ['id' => 'B', 'text' => 'def', 'correct' => true]]);

        // 3. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Parameter', 'content' => "Fungsi bisa menerima data masuk (parameter).\\n`def sapa(nama):`\\n`    print(\"Halo \" + nama)`\\nJika kita panggil `sapa(\"Budi\")`, maka akan muncul 'Halo Budi'."]);
        // 4. Quiz
        \$this->createQuiz(\$lesson, 4, 'Berdasarkan fungsi di atas, "nama" bertindak sebagai?', [['id' => 'A', 'text' => 'Parameter', 'correct' => true], ['id' => 'B', 'text' => 'Keyword khusus Python', 'correct' => false]]);

        // 5. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Return Value', 'content' => "Fungsi tidak hanya print, tapi bisa melempar nilai kembali (Return) pakai `return`.\\n`def tambah(a, b):`\\n`    return a + b`\\n`hasil = tambah(5, 5)`\\nSekarang `hasil` bernilai 10!"]);
        // 6. Quiz
        \$this->createQuiz(\$lesson, 6, 'Bagaimana cara mengirim hasil hitungan ke luar fungsi di Python?', [['id' => 'A', 'text' => 'print', 'correct' => false], ['id' => 'B', 'text' => 'return', 'correct' => true]]);

        // 7. Minigame: Code Arrange
        \$lesson->slides()->firstOrCreate(['order' => 7], [
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
        \$lesson->slides()->firstOrCreate(['order' => 8], [
            'type' => 'code_fillblank',
            'title' => 'Siapkan Fungsinya! 🔧',
            'content' => 'Lengkapi sintaks pembuatan fungsi ini.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' ucap_selamat(nama)'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '\\n    pesan = "Selamat " + nama\\n    '],
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
        \$lesson->slides()->firstOrCreate(['order' => 9], [
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
EOT;

// Lesson 10
$lesson10 = <<<EOT
    private function createPythonLesson10(\$course)
    {
        \$lesson = Lesson::firstOrCreate(
            ['slug' => 'mini-project-python'],
            [
                'course_id' => \$course->id, 'title' => 'Mini Project: Game Tebak Angka',
                'content' => 'Menggabungkan semua ilmu Python-mu.', 'video_url' => null, 'order' => 10, 'xp_reward' => 100,
            ]);

        // 1. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Selamat!', 'content' => "Kamu sudah sampai di proyek akhir tingkat dasar!\\nKita akan menggabungkan: Variabel, If-Else, dan Loop untuk membuat Game Tebak Angka sederhana."]);
        // 2. Quiz
        \$this->createQuiz(\$lesson, 2, 'Apa saja komponen yang bisa digabungkan untuk membuat program yang kompleks?', [['id' => 'A', 'text' => 'Hanya print saja', 'correct' => false], ['id' => 'B', 'text' => 'Variabel, Struktur Kontrol, dan Loop', 'correct' => true]]);

        // 3. Trivia
        \$lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Konsep Game', 'content' => "Alur gamenya:\\n1. Tentukan angka rahasia.\\n2. Gunakan While loop yang meminta tebakan user (pakai fungsi `input()`).\\n3. Jika tebakan benar, loop berhenti (break) dan print 'Menang!'."]);
        // 4. Quiz
        \$this->createQuiz(\$lesson, 4, 'Fungsi Python apa yang digunakan untuk meminta input dari user di terminal?', [['id' => 'A', 'text' => 'input()', 'correct' => true], ['id' => 'B', 'text' => 'ask()', 'correct' => false]]);

        // 5. Minigame: Code Arrange
        \$lesson->slides()->firstOrCreate(['order' => 5], [
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
        \$lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Tambahkan Petunjuk! 힌트',
            'content' => 'Lengkapi kode dengan else if (elif) agar game memberikan petunjuk terlalu besar/kecil.',
            'options' => [
                ['type' => 'text', 'value' => '    if tebakan == rahasia:\\n        print("Benar!")\\n        break\\n    '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' tebakan > rahasia:\\n        print("Terlalu Besar!")\\n    '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ':\\n        print("Terlalu Kecil!")'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'elif', 'color' => 'blue'],
                ['id' => 2, 'text' => 'else', 'color' => 'orange'],
            ]),
            'explanation' => 'elif untuk kondisi khusus ("apakah lebih besar?"), lalu else untuk semua kemungkinan sisa ("artinya lebih kecil").',
        ]);
    }
EOT;

file_put_contents('python_part3.php', "<?php\n\n" . $lesson7 . "\n\n" . $lesson8 . "\n\n" . $lesson9 . "\n\n" . $lesson10 . "\n");
echo "Part 3 created.";

