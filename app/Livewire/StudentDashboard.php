<?php

namespace App\Livewire;

use Livewire\Component;

class StudentDashboard extends Component
{
    public function getGreeting($user)
    {
        $hour = date('H');
        $timeGreeting = match(true) {
            $hour < 12 => 'Selamat Pagi',
            $hour < 15 => 'Selamat Siang',
            $hour < 18 => 'Selamat Sore',
            default => 'Selamat Malam',
        };

        if ($user->age_group === '4-7') {
            return "Halo, " . explode(' ', $user->name)[0] . "! 🌟";
        }

        return "$timeGreeting, " . explode(' ', $user->name)[0] . "!";
    }

    public function render()
    {
        $user = auth()->user()->load(['currentLevel', 'progress']);
        
        $levels = \App\Models\Level::orderBy('order')->get();
        
        // Courses for current level map
        $currentLevelCourses = \App\Models\Course::where('level_id', $user->current_level_id ?? 1)
            ->orderBy('order')
            ->with(['lessons', 'lessons.questions'])
            ->get();

        // Catalog: All courses grouped by level
        $catalogLevels = \App\Models\Level::orderBy('order')
            ->with(['courses' => function($query) {
                $query->orderBy('order');
            }])
            ->get();
            
        $greeting = $this->getGreeting($user);

        return view('livewire.student-dashboard', [
            'greeting' => $greeting,
            'user' => $user,
            'levels' => $levels,
            'courses' => $currentLevelCourses,
            'catalogLevels' => $catalogLevels,
        ])->layout('components.layouts.student');
    }
}
