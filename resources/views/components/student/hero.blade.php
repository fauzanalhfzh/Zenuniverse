@props(['name' => 'Astronot Cilik', 'progress' => 80])

<div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 rounded-[3rem] p-10 shadow-xl overflow-hidden group mb-10">
    <div class="absolute top-0 right-0 w-full h-full">
        <div class="absolute top-10 right-20 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>
        <div class="absolute bottom-10 left-1/2 w-48 h-48 bg-blue-400/20 rounded-full blur-3xl"></div>
    </div>
    <div class="relative z-10 grid md:grid-cols-2 gap-10 items-center">
        <div class="space-y-6">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/20 backdrop-blur-sm text-white font-black text-xs uppercase tracking-widest">
                <span class="material-symbols-outlined text-sm">stars</span>
                <span>Misi Utama</span>
            </div>
            <h3 class="text-4xl md:text-5xl font-black text-white leading-tight">Welcome Back,<br><span class="text-primary italic">{{ $name }}!</span></h3>
            <p class="text-lg text-blue-100 font-medium">
                Keren! Kamu sudah menyelesaikan {{ $progress }}% misi minggu ini. Ayo jelajahi galaksi coding hari ini!
            </p>
            <button class="bubbly-button flex items-center gap-3 px-8 py-4 rounded-full bg-primary text-white text-xl font-black hover:brightness-105 transition-all">
                Mulai Misi Hari Ini
                <span class="material-symbols-outlined font-bold">rocket_launch</span>
            </button>
        </div>
        <div class="flex justify-center md:justify-end">
            <div class="relative w-full max-w-[280px] aspect-square">
                <img src="{{ asset('images/hero.png') }}" alt="Mascot" class="w-full h-full object-contain">
            </div>
        </div>
    </div>
</div>
