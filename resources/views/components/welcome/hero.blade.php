<section class="relative px-6 py-12 md:py-24">
    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-[1fr_1.3fr] gap-12 md:gap-16 items-center">
        <div class="space-y-8 text-center lg:text-left">
            <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-white dark:bg-slate-800 shadow-md border-2 border-blue-100 dark:border-slate-700 text-primary font-bold text-lg">
                <span class="material-symbols-outlined text-xl">star</span>
                <span>Petualangan Menantimu!</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold leading-[1.1] tracking-tight text-slate-800 dark:text-white">
                Belajar Coding <br>
                <span class="text-primary">Jadi Super Seru!</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-500 dark:text-slate-400 max-w-lg mx-auto lg:mx-0 leading-relaxed font-medium">
                Jelajahi galaksi teknologi sambil bermain game! Kumpulkan lencana keren dan jadilah juara teknologi masa depan.
            </p>
            <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-6 pt-4">
                <button class="bubbly-button flex items-center justify-center gap-3 px-10 py-5 rounded-full bg-primary text-white text-2xl font-bold hover:brightness-110 transition-all">
                    Mulai Belajar 
                    <span class="material-symbols-outlined text-3xl">celebration</span>
                </button>
                <div class="flex items-center justify-center gap-3 px-8 py-4 rounded-full bg-white dark:bg-slate-800 border-4 border-blue-50 dark:border-slate-700 shadow-sm transition-colors">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full bg-orange-400 border-4 border-white dark:border-slate-800"></div>
                        <div class="w-10 h-10 rounded-full bg-purple-400 border-4 border-white dark:border-slate-800"></div>
                        <div class="w-10 h-10 rounded-full bg-sky-400 border-4 border-white dark:border-slate-800"></div>
                    </div>
                    <span class="text-lg font-bold text-slate-400 dark:text-slate-500">10rb+ Sahabat Zen</span>
                </div>
            </div>
        </div>

        <!-- Hero Image Area -->
        <div class="relative lg:scale-110 transition-transform duration-500">
            <div class="absolute inset-0 bg-blue-200/30 dark:bg-purple-900/30 blur-[100px] rounded-full"></div>
            <img src="{{ asset('images/hero.png') }}" alt="Chibi astronaut mascot" class="w-full h-full object-cover drop-shadow-2xl hover:scale-105 transition-transform duration-500">
        </div>
    </div>
</section>
