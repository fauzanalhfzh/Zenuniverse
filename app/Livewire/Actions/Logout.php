<?php

namespace App\Livewire\Actions;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Logout
{
    /**
     * Log the current user out of the application.
     */
    public function __invoke(): void
    {
        \Illuminate\Support\Facades\Log::info('Logout action invoked');
        Auth::guard('web')->logout();

        Session::invalidate();
        Session::regenerateToken();
    }
}
