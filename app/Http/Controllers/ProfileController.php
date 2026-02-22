<?php

namespace App\Http\Controllers;

use App\Models\Level;
use App\Models\UserProgress;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // Load relationships
        $user->load('currentLevel');

        // Misi Selesai
        $completedCount = UserProgress::where('user_id', $user->id)
            ->where('status', 'completed')
            ->count();

        // Level Progress Data
        $currentXp = $user->total_xp;
        $rankTitle = $user->currentLevel?->name ?? 'Pemula';
        
        $nextLevel = Level::where('order', '>', $user->currentLevel?->order ?? 0)
            ->orderBy('order')
            ->first();

        // If at max level, set target to current + 1000 just for display
        $nextLevelXp = $nextLevel ? $nextLevel->xp_required : ($currentXp + 1000);
        $baseLevelXp = $user->currentLevel?->xp_required ?? 0;
        
        // Calculate percentage within current level bracket
        $xpProgress = max(0, $currentXp - $baseLevelXp);
        $xpTarget = max(1, $nextLevelXp - $baseLevelXp); // Prevent division by zero
        $xpPercent = min(100, ($xpProgress / $xpTarget) * 100);

        return view('profile', compact(
            'completedCount',
            'currentXp',
            'nextLevelXp',
            'xpPercent',
            'rankTitle'
        ));
    }
}
