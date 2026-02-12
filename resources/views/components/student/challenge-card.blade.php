@props(['title', 'description', 'reward', 'expiry'])

<div class="bg-orange-400 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-lg h-full min-h-[400px] flex flex-col">
    <div class="absolute -top-10 -right-10 w-40 h-40 bg-white/10 rounded-full"></div>
    <div class="absolute bottom-20 -left-10 w-32 h-32 bg-orange-300/20 rounded-full"></div>
    <div class="relative z-10 space-y-6 flex-1">
        <div class="size-16 rounded-2xl bg-white/20 backdrop-blur-md flex items-center justify-center">
            <span class="material-symbols-outlined text-4xl">emoji_events</span>
        </div>
        <div>
            <h5 class="text-2xl font-black mb-2 leading-tight">{{ $title }}</h5>
            <p class="text-orange-50 font-medium">{{ $description }}</p>
        </div>
        <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-4 border border-white/20">
            <div class="flex items-center justify-between mb-2">
                <span class="text-sm font-bold">Hadiah:</span>
                <span class="flex items-center gap-1 font-black text-yellow-300">
                    <span class="material-symbols-outlined text-sm font-fill-1">star</span>
                    +{{ $reward }}
                </span>
            </div>
            <p class="text-xs text-orange-100">Berakhir dalam {{ $expiry }}</p>
        </div>
    </div>
    <button class="relative z-10 mt-6 w-full py-4 bg-white text-primary font-black rounded-2xl shadow-md hover:bg-orange-50 transition-colors">
        Ambil Tantangan
    </button>
</div>
