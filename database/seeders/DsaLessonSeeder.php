<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CreatesQuiz;

class DsaLessonSeeder extends Seeder
{
    use CreatesQuiz;

    public function run(): void
    {
        $course = Course::where('title', 'Struktur Data & Algoritma')->first();
        if (!$course) return;

        $this->createDsaLesson1($course);
        $this->createDsaLesson2($course);
        $this->createDsaLesson3($course);
        $this->createDsaLesson4($course);
        $this->createDsaLesson5($course);
    }

    private function createDsaLesson1($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pengenalan-algoritma'],
            [
                'course_id' => $course->id, 'title' => 'Pengenalan Algoritma',
                'content' => 'Resep rahasia untuk menyelesaikan masalah.', 'video_url' => null, 'order' => 1, 'xp_reward' => 70,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Algoritma?', 'content' => "Algoritma pada dasarnya hanyalah **urutan langkah-langkah** yang logis untuk menyelesaikan sebuah masalah.\nSama seperti resep membuat mie instan: 1. Rebus air, 2. Masukkan mie, 3. Tuang bumbu, 4. Sajikan."]);
        $this->createQuiz($lesson, 2, 'Manakah pernyataan yang paling tepat tentang Algoritma?', [['id' => 'A', 'text' => 'Bahasa pemrograman baru pengganti Python', 'correct' => false], ['id' => 'B', 'text' => 'Urutan langkah-langkah logis untuk menyelesaikan masalah', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Pseudo-code', 'content' => "**Pseudo-code** adalah cara menulis algoritma dengan bahasa manusia yang dicampur bahasa mesin, agar mudah dipahami programmer mana pun sebelum ditulis kode aslinya.\nContoh: `JIKA lapar MAKA makan()`"]);
        $this->createQuiz($lesson, 4, 'Bahasa penengah antara bahasa manusia dan bahasa pemrograman disebut?', [['id' => 'A', 'text' => 'Pseudo-code', 'correct' => true], ['id' => 'B', 'text' => 'Machine code', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Algoritma Kopi ☕',
            'content' => 'Susun algoritma (pseudo-code) membuat kopi yang benar.',
            'options' => [
                ['id' => 1, 'text' => 'AMBIL gelas'],
                ['id' => 2, 'text' => 'MASUKKAN bubuk kopi dan gula'],
                ['id' => 3, 'text' => 'TUANGKAN air panas'],
                ['id' => 4, 'text' => 'ADUK hingga rata'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Algoritma harus berurutan. Tidak mungkin menuang air jika belum ada gelasnya.',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Logika Sandi 🔒',
            'content' => 'Lengkapi pseudo-code sistem login ini.',
            'options' => [
                ['type' => 'text', 'value' => 'BACA password_input\n'],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' password_input SAMA DENGAN "12345" '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '\n    TAMPILKAN "Akses Diberikan"\n'],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => '\n    TAMPILKAN "Password Salah"\nAKHIRI JIKA'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'JIKA', 'color' => 'blue'],
                ['id' => 2, 'text' => 'MAKA', 'color' => 'orange'],
                ['id' => 3, 'text' => 'LAINNYA', 'color' => 'green'],
            ]),
            'explanation' => 'JIKA (If), MAKA (Then), LAINNYA (Else). Ini adalah struktur kontrol dasar algoritma.',
        ]);
    }

    private function createDsaLesson2($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'big-o-notation'],
            [
                'course_id' => $course->id, 'title' => 'Big O Notation (Dasar)',
                'content' => 'Mengukur kecepatan kodemu.', 'video_url' => null, 'order' => 2, 'xp_reward' => 75,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Waktu Eksekusi', 'content' => "Komputer bisa memproses jutaan data. Pertanyaannya: Jika data bertambah banyak, apakah kodemu akan semakin lambat?\nUntuk mengukurnya, Computer Science memakai konsep **Big O Notation**."]);
        $this->createQuiz($lesson, 2, 'Apa tujuan utama dari mempelajari Big O Notation?', [['id' => 'A', 'text' => 'Untuk mengukur efisiensi (kecepatan & memori) algoritma', 'correct' => true], ['id' => 'B', 'text' => 'Untuk membuat tulisan membesar di HTML', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'O(1) vs O(n)', 'content' => "**O(1)** Konstan: Kecepatan selalu sama walau data ada 1 miliar (Cth: akses array index ke-5).\n**O(n)** Linear: Waktu bertambah lambat seiring jumlah data (Cth: For Loop dari awal sampai akhir)."]);
        $this->createQuiz($lesson, 4, 'Sebuah algoritma menggunakan perulangan FOR dari awal hingga akhir data. Notasi Big O manakah ini?', [['id' => 'A', 'text' => 'O(1)', 'correct' => false], ['id' => 'B', 'text' => 'O(n)', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Tingkat Kecepatan 🏎️',
            'content' => 'Susun Notasi Big O ini dari yang PALING CEPAT hingga PALING LAMBAT.',
            'options' => [
                ['id' => 1, 'text' => 'O(1) - Instan'],
                ['id' => 2, 'text' => 'O(log n) - Sangat Cepat (Membelah data)'],
                ['id' => 3, 'text' => 'O(n) - Linear (Seiring data)'],
                ['id' => 4, 'text' => 'O(n^2) - Sangat Lambat (Loop dalam Loop)'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Kita ingin selalu menargetkan algoritma kita mendekati O(1) atau O(log n).',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Uji Kecepatan ⏱️',
            'content' => 'Pilih notasi O yang tepat.',
            'options' => [
                ['type' => 'text', 'value' => 'Mengambil item pertama dari tas selalu memakan waktu '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '.\nSedangkan mencari item yang hilang dengan memeriksa SELURUH isi tas satu per satu memakan waktu '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'O(1)', 'color' => 'blue'],
                ['id' => 2, 'text' => 'O(n)', 'color' => 'orange'],
            ]),
            'explanation' => 'O(1) itu langsung dapat (instan). O(n) itu harus mengecek semuanya (linear).',
        ]);
    }

    private function createDsaLesson3($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'array-vs-linked-list'],
            [
                'course_id' => $course->id, 'title' => 'Array vs Linked List',
                'content' => 'Dua cara berbaris di memori komputer.', 'video_url' => null, 'order' => 3, 'xp_reward' => 80,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Array (Antrean Tetap)', 'content' => "**Array** menyimpan data bersebelahan di memori. Kelebihannya: Sangat cepat mengambil data dengan indeks misal `data[5]`. Kelemahannya: Susah untuk menambah data di tengah-tengah karena semuanya harus bergeser."]);
        $this->createQuiz($lesson, 2, 'Apa keunggulan utama dari struktur data Array?', [['id' => 'A', 'text' => 'Mudah menyisipkan data di tengah-tengah antrean', 'correct' => false], ['id' => 'B', 'text' => 'Sangat cepat mengakses data jika indeksnya diketahui', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Linked List (Rantai Bebas)', 'content' => "**Linked List** menyimpan data secara acak di memori, tapi setiap data punya 'tali' yang menunjuk ke data berikutnya.\nKelebihannya: Sangat cepat menyisipkan data baru di mana saja."]);
        $this->createQuiz($lesson, 4, 'Di Linked List, setiap elemen menyimpan datanya dan sebuah "tali penunjuk" ke elemen berikutnya. Tali ini disebut?', [['id' => 'A', 'text' => 'Pointer / Node', 'correct' => true], ['id' => 'B', 'text' => 'Index Array', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Rantai Node 🔗',
            'content' => 'Susun ilustrasi struktur dasar Linked List.',
            'options' => [
                ['id' => 1, 'text' => 'Head (Kepala Rantai)'],
                ['id' => 2, 'text' => 'Node A -> menunjuk ke -> Node B'],
                ['id' => 3, 'text' => 'Node B -> menunjuk ke -> Node C'],
                ['id' => 4, 'text' => 'Node C -> menunjuk ke -> Null (Akhir)'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Linked list dimulai dari Head, lalu menyambung seperti gerbong kereta hingga ujungnya Null.',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Pilih Senjatamu! ⚔️',
            'content' => 'Tentukan struktur data mana yang lebih baik.',
            'options' => [
                ['type' => 'text', 'value' => 'Jika aplikasiku sering membaca/mencari data indeks tertentu secara cepat, aku akan menggunakan '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '.\nNamun jika aplikasiku sering menyisipkan dan menghapus data di tengah jalan, aku akan memilih '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Array', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Linked List', 'color' => 'orange'],
            ]),
            'explanation' => 'Array menang di kecepatan Akses (O(1)). Linked List menang di kecepatan Modifikasi (O(1)).',
        ]);
    }

    private function createDsaLesson4($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'stack-and-queue'],
            [
                'course_id' => $course->id, 'title' => 'Stack & Queue',
                'content' => 'Tumpukan piring vs Antrean kasir.', 'video_url' => null, 'order' => 4, 'xp_reward' => 85,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Stack (Tumpukan)', 'content' => "**Stack** memakai prinsip **LIFO** (Last In, First Out). Yang terakhir masuk, yang pertama keluar.\nBayangkan tumpukan piring: Piring terakhir yang ditaruh di atas, akan menjadi piring pertama yang diambil."]);
        $this->createQuiz($lesson, 2, 'Fitur "Undo" (Ctrl+Z) di komputer paling cocok menggunakan struktur data apa?', [['id' => 'A', 'text' => 'Stack (LIFO)', 'correct' => true], ['id' => 'B', 'text' => 'Queue (FIFO)', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Queue (Antrean)', 'content' => "**Queue** memakai prinsip **FIFO** (First In, First Out). Yang pertama masuk, yang pertama keluar.\nBayangkan antrean kasir: Orang yang pertama antre akan dilayani duluan."]);
        $this->createQuiz($lesson, 4, 'Sistem antrean tiket bioskop menggunakan prinsip data apa?', [['id' => 'A', 'text' => 'Stack (LIFO)', 'correct' => false], ['id' => 'B', 'text' => 'Queue (FIFO)', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Tumpuk Piring 🍽️',
            'content' => 'Susun instruksi Stack ini secara berurutan dari piring masuk sampai keluar.',
            'options' => [
                ['id' => 1, 'text' => 'push("Piring Merah") # Piring paling bawah'],
                ['id' => 2, 'text' => 'push("Piring Biru")  # Piring di atasnya'],
                ['id' => 3, 'text' => 'push("Piring Kaca")  # Piring paling atas'],
                ['id' => 4, 'text' => 'pop() # Mengambil Piring Kaca!'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Operasi tambah di Stack disebut Push. Operasi ambil disebut Pop.',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Singkatan Penting 🔠',
            'content' => 'Lengkapi kepanjangan LIFO dan FIFO.',
            'options' => [
                ['type' => 'text', 'value' => 'Stack itu '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' (Last In First Out), data terakhir masuk akan keluar duluan.\nQueue itu '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' (First In First Out), data pertama masuk akan keluar duluan.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'LIFO', 'color' => 'blue'],
                ['id' => 2, 'text' => 'FIFO', 'color' => 'orange'],
            ]),
            'explanation' => 'LIFO (Last In First Out) untuk Tumpukan. FIFO (First In First Out) untuk Antrean.',
        ]);
    }

    private function createDsaLesson5($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'searching-algorithm'],
            [
                'course_id' => $course->id, 'title' => 'Searching Algorithm',
                'content' => 'Seni mencari jarum di tumpukan jerami.', 'video_url' => null, 'order' => 5, 'xp_reward' => 100,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Linear Search', 'content' => "**Linear Search** mencari data dengan mengeceknya satu per satu dari awal sampai akhir.\nCocok untuk data acak, tapi sangat lambat O(n) jika datanya jutaan."]);
        $this->createQuiz($lesson, 2, 'Mengapa Linear Search sangat lambat untuk data yang besar?', [['id' => 'A', 'text' => 'Karena ia mengecek datanya satu per satu dari urutan paling depan', 'correct' => true], ['id' => 'B', 'text' => 'Karena ia membutuhkan RAM terlalu banyak', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Binary Search (Tebak Angka)', 'content' => "**Binary Search** sangat cepat O(log n), tapi SYARATNYA: data harus sudah **berurutan (sorted)**!\nCaranya dengan selalu memotong data jadi dua bagian dan menebak nilai tengahnya."]);
        $this->createQuiz($lesson, 4, 'Apa syarat WAJIB sebelum kita bisa memakai kehebatan Binary Search?', [['id' => 'A', 'text' => 'Datanya harus berbentuk Teks', 'correct' => false], ['id' => 'B', 'text' => 'Datanya sudah harus terurut secara ascending/descending', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Membelah Data 🔪',
            'content' => 'Susun langkah Binary Search saat mencari angka 7 di array [1,3,5,7,9].',
            'options' => [
                ['id' => 1, 'text' => 'Cek nilai tengah: 5'],
                ['id' => 2, 'text' => 'Karena 7 lebih besar dari 5, abaikan angka [1,3,5]'],
                ['id' => 3, 'text' => 'Sisa array: [7,9]. Cek nilai tengah: 7'],
                ['id' => 4, 'text' => 'Ketemu! Data ada di indeks ke-3.'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Binary search terus membelah data menjadi dua hingga target ditemukan. Ini yang membuatnya sangat cepat O(log n).',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Cari dan Temukan! 🔍',
            'content' => 'Lengkapi kesimpulan metode pencarian ini.',
            'options' => [
                ['type' => 'text', 'value' => 'Pencarian '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' cocok untuk data yang tidak terurut (acak).\nPencarian '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' sangat cepat namun mewajibkan data harus sudah diurutkan terlebih dahulu.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Linear', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Binary', 'color' => 'orange'],
            ]),
            'explanation' => 'Linear Search (Cari Lurus O(n)), Binary Search (Cari Belah O(log n)).',
        ]);
    }
}
