<?php

use App\Livewire\LessonPlayer;
use App\Livewire\StudentDashboard;
use App\Livewire\Welcome;

Route::get('/', Welcome::class)->name('home');

Route::get('dashboard', StudentDashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('lesson/{lesson}', LessonPlayer::class)
    ->middleware(['auth', 'verified'])
    ->name('lesson.show');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
