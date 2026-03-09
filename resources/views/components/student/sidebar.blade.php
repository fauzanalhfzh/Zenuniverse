@props(['active' => 'dashboard'])

<aside class="w-64 bg-white dark:bg-slate-800 border-r-4 border-orange-50 dark:border-slate-700 transition-colors duration-300 hidden lg:flex flex-col z-50 h-screen sticky top-0">
    <div class="p-6 flex items-center justify-between">
        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.jpeg') }}" alt="ZenUniverse Logo" class="h-10 w-auto object-contain rounded-xl">
            <h1 class="text-xl font-bold tracking-tight text-primary">ZenUniverse</h1>
        </div>
        {{-- Close button removed: sidebar is desktop-only now --}}
    </div>

    <nav class="flex-1 mt-4 px-4 space-y-2 overflow-y-auto custom-scrollbar">
        <a href="{{ route('dashboard') }}" class="{{ ($active === 'dashboard' || $active === 'learn') ? 'sidebar-item-active' : 'text-slate-400 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-700' }} flex items-center gap-4 px-4 py-3 rounded-2xl font-bold transition-colors duration-300">
            <span class="material-symbols-outlined">map</span>
            <span>Peta Belajar</span>
        </a>

        <a href="{{ route('profile') }}" class="{{ $active === 'profile' ? 'sidebar-item-active' : 'text-slate-400 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-700' }} flex items-center gap-4 px-4 py-3 rounded-2xl font-bold transition-colors duration-300">
            <span class="material-symbols-outlined">person</span>
            <span>Profil</span>
        </a>
    </nav>
    
    <div class="p-4 border-t-2 border-slate-50 dark:border-slate-700 space-y-2 transition-colors duration-300">
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl font-bold text-slate-400 dark:text-slate-500 hover:bg-red-50 dark:hover:bg-red-900/30 hover:text-red-500 transition-colors duration-300">
                <span class="material-symbols-outlined">logout</span>
                <span>Keluar</span>
            </button>
        </form>

        <button @click="toggleTheme()" class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl font-bold text-slate-400 dark:text-slate-500 hover:bg-slate-50 dark:hover:bg-slate-700 hover:text-primary dark:hover:text-primary transition-colors duration-300 focus:outline-none">
            <span class="material-symbols-outlined" x-text="darkMode ? 'light_mode' : 'dark_mode'">dark_mode</span>
            <span x-text="darkMode ? 'Mode Terang' : 'Mode Gelap'">Mode Gelap</span>
        </button>

        <div class="pt-4 pb-2">
            <p class="px-4 text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest mb-3 transition-colors duration-300">Pencapaian</p>
            <div class="px-4 py-3 bg-orange-50 dark:bg-orange-900/20 rounded-xl space-y-2 transition-colors duration-300">
                @php
                    $user = auth()->user();
                    $currentXp = $user?->total_xp ?? 0;
                    $baseLevelXp = $user?->currentLevel?->xp_required ?? 0;
                    
                    $nextLevel = \App\Models\Level::where('order', '>', $user?->currentLevel?->order ?? 0)
                        ->orderBy('order')
                        ->first();
                        
                    $nextLevelXp = $nextLevel ? $nextLevel->xp_required : ($currentXp + 1000);
                    $xpProgress = max(0, $currentXp - $baseLevelXp);
                    $xpTarget = max(1, $nextLevelXp - $baseLevelXp);
                    $xpPercent = min(100, ($xpProgress / $xpTarget) * 100);
                @endphp
                <p class="text-xs font-bold text-primary dark:text-orange-400">🔥 Streak: {{ $user?->current_streak ?? 0 }} hari</p>
                <div class="w-full bg-orange-200 h-1.5 rounded-full overflow-hidden" title="{{ $xpProgress }} / {{ $xpTarget }} to next level">
                    <div class="bg-primary dark:bg-orange-400 h-full transition-all" style="width: {{ $xpPercent }}%"></div>
                </div>
            </div>
        </div>
    </div>
</aside>
