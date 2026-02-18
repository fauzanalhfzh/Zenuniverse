<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\Level;
use Livewire\Component;
use Livewire\Attributes\Url;

class StudentDashboard extends Component
{
    #[Url]
    public $selectedCourseId;

    public function mount()
    {
        $user = auth()->user();

        // 1. Try to get from URL (temporary override)
        if ($this->selectedCourseId) {
            return;
        }

        // 2. Try to get from User Profile (persisted)
        if ($user && $user->active_course_id) {
            $this->selectedCourseId = $user->active_course_id;
            return;
        }

        // 3. Fallback to first course
        $firstCourse = Course::orderBy('order')->first();
        if ($firstCourse) {
            $this->selectedCourseId = $firstCourse->id;
            // Optional: Auto-save this default to user
            if ($user && !$user->active_course_id) {
                $user->update(['active_course_id' => $firstCourse->id]);
            }
        }
    }

    public function selectCourse($courseId)
    {
        $this->selectedCourseId = (int) $courseId;
        \Log::info('Select Course Triggered: ' . $this->selectedCourseId);
    }

    public function render()
    {
        $user = auth()->user()->load(['currentLevel', 'progress']);

        // 1. Get ALL available courses
        $availableCourses = Course::orderBy('order')->get();
        
        \Log::info('Available Course IDs: ' . $availableCourses->pluck('id')->implode(', '));

        // 2. Determine Current Course based on selection
        // Use loose comparison or loop to be extra safe
        $currentCourse = $availableCourses->first(fn($c) => $c->id == $this->selectedCourseId);

        \Log::info('Render - Selected ID: ' . $this->selectedCourseId . ' (Type: ' . gettype($this->selectedCourseId) . ')');
        \Log::info('Render - Found Course: ' . ($currentCourse ? $currentCourse->title : 'None'));

        // Fallback if selection invalid or empty
        if (! $currentCourse && $availableCourses->isNotEmpty()) {
            $currentCourse = $availableCourses->first();
            $this->selectedCourseId = $currentCourse->id;
            \Log::info('Render - Fallback to First: ' . $currentCourse->title);
        }

        // 3. Get lessons for SELECTED course
        $lessons = $currentCourse
            ? $currentCourse->lessons()->orderBy('order')->get()
            : collect();

        // Completed lesson IDs from user progress
        $completedLessonIds = $user->progress
            ->where('status', 'completed')
            ->pluck('lesson_id')
            ->toArray();

        // Current lesson = first lesson not yet completed
        $currentLessonId = null;
        foreach ($lessons as $lesson) {
            if (! in_array($lesson->id, $completedLessonIds)) {
                $currentLessonId = $lesson->id;
                break;
            }
        }

        // If all completed, no current lesson
        if ($currentLessonId === null && $lessons->count() > 0) {
            $currentLessonId = null; // All done!
        }

        return view('livewire.student-dashboard', [
            'user' => $user,
            'availableCourses' => $availableCourses,
            'currentCourse' => $currentCourse,
            'lessons' => $lessons,
            'completedLessonIds' => $completedLessonIds,
            'currentLessonId' => $currentLessonId,
        ])->layout('components.layouts.student');
    }
}
