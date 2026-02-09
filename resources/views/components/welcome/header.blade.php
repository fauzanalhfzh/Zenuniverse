<header class="fixed top-0 w-full z-50 bg-white/70 dark:bg-slate-900/80 backdrop-blur-lg border-b-4 border-blue-50 dark:border-slate-800 transition-colors duration-300">
    <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
        <div class="flex items-center gap-3 cursor-pointer" onclick="Livewire.navigate('{{ route('home') }}')">
            <div class="bg-primary p-2 rounded-2xl shadow-lg">
                <span class="material-symbols-outlined text-white text-3xl">rocket_launch</span>
            </div>
            <!-- Text Color fixed for dark mode -->
            <h2 class="text-3xl font-bold tracking-tight text-primary">ZenUniverse</h2>
        </div>
        
        <nav class="hidden md:flex items-center gap-10">
            <a class="text-lg font-bold {{ request()->routeIs('home') ? 'text-primary' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary' }} transition-colors" href="{{ route('home') }}" wire:navigate>Beranda</a>
            <a class="text-lg font-bold {{ request()->routeIs('about') ? 'text-primary border-b-4 border-primary' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary' }} transition-colors" href="{{ route('about') }}" wire:navigate>Tentang Kami</a>
            <a class="text-lg font-bold {{ request()->routeIs('learning-path') ? 'text-primary border-b-4 border-primary' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary' }} transition-colors" href="{{ route('learning-path') }}" wire:navigate>Alur Belajar</a>
            <a class="text-lg font-bold {{ request()->routeIs('blog.*') ? 'text-primary border-b-4 border-primary' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary' }} transition-colors" href="{{ route('blog.index') }}" wire:navigate>Blog</a>
            <a class="text-lg font-bold {{ request()->routeIs('contact') ? 'text-primary border-b-4 border-primary' : 'text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary' }} transition-colors" href="{{ route('contact') }}" wire:navigate>Kontak</a>
        </nav>

        <div class="flex items-center gap-4">
            <!-- Dark Mode Toggle Button (Alpine Integration) -->
            <button @click="toggleTheme()" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors text-slate-600 dark:text-slate-300" aria-label="Toggle Dark Mode">
                <span class="material-symbols-outlined" x-show="!darkMode">dark_mode</span>
                <span class="material-symbols-outlined" x-show="darkMode" style="display: none;">light_mode</span>
            </button>

            <a href="{{ route('login') }}" class="hidden sm:flex px-6 py-2 text-lg font-bold rounded-full border-4 border-slate-200 text-slate-500 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 transition-all">
                Masuk
            </a>
            <a href="{{ route('register') }}" class="bubbly-button px-6 py-2 text-lg font-bold rounded-full bg-primary text-white hover:brightness-110 transition-all shadow-orange-500/50">
                Ayo Main!
            </a>
        </div>
    </div>
</header>
