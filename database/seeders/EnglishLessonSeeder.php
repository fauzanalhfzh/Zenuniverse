<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CreatesQuiz;

class EnglishLessonSeeder extends Seeder
{
    use CreatesQuiz;

    public function run(): void
    {
        $course = Course::where('title', 'Bahasa Inggris untuk Programmer')->first();
        if (!$course) return;

        $this->createEnglishLesson1($course);
        $this->createEnglishLesson2($course);
        $this->createEnglishLesson3($course);
        $this->createEnglishLesson4($course);
        $this->createEnglishLesson5($course);
    }

    private function createEnglishLesson1($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'basic-tech-vocab'],
            [
                'course_id' => $course->id, 'title' => 'Basic Tech Vocabulary',
                'content' => 'Kosakata wajib sehari-hari software engineer.', 'video_url' => null, 'order' => 1, 'xp_reward' => 50,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Bug & Debugging', 'content' => "Dalam programming, kesalahan atau cacat pada kode disebut **Bug** (serangga).\nProses mencari dan memperbaiki bug tersebut dinamakan **Debugging**."]);
        $this->createQuiz($lesson, 2, 'Apa istilah untuk proses memperbaiki error di dalam kode?', [['id' => 'A', 'text' => 'Deploying', 'correct' => false], ['id' => 'B', 'text' => 'Debugging', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Deploy & Repository', 'content' => "**Deploy** artinya mempublikasikan kode kita agar bisa diakses pengguna di internet.\n**Repository** (repo) adalah tempat atau gudang penyimpanan kode sumber (source code) kita, seperti di GitHub."]);
        $this->createQuiz($lesson, 4, 'Apa sebutan untuk tempat penyimpanan kode sumber kita secara online?', [['id' => 'A', 'text' => 'Repository', 'correct' => true], ['id' => 'B', 'text' => 'Browser', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Siklus Developer 🔄',
            'content' => 'Susun tahapan kerja developer ini dari awal hingga akhir.',
            'options' => [
                ['id' => 1, 'text' => 'Write Code (Menulis kode)'],
                ['id' => 2, 'text' => 'Find Bugs (Menemukan bug)'],
                ['id' => 3, 'text' => 'Debugging (Memperbaiki kode)'],
                ['id' => 4, 'text' => 'Deploy (Publikasi)'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Tulis kode -> Temukan error -> Perbaiki -> Publikasikan!',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Istilah Harian 🗣️',
            'content' => 'Lengkapi percakapan singkat antar developer ini.',
            'options' => [
                ['type' => 'text', 'value' => 'A: "Aku sudah selesai menulis fitur ini."\nB: "Bagus, tolong masukkan ke dalam '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' GitHub kita ya."\nA: "Oke, tapi masih ada sedikit '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' jadi aku harus '],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ' dulu."'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Repository', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Bug', 'color' => 'orange'],
                ['id' => 3, 'text' => 'Debug', 'color' => 'green'],
            ]),
            'explanation' => 'Repository adalah tempat simpan, Bug adalah masalah, Debug adalah solusinya.',
        ]);
    }

    private function createEnglishLesson2($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'ui-ux-terminology'],
            [
                'course_id' => $course->id, 'title' => 'UI/UX Terminology',
                'content' => 'Bahasa desain antarmuka.', 'video_url' => null, 'order' => 2, 'xp_reward' => 55,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Header & Footer', 'content' => "**Header** adalah bagian atas halaman web (biasanya berisi logo dan menu).\n**Footer** adalah bagian paling bawah (biasanya berisi copyright dan link kontak)."]);
        $this->createQuiz($lesson, 2, 'Di mana biasanya letak menu utama dan logo website?', [['id' => 'A', 'text' => 'Footer', 'correct' => false], ['id' => 'B', 'text' => 'Header', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Interaksi Elemen', 'content' => "**Hover**: Saat kursor mouse diarahkan ke atas suatu elemen (tapi belum diklik).\n**Dropdown**: Menu yang jatuh/terbuka ke bawah saat diklik.\n**Toggle**: Tombol saklar (seperti mode on/off atau Dark Mode)."]);
        $this->createQuiz($lesson, 4, 'Efek apa yang terjadi HANYA ketika kursor mouse menempel di atas elemen?', [['id' => 'A', 'text' => 'Toggle', 'correct' => false], ['id' => 'B', 'text' => 'Hover', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Struktur Website 🏗️',
            'content' => 'Susun elemen UI ini dari urutan paling atas halaman hingga paling bawah.',
            'options' => [
                ['id' => 1, 'text' => 'Header (Logo & Navigation)'],
                ['id' => 2, 'text' => 'Hero Section (Banner Utama)'],
                ['id' => 3, 'text' => 'Main Content (Isi Artikel)'],
                ['id' => 4, 'text' => 'Footer (Copyright)'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Header selalu di atas, Hero ada di bawah Header, dilanjut konten, dan ditutup oleh Footer.',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Tombol Saklar 🔘',
            'content' => 'Pilih istilah UI yang tepat.',
            'options' => [
                ['type' => 'text', 'value' => 'Untuk mengubah dari mode siang ke malam, pengguna harus menekan tombol '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '.\nJika tombol disentuh mouse ('],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ') warnanya akan berubah menjadi abu-abu.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Toggle', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Hover', 'color' => 'orange'],
            ]),
            'explanation' => 'Toggle untuk saklar ON/OFF. Hover untuk aksi mengarahkan mouse.',
        ]);
    }

    private function createEnglishLesson3($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'reading-errors'],
            [
                'course_id' => $course->id, 'title' => 'Membaca Pesan Error',
                'content' => 'Jangan panik saat melihat teks merah!', 'video_url' => null, 'order' => 3, 'xp_reward' => 60,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Unexpected Token', 'content' => "Error `Unexpected token` artinya ada karakter atau simbol yang muncul di tempat yang tidak semestinya.\nMisal: Kurang titik koma, salah ketik kurung kurawal, atau typo di sintaks dasar."]);
        $this->createQuiz($lesson, 2, 'Pesan error apa yang muncul jika kamu kelebihan atau lupa mengetik kurung kurawal?', [['id' => 'A', 'text' => 'Unexpected token', 'correct' => true], ['id' => 'B', 'text' => 'Not found', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Undefined & Null', 'content' => "`Undefined` berarti sebuah variabel sudah dibuat, namun belum ada nilainya sama sekali (tidak terdefinisi).\nSedangkan `Null` adalah nilai kosong yang memang SENGAJA disetel oleh programmer."]);
        $this->createQuiz($lesson, 4, 'Variabel yang dibuat tapi lupa diisi nilai secara otomatis akan bertipe apa?', [['id' => 'A', 'text' => 'Null', 'correct' => false], ['id' => 'B', 'text' => 'Undefined', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Detektif Error 🕵️',
            'content' => 'Susun arti error ini dengan penyebab utamanya.',
            'options' => [
                ['id' => 1, 'text' => 'Unexpected token = Salah simbol/typo.'],
                ['id' => 2, 'text' => 'Undefined = Lupa mengisi nilai.'],
                ['id' => 3, 'text' => 'Not Found (404) = File tidak ada.'],
            ],
            'correct_answer' => null,
            'explanation' => 'Memahami tipe error akan mempercepat proses debugging.',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Pesan Merah 🚨',
            'content' => 'Isi titik-titik dengan tipe pesan error yang tepat.',
            'options' => [
                ['type' => 'text', 'value' => 'Jika kamu lupa mengetik titik koma, sistem akan memberi error '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => '.\nJika kamu memanggil variabel yang kosong, hasilnya '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => '.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Unexpected', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Undefined', 'color' => 'orange'],
            ]),
            'explanation' => 'Sintaks salah = Unexpected. Nilai tidak ada = Undefined.',
        ]);
    }

    private function createEnglishLesson4($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'action-verbs'],
            [
                'course_id' => $course->id, 'title' => 'Action Verbs for Programming',
                'content' => 'Kata kerja perintah yang sering digunakan.', 'video_url' => null, 'order' => 4, 'xp_reward' => 65,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Fetch & Execute', 'content' => "**Fetch** artinya mengambil (biasanya mengambil data dari server atau API).\n**Execute** artinya menjalankan (menjalankan sebuah perintah, script, atau program)."]);
        $this->createQuiz($lesson, 2, 'Kata kerja apa yang digunakan saat sebuah program meminta data ke server lain?', [['id' => 'A', 'text' => 'Fetch', 'correct' => true], ['id' => 'B', 'text' => 'Compile', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Compile & Parse', 'content' => "**Compile** adalah menerjemahkan kode bahasa manusia ke bahasa mesin yang dimengerti komputer.\n**Parse** adalah membaca sebuah data (seperti JSON/teks) lalu mengubahnya menjadi format yang bisa diolah variabel."]);
        $this->createQuiz($lesson, 4, 'Istilah penerjemahan bahasa pemrograman menjadi bahasa komputer disebut?', [['id' => 'A', 'text' => 'Execute', 'correct' => false], ['id' => 'B', 'text' => 'Compile', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Siklus Data 🔄',
            'content' => 'Susun tahapan komputer mengambil dan memproses data.',
            'options' => [
                ['id' => 1, 'text' => 'Fetch (Ambil data dari server)'],
                ['id' => 2, 'text' => 'Parse (Terjemahkan data JSON)'],
                ['id' => 3, 'text' => 'Execute (Jalankan fungsi untuk menampilkan)'],
            ],
            'correct_answer' => '1,2,3',
            'explanation' => 'Ambil dulu (Fetch), ubah formatnya (Parse), baru jalankan (Execute).',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Instruksi Komputer 💻',
            'content' => 'Lengkapi istilah perintah di bawah ini.',
            'options' => [
                ['type' => 'text', 'value' => 'Tolong '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' data ini dari server, lalu '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' ke variabel array.'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Fetch', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Parse', 'color' => 'orange'],
            ]),
            'explanation' => 'Fetch untuk mengambil, Parse untuk menerjemahkan format.',
        ]);
    }

    private function createEnglishLesson5($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'git-commits'],
            [
                'course_id' => $course->id, 'title' => 'Writing Good Commits',
                'content' => 'Cara profesional melaporkan perubahan kodemu.', 'video_url' => null, 'order' => 5, 'xp_reward' => 70,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Fix & Add', 'content' => "Gunakan **Fix:** ketika kamu memperbaiki error/bug. (Contoh: `Fix: login crash on mobile`)\nGunakan **Add:** ketika kamu menambahkan fitur baru. (Contoh: `Add: dark mode toggle`)"]);
        $this->createQuiz($lesson, 2, 'Kata apa yang harus mengawali pesan commit saat kamu baru saja membenahi sebuah error?', [['id' => 'A', 'text' => 'Update:', 'correct' => false], ['id' => 'B', 'text' => 'Fix:', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Update & Refactor', 'content' => "Gunakan **Update:** saat memperbarui versi library atau teks kecil. (Contoh: `Update: logo to new version`)\nGunakan **Refactor:** saat merapikan kode TANPA mengubah fiturnya. (Contoh: `Refactor: clean up user controller`)"]);
        $this->createQuiz($lesson, 4, 'Jika kamu menyederhanakan kode agar lebih rapi tanpa mengubah fungsinya, gunakan kata?', [['id' => 'A', 'text' => 'Add:', 'correct' => false], ['id' => 'B', 'text' => 'Refactor:', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Sejarah Commit 📜',
            'content' => 'Susun urutan log commit ini dari awal membuat fitur sampai memperbaiki masalahnya.',
            'options' => [
                ['id' => 1, 'text' => 'Add: login page UI'],
                ['id' => 2, 'text' => 'Update: change button color to blue'],
                ['id' => 3, 'text' => 'Fix: button not clickable on mobile'],
                ['id' => 4, 'text' => 'Refactor: clean up CSS classes'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Tambah (Add) -> Perbarui warna (Update) -> Ada bug lalu perbaiki (Fix) -> Rapikan kodenya (Refactor).',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Log Harian Developer 📝',
            'content' => 'Lengkapi awalan pesan commit ini.',
            'options' => [
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ': typo on about page\n'],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ': payment gateway feature\n'],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ': change variable names for readability'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Fix', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Add', 'color' => 'orange'],
                ['id' => 3, 'text' => 'Refactor', 'color' => 'green'],
            ]),
            'explanation' => 'Fix untuk typo/bug, Add untuk fitur baru, Refactor untuk merapikan nama variabel.',
        ]);
    }
}
