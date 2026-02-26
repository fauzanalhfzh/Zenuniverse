@props(['title' => 'Beranda', 'xp' => 0, 'streak' => 0, 'hearts' => 5])

@php
    $remainingSeconds = 0;
    $user = auth()->user();
    
    if ($user && $user->hearts < 5) {
        if (!$user->last_heart_replenished_at) {
            $user->last_heart_replenished_at = now();
            $user->save();
        } else {
            $secondsPassed = abs(now()->diffInSeconds($user->last_heart_replenished_at));
            if ($secondsPassed >= 300) {
                $heartsToAdd = floor($secondsPassed / 300);
                $newHearts = min(5, $user->hearts + $heartsToAdd);
                $remainderSeconds = $secondsPassed % 300;
                
                $user->hearts = $newHearts;
                if ($newHearts >= 5) {
                    $user->last_heart_replenished_at = null;
                } else {
                    $user->last_heart_replenished_at = now()->subSeconds($remainderSeconds);
                }
                $user->save();
            }
        }
    }
    
    // Refresh user model context (in case it was updated)
    $hearts = $user ? $user->hearts : 5;

    if ($user && $user->hearts < 5) {
        if ($user->last_heart_replenished_at) {
            $secondsElapsed = abs(now()->diffInSeconds($user->last_heart_replenished_at));
            // Cap to maximum 300s (5mins) to prevent weird overflow display
            $remainingSeconds = 300 - ($secondsElapsed % 300);
            if ($remainingSeconds > 300) $remainingSeconds = 300;
        } else {
            $remainingSeconds = 300;
        }
    }
@endphp

<header class="h-14 md:h-20 bg-white/80 backdrop-blur-md border-b-4 border-orange-50 flex items-center justify-between px-4 md:px-8 z-40 sticky top-0 transition-colors">
    <div class="flex items-center gap-3 md:gap-6">
        {{-- Hamburger menu removed: replaced by bottom navigation --}}
        <h2 class="text-lg md:text-2xl font-black text-slate-800 truncate">{{ $title }}</h2>
    </div>
    
    <div class="flex items-center gap-3 md:gap-6">
        <div class="flex items-center gap-3 md:gap-6 bg-white px-3 md:px-6 py-1.5 md:py-2 rounded-full shadow-sm border-2 border-slate-50 transition-colors">
            <div class="flex items-center gap-1 md:gap-2" title="Total XP">
                <span class="material-symbols-outlined text-primary font-fill-1 text-lg md:text-[24px]">star</span>
                <span class="font-bold text-slate-700 text-sm md:text-base">{{ number_format($xp) }}</span>
            </div>
            <div class="w-px h-4 md:h-6 bg-slate-200"></div>
            <div class="flex items-center gap-1 md:gap-2" title="Streak Belajar">
                <span class="material-symbols-outlined text-orange-600 font-fill-1 text-lg md:text-[24px]">local_fire_department</span>
                <span class="font-bold text-slate-700 text-sm md:text-base">{{ $streak }}<span class="hidden sm:inline"> Hari</span></span>
            </div>
            <div class="w-px h-4 md:h-6 bg-slate-200"></div>
            <div class="flex items-center gap-1 md:gap-2 relative group cursor-help">
                <span class="material-symbols-outlined text-red-500 text-lg md:text-[24px] font-variation-settings: 'FILL' 1">favorite</span>
                <span class="font-bold text-red-600 dark:text-red-400 text-sm md:text-base">{{ $hearts }}</span>
                
                @if($user && $hearts < 5)
                <div class="absolute top-full right-0 mt-4 whitespace-nowrap bg-white text-slate-700 text-xs font-bold py-2 px-4 rounded-xl border-2 border-slate-100 opacity-0 group-hover:opacity-100 transition-all pointer-events-none z-50 shadow-xl flex items-center gap-2 translate-y-2 group-hover:translate-y-0" 
                     x-data="{ seconds: Math.min({{ $remainingSeconds }}, 300) }" 
                     x-init="setInterval(() => { if(seconds > 0) seconds-- }, 1000)">
                    <span class="material-symbols-outlined text-[16px] text-red-500 animate-pulse">timer</span>
                    <span>+1 Nyawa dalam <span class="text-red-500"><span x-text="Math.floor(seconds / 60)"></span>m <span x-text="seconds % 60"></span>s</span></span>
                    
                    <!-- Triangle Pointer -->
                    <div class="absolute -top-1.5 right-4 size-3 bg-white border-t-2 border-l-2 border-slate-100 rotate-45"></div>
                </div>
                @endif
            </div>
        </div>  
    </div>
</header>
