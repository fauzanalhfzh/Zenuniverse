<?php

use App\Livewire\LessonPlayer;
use App\Livewire\StudentDashboard;
use App\Livewire\Welcome;

Route::get('/', Welcome::class)->name('home');
Route::view('about', 'about')->name('about');
Route::view('learning-path', 'learning-path')->name('learning-path');

Route::controller(\App\Http\Controllers\BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog.index');
    Route::get('/blog/{slug}', 'show')->name('blog.show');
});

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
