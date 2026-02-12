<?php

namespace App\Livewire\Hub;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.student', ['title' => 'Pusat Belajar', 'active' => 'learn'])]
class LearningCenter extends Component
{
    public function render()
    {
        return view('livewire.hub.learning-center');
    }
}
