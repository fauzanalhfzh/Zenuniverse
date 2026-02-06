<div :class="{ 'dark': darkMode }" class="min-h-screen bg-gradient-to-br from-indigo-500 via-purple-500 to-pink-500 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900 flex flex-col transition-colors duration-500">
    {{-- Navbar --}}
    <nav class="w-full flex items-center justify-between p-6 bg-white/10 dark:bg-black/20 backdrop-blur-md shadow-lg sticky top-0 z-50 transition-colors duration-500">
        <div class="flex items-center space-x-3">
            <span class="text-3xl">🚀</span>
            <h1 class="text-2xl font-bold text-white tracking-widest font-mono">TEKNOLOGI.CODING</h1>
        </div>
        <div class="flex items-center space-x-4">
            {{-- Dark Mode Toggle --}}
            <button @click="toggleTheme()" class="p-2 rounded-full bg-white/20 hover:bg-white/30 text-white transition focus:outline-none">
                <span x-show="!darkMode">🌙</span>
                <span x-show="darkMode" style="display: none;">☀️</span>
            </button>

            @auth
                <a href="{{ route('dashboard') }}" class="px-6 py-2 bg-white text-indigo-600 font-bold rounded-full hover:bg-indigo-100 transition shadow-md">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-white hover:text-yellow-300 font-semibold transition">Masuk</a>
                <a href="{{ route('register') }}" class="px-6 py-2 bg-yellow-400 text-indigo-900 font-bold rounded-full hover:bg-yellow-300 transition shadow-lg transform hover:scale-105">Daftar Sekarang</a>
            @endauth
        </div>
    </nav>

    {{-- Hero Section --}}
    <main class="flex-grow flex items-center justify-center px-6">
        <div class="max-w-6xl w-full grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
            <div class="space-y-6 text-center md:text-left">
                <h2 class="text-5xl md:text-7xl font-extrabold text-white leading-tight drop-shadow-md">
                    Belajar Coding <br>
                    <span class="text-yellow-300">Jadi Seru! 🎮</span>
                </h2>
                <p class="text-xl text-indigo-100 max-w-lg mx-auto md:mx-0 leading-relaxed">
                    Platform belajar teknologi pertama di Indonesia dengan konsep gamifikasi. 
                    Mainkan levelnya, kumpulkan XP, dan jadilah master teknologi!
                </p>
                
                <div class="flex flex-col md:flex-row gap-4 justify-center md:justify-start pt-4">
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-yellow-400 text-indigo-900 text-xl font-bold rounded-2xl shadow-xl hover:bg-yellow-300 transform hover:-translate-y-1 transition duration-300 flex items-center justify-center gap-2">
                        <span>Mulai Petualangan</span>
                        <span>👉</span>
                    </a>
                    <a href="#features" class="px-8 py-4 bg-white/20 text-white text-xl font-bold rounded-2xl hover:bg-white/30 backdrop-blur-sm transition duration-300 border border-white/30">
                        Lihat Fitur
                    </a>
                </div>
            </div>

            {{-- Illustration Area --}}
            <div class="hidden md:flex justify-center relative">
                <div class="absolute inset-0 bg-white/20 rounded-full blur-3xl animate-pulse"></div>
                <div class="relative bg-white/10 backdrop-blur-lg p-8 rounded-3xl border border-white/20 shadow-2xl rotate-3 hover:rotate-0 transition duration-500">
                    <div class="space-y-4">
                        <div class="flex items-center gap-4 bg-white/90 p-4 rounded-xl shadow-md">
                            <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-2xl">🏆</div>
                            <div>
                                <h3 class="font-bold text-gray-800">Level Up!</h3>
                                <p class="text-sm text-gray-600">Kamu naik ke level Pemula</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 bg-white/90 p-4 rounded-xl shadow-md translate-x-4">
                            <div class="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center text-2xl">⚡</div>
                            <div>
                                <h3 class="font-bold text-gray-800">100 XP Didapat</h3>
                                <p class="text-sm text-gray-600">Menyelesaikan misi harian</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-4 bg-white/90 p-4 rounded-xl shadow-md">
                            <div class="w-12 h-12 bg-purple-500 rounded-full flex items-center justify-center text-2xl">🔥</div>
                            <div>
                                <h3 class="font-bold text-gray-800">7 Hari Streak</h3>
                                <p class="text-sm text-gray-600">Konsistensi luar biasa!</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    {{-- Footer --}}
    <footer class="p-6 text-center text-indigo-200 text-sm">
        &copy; {{ date('Y') }} teknologi.coding. All rights reserved.
    </footer>
</div>
