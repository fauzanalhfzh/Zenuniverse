<?php

namespace App\Services;

use App\Models\Lesson;
use App\Models\User;
use App\Models\UserProgress;

class LessonService
{
    public function __construct(
        protected StreakService $streakService
    ) {}

    /**
     * Mark a lesson as completed and award XP to the user.
     * Returns true if this is a new completion, false if already completed.
     */
    public function completeLesson(User $user, Lesson $lesson): bool
    {
        $existingProgress = UserProgress::where('user_id', $user->id)
            ->where('lesson_id', $lesson->id)
            ->first();

        if ($existingProgress) {
            return false;
        }

        UserProgress::create([
            'user_id' => $user->id,
            'lesson_id' => $lesson->id,
            'status' => 'completed',
            'xp_earned' => $lesson->xp_reward,
            'completed_at' => now(),
        ]);

        $user->increment('current_xp', $lesson->xp_reward);
        $user->increment('total_xp', $lesson->xp_reward);

        $this->checkLevelUp($user);
        $this->streakService->recordActivity($user);
        $this->checkBadges($user);

        return true;
    }

    /**
     * Complete a mission (slide-based lesson) and award XP.
     */
    public function completeMission(User $user, Lesson $mission): bool
    {
        UserProgress::updateOrCreate(
            [
                'user_id' => $user->id,
                'lesson_id' => $mission->id,
            ],
            [
                'mission_slug' => $mission->slug,
                'status' => 'completed',
                'xp_earned' => $mission->xp_reward ?? 100,
                'completed_at' => now(),
            ]
        );

        $user->increment('current_xp', $mission->xp_reward ?? 100);
        $user->increment('total_xp', $mission->xp_reward ?? 100);

        $this->checkLevelUp($user);
        $this->streakService->recordActivity($user);
        $this->checkBadges($user);

        return true;
    }

    /**
     * Simple level-up check based on XP threshold.
     */
    protected function checkLevelUp(User $user): void
    {
        $nextLevel = \App\Models\Level::where('order', '>', $user->currentLevel?->order ?? 0)
            ->orderBy('order')
            ->first();

        if ($nextLevel && $user->total_xp >= $nextLevel->xp_required) {
            $user->update(['current_level_id' => $nextLevel->id]);
        }
    }

    /**
     * Check and award badges dynamically.
     */
    public function checkBadges(User $user): void
    {
        $allBadges = \App\Models\Badge::all();
        $userBadges = $user->badges()->pluck('badges.id')->toArray();

        // Calculate progress criteria
        $completedMissionsCount = \App\Models\UserProgress::where('user_id', $user->id)
                                ->where('status', 'completed')
                                ->count();
        $totalXp = $user->total_xp;
        $streakDays = $user->current_streak;

        $badgesToAward = [];

        foreach ($allBadges as $badge) {
            if (in_array($badge->id, $userBadges)) {
                continue; // Already has badge
            }

            $unlocked = false;
            switch ($badge->condition_type) {
                case 'total_xp':
                    $unlocked = $totalXp >= $badge->condition_value;
                    break;
                case 'completed_missions':
                    $unlocked = $completedMissionsCount >= $badge->condition_value;
                    break;
                case 'streak_days':
                    $unlocked = $streakDays >= $badge->condition_value;
                    break;
            }

            if ($unlocked) {
                $badgesToAward[$badge->id] = ['unlocked_at' => now()];
            }
        }

        if (!empty($badgesToAward)) {
            $user->badges()->syncWithoutDetaching($badgesToAward);
        }
    }
}

