<?php

namespace App\Livewire\Missions\Math;

use App\Models\UserProgress;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.empty')]
class CountingAdventure extends Component
{
    public int $currentLevel = 1;
    public int $maxLevels = 5;
    public int $score = 0;
    public int $hearts = 3;
    
    public int $targetNumber = 0;
    public array $options = [];
    public ?int $selectedAnswer = null;
    public bool $isCorrect = false;
    public bool $isChecked = false;
    
    public string $mascotImage = 'images/hero.png';

    public function mount()
    {
        $this->generateLevel();
    }

    public function generateLevel()
    {
        $this->resetState();
        
        // Difficulty scales with level
        $maxNumber = 3 + ($this->currentLevel * 2); // Level 1: max 5, Level 5: max 13
        
        $this->targetNumber = rand(1, $maxNumber);
        
        // Generate options (1 correct, 2 wrong)
        $options = [$this->targetNumber];
        while(count($options) < 3) {
            $wrong = rand(1, $maxNumber);
            if (!in_array($wrong, $options)) {
                $options[] = $wrong;
            }
        }
        shuffle($options);
        $this->options = $options;
    }

    public function resetState()
    {
        $this->selectedAnswer = null;
        $this->isCorrect = false;
        $this->isChecked = false;
    }

    public function selectAnswer($number)
    {
        if ($this->isChecked) return;
        
        $this->selectedAnswer = $number;
        $this->checkAnswer();
    }

    public function checkAnswer()
    {
        $this->isChecked = true;
        $this->isCorrect = ($this->selectedAnswer === $this->targetNumber);

        if ($this->isCorrect) {
            $this->dispatch('play-sound', sound: 'success');
            $this->score += 20;
        } else {
            $this->dispatch('play-sound', sound: 'error');
            $this->hearts = max(0, $this->hearts - 1);
        }
    }

    public function nextLevel()
    {
        if ($this->hearts <= 0) {
            return redirect()->route('learning-center'); 
        }

        if ($this->currentLevel < $this->maxLevels) {
            $this->dispatch('play-sound', sound: 'level-up');
            $this->currentLevel++;
            $this->generateLevel();
        } else {
            $this->finishMission();
        }
    }

    public function finishMission()
    {
        if (auth()->check()) {
            UserProgress::updateOrCreate(
                [
                    'user_id' => auth()->id(),
                    'mission_slug' => 'math-counting-adventure',
                ],
                [
                    'status' => 'completed',
                    'xp_earned' => $this->score,
                    'completed_at' => now(),
                ]
            );
        }

        $this->dispatch('play-sound', sound: 'fanfare');
        return redirect()->route('learning-center');
    }

    public function render()
    {
        return view('livewire.missions.math.counting-adventure');
    }
}
