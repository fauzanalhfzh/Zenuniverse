<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;
use Database\Seeders\Traits\CreatesQuiz;

class WebProgrammingLessonSeeder extends Seeder
{
    use CreatesQuiz;

    public function run(): void
    {
        $course = Course::where('title', 'Dasar Pemrograman Web')->first();
        if (!$course) return;

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
}
