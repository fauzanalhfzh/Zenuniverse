<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Database\Seeder;

class MathLessonSeeder extends Seeder
{
    public function run(): void
    {
        $course = Course::where('title', 'Matematika Dasar')->first();
        if (!$course) return;

        $this->createMathLessons($course);
    }

    private function createMathLessons($course)
    {
        $adventures = [
            [
                'title' => 'Kebun Apel Kakek',
                'story' => 'Hari ini kita membantu Kakek memanen apel merah yang manis di kebun.',
                'trivias' => [
                    'Di pohon pertama, kita menemukan 1 apel besar yang bersinar di bawah matahari!',
                    'Kakek menunjuk dahan lain, oh lihat! Ada 2 apel kembar yang saling berdempetan.',
                    'Angka 3 seperti sayap burung. Kita menemukan 3 apel bersembunyi di balik daun.',
                    'Keranjang kita mulai terisi. 4 apel merah siap dibawa pulang untuk dibuat pai!',
                    'Hore! Kita melengkapi keranjang dengan 5 apel. Angka 5 seperti kail pancing yang melengkung.',
                ],
                'quizzes' => [
                    ['q' => 'Berapa apel yang pertama kali kita temukan di pohon?', 'options' => ['1 apel' => true, '3 apel' => false, '5 apel' => false]],
                    ['q' => 'Dua apel yang saling berdempetan disebut apel apa kata Kakek?', 'options' => ['Apel Raksasa' => false, 'Apel Kembar' => true, 'Apel Jatuh' => false]],
                    ['q' => 'Bentuk angka apa yang mirip dengan sayap burung terbang?', 'options' => ['Angka 1' => false, 'Angka 5' => false, 'Angka 3' => true]],
                    ['q' => 'Setelah ada 3 apel, kakek menambah 1 lagi. Jadi berapa?', 'options' => ['4 apel' => true, '2 apel' => false, '5 apel' => false]],
                    ['q' => 'Berapa total apel di dalam keranjang pai kita?', 'options' => ['10 apel' => false, '5 apel' => true, '3 apel' => false]],
                ],
            ],
            [
                'title' => 'Misi Penyelamatan Bintang',
                'story' => 'Malam ini, ada bintang-bintang kecil yang jatuh dari langit. Misi kita adalah mengumpulkannya!',
                'trivias' => [
                    'Bintang pertama hingga kelima sudah aman. Wah, lihat ada 1 bintang lagi! Sekarang kita punya 6 bintang.',
                    'Angka 7 seperti tongkat kakek sihir. Kita menggunakan tongkat untuk meraih bintang ke-7.',
                    'Dua lingkaran bersusun membentuk angka 8. Kita menemukan 8 bintang membentuk rasi salju.',
                    '9 adalah angka ajaib sebelum sepuluh! Bintang ke-9 bersembunyi di balik awan tebal.',
                    'Hebat Kapten! Kita mengumpulkan 10 bintang bercahaya. 10 adalah 1 dan 0 yang bergandengan!',
                ],
                'quizzes' => [
                    ['q' => 'Berapa bintang yang kita punya setelah menambah 1 pada 5 bintang awal?', 'options' => ['6 Bintang' => true, '7 Bintang' => false, '10 Bintang' => false]],
                    ['q' => 'Angka berapa yang bentuknya seperti tongkat kakek sihir?', 'options' => ['Angka 9' => false, 'Angka 7' => true, 'Angka 6' => false]],
                    ['q' => 'Jika kita punya 7 bintang laut dan menemukan 1 lagi, totalnya menjadi?', 'options' => ['9 bintang' => false, '8 bintang' => true, '10 bintang' => false]],
                    ['q' => 'Di mana bintang ke-9 bersembunyi?', 'options' => ['Di dalam air' => false, 'Di balik bulan' => false, 'Di balik awan tebal' => true]],
                    ['q' => 'Terdiri dari angka berapakah bilangan 10?', 'options' => ['1 dan 0' => true, '1 dan 1' => false, '0 dan 1' => false]],
                ],
            ],
            [
                'title' => 'Toko Permen Manis',
                'story' => 'Selamat datang di Toko Permen! Di sini kita akan belajar menjumlahkan permen-permen lezat.',
                'trivias' => [
                    'Paman Beruang punya 2 permen loli merah bata, lalu Bibi Kelinci memberinya 1 permen biru. Totalnya 3 permen!',
                    'Penjumlahan itu bertambah banyak. Tanda tambah (+) bentuknya seperti palang pintu menyilangkan tangan.',
                    'Jika kita punya 3 permen karet muda dan membeli 2 permen coklat, sekarang kantong kita isinya 5 permen.',
                    'Lihat toples itu! Ada 4 permen kapas di kiri dan 4 permen jahe di kanan. Jika disatukan menjadi 8 permen.',
                    'Jika kita punya 5 marshmallow dan ditambahkan 5 bungkus misis, total menjadi 10! Angka yang sangat sempurna.',
                ],
                'quizzes' => [
                    ['q' => 'Berapa hasil dari 2 permen ditambah 1 permen?', 'options' => ['4 permen' => false, '3 permen' => true, '5 permen' => false]],
                    ['q' => 'Seperti apakah bentuk tanda (+)?', 'options' => ['Garis miring' => false, 'Lingkaran penuh' => false, 'Palang yang menyilang' => true]],
                    ['q' => '3 permen karet + 2 permen coklat = ...?', 'options' => ['5 permen' => true, '6 permen' => false, '4 permen' => false]],
                    ['q' => '4 permen kapas + 4 permen jahe = ...?', 'options' => ['9 permen' => false, '8 permen' => true, '10 permen' => false]],
                    ['q' => 'Berapa jumlah dari 5 + 5?', 'options' => ['10' => true, '9' => false, '15' => false]],
                ],
            ],
            [
                'title' => 'Balon Udara yang Bocor',
                'story' => 'Oh tidak! Balon udara kita kelebihan beban dan beberapa karung pasir harus dibuang ke bawah.',
                'trivias' => [
                    'Pengurangan artinya mengurangi jumlah. Tandanya adalah strip (-) seperti tali tipis panjang.',
                    'Kita membawa 5 karung pasir. Jika 1 karung dibuang, maka balon menjadi ringan dan sisa karung adalah 4.',
                    'Tiba-tiba tiupan angin mematahkan 2 dari 4 tali tiang layar kita. Kini layar hanya diikat oleh 2 tali saja.',
                    'Ada 7 burung camar hinggap di balon. Karena kaget mendengarkan terompet, 3 ekor terbang jauh. Tersisa 4 camar.',
                    'Pengurangan dengan bilangan yang sama akan menghasilkan 0 (NOL). Berarti habis tak tersisa!',
                ],
                'quizzes' => [
                    ['q' => 'Apa lambang dari pengurangan?', 'options' => ['Silang (X)' => false, 'Strip (-)' => true, 'Titik dua (:)' => false]],
                    ['q' => '5 karung dikurang 1 karung hasilnya berapa?', 'options' => ['4 karung' => true, '3 karung' => false, '5 karung' => false]],
                    ['q' => '4 tali layar putus 2, sisa berapa tali yang menahan?', 'options' => ['1 tali' => false, '3 tali' => false, '2 tali' => true]],
                    ['q' => '7 ekor burung camar dikurangi 3 ekor yang terbang sisa berapa?', 'options' => ['4 ekor' => true, '5 ekor' => false, '2 ekor' => false]],
                    ['q' => 'Apa hasil dari perhitungan 5 dikurangi 5 ?', 'options' => ['10' => false, '5' => false, '0' => true]],
                ],
            ],
            [
                'title' => 'Buru Harta Karun Laut',
                'story' => 'Menyelam ke samudra dalam untuk mengumpulkan koin emas peninggalan bajak laut legendaris!',
                'trivias' => [
                    'Setelah 10 adalah belasan! 10 koin emas ditambah 1 koin perak menjadi 11 koin yang berkelip.',
                    'Angka belasan diawali angka 1. Contoh, 10 + 4 = 14 kerang mutiara purba. 14 dinamakan empat belas.',
                    'Kita bertemu 15 kuda laut kecil berbaris-baris. 15 terdiri dari angka 1 dan 5 bersandingan.',
                    'Gurita raksasa menjaga 18 berlian! Wah, 18 adalah jumlah yang besar, delapan belas buah.',
                    'Dua puluhan! Jika kita punya 10 kepiting dan 10 kerang, total kawan laut kita adalah 20 ekor.',
                ],
                'quizzes' => [
                    ['q' => '10 koin emas + 1 koin perak menjadi angka berapa?', 'options' => ['12' => false, '11' => true, '10' => false]],
                    ['q' => 'Bagaimana kita menyebut angka 14?', 'options' => ['Dua Belas' => false, 'Empat Belas' => true, 'Satu Empat' => false]],
                    ['q' => 'Terdiri dari angka apa saja bilangan 15?', 'options' => ['1 dan 5' => true, '5 dan 0' => false, '1 dan 4' => false]],
                    ['q' => 'Berapa jumlah berlian yang dijaga si gurita raksasa?', 'options' => ['18 buah' => true, '19 buah' => false, '20 buah' => false]],
                    ['q' => 'Jika kita memiliki 10 puluhan ditambah 10 puluhan, hasilnya?', 'options' => ['20' => true, '30' => false, '100' => false]],
                ],
            ],
            [
                'title' => 'Peternakan Ayam Ceria',
                'story' => 'Ayam-ayam di peternakan baru saja bertelur. Ayo bantu Paman Peternak menghitungnya!',
                'trivias' => [
                    'Ayam Jago Putih punya 10 telur, lalu Ayam Betina Coklat menetaskan 5 telur lagi. Totalnya 15!',
                    'Menghitung belasan gampang! Simpan angka di otak dan pakai jari. 12 + 3, ucapkan 12, lalu hitung jari 13, 14, 15.',
                    'Di keranjang kiri ada 8 telur, di keranjang kanan 8 telur. Hasilnya 16! Ini namanya penjumlahan ganda.',
                    'Wah, seekor induk menemukan 11 telur emas, temannya memberi 6 telur perak. Totalnya 17 butir.',
                    'Tahukah kapten? 10 telur bebek + 10 telur angsa berarti peternakan menetas secara berlimpah, 20 anak unggas!',
                ],
                'quizzes' => [
                    ['q' => '10 telur putih + 5 telur coklat sama dengan?', 'options' => ['15' => true, '16' => false, '14' => false]],
                    ['q' => 'Trik menjumlahkan 12 + 3 adalah?', 'options' => ['Hitung terus dengan jari dari 12' => true, 'Menghitung dari 1' => false, 'Menebak' => false]],
                    ['q' => 'Jika 8 ditambah 8, hasilnya menjadi bilangan penjumlahan ganda yaitu?', 'options' => ['15' => false, '16' => true, '18' => false]],
                    ['q' => 'Berapakah 11 telur emas ditambah 6 telur perak?', 'options' => ['17' => true, '16' => false, '18' => false]],
                    ['q' => '10 anak bebek ditambah 10 anak angsa menghasilkan berapa anak unggas?', 'options' => ['25' => false, '15' => false, '20' => true]],
                ],
            ],
            [
                'title' => 'Pesta Makan Es Krim',
                'story' => 'Waktunya pesta es krim! Sayangnya es krim cepat meleleh karena matahari.',
                'trivias' => [
                    'Kita punya 15 es krim vanila. Jika 3 meleleh tumpah ke tanah, sisa es krim adalah 12.',
                    'Ada 18 mangkuk sundae. Teman-teman mengambil 8 mangkuk. Tinggal 10 mangkuk yang utuh!',
                    'Pengurangan angka belasan bisa dilakukan dengan mundur. Seperti 14 mundur 2 langkah (13, 12).',
                    'Paman Pinguin menjaga 20 balok es batu mini. Namun 5 telah mencair. Balok es tersisa 15.',
                    'Pengurangan itu mengurangi jumlah aslimu. Semakin banyak dikurangi, angkanya semakin kecil!',
                ],
                'quizzes' => [
                    ['q' => '15 es krim vanila dikurang 3 yang leleh, hasilnya?', 'options' => ['12 es krim' => true, '11 es krim' => false, '10 es krim' => false]],
                    ['q' => '18 sundae dikurangi 8 yang diambil teman. Sisanya?', 'options' => ['10' => true, '8' => false, '12' => false]],
                    ['q' => 'Bagaimana cara mudah mengurangkan angka kecil dari belasan?', 'options' => ['Hitung mundur pada garis bilangan' => true, 'Menambahkan' => false, 'Hilangkan puluhan' => false]],
                    ['q' => '20 balok es batu dikurangi 5 yang cair menyisakan?', 'options' => ['15 balok' => true, '25 balok' => false, '10 balok' => false]],
                    ['q' => 'Coba hitung dengan mundur: 16 - 4 = ?', 'options' => ['13' => false, '12' => true, '14' => false]],
                ],
            ],
            [
                'title' => 'Katak yang Melompat',
                'story' => 'Di tepi rawa biru, ada Katak Hijau yang suka melompat batu ke batu dengan irama berulang.',
                'trivias' => [
                    'Katak melompat dua langkah! Dari 2, ia lompat ke 4, lalu ke 6. Ini lompatan Genap.',
                    'Pola itu seperti aturan pasti. Melompat ditambah 2 terus menerus dinamakan Pola bilangan.',
                    'Di daun Teratai besar, Katak Oranye melompat ganjil: 1, 3, 5! Dia selalu melewati daun di antaranya.',
                    'Ada Katak Super yang lompatnya lima lompatan: 5, 10, 15, lalu mendarat di 20!',
                    'Setiap lompatan katak bernilai selisih konstan. Itulah yang dinamakan pola melompat.',
                ],
                'quizzes' => [
                    ['q' => 'Jika katak ada di batu angka 6 dan lompat 2 bilangan lagi, ia mendarat di mana?', 'options' => ['7' => false, '8' => true, '9' => false]],
                    ['q' => 'Deret 2 - 4 - 6 disebut pola apa?', 'options' => ['Pola Ganjil' => false, 'Teratai' => false, 'Pola Genap (+2)' => true]],
                    ['q' => 'Jika Katak Oranye lompat ganjil (1, 3, 5), batu mana setelah 5?', 'options' => ['7' => true, '8' => false, '6' => false]],
                    ['q' => 'Katak Super lompat (5, 10, 15). Ke mana ia mendarat setelah 15?', 'options' => ['18' => false, '20' => true, '25' => false]],
                    ['q' => 'Apa syarat agar sebuah deret angka disebut Pola Bilangan?', 'options' => ['Lompatan acak' => false, 'Punya selisih teratur yang sama' => true, 'Angkanya besar' => false]],
                ],
            ],
            [
                'title' => 'Mengecat Istana Raja',
                'story' => 'Raja minta kita merapikan dinding kerajaan dengan stiker cat berbentuk geometris!',
                'trivias' => [
                    'Jendela Menara berbentuk Bulat seperti koin. Ini namanya Lingkaran. Ia tidak punya sudut lancip!',
                    'Pintu gerbang berbentuk panjang ke atas dan lebarnya berbeda. Itulah si Persegi Panjang!',
                    'Puncak pilar menara meruncing di atas. Itu adalah Segitiga karena memiliki tiga sudut potong.',
                    'Lantai istana dipasangi ubin dengan ukuran keempat sisi sama persis! Itulah si Persegi utuh.',
                    'Semua bentuk ini dipelajari dalam Geometri. Lingkaran adalah satu-satunya yang gampang bergulir.',
                ],
                'quizzes' => [
                    ['q' => 'Bangun manakah yang mirip dengan koin logam?', 'options' => ['Segitiga' => false, 'Lingkaran' => true, 'Persegi' => false]],
                    ['q' => 'Bentuk pintu yang ukurannya panjang dan lebar berbeda adalah?', 'options' => ['Persegi Panjang' => true, 'Lingkaran Bawah' => false, 'Kotak Sempurna' => false]],
                    ['q' => 'Berapa jumlah titik sudut pada atap pilar Segitiga?', 'options' => ['4 titik' => false, '0 titik' => false, '3 titik' => true]],
                    ['q' => 'Bentuk ubin lantai yang keempat sisi pembatasnya sama persis dinamakan apa?', 'options' => ['Persegi' => true, 'Persegi Panjang' => false, 'Segitiga' => false]],
                    ['q' => 'Siapa yang paling mungkin menggelinding jika dijatuhkan ke bawah bukit?', 'options' => ['Kotak' => false, 'Lingkaran' => true, 'Segitiga' => false]],
                ],
            ],
            [
                'title' => 'Melawan Naga Kalkulator',
                'story' => 'Seekor Naga Perkasa menghalangi jalan. Jawab 5 teka-tekinya dari semua ilmu! Tunjukkan kekuatan perhitunganmu.',
                'trivias' => [
                    'Naga: Berapa 7 pedang ditambah 2 pedang? Ingat Penjumlahan!',
                    'Naga: Berapa 16 tameng jika dipukul hilang 4? Kurangi pelan-pelan ke belakang!',
                    'Naga: Aku menyukai tebak-tebakan. Pola apa ini: 10, 12, 14, __?',
                    'Naga: Dari atas awan, piramida terlihat berbentuk apa?',
                    'Kamu sangat hebat Kapten. Bersiaplah untuk menyerang ujian terakhirku yang menggabungkan tambah dan kurang!',
                ],
                'quizzes' => [
                    ['q' => 'Tantangan 1 Naga: 7 + 2 = ?', 'options' => ['8' => false, '9' => true, '10' => false]],
                    ['q' => 'Tantangan 2 Naga: 16 - 4 = ?', 'options' => ['11' => false, '12' => true, '13' => false]],
                    ['q' => 'Tantangan 3 Naga: Jika polanya 10, 12, 14, berapakah bilangan berikutnya?', 'options' => ['18' => false, '16' => true, '20' => false]],
                    ['q' => 'Tantangan 4 Naga: Bangun apa yang menyerupai bentuk luar Piramida Mesir Kuno?', 'options' => ['Lingkaran' => false, 'Segitiga' => true, 'Bujur Sangkar' => false]],
                    ['q' => 'Tantangan Final: Uang sebanyak 10 koin, dipakai 3 koin, ditambahkan lagi hadiah 1 koin. Berapa sisanya?', 'options' => ['8 koin' => true, '7 koin' => false, '9 koin' => false]],
                ],
            ],
        ];

        foreach ($adventures as $index => $adventure) {
            $lesson = $course->lessons()->updateOrCreate(
                ['title' => $adventure['title']],
                [
                    'slug' => \Illuminate\Support\Str::slug($adventure['title']),
                    'order' => $index + 1,
                    'xp_reward' => 50,
                    'icon' => $course->icon,
                ]
            );

            for ($i = 0; $i < 5; $i++) {
                // Text Slide
                $lesson->slides()->updateOrCreate(
                    ['order' => ($i * 2) + 1],
                    [
                        'type' => 'text',
                        'title' => 'Petunjuk Cerita '.($i + 1),
                        'content' => $adventure['trivias'][$i],
                    ]
                );

                // Quiz Slide
                $quizData = $adventure['quizzes'][$i];
                $options = [];
                $letters = ['A', 'B', 'C', 'D'];
                $optionIndex = 0;
                foreach ($quizData['options'] as $text => $isCorrect) {
                    $options[] = [
                        'id' => $letters[$optionIndex],
                        'text' => (string) $text,
                        'correct' => (bool) $isCorrect,
                    ];
                    $optionIndex++;
                }

                $lesson->slides()->updateOrCreate(
                    ['order' => ($i * 2) + 2],
                    [
                        'type' => 'quiz',
                        'title' => 'Tantangan '.($i + 1),
                        'content' => $quizData['q'],
                        'options' => $options,
                    ]
                );
            }
        }
    }
}
