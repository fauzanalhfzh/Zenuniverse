<?php

namespace App\Livewire\Missions;

use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.empty')]
class IntroToTech extends Component
{
    public int $step = 0;

    public int $hearts = 5;

    public $selectedAnswer = null;

    public bool $isChecked = false;

    public bool $isCorrect = false;

    public array $slides = [
        [
            'type' => 'intro',
            'title' => 'Selamat Datang di Dunia Teknologi!',
            'image' => 'images/hero.png',
            'content' => 'Halo Penjelajah! 👋
            
Tahukah kamu? Teknologi itu bukan cuma robot atau komputer canggih loh. Yuk, kita cari tahu apa sebenarnya teknologi itu!',
            'button_text' => 'Siap Belajar!',
        ],
        [
            'type' => 'intro',
            'title' => 'Apa Itu Teknologi? 🤔',
            'image' => 'images/hero.png',
            'content' => 'Teknologi adalah **alat atau cara** yang diciptakan manusia untuk membuat pekerjaan kita menjadi lebih **mudah dan cepat**.
            
Jadi, pensil yang kamu pakai untuk menulis juga termasuk teknologi!',
            'button_text' => 'Wah, Benarkah?',
        ],
        [
            'type' => 'quiz',
            'question' => 'Manakah di bawah ini yang MERUPAKAN teknologi?',
            'options' => [
                ['id' => 'a', 'text' => 'Batu di sungai 🪨', 'correct' => false],
                ['id' => 'b', 'text' => 'Sendok makan 🥄', 'correct' => true],
                ['id' => 'c', 'text' => 'Awan di langit ☁️', 'correct' => false],
            ],
            'explanation' => 'Betul! Sendok adalah teknologi sederhana yang dibuat manusia untuk membantu kita makan.',
            'button_text' => 'Cek Jawaban',
        ],
        [
            'type' => 'intro',
            'title' => 'Teknologi Sederhana vs Canggih ⚡',
            'image' => 'images/hero.png',
            'content' => 'Ada teknologi yang **sederhana** (tidak butuh listrik) seperti roda, gunting, dan palu.
            
Ada juga yang **canggih** (butuh listrik & komputer) seperti HP, satelit, dan internet.',
            'button_text' => 'Paham!',
        ],
        [
            'type' => 'quiz',
            'question' => 'Coba tebak, mana yang termasuk teknologi CANGGIH?',
            'options' => [
                ['id' => 'a', 'text' => 'Sepeda ontel 🚲', 'correct' => false],
                ['id' => 'b', 'text' => 'Kipas angin kertas 🪭', 'correct' => false],
                ['id' => 'c', 'text' => 'Robot pembersih 🤖', 'correct' => true],
            ],
            'explanation' => '100 Buat Kamu! Robot adalah teknologi canggih yang menggunakan program komputer.',
            'button_text' => 'Lanjut',
        ],
        [
            'type' => 'intro',
            'title' => 'Kenapa Kita Butuh Teknologi? 🌍',
            'image' => 'images/hero.png',
            'content' => 'Bayangkan kalau tidak ada lampu, malam pasti gelap gulita! 🌑
            
Teknologi membantu kita:
✅ Menghemat waktu
✅ Menjaga kesehatan
✅ Berkomunikasi jarak jauh',
            'button_text' => 'Masuk Akal!',
        ],
        [
            'type' => 'intro',
            'title' => 'Kamu Adalah Calon Penemu! 🚀',
            'image' => 'images/hero.png',
            'content' => 'Sekarang kamu sudah paham dasar teknologi.
            
Siapa tahu, suatu saat nanti KAMU yang akan menciptakan teknologi baru untuk membantu dunia! Semangat!',
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
        Log::info('checkAnswer called', ['step' => $this->step, 'answer' => $this->selectedAnswer]);
        if ($this->selectedAnswer === null) {
            return;
        }

        $currentSlide = $this->slides[$this->step];
        $correctOption = collect($currentSlide['options'])->firstWhere('correct', true);

        $this->isCorrect = $this->selectedAnswer === $correctOption['id'];
        $this->isChecked = true;

        if ($this->isCorrect) {
            $this->dispatch('play-sound', sound: 'success');
        } else {
            $this->hearts = max(0, $this->hearts - 1);
            $this->dispatch('play-sound', sound: 'error');
        }
    }

    public function nextStep()
    {
        Log::info('nextStep called', ['current_step' => $this->step]);
        if ($this->step < count($this->slides) - 1) {
            $this->step++;
            $this->resetStep();
        } else {
            // Save Progress
            if (auth()->check()) {
                \App\Models\UserProgress::updateOrCreate(
                    [
                        'user_id' => auth()->id(),
                        'mission_slug' => 'intro-to-tech',
                    ],
                    [
                        'status' => 'completed',
                        'xp_earned' => 100, // Example XP
                        'completed_at' => now(),
                    ]
                );
                
                $this->dispatch('play-sound', sound: 'fanfare');
            }

            return redirect()->route('learning-center');
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
        return view('livewire.missions.intro-to-tech', [
            'currentSlide' => $this->slides[$this->step],
            'progress' => (($this->step + 1) / count($this->slides)) * 100,
        ]);
    }
}
