<?php

namespace App\Livewire\Missions;

use App\Models\Lesson;
use App\Services\LessonService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.empty')]
class MissionPlayer extends Component
{
    public $mission;

    public $slides = [];

    public $step = 0;

    public $selectedAnswer = null;

    public $isChecked = false;

    public $isCorrect = false;

    public $hearts = 5;

    public function mount($slug)
    {
        $this->mission = Lesson::where('slug', $slug)->with('slides')->firstOrFail();
        $this->slides = $this->mission->slides->toArray();

        if (empty($this->slides)) {
            $this->redirectRoute('dashboard', navigate: true);

            return;
        }
    }

    public function selectAnswer($optionId)
    {
        if ($this->isChecked) {
            return;
        }
        $this->selectedAnswer = $optionId;
    }

    public function checkAnswer()
    {
        if ($this->selectedAnswer === null || $this->isChecked) {
            return;
        }

        $currentSlide = $this->slides[$this->step];
        $this->isChecked = true;

        // Find if selected option is correct
        $correctOption = collect($currentSlide['options'])->firstWhere('correct', true);
        $this->isCorrect = ($this->selectedAnswer == ($correctOption['id'] ?? null));

        if (! $this->isCorrect) {
            $this->hearts = max(0, $this->hearts - 1);
        }
    }

    public function nextStep()
    {
        if ($this->step < count($this->slides) - 1) {
            $this->step++;
            $this->resetStep();
        } else {
            // Save Progress via Service
            if (auth()->check()) {
                app(LessonService::class)->completeMission(auth()->user(), $this->mission);
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
        return view('livewire.missions.mission-player', [
            'currentSlide' => $this->slides[$this->step],
            'progress' => (($this->step + 1) / count($this->slides)) * 100,
        ]);
    }
}
