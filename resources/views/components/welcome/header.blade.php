<header class="fixed z-50 transition-all duration-500 ease-out"
    x-data="{ mobileMenu: false, scrolled: false }"
    x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="scrolled
        ? 'top-4 left-4 right-4 md:left-8 md:right-8 lg:left-1/2 lg:-translate-x-1/2 lg:w-[calc(100%-8rem)] xl:w-[calc(100%-12rem)] bg-white/80 dark:bg-slate-900/85 backdrop-blur-xl rounded-2xl shadow-lg shadow-black/5 dark:shadow-black/20 border border-slate-200/60 dark:border-slate-700/60'
        : 'top-0 left-0 right-0 bg-white/70 dark:bg-slate-900/80 backdrop-blur-lg border-b-4 border-blue-50 dark:border-slate-800'"
>
    <style>
        @media (min-width: 1024px) {
            .desktop-only { display: flex !important; }
            .mobile-hide-desktop { display: none !important; }
        }
        @media (max-width: 1023px) {
            .desktop-only { display: none !important; }
        }
    </style>
    <div class="max-w-7xl mx-auto px-4 md:px-6 h-16 md:h-20 flex items-center justify-between">
        <div class="flex items-center gap-3 cursor-pointer py-1" onclick="Livewire.navigate('{{ route('home') }}')">
            <img src="{{ asset('images/logo.jpeg') }}" alt="ZenUniverse Logo" class="h-10 md:h-12 w-auto object-contain rounded-xl">
            <h2 class="text-2xl md:text-3xl font-bold tracking-tight text-primary">ZenUniverse</h2>
        </div>
        
        <nav class="desktop-only items-center gap-10">
            <a class="text-lg font-bold {{ request()->routeIs('home') ? 'text-primary' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary' }} transition-colors" href="{{ route('home') }}" wire:navigate>Beranda</a>
            <a class="text-lg font-bold {{ request()->routeIs('learning-path') ? 'text-primary border-b-4 border-primary' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary' }} transition-colors" href="{{ route('learning-path') }}" wire:navigate>Alur Belajar</a>
            <a class="text-lg font-bold {{ request()->routeIs('blog.*') ? 'text-primary border-b-4 border-primary' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary' }} transition-colors" href="{{ route('blog.index') }}" wire:navigate>Blog</a>
            <a class="text-lg font-bold {{ request()->routeIs('contact') ? 'text-primary border-b-4 border-primary' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary' }} transition-colors" href="{{ route('contact') }}" wire:navigate>Kontak</a>
        </nav>

        <div class="flex items-center gap-2 lg:gap-4">
            {{-- Desktop Navigation Buttons --}}
            <div class="desktop-only items-center gap-4">
                <button @click="toggleTheme()" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors text-slate-600 dark:text-slate-300" aria-label="Toggle Dark Mode">
                    <span class="material-symbols-outlined" x-show="!darkMode">dark_mode</span>
                    <span class="material-symbols-outlined" x-show="darkMode" style="display: none;">light_mode</span>
                </button>

                <a href="{{ route('login') }}" class="px-6 py-2 text-lg font-bold rounded-full border-4 border-slate-200 text-slate-500 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 transition-all">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="bubbly-button px-6 py-2 text-lg font-bold rounded-full bg-primary text-white hover:brightness-110 transition-all shadow-orange-500/50">
                    Ayo Main!
                </a>
            </div>

            {{-- Hamburger button (mobile only) --}}
            <div class="mobile-hide-desktop">
                <button @click="mobileMenu = !mobileMenu" class="p-2 text-slate-600 dark:text-slate-300 hover:text-primary transition-colors focus:outline-none">
                    <span class="material-symbols-outlined text-4xl" x-text="mobileMenu ? 'close' : 'menu'">menu</span>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Navigation Dropdown --}}
    <div x-show="mobileMenu" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2"
         class="mobile-hide-desktop absolute top-full left-0 right-0 bg-white dark:bg-slate-900 border-b-4 border-blue-50 dark:border-slate-800 px-6 py-6 space-y-2 shadow-lg" style="display: none;">
        <div class="flex items-center justify-between mb-4 pb-4 border-b border-slate-100 dark:border-slate-800">
            <span class="text-sm font-black text-slate-400 uppercase tracking-widest">Menu</span>
            <button @click="toggleTheme()" class="p-3 rounded-2xl bg-slate-50 dark:bg-slate-800 text-slate-600 dark:text-slate-300 transition-colors flex items-center gap-2">
                <span class="material-symbols-outlined" x-show="!darkMode">dark_mode</span>
                <span class="material-symbols-outlined" x-show="darkMode">light_mode</span>
                <span class="font-bold" x-text="darkMode ? 'Mode Terang' : 'Mode Gelap'"></span>
            </button>
        </div>

        <a href="{{ route('home') }}" wire:navigate class="block px-4 py-3 rounded-xl text-lg font-bold {{ request()->routeIs('home') ? 'text-primary bg-orange-50' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} transition-colors">Beranda</a>
        <a href="{{ route('learning-path') }}" wire:navigate class="block px-4 py-3 rounded-xl text-lg font-bold {{ request()->routeIs('learning-path') ? 'text-primary bg-orange-50' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} transition-colors">Alur Belajar</a>
        <a href="{{ route('blog.index') }}" wire:navigate class="block px-4 py-3 rounded-xl text-lg font-bold {{ request()->routeIs('blog.*') ? 'text-primary bg-orange-50' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} transition-colors">Blog</a>
        <a href="{{ route('contact') }}" wire:navigate class="block px-4 py-3 rounded-xl text-lg font-bold {{ request()->routeIs('contact') ? 'text-primary bg-orange-50' : 'text-slate-600 dark:text-slate-300 hover:bg-slate-50 dark:hover:bg-slate-800' }} transition-colors">Kontak</a>
        
        <div class="pt-4 border-t border-slate-100 dark:border-slate-800 space-y-3">
            <a href="{{ route('login') }}" class="block w-full text-center px-4 py-4 rounded-2xl text-lg font-bold border-4 border-slate-100 text-slate-500 hover:bg-slate-50 dark:border-slate-800 dark:text-slate-300 dark:hover:bg-slate-800 transition-colors">Masuk</a>
            <a href="{{ route('register') }}" class="block w-full text-center px-4 py-4 rounded-2xl text-lg font-bold bg-primary text-white hover:brightness-110 transition-all shadow-lg shadow-orange-500/30">Ayo Main!</a>
        </div>
    </div>
</header>
