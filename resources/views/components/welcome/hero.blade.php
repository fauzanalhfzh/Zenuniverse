<section class="relative px-6 pt-16 pb-12 md:pt-28 md:pb-20 overflow-hidden" x-data="{ shown: false }" x-init="setTimeout(() => shown = true, 100)">
    {{-- Decorative background accents --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[800px] bg-gradient-radial from-orange-100/60 via-transparent to-transparent dark:from-orange-900/20 rounded-full blur-3xl -z-10 pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-gradient-radial from-indigo-100/40 via-transparent to-transparent dark:from-indigo-900/15 rounded-full blur-3xl -z-10 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto">
        {{-- Top Section: Main Hero --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 md:gap-16 items-center">
            {{-- Left: Content --}}
            <div class="space-y-7 text-center lg:text-left order-2 lg:order-1"
                 x-show="shown"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-y-8"
                 x-transition:enter-end="opacity-100 translate-y-0">

                {{-- Trust Badge --}}
                <div class="inline-flex items-center gap-2.5 px-5 py-2 rounded-full bg-white/80 dark:bg-slate-800/80 backdrop-blur-sm shadow-sm border border-orange-100 dark:border-slate-700 text-sm font-bold text-primary">
                    <span class="flex items-center justify-center w-5 h-5 rounded-full bg-green-400 shadow-sm">
                        <span class="material-symbols-outlined text-white text-xs">check</span>
                    </span>
                    <span>Platform belajar coding interaktif #1 untuk pemula</span>
                </div>

                {{-- Main Headline --}}
                <h1 class="text-4xl sm:text-5xl md:text-6xl lg:text-[3.5rem] xl:text-6xl font-extrabold leading-[1.1] tracking-tight text-slate-800 dark:text-white">
                    Kuasai Coding
                    <span class="relative inline-block">
                        <span class="text-primary">Tanpa Ribet,</span>
                        <svg class="absolute -bottom-1 left-0 w-full" viewBox="0 0 200 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 5.5C30 2 70 2 100 4C130 6 170 3 198 5" stroke="#ff8a3d" stroke-width="3" stroke-linecap="round" opacity="0.4"/>
                        </svg>
                    </span>
                    <br class="hidden sm:block">
                    Langsung Praktik.
                </h1>

                {{-- Value Proposition --}}
                <p class="text-lg md:text-xl text-slate-500 dark:text-slate-400 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                    Belajar programming dari nol dengan metode <strong class="text-slate-700 dark:text-slate-300">gamifikasi</strong> — selesaikan misi, kumpulkan poin, dan bangun skill coding kamu langkah demi langkah. Cocok untuk pelajar, mahasiswa, maupun kamu yang ingin switch career.
                </p>

                {{-- Key Benefits (micro info) --}}
                <div class="flex flex-wrap justify-center lg:justify-start gap-x-6 gap-y-3 text-sm font-semibold text-slate-500 dark:text-slate-400">
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-green-500 text-lg font-fill-1">check_circle</span>
                        <span>Gratis untuk mulai</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-green-500 text-lg font-fill-1">check_circle</span>
                        <span>Belajar sambil bermain</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-green-500 text-lg font-fill-1">check_circle</span>
                        <span>Raih sertifikat</span>
                    </div>
                </div>

                {{-- CTA Buttons --}}
                <div class="flex flex-col sm:flex-row justify-center lg:justify-start gap-4 pt-2">
                    <a href="{{ route('register') }}" class="bubbly-button group flex items-center justify-center gap-3 px-8 py-4 rounded-2xl bg-primary text-white text-lg font-bold hover:brightness-110 transition-all">
                        Mulai Belajar Gratis
                        <span class="material-symbols-outlined text-2xl group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </a>
                    <a href="{{ route('learning-path') }}" wire:navigate class="flex items-center justify-center gap-2.5 px-8 py-4 rounded-2xl bg-white dark:bg-slate-800 border-2 border-slate-200 dark:border-slate-700 text-slate-600 dark:text-slate-300 text-lg font-bold hover:border-primary/40 hover:text-primary transition-all">
                        <span class="material-symbols-outlined text-xl">play_circle</span>
                        Lihat Alur Belajar
                    </a>
                </div>

                {{-- Social Proof --}}
                <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 pt-2">
                    <div class="flex items-center gap-3">
                        <div class="flex -space-x-2.5">
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-orange-400 to-orange-500 border-2 border-white dark:border-slate-800 flex items-center justify-center">
                                <span class="text-white text-xs font-bold">A</span>
                            </div>
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-purple-400 to-purple-500 border-2 border-white dark:border-slate-800 flex items-center justify-center">
                                <span class="text-white text-xs font-bold">R</span>
                            </div>
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-sky-400 to-sky-500 border-2 border-white dark:border-slate-800 flex items-center justify-center">
                                <span class="text-white text-xs font-bold">D</span>
                            </div>
                            <div class="w-9 h-9 rounded-full bg-gradient-to-br from-emerald-400 to-emerald-500 border-2 border-white dark:border-slate-800 flex items-center justify-center">
                                <span class="text-white text-xs font-bold">+</span>
                            </div>
                        </div>
                        <div class="text-left">
                            <p class="text-sm font-bold text-slate-700 dark:text-slate-200">10,000+ pelajar aktif</p>
                            <div class="flex items-center gap-1">
                                @for ($i = 0; $i < 5; $i++)
                                    <span class="material-symbols-outlined text-amber-400 text-sm font-fill-1">star</span>
                                @endfor
                                <span class="text-xs font-semibold text-slate-400 ml-1">4.9/5 rating</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right: Hero Visual --}}
            <div class="relative order-1 lg:order-2 flex items-center justify-center"
                 x-show="shown"
                 x-transition:enter="transition ease-out duration-700 delay-200"
                 x-transition:enter-start="opacity-0 scale-95"
                 x-transition:enter-end="opacity-100 scale-100">

                {{-- Floating decorative elements --}}
                <div class="absolute -top-6 -left-4 md:top-2 md:left-4 z-20">
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 px-4 py-3 flex items-center gap-3 floating-element" style="animation-delay: 0.5s;">
                        <div class="w-10 h-10 rounded-xl bg-green-100 dark:bg-green-900/30 flex items-center justify-center">
                            <span class="material-symbols-outlined text-green-500 text-xl">trending_up</span>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-400">Progress</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-white">+85% skill naik</p>
                        </div>
                    </div>
                </div>

                <div class="absolute -bottom-2 -right-2 md:bottom-8 md:right-0 z-20">
                    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border border-slate-100 dark:border-slate-700 px-4 py-3 flex items-center gap-3 floating-element" style="animation-delay: 1.5s;">
                        <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                            <span class="material-symbols-outlined text-secondary text-xl">emoji_events</span>
                        </div>
                        <div>
                            <p class="text-xs font-semibold text-slate-400">Lencana</p>
                            <p class="text-sm font-bold text-slate-700 dark:text-white">50+ badge diraih</p>
                        </div>
                    </div>
                </div>

                {{-- Main Image --}}
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-br from-orange-200/40 via-transparent to-indigo-200/40 dark:from-orange-900/20 dark:to-indigo-900/20 blur-[80px] rounded-full scale-110"></div>
                    <img src="{{ asset('images/hero.png') }}" alt="ZenUniverse mascot - belajar coding interaktif"
                         class="relative w-full max-w-md lg:max-w-lg xl:max-w-xl h-auto object-contain drop-shadow-2xl hover:scale-[1.03] transition-transform duration-500">
                </div>
            </div>
        </div>

        {{-- Bottom: Quick Stats Bar --}}
        <div class="mt-14 md:mt-20 grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6"
             x-show="shown"
             x-transition:enter="transition ease-out duration-700 delay-500"
             x-transition:enter-start="opacity-0 translate-y-6"
             x-transition:enter-end="opacity-100 translate-y-0">

            <div class="group bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm rounded-2xl border border-slate-100 dark:border-slate-700 p-5 text-center hover:border-primary/30 hover:shadow-lg hover:shadow-primary/5 transition-all duration-300 cursor-default">
                <div class="w-12 h-12 rounded-xl bg-orange-50 dark:bg-orange-900/20 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-primary text-2xl">school</span>
                </div>
                <p class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white">7+</p>
                <p class="text-sm font-semibold text-slate-400 mt-1">Kursus Lengkap</p>
            </div>

            <div class="group bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm rounded-2xl border border-slate-100 dark:border-slate-700 p-5 text-center hover:border-secondary/30 hover:shadow-lg hover:shadow-secondary/5 transition-all duration-300 cursor-default">
                <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-900/20 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-secondary text-2xl">extension</span>
                </div>
                <p class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white">100+</p>
                <p class="text-sm font-semibold text-slate-400 mt-1">Misi Interaktif</p>
            </div>

            <div class="group bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm rounded-2xl border border-slate-100 dark:border-slate-700 p-5 text-center hover:border-green-400/30 hover:shadow-lg hover:shadow-green-400/5 transition-all duration-300 cursor-default">
                <div class="w-12 h-12 rounded-xl bg-green-50 dark:bg-green-900/20 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-green-500 text-2xl">verified</span>
                </div>
                <p class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white">100%</p>
                <p class="text-sm font-semibold text-slate-400 mt-1">Gratis Selamanya</p>
            </div>

            <div class="group bg-white/70 dark:bg-slate-800/70 backdrop-blur-sm rounded-2xl border border-slate-100 dark:border-slate-700 p-5 text-center hover:border-amber-400/30 hover:shadow-lg hover:shadow-amber-400/5 transition-all duration-300 cursor-default">
                <div class="w-12 h-12 rounded-xl bg-amber-50 dark:bg-amber-900/20 flex items-center justify-center mx-auto mb-3 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined text-amber-500 text-2xl">workspace_premium</span>
                </div>
                <p class="text-2xl md:text-3xl font-extrabold text-slate-800 dark:text-white">Resmi</p>
                <p class="text-sm font-semibold text-slate-400 mt-1">Sertifikat Digital</p>
            </div>
        </div>
    </div>
</section>
