<div class="min-h-screen bg-sky-base dark:bg-slate-900 transition-colors duration-300 relative overflow-x-hidden">
    <!-- Background Elements -->
    <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-sky-blue to-white dark:from-slate-900 dark:to-slate-800 transition-colors duration-500"></div>
        
        <!-- Clouds (Light Mode) / Stars (Dark Mode) -->
        <div class="floating-cloud w-64 h-32 top-20 -left-10 bg-white dark:bg-white/5 dark:blur-3xl transition-all duration-500"></div>
        <div class="floating-cloud w-80 h-40 top-1/3 -right-20 bg-blue-100 dark:bg-purple-900/20 dark:blur-3xl transition-all duration-500"></div>
        <div class="floating-cloud w-96 h-48 bottom-20 left-1/4 bg-blue-50 dark:bg-indigo-900/20 dark:blur-3xl transition-all duration-500"></div>
        
        <!-- Animated Planets/Orbs -->
        <div class="absolute top-40 right-[10%] w-24 h-24 rounded-full bg-pink-200 border-4 border-pink-100 opacity-60 dark:bg-pink-900/40 dark:border-pink-800 animate-pulse"></div>
        <div class="absolute bottom-60 left-[5%] w-16 h-16 rounded-full bg-green-200 border-4 border-green-100 opacity-60 dark:bg-green-900/40 dark:border-green-800 animate-bounce delay-700"></div>
    </div>

    <!-- Header -->
    <header class="fixed top-0 w-full z-50 bg-white/70 dark:bg-slate-900/80 backdrop-blur-lg border-b-4 border-blue-50 dark:border-slate-800 transition-colors duration-300">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-primary p-2 rounded-2xl shadow-lg">
                    <span class="material-symbols-outlined text-white text-3xl">rocket_launch</span>
                </div>
                <!-- Text Color fixed for dark mode -->
                <h2 class="text-3xl font-bold tracking-tight text-primary">ZenUniverse</h2>
            </div>
            
            <nav class="hidden md:flex items-center gap-10">
                <a class="text-lg font-bold text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary transition-colors" href="#">Misi Seru</a>
                <a class="text-lg font-bold text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary transition-colors" href="#">Planet Belajar</a>
                <a class="text-lg font-bold text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary transition-colors" href="#">Toko Keren</a>
                <a class="text-lg font-bold text-slate-600 hover:text-primary dark:text-slate-300 dark:hover:text-primary transition-colors" href="#">Offline</a>
            </nav>

            <div class="flex items-center gap-4">
                <!-- Dark Mode Toggle Button (Alpine Integration) -->
                <button @click="toggleTheme()" class="p-2 rounded-full hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors text-slate-600 dark:text-slate-300" aria-label="Toggle Dark Mode">
                    <span class="material-symbols-outlined" x-show="!darkMode">dark_mode</span>
                    <span class="material-symbols-outlined" x-show="darkMode" style="display: none;">light_mode</span>
                </button>

                <a href="{{ route('login') }}" class="hidden sm:flex px-6 py-2 text-lg font-bold rounded-full border-4 border-slate-200 text-slate-500 hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 transition-all">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="bubbly-button px-6 py-2 text-lg font-bold rounded-full bg-primary text-white hover:brightness-110 transition-all shadow-orange-500/50">
                    Ayo Main!
                </a>
            </div>
        </div>
    </header>

    <main class="pt-24 relative z-10 transition-colors duration-300">
        
        <!-- Hero Section -->
        <section class="relative px-6 py-12 md:py-24">
            <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
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
                <div class="relative">
                    <div class="absolute inset-0 bg-blue-200/30 dark:bg-purple-900/30 blur-[100px] rounded-full"></div>
                    <div class="relative bg-white/60 dark:bg-slate-800/60 backdrop-blur-md p-6 md:p-12 rounded-[4rem] border-8 border-white dark:border-slate-700 shadow-xl aspect-square flex items-center justify-center overflow-hidden transition-colors duration-500">
                        <!-- Placeholder Image - Using generation tool logic, sticking to mockup URL for now or a placeholder -->
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAF5Wc58uqrZLOcAMMPTi744lEnr8F7UISKzw1XBa3zrDvc-H3NCE83ZOuB_LCU5OjTpex7Mu82dRPBQADeCEilogLt0inD02SxMydy9GXQnewHWrR4NLAUL71u7xdPVzTH62TfagJXCQem0_7rdiVO-HKd5N7u0pkoTUBIZ1V_4UQ3DzCxzdrujPbGnq8ogtT05ebgsFJbM5rTHfDZdjW-LPcV3-AbNh_DQlI1n-dgG3yRI8AuQian86HtFo33t7F_PQHiJL0ivww" alt="Chibi astronaut mascot" class="w-full h-full object-contain drop-shadow-2xl hover:scale-105 transition-transform duration-500">
                        
                        <div class="absolute bottom-8 right-8 bg-white dark:bg-slate-800 border-4 border-blue-100 dark:border-slate-600 p-6 rounded-[2.5rem] shadow-xl flex items-center gap-4 animate-bounce">
                            <div class="size-14 rounded-2xl bg-gradient-to-br from-yellow-400 to-orange-500 flex items-center justify-center shadow-lg">
                                <span class="material-symbols-outlined text-white text-3xl">emoji_events</span>
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-400 uppercase tracking-widest">Level Kamu</p>
                                <p class="text-3xl font-black text-slate-800 dark:text-white">24</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Stats Section -->
        <section class="bg-white/50 dark:bg-slate-800/50 py-10 border-y-4 border-blue-50 dark:border-slate-700 transition-colors">
            <div class="max-w-7xl mx-auto px-6 flex flex-wrap justify-around gap-8 text-slate-600 dark:text-slate-300 font-bold text-xl text-center">
                <div class="flex flex-col items-center gap-1 group">
                    <span class="material-symbols-outlined text-primary text-4xl mb-2 group-hover:scale-110 transition-transform">thumb_up</span>
                    <span>500rb+ Misi Seru</span>
                </div>
                <div class="flex flex-col items-center gap-1 group">
                    <span class="material-symbols-outlined text-secondary text-4xl mb-2 group-hover:scale-110 transition-transform">map</span>
                    <span>Keliling Indonesia</span>
                </div>
                <div class="flex flex-col items-center gap-1 group">
                    <span class="material-symbols-outlined text-green-500 text-4xl mb-2 group-hover:scale-110 transition-transform">verified</span>
                    <span>Sertifikat Keren</span>
                </div>
            </div>
        </section>

        <!-- Features Section -->
        <section class="py-24 px-6 relative">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-20 space-y-4">
                    <h2 class="text-5xl md:text-6xl font-black tracking-tight text-slate-800 dark:text-white">Kenapa <span class="text-primary">ZenUniverse?</span></h2>
                    <p class="text-2xl text-slate-500 dark:text-slate-400 max-w-2xl mx-auto font-medium">Bikin belajar teknologi jadi gampang kayak main puzzle!</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    <!-- Feature 1 -->
                    <div class="group p-10 rounded-[3rem] bg-white dark:bg-slate-800 border-4 border-blue-50 dark:border-slate-700 hover:border-primary/30 transition-all duration-500 hover:-translate-y-4 shadow-xl">
                        <div class="size-24 rounded-[2rem] bg-orange-100 dark:bg-orange-900/30 text-primary flex items-center justify-center mb-8 shadow-inner">
                            <span class="material-symbols-outlined text-6xl group-hover:rotate-12 transition-transform">videogame_asset</span>
                        </div>
                        <h3 class="text-3xl font-bold mb-4 text-slate-800 dark:text-white">Main Sambil Belajar</h3>
                        <p class="text-xl text-slate-500 dark:text-slate-400 leading-relaxed font-medium">
                            Kumpulkan poin energi dan tukarkan dengan kostum astronot yang keren banget!
                        </p>
                    </div>

                    <!-- Feature 2 -->
                    <div class="group p-10 rounded-[3rem] bg-white dark:bg-slate-800 border-4 border-blue-50 dark:border-slate-700 hover:border-secondary/30 transition-all duration-500 hover:-translate-y-4 shadow-xl">
                        <div class="size-24 rounded-[2rem] bg-indigo-100 dark:bg-indigo-900/30 text-secondary flex items-center justify-center mb-8 shadow-inner">
                            <span class="material-symbols-outlined text-6xl group-hover:rotate-12 transition-transform">stairs</span>
                        </div>
                        <h3 class="text-3xl font-bold mb-4 text-slate-800 dark:text-white">Naik Level Terus</h3>
                        <p class="text-xl text-slate-500 dark:text-slate-400 leading-relaxed font-medium">
                            Mulai dari Pemula sampai jadi Ahli. Pelan-pelan asal senang, pasti bisa!
                        </p>
                    </div>

                    <!-- Feature 3 -->
                    <div class="group p-10 rounded-[3rem] bg-white dark:bg-slate-800 border-4 border-blue-50 dark:border-slate-700 hover:border-green-400/30 transition-all duration-500 hover:-translate-y-4 shadow-xl">
                        <div class="size-24 rounded-[2rem] bg-green-100 dark:bg-green-900/30 text-green-500 flex items-center justify-center mb-8 shadow-inner">
                            <span class="material-symbols-outlined text-6xl group-hover:rotate-12 transition-transform">wifi_off</span>
                        </div>
                        <h3 class="text-3xl font-bold mb-4 text-slate-800 dark:text-white">Bisa Tanpa Sinyal</h3>
                        <p class="text-xl text-slate-500 dark:text-slate-400 leading-relaxed font-medium">
                            Gak ada internet? Gak masalah! Download misinya dan mainkan di mana saja.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Learning Path Section -->
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

        <!-- CTA Section -->
        <section class="py-24 px-6">
            <div class="max-w-5xl mx-auto bg-white dark:bg-slate-800 border-8 border-blue-50 dark:border-slate-700 rounded-[4rem] p-12 md:p-20 text-center space-y-10 relative overflow-hidden shadow-2xl transition-colors">
                <div class="absolute top-0 right-0 w-80 h-80 bg-orange-100 dark:bg-orange-900/20 rounded-full -mr-32 -mt-32 blur-[80px]"></div>
                <div class="absolute bottom-0 left-0 w-80 h-80 bg-blue-100 dark:bg-blue-900/20 rounded-full -ml-32 -mb-32 blur-[80px]"></div>
                
                <h2 class="text-5xl md:text-7xl font-black text-slate-800 dark:text-white tracking-tight relative z-10">
                    Siap Jadi <br>
                    <span class="text-primary">Hero Digital?</span>
                </h2>
                <p class="text-2xl text-slate-500 dark:text-slate-400 font-bold max-w-2xl mx-auto relative z-10 leading-relaxed">
                    Gabung bersama ribuan teman lainnya. Gratis, seru, dan bikin kamu makin pintar!
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-6 pt-6 relative z-10">
                    <a href="{{ route('register') }}" class="bubbly-button px-14 py-6 rounded-full bg-primary text-white text-2xl font-black hover:brightness-110 transition-all">
                        Daftar Sekarang!
                    </a>
                    <button class="px-14 py-6 rounded-full border-4 border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-300 text-2xl font-black hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                        Tanya Mama Papa
                    </button>
                </div>
            </div>
        </section>

    </main>

    <!-- Footer -->
    <footer class="bg-blue-50/50 dark:bg-slate-900 border-t-4 border-blue-100 dark:border-slate-800 py-16 px-6 transition-colors">
        <div class="max-w-7xl mx-auto flex flex-col md:flex-row justify-between items-center gap-10">
            <div class="flex items-center gap-3">
                <div class="bg-primary/20 dark:bg-primary/10 p-2 rounded-2xl">
                    <span class="material-symbols-outlined text-primary text-3xl">rocket_launch</span>
                </div>
                <h2 class="text-3xl font-bold text-primary">ZenUniverse</h2>
            </div>
            
            <p class="text-slate-500 dark:text-slate-500 text-lg font-bold">© 2024 ZenUniverse. Belajar Asik Keliling Galaksi!</p>
            
            <div class="flex gap-8">
                <a href="#" class="text-slate-400 hover:text-primary transition-colors">
                    <span class="material-symbols-outlined text-3xl">photo_camera</span>
                </a>
                <a href="#" class="text-slate-400 hover:text-secondary transition-colors">
                    <span class="material-symbols-outlined text-3xl">play_circle</span>
                </a>
                <a href="#" class="text-slate-400 hover:text-blue-400 transition-colors">
                    <span class="material-symbols-outlined text-3xl">alternate_email</span>
                </a>
            </div>
        </div>
    </footer>
</div>
