<?php

namespace App\Livewire\Auth;

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth-custom')]
class Login extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();
        
        // Update Streak Logic
        $user = auth()->user();
        $today = now()->startOfDay();
        $lastActivity = $user->last_activity_at ? $user->last_activity_at->startOfDay() : null;

        if (!$lastActivity || $lastActivity->diffInDays($today) > 1) {
            // Missed a day or first time, reset streak
            $user->update([
                'current_streak' => 1,
                'last_activity_at' => now(),
            ]);
        } elseif ($lastActivity->diffInDays($today) === 1) {
            // Consecutive day, increment streak
            $user->update([
                'current_streak' => $user->current_streak + 1,
                'longest_streak' => max($user->longest_streak, $user->current_streak + 1),
                'last_activity_at' => now(),
            ]);
        } else {
            // Same day login, just update time
            $user->update(['last_activity_at' => now()]);
        }

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: false);
    }

    public function render()
    {
        return view('livewire.auth.login');
    }
}
