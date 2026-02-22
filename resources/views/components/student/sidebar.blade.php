@props(['active' => 'dashboard'])

<aside class="w-64 bg-white border-r-4 border-orange-50 flex flex-col z-50 h-screen sticky top-0">
    <div class="p-6 flex items-center gap-3">
        <div class="relative logo-orbit">
            <div class="bg-primary size-9 rounded-xl shadow-md flex items-center justify-center">
                <span class="material-symbols-outlined text-white text-2xl">rocket_launch</span>
            </div>
            <div class="orbit-z text-[8px]">Z</div>
            <div class="orbit-u text-[8px]">U</div>
        </div>
        <h1 class="text-xl font-bold tracking-tight text-primary">ZenUniverse</h1>
    </div>

    <nav class="flex-1 mt-4 px-4 space-y-2 overflow-y-auto custom-scrollbar">
        <a href="{{ route('dashboard') }}" class="{{ ($active === 'dashboard' || $active === 'learn') ? 'sidebar-item-active' : 'text-slate-400 hover:bg-slate-50' }} flex items-center gap-4 px-4 py-3 rounded-2xl font-bold transition-colors">
            <span class="material-symbols-outlined">map</span>
            <span>Peta Belajar</span>
        </a>

        <a href="{{ route('profile') }}" class="{{ $active === 'profile' ? 'sidebar-item-active' : 'text-slate-400 hover:bg-slate-50' }} flex items-center gap-4 px-4 py-3 rounded-2xl font-bold transition-colors">
            <span class="material-symbols-outlined">person</span>
            <span>Profil</span>
        </a>
        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex items-center gap-4 px-4 py-3 rounded-2xl font-bold text-slate-400 hover:bg-red-50 hover:text-red-500 transition-colors">
                <span class="material-symbols-outlined">logout</span>
                <span>Keluar</span>
            </button>
        </form>

        <div class="pt-8 pb-4">
            <p class="px-4 text-xs font-black text-slate-300 uppercase tracking-widest mb-4">Pencapaian</p>
            <div class="px-4 py-3 bg-orange-50 rounded-2xl space-y-2">
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
                <p class="text-sm font-bold text-primary">🔥 Streak: {{ $user?->current_streak ?? 0 }} hari</p>
                <div class="w-full bg-orange-200 h-2 rounded-full overflow-hidden" title="{{ $xpProgress }} / {{ $xpTarget }} to next level">
                    <div class="bg-primary h-full transition-all" style="width: {{ $xpPercent }}%"></div>
                </div>
            </div>
        </div>
    </nav>
</aside>
