<x-layouts.student title="Beranda" active="dashboard">
    <div class="max-w-6xl mx-auto">
        {{-- Hero Section --}}
        <x-student.hero :name="auth()->user()->name" />

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-8">
                {{-- Recent Activity --}}
                <section>
                    <div class="flex items-center justify-between mb-4">
                        <h4 class="text-2xl font-black text-slate-800">Aktivitas Terakhir</h4>
                        <a href="#" class="text-primary font-bold text-sm hover:underline">Lihat Semua</a>
                    </div>
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
</x-layouts.student>

