<?php

namespace App\Livewire\Missions;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Support\Facades\Log;

#[Layout('components.layouts.empty')]
class IntroToInternet extends Component
{
    public int $step = 0;

    public int $hearts = 5;

    public $selectedAnswer = null;

    public bool $isChecked = false;

    public bool $isCorrect = false;

    public array $slides = [
        [
            'type' => 'intro',
            'title' => 'Selamat Datang di Dunia Internet! 🌐',
            'image' => 'images/hero.png',
            'content' => 'Halo Penjelajah Digital! 👩‍🚀   
            
Pernah dengar kata "Internet"? Pasti sering dong! Tapi, tahukah kamu apa sebenarnya internet itu?',
            'button_text' => 'Ayo Cari Tahu!',
        ],
        [
            'type' => 'intro',
            'title' => 'Jaring Laba-laba Raksasa 🕸️',
            'image' => 'images/hero.png',
            'content' => 'Bayangkan ada jaring laba-laba raksasa yang menyelimuti seluruh bumi.
            
Setiap titik di jaring itu adalah **komputer** (seperti laptopmu atau HP). Internet adalah **benang** yang menghubungkan semuanya!',
            'button_text' => 'Wah, Besar Sekali!',
        ],
        [
            'type' => 'quiz',
            'question' => 'Jadi, apa fungsi utama Internet?',
            'options' => [
                ['id' => 'a', 'text' => 'Menghubungkan miliaran perangkat 🌍', 'correct' => true],
                ['id' => 'b', 'text' => 'Membuat HP jadi berat 📱', 'correct' => false],
                ['id' => 'c', 'text' => 'Menyimpan makanan di kulkas 🍔', 'correct' => false],
            ],
            'explanation' => 'Tepat! Internet menghubungkan komputer di seluruh dunia agar bisa saling bicara.',
            'button_text' => 'Lanjut',
        ],
        [
            'type' => 'intro',
            'title' => 'Seperti Mengirim Surat ✉️',
            'image' => 'images/hero.png',
            'content' => 'Saat kamu mengirim pesan WA atau nonton YouTube, data dikirim dalam bentuk **paket-paket kecil**.
            
Paket ini terbang lewat kabel di bawah laut atau sinyal udara (WiFi) super cepat sampai ke tujuan! 🚀',
            'button_text' => 'Canggih!',
        ],
        [
            'type' => 'quiz',
            'question' => 'Apa yang kamu butuhkan untuk masuk ke Internet?',
            'options' => [
                ['id' => 'a', 'text' => 'Hanya Komputer 💻', 'correct' => false],
                ['id' => 'b', 'text' => 'Komputer & Koneksi (WiFi/Data) 📡', 'correct' => true],
                ['id' => 'c', 'text' => 'Televisi Jadul 📺', 'correct' => false],
            ],
            'explanation' => 'Betul! Kamu butuh alat (Gadget) DAN jalan (Koneksi) untuk masuk ke internet.',
            'button_text' => 'Cek Jawaban',
        ],
        [
            'type' => 'intro',
            'title' => 'Hati-hati di Jalan Raya! 🛑',
            'image' => 'images/hero.png',
            'content' => 'Internet itu tempat umum, seperti jalan raya. Ada orang baik, ada juga yang jahat.
            
**Aturan Emas:** JANGAN BERIKAN Password atau Alamat Rumah kepada orang asing di internet!',
            'button_text' => 'Siap, Kapten!',
        ],
        [
            'type' => 'quiz',
            'question' => 'Ada orang asing minta password game kamu. Kamu harus apa?',
            'options' => [
                ['id' => 'a', 'text' => 'Kasih aja, biar dia senang 😊', 'correct' => false],
                ['id' => 'b', 'text' => 'Marah-marah 😡', 'correct' => false],
                ['id' => 'c', 'text' => 'Tolak & Lapor Orang Tua 🛡️', 'correct' => true],
            ],
            'explanation' => 'Pintar! Password itu rahasia. Jangan pernah diberikan ke siapapun kecuali orang tua.',
            'button_text' => 'Lanjut',
        ],
        [
            'type' => 'intro',
            'title' => 'Kamu Siap Menjelajah! 🚀',
            'image' => 'images/hero.png',
            'content' => 'Selamat! Kamu sudah paham dasar-dasar internet dan cara aman menggunakannya.
            
Dunia digital yang luas menunggumu. Gunakan internet untuk belajar dan berkarya ya!',
            'button_text' => 'Selesai Misi',
        ],
    ];

    public function selectAnswer($id)
    {
        if ($this->isChecked) {
            return;
        }
        $this->selectedAnswer = $id;
    }

    public function checkAnswer()
    {
        Log::info('checkAnswer (internet) called', ['step' => $this->step, 'answer' => $this->selectedAnswer]);
        if ($this->selectedAnswer === null) {
            return;
        }

        $currentSlide = $this->slides[$this->step];
        $correctOption = collect($currentSlide['options'])->firstWhere('correct', true);

        $this->isCorrect = $this->selectedAnswer === $correctOption['id'];
        $this->isChecked = true;

        if (! $this->isCorrect) {
            $this->hearts = max(0, $this->hearts - 1);
        }
    }

    public function nextStep()
    {
        Log::info('nextStep (internet) called', ['current_step' => $this->step]);
        if ($this->step < count($this->slides) - 1) {
            $this->step++;
            $this->resetStep();
        } else {
            // Save Progress
            if (auth()->check()) {
                \App\Models\UserProgress::updateOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'mission_slug' => 'intro-to-internet',
                    ],
                    [
                        'status' => 'completed',
                        'xp_earned' => 100,
                        'completed_at' => now(),
                    ]
                );
            }
            
            return redirect()->route('dashboard');
        }
    }

    private function resetStep()
    {
        $this->selectedAnswer = null;
        $this->isChecked = false;
        $this->isCorrect = false;
    }

    public function render()
    {
        return view('livewire.missions.intro-to-internet', [
            'currentSlide' => $this->slides[$this->step],
            'progress' => (($this->step + 1) / count($this->slides)) * 100,
        ]);
    }
}
