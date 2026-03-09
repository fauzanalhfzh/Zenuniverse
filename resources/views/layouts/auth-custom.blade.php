<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'ZenUniverse') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root {
            --sky-blue: #e0f2fe;
            --soft-white: #ffffff;
            --accent-orange: #ff8a3d;
            --cloud-white: #f8fafc;
            --planet-purple: #c084fc;
            --planet-green: #4ade80;
        }
        body {
            font-family: 'Fredoka', sans-serif;
            overflow-x: hidden;
            min-height: 100vh;
        }
        .bubbly-button {
            box-shadow: 0 6px 0px #d97706;
            transition: all 0.2s ease;
        }
        .bubbly-button:active {
            box-shadow: 0 2px 0px #d97706;
            transform: translateY(4px);
        }
        .floating-cloud {
            background: white;
            border-radius: 50px;
            position: absolute;
            z-index: -1;
            filter: blur(20px);
            opacity: 0.7;
        }
        .input-field {
            transition: all 0.3s ease;
            border: 3px solid #e2e8f0;
        }
        .input-field:focus {
            border-color: #ff8a3d;
            box-shadow: 0 0 0 4px rgba(255, 138, 61, 0.2);
        }
    </style>
</head>
<body class="text-soft-text selection:bg-primary/20 flex flex-col min-h-screen bg-gradient-to-b from-sky-100 to-white dark:from-slate-900 dark:to-slate-800 transition-colors duration-300"
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
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="floating-cloud w-64 h-32 top-10 -left-10 bg-white dark:bg-slate-800 transition-colors duration-300"></div>
        <div class="floating-cloud w-80 h-40 top-1/4 -right-20 bg-blue-100 dark:bg-blue-900/30 transition-colors duration-300"></div>
        <div class="floating-cloud w-96 h-48 bottom-10 left-1/4 bg-blue-50 dark:bg-slate-800/50 transition-colors duration-300"></div>
        <div class="absolute top-20 right-[15%] w-16 h-16 rounded-full bg-pink-200 dark:bg-pink-900/40 border-4 border-pink-100 dark:border-pink-800/50 opacity-60 animate-pulse transition-colors duration-300"></div>
        <div class="absolute bottom-40 left-[10%] w-12 h-12 rounded-full bg-green-200 dark:bg-green-900/40 border-4 border-green-100 dark:border-green-800/50 opacity-60 transition-colors duration-300"></div>
    </div>

    <x-welcome.header />

    <main class="flex-grow pt-24 pb-10 relative z-10 flex items-center justify-center">
        {{ $slot }}
    </main>

    <footer class="bg-white/50 dark:bg-slate-900/50 border-t-4 border-blue-50 dark:border-slate-800 py-6 px-6 relative z-10 transition-colors duration-300">
        <div class="max-w-7xl mx-auto flex justify-center items-center text-center">
            <p class="text-slate-400 dark:text-slate-500 text-sm font-bold">© {{ date('Y') }} ZenUniverse. Misi Menjelajah Galaksi.</p>
        </div>
    </footer>
</body>
</html>
