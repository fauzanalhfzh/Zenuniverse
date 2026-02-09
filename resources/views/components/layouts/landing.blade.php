@props(['title' => 'ZenUniverse'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>{{ $title ?? 'ZenUniverse' }}</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet" />
       
       {{-- Font Awesome --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Styles & Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
             .bubbly-button {
                box-shadow: 0 6px 0px #d97706;
                transition: all 0.2s ease;
            }
            .bubbly-button:active {
                box-shadow: 0 2px 0px #d97706;
                transform: translateY(4px);
            }
        </style>
    </head>
    <body class="font-fredoka antialiased text-soft-text selection:bg-primary/20 bg-sky-base dark:bg-slate-900 transition-colors duration-300 relative overflow-x-hidden"
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
        <!-- Background Elements -->
        <x-welcome.background />

        <!-- Header -->
        <x-welcome.header />

        <main class="pt-24 relative z-10 transition-colors duration-300 min-h-screen">
            {{ $slot }}
        </main>

        <!-- Footer -->
        <x-welcome.footer />
    </body>
</html>
