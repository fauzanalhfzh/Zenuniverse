@props(['title' => 'Beranda', 'active' => 'dashboard'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
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
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'ZenUniverse' }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
       
        <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
        <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
        <link rel="shortcut icon" href="{{ asset('images/favicon/favicon.ico') }}">

        <!-- Styles & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-fredoka antialiased text-soft-text selection:bg-primary/20 flex h-screen overflow-hidden bg-slate-50/50">
        {{-- Mobile Bottom Navigation --}}
        <x-student.bottom-nav :active="$active" />

        <x-student.sidebar :active="$active" />

        <div class="flex-1 flex flex-col overflow-hidden">
            <x-student.header 
                :title="$title" 
                :xp="auth()->user()->total_xp" 
                :streak="auth()->user()->current_streak ?? 0" 
                :hearts="auth()->user()->hearts ?? 5" 
            />

            {{-- Added pb-24 to prevent content from hiding behind the bottom nav on mobile --}}
            <main class="flex-1 overflow-y-auto p-4 md:p-8 pb-24 lg:pb-8 custom-scrollbar">
                {{ $slot }}
            </main>
        </div>
        @livewireScripts
    </body>
</html>
