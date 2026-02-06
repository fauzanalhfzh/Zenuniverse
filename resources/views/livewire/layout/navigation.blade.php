<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div class="sticky top-0 z-50 w-full border-b border-[#e7f3eb] dark:border-[#2a4533] bg-background-light/95 dark:bg-background-dark/95 backdrop-blur-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <header class="flex h-16 items-center justify-between">
            <!-- Logo -->
            <div class="flex items-center gap-2">
                <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2 group">
                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-background-dark transform group-hover:scale-110 transition-transform">
                        <span class="material-symbols-outlined text-xl font-bold">rocket_launch</span>
                    </div>
                    <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">TechUp</h2>
                </a>
            </div>

            <!-- Desktop Nav -->
            <nav class="hidden md:flex items-center gap-8">
                <a class="text-sm font-medium hover:text-primary transition-colors text-slate-900 dark:text-gray-200 {{ request()->routeIs('dashboard') ? 'text-primary' : '' }}" href="{{ route('dashboard') }}" wire:navigate>Dashboard</a>
                <a class="text-sm font-medium hover:text-primary transition-colors text-slate-900 dark:text-gray-200" href="#">Lessons</a>
                <a class="text-sm font-medium hover:text-primary transition-colors text-slate-900 dark:text-gray-200" href="#">Leaderboard</a>
                <a class="text-sm font-medium hover:text-primary transition-colors text-slate-900 dark:text-gray-200" href="#">Settings</a>
            </nav>

            <!-- User Profile & Mobile Menu -->
            <div class="flex items-center gap-4">
                <!-- Dark Mode Toggle -->
                <button @click="toggleTheme()" class="p-2 rounded-full text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition">
                    <span x-show="!darkMode" class="material-symbols-outlined">dark_mode</span>
                    <span x-show="darkMode" class="material-symbols-outlined" style="display: none;">light_mode</span>
                </button>

                <!-- User Badges / XP -->
                <div class="hidden sm:flex items-center gap-2 rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-card-dark py-1 pl-1 pr-3 shadow-sm">
                    <div class="h-8 w-8 rounded-full bg-gray-200 flex items-center justify-center text-lg">
                        🧑‍💻
                    </div>
                    <span class="text-sm font-bold text-slate-700 dark:text-gray-200">{{ auth()->user()->total_xp ?? 0 }} XP</span>
                </div>

                <!-- Profile Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 focus:outline-none">
                             <span class="material-symbols-outlined text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">expand_more</span>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <button wire:click="logout" class="w-full text-start">
                            <x-dropdown-link>
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </button>
                    </x-slot>
                </x-dropdown>
            </div>
        </header>
    </div>
</div>
