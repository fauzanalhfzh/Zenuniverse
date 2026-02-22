<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        $topUsers = User::whereNotNull('total_xp')
            ->where('role', 'student')
            ->orderByDesc('total_xp')
            ->limit(20)
            ->get();

        $currentUser = auth()->user();
        $currentUserRank = null;

        if ($currentUser) {
            $currentUserRank = User::where('role', 'student')
                ->where('total_xp', '>', $currentUser->total_xp)
                ->count() + 1;
        }

        return view('leaderboard', compact('topUsers', 'currentUser', 'currentUserRank'));
    }
}
