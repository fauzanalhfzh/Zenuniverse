<?php

namespace App\Livewire;

use Livewire\Component;

class StudentDashboard extends Component
{
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

        return view('livewire.student-dashboard', [
            'user' => $user,
            'levels' => $levels,
            'courses' => $currentLevelCourses,
            'catalogLevels' => $catalogLevels,
        ]);
    }
}
