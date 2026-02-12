<?php

namespace App\Livewire\Hub;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student', ['title' => 'Pusat Belajar', 'active' => 'learn'])]
class LearningCenter extends Component
{
    public $progress = [];

    public function mount()
    {
        if (auth()->check()) {
            $this->progress = auth()->user()->progress()
                ->whereNotNull('mission_slug')
                ->pluck('status', 'mission_slug')
                ->toArray();
        }
    }

    public function render()
    {
        return view('livewire.hub.learning-center');
    }
}
