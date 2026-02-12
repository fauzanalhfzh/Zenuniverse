@props(['title', 'module', 'progress' => 0])

<div class="bg-white rounded-[2rem] border-4 border-slate-50 p-6 shadow-sm flex items-center gap-6 card-hover">
    <div class="size-20 rounded-2xl bg-orange-100 flex items-center justify-center flex-shrink-0">
        <span class="material-symbols-outlined text-4xl text-orange-500 font-fill-1">autoplay</span>
    </div>
    <div class="flex-1">
        <p class="text-xs font-black text-slate-400 uppercase tracking-wider mb-1">{{ $module }}</p>
        <h5 class="text-xl font-bold text-slate-800 mb-2">{{ $title }}</h5>
        <div class="flex items-center gap-4">
            <div class="flex-1 bg-slate-100 h-2.5 rounded-full overflow-hidden">
                <div class="bg-primary h-full transition-all duration-500" style="width: {{ $progress }}%"></div>
            </div>
            <span class="text-sm font-bold text-primary whitespace-nowrap">{{ $progress }}% Selesai</span>
        </div>
    </div>
    <button class="size-12 rounded-full bg-primary text-white flex items-center justify-center hover:scale-110 transition-transform">
        <span class="material-symbols-outlined font-bold">play_arrow</span>
    </button>
</div>
