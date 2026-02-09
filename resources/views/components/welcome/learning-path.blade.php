<section class="py-24 px-6 relative bg-blue-50/30 dark:bg-slate-900/50">
    <div class="max-w-4xl mx-auto relative">
        <div class="text-center mb-20">
            <h2 class="text-5xl font-black tracking-tight mb-4 text-slate-800 dark:text-white">Petualangan Belajarmu</h2>
            <p class="text-2xl text-slate-500 dark:text-slate-400 font-medium">Lewati rintangan dan jadi Master Teknologi!</p>
        </div>
        
        <div class="flex flex-col items-center gap-10">
            <!-- Step 1 -->
            <div class="relative group cursor-pointer">
                <div class="size-32 rounded-full bg-primary flex items-center justify-center shadow-xl border-8 border-white dark:border-slate-800 group-hover:scale-110 transition-transform z-10 relative">
                    <span class="material-symbols-outlined text-6xl text-white">child_care</span>
                </div>
                <div class="absolute -right-52 top-1/2 -translate-y-1/2 hidden md:block opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="font-bold text-2xl text-primary bg-white dark:bg-slate-800 px-8 py-3 rounded-full shadow-lg border-2 border-primary/20 whitespace-nowrap">Planet Dasar</p>
                </div>
            </div>
            
            <div class="w-4 h-20 bg-primary/20 rounded-full"></div>
            
            <!-- Step 2 -->
            <div class="relative group cursor-pointer">
                <div class="size-32 rounded-full bg-secondary flex items-center justify-center shadow-xl border-8 border-white dark:border-slate-800 group-hover:scale-110 transition-transform z-10 relative">
                    <span class="material-symbols-outlined text-6xl text-white">code</span>
                </div>
                <div class="absolute -left-52 top-1/2 -translate-y-1/2 hidden md:block opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    <p class="font-bold text-2xl text-secondary bg-white dark:bg-slate-800 px-8 py-3 rounded-full shadow-lg border-2 border-secondary/20 whitespace-nowrap">Lembah Koding</p>
                </div>
            </div>
            
            <div class="w-4 h-20 bg-slate-200 dark:bg-slate-700 rounded-full"></div>
            
            <!-- Step 3 (Locked) -->
            <div class="relative opacity-50 hover:opacity-100 transition-opacity duration-300">
                <div class="size-32 rounded-full bg-slate-300 dark:bg-slate-600 flex items-center justify-center shadow-xl border-8 border-white dark:border-slate-800">
                    <span class="material-symbols-outlined text-6xl text-white">lock</span>
                </div>
                <div class="absolute -right-52 top-1/2 -translate-y-1/2 hidden md:block">
                    <p class="font-bold text-2xl text-slate-400 bg-white dark:bg-slate-800 dark:text-slate-500 px-8 py-3 rounded-full shadow-md border-2 border-slate-100 dark:border-slate-700 whitespace-nowrap">Galaksi Master</p>
                </div>
            </div>

            <a href="{{ route('register') }}" class="bubbly-button mt-12 px-12 py-6 rounded-full bg-primary text-white text-3xl font-black hover:scale-105 transition-all">
                Ayo Meluncur!
            </a>
        </div>
    </div>
</section>
