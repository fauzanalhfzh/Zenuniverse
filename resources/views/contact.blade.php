<x-layouts.landing title="ZenUniverse: Hubungi Pusat Kendali">
    <main class="pt-32 pb-24 px-6 relative overflow-hidden">
        <!-- Floating Decorative Elements -->
        <div class="absolute top-40 right-[5%] w-32 h-32 rounded-full bg-pink-100/50 dark:bg-pink-900/20 blur-2xl"></div>
        <div class="absolute bottom-20 left-[10%] w-48 h-48 rounded-full bg-blue-100/50 dark:bg-blue-900/20 blur-2xl"></div>

        <div class="max-w-7xl mx-auto">
            <!-- Header Section -->
            <div class="text-center mb-16 space-y-4">
                <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-white dark:bg-slate-800 shadow-md border-2 border-blue-100 dark:border-slate-700 text-primary font-bold text-lg">
                    <span class="material-symbols-outlined text-xl">satellite_alt</span>
                    <span>Transmisi Terbuka</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-black text-slate-800 dark:text-white tracking-tight">
                    Hubungi <span class="text-primary">Pusat Kendali</span>
                </h1>
                <p class="text-xl md:text-2xl text-slate-500 dark:text-slate-400 font-medium">Ada pertanyaan atau butuh bantuan astronaut? Kirim sinyalmu ke sini!</p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">
                <!-- Info Sidebar -->
                <div class="lg:col-span-4 space-y-8">
                    <!-- Mascot Card -->
                    <div class="station-card bg-white dark:bg-slate-800 p-8 relative group">
                        <div class="absolute -top-12 -left-6 floating-element">
                            <div class="bg-yellow-400 p-4 rounded-3xl shadow-xl border-4 border-white dark:border-slate-700">
                                <span class="material-symbols-outlined text-white text-4xl">mark_email_unread</span>
                            </div>
                        </div>
                        <div class="space-y-6">
                            <div class="aspect-square bg-sky-50 dark:bg-sky-900/30 rounded-[2.5rem] border-4 border-dashed border-sky-200 dark:border-sky-800 flex items-center justify-center overflow-hidden">
                                <img alt="Chibi astronaut mascot" class="w-4/5 h-4/5 object-contain drop-shadow-xl" src="{{ asset('images/hero.png') }}"/>
                            </div>
                            <div class="space-y-4">
                                <h3 class="text-2xl font-bold text-slate-800 dark:text-white">Kotak Pos Galaksi</h3>
                                <p class="text-slate-500 dark:text-slate-400 font-medium">Suratmu akan diantar oleh robot kurir tercepat di semesta!</p>
                            </div>
                            <div class="p-6 bg-slate-50 dark:bg-slate-900/50 rounded-2xl border-2 border-slate-100 dark:border-slate-700 flex items-center gap-4">
                                <div class="size-12 rounded-xl bg-secondary/10 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-secondary text-2xl">location_on</span>
                                </div>
                                <div>
                                    <p class="font-bold text-slate-800 dark:text-white">Bumi, Indonesia</p>
                                    <p class="text-sm text-slate-500">Koordinat Pusat Zen</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp Card -->
                    <div class="station-card bg-indigo-600 p-8 text-white relative overflow-hidden">
                        <div class="relative z-10">
                            <div class="flex items-center gap-3 mb-6">
                                <span class="material-symbols-outlined text-3xl">radio</span>
                                <h3 class="text-2xl font-bold">Ask Us via Radio</h3>
                            </div>
                            <div class="flex gap-4">
                                <a class="size-14 rounded-2xl bg-white/20 hover:bg-white/40 flex items-center justify-center transition-all group" href="#">
                                    <span class="material-symbols-outlined text-3xl">photo_camera</span>
                                </a>
                                <a class="size-14 rounded-2xl bg-white/20 hover:bg-white/40 flex items-center justify-center transition-all group" href="#">
                                    <span class="material-symbols-outlined text-3xl">play_circle</span>
                                </a>
                                <a class="size-14 rounded-2xl bg-white/20 hover:bg-white/40 flex items-center justify-center transition-all group" href="#">
                                    <span class="material-symbols-outlined text-3xl">forum</span>
                                </a>
                            </div>
                            <p class="mt-6 text-indigo-100 font-medium mb-6">Frekuensi aktif 24 jam untuk sahabat Zen!</p>
                            <div class="border-t border-indigo-500 pt-6">
                                <button class="whatsapp-button w-full px-6 py-4 rounded-2xl bg-wa-green text-white font-bold text-lg flex items-center justify-center gap-3 hover:brightness-110 transition-all">
                                    <span class="material-symbols-outlined text-2xl">chat</span>
                                    Chat lewat WhatsApp
                                </button>
                                <p class="mt-2 text-center text-xs text-indigo-200 opacity-80">Balasan secepat roket!</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Form Section -->
                <div class="lg:col-span-8">
                    <div class="bg-white dark:bg-slate-800 rounded-[4rem] p-10 md:p-16 border-8 border-white dark:border-slate-700 shadow-2xl relative">
                        <div class="absolute top-8 right-12 opacity-10">
                            <span class="material-symbols-outlined text-[120px] text-slate-800 dark:text-white">edit_note</span>
                        </div>
                        <form class="space-y-8 relative z-10">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-3">
                                    <label class="text-xl font-bold text-slate-700 dark:text-slate-300 ml-2" for="nama">Nama Astronot</label>
                                    <input class="w-full px-8 py-5 rounded-full bg-slate-50 dark:bg-slate-900/50 border-4 border-slate-100 dark:border-slate-700 focus:border-primary focus:ring-0 text-lg font-medium transition-all placeholder:text-slate-300 dark:text-white" id="nama" placeholder="Siapa namamu?" type="text"/>
                                </div>
                                <div class="space-y-3">
                                    <label class="text-xl font-bold text-slate-700 dark:text-slate-300 ml-2" for="email">Email Orang Tua / Kamu</label>
                                    <input class="w-full px-8 py-5 rounded-full bg-slate-50 dark:bg-slate-900/50 border-4 border-slate-100 dark:border-slate-700 focus:border-primary focus:ring-0 text-lg font-medium transition-all placeholder:text-slate-300 dark:text-white" id="email" placeholder="halo@email.com" type="email"/>
                                </div>
                            </div>
                            <div class="space-y-3">
                                <label class="text-xl font-bold text-slate-700 dark:text-slate-300 ml-2" for="pesan">Pesan dari Luar Angkasa</label>
                                <textarea class="w-full px-8 py-6 rounded-[2.5rem] bg-slate-50 dark:bg-slate-900/50 border-4 border-slate-100 dark:border-slate-700 focus:border-primary focus:ring-0 text-lg font-medium transition-all placeholder:text-slate-300 resize-none dark:text-white" id="pesan" placeholder="Tuliskan pesan serumu di sini..." rows="5"></textarea>
                            </div>
                            <div class="pt-4">
                                <button class="bubbly-button w-full md:w-auto px-16 py-6 rounded-full bg-primary text-white text-2xl font-black flex items-center justify-center gap-4 hover:brightness-110 transition-all" type="submit">
                                    Kirim Sinyal!
                                    <span class="material-symbols-outlined text-3xl">send</span>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- FAQ Referral -->
                    <div class="mt-12 p-8 bg-green-50 dark:bg-green-900/20 rounded-[3rem] border-4 border-green-100 dark:border-green-800 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div class="flex items-center gap-5">
                            <div class="size-16 rounded-2xl bg-green-500 text-white flex items-center justify-center shadow-lg">
                                <span class="material-symbols-outlined text-4xl">quiz</span>
                            </div>
                            <div>
                                <h4 class="text-2xl font-bold text-slate-800 dark:text-white">Punya pertanyaan umum?</h4>
                                <p class="text-slate-500 dark:text-slate-400 font-medium">Cek di Pusat Pengetahuan dulu, yuk!</p>
                            </div>
                        </div>
                        <button class="px-8 py-3 rounded-full bg-white dark:bg-slate-800 border-4 border-green-200 dark:border-green-800 text-green-600 dark:text-green-400 font-bold text-lg hover:bg-green-100 dark:hover:bg-green-800/50 transition-all">
                            Lihat FAQ
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-layouts.landing>
