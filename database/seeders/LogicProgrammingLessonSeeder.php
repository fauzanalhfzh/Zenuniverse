<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CreatesQuiz;

class LogicProgrammingLessonSeeder extends Seeder
{
    use CreatesQuiz;

    public function run(): void
    {
        $course = Course::where('title', 'Logika Pemrograman Dasar')->first();
        if (!$course) return;

        // Lessons 1-5: Original
        $this->createLogicLesson1($course);
        $this->createLogicLesson2($course);
        $this->createLogicLesson3($course);
        $this->createLogicLesson4($course);
        $this->createLogicLesson5($course);

        // Lessons 6-7: From Set 2 (Operator Aritmatika & Logika)
        $this->createLogicLessonArithmetic($course);
        $this->createLogicLessonLogicOp($course);

        // Lessons 8-11: From Set 1 (Array, Fungsi, Argumen, Scope) - renumbered
        $this->createLogicLessonArray($course);
        $this->createLogicLessonFunctions($course);
        $this->createLogicLessonArguments($course);
        $this->createLogicLessonScope($course);

        // Lesson 12: Nested Loop from Set 2
        $this->createLogicLessonNestedLoop($course);

        // Lessons 13-18: From Set 1 (Debug, Stack, Search, Sort, Recursion, Modular) - renumbered
        $this->createLogicLessonDebugging($course);
        $this->createLogicLessonStackQueue($course);
        $this->createLogicLessonSearching($course);
        $this->createLogicLessonSorting($course);
        $this->createLogicLessonRecursion($course);
        $this->createLogicLessonModular($course);
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
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Variabel?', 'content' => 'Variabel adalah "wadah" untuk menyimpan nilai atau data dalam program. Setiap variabel punya nama unik sebagai pengenal.']);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 2, 'Fungsi utama variabel adalah?', [
            ['id' => 'A', 'text' => 'Menyimpan data', 'correct' => true],
            ['id' => 'B', 'text' => 'Menghapus data', 'correct' => false],
            ['id' => 'C', 'text' => 'Mencetak ke layar', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Analogi Kotak', 'content' => 'Bayangkan variabel seperti kotak kardus berlabel. Kamu bisa menaruh berbagai isi ke dalamnya dan mengambilnya kembali kapanpun dibutuhkan.']);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 4, 'Variabel paling mirip dengan?', [
            ['id' => 'A', 'text' => 'Kotak penyimpanan berlabel', 'correct' => true],
            ['id' => 'B', 'text' => 'Bola lampu', 'correct' => false],
            ['id' => 'C', 'text' => 'Kalender', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Integer', 'content' => 'Integer adalah tipe data untuk bilangan bulat tanpa koma, seperti: 5, 10, -3, 100. Digunakan untuk menghitung jumlah, skor, dll.']);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 6, 'Manakah yang merupakan Integer?', [
            ['id' => 'A', 'text' => '3.14', 'correct' => false],
            ['id' => 'B', 'text' => '100', 'correct' => true],
            ['id' => 'C', 'text' => '"Halo"', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'String', 'content' => 'String adalah tipe data untuk teks. Ditulis di antara tanda kutip, contoh: "Halo Dunia" atau "Nama Saya Budi".']);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 8, 'Tipe data untuk kalimat/teks adalah?', [
            ['id' => 'A', 'text' => 'Integer', 'correct' => false],
            ['id' => 'B', 'text' => 'String', 'correct' => true],
            ['id' => 'C', 'text' => 'Boolean', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Boolean', 'content' => 'Boolean hanya memiliki dua nilai: Benar (True) atau Salah (False). Dipakai untuk kondisi logika seperti "Apakah sudah login?".']);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 10, 'Nilai yang mungkin dari Boolean?', [
            ['id' => 'A', 'text' => 'True / False', 'correct' => true],
            ['id' => 'B', 'text' => 'A / B / C', 'correct' => false],
            ['id' => 'C', 'text' => '0 sampai 100', 'correct' => false],
        ]);

        // 11. Trivia tambahan — FloatW
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Float (Desimal)', 'content' => 'Float adalah tipe data untuk bilangan dengan koma/desimal, seperti: 3.14, 2.5, -0.75. Cocok untuk nilai mata uang atau pengukuran.']);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 12, 'Tipe data yang tepat untuk nilai 9.99?', [
            ['id' => 'A', 'text' => 'Integer', 'correct' => false],
            ['id' => 'B', 'text' => 'Float', 'correct' => true],
            ['id' => 'C', 'text' => 'Boolean', 'correct' => false],
        ]);

        // 13. Trivia tambahan — Penamaan
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Aturan Penamaan Variabel', 'content' => "Nama variabel harus:\n- Dimulai dengan huruf atau garis bawah (_)\n- Tidak boleh ada spasi (gunakan _ atau camelCase)\n- Deskriptif agar mudah dipahami (contoh: namaUser bukan x)."]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 14, 'Nama variabel yang benar adalah?', [
            ['id' => 'A', 'text' => 'nama user', 'correct' => false],
            ['id' => 'B', 'text' => 'namaUser', 'correct' => true],
            ['id' => 'C', 'text' => '1nama', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — urutan deklarasi variabel
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Deklarasi Variabel 📦',
            'content' => 'Susun langkah-langkah membuat dan menggunakan variabel dengan benar!',
            'options' => [
                ['id' => 0, 'text' => 'Pikirkan data apa yang perlu disimpan'],
                ['id' => 1, 'text' => 'Pilih tipe data yang sesuai (Integer, String, dll)'],
                ['id' => 2, 'text' => 'Beri nama variabel yang deskriptif'],
                ['id' => 3, 'text' => 'Isi variabel dengan nilai awal'],
                ['id' => 4, 'text' => 'Gunakan variabel dalam program'],
            ],
            'correct_answer' => null,
            'explanation' => 'Urutan yang benar: tentukan kebutuhan → pilih tipe → beri nama → isi nilai → gunakan. Inilah cara kerja variabel dalam program!',
        ]);

        // 16. Minigame: Fill in the Blank — tipe data
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi Tipe Data! 🧩',
            'content' => 'Pilih tipe data yang tepat untuk melengkapi kalimat berikut.',
            'options' => [
                ['type' => 'text', 'value' => 'Nilai skor permainan disimpan sebagai '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ".\nNama pemain disimpan sebagai "],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ".\nStatus apakah pemain menang disimpan sebagai "],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => '.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Integer', 'color' => 'blue'],
                ['id' => 2, 'text' => 'String', 'color' => 'green'],
                ['id' => 3, 'text' => 'Boolean', 'color' => 'orange'],
                ['id' => 4, 'text' => 'Float', 'color' => 'purple'],
            ]),
            'explanation' => 'Skor → Integer (angka bulat), Nama → String (teks), Status menang → Boolean (benar/salah). Pemilihan tipe data yang tepat membuat program lebih efisien!',
        ]);

        // 17. Minigame: Block Code — susun blok variabel
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Susun Kode Variabelmu! 🤖',
            'content' => 'Pilih blok yang tepat untuk membuat program yang menyimpan nama dan usia, lalu mencetaknya.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'nama = "Budi"'],
                ['id' => 2, 'type' => 'math', 'text' => 'usia = 15'],
                ['id' => 3, 'type' => 'action', 'text' => 'PRINT nama'],
                ['id' => 4, 'type' => 'loop', 'text' => 'ULANGI 5 KALI'],
                ['id' => 5, 'type' => 'logic', 'text' => 'JIKA usia > 10'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => 'Program yang tepat: simpan nama (String), simpan usia (Integer), lalu cetak nama. Kamu tidak perlu loop atau kondisi untuk tugas sederhana ini.',
        ]);
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
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Percabangan', 'content' => 'Program bisa mengambil keputusan berdasarkan kondisi tertentu menggunakan "If" (Jika). Ini membuat program "berpikir" sebelum bertindak.']);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 2, 'Pernyataan If digunakan untuk?', [
            ['id' => 'A', 'text' => 'Mengulang kode', 'correct' => false],
            ['id' => 'B', 'text' => 'Memeriksa kondisi', 'correct' => true],
            ['id' => 'C', 'text' => 'Menyimpan data', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Analogi Kehidupan', 'content' => "JIKA hujan → bawa payung.\nJIKA TIDAK → pakai topi.\n\nItulah logika If/Else dalam kehidupan sehari-hari!"]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 4, 'Jika hujan, apa yang dilakukan?', [
            ['id' => 'A', 'text' => 'Bawa payung', 'correct' => true],
            ['id' => 'B', 'text' => 'Siram tanaman', 'correct' => false],
            ['id' => 'C', 'text' => 'Pakai kacamata hitam', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Else (Jika Tidak)', 'content' => '"Else" dijalankan ketika kondisi "If" tidak terpenuhi. Ia adalah alternatif/jalan cadangan ketika kondisi pertama salah.']);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 6, 'Kapan blok "Else" dijalankan?', [
            ['id' => 'A', 'text' => 'Saat kondisi If benar', 'correct' => false],
            ['id' => 'B', 'text' => 'Saat kondisi If salah', 'correct' => true],
            ['id' => 'C', 'text' => 'Selalu dijalankan', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Operator Perbandingan', 'content' => "Untuk mengecek kondisi, kita pakai operator:\n> (lebih besar)\n< (lebih kecil)\n== (sama dengan)\n!= (tidak sama)"]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 8, 'Simbol untuk "sama dengan" dalam kondisi adalah?', [
            ['id' => 'A', 'text' => '=', 'correct' => false],
            ['id' => 'B', 'text' => '==', 'correct' => true],
            ['id' => 'C', 'text' => '!=', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Nested If (If Bersarang)', 'content' => 'Kita bisa memasukkan If di dalam If untuk logika yang lebih kompleks. Contoh: Jika nilai >= 80, cek lagi apakah nilai >= 90 untuk nilai A.']);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 10, 'If di dalam If disebut?', [
            ['id' => 'A', 'text' => 'Double If', 'correct' => false],
            ['id' => 'B', 'text' => 'Nested If', 'correct' => true],
            ['id' => 'C', 'text' => 'Loop If', 'correct' => false],
        ]);

        // 11. Trivia — Else If
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Else If (Kondisi Berantai)', 'content' => "Else If memungkinkan kita mengecek beberapa kondisi secara berantai:\nJIKA nilai >= 90 → A\nANTARA LAIN JIKA nilai >= 80 → B\nJIKA TIDAK → C"]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 12, 'Kata kunci untuk kondisi berantai setelah If adalah?', [
            ['id' => 'A', 'text' => 'But If', 'correct' => false],
            ['id' => 'B', 'text' => 'Else If', 'correct' => true],
            ['id' => 'C', 'text' => 'Then If', 'correct' => false],
        ]);

        // 13. Trivia — Operator Logika
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Operator Logika', 'content' => "Operator logika menggabungkan beberapa kondisi:\nAND (&&): semua kondisi harus benar\nOR (||): cukup satu kondisi yang benar\nNOT (!): membalik kondisi (benar jadi salah)"]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 14, 'Operator AND (&&) menghasilkan True ketika?', [
            ['id' => 'A', 'text' => 'Salah satu kondisi benar', 'correct' => false],
            ['id' => 'B', 'text' => 'Semua kondisi benar', 'correct' => true],
            ['id' => 'C', 'text' => 'Semua kondisi salah', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Urutan If/Else 🚦',
            'content' => 'Susun langkah-langkah program lampu lalu lintas dengan benar dari atas ke bawah!',
            'options' => [
                ['id' => 0, 'text' => 'Cek warna lampu'],
                ['id' => 1, 'text' => 'JIKA lampu = Merah → Berhenti'],
                ['id' => 2, 'text' => 'LAINNYA JIKA lampu = Kuning → Siap-siap'],
                ['id' => 3, 'text' => 'JIKA TIDAK → Jalan'],
                ['id' => 4, 'text' => 'Program selesai'],
            ],
            'correct_answer' => null,
            'explanation' => 'Ini adalah contoh If/Else If/Else yang sempurna! Program mengecek satu kondisi demi satu, sampai kondisi yang tepat ditemukan.',
        ]);

        // 16. Minigame: Fill in the Blank — kondisi kelulusan
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Program Nilai Ujian 📝',
            'content' => 'Lengkapi program logika nilai ujian berikut.',
            'options' => [
                ['type' => 'text', 'value' => 'JIKA nilai >= 70, maka siswa dinyatakan '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ".\nJIKA TIDAK, maka siswa dinyatakan "],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ".\nKondisi nilai >= 70 menggunakan operator "],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => '.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'LULUS', 'color' => 'green'],
                ['id' => 2, 'text' => 'TIDAK LULUS', 'color' => 'red'],
                ['id' => 3, 'text' => '>=', 'color' => 'blue'],
                ['id' => 4, 'text' => '==', 'color' => 'purple'],
            ]),
            'explanation' => 'Logika If/Else membantu program mengambil keputusan otomatis. Operator >= berarti "lebih besar atau sama dengan".',
        ]);

        // 17. Minigame: Block Code — robot berbelok
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Robot Pintar Berbelok 🤖',
            'content' => 'Susun blok kode agar robot bergerak maju, lalu memeriksa apakah ada rintangan, dan berbelok jika iya.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'Maju 1 Langkah'],
                ['id' => 2, 'type' => 'logic', 'text' => 'JIKA ada rintangan'],
                ['id' => 3, 'type' => 'action', 'text' => 'Belok Kanan'],
                ['id' => 4, 'type' => 'loop', 'text' => 'ULANGI 3 KALI'],
                ['id' => 5, 'type' => 'action', 'text' => 'Mundur 1 Langkah'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => 'Robot: Maju dahulu → Cek kondisi (If ada rintangan) → Belok. Ini adalah penerapan logika If sederhana dalam robotika!',
        ]);
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
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Kenapa Loop?', 'content' => 'Loop digunakan untuk menjalankan kode yang sama berkali-kali tanpa menulis ulang. Bayangkan harus mencetak 1000 baris — loop menyelesaikannya dalam beberapa baris kode saja!']);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 2, 'Apa fungsi utama loop dalam pemrograman?', [
            ['id' => 'A', 'text' => 'Menghentikan program', 'correct' => false],
            ['id' => 'B', 'text' => 'Mengulang kode berkali-kali', 'correct' => true],
            ['id' => 'C', 'text' => 'Menyimpan data', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'For Loop', 'content' => "For Loop digunakan saat kita tahu pasti berapa kali pengulangan dilakukan.\nContoh: UNTUK i dari 1 sampai 5 → PRINT i\nHasilnya: 1, 2, 3, 4, 5"]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 4, 'Kapan For Loop paling tepat digunakan?', [
            ['id' => 'A', 'text' => 'Saat jumlah pengulangan tidak diketahui', 'correct' => false],
            ['id' => 'B', 'text' => 'Saat jumlah pengulangan sudah pasti', 'correct' => true],
            ['id' => 'C', 'text' => 'Saat ingin menghentikan program', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'While Loop', 'content' => "While Loop berjalan SELAMA kondisi masih bernilai benar.\nContoh: SELAMA baterai > 0 → MAINKAN musik\nJika salah membuat kondisi, loop bisa tidak berhenti!"]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 6, 'While Loop berjalan selama?', [
            ['id' => 'A', 'text' => 'Kondisi bernilai FALSE', 'correct' => false],
            ['id' => 'B', 'text' => 'Kondisi bernilai TRUE', 'correct' => true],
            ['id' => 'C', 'text' => 'Program belum selesai', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Infinite Loop (Loop Tak Terbatas)', 'content' => "Hati-hati! Infinite Loop terjadi saat kondisi While tidak pernah menjadi False.\nContoh: SELAMA (1 == 1) → ini berjalan SELAMANYA!\nProgram bisa macet (hang) karenanya."]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 8, 'Loop yang tidak pernah berhenti disebut?', [
            ['id' => 'A', 'text' => 'Mega Loop', 'correct' => false],
            ['id' => 'B', 'text' => 'Infinite Loop', 'correct' => true],
            ['id' => 'C', 'text' => 'Forever Loop', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Efisiensi Kode', 'content' => 'Dengan loop, kode menjadi lebih pendek, mudah dibaca, dan mudah dimodifikasi. Jika perlu mengubah logika, cukup edit di satu tempat, bukan 1000 tempat!']);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 10, 'Apa manfaat utama menggunakan loop?', [
            ['id' => 'A', 'text' => 'Kode lebih rumit', 'correct' => false],
            ['id' => 'B', 'text' => 'Kode lebih pendek dan efisien', 'correct' => true],
            ['id' => 'C', 'text' => 'Program berjalan lebih lambat', 'correct' => false],
        ]);

        // 11. Trivia tambahan — Break & Continue
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Break & Continue', 'content' => "Break: menghentikan loop lebih awal sebelum selesai.\nContinue: melewati iterasi saat ini dan lanjut ke iterasi berikutnya.\n\nContoh Break: berhenti saat menemukan angka 7 dalam daftar."]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 12, 'Kata kunci untuk menghentikan loop lebih awal adalah?', [
            ['id' => 'A', 'text' => 'Stop', 'correct' => false],
            ['id' => 'B', 'text' => 'Break', 'correct' => true],
            ['id' => 'C', 'text' => 'End', 'correct' => false],
        ]);

        // 13. Trivia tambahan — Nested Loop
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Nested Loop (Loop Bersarang)', 'content' => "Loop di dalam loop disebut Nested Loop.\nContoh: untuk membuat tabel perkalian, kita butuh loop luar (baris) dan loop dalam (kolom).\nSetiap iterasi loop luar menjalankan SEMUA iterasi loop dalam."]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 14, 'Loop di dalam loop disebut?', [
            ['id' => 'A', 'text' => 'Double Loop', 'correct' => false],
            ['id' => 'B', 'text' => 'Nested Loop', 'correct' => true],
            ['id' => 'C', 'text' => 'Multi Loop', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — struktur for loop
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Susun For Loop! 🔁',
            'content' => 'Susun bagian-bagian For Loop untuk mencetak angka 1 sampai 5 dengan urutan yang benar!',
            'options' => [
                ['id' => 0, 'text' => 'Tentukan variabel awal: i = 1'],
                ['id' => 1, 'text' => 'Cek kondisi: i <= 5'],
                ['id' => 2, 'text' => 'Jalankan isi loop: PRINT i'],
                ['id' => 3, 'text' => 'Tambah nilai: i = i + 1'],
                ['id' => 4, 'text' => 'Kembali cek kondisi (ulangi dari step 2)'],
            ],
            'correct_answer' => null,
            'explanation' => 'For Loop bekerja dengan: inisialisasi → cek kondisi → jalankan isi → update variabel → ulangi. Urutan ini sangat penting!',
        ]);

        // 16. Minigame: Fill in the Blank — while loop
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Lengkapi While Loop! 🕹️',
            'content' => 'Isi bagian yang kosong agar program loop berjalan dengan benar.',
            'options' => [
                ['type' => 'text', 'value' => 'nyawa = 3\nSELAMA nyawa '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => " 0:\n  Mainkan Game\n  nyawa = nyawa "],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => " 1\nJika nyawa = 0: "],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ' Permainan Berakhir'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '>', 'color' => 'blue'],
                ['id' => 2, 'text' => '-', 'color' => 'red'],
                ['id' => 3, 'text' => 'PRINT', 'color' => 'green'],
                ['id' => 4, 'text' => '+', 'color' => 'purple'],
            ]),
            'explanation' => 'While loop berjalan selama nyawa > 0. Setiap iterasi, nyawa dikurangi 1. Saat nyawa = 0, loop berakhir dan "Permainan Berakhir" dicetak.',
        ]);

        // 17. Minigame: Block Code — cetak angka 1-3
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Robot Menghitung! 🤖',
            'content' => 'Susun blok kode agar robot dapat mengulang gerakan maju sebanyak 3 kali lalu berhenti.',
            'options' => [
                ['id' => 1, 'type' => 'loop', 'text' => 'ULANGI 3 KALI'],
                ['id' => 2, 'type' => 'action', 'text' => 'Maju 1 Langkah'],
                ['id' => 3, 'type' => 'action', 'text' => 'BERHENTI'],
                ['id' => 4, 'type' => 'logic', 'text' => 'JIKA langkah > 3'],
                ['id' => 5, 'type' => 'math', 'text' => 'Hitung = Hitung + 1'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => 'Cara paling efisien: gunakan ULANGI 3 KALI → Maju 1 Langkah → BERHENTI. Loop mengulangi aksi maju, lalu program berhenti!',
        ]);
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
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Pseudocode?', 'content' => 'Pseudocode adalah "kode semu" — cara menulis logika program menggunakan bahasa manusia yang mudah dipahami, sebelum menulis kode nyata.']);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 2, 'Pseudocode adalah?', [
            ['id' => 'A', 'text' => 'Bahasa mesin komputer', 'correct' => false],
            ['id' => 'B', 'text' => 'Kode semu yang mudah dibaca manusia', 'correct' => true],
            ['id' => 'C', 'text' => 'Kode program yang siap dijalankan', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Mengapa Pseudocode Penting?', 'content' => "Pseudocode membantu kita:\n- Merencanakan logika sebelum coding\n- Mudah dikomunikasikan ke orang lain\n- Tidak terikat aturan sintaks bahasa tertentu\n- Mengurangi kesalahan logika"]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 4, 'Apa fokus utama pseudocode?', [
            ['id' => 'A', 'text' => 'Sintaks yang benar', 'correct' => false],
            ['id' => 'B', 'text' => 'Logika dan alur program', 'correct' => true],
            ['id' => 'C', 'text' => 'Kecepatan eksekusi', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Bahasa Bebas', 'content' => "Pseudocode bisa ditulis dalam bahasa Indonesia atau Inggris — yang terpenting adalah jelas dan mudah dipahami.\n\nTidak ada kompiler atau aturan ketat yang harus diikuti!"]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 6, 'Bahasa pseudocode yang benar adalah?', [
            ['id' => 'A', 'text' => 'Harus bahasa Inggris', 'correct' => false],
            ['id' => 'B', 'text' => 'Harus bahasa Indonesia', 'correct' => false],
            ['id' => 'C', 'text' => 'Bebas, asal mudah dipahami', 'correct' => true],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Kata Kunci Umum', 'content' => "Meski bebas, pseudocode biasanya menggunakan kata kunci seperti:\nINPUT / OUTPUT / PRINT\nIF / ELSE / ELSE IF\nWHILE / FOR\nBEGIN / END"]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 8, 'Kata kunci yang TIDAK umum dipakai dalam pseudocode?', [
            ['id' => 'A', 'text' => 'IF, ELSE', 'correct' => false],
            ['id' => 'B', 'text' => 'PRINT, INPUT', 'correct' => false],
            ['id' => 'C', 'text' => 'JUMP, TELEPORT', 'correct' => true],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Pseudocode = Jembatan', 'content' => "Pseudocode adalah jembatan antara:\nPikiran manusia ↔ Kode program\n\nSetelah pseudocode selesai, programmer dapat mengubahnya ke bahasa apapun: Python, Java, PHP, dll."]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 10, 'Pseudocode bertindak sebagai jembatan antara?', [
            ['id' => 'A', 'text' => 'Hardware dan Software', 'correct' => false],
            ['id' => 'B', 'text' => 'Bahasa Inggris dan Indonesia', 'correct' => false],
            ['id' => 'C', 'text' => 'Pikiran manusia dan kode program', 'correct' => true],
        ]);

        // 11. Trivia — Konvensi
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Konvensi Penulisan Pseudocode', 'content' => "Beberapa konvensi umum:\n- Kata kunci ditulis KAPITAL (IF, WHILE, PRINT)\n- Setiap langkah ditulis di baris baru\n- Gunakan indentasi untuk menunjukkan blok kode\n- Deskripsi aksi ditulis jelas (bukan singkatan misterius)"]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 12, 'Mengapa kata kunci pseudocode ditulis dengan KAPITAL?', [
            ['id' => 'A', 'text' => 'Karena aturan komputer', 'correct' => false],
            ['id' => 'B', 'text' => 'Agar lebih mudah dibedakan dari deskripsi', 'correct' => true],
            ['id' => 'C', 'text' => 'Karena sudah tradisi saja', 'correct' => false],
        ]);

        // 13. Trivia — Pseudocode vs Kode Nyata
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Pseudocode → Kode Nyata', 'content' => "Pseudocode:\nJIKA nilai >= 70\n  PRINT \"Lulus\"\nJIKA TIDAK\n  PRINT \"Tidak Lulus\"\n\nPython:\nif nilai >= 70:\n  print('Lulus')\nelse:\n  print('Tidak Lulus')\n\nLogikanya sama, hanya sintaksnya berbeda!"]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 14, 'Perbedaan utama pseudocode dengan kode program adalah?', [
            ['id' => 'A', 'text' => 'Pseudocode lebih cepat dieksekusi', 'correct' => false],
            ['id' => 'B', 'text' => 'Pseudocode tidak terikat aturan sintaks bahasa tertentu', 'correct' => true],
            ['id' => 'C', 'text' => 'Pseudocode tidak bisa diconvert ke kode nyata', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — pseudocode ATM
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Pseudocode ATM 🏧',
            'content' => 'Susun langkah-langkah pseudocode untuk mengambil uang di ATM dengan urutan yang benar!',
            'options' => [
                ['id' => 0, 'text' => 'BEGIN — Masuk ke mesin ATM'],
                ['id' => 1, 'text' => 'INPUT kartu ATM'],
                ['id' => 2, 'text' => 'INPUT PIN dan validasi'],
                ['id' => 3, 'text' => 'JIKA PIN benar → lanjut, JIKA TIDAK → tolak'],
                ['id' => 4, 'text' => 'INPUT jumlah uang yang diambil'],
                ['id' => 5, 'text' => 'OUTPUT uang, END'],
            ],
            'correct_answer' => null,
            'explanation' => 'Pseudocode ATM menggambarkan alur logis: masuk → input kartu → validasi PIN → input jumlah → keluarkan uang. Ini adalah algoritma ATM dalam kehidupan nyata!',
        ]);

        // 16. Minigame: Fill in the Blank — pseudocode kata kunci
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Isi Kata Kunci Pseudocode! ✏️',
            'content' => 'Lengkapi pseudocode login berikut dengan kata kunci yang tepat.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => " username dan password\nJIKA username = 'admin' "],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => " password = '1234':\n  "],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => " \"Login Berhasil\"\nJIKA TIDAK:\n  PRINT \"Akses Ditolak\""],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'INPUT', 'color' => 'blue'],
                ['id' => 2, 'text' => 'DAN', 'color' => 'orange'],
                ['id' => 3, 'text' => 'PRINT', 'color' => 'green'],
                ['id' => 4, 'text' => 'OUTPUT', 'color' => 'purple'],
            ]),
            'explanation' => 'INPUT digunakan untuk menerima data, DAN (AND) menggabungkan kondisi, PRINT/OUTPUT menampilkan hasil. Inilah cara pseudocode menggambarkan sistem login!',
        ]);

        // 17. Minigame: Block Code — susun pseudocode
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Tulis Pseudocode-mu! 🖊️',
            'content' => 'Susun blok pseudocode yang tepat untuk membuat program yang menerima nilai siswa dan menampilkan keterangan lulus atau tidak.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'INPUT nilai'],
                ['id' => 2, 'type' => 'logic', 'text' => 'JIKA nilai >= 70'],
                ['id' => 3, 'type' => 'action', 'text' => 'PRINT "Lulus"'],
                ['id' => 4, 'type' => 'action', 'text' => 'PRINT "Tidak Lulus"'],
                ['id' => 5, 'type' => 'loop', 'text' => 'ULANGI 5 KALI'],
                ['id' => 6, 'type' => 'math', 'text' => 'nilai = nilai + 10'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Pseudocode yang benar: INPUT nilai → JIKA nilai >= 70 → PRINT Lulus → PRINT Tidak Lulus (untuk kondisi Else). Ini mencakup semua kemungkinan kasus!',
        ]);
    }
    private function createLogicLessonArithmetic($course)
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

    private function createLogicLessonLogicOp($course)
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

    private function createLogicLessonArray($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'struktur-data-array'],
            [
                'course_id' => $course->id, 'title' => 'Struktur Data Array',
                'content' => 'Menyimpan antrean data dalam satu variabel.', 'video_url' => null, 'order' => 8, 'xp_reward' => 45,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Array?', 'content' => 'Array (atau List) adalah struktur data yang memungkinkan kita menyimpan banyak nilai (elemen) dalam satu variabel tunggal.']);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 2, 'Fungsi utama sebuah Array adalah?', [
            ['id' => 'A', 'text' => 'Menghapus banyak data sekaligus', 'correct' => false],
            ['id' => 'B', 'text' => 'Menyimpan banyak nilai dalam satu variabel', 'correct' => true],
            ['id' => 'C', 'text' => 'Membuat kode berjalan lebih lambat', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Analogi Array', 'content' => "Bayangkan Array seperti loker di sekolah. Ada banyak laci berderet, dan setiap laci punya nomor berurutan. Kamu bisa menyimpan buku berbeda di setiap laci."]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 4, 'Array paling mirip dengan apa dalam dunia nyata?', [
            ['id' => 'A', 'text' => 'Satu kotak kosong', 'correct' => false],
            ['id' => 'B', 'text' => 'Deretan loker dengan nomor urut', 'correct' => true],
            ['id' => 'C', 'text' => 'Lampu lalu lintas', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Indeks (Nomor Urut)', 'content' => "Dalam pemrograman, setiap elemen dalam Array memiliki nomor urut yang disebut *Indeks*.\n\nUniknya, *Indeks selalu dihitung mulai dari angka 0*, bukan 1!"]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 6, 'Dalam programming, Indeks Array selalu dimulai dari angka berapa?', [
            ['id' => 'A', 'text' => '1', 'correct' => false],
            ['id' => 'B', 'text' => '0', 'correct' => true],
            ['id' => 'C', 'text' => '-1', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Mengakses Data', 'content' => "Jika kita punya `buah = ['Apel', 'Jeruk', 'Mangga']`:\n`buah[0]` adalah 'Apel'\n`buah[1]` adalah 'Jeruk'\n`buah[2]` adalah 'Mangga'"]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 8, "Pada `buah = ['Apel', 'Jeruk', 'Mangga']`, data 'Mangga' berada di indeks ke berapa?", [
            ['id' => 'A', 'text' => 'Indeks ke-1', 'correct' => false],
            ['id' => 'B', 'text' => 'Indeks ke-2', 'correct' => true],
            ['id' => 'C', 'text' => 'Indeks ke-3', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Kenapa Pakai Array?', 'content' => "Tanpa Array: `siswa1 = 'Ali'`, `siswa2 = 'Budi'`, `siswa3 = 'Siti'` (Capek buat 100 variabel).\nDengan Array: `siswa = ['Ali', 'Budi', 'Siti', ...]`. Jauh lebih rapi!"]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 10, 'Keuntungan utama menggunakan Array adalah?', [
            ['id' => 'A', 'text' => 'Kode lebih berantakan', 'correct' => false],
            ['id' => 'B', 'text' => 'Hanya bisa simpan satu angka', 'correct' => false],
            ['id' => 'C', 'text' => 'Kode jauh lebih rapi dan hemat variabel', 'correct' => true],
        ]);

        // 11. Trivia
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Panjang Array (Length)', 'content' => "Setiap Array memiliki ukuran atau *Length* (panjang), yaitu total jumlah elemen di dalamnya.\nContoh: `['A', 'B', 'C']` memiliki *Length* = 3."]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 12, 'Berapa Length (panjang) dari Array berikut: ["Merah", "Kuning", "Hijau"]?', [
            ['id' => 'A', 'text' => '2', 'correct' => false],
            ['id' => 'B', 'text' => '3', 'correct' => true],
            ['id' => 'C', 'text' => '4', 'correct' => false],
        ]);

        // 13. Trivia
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Manipulasi Array', 'content' => "Data di Array bisa diubah!\nKita bisa Menambahkan (Push/Append) data baru ke akhir barisan, Menyisipkan (Insert) di tengah, atau Menghapus (Pop/Remove) data."]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 14, 'Jika kita melakukan "Push" atau "Append" pada Array, apa yang terjadi?', [
            ['id' => 'A', 'text' => 'Menghapus data terakhir', 'correct' => false],
            ['id' => 'B', 'text' => 'Semua data hilang', 'correct' => false],
            ['id' => 'C', 'text' => 'Menambahkan data baru ke urutan paling belakang', 'correct' => true],
        ]);

        // 15. Minigame: Code Arrange — Konsep Indeks
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Urutan Indeks Array 🧩',
            'content' => 'Susun pasangan data `hewan = ["Kucing", "Anjing", "Ayam", "Burung"]` dari Indeks 0 sampai Indeks 3!',
            'options' => [
                ['id' => 0, 'text' => 'hewan[0] otomatis bernilai "Kucing" (Elemen Pertama)'],
                ['id' => 1, 'text' => 'hewan[1] otomatis bernilai "Anjing" (Elemen Kedua)'],
                ['id' => 2, 'text' => 'hewan[2] otomatis bernilai "Ayam" (Elemen Ketiga)'],
                ['id' => 3, 'text' => 'hewan[3] bernilai "Burung" (Elemen Terakhir)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Ingat selalu: Nomor Indeks Array dimulai dari angka NOL. Angka 1 berarti elemen baris kedua!',
        ]);

        // 16. Minigame: Fill in the Blank — Akses Data
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Pemanggilan Data Array 📝',
            'content' => 'Isi kode yang kosong untuk menampilkan nilai yang tepat.',
            'options' => [
                ['type' => 'text', 'value' => "warna = ['Merah', 'Kuning', 'Hijau', 'Biru']\nUntuk mencetak 'Kuning' gunakan: PRINT warna["],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => "]\nUntuk mencetak 'Biru' gunakan: PRINT warna["],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => "]\nPanjang Array warna tersebut adalah "],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '1', 'color' => 'blue'],
                ['id' => 2, 'text' => '3', 'color' => 'orange'],
                ['id' => 3, 'text' => '4', 'color' => 'green'],
                ['id' => 4, 'text' => '0', 'color' => 'purple'], // Distractor
            ]),
            'explanation' => 'Kuning ada di urutan kedua (Indeks 1). Biru di akhir (Indeks 3). Total data ada 4 buah!',
        ]);

        // 17. Minigame: Block Code — Menambah Data
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Bermain dengan Array 📦',
            'content' => 'Susun perintah agar kita membuat Array daftar belanja, lalu tambahkan "Apel" ke dalamnya kemudian Cetak!',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'belanja = ["Susu", "Roti"]'],
                ['id' => 2, 'type' => 'action', 'text' => 'TAMBAHKAN "Apel" ke array belanja'],
                ['id' => 3, 'type' => 'action', 'text' => 'PRINT belanja'],
                ['id' => 4, 'type' => 'logic', 'text' => 'JIKA belanja > 2'],
                ['id' => 5, 'type' => 'math', 'text' => 'belanja[0] = "Air"'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => 'Sistem logis: Deklarasi Array baru -> Gunakan fungi Tambah/Push -> Tampilkan ke layar!',
        ]);
    }

    private function createLogicLessonFunctions($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'fungsi-dasar'],
            [
                'course_id' => $course->id, 'title' => 'Fungsi (Functions)',
                'content' => 'Blok kode yang bisa digunakan berulang kali.', 'video_url' => null, 'order' => 9, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Fungsi?', 'content' => "Fungsi (Function) adalah blok kode terpisah yang dirancang untuk melakukan tugas khusus.\nSetelah dibuat, fungsi bisa dipanggil (dijalankan) kapan saja dan di mana saja dalam program."]);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 2, 'Apa itu Fungsi dalam pemrograman?', [
            ['id' => 'A', 'text' => 'Tipe data untuk menyimpan teks', 'correct' => false],
            ['id' => 'B', 'text' => 'Blok kode khusus yang bisa dipanggil berulang kali', 'correct' => true],
            ['id' => 'C', 'text' => 'Program untuk menghentikan perulangan', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Analogi Mesin', 'content' => "Bayangkan fungsi seperti mesin pembuat kopi.\nKamu tidak perlu tahu cara kerja kabel di dalamnya. Cukup pencet tombol (panggil fungsi), dan kopi (hasil) akan keluar."]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 4, 'Berdasarkan analogi mesin, apa maksud memanggil fungsi?', [
            ['id' => 'A', 'text' => 'Membongkar mesin', 'correct' => false],
            ['id' => 'B', 'text' => 'Mencabut kabel mesin', 'correct' => false],
            ['id' => 'C', 'text' => 'Memencet tombol agar mesin bekerja', 'correct' => true],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'DRY (Don\'t Repeat Yourself)', 'content' => "Fungsi membantu kita menerapkan prinsip DRY.\nAlih-alih menyalin kode 10 kali, buat saja 1 fungsi dan panggil 10 kali. Jika ada error, cukup perbaiki di 1 tempat!"]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 6, 'Apa keutamaan prinsip DRY yang didukung oleh fungsi?', [
            ['id' => 'A', 'text' => 'Membuat kode basah dan panjang', 'correct' => false],
            ['id' => 'B', 'text' => 'Mencegah penulisan kode yang sama berulang-ulang', 'correct' => true],
            ['id' => 'C', 'text' => 'Menghapus seluruh variabel', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Cara Membuat', 'content' => "Di banyak bahasa (seperti Python), fungsi dibuat dengan kata kunci `def` atau `function`.\nContoh:\n`def sapa():`\n  `PRINT \"Halo Semuanya!\"`"]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 8, 'Kata kunci apa yang sering dipakai untuk membuat fungsi?', [
            ['id' => 'A', 'text' => 'def atau function', 'correct' => true],
            ['id' => 'B', 'text' => 'if atau else', 'correct' => false],
            ['id' => 'C', 'text' => 'var atau let', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Cara Memanggil', 'content' => "Membuat saja tidak cukup. Fungsi tidak akan berjalan sampai DENGAN SENGAJA kita panggil.\nCara panggil: sebut namanya diikuti kurung `sapa()`"]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 10, 'Bagaimana cara menjalankan/memanggil fungsi bernama `sapa`?', [
            ['id' => 'A', 'text' => 'panggil sapa', 'correct' => false],
            ['id' => 'B', 'text' => 'sapa[]', 'correct' => false],
            ['id' => 'C', 'text' => 'sapa()', 'correct' => true],
        ]);

        // 11. Trivia
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Isi Fungsi', 'content' => "Sebuah fungsi dapat berisi bebas instruksi apapun: perhitungan matematika, deklarasi variabel, perulangan, atau gabungan semuanya."]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 12, 'Apa saja yang boleh ditulis di dalam fungsi?', [
            ['id' => 'A', 'text' => 'Bebas, bisa berisi perhitungan, loop, dll', 'correct' => true],
            ['id' => 'B', 'text' => 'Hanya operasi bilangan', 'correct' => false],
            ['id' => 'C', 'text' => 'Hanya boleh 1 baris kode', 'correct' => false],
        ]);

        // 13. Trivia
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Built-in Function', 'content' => "Bahasa pemrograman sudah bawaan punya banyak fungsi yang siap pakai (Built-in).\nContoh: `PRINT()`, `LENGHT()`, `MAX()`, `MIN()`. Jadi kamu tidak harus selalu membuat dari awal!"]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 14, 'Fungsi yang sudah disediakan oleh bahasa pemrograman disebut?', [
            ['id' => 'A', 'text' => 'Magic function', 'correct' => false],
            ['id' => 'B', 'text' => 'Built-in function', 'correct' => true],
            ['id' => 'C', 'text' => 'User function', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — Definisi & Panggil
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Buat dan Panggil Fungsi 🤖',
            'content' => 'Susun tahapan pembuatan dan pemanggilan fungsi ini agar ucapan pagi dicetak 2 kali!',
            'options' => [
                ['id' => 0, 'text' => 'Mulai buat fungsi: FUNCTION sapaPagi()'],
                ['id' => 1, 'text' => 'Isi fungsi: PRINT "Selamat Pagi!"'],
                ['id' => 2, 'text' => 'Akhir fungsi: END FUNCTION'],
                ['id' => 3, 'text' => 'Panggilan pertama: sapaPagi()'],
                ['id' => 4, 'text' => 'Panggilan kedua: sapaPagi()'],
            ],
            'correct_answer' => null,
            'explanation' => 'Aturan emas: Buat dulu fungsinya dengan utuh (dibuka dan ditutup), BARU fungsi tersebut siap dipanggil berkali-kali!',
        ]);

        // 16. Minigame: Fill in the Blank — Fungsi Login
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Siapkan Fungsi Login! 🔓',
            'content' => 'Lengkapi blok fungsi untuk mengecek login pengguna.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => " cekLogin():\n  JIKA user = 'admin':\n    "],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => " \"Sukses!\"\n\n# Panggil fungsi\n"],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => "()"],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'FUNCTION', 'color' => 'blue'],
                ['id' => 2, 'text' => 'PRINT', 'color' => 'green'],
                ['id' => 3, 'text' => 'cekLogin', 'color' => 'orange'],
                ['id' => 4, 'text' => 'IF', 'color' => 'purple'], // Distractor
            ]),
            'explanation' => 'Gunakan FUNCTION untuk mendefinisikan, lalu isinya mencetak (PRINT), terakhir jalankan dengan menulis identitas fungsinya (cekLogin).',
        ]);

        // 17. Minigame: Block Code — Susun Fungsi
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Fungsi Alarm ⏰',
            'content' => 'Buat sebuah fungsi Alarm yang melakukan Print "Tetot!" sebanyak 3 kali, dan panggil fungsi tersebut.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'FUNCTION bunyiAlarm()'],
                ['id' => 2, 'type' => 'loop', 'text' => 'ULANGI 3 KALI'],
                ['id' => 3, 'type' => 'action', 'text' => 'PRINT "Tetot!"'],
                ['id' => 4, 'type' => 'action', 'text' => 'bunyiAlarm()'],
                ['id' => 5, 'type' => 'math', 'text' => 'Waktu = + 1'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Fungsi membungkus loop. Jadi ketika bunyiAlarm() dieksekusi, loop 3x print itu akan otomatis ikut dijalankan! Sangat efisien bukan?',
        ]);
    }

    private function createLogicLessonArguments($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'argumen-return'],
            [
                'course_id' => $course->id, 'title' => 'Argumen & Return Value',
                'content' => 'Fungsi yang cerdas dan interaktif.', 'video_url' => null, 'order' => 10, 'xp_reward' => 55,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Parameter & Argumen', 'content' => "Fungsi bisa menerima data masuk yang disebut *Parameter*. Data spesifik yang dikirimkan saat dipanggil disebut *Argumen*.\nIni membuat 1 fungsi bisa menghasilkan hasil yang beda-beda!"]);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 2, 'Data yang dikirim ke dalam fungsi disebut?', [
            ['id' => 'A', 'text' => 'Variabel luar', 'correct' => false],
            ['id' => 'B', 'text' => 'Argumen / Parameter', 'correct' => true],
            ['id' => 'C', 'text' => 'Looping', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Analogi Mesin Jus', 'content' => "Fungsi = Mesin Blender\nParameter = 'Tempat masuk buah'\nArgumen = 'Apel' atau 'Jeruk' yang kamu masukkan\n\nHasil setiap panggilan akan beda sesuai buahnya!"]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 4, 'Berdasarkan analogi mesin jus, Argumen diibaratkan sebagai?', [
            ['id' => 'A', 'text' => 'Tombol start', 'correct' => false],
            ['id' => 'B', 'text' => 'Gelas', 'correct' => false],
            ['id' => 'C', 'text' => 'Buah yang dimasukkan ke blender', 'correct' => true],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Return Value', 'content' => "Fungsi tidak hanya 'mengerjakan', tapi bisa juga 'mengembalikan' suatu hasil dengan kata kunci `RETURN`.\nHasil ini bisa difoto, disimpan, atau diolah lagi oleh program utama."]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 6, 'Bagaimana fungsi memberikan kembali hasil perhitungan ke program utama?', [
            ['id' => 'A', 'text' => 'Dengan BREAK', 'correct' => false],
            ['id' => 'B', 'text' => 'Mencetak ke layar', 'correct' => false],
            ['id' => 'C', 'text' => 'Menggunakan kata kunci RETURN', 'correct' => true],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Print VS Return', 'content' => "`PRINT` hanya menampilkan hasil ke layar mata.\n`RETURN` menyerahkan data kembali ke program agar bisa dikalikan/dibagi/disimpan. (Return adalah Jus yang masuk ke gelasmu!)."]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 8, 'Apa bedanya PRINT dan RETURN?', [
            ['id' => 'A', 'text' => 'Keduanya sama persis', 'correct' => false],
            ['id' => 'B', 'text' => 'PRINT tampil ke layar, RETURN kembalikan data ke program', 'correct' => true],
            ['id' => 'C', 'text' => 'RETURN tampil ke layar, PRINT hentikan program', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Menyimpan Hasil Return', 'content' => "Karena fungsi mengirimkan data dari return, kita harus menangkapnya!\nContoh: `hasil = kalikanDua(5)`\nMaka variabel `hasil` sekarang berisi angka `10`."]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 10, 'Pada \"hasil = kalikanDua(5)\", angka 5 bertindak sebagai?', [
            ['id' => 'A', 'text' => 'Nama fungsi', 'correct' => false],
            ['id' => 'B', 'text' => 'Argumen yang dikirim', 'correct' => true],
            ['id' => 'C', 'text' => 'Nilai kembalian (Return)', 'correct' => false],
        ]);

        // 11. Trivia
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Banyak Parameter', 'content' => "Sebuah fungsi bisa menerima banyak argumen yang dipisah dengan tanda koma.\nContoh `def tambah(angka1, angka2)`.\nSaat dipanggil `tambah(10, 5)`, akan me-return `15`."]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 12, 'Apa batas jumlah parameter dalam sebuah fungsi?', [
            ['id' => 'A', 'text' => 'Boleh berapapun, dipisah dengan koma', 'correct' => true],
            ['id' => 'B', 'text' => 'Maksimal hanya 1', 'correct' => false],
            ['id' => 'C', 'text' => 'Maksimal 2', 'correct' => false],
        ]);

        // 13. Trivia
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Sifat Return menghentikan!', 'content' => "Begitu fungsi me-RETURN sesuatu, eksekusi fungsi langsung berhenti saat itu juga.\nKode setelah baris `RETURN` dalam fungsi takkan pernah tersentuh!"]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 14, 'Jika ada baris fungsi di bawah instruksi RETURN, apa yang terjadi?', [
            ['id' => 'A', 'text' => 'Dijalankan setelah fungsi di luar dipanggil', 'correct' => false],
            ['id' => 'B', 'text' => 'Diabaikan, fungsi berhenti saat RETURN', 'correct' => true],
            ['id' => 'C', 'text' => 'Menyebabkan error memori', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — Fungsi Return
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Mesin Kali Dua ✖️',
            'content' => 'Susun langkah-langkah pembuatan fungsi matematika agar bisa mengembalikan hasil perkalian.',
            'options' => [
                ['id' => 0, 'text' => 'FUNCTION kaliDua(angka)'],
                ['id' => 1, 'text' => 'hasil = angka * 2'],
                ['id' => 2, 'text' => 'RETURN hasil'],
                ['id' => 3, 'text' => 'END FUNCTION'],
                ['id' => 4, 'text' => 'jawaban = kaliDua(10)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Perhitungan dilakukan, di-RETURN, lalu pada program luar kita "menangkap" return value itu ke dalam variabel!',
        ]);

        // 16. Minigame: Fill in the Blank — Fungsi Ber-Parameter
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Sapa Sesuai Nama! 👤',
            'content' => 'Lengkapi fungsi ini agar menyapa siapa pun nama yang dikirim dari luar.',
            'options' => [
                ['type' => 'text', 'value' => 'FUNCTION sapa('],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => "):\n  teks = 'Halo ' + nama\n  "],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => " teks\nEND\n\npesan = sapa("],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ")"],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'nama', 'color' => 'blue'],
                ['id' => 2, 'text' => 'RETURN', 'color' => 'green'],
                ['id' => 3, 'text' => '"Bintang"', 'color' => 'orange'],
                ['id' => 4, 'text' => 'PRINT', 'color' => 'purple'], // Distractor
            ]),
            'explanation' => 'Fungsi menerima "nama", merangkai kalimat "Halo Bintang", dan mengembalikannya untuk disimpan di variabel "pesan". Sangat interaktif!',
        ]);

        // 17. Minigame: Block Code — Menangkap Return
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Simpan Jawaban! 📥',
            'content' => 'Gunakan fungsi hitung() yang mereturn nilai skor, lalu simpan skor tersebut ke variabel final, dan tampilkan.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'skorFinal ='],
                ['id' => 2, 'type' => 'math', 'text' => 'hitungSkor(10)'],
                ['id' => 3, 'type' => 'action', 'text' => 'PRINT skorFinal'],
                ['id' => 4, 'type' => 'logic', 'text' => 'RETURN JIKA skor = 0'],
                ['id' => 5, 'type' => 'action', 'text' => 'PRINT hitungSkor'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => 'Kamu memanggil fungsi fungsi dengan angka 10, menyimpan nilai kembaliannya (Return) ke dalam skorFinal, dan menampilkannya ke layar!',
        ]);
    }

    private function createLogicLessonScope($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'lingkup-variabel'],
            [
                'course_id' => $course->id, 'title' => 'Lingkup Variabel (Scope)',
                'content' => 'Di mana variabelmu hidup dan mati.', 'video_url' => null, 'order' => 11, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Scope?', 'content' => "Variabel itu punya \'umur\' dan \'wilayah kekuasaan\'.\nTidak semua variabel bisa dipanggil dari sembarang tempat. Inilah yang disebut dengan *Scope* atau Lingkup Variabel."]);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 2, 'Apa itu Lingkup Variabel (Scope)?', [
            ['id' => 'A', 'text' => 'Tipe data untuk menyimpan angka panjang', 'correct' => false],
            ['id' => 'B', 'text' => 'Batas wilayah tempat sebuah variabel bisa dikenali atau diakses', 'correct' => true],
            ['id' => 'C', 'text' => 'Tempat untuk menyimpan fungsi', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Variabel Lokal', 'content' => "Variabel Lokal adalah variabel yang dideklarasikan DI DALAM sebuah fungsi atau blok kode.\nVariabel ini HANYA HIDUP di dalam sana. Kalau fungsi selesai, variabel itu langsung musnah!"]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 4, 'Apa sifat utama Variabel Lokal?', [
            ['id' => 'A', 'text' => 'Hanya dikenali di dalam fungsi tempatnya dibuat', 'correct' => true],
            ['id' => 'B', 'text' => 'Bisa diakses dari seluruh file program', 'correct' => false],
            ['id' => 'C', 'text' => 'Nilainya tidak bisa diubah selamanya', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Analogi Rahasia Kamar', 'content' => "Bayangkan variabel lokal seperti buku harian di dalam laci kamarmu.\nBuku itu hanya ada di kamarmu. Orang di ruang tamu (program utama) tidak tahu kalau buku itu ada!"]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 6, 'Jika program utama mencoba memanggil variabel lokal dari dalam fungsi, apa yang terjadi?', [
            ['id' => 'A', 'text' => 'Program berjalan normal', 'correct' => false],
            ['id' => 'B', 'text' => 'Variabel langsung tercetak', 'correct' => false],
            ['id' => 'C', 'text' => 'Terjadi Error / Variabel Tidak Ditemukan', 'correct' => true],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Variabel Global', 'content' => "Kebalikannya, Variabel Global dideklarasikan DI LUAR semua fungsi, biasanya di bagian paling atas program.\nSemua orang (semua fungsi) bisa melihat dan memakai variabel ini."]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 8, 'Di mana posisi biasanya Variabel Global dibuat?', [
            ['id' => 'A', 'text' => 'Di luar semua fungsi / di area utama program', 'correct' => true],
            ['id' => 'B', 'text' => 'Di dalam sebuah loop WHILE', 'correct' => false],
            ['id' => 'C', 'text' => 'Hanya di bagian paling bawah program', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Bahaya Variabel Global', 'content' => "Walau praktis, memakai terlalu banyak variabel global itu bahaya!\nKarena SEMUA fungsi bisa mengubah isinya secara bebas, melacak siapa yang secara tak sengaja \'merusak\' data menjadi sangat sulit."]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 10, 'Mengapa programmer profesional menghindari pemakaian Variabel Global berlebihan?', [
            ['id' => 'A', 'text' => 'Karena membuat file program menjadi sangat berat', 'correct' => false],
            ['id' => 'B', 'text' => 'Rentan diubah tiba-tiba oleh fungsi lain, bikin error susah dilacak', 'correct' => true],
            ['id' => 'C', 'text' => 'Karena komputer akan mati sendiri', 'correct' => false],
        ]);

        // 11. Trivia
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Konflik Nama (Shadowing)', 'content' => "Apa yang terjadi kalau variabel lokal punya NAMA SAMA dengan variabel global?\nProgram akan 'Shadowing' (menutupi). Fungsi akan selalu memprioritaskan variabel lokal miliknya sendiri di atas global yang namanya sama."]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 12, 'Ada global `skor=10`. Di dalam fungsi ada lokal `skor=50`. Jika fungsi mencetak skor, berapa hasilnya?', [
            ['id' => 'A', 'text' => '10 (Ikut Global)', 'correct' => false],
            ['id' => 'B', 'text' => '60 (Ditambahkan)', 'correct' => false],
            ['id' => 'C', 'text' => '50 (Variabel lokal menang di dalam kawasannya)', 'correct' => true],
        ]);

        // 13. Trivia
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Tips Best Practice', 'content' => "Gunakan Parameter dan Return Value alih-alih variabel global.\nKirim data sebagai parameter ke dalam fungsi, dan kembalikan hasilnya lewat Return. Kode akan jauh lebih aman dan bisa ditebak!"]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 14, 'Solusi yang lebih baik daripada memakai variabel global untuk mengirim data ke fungsi adalah?', [
            ['id' => 'A', 'text' => 'Menghapus kode dan membuat ulang', 'correct' => false],
            ['id' => 'B', 'text' => 'Menggunakan Parameter (Argumen) dan RETURN', 'correct' => true],
            ['id' => 'C', 'text' => 'Memakai perintah PRINT berulang-ulang', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — Scope Tersembunyi
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Umur Variabel 🕰️',
            'content' => 'Susun alur kehidupan variabel pesan lokal yang akan mati saat fungsi usai.',
            'options' => [
                ['id' => 0, 'text' => 'FUNCTION sapa()'],
                ['id' => 1, 'text' => '  pesan_lokal = "Hai Bro!"'],
                ['id' => 2, 'text' => '  PRINT pesan_lokal'],
                ['id' => 3, 'text' => 'END FUNCTION'],
                ['id' => 4, 'text' => '# Error! pesan_lokal sudah tidak ada di bawah sini'],
            ],
            'correct_answer' => null,
            'explanation' => 'Variabel lokal hanya tercipta saat fungsinya dipanggil, dan otomatis dihapus (Garbage Collected) dari memori begitu fungsi berakhir.',
        ]);

        // 16. Minigame: Fill in the Blank — Menghindari Tabrakan
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Perang Variabel! ⚔️',
            'content' => 'Lengkapi kode ini agar pemahamanmu tentang Shadowing benar.',
            'options' => [
                ['type' => 'text', 'value' => 'hp = 100 # Ini Variabel '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => "\n\nFUNCTION kenaRacun():\n  hp = 'Racun lvl 1' # Ini Variabel "],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => "\n  PRINT hp \nEND\n\nkenaRacun() # Akan memprint: "],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Global', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Lokal', 'color' => 'orange'],
                ['id' => 3, 'text' => '"Racun lvl 1"', 'color' => 'green'],
                ['id' => 4, 'text' => '100', 'color' => 'purple'], // Distractor
            ]),
            'explanation' => 'Variabel pertama bersifat Global. Yang di dalam fungsi itu Lokal, walau namanya sama-sama \'hp\', mereka adalah dua kotak penyimpanan berbeda!',
        ]);

        // 17. Minigame: Block Code — Menjaga Variabel Aman
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Membangun Benteng Parameter 🏰',
            'content' => 'Daripada memakai satu nyawa global bersama, susun kode ini agar menerima nyawa sebagai Parameter secara terisolasi.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'FUNCTION heal(nyawaSedang)'],
                ['id' => 2, 'type' => 'math', 'text' => 'nyawaBaru = nyawaSedang + 10'],
                ['id' => 3, 'type' => 'logic', 'text' => 'RETURN nyawaBaru'],
                ['id' => 4, 'type' => 'action', 'text' => 'nyawa_player = heal(50)'],
                ['id' => 5, 'type' => 'loop', 'text' => 'JIKA nyawa_player == 0'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Memanipulasi data lewat parameter lalu mereturn hasilnya adalah cara paling stabil dan direkomendasikan untuk menghindari konflik Scope!',
        ]);
    }

    private function createLogicLessonNestedLoop($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'nested-loop'],
            [
                'course_id' => $course->id, 'title' => 'Nested Loop',
                'content' => 'Perulangan di dalam perulangan.', 'video_url' => null, 'order' => 12, 'xp_reward' => 50,
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

    private function createLogicLessonDebugging($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pengenalan-debugging'],
            [
                'course_id' => $course->id, 'title' => 'Pengenalan Debugging',
                'content' => 'Sebagai detektif kode yang ulung.', 'video_url' => null, 'order' => 13, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Bug?', 'content' => "Dalama programming, *Bug* berarti kecacatan atau kesalahan dalam kode yang menyebabkan program crash atau berperilaku tidak sesuai harapan.\nError adalah makanan sehari-hari programmer!"]);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 101, 'Apa definisi "Bug" dalam dunia pengembangan software?', [
            ['id' => 'A', 'text' => 'Serangga sungguhan di dalam keyboard', 'correct' => false],
            ['id' => 'B', 'text' => 'Fitur virus yang merusak data', 'correct' => false],
            ['id' => 'C', 'text' => 'Kesalahan logika atau sintaks pada program komputer', 'correct' => true],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Apa itu Debugging?', 'content' => "Debugging adalah proses super penting: mencari tahu penyebab Bug dan memperbaikinya secara sistematis.\nIni ibarat menjadi detektif yang menelusuri jejak kaki kriminal."]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 102, 'Tujuan utama dari Debugging adalah untuk?', [
            ['id' => 'A', 'text' => 'Menemukan dan memperbaiki error dalam kode', 'correct' => true],
            ['id' => 'B', 'text' => 'Mengeksekusi program lebih cepat berkali-kali', 'correct' => false],
            ['id' => 'C', 'text' => 'Menghapus seluruh file project', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Sintaks Error vs Logic Error', 'content' => "1. *Syntax Error*: Kamu salah ketik bahasa pemrogramannya. Mudah ditemukan karena ada peringatan merah.\n2. *Logic Error*: Kodenya jalan mulus, tapi hasil bilang '2 + 2 = 5'. Ini jauh lebih berbahaya dan susah dicari!"]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 103, 'Jenis Error apa yang programnya tetap bisa jalan tapi output/hasilnya keliru?', [
            ['id' => 'A', 'text' => 'Syntax Error (Kesalahan tata bahasa)', 'correct' => false],
            ['id' => 'B', 'text' => 'Logic Error (Kesalahan logika berpikir)', 'correct' => true],
            ['id' => 'C', 'text' => 'Tidak ada yang benar', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Senjata 1: Membaca Pesan Error', 'content' => "Saat program error, komputer TIDAK DIAM, ia meninggalkan pesan error (Stack Trace).\nPesan itu berisi nama file yang bermasalah dan tebakan di baris ke berapa masalahnya berada!"]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 104, 'Apa yang pertama kali dilakukan programmer bila melihat kode tiba-tiba Crash (Rusak)?', [
            ['id' => 'A', 'text' => 'Panik lalu merestart komputer', 'correct' => false],
            ['id' => 'B', 'text' => 'Langsung menghapus 100 baris kode', 'correct' => false],
            ['id' => 'C', 'text' => 'Membaca Pesan Error untuk mencari petunjuk baris kejadian', 'correct' => true],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Senjata 2: Debug dengan PRINT', 'content' => "Teknik paling purba seantero bumi adalah mengapit kodenya dengan `PRINT(\"Sampai Sini Jalan\")`.\nJika tulisan itu tercetak, artinya kodenya sehat SETIDAKNYA sampai tahap PRINT tersebut. Jika tidak, artinya error ada di atasnya."]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 105, 'Bagaimana teknik PRINT Debugging bekerja?', [
            ['id' => 'A', 'text' => 'Mencetak baris teks untuk melihat sejauh mana program masih bertahan hidup tanpa crash', 'correct' => true],
            ['id' => 'B', 'text' => 'Mengirim hasil cetakan ke kertas lewat printer', 'correct' => false],
            ['id' => 'C', 'text' => 'Memanggil fungsi tambahan dari internet', 'correct' => false],
        ]);

        // 11. Trivia
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Mengecek Isi Variabel', 'content' => "Sering kali variabel berisi sesuatu yang 'GHAIB'. Kamu kira isinya angka `5`, ternyata ia bertipe Teks `\"5\"`, lalu ditambahkan, crash.\nMaka panggil `PRINT(Tipe(variabel))` untuk memverifikasi kecurigaanmu."]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 106, 'Mengapa memverifikasi isi dan tipe variabel penting dalam debugging?', [
            ['id' => 'A', 'text' => 'Agar programmer tidak bosan', 'correct' => false],
            ['id' => 'B', 'text' => 'Kerap kali Logic Error terjadi karena isi data berbeda dari ekspektasi (misal minta angka, datang huruf)', 'correct' => true],
            ['id' => 'C', 'text' => 'Karena bahasa pemrograman mewajibkannya', 'correct' => false],
        ]);

        // 13. Trivia
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Debugger (The Ultimate Tool)', 'content' => "Aplikasi Editor keren (seperti VSCode) punya fitur *Debugger*.\nDengan tools ini, kamu bisa mengerem waktu dan mem-Pause program baris demi baris layaknya mesin waktu, dan 'mengintip' nilai variabel terbang secara live."]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 107, 'Satu kelebihan utama fitur Debugger (vs Sekadar teknik PRINT biasa) adalah?', [
            ['id' => 'A', 'text' => 'Debugger bisa menghentikan sementara (pause) eksekusi dan berjalan baris per baris pelan-pelan', 'correct' => true],
            ['id' => 'B', 'text' => 'Debugger bekerja jauh lebih boros dan merusak komputer', 'correct' => false],
            ['id' => 'C', 'text' => 'Debugger tidak butuh listrik untuk berjalan', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — Proses Detektif
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Prosedur Standar Detektif 🔍',
            'content' => 'Susun tahapan standar profesional dalam melakukan debugging program!',
            'options' => [
                ['id' => 0, 'text' => 'Program Crash! Layar merah muncul'],
                ['id' => 1, 'text' => '1. Baca Pesan Error dan Baris lokasinya secara teliti'],
                ['id' => 2, 'text' => '2. Tuju baris kode itu dan pahami apa niat awal programmu'],
                ['id' => 3, 'text' => '3. Temukan letak perbedaannya, perbaiki, dan Simpan(Save)'],
                ['id' => 4, 'text' => '4. Jalankan ulang program untuk verifikasi!'],
            ],
            'correct_answer' => null,
            'explanation' => 'Penting: Jangan tebak-tebak buah manggis, mulailah selalu dari jejak Error Message yang ditinggalkan!',
        ]);

        // 16. Minigame: Fill in the Blank — Menangkap Monster Variabel
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Bug Tipe Data Ghaib! 👻',
            'content' => 'Gunakan trik `PRINT` untuk menengahi cekikan tipe data. Umurnya disangka integer!',
            'options' => [
                ['type' => 'text', 'value' => 'umur = "25"\nhitung = umur + 10 # BOOM! program error!'],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => "\n\n# Kamu curiga tipe datanya, maka kamu tambahkan:\n"],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => " TipeData(umur)\n\n# Dan oh! Output muncul "],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => " bukannya Angka!! Itulah dalang dibalik Crash tersebut."],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => '# Error', 'color' => 'blue'],
                ['id' => 2, 'text' => 'PRINT', 'color' => 'orange'],
                ['id' => 3, 'text' => '"Teks/String"', 'color' => 'green'],
                ['id' => 4, 'text' => 'Float', 'color' => 'purple'], // Distractor
            ]),
            'explanation' => 'Kita sering tidak sadar variabel menerima teks/tulisan, lalu kita memaksanya untuk perhitungan matematika, jelas Error.',
        ]);

        // 17. Minigame: Block Code — Susun Benteng Debug
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Susun Print-Trap! 🪤',
            'content' => 'Susun perangkap PRINT di antara logika rumit demi memastikan bahwa program setidaknya berhasil melewati tahapan A.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'Awal = Muat Sistem Data'],
                ['id' => 2, 'type' => 'action', 'text' => 'PRINT "Data Berhasil Dimuat!"'],
                ['id' => 3, 'type' => 'logic', 'text' => 'Tahapan_B = Proses Kalkulasi_Sulit()'],
                ['id' => 4, 'type' => 'action', 'text' => 'PRINT "Kalkulasi Berhasil!"'],
                ['id' => 5, 'type' => 'boolean', 'text' => 'Hancurkan Data()'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Menaruh PRINT di antara logika bahaya memastikan "Jika cuma keluar PRINT data dimuat, berati error pasti terjadi pas Kalkulasi_Sulit!"',
        ]);
    }

    private function createLogicLessonStackQueue($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'stack-dan-queue'],
            [
                'course_id' => $course->id, 'title' => 'Struktur Data Stack & Queue',
                'content' => 'Tumpukan piring dan antrean kasir.', 'video_url' => null, 'order' => 14, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Dua Bersaudara', 'content' => "Array menyimpan data secara berbaris.\nTapi ada dua cara \"Khusus\" yang sangat terkenal untuk memanipulasi Array tersebut: *Stack* (Tumpukan) dan *Queue* (Antrean)."]);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 111, 'Apakah Stack dan Queue itu?', [
            ['id' => 'A', 'text' => 'Bahasa pemrograman baru', 'correct' => false],
            ['id' => 'B', 'text' => 'Bentuk manipulasi khusus dari struktur data penyimpan berbaris', 'correct' => true],
            ['id' => 'C', 'text' => 'Hardware komputer', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Stack = Tumpukan Piring', 'content' => "Bayangkan kamu mencuci piring lalu di**tumpuk**.\nPiring yang *terakhir* ditaruh di atas, pasti akan menjadi piring *pertama* yang diambil!"]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 112, 'Sesuai analogi tumpukan piring, data Stack bekerja dengan prinsip apa?', [
            ['id' => 'A', 'text' => 'Data bebas diacak', 'correct' => false],
            ['id' => 'B', 'text' => 'Data terakhir masuk, dialah yang pertama keluar', 'correct' => true],
            ['id' => 'C', 'text' => 'Data di tengah dikeluarkan duluan', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'LIFO (Last In, First Out)', 'content' => "Prinsip Stack sering disingkat **LIFO**.\n(Yang Terakhir Masuk, Yang Pertama Keluar).\nContoh penggunaan nyatanya adalah tombol \'Undo/CTRL+Z\' di komputermu!"]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 113, 'Tombol Undo (kembalikan aksi) adalah contoh penggunaan struktur data apa?', [
            ['id' => 'A', 'text' => 'Queue / LIFO', 'correct' => false],
            ['id' => 'B', 'text' => 'Stack / LIFO', 'correct' => true],
            ['id' => 'C', 'text' => 'Tree', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Queue = Antrean Kasir', 'content' => "Queue adalah Antrean Kasir.\nOrang (data) yang *Paling Awal (Pertama)* datang, dialah yang akan *Paling Awal (Pertama)* dilayani/keluar."]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 114, 'Dalam dunia nyata, analogi paling tepat untuk Queue adalah?', [
            ['id' => 'A', 'text' => 'Antrean membeli tiket', 'correct' => true],
            ['id' => 'B', 'text' => 'Tumpukan buku', 'correct' => false],
            ['id' => 'C', 'text' => 'Air dari gayung', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'FIFO (First In, First Out)', 'content' => "Prinsip antrean ini disingkat **FIFO**.\n(Yang Pertama Datang, Dialah yang Pertama Keluar).\nIni digunakan oleh printer untuk print dokumen satu persatu, atau antrean lagu Spotify."]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 115, 'Sistem antrean printer yang mencetak dokumen satu demi satu disebut?', [
            ['id' => 'A', 'text' => 'LIFO (Last In First Out)', 'correct' => false],
            ['id' => 'B', 'text' => 'FIFO (First In First Out)', 'correct' => true],
            ['id' => 'C', 'text' => 'LILO (Last In Last Out)', 'correct' => false],
        ]);

        // 11. Trivia
        $lesson->slides()->firstOrCreate(['order' => 14], ['type' => 'text', 'title' => 'Operasi Utama', 'content' => "Istilah untuk menambah data di *Stack* adalah **Push**, untuk mengambil data namanya **Pop**.\nUntuk menambah data di *Queue* adalah **Enqueue**, lalu mengambil data **Dequeue**."]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 116, 'Apa istilah untuk mengeluarkan (mengambil) data paling atas dari sebuah struktur Stack?', [
            ['id' => 'A', 'text' => 'Pop', 'correct' => true],
            ['id' => 'B', 'text' => 'Push', 'correct' => false],
            ['id' => 'C', 'text' => 'Enqueue', 'correct' => false],
        ]);

        // 13. Trivia
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Kapasitas (Overflow)', 'content' => "Baik tumpukan maupun antrean bisa Penuh! Kalau memori komputer habis gara-gara tumpukan kepenuhan, itu disebut **Stack Overflow**.\n(Ya, asal nama website tanya jawab coding populer itu dari sini)."]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 117, 'Apa yang terjadi jika kita terus memasukkan data (Push) hingga memori komputer penuh?', [
            ['id' => 'A', 'text' => 'Program berjalan lebih cepat', 'correct' => false],
            ['id' => 'B', 'text' => 'Program akan mengalami kehancuran memori (Stack Overflow)', 'correct' => true],
            ['id' => 'C', 'text' => 'Tumpukan berubah jadi antrean', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — Cara Kerja Printer
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Mesin Pencetak (FIFO) 🖨️',
            'content' => 'Susun log agar printer menyelesaikan dan menghapus dokumen dari memori pakai sistem Queue/Antrean!',
            'options' => [
                ['id' => 0, 'text' => 'Printer Antrean: [Proposal, PR, Foto]'],
                ['id' => 1, 'text' => 'DEQUEUE (Print Proposal)'],
                ['id' => 2, 'text' => 'Antrean tersisa: [PR, Foto]'],
                ['id' => 3, 'text' => 'DEQUEUE (Print PR)'],
                ['id' => 4, 'text' => 'Antrean tersisa: [Foto]'],
            ],
            'correct_answer' => null,
            'explanation' => 'Queue secara ketat memproses yang datang lebih awal (Proposal yang masuk duluan, maka dia yang keluar diprint duluan).',
        ]);

        // 16. Minigame: Fill in the Blank — Menumpuk Baju
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'LIFO Si Tumpukan Baju 🧦',
            'content' => 'Isi struktur kata di bawah ini sesuai karakteristik LIFO dari Stack.',
            'options' => [
                ['type' => 'text', 'value' => 'Data A dimasukkan. Lalu B dimasukkan atasnya. Tumpukan = [A, B].\\nOperasinya disebut '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '\\nKemudian kita mengambil data. Operasi pengambilannya disebut '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '\\nSesuai konsep LIFO, nilai yang terambil adalah '],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Push', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Pop', 'color' => 'orange'],
                ['id' => 3, 'text' => 'B', 'color' => 'green'],
                ['id' => 4, 'text' => 'A', 'color' => 'purple'], // Distractor
            ]),
            'explanation' => 'Push menumpuk ke atas. Pop mengambil dari atas. Karena B ditumpuk BELAKANGAN, B lah yang ditarik PERTAMA KALI.',
        ]);

        // 17. Minigame: Block Code — Susun CTRL+Z
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Program Tombol Undo 🔙',
            'content' => 'Buat logika stack sederhana untuk Sistem Undo pada software menggambar.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'StackRiwayat = []'],
                ['id' => 2, 'type' => 'action', 'text' => 'PUSH "Gambar Lingkaran"'],
                ['id' => 3, 'type' => 'action', 'text' => 'PUSH "Beri Warna Merah"'],
                ['id' => 4, 'type' => 'logic', 'text' => 'JIKA user menekan Undo:'],
                ['id' => 5, 'type' => 'action', 'text' => 'POP riwayat (Hapus Warna Merah)'],
                ['id' => 6, 'type' => 'math', 'text' => 'Dequeue Data'],
            ],
            'correct_answer' => '1,2,3,4,5',
            'explanation' => 'Sistem Undo menyusun aksi History ke dalam Stack. Ketika kamu memencet Undo (Pop), aksi paling TERAKHIR kamu buat ("Warna Merah") lah yang akan dicabut lebih dulu.',
        ]);
    }

    private function createLogicLessonSearching($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pencarian-sederhana'],
            [
                'course_id' => $course->id, 'title' => 'Algoritma Pencarian',
                'content' => 'Menemukan jarum dalam tumpukan jerami.', 'video_url' => null, 'order' => 15, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Kenapa Butuh Algoritma Pencarian?', 'content' => "Di dunia nyata, kita sering mencari data: kontak teman di HP, film di Netflix, atau barang di Tokopedia.\nAgar komputer bisa 'menemukan' data dengan cepat, dibutuhkan teknik Algoritma Pencarian yang pintar."]);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 121, 'Apa fungsi utama algoritma pencarian (Searching)?', [
            ['id' => 'A', 'text' => 'Mengubah gambar jadi teks', 'correct' => false],
            ['id' => 'B', 'text' => 'Menemukan lokasi data spesifik dari dalam kumpulan data (Array)', 'correct' => true],
            ['id' => 'C', 'text' => 'Menghapus virus dari komputer', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Linear Search (Pencarian Lurus)', 'content' => "Ini adalah cara mencari paling sederhana: periksa data SATU PER SATU dari awal sampai akhir, sampai barang yang dicari ketemu.\nSangat cocok untuk data yang acak tidak berurutan."]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 122, 'Bagaimana cara kerja Linear Search?', [
            ['id' => 'A', 'text' => 'Acak data bolak balik', 'correct' => false],
            ['id' => 'B', 'text' => 'Langsung mencari ke bagian tengah layar', 'correct' => false],
            ['id' => 'C', 'text' => 'Mengecek data satu demi satu berurutan dari awal sampai akhir', 'correct' => true],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Kelemahan Linear Search', 'content' => "Bayangkan mencari kata 'Zebra' di Kamus Besar Bahasa Indonesia dengan membalik halaman SATU PER SATU dari depan. Sangat lama dan membuang waktu, kan?\nLinear Search sangat pelan untuk data yang ribuan/jutaan."]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 123, 'Kapan Linear Search menjadi SANGAT tidak efisien?', [
            ['id' => 'A', 'text' => 'Ketika jumlah data mencapai jutaan item', 'correct' => true],
            ['id' => 'B', 'text' => 'Ketika data hanya berisi 10 angka', 'correct' => false],
            ['id' => 'C', 'text' => 'Ketika dicari pada siang hari', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Binary Search (Pancarian Terbelah)', 'content' => "Solusi mencari lebih cepat adalah *Binary Search*.\nPrinsipnya: Data HARUS SUDAH URUT! Lalu kita tebak bagian tengahnya. Jika target lebih kecil, buang setengah data bagian kanan. Jika lebih besar, buang yang kiri. Cepat bukan!"]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 124, 'Apa SYARAT MUTLAK agar Binary Search bisa digunakan?', [
            ['id' => 'A', 'text' => 'Data harus acak sepenuhnya', 'correct' => false],
            ['id' => 'B', 'text' => 'Data HARUS sudah terurut (Sorted)', 'correct' => true],
            ['id' => 'C', 'text' => 'Jumlah data ganjil', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Simulasi Binary Search', 'content' => "Cari angka 7 di: [1, 3, 5, 7, 9]\nTengah: 5 (Lebih kecil dari 7, buang sebelah kiri)\nSisa target: [7, 9]\nTengah: 7 (Ketemu!)\nHanya butuh 2 tebakan, alih-alih 4 kali cek dengan linear!"]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 125, 'Bagaimana teknik Binary Search mempercepat pencarian?', [
            ['id' => 'A', 'text' => 'Dengan membuang setengah kemungkinan data yang tidak relevan di setiap langkah', 'correct' => true],
            ['id' => 'B', 'text' => 'Membeli komputer yang lebih mahal', 'correct' => false],
            ['id' => 'C', 'text' => 'Dengan mencari 2 data sekaligus', 'correct' => false],
        ]);

        // 11. Trivia
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Skenario Error (Tidak Ditemukan)', 'content' => "Dalam algoritma pencarian, kita harus membuat skenario \"Apa yang harus dilakukan bila data tidak ketemu?\"\nBiasanya programmer akan mereturn nilai khusus seperti `-1` atau `False` untuk nandain gagal."]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 126, 'Apa standar pengembalian nilai yang sering dipakai jika pencarian GAGAL?', [
            ['id' => 'A', 'text' => 'Angka 100', 'correct' => false],
            ['id' => 'B', 'text' => 'Mereturn nilai -1 atau False/Null', 'correct' => true],
            ['id' => 'C', 'text' => 'Hapus file program', 'correct' => false],
        ]);

        // 13. Trivia
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Ganti Tool sesuai Kondisi', 'content' => "Tidak ada algoritma yang 'Terbaik'.\nJika array data acak dan pendek -> Linear Search.\nJika mencari nama orang di buku telepon (terurut) dan jutaan -> Binary Search! Program yang baik tahu kapan memakai tool yang tepat."]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 127, 'Algoritma mana yang lebih baik mengecek daftar 10 nama murid absen yang ACAK?', [
            ['id' => 'A', 'text' => 'Binary Search', 'correct' => false],
            ['id' => 'B', 'text' => 'Mengurutkannya dulu, baru pakai Binary', 'correct' => false],
            ['id' => 'C', 'text' => 'Pakai saja Linear Search secara langsung (Kekuatan Pengecekan Satu Persatu)', 'correct' => true],
        ]);

        // 15. Minigame: Code Arrange — Linear Search Standar
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Linear Search Lurus 🔍',
            'content' => 'Temukan angka 8 dengan menjejak dari awal. Susun kodenya!',
            'options' => [
                ['id' => 0, 'text' => 'ARRAY data = [2, 5, 8, 10]'],
                ['id' => 1, 'text' => 'UNTUK SETIAP item di data:'],
                ['id' => 2, 'text' => '  JIKA item == 8'],
                ['id' => 3, 'text' => '    RETURN "Ketemu!"'],
                ['id' => 4, 'text' => 'RETURN "Gagal" # Jika diluar Loop habis tak ada hasil'],
            ],
            'correct_answer' => null,
            'explanation' => 'Loop periksa dari nomor 1. Begitu dicek ada yang sama persis, dia lapor dan pekerjaan selesai!',
        ]);

        // 16. Minigame: Fill in the Blank — Binary Search
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Senjata Binary Search! ⚔️',
            'content' => 'Lengkapi rumpang cara kerja pemotongan data untuk Binary Search (Target yang dicari lebih kecil).',
            'options' => [
                ['type' => 'text', 'value' => 'Data: [1, 2, 3, 4, 5, 6, 7]. Target = 2.\nLangkah Pertama lihat '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' yaitu angka (4).\nKarena 2 lebih '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' dari 4, maka data di bagian KANAN '],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ' sepenuhnya!'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Tengah', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Kecil', 'color' => 'orange'],
                ['id' => 3, 'text' => 'Dibuang', 'color' => 'green'],
                ['id' => 4, 'text' => 'Besar', 'color' => 'purple'], // Distractor
            ]),
            'explanation' => 'Tengah-tengah adalah titik pembaginya. Kita membuang data kanan karena target 2 PASTI ada di potongan wilayah sebelah kiri.',
        ]);

        // 17. Minigame: Block Code — Susun Pencarianmu
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Mesin Pencari Absen 🧑‍🎓',
            'content' => 'Rangkai program Linear Search yang mencari nama "Budi" dari array siswa.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'siswa = ["Ani", "Budi", "Caca"]'],
                ['id' => 2, 'type' => 'loop', 'text' => 'UNTUK tiap nama di siswa:'],
                ['id' => 3, 'type' => 'logic', 'text' => 'JIKA nama == "Budi"'],
                ['id' => 4, 'type' => 'action', 'text' => 'PRINT "Hadir!"'],
                ['id' => 5, 'type' => 'math', 'text' => 'nama + 10'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Instruksinya runtut: Siapkan data -> Lakukan putaran periksa satu-satu (Loop) -> Cek pakai IF jika nama cocok -> Print.',
        ]);
    }

    private function createLogicLessonSorting($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'algoritma-pengurutan'],
            [
                'course_id' => $course->id, 'title' => 'Algoritma Pengurutan (Sorting)',
                'content' => 'Merapikan data yang berantakan.', 'video_url' => null, 'order' => 16, 'xp_reward' => 50,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Kenapa harus diurutkan?', 'content' => "Data dari pengguna kadang dimasukkan acak-acakan.\nTapi saat ditampilkan seperti Klasemen Game FPS, tentu kita ingin yang skornya TERTINGGI ada di urutan teratas kan? Teknik mengubah susunan array itulah Sorting."]);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 131, 'Apa definisi dasar dari Sorting?', [
            ['id' => 'A', 'text' => 'Menghapus data ganda', 'correct' => false],
            ['id' => 'B', 'text' => 'Menyusun sebuah antrean data berdasarkan kriteria tertentu (Kecil->Besar dsb)', 'correct' => true],
            ['id' => 'C', 'text' => 'Mengacak warna teks', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Ascending vs Descending', 'content' => "Ascending: Naik (Misal dari A ke Z, atau 1 ke 100).\nDescending: Turun (Misal Klasemen Game dari nomor 100 turun ke 1, supaya yang menang skornya di Atas)."]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 132, 'Jika kita ingin menampilkan top skor dari yang paling mahir (skor terbesar) hingga yang paling bawah, tipe sorting yang dipakai?', [
            ['id' => 'A', 'text' => 'Ascending', 'correct' => false],
            ['id' => 'B', 'text' => 'Descending', 'correct' => true],
            ['id' => 'C', 'text' => 'Randomize', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Tukar Menukar (Swap)', 'content' => "Mayoritas dasar dari Teknik Pengurutan adalah proses *SWAP* atau menukar dua barang bertetangga.\nJika posisi yang Kiri lebih besar dari posisi Kanan, maka tukar keduanya. Lakukan berulang kali."]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 133, 'Inti dari manipulasi urutan elemen di algoritma Sorting adalah?', [
            ['id' => 'A', 'text' => 'Menambahkan data baru', 'correct' => false],
            ['id' => 'B', 'text' => 'Menukar (Swap) letak dua komponen Array', 'correct' => true],
            ['id' => 'C', 'text' => 'Membagi kumpulan angka', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Bubble Sort (Balon Mengudara)', 'content' => "Bubble sort itu memanipulasi seperti gelembung air: angka terbesar pelan-pelan digeser terus ke kanan sampai mentok. Kemudian proses diulang ke sisa awal. Begitu terus sampai terurut rapi."]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 134, 'Cara kerja Bubble Sort adalah?', [
            ['id' => 'A', 'text' => 'Mengocok angka', 'correct' => false],
            ['id' => 'B', 'text' => 'Membuang angka acak', 'correct' => false],
            ['id' => 'C', 'text' => 'Menggeser/Menukar angka besar secara perlahan terus ke sebelah kanan hingga ujung', 'correct' => true],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Simulasi Bubble Sort', 'content' => "[Sah, 5, 2, 8]\nCek (5 dan 2), 5 lebih besar! Maka SWAP.\nJadinya [2, 5, 8].\nCek (5 dan 8), 5 kecil, jangan digeser.\nBegitu terus sampai tidak ada yang bersinggungan kebalik!"]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 135, 'Jika Array = [3, 1], ada langkah Bubble Sort yang membuat mereka ditukar (3 ditaruh belakang). Bagaimanakah array finalnya?', [
            ['id' => 'A', 'text' => '[1, 3]', 'correct' => true],
            ['id' => 'B', 'text' => '[3, 1]', 'correct' => false],
            ['id' => 'C', 'text' => '[1, 1]', 'correct' => false],
        ]);

        // 11. Trivia
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Apakah cuman ada Bubble Sort?', 'content' => "Tentu tidak! Programmer menemukan puluhan cara men-sorting data. Ada *Merge Sort* (membelah data lalu menyatukan lgi), *Quick Sort* (pakai patokan pivot).\nBubble sort pelan, tapi sangat gampang dipelajari konsepnya!"]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 136, 'Mengapa programmer butuh banyak teori Algoritma Pengurutan (Quick, Merge, dsbg) jika Bubble Sort sudah bisa?', [
            ['id' => 'A', 'text' => 'Karena itu seru', 'correct' => false],
            ['id' => 'B', 'text' => 'Karena untuk data raksasa (ribuan elemen), Bubble sort amat lelet, butuh algoritma yang lebih cerdik dan Melesat (seperti Quick Sort)', 'correct' => true],
            ['id' => 'C', 'text' => 'Biar rumit dipelajari', 'correct' => false],
        ]);

        // 13. Trivia
        $lesson->slides()->firstOrCreate(['order' => 16], ['type' => 'text', 'title' => 'Built-In Sort', 'content' => "Beruntunglah kamu lahir zaman sekarang. Di bahasa pemrograman moderen misal Python, kamu cukup panggil `buah.sort()` dan boom! langsung terurut ke A-Z otomatis."]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 137, 'Meski bahasa pemrograman zaman sekarang sudah punya `.sort()`, kenapa kita harus mengerti filosofi teknik Sorting?', [
            ['id' => 'A', 'text' => 'Agar keren di ujian', 'correct' => false],
            ['id' => 'B', 'text' => 'Untuk melatih logika berfikir secara sistematis ketika dihadapkan soal penarikan rumit lainnya', 'correct' => true],
            ['id' => 'C', 'text' => 'Agar program cepat', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — Simulasi Swap Buble
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Geser Biar Rapi 🔀',
            'content' => 'Susun langkah menukar 2 angka array jika yang Kiri lebih Gede menurut prinsip Bubble Sort (Ascending)!',
            'options' => [
                ['id' => 0, 'text' => 'JIKA data[kiri] > data[kanan]:'],
                ['id' => 1, 'text' => '  wadah_sementara = data[kiri]'],
                ['id' => 2, 'text' => '  data[kiri] = data[kanan]'],
                ['id' => 3, 'text' => '  data[kanan] = wadah_sementara'],
            ],
            'correct_answer' => null,
            'explanation' => 'Kita tidak bisa langsung mengganti variabel a ke b. Harus dipinjam di gelas kosong (wadah_sementara) dulu biar isinya nggak tumpah!',
        ]);

        // 16. Minigame: Fill in the Blank — Fungsi .sort Terpendek
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Cara Singkat Orang Malas! 🥱',
            'content' => 'Urutkan data tanpa mikir pakai Built-in method dan cetak hasil Ascendingnya.',
            'options' => [
                ['type' => 'text', 'value' => 'skor = [5, 1, 9, 3]\n\n# Memanggil fungsi bawaan agar terurut Acending\nskor.'],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => "()\n\n# Tampilkan hasil jadinya!\n"],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => " skor\n# Hasilnya -> "],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'sort', 'color' => 'blue'],
                ['id' => 2, 'text' => 'PRINT', 'color' => 'orange'],
                ['id' => 3, 'text' => '[1,3,5,9]', 'color' => 'green'],
                ['id' => 4, 'text' => '[9,5,3,1]', 'color' => 'purple'], // Distractor
            ]),
            'explanation' => 'Fungsi sort() memilah secara ascending (dari Terkecil->Terbesar). Sehingga yang asalnya acak langsung tertata manis [1,3,5,9].',
        ]);

        // 17. Minigame: Block Code — Tukar Barang
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Piala Terbalik 🏆',
            'content' => 'Ahmad sang juara 1 salah nerima piala perak. Susun urutan instruksi swap agar Budi (Juara 2) memberikan pialanya ke Ahmad!',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'Meja = Piala [Ahmad]'],
                ['id' => 2, 'type' => 'action', 'text' => 'Piala [Ahmad] = Piala [Budi]'],
                ['id' => 3, 'type' => 'action', 'text' => 'Piala [Budi] = Meja'],
                ['id' => 4, 'type' => 'logic', 'text' => 'JIKA Budi = Ahmad'],
                ['id' => 5, 'type' => 'loop', 'text' => 'ULANGI 2X'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => 'Ini adalah esensi murni dari SWAP variabel pada struktur memori komputer! Pinjam memori "Meja" sementara sebelum ditiban.',
        ]);
    }

    private function createLogicLessonRecursion($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pola-rekursi'],
            [
                'course_id' => $course->id, 'title' => 'Konsep Rekursi',
                'content' => 'Fungsi yang memanggil dirinya sendiri.', 'video_url' => null, 'order' => 17, 'xp_reward' => 55,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Cerita Boneka Rusia (Matryoshka)', 'content' => "Pernah lihat boneka Rusia yang kalau dibuka, ada boneka lebih kecil di dalamnya?\nDan di dalamnya ada boneka yang lebih kecil lagi.\nItulah esensi *REKURSI*: Cerminan di dalam Cerminan."]);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 141, 'Secara konsep, Rekursi sangat terinspirasi dan mirip dengan benda apa?', [
            ['id' => 'A', 'text' => 'Uang Logam', 'correct' => false],
            ['id' => 'B', 'text' => 'Boneka Matryoshka (Boneka beranak menembus ke dalam)', 'correct' => true],
            ['id' => 'C', 'text' => 'Roda bergulir', 'correct' => false],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Fungsi Memanggil Dirinya Sendiri', 'content' => "Secara kode, algoritma *Rekursif* adalah apabila sebuah fungsi di dalamnya MELAKUKAN PEMANGGILAN TERHADAP FUNGSINYA SENDIRI.\nContoh: `def bersihkan()` di dalamnya memanggil lagi `bersihkan()`."]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 142, 'Kapan sebuah algoritma resmi bisa dikategorikan sebagai Fungsi Rekursif?', [
            ['id' => 'A', 'text' => 'Saat ia memiliki return', 'correct' => false],
            ['id' => 'B', 'text' => 'Jika ia melakukan operasi matematika', 'correct' => false],
            ['id' => 'C', 'text' => 'Bila ia di dalam bloknya mengeksekusi (memanggil) kembali fungsinya sendiri', 'correct' => true],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Perangkap Mengerikan (Infinite Loop)', 'content' => "Karena fungsi itu memanggil fungsinya kembali, lalu yg terpanggil akan memanggil lagi, lalu lagi.\nJika TIADA BATAS, maka komputer akan terjebak LOOP TANPA UJUNG dan program akan Error memori! (Stack Overflow)"]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 143, 'Kelalaian apa yang menyebabkan fitur Rekursi malah membuat program rusak / hang?', [
            ['id' => 'A', 'text' => 'Karena lupa memberi kondisi titik henti sehingga fungsi memanggil tiada henti', 'correct' => true],
            ['id' => 'B', 'text' => 'Karena komputer kehabisan baterai', 'correct' => false],
            ['id' => 'C', 'text' => 'Karena bahasa pemrogramannya jadul', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Syarat Utama: BASE CASE', 'content' => "Agar selamat, fungsi ajaib ini wajib punya sebuah Rem Berhenti yang dinamakan **Base Case**.\nJika sebuah syarat Base case terpenuhi (misal Hitungan ke 0), dia HARUS me- रिटर्न (Return) dan STOP mendelegasikan tugas!"]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 144, 'Istilah untuk kondisi pengerem/penghenti yang wajib ada di dalam pola Rekursi adalah?', [
            ['id' => 'A', 'text' => 'Switch Case', 'correct' => false],
            ['id' => 'B', 'text' => 'Base Case', 'correct' => true],
            ['id' => 'C', 'text' => 'Lower Case', 'correct' => false],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Kenapa Tidak Pakai For Loop Saja?', 'content' => "Memang betul sebuah rekursif PASTI juga bisa diselesaikan dengan loop reguler (For/While).\nTetapi Rekursi membuat solusi jadi jauh lebih SANGAT ELEGAN dan SINGKAT, utamanya di bidang perhitungan keriting seperti Faktorial atau Sistem Folder (Tree)."]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 145, 'Apa alasan utama programmer menggunakan algoritma Rekursi dibanding Loop biasa?', [
            ['id' => 'A', 'text' => 'Karena kode For Loop telah dihapus dari komputer', 'correct' => false],
            ['id' => 'B', 'text' => 'Pola Rekursif membuat pemecahan logika bersarang / bercabang jauh lebih elegan dan bersih', 'correct' => true],
            ['id' => 'C', 'text' => 'Perintah atasan perusahaan', 'correct' => false],
        ]);

        // 11. Trivia
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Contoh Faktorial Sederhana', 'content' => "5 Faktorial artinya `5 x 4 x 3 x 2 x 1`.\nDengan Rekursif logikanya sesederhana: `hitung(5) itu adalah mengalikan 5 dengan hitung(4)`.\nDan `hitung(4)` memanggil `hitung(3)`... Terus sampai ketok Base Case (1)."]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 146, 'Berdasarkan pola rekursif 5 faktorial (5!), bagaimana cara penjabarannya yang meniru pendelegasian sifat Rekursi?', [
            ['id' => 'A', 'text' => 'Tanya kepada teman', 'correct' => false],
            ['id' => 'B', 'text' => 'Ulangi for loop dengan bebas', 'correct' => false],
            ['id' => 'C', 'text' => 'Hasil 5! = \'5 dikali dengan hasil delegasi dari pola rekursi (4!)\'', 'correct' => true],
        ]);

        // 13. Trivia
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Berhati-hatilah', 'content' => "Memahami rekursi itu seperti meme Inception. Awalnya kepalamu pusing. Tapi saat kamu menangkap idenya 'Menugaskan fungsi yang sama namun versi yang lebih kecil!', seketika matamu akan terbuka layaknya dewa kode!"]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 147, 'Mana trik kalimat yang membantu akal manusia menjernihkan mindset memahami rekursi?', [
            ['id' => 'A', 'text' => 'Menyelesaikan sebuah problem rumit dengan cara melempar versi yang \'sedikit Lebih Kecil\' dari problem tsb ke fungsinya lagi sampai menyentuh dasar minimal.', 'correct' => true],
            ['id' => 'B', 'text' => 'Mengcopy paste kode 20 kali', 'correct' => false],
            ['id' => 'C', 'text' => 'Mematikan internet', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — Pola Rekursi Bom
        $lesson->slides()->firstOrCreate(['order' => 15], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Hitung Mundur Bom 💣',
            'content' => 'Susun pola rekursi menghitung mundur hingga memprint "BOM MELEDAK".',
            'options' => [
                ['id' => 0, 'text' => 'FUNCTION hitungMundur(detik):'],
                ['id' => 1, 'text' => '  JIKA detik == 0:  # (BASE CASE)'],
                ['id' => 2, 'text' => '    PRINT "BOM MELEDAK!!"'],
                ['id' => 3, 'text' => '  JIKA TIDAK:'],
                ['id' => 4, 'text' => '    PRINT detik'],
                ['id' => 5, 'text' => '    hitungMundur(detik - 1)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Tanpa BASE CASE if detik == 0, hitungan mundurnya akan menuju minus tak terhingga. Fungsi terus memanggil "versi kecilnya" (detik-1) berulang!',
        ]);

        // 16. Minigame: Fill in the Blank — Faktorial Gila
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Faktorial Otot Kawat! 💪',
            'content' => 'Lengkapi pola rekursif pengerjaan angka Faktorial (A!).',
            'options' => [
                ['type' => 'text', 'value' => "FUNCTION prosesFaktorial(angka):\n  JIKA angka == 1:\n    "],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => " angka # (Base Case)\n  JIKA TIDAK:\n    RETURN angka * "],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => "("],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ") # Ini letak Rekursinya!\nEND"],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'RETURN', 'color' => 'blue'],
                ['id' => 2, 'text' => 'prosesFaktorial', 'color' => 'orange'],
                ['id' => 3, 'text' => 'angka - 1', 'color' => 'green'],
                ['id' => 4, 'text' => 'angka + 1', 'color' => 'purple'], // Distractor
            ]),
            'explanation' => 'Kita me-RETURN angka dikalikan panggilan ulangnya, tapi untuk (angka yang dikurangi 1). Begitu terus hingga nyentuh Base Case (angka == 1)!',
        ]);

        // 17. Minigame: Block Code — Susunan Ajaib Inception
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Bangun Inception-Mu 🏗️',
            'content' => 'Bangun fungsi Rekursif ajaib pemanggil cermin diri.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'FUNCTION masukiMimpi(level)'],
                ['id' => 2, 'type' => 'logic', 'text' => 'JIKA level == 5 RETURN "Terjebak"'],
                ['id' => 3, 'type' => 'action', 'text' => 'masukiMimpi(level + 1)'],
                ['id' => 4, 'type' => 'math', 'text' => 'PRINT "Selamat"'],
                ['id' => 5, 'type' => 'loop', 'text' => 'ULANGI FOR'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => 'Dimulai mendefinisikan fungsinya... lalu memasang Base Case darurat penahan, lantas baru ia diizinkan masuk memanggil mimpi rekursi level berikutnya.',
        ]);
    }

    private function createLogicLessonModular($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pemrograman-modular'],
            [
                'course_id' => $course->id, 'title' => 'Pemrograman Modular',
                'content' => 'Membangun aplikasi seperti menyusun balok Lego.', 'video_url' => null, 'order' => 18, 'xp_reward' => 55,
            ]);

        // 1. Trivia
        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Spaghetti Code', 'content' => "Bayangkan ada sepiring mie spaghetti yang berantakan. Nah, *Spaghetti Code* adalah julukan untuk ribuan baris kode yang ditulis memanjang dalam SATU file utuh tanpa dipisah-pisah.\nPusing matamu bacanya!"]);
        // 2. Quiz (3 pilihan)
        $this->createQuiz($lesson, 151, 'Apa masalah utama dari \'Spaghetti Code\' (kode yang panjang menyatu tanpa struktur)?', [
            ['id' => 'A', 'text' => 'Bikin program jadi berat di database', 'correct' => false],
            ['id' => 'B', 'text' => 'Mengeksekusi lebih cepat', 'correct' => false],
            ['id' => 'C', 'text' => 'Susah dibaca, susah di-debug, dan rentan rusak karena tersenggol (sulit di-maintain)', 'correct' => true],
        ]);

        // 3. Trivia
        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Konsep Pemrograman Modular', 'content' => "Daripada menulis satu file isi 5000 baris, lebih baik memecahnya!\nSatu file berisi 100 baris khusus *Sistem Login*, satu file 200 baris *Sistem Keranjang*, file lain *Koneksi Database*.\nInilah esensi *Pemrograman Modular*."]);
        // 4. Quiz (3 pilihan)
        $this->createQuiz($lesson, 152, 'Apa filosofi dasar Pemrograman Modular?', [
            ['id' => 'A', 'text' => 'Menghemat RAM', 'correct' => false],
            ['id' => 'B', 'text' => 'Memecah aplikasi raksasa menjadi potongan modul-modul (file) kecil yang terpisah sesuai fungsinya', 'correct' => true],
            ['id' => 'C', 'text' => 'Hanya menggunakan satu bahasa pemrograman selamanya', 'correct' => false],
        ]);

        // 5. Trivia
        $lesson->slides()->firstOrCreate(['order' => 5], ['type' => 'text', 'title' => 'Analogi Balok Lego', 'content' => "Modul-modul ini seperti balok Lego.\nSistem login yang kamu rakit hari ini bisa 'dicabut' dan 'dipasang' lagi di project komputermu tahun depan tanpa perlu nulis ulang dari awal! (Reusability)."]);
        // 6. Quiz (3 pilihan)
        $this->createQuiz($lesson, 153, 'Apa keuntungan utama (Reusability) dari memecah program ke dalam modul?', [
            ['id' => 'A', 'text' => 'Program otomatis mendapatkan sertifikat hak cipta', 'correct' => false],
            ['id' => 'B', 'text' => 'Karena kodenya terpisah mandiri, kapanpun kita buat aplikasi baru yang butuh fitur sama, kita tinggal pindahkan/tambahkan modul tersebut tanpa mikir ulang', 'correct' => true],
            ['id' => 'C', 'text' => 'Warnanya jadi lebih indah', 'correct' => false],
        ]);

        // 7. Trivia
        $lesson->slides()->firstOrCreate(['order' => 7], ['type' => 'text', 'title' => 'Library (Perpustakaan Eksternal)', 'content' => "Kadang kamu gak perlu nulis kode sendiri!\nDi dunia Programming ada yang namanya *Library*. Orang pintar di belahan dunia lain telah merakit *Lego Modul* peningkat grafis 3D (misal OpenGL) lalu membagikannya gratis ke internet. Kamu tinggal pasang dan panggil fungsinya!"]);
        // 8. Quiz (3 pilihan)
        $this->createQuiz($lesson, 154, 'Apa yang disebut sebagai Library dalam konteks pemrograman?', [
            ['id' => 'A', 'text' => 'Komputer pusat penyimpan data file sekolah', 'correct' => false],
            ['id' => 'B', 'text' => 'Kumpulan buku pelajaran komputer', 'correct' => false],
            ['id' => 'C', 'text' => 'Modul kode berisi banyak fungsi siap pakai buatan orang lain yang tinggal kita integrasikan ke project kita', 'correct' => true],
        ]);

        // 9. Trivia
        $lesson->slides()->firstOrCreate(['order' => 9], ['type' => 'text', 'title' => 'Bagaimana Cara Manggilnya? (Import/Include)', 'content' => "Agar File A bisa memakai fungsi yang ada di File B, File A harus mengundang temannya!\nBiasanya di awal kode programmer mengetik `import matematika` atau `include 'file_database.php'`."]);
        // 10. Quiz (3 pilihan)
        $this->createQuiz($lesson, 155, 'Perintah apa yang umum digunakan untuk "memasukkan/memuat" modul eksternal ke dalam file tempat kita sedang ngoding?', [
            ['id' => 'A', 'text' => 'Import / Include', 'correct' => true],
            ['id' => 'B', 'text' => 'Insert / Push', 'correct' => false],
            ['id' => 'C', 'text' => 'Print / Echo', 'correct' => false],
        ]);

        // 11. Trivia
        $lesson->slides()->firstOrCreate(['order' => 11], ['type' => 'text', 'title' => 'Mencegah Tabrakan Nama (Namespace)', 'content' => "Bayangkan Modul A punya fungsi `cetakPDF()`. Modul B juga tidak sengaja bawa fungsi bernama `cetakPDF()`.\nKarena berantem, diciptakan sistem Marga (Namespace).\nSaat memanggil kita pakai awalan: `ModulA.cetakPDF()` dan `ModulB.cetakPDF()`. Aman deh!"]);
        // 12. Quiz (3 pilihan)
        $this->createQuiz($lesson, 156, 'Untuk apakah sistem pemanggilan menggunakan titik `namaModul.namaFungsinya()` (Namespace) diciptakan?', [
            ['id' => 'A', 'text' => 'Menambah kecepatan program', 'correct' => false],
            ['id' => 'B', 'text' => 'Mencegah terjadinya bentrok (konflik eksekusi) jika ternyata ada nama fungsi/variabel yang sama kembar', 'correct' => true],
            ['id' => 'C', 'text' => 'Agar programmer terlihat pintar', 'correct' => false],
        ]);

        // 13. Trivia
        $lesson->slides()->firstOrCreate(['order' => 13], ['type' => 'text', 'title' => 'Teamwork Tanpa Marah-Marah', 'content' => "Pemrograman Modular adalah nyawa sebuah Perusahaan Tech!\nSi A disuruh nulis fitur Chat di file `chat.php`. Si B disuruh nulis Grafik di `chart.js`.\nKeduanya tidak akan pernah bertabrakan saat menyimpan kode (Bandingkan jika 1 File besar diedit berdua. Bisa perang!)"]);
        // 14. Quiz (3 pilihan)
        $this->createQuiz($lesson, 157, 'Kesimpulan: Alasan Pemrograman Modular sangat digandrungi di perusahaan profesional?', [
            ['id' => 'A', 'text' => 'Karena komputer modern membenci file tunggal', 'correct' => false],
            ['id' => 'B', 'text' => 'Sangat ideal untuk kerja tim (Collaborative), perbaikan rapi berkelompok, dan kode bisa dipakai berulang (Reuse)', 'correct' => true],
            ['id' => 'C', 'text' => 'Tidak punya alasan khusus', 'correct' => false],
        ]);

        // 15. Minigame: Code Arrange — Rakit Robotmu
        $lesson->slides()->firstOrCreate(['order' => 18], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Import Komponen Siber 🤖',
            'content' => 'Susun instruksi Import agar Robot Utama terakit dengan modul Tangan dan Mata!',
            'options' => [
                ['id' => 0, 'text' => 'IMPORT modul_mata  #(Bagian Awal File)'],
                ['id' => 1, 'text' => 'IMPORT modul_tangan'],
                ['id' => 2, 'text' => 'FUNCTION rakitRobot():'],
                ['id' => 3, 'text' => '  modul_mata.aktifkanMata()'],
                ['id' => 4, 'text' => '  modul_tangan.gerak(10)'],
            ],
            'correct_answer' => null,
            'explanation' => 'Import harus selalu ada di atap kode sebagai "Deklarasi/Pendaftaran" bahwa file ini akan memakai komponen tersebut, barulah dipanggil fungsingnya.',
        ]);

        // 16. Minigame: Fill in the Blank — Mencomot Modul
        $lesson->slides()->firstOrCreate(['order' => 16], [
            'type' => 'code_fillblank',
            'title' => 'Namespace Pemecah Masalah! 🏷️',
            'content' => 'Lengkapi kode ini dengan Namespace (marga) agar program tidak bingung modul mana yang dipanggil!',
            'options' => [
                ['type' => 'text', 'value' => 'IMPORT fisika\nIMPORT kimia\n\n# Kita mau mengambil rumus gaya tarik (Gravitasi dari fisika)\nhasil = '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '.'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '\nPRINT "Berat Bendanya adalah " '],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'fisika', 'color' => 'blue'],
                ['id' => 2, 'text' => 'gayaTarik(10)', 'color' => 'orange'],
                ['id' => 3, 'text' => '+ hasil', 'color' => 'green'],
                ['id' => 4, 'text' => 'kimia', 'color' => 'purple'], // Distractor
            ]),
            'explanation' => 'Bayangkan `fisika` adalah nama marga dan `gayaTarik()` adalah kemampuan/resep nya. Selalu sebutkan asal usulnya pakai Notasi Titik (Dot)!',
        ]);

        // 17. Minigame: Block Code — Susun Lego Arsitektur
        $lesson->slides()->firstOrCreate(['order' => 17], [
            'type' => 'block_code',
            'title' => 'Bata Pembuatan Aplikasi 🧱',
            'content' => 'Ini file "Utama.app". Bangun alur eksekusi Modul Autentikasi terlebih dahulu baru ke Profil.',
            'options' => [
                ['id' => 1, 'type' => 'action', 'text' => 'IMPORT modulLogin'],
                ['id' => 2, 'type' => 'action', 'text' => 'IMPORT modulProfil'],
                ['id' => 3, 'type' => 'logic', 'text' => 'JIKA modulLogin.cekSandi("admin"):'],
                ['id' => 4, 'type' => 'action', 'text' => '  modulProfil.tampilkanTampilan()'],
                ['id' => 5, 'type' => 'loop', 'text' => 'ULANGI FOR'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Sebuah Aplikasi Besar bekerja dengan cara Import modul dulu di header, lalu menggunakan logic Login sebelum memanggil UI Profil!',
        ]);
    }
}
