<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CreatesQuiz;

class SqlLessonSeeder extends Seeder
{
    use CreatesQuiz;

    public function run(): void
    {
        $course = Course::where('title', 'Database & SQL')->first();
        if (!$course) return;

        $this->createSqlLesson1($course);
        $this->createSqlLesson2($course);
        $this->createSqlLesson3($course);
        $this->createSqlLesson4($course);
        $this->createSqlLesson5($course);
    }

    private function createSqlLesson1($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'pengenalan-database'],
            [
                'course_id' => $course->id, 'title' => 'Pengenalan Database Relasional',
                'content' => 'Tempat penyimpanan rahasia para programmer.', 'video_url' => null, 'order' => 1, 'xp_reward' => 50,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Apa itu Database?', 'content' => "Database adalah tempat terstruktur untuk menyimpan data. Bayangkan seperti aplikasi Excel raksasa yang tidak pernah ngelag!\nSetiap data disimpan di dalam **Tabel**, yang memiliki **Kolom** (Atribut) dan **Baris** (Data)."]);
        $this->createQuiz($lesson, 2, 'Apa padanan terdekat dari sebuah Tabel Database di kehidupan nyata?', [['id' => 'A', 'text' => 'Lembar kerja Excel', 'correct' => true], ['id' => 'B', 'text' => 'Buku gambar kosong', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'SQL', 'content' => "Untuk berkomunikasi dengan Database, kita memakai bahasa khusus bernama **SQL** (Structured Query Language).\nDengan SQL kita bisa membaca, menambah, mengubah, dan menghapus data (CRUD)."]);
        $this->createQuiz($lesson, 4, 'Singkatan dari apakah SQL?', [['id' => 'A', 'text' => 'Structured Query Language', 'correct' => true], ['id' => 'B', 'text' => 'System Quick Logic', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Hierarki Data 🏢',
            'content' => 'Susun urutan hierarki database dari yang terbesar hingga terkecil.',
            'options' => [
                ['id' => 1, 'text' => 'Server Database'],
                ['id' => 2, 'text' => 'Nama Database (contoh: toko_online)'],
                ['id' => 3, 'text' => 'Nama Tabel (contoh: users)'],
                ['id' => 4, 'text' => 'Kolom & Baris'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Server memiliki banyak Database. Database memiliki banyak Tabel. Tabel berisi Kolom dan Baris.',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Sistem CRUD ⚙️',
            'content' => 'Lengkapi istilah operasi dasar database.',
            'options' => [
                ['type' => 'text', 'value' => 'C : Create (Membuat)\nR : Read (Membaca)\nU : '],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' (Mengubah)\nD : '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' (Menghapus)'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'Update', 'color' => 'blue'],
                ['id' => 2, 'text' => 'Delete', 'color' => 'orange'],
            ]),
            'explanation' => 'CRUD (Create, Read, Update, Delete) adalah 4 operasi wajib yang ada di sistem database mana pun.',
        ]);
    }

    private function createSqlLesson2($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'select-from-sql'],
            [
                'course_id' => $course->id, 'title' => 'SELECT & FROM',
                'content' => 'Membaca dan mengambil data.', 'video_url' => null, 'order' => 2, 'xp_reward' => 55,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Sintaks Dasar', 'content' => "Sintaks dasar SQL untuk membaca data:\n`SELECT kolom FROM tabel;`\nContoh jika ingin mengambil nama dari tabel user:\n`SELECT nama FROM users;`"]);
        $this->createQuiz($lesson, 2, 'Perintah apa yang digunakan untuk membaca/mengambil data dari database?', [['id' => 'A', 'text' => 'SELECT', 'correct' => true], ['id' => 'B', 'text' => 'READ', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Simbol Bintang (*)', 'content' => "Gunakan simbol bintang (`*`) jika ingin mengambil **SEMUA** kolom dari sebuah tabel, tanpa perlu mengetikkan namanya satu per satu.\n`SELECT * FROM users;`"]);
        $this->createQuiz($lesson, 4, 'Apa arti dari simbol * dalam SQL?', [['id' => 'A', 'text' => 'Semua kolom', 'correct' => true], ['id' => 'B', 'text' => 'Kolom rahasia', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Ambil Data 🛒',
            'content' => 'Susun kode SQL ini untuk mengambil nama dan harga dari tabel produk.',
            'options' => [
                ['id' => 1, 'text' => 'SELECT'],
                ['id' => 2, 'text' => 'nama, harga'],
                ['id' => 3, 'text' => 'FROM'],
                ['id' => 4, 'text' => 'produk;'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Pilih kolomnya dulu (SELECT nama, harga), lalu tentukan sumber tabelnya (FROM produk).',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Sapu Bersih! 🧹',
            'content' => 'Lengkapi query untuk mengambil SELURUH kolom dari tabel users.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' FROM users;'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'SELECT', 'color' => 'blue'],
                ['id' => 2, 'text' => '*', 'color' => 'orange'],
            ]),
            'explanation' => 'SELECT * mengambil seluruh kolom tanpa terkecuali.',
        ]);
    }

    private function createSqlLesson3($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'where-and-or'],
            [
                'course_id' => $course->id, 'title' => 'Penyaringan Data (WHERE)',
                'content' => 'Memfilter data agar tidak tumpah.', 'video_url' => null, 'order' => 3, 'xp_reward' => 60,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Klausa WHERE', 'content' => "Untuk memfilter data, gunakan klausa `WHERE`.\n`SELECT * FROM users WHERE umur = 20;`\nQuery ini hanya akan memunculkan user yang umurnya persis 20!"]);
        $this->createQuiz($lesson, 2, 'Klausa apa yang digunakan untuk mem-filter data yang diambil?', [['id' => 'A', 'text' => 'WHERE', 'correct' => true], ['id' => 'B', 'text' => 'FILTER', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'AND dan OR', 'content' => "Kamu bisa menggabungkan banyak kondisi.\n`AND`: Semua kondisi wajib benar.\n`OR`: Salah satu kondisi benar sudah cukup.\n`SELECT * FROM mobil WHERE warna = 'merah' AND harga < 100;`"]);
        $this->createQuiz($lesson, 4, 'Operator apa yang mengharuskan SEMUA kondisi terpenuhi?', [['id' => 'A', 'text' => 'OR', 'correct' => false], ['id' => 'B', 'text' => 'AND', 'correct' => true]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Cari Buronan 👮',
            'content' => 'Susun query untuk mencari user bernama "Budi" yang berumur di atas 18 tahun.',
            'options' => [
                ['id' => 1, 'text' => 'SELECT * FROM users'],
                ['id' => 2, 'text' => 'WHERE nama = "Budi"'],
                ['id' => 3, 'text' => 'AND'],
                ['id' => 4, 'text' => 'umur > 18;'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Kita pasang kondisi pertama, sambung dengan AND, dan ikuti dengan kondisi kedua.',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Pencarian Spesifik 🎯',
            'content' => 'Lengkapi query untuk mencari handphone samsung atau xiaomi.',
            'options' => [
                ['type' => 'text', 'value' => 'SELECT * FROM produk\n'],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' merk = "samsung" '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' merk = "xiaomi";'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'WHERE', 'color' => 'blue'],
                ['id' => 2, 'text' => 'OR', 'color' => 'orange'],
            ]),
            'explanation' => 'Kita pakai OR karena merk produk tidak mungkin sekaligus samsung dan xiaomi bersamaan.',
        ]);
    }

    private function createSqlLesson4($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'order-by-limit'],
            [
                'course_id' => $course->id, 'title' => 'ORDER BY & LIMIT',
                'content' => 'Mengurutkan dan membatasi data.', 'video_url' => null, 'order' => 4, 'xp_reward' => 65,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Mengurutkan Data', 'content' => "Gunakan `ORDER BY nama_kolom` untuk mengurutkan.\nTambahkan `ASC` (Ascending) dari kecil ke besar/A-Z.\nTambahkan `DESC` (Descending) dari besar ke kecil/Z-A.\n`ORDER BY harga DESC` (mengurutkan harga termahal)."]);
        $this->createQuiz($lesson, 2, 'Keyword apa yang membuat urutan dari Terbesar ke Terkecil?', [['id' => 'A', 'text' => 'DESC', 'correct' => true], ['id' => 'B', 'text' => 'ASC', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Limit Data', 'content' => "Agar server tidak meledak mengambil jutaan data, kita bisa membatasinya dengan `LIMIT`.\n`SELECT * FROM tabel LIMIT 5;` (Hanya ambil 5 data pertama)."]);
        $this->createQuiz($lesson, 4, 'Keyword apa yang digunakan untuk membatasi jumlah data yang diambil?', [['id' => 'A', 'text' => 'LIMIT', 'correct' => true], ['id' => 'B', 'text' => 'MAX', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Top 3 🏆',
            'content' => 'Susun query untuk mengambil 3 siswa dengan nilai tertinggi.',
            'options' => [
                ['id' => 1, 'text' => 'SELECT * FROM siswa'],
                ['id' => 2, 'text' => 'ORDER BY nilai'],
                ['id' => 3, 'text' => 'DESC'],
                ['id' => 4, 'text' => 'LIMIT 3;'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Kita urutkan nilai secara Descending (tertinggi ke terendah) lalu potong hanya mengambil 3 baris teratas.',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Urutan Abjad 🔠',
            'content' => 'Lengkapi query untuk mengurutkan nama A-Z.',
            'options' => [
                ['type' => 'text', 'value' => 'SELECT * FROM users\n'],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' nama '],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ';'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'ORDER', 'color' => 'blue'],
                ['id' => 2, 'text' => 'BY', 'color' => 'orange'],
                ['id' => 3, 'text' => 'ASC', 'color' => 'green'],
            ]),
            'explanation' => 'ORDER BY selalu dipasangkan, dan ASC digunakan untuk urutan ascending (A-Z).',
        ]);
    }

    private function createSqlLesson5($course)
    {
        $lesson = Lesson::firstOrCreate(
            ['slug' => 'insert-update-delete'],
            [
                'course_id' => $course->id, 'title' => 'INSERT, UPDATE, DELETE',
                'content' => 'Merubah isi database secara permanen.', 'video_url' => null, 'order' => 5, 'xp_reward' => 70,
            ]);

        $lesson->slides()->firstOrCreate(['order' => 1], ['type' => 'text', 'title' => 'Insert Data', 'content' => "Sintaks menambah data baru:\n`INSERT INTO nama_tabel (kolom1, kolom2) VALUES (nilai1, nilai2);`\nContoh: `INSERT INTO users (nama, umur) VALUES ('Joko', 20);`"]);
        $this->createQuiz($lesson, 2, 'Kata kunci apa yang menemani INSERT INTO untuk mendefinisikan datanya?', [['id' => 'A', 'text' => 'VALUES', 'correct' => true], ['id' => 'B', 'text' => 'DATA', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 3], ['type' => 'text', 'title' => 'Update & Delete', 'content' => "**PENTING:** Selalu gunakan klausa `WHERE` saat UPDATE/DELETE!\nJika lupa `WHERE`, SEMUA DATA di tabel akan berubah atau terhapus!\n`UPDATE users SET umur = 21 WHERE id = 1;`\n`DELETE FROM users WHERE id = 1;`"]);
        $this->createQuiz($lesson, 4, 'Apa yang terjadi jika kamu menjalankan DELETE FROM users; tanpa WHERE?', [['id' => 'A', 'text' => 'Semua user akan terhapus', 'correct' => true], ['id' => 'B', 'text' => 'Akan error dan dicegah', 'correct' => false]]);

        $lesson->slides()->firstOrCreate(['order' => 5], [
            'type' => 'code_arrange',
            'title' => 'Puzzle: Promo Diskon 💸',
            'content' => 'Susun kode ini untuk mengubah harga barang menjadi 500.',
            'options' => [
                ['id' => 1, 'text' => 'UPDATE produk'],
                ['id' => 2, 'text' => 'SET harga = 500'],
                ['id' => 3, 'text' => 'WHERE'],
                ['id' => 4, 'text' => 'id = 10;'],
            ],
            'correct_answer' => '1,2,3,4',
            'explanation' => 'Jangan lupa WHERE! UPDATE tabel SET kolom = nilai WHERE target.',
        ]);

        $lesson->slides()->firstOrCreate(['order' => 6], [
            'type' => 'code_fillblank',
            'title' => 'Buang Sampah 🗑️',
            'content' => 'Lengkapi query untuk menghapus pesanan yang dibatalkan.',
            'options' => [
                ['type' => 'text', 'value' => ''],
                ['type' => 'blank', 'id' => 0, 'answer_id' => 1],
                ['type' => 'text', 'value' => ' '],
                ['type' => 'blank', 'id' => 1, 'answer_id' => 2],
                ['type' => 'text', 'value' => ' pesanan\n'],
                ['type' => 'blank', 'id' => 2, 'answer_id' => 3],
                ['type' => 'text', 'value' => ' status = "dibatalkan";'],
            ],
            'correct_answer' => json_encode([
                ['id' => 1, 'text' => 'DELETE', 'color' => 'blue'],
                ['id' => 2, 'text' => 'FROM', 'color' => 'orange'],
                ['id' => 3, 'text' => 'WHERE', 'color' => 'green'],
            ]),
            'explanation' => 'DELETE FROM menghapus baris, WHERE menjaga agar hanya yang statusnya "dibatalkan" saja yang terhapus.',
        ]);
    }
}
