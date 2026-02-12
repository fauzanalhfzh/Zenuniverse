<div class="space-y-12">
    <!-- Hero Section -->
    <div class="max-w-6xl mx-auto">
        <div class="relative bg-white rounded-[3rem] border-4 border-orange-100 p-10 shadow-xl overflow-hidden group">
            <div class="absolute top-0 right-0 w-1/2 h-full bg-gradient-to-l from-orange-50 to-transparent pointer-events-none"></div>
            <div class="absolute -top-10 -right-10 w-64 h-64 bg-primary/5 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 grid md:grid-cols-5 gap-10 items-center">
                <div class="md:col-span-3 space-y-6">
                    <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-orange-100 text-primary font-black text-xs uppercase tracking-widest">
                        <span class="material-symbols-outlined text-sm">rocket</span>
                        <span>Misi Belajar Saat Ini</span>
                    </div>
                    
                    <h3 class="text-4xl font-black text-slate-800 leading-tight">
                        Petualangan di Planet Logika: <span class="text-primary">Looping Seru!</span>
                    </h3>
                    
                    <p class="text-lg text-slate-500 font-medium max-w-lg">
                        Bantu si astronot cilik mengumpulkan bahan bakar dengan menggunakan perintah pengulangan yang efisien.
                    </p>
                    
                    <div class="flex flex-wrap items-center gap-6">
                        <button class="bubbly-button flex items-center gap-3 px-8 py-4 rounded-full bg-primary text-white text-xl font-black hover:brightness-105">
                            Lanjut Belajar
                            <span class="material-symbols-outlined font-bold">play_circle</span>
                        </button>
                        
                        <div class="flex items-center gap-3">
                            <div class="w-32 h-3 bg-slate-100 rounded-full overflow-hidden border border-slate-200">
                                <div class="bg-primary h-full w-[40%]"></div>
                            </div>
                            <span class="text-sm font-bold text-slate-400">40% Selesai</span>
                        </div>
                    </div>
                </div>
                
                <div class="md:col-span-2 flex justify-center">
                    <div class="relative w-full max-w-[240px] aspect-square">
                        <img alt="Mascot" class="w-full h-full object-contain animate-bounce" src="{{ asset('images/hero.png') }}" style="animation-duration: 3s"/>
                        <div class="absolute -bottom-4 -left-4 bg-white border-2 border-orange-100 p-4 rounded-3xl shadow-lg">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary">emoji_events</span>
                                <span class="text-xs font-black text-slate-600">+250 XP</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Learning Path Grid -->
    <div class="max-w-6xl mx-auto pb-12">
        <div class="flex items-center justify-between mb-8">
            <h4 class="text-3xl font-black text-slate-800">Jalur Belajarmu</h4>
            <button class="text-primary font-bold hover:underline flex items-center gap-1">
                Lihat Semua Katalog <span class="material-symbols-outlined">chevron_right</span>
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Card 1: Intro to Tech (Linked) -->
            @php
                $techStatus = $progress['intro-to-tech'] ?? 'start';
                $isTechCompleted = $techStatus === 'completed';
            @endphp
            <a href="{{ route('missions.intro-to-tech') }}" wire:navigate class="planet-card bg-white rounded-[2.5rem] border-4 border-slate-50 p-6 shadow-sm hover:shadow-md hover:border-orange-200 flex flex-col group cursor-pointer">
                <div class="size-20 rounded-3xl bg-blue-100 flex items-center justify-center mb-6 self-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-4xl text-blue-500">public</span>
                </div>
                <h5 class="text-xl font-bold text-slate-800 mb-2">Dunia Teknologi</h5>
                <p class="text-sm text-slate-500 font-medium mb-6 flex-1">Pengenalan seru tentang apa itu teknologi.</p>
                <div class="space-y-3 mt-auto">
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-slate-400">Status</span>
                        <span @class(['text-primary', 'text-green-500' => $isTechCompleted])>
                            {{ $isTechCompleted ? 'Selesai ✅' : 'Mulai Baru' }}
                        </span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                        <div @class(['h-full w-0 transition-all duration-1000', 'bg-slate-200' => !$isTechCompleted, 'bg-green-500 w-full' => $isTechCompleted])></div>
                    </div>
                </div>
            </a>

            <!-- Unit 2: Dasar Internet -->
            @php
                $netStatus = $progress['intro-to-internet'] ?? 'start';
                $isNetCompleted = $netStatus === 'completed';
            @endphp
            <a href="{{ route('missions.intro-to-internet') }}" wire:navigate class="planet-card bg-white rounded-[2.5rem] border-4 border-slate-50 p-6 shadow-sm hover:shadow-md hover:border-blue-200 flex flex-col group cursor-pointer">
                <div class="size-20 rounded-3xl bg-blue-100 flex items-center justify-center mb-6 self-center group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-4xl text-blue-500">language</span>
                </div>
                <h5 class="text-xl font-bold text-slate-800 mb-2 font-black">Dasar Internet</h5>
                <p class="text-sm text-slate-500 font-medium mb-6 flex-1 font-bold">Jelajahi Dunia Maya dan cara kerjanya.</p>
                <div class="space-y-3 mt-auto">
                    <div class="flex justify-between text-xs font-bold">
                        <span class="text-slate-400">Status</span>
                        <span @class(['text-primary font-black', 'text-green-500' => $isNetCompleted])>
                            {{ $isNetCompleted ? 'Selesai ✅' : 'Mulai Baru' }}
                        </span>
                    </div>
                    <div class="w-full h-2.5 bg-slate-100 rounded-full overflow-hidden">
                        <div @class(['h-full w-0 transition-all duration-1000', 'bg-slate-200' => !$isNetCompleted, 'bg-green-500 w-full' => $isNetCompleted])></div>
                    </div>
                </div>
            </a>
        </div>
        </div>
    </div>
</div>
