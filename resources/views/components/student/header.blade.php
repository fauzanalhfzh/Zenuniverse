@props(['title' => 'Beranda', 'xp' => 0, 'streak' => 0, 'level' => 1])

<header class="h-20 bg-white/80 backdrop-blur-md border-b-4 border-orange-50 flex items-center justify-between px-8 z-40 sticky top-0">
    <div class="flex items-center gap-6">
        <h2 class="text-2xl font-black text-slate-800">{{ $title }}</h2>
    </div>
    
    <div class="flex items-center gap-6">
        <div class="flex items-center gap-6 bg-white px-6 py-2 rounded-full shadow-sm border-2 border-slate-50">
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-primary font-fill-1">star</span>
                <span class="font-bold text-slate-700">{{ number_format($xp) }}</span>
            </div>
            <div class="w-px h-6 bg-slate-200"></div>
            <div class="flex items-center gap-2">
                <span class="material-symbols-outlined text-orange-600 font-fill-1">local_fire_department</span>
                <span class="font-bold text-slate-700">{{ $streak }} Hari</span>
            </div>
            <div class="w-px h-6 bg-slate-200"></div>
            <div class="flex items-center gap-2">
                <div class="size-6 rounded-lg bg-primary flex items-center justify-center">
                    <span class="text-[10px] font-black text-white">LV</span>
                </div>
                <span class="font-bold text-slate-700">{{ $level }}</span>
            </div>
        </div>  
    </div>
</header>
