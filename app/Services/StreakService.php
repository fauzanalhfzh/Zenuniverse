<?php

namespace App\Services;

use App\Models\User;
use Carbon\Carbon;

class StreakService
{
    /**
     * Record daily activity and update streak counters.
     * Should be called after every lesson/mission completion.
     */
    public function recordActivity(User $user): void
    {
        $now = Carbon::now();
        $lastActivity = $user->last_activity_at;

        // Already active today — skip
        if ($lastActivity && $lastActivity->isToday()) {
            return;
        }

        if ($lastActivity && $lastActivity->isYesterday()) {
            // Consecutive day — increment streak
            $user->current_streak += 1;
        } else {
            // Streak broken or first activity — start fresh
            $user->current_streak = 1;
        }

        // Update longest streak if current is higher
        if ($user->current_streak > $user->longest_streak) {
            $user->longest_streak = $user->current_streak;
        }

        $user->last_activity_at = $now;
        $user->save();
    }
}
