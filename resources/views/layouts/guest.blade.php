<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Zenuniverse') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased"
        x-data="{ 
            darkMode: localStorage.getItem('darkMode') === 'true',
            toggleTheme() {
                this.darkMode = !this.darkMode;
                localStorage.setItem('darkMode', this.darkMode);
                if (this.darkMode) {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }
            }
        }"
        x-init="$watch('darkMode', val => val ? document.documentElement.classList.add('dark') : document.documentElement.classList.remove('dark')); if(darkMode) document.documentElement.classList.add('dark');"
    >
        <div :class="{ 'dark': darkMode }" class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 transition-colors duration-500">
            <div>
                <a href="/" wire:navigate class="flex flex-col items-center group">
                    <span class="text-5xl mb-2 transform group-hover:scale-110 transition duration-300">🚀</span>
                    <h1 class="text-2xl font-bold text-white tracking-widest font-mono drop-shadow-md">Zenuniverses</h1>
                </a>
            </div>
            
            <div class="absolute top-4 right-4">
                <button @click="toggleTheme()" class="p-2 rounded-full bg-white/20 hover:bg-white/30 text-white transition focus:outline-none">
                    <span x-show="!darkMode">🌙</span>
                    <span x-show="darkMode" style="display: none;">☀️</span>
                </button>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-8 py-8 bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm shadow-2xl overflow-hidden sm:rounded-2xl border border-white/50 dark:border-gray-700 relative transition-colors duration-500">
                {{-- Decorative elements --}}
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-yellow-300 rounded-full blur-3xl opacity-30"></div>
                <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-blue-300 rounded-full blur-3xl opacity-30"></div>
                
                <div class="relative z-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
