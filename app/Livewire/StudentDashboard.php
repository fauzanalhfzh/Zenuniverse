<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\User;
use App\Models\UserProgress;
use Livewire\Attributes\Url;
use Livewire\Component;

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
            if ($user && ! $user->active_course_id) {
                $user->update(['active_course_id' => $firstCourse->id]);
            }
        }
    }

    public function selectCourse($courseId)
    {
        $this->selectedCourseId = (int) $courseId;
    }

    public function render()
    {
        $user = auth()->user()->load(['currentLevel', 'progress']);

        // 1. Get ALL available courses
        $availableCourses = Course::orderBy('order')->get();

        // 2. Determine Current Course based on selection
        $currentCourse = $availableCourses->first(fn ($c) => $c->id == $this->selectedCourseId);

        // Fallback if selection invalid or empty
        if (! $currentCourse && $availableCourses->isNotEmpty()) {
            $currentCourse = $availableCourses->first();
            $this->selectedCourseId = $currentCourse->id;
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

        // --- Gamification Data ---
        $leaderboardRank = User::where('role', 'student')
            ->where('total_xp', '>', $user->total_xp)
            ->count() + 1;

        $todayXpEarned = UserProgress::where('user_id', $user->id)
            ->whereDate('completed_at', today())
            ->sum('xp_earned');

        $lessonsDoneToday = UserProgress::where('user_id', $user->id)
            ->whereDate('completed_at', today())
            ->where('status', 'completed')
            ->count();

        // --- Handle Heart Regeneration Internally within the Component ---
        if ($user->hearts < 5) {
            if (! $user->last_heart_replenished_at) {
                $user->last_heart_replenished_at = now();
                $user->save();
            } else {
                $secondsPassed = abs(now()->diffInSeconds($user->last_heart_replenished_at));
                if ($secondsPassed >= 300) {
                    $heartsToAdd = floor($secondsPassed / 300);
                    $newHearts = min(5, $user->hearts + $heartsToAdd);
                    $remainderSeconds = $secondsPassed % 300;

                    $user->hearts = $newHearts;
                    if ($newHearts >= 5) {
                        $user->last_heart_replenished_at = null;
                    } else {
                        // Advance the timer forward by however many full cycles have passed
                        $user->last_heart_replenished_at = now()->subSeconds($remainderSeconds);
                    }
                    $user->save();
                }
            }
        }

        // --- Calculate display time remaining ---
        $remainingSeconds = 0;
        if ($user->hearts < 5) {
            if ($user->last_heart_replenished_at) {
                // How many seconds since the last recorded replenish?
                $secondsElapsed = abs(now()->diffInSeconds($user->last_heart_replenished_at));
                // A new heart spawns every 5 mins (300 secs).
                // Any overflow beyond 300s should have been processed by middleware,
                // but if not, modulo 300 gives us the progress into the *current* cycle.
                $secondsIntoCurrentCycle = $secondsElapsed % 300;
                // Remaining is the cycle length minus the progress
                $remainingSeconds = 300 - $secondsIntoCurrentCycle;
            } else {
                $remainingSeconds = 300;
            }
        }

        return view('livewire.student-dashboard', [
            'user' => $user,
            'availableCourses' => $availableCourses,
            'currentCourse' => $currentCourse,
            'lessons' => $lessons,
            'completedLessonIds' => $completedLessonIds,
            'currentLessonId' => $currentLessonId,
            'leaderboardRank' => $leaderboardRank,
            'todayXpEarned' => $todayXpEarned,
            'lessonsDoneToday' => $lessonsDoneToday,
            'remainingSeconds' => $remainingSeconds,
        ])->layout('components.layouts.student');
    }
}
