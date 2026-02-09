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
            background: linear-gradient(180deg, #e0f2fe 0%, #ffffff 100%);
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
<body class="text-soft-text selection:bg-primary/20 flex flex-col min-h-screen">
    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="floating-cloud w-64 h-32 top-10 -left-10 bg-white"></div>
        <div class="floating-cloud w-80 h-40 top-1/4 -right-20 bg-blue-100"></div>
        <div class="floating-cloud w-96 h-48 bottom-10 left-1/4 bg-blue-50"></div>
        <div class="absolute top-20 right-[15%] w-16 h-16 rounded-full bg-pink-200 border-4 border-pink-100 opacity-60 animate-pulse"></div>
        <div class="absolute bottom-40 left-[10%] w-12 h-12 rounded-full bg-green-200 border-4 border-green-100 opacity-60"></div>
    </div>

    <header class="fixed top-0 w-full z-50 bg-white/70 backdrop-blur-lg border-b-4 border-blue-50">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3 cursor-pointer" onclick="window.location.href='{{ route('home') }}'">
                <div class="bg-primary p-2 rounded-2xl shadow-lg">
                    <span class="material-symbols-outlined text-white text-3xl">rocket_launch</span>
                </div>
                <h2 class="text-3xl font-bold tracking-tight text-primary">ZenUniverse</h2>
            </div>
            <a class="text-lg font-bold text-slate-500 hover:text-primary transition-colors flex items-center gap-2" href="{{ route('home') }}">
                <span class="material-symbols-outlined">arrow_back</span>
                Kembali ke Beranda
            </a>
        </div>
    </header>

    <main class="flex-grow pt-24 pb-10 relative z-10 flex items-center justify-center">
        {{ $slot }}
    </main>

    <footer class="bg-white/50 border-t-4 border-blue-50 py-6 px-6 relative z-10">
        <div class="max-w-7xl mx-auto flex justify-center items-center text-center">
            <p class="text-slate-400 text-sm font-bold">© {{ date('Y') }} ZenUniverse. Misi Menjelajah Galaksi.</p>
        </div>
    </footer>
</body>
</html>
