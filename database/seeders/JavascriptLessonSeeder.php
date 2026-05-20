<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CreatesQuiz;

class JavascriptLessonSeeder extends Seeder
{
    use CreatesQuiz;

    public function run(): void
    {
        $course = Course::where('title', 'JavaScript Development')->first();
        if (!$course) return;

        $this->createJsLesson1($course);
        $this->createJsLesson2($course);
        $this->createJsLesson3($course);
        $this->createJsLesson4($course);
        $this->createJsLesson5($course);
    }

    private function createJsLesson1($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pengenalan-javascript'],
            [
                'course_id' => $course->id, 'title' => 'Pengenalan JavaScript',
                'content' => 'Memberi nyawa pada halaman web.', 'video_url' => null, 'order' => 1, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu JavaScript?', 'content' => "JavaScript (JS) adalah bahasa pemrograman yang membuat website menjadi interaktif.\nTanpa JS, website hanya akan menampilkan teks mati. Dengan JS, kamu bisa membuat animasi, pop-up, dan game!"]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Apa fungsi utama JavaScript pada sebuah website?', [['id' => 'A', 'text' => 'Mendesain warna background', 'correct' => false], ['id' => 'B', 'text' => 'Membuat website menjadi interaktif', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Menyapa Dunia!', 'content' => "Di JS, kita bisa menampilkan teks ke layar kecil (Pop-up) menggunakan `alert()`, atau mencetaknya secara rahasia di layar belakang layar (Console) menggunakan `console.log()`."]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Perintah apa yang digunakan untuk mencetak pesan secara rahasia untuk programmer di dalam browser?', [['id' => 'A', 'text' => 'console.log()', 'correct' => true], ['id' => 'B', 'text' => 'alert()', 'correct' => false]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Sapaan Pertamamu 👋',
            'content' => 'Susun kode ini untuk memunculkan pesan peringatan lalu mencetak teks di console.',
            'options' => [
                ['id' => 1, 'text' => 'alert("Halo Dunia!");'],
                ['id' => 2, 'text' => 'console.log("Pesan ini rahasia");'],
            ],
            'correct_answer' => null, // Bebas selama barisnya benar logikanya
            'explanation' => 'alert() muncul ke user, sedangkan console.log() muncul di DevTools browser.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi Kodenya! 🧩',
            'content' => 'Lengkapi kode untuk memunculkan pop-up.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '("Selamat Datang!")'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'alert', 'color' => 'blue'],
                ['id' => 2, 'text' => ';', 'color' => 'orange'],
            ]),
            'explanation' => 'Fungsi alert memunculkan pop-up box, dan di JS kita disarankan mengakhiri baris dengan titik koma (;).',
        ]);
    }

    private function createJsLesson2($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'variabel-tipe-data-js'],
            [
                'course_id' => $course->id, 'title' => 'Variabel & Tipe Data JS',
                'content' => 'Menyimpan data di dalam memori JS.', 'video_url' => null, 'order' => 2, 'xp_reward' => 55,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Let dan Const', 'content' => "Berbeda dengan Python, di JavaScript kita harus mendeklarasikan variabel dengan kata kunci `let` atau `const`.\n`let` = Nilainya bisa diubah nanti.\n`const` = Nilainya tetap (konstan)."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Kata kunci apa yang digunakan untuk membuat variabel yang nilainya TIDAK BISA diubah?', [['id' => 'A', 'text' => 'let', 'correct' => false], ['id' => 'B', 'text' => 'const', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Tipe Data JS', 'content' => "Tipe data utamanya sama: String (Teks), Number (Angka), Boolean (True/False).\nNamun, jika variabel dibuat tapi belum diisi nilainya, tipe datanya adalah `undefined`!"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Apa tipe data dari variabel yang belum diisi nilai di JS?', [['id' => 'A', 'text' => 'undefined', 'correct' => true], ['id' => 'B', 'text' => 'null', 'correct' => false]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Identitas 🪪',
            'content' => 'Susun deklarasi variabel ini dengan tepat.',
            'options' => [
                ['id' => 1, 'text' => 'const nama = "Budi";'],
                ['id' => 2, 'text' => 'let umur = 20;'],
                ['id' => 3, 'text' => 'umur = 21;'],
            ],
            'correct_answer' => null,
            'explanation' => 'Kita memakai const untuk nama (tidak berubah), dan let untuk umur (karena bertambah).',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Variabel Konstan 🔒',
            'content' => 'Lengkapi kode untuk membuat nilai gravitasi yang tetap.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' gravitasi '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' 9.8;'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'const', 'color' => 'blue'],
                ['id' => 2, 'text' => '=', 'color' => 'orange'],
            ]),
            'explanation' => 'const digunakan agar nilai gravitasi tidak bisa diubah oleh kode lain.',
        ]);
    }

    private function createJsLesson3($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'fungsi-js'],
            [
                'course_id' => $course->id, 'title' => 'Fungsi (Functions)',
                'content' => 'Blok kode yang dapat dipanggil berulang kali.', 'video_url' => null, 'order' => 3, 'xp_reward' => 60,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Membuat Fungsi', 'content' => "Gunakan kata kunci `function` (di JS) bukan `def` (seperti Python).\nSintaks:\n`function sapa() {`\n`  alert(\"Halo!\");`\n`}`"]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Simbol apa yang membungkus isi/badan dari sebuah fungsi di JavaScript?', [['id' => 'A', 'text' => 'Titik dua ( : )', 'correct' => false], ['id' => 'B', 'text' => 'Kurung kurawal { }', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Arrow Function', 'content' => "JavaScript modern punya cara singkat membuat fungsi bernama **Arrow Function** `=>`.\n`const sapa = () => {`\n`  alert(\"Halo!\");`\n`}`"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Simbol apa yang disebut sebagai Arrow (Panah) di Arrow Function?', [['id' => 'A', 'text' => '=>', 'correct' => true], ['id' => 'B', 'text' => '->', 'correct' => false]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Mesin Hitung 🧮',
            'content' => 'Susun fungsi JS ini untuk mengembalikan hasil kuadrat.',
            'options' => [
                ['id' => 1, 'text' => 'function kuadrat(angka) {'],
                ['id' => 2, 'text' => '  return angka * angka;'],
                ['id' => 3, 'text' => '}'],
                ['id' => 4, 'text' => 'let hasil = kuadrat(5);'],
            ],
            'correct_answer' => null,
            'explanation' => 'Fungsi dideklarasikan dengan kurung kurawal, lalu dipanggil dari luar.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Panah Ajaib! 🏹',
            'content' => 'Lengkapi sintaks Arrow Function ini.',
            'options' => [
                ['type' => 'text', 'value' => 'const tambah = (a, b) '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '\n  return a + b;\n}'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '=>', 'color' => 'blue'],
                ['id' => 2, 'text' => '{', 'color' => 'orange'],
            ]),
            'explanation' => 'Arrow function didefinisikan dengan simbol panah (=>) yang mengarah ke kurung kurawal pembuka ({).',
        ]);
    }

    private function createJsLesson4($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'manipulasi-dom'],
            [
                'course_id' => $course->id, 'title' => 'Manipulasi DOM',
                'content' => 'Mengendalikan HTML dari JavaScript.', 'video_url' => null, 'order' => 4, 'xp_reward' => 65,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu DOM?', 'content' => "DOM (Document Object Model) adalah representasi HTML kita di dalam JS.\nKita bisa mengambil elemen HTML (seperti `<h1>` atau `<p>`) dari JS untuk diubah teksnya, warnanya, dll."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Melalui DOM, apakah JavaScript bisa mengubah teks pada halaman HTML?', [['id' => 'A', 'text' => 'Tidak bisa', 'correct' => false], ['id' => 'B', 'text' => 'Tentu bisa', 'correct' => true]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Menangkap Elemen', 'content' => "Cara paling terkenal adalah dengan: `document.getElementById('judul')`.\nSetelah tertangkap, kita ubah isinya dengan `.innerHTML`.\nContoh: `teks.innerHTML = 'Berubah!'`"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Properti apa yang diubah jika kita ingin mengganti teks/isi dari elemen HTML yang sudah ditangkap JS?', [['id' => 'A', 'text' => '.innerHTML', 'correct' => true], ['id' => 'B', 'text' => '.style', 'correct' => false]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Hacker Teks 🕵️',
            'content' => 'Susun kode ini untuk mengubah teks judul yang memiliki id="header".',
            'options' => [
                ['id' => 1, 'text' => 'let judul = document.getElementById("header");'],
                ['id' => 2, 'text' => 'judul.innerHTML = "Website Di-Hack!";'],
                ['id' => 3, 'text' => 'judul.style.color = "red";'],
            ],
            'correct_answer' => null,
            'explanation' => 'Kita tangkap dulu elemennya, baru ubah isi dan gayanya (style).',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Pencari ID 🔍',
            'content' => 'Lengkapi fungsi untuk mengambil elemen berdasarkan ID-nya.',
            'options' => [
                ['type' => 'text', 'value' => 'let kotak = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '.'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '("box_1");'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'document', 'color' => 'blue'],
                ['id' => 2, 'text' => 'getElementById', 'color' => 'orange'],
            ]),
            'explanation' => 'Kita menggunakan object global `document` dan method `getElementById`.',
        ]);
    }

    private function createJsLesson5($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'event-listener'],
            [
                'course_id' => $course->id, 'title' => 'Event Listener',
                'content' => 'Merespon setiap klik dari User.', 'video_url' => null, 'order' => 5, 'xp_reward' => 70,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Event Listener', 'content' => "JS bisa 'mendengarkan' apa yang dilakukan user. Klik tombol, menggerakkan mouse, atau mengetik di keyboard.\nCara tertua adalah menaruh atribut `onclick` di HTML-nya: `<button onclick=\"sapa()\">`."]);
        // 2. Quiz
        $this->createQuiz($lesson, 2, 'Atribut HTML apa yang mendeteksi jika tombol diklik user?', [['id' => 'A', 'text' => 'onclick', 'correct' => true], ['id' => 'B', 'text' => 'onmove', 'correct' => false]]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'addEventListener', 'content' => "Cara modern (dan lebih bersih) di JS adalah `addEventListener()`.\n`tombol.addEventListener('click', function() {`\n`  alert('Ditekan!');`\n`});`\nHHTML dan JS tidak lagi tercampur!"]);
        // 4. Quiz
        $this->createQuiz($lesson, 4, 'Apa kelebihan menggunakan addEventListener?', [['id' => 'A', 'text' => 'Memisahkan logika JS dari kode HTML', 'correct' => true], ['id' => 'B', 'text' => 'Website jadi berwarna warni otomatis', 'correct' => false]]);

        // 5. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Tombol Reaktif 🔘',
            'content' => 'Susun kode ini agar tombol berfungsi saat di-klik.',
            'options' => [
                ['id' => 1, 'text' => 'let btn = document.getElementById("tombolku");'],
                ['id' => 2, 'text' => 'btn.addEventListener("click", function() {'],
                ['id' => 3, 'text' => '  console.log("Klik terdeteksi!");'],
                ['id' => 4, 'text' => '});'],
            ],
            'correct_answer' => null,
            'explanation' => 'Tangkap elemennya, lalu pasang Pendengar Event (Event Listener) dengan mode click.',
        ]);

        // 6. Minigame: Fill in the Blank
        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Dengar Kliknya! 👂',
            'content' => 'Lengkapi kode Event Listener ini.',
            'options' => [
                ['type' => 'text', 'value' => 'tombol.'],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '("'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '", function() {\n  alert("Yay!");\n});'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'addEventListener', 'color' => 'blue'],
                ['id' => 2, 'text' => 'click', 'color' => 'orange'],
            ]),
            'explanation' => 'addEventListener menunggu event tertentu, dalam contoh ini adalah event click.',
        ]);
    }
}
