<x-layouts.landing title="ZenUniverse: Peta Penjelajahanmu">
    <x-slot:title>
        ZenUniverse: Peta Penjelajahanmu
    </x-slot>

    <style>
        .planet-glow {
            filter: drop-shadow(0 0 15px rgba(255, 255, 255, 0.8));
        }
        .path-line {
            background-image: linear-gradient(to bottom, #cbd5e1 50%, transparent 50%);
            background-size: 8px 16px;
        }
        .floating-object {
            animation: floating 3s ease-in-out infinite;
        }
        @keyframes floating {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>

    <div class="fixed inset-0 pointer-events-none z-0">
        <div class="absolute top-20 left-10 w-32 h-32 bg-white/40 rounded-full blur-2xl"></div>
        <div class="absolute bottom-40 right-10 w-48 h-48 bg-blue-100/50 rounded-full blur-3xl"></div>
        <div class="absolute top-1/2 left-1/4 w-4 h-4 bg-yellow-400 rounded-full animate-pulse"></div>
        <div class="absolute top-1/4 right-1/3 w-3 h-3 bg-white rounded-full"></div>
    </div>

    <div class="max-w-5xl mx-auto px-6 pt-10 pb-24 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-white shadow-md border-2 border-blue-100 text-primary font-bold text-lg mb-6">
                <span class="material-symbols-outlined text-xl">map</span>
                <span>Rencana Perjalanan Ruang Angkasamu</span>
            </div>
            <h1 class="text-5xl md:text-6xl font-black text-slate-800 mb-6">Peta Penjelajahanmu</h1>
            <p class="text-xl md:text-2xl text-slate-500 max-w-2xl mx-auto font-medium">
                Selesaikan misi di setiap planet untuk naik level dan dapatkan hadiah keren!
            </p>
        </div>

        <div class="relative">
            <!-- Central Line -->
            <div class="absolute left-1/2 -translate-x-1/2 top-0 bottom-0 w-4 path-line rounded-full opacity-30"></div>
            
            <div class="space-y-24 relative">
                <!-- Level 1: Cadet -->
                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-0">
                    <div class="flex-1 md:text-right md:pr-12 order-2 md:order-1">
                        <div class="bg-white p-6 rounded-3xl shadow-xl border-4 border-sky-100 inline-block max-w-md">
                            <h3 class="text-2xl font-black text-cadet-blue mb-2">Level 1: Cadet</h3>
                            <p class="text-slate-500 font-medium mb-4">Mulai perjalananmu mengenal dasar-dasar teknologi dan algoritma sederhana.</p>
                            <div class="flex flex-wrap gap-2 md:justify-end">
                                <span class="px-3 py-1 bg-sky-50 text-sky-600 rounded-full text-sm font-bold">Logika Dasar</span>
                                <span class="px-3 py-1 bg-sky-50 text-sky-600 rounded-full text-sm font-bold">Puzzle</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10 order-1 md:order-2">
                        <div class="size-32 md:size-40 rounded-full bg-cadet-blue border-8 border-white shadow-2xl flex items-center justify-center planet-glow floating-object">
                            <span class="material-symbols-outlined text-white text-6xl">child_care</span>
                        </div>
                        <div class="absolute -top-4 -right-4 bg-yellow-400 text-white p-2 rounded-full shadow-lg border-2 border-white">
                            <span class="material-symbols-outlined">check</span>
                        </div>
                    </div>
                    <div class="flex-1 md:pl-12 order-3">
                        <div class="flex items-center gap-4">
                            <div class="size-16 rounded-2xl bg-sky-100 flex items-center justify-center">
                                <span class="material-symbols-outlined text-cadet-blue text-4xl">military_tech</span>
                            </div>
                            <span class="text-xl font-bold text-slate-700">Lencana Cadet</span>
                        </div>
                    </div>
                </div>

                <!-- Level 2: Explorer -->
                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-0">
                    <div class="flex-1 md:pr-12 order-3 md:order-1 flex md:justify-end">
                        <div class="flex items-center gap-4">
                            <span class="text-xl font-bold text-slate-700">Kostum Explorer</span>
                            <div class="size-16 rounded-2xl bg-green-100 flex items-center justify-center">
                                <span class="material-symbols-outlined text-green-500 text-4xl">apparel</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10 order-1 md:order-2">
                        <div class="size-32 md:size-40 rounded-full bg-explorer-green border-8 border-white shadow-2xl flex items-center justify-center planet-glow floating-object" style="animation-delay: 0.5s">
                            <span class="material-symbols-outlined text-white text-6xl">explore</span>
                        </div>
                        <div class="absolute -top-2 -left-2 bg-primary text-white px-3 py-1 rounded-full text-sm font-bold shadow-lg border-2 border-white">SEDANG BERJALAN</div>
                    </div>
                    <div class="flex-1 md:pl-12 order-2 md:order-3">
                        <div class="bg-white p-6 rounded-3xl shadow-xl border-4 border-green-100 inline-block max-w-md">
                            <h3 class="text-2xl font-black text-explorer-green mb-2">Level 2: Explorer</h3>
                            <p class="text-slate-500 font-medium mb-4">Belajar membuat animasi dan game sederhana yang seru bareng teman-teman.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-sm font-bold">Animasi</span>
                                <span class="px-3 py-1 bg-green-50 text-green-600 rounded-full text-sm font-bold">Game Maker</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Level 3: Tech Expert -->
                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-0 opacity-60 grayscale">
                    <div class="flex-1 md:text-right md:pr-12 order-2 md:order-1">
                        <div class="bg-white p-6 rounded-3xl shadow-lg border-4 border-purple-50 inline-block max-w-md">
                            <h3 class="text-2xl font-black text-expert-purple mb-2">Level 3: Tech Expert</h3>
                            <p class="text-slate-500 font-medium mb-4">Saatnya membangun aplikasi pertama kamu dan memecahkan masalah nyata.</p>
                            <div class="flex flex-wrap gap-2 md:justify-end">
                                <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-sm font-bold">App Builder</span>
                                <span class="px-3 py-1 bg-purple-50 text-purple-600 rounded-full text-sm font-bold">Database</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10 order-1 md:order-2">
                        <div class="size-32 md:size-40 rounded-full bg-expert-purple border-8 border-white shadow-2xl flex items-center justify-center planet-glow">
                            <span class="material-symbols-outlined text-white text-6xl">psychology</span>
                        </div>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                            <span class="material-symbols-outlined text-white/50 text-5xl">lock</span>
                        </div>
                    </div>
                    <div class="flex-1 md:pl-12 order-3">
                        <div class="flex items-center gap-4">
                            <div class="size-16 rounded-2xl bg-purple-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-purple-400 text-4xl">robot</span>
                            </div>
                            <span class="text-xl font-bold text-slate-400">Pet Robot Baru</span>
                        </div>
                    </div>
                </div>

                <!-- Level 4: Galaxy Master -->
                <div class="flex flex-col md:flex-row items-center gap-8 md:gap-0 opacity-60 grayscale">
                    <div class="flex-1 md:pr-12 order-3 md:order-1 flex md:justify-end">
                        <div class="flex items-center gap-4">
                            <span class="text-xl font-bold text-slate-400">Sertifikat Master</span>
                            <div class="size-16 rounded-2xl bg-amber-50 flex items-center justify-center">
                                <span class="material-symbols-outlined text-master-gold text-4xl">workspace_premium</span>
                            </div>
                        </div>
                    </div>
                    <div class="relative z-10 order-1 md:order-2">
                        <div class="size-32 md:size-40 rounded-full bg-master-gold border-8 border-white shadow-2xl flex items-center justify-center planet-glow">
                            <span class="material-symbols-outlined text-white text-6xl">auto_awesome</span>
                        </div>
                        <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                            <span class="material-symbols-outlined text-white/50 text-5xl">lock</span>
                        </div>
                    </div>
                    <div class="flex-1 md:pl-12 order-2 md:order-3">
                        <div class="bg-white p-6 rounded-3xl shadow-lg border-4 border-amber-50 inline-block max-w-md">
                            <h3 class="text-2xl font-black text-master-gold mb-2">Level 4: Galaxy Master</h3>
                            <p class="text-slate-500 font-medium mb-4">Puncak kejayaan! Kamu sudah siap jadi mentor dan memimpin proyek besar.</p>
                            <div class="flex flex-wrap gap-2">
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-sm font-bold">Cyber Security</span>
                                <span class="px-3 py-1 bg-amber-50 text-amber-600 rounded-full text-sm font-bold">AI Dasar</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-24 p-12 bg-white rounded-[3rem] border-8 border-blue-50 shadow-2xl text-center relative overflow-hidden">
            <div class="absolute -top-10 -right-10 w-40 h-40 bg-primary/10 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <h2 class="text-4xl font-black text-slate-800 mb-4">Sistem Hadiah Bintang</h2>
                <p class="text-xl text-slate-500 mb-10 max-w-2xl mx-auto font-medium">
                    Setiap kamu menyelesaikan misi, kamu akan mendapatkan Koin Bintang yang bisa ditukar di Toko Keren!
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="p-6 rounded-2xl bg-blue-50 border-2 border-blue-100">
                        <span class="material-symbols-outlined text-4xl text-primary mb-2">task_alt</span>
                        <p class="font-bold text-slate-700">Selesaikan Misi</p>
                        <p class="text-sm text-slate-500">+100 Koin</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-blue-50 border-2 border-blue-100">
                        <span class="material-symbols-outlined text-4xl text-secondary mb-2">group</span>
                        <p class="font-bold text-slate-700">Bantu Teman</p>
                        <p class="text-sm text-slate-500">+50 Koin</p>
                    </div>
                    <div class="p-6 rounded-2xl bg-blue-50 border-2 border-blue-100">
                        <span class="material-symbols-outlined text-4xl text-green-500 mb-2">calendar_today</span>
                        <p class="font-bold text-slate-700">Belajar Tiap Hari</p>
                        <p class="text-sm text-slate-500">+20 Koin</p>
                    </div>
                </div>
                <button class="bubbly-button mt-12 px-12 py-5 rounded-full bg-primary text-white text-2xl font-black hover:brightness-110 transition-all">
                    Ayo Lanjutkan Misi!
                </button>
            </div>
        </div>
    </div>
</x-layouts.landing>
