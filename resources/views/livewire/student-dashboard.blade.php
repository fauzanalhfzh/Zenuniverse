<div class="max-w-6xl mx-auto">
    {{-- Hero Section --}}
    {{-- Header Section with Streak --}}
    <div class="flex justify-between items-end mb-8 animate-fade-in-up">
        <div>
            <h1 class="text-3xl md:text-4xl font-black text-slate-800 tracking-tight mb-2">
                {{ $greeting }}
            </h1>
            <p class="text-slate-500 font-medium">Siap untuk petualangan barumu hari ini? 🚀</p>
        </div>
        
        <div class="flex items-center gap-4">
            <!-- Streak Counter -->
            <div class="sound-hover group relative bg-orange-100/50 hover:bg-orange-100 border-2 border-orange-200 hover:border-orange-300 rounded-2xl p-3 flex items-center gap-3 transition-all cursor-help" title="Streak Belajar">
                <div class="w-10 h-10 bg-orange-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-orange-500/30 group-hover:scale-110 transition-transform">
                    <span class="material-symbols-outlined font-bold">local_fire_department</span>
                </div>
                <div class="pr-2">
                    <div class="text-md font-black text-orange-600 leading-none">{{ $user->current_streak }} Hari</div>
                    <div class="text-[10px] font-bold text-orange-400 uppercase tracking-wider">Streak</div>
                </div>
                
                <!-- Tooltip -->
                <div class="absolute -bottom-12 right-0 w-48 bg-slate-800 text-white text-xs p-2 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none z-20 text-center">
                    Belajar setiap hari untuk menjaga apimu tetap menyala! 🔥
                </div>
            </div>

            <!-- XP Badge -->
            <div class="sound-hover bg-blue-100/50 border-2 border-blue-200 rounded-2xl p-3 flex items-center gap-3">
                 <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center text-white shadow-lg shadow-blue-500/30">
                    <span class="material-symbols-outlined font-bold">bolt</span>
                </div>
                <div class="pr-2">
                    <div class="text-md font-black text-blue-600 leading-none">{{ $user->current_xp ?? 0 }} XP</div>
                    <div class="text-[10px] font-bold text-blue-400 uppercase tracking-wider">Total XP</div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-8">
            {{-- Recent Activity --}}
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-2xl font-black text-slate-800">Aktivitas Terakhir</h4>
                    <a href="#" class="text-primary font-bold text-sm hover:underline">Lihat Semua</a>
                </div>
                {{-- For now using static activity, could be dynamic later --}}
                <x-student.activity-card 
                    module="Melanjutkan Modul" 
                    title="Looping Seru di Planet Mars" 
                    progress="40" 
                />
            </section>

            {{-- Galaxy News --}}
            <section>
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-2xl font-black text-slate-800">Berita Galaksi</h4>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <x-student.news-card 
                        title="Update: Fitur Kolaborasi Baru di Lab Coding!" 
                        time="2 jam yang lalu" 
                        image="https://lh3.googleusercontent.com/aida-public/AB6AXuAr-G5WOOpK9EkAM9CWhvR6RbSIig040DtYoLFCG3LH-_RGO1OqnOp_k-27rSZe6fozNz_cPdndKNb5cuqhtYxlKBNlYNLfq9NmdKT7P7KLak_zINcsxPs9Ttqw6JKhYVF4EDBYOhzL9Z5Mk94X9PcNYj2_IkGhFEyS2psXwY2fDWZ9E_jZVLoKVt6OG4sANzoz9ZWjGbL0Tn-MdJA4OIR7MQ2RysLOp1AKaRaw-F9aOd8tXbPpXzRTt5h9j3qPFEPS2iWe4G061KM" 
                    />
                    <x-student.news-card 
                        title="Event: Lomba Desain Robot Antar Galaksi" 
                        time="Kemarin" 
                        image="https://lh3.googleusercontent.com/aida-public/AB6AXuBl3-Xf7mZ8OjSevNqfJesHKF-IpbJ_CJTwN2txc10jK8o-Xi6keg6hNPl01mRRMNQ8rtvtQAqBZxjEvckjgBAcz0vag0UoRZGsKPXg4kmd3oNHqDkS8iIFNTValbvriQGPocVQb7PJQg6iQZwL8HPKW75hYu51779o3HWDfukABkhbycXIDVsGI6b5qRwzmotqHIsn1ZAp5n_R0iuD_gEVJHJjK4EYLxfsDZaWh3-JRRv4THj4-TJTzn8UkFWvODRK8uW6yF8WlfU" 
                    />
                </div>
            </section>
        </div>

        {{-- Daily Challenge --}}
        <div class="space-y-8">
            <section class="h-full">
                <div class="flex items-center justify-between mb-4">
                    <h4 class="text-2xl font-black text-slate-800">Tantangan Hari Ini</h4>
                </div>
                <x-student.challenge-card 
                    title="Misi Harian: Penyelamat Kode" 
                    description="Perbaiki 3 baris kode yang rusak di stasiun luar angkasa untuk mendapatkan bonus XP!" 
                    reward="100" 
                    expiry="5 jam 20 menit" 
                />
            </section>
        </div>
    </div>
</div>


