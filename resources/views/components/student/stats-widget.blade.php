@props(['xp' => 0, 'streak' => 0, 'hearts' => 5])

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

<div class="bg-white dark:bg-slate-800 rounded-2xl border-2 border-slate-100 dark:border-slate-700 p-5 flex flex-col gap-4 transition-colors duration-300">
    <div class="flex items-center justify-between">
        <p class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Statistikmu</p>
    </div>
    
    <div class="flex items-center justify-between gap-2">
        <div class="flex flex-col items-center flex-1 justify-center relative group cursor-help" title="Total XP">
            <span class="material-symbols-outlined text-primary font-fill-1 text-3xl mb-1">star</span>
            <span class="font-bold text-slate-700 dark:text-slate-200">{{ number_format($xp) }}</span>
            <span class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase">XP</span>
        </div>
        
        <div class="w-px h-10 bg-slate-100 dark:bg-slate-700 transition-colors duration-300"></div>
        
        <div class="flex flex-col items-center flex-1 justify-center relative group cursor-help" title="Streak Belajar">
            <span class="material-symbols-outlined text-orange-600 font-fill-1 text-3xl mb-1">local_fire_department</span>
            <span class="font-bold text-slate-700 dark:text-slate-200">{{ $streak }}</span>
            <span class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase">Hari</span>
        </div>
        
        <div class="w-px h-10 bg-slate-100 dark:bg-slate-700 transition-colors duration-300"></div>
        
        <div class="flex flex-col items-center flex-1 justify-center relative group cursor-help" title="Nyawa Tersisa">
            <span class="material-symbols-outlined text-red-500 text-3xl mb-1 font-variation-settings: 'FILL' 1">favorite</span>
            <span class="font-bold text-red-600 dark:text-red-400">{{ $hearts }}</span>
            <span class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase">Nyawa</span>
            
            @if($user && $hearts < 5)
            <div class="absolute top-full right-1/2 translate-x-1/2 mt-2 whitespace-nowrap bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-300 text-xs font-bold py-2 px-4 rounded-xl border-2 border-slate-100 dark:border-slate-700 opacity-0 group-hover:opacity-100 transition-all pointer-events-none z-50 shadow-xl flex items-center gap-2 translate-y-2 group-hover:translate-y-0" 
                 x-data="{ seconds: Math.min({{ $remainingSeconds }}, 300) }" 
                 x-init="setInterval(() => { if(seconds > 0) seconds-- }, 1000)">
                <span class="material-symbols-outlined text-[16px] text-red-500 animate-pulse">timer</span>
                <span>+1 Nyawa dalam <span class="text-red-500"><span x-text="Math.floor(seconds / 60)"></span>m <span x-text="seconds % 60"></span>s</span></span>
                
                <!-- Triangle Pointer -->
                <div class="absolute -top-1.5 left-1/2 -translate-x-1/2 size-3 bg-white dark:bg-slate-800 border-t-2 border-l-2 border-slate-100 dark:border-slate-700 rotate-45 transition-colors duration-300"></div>
            </div>
            @endif
        </div>
    </div>
</div>
