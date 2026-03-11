<?php

use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\PageController;
use App\Livewire\Hub\LearningCenter;
use App\Livewire\LessonPlayer;
use App\Livewire\StudentDashboard;
use App\Livewire\Welcome;

Route::get('/', Welcome::class)->name('home');
Route::get('about', [PageController::class, 'about'])->name('about');
Route::get('contact', [PageController::class, 'contact'])->name('contact');
Route::get('learning-path', [PageController::class, 'learningPath'])->name('learning-path');
Route::get('tracks', App\Livewire\CourseSelection::class)->name('tracks');

Route::controller(\App\Http\Controllers\BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog.index');
    Route::get('/blog/{slug}', 'show')->name('blog.show');
});

Route::get('dashboard', StudentDashboard::class)
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('learning-center', LearningCenter::class)
    ->middleware(['auth', 'verified'])
    ->name('learning-center');

Route::get('leaderboard', [LeaderboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('leaderboard');

// Missions
Route::get('missions/{slug}', \App\Livewire\Missions\MissionPlayer::class)->name('missions.player');

Route::get('lesson/{lesson}', LessonPlayer::class)
    ->middleware(['auth', 'verified'])
    ->name('lesson.show');

use App\Http\Controllers\ProfileController;

Route::get('profile', [ProfileController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('profile');

Route::post('logout', LogoutController::class)->name('logout');

// Route::get('/setup-db', function() {
//     Artisan::call('optimize:clear');
//     Artisan::call('storage:link');
//     Artisan::call('migrate:fresh', [
//         '--force' => true,
//         '--seed' => true
//     ]);
//     return 'Setup server selesai! Hapus route ini sekarang!';
// });

require __DIR__.'/auth.php';
