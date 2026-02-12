<x-layouts.landing title="ZenUniverse - Tentang Kami">
    <section class="px-6 mb-24 pt-10">
        <div class="max-w-7xl mx-auto text-center">
            <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-white shadow-md border-2 border-blue-100 text-primary font-bold text-lg mb-8">
                <span class="material-symbols-outlined text-xl">public</span>
                <span>Misi Sosial Kita</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-black text-slate-800 leading-[1.1] mb-6">
                Misi Kami di <br/>
                <span class="text-primary">Seluruh Galaksi</span>
            </h1>
            <p class="text-xl md:text-2xl text-slate-500 max-w-3xl mx-auto font-medium leading-relaxed">
                Kami percaya setiap anak, bahkan di desa terjauh sekalipun, berhak menjadi astronot teknologi yang hebat!
            </p>
        </div>
    </section>

    <section class="px-6 py-12 mb-24">
        <div class="max-w-7xl mx-auto bg-white/60 backdrop-blur-md rounded-[4rem] border-8 border-white shadow-xl overflow-hidden">
            <div class="grid grid-cols-1 lg:grid-cols-2">
                <div class="p-12 md:p-20 flex flex-col justify-center space-y-8">
                    <h2 class="text-4xl font-black text-slate-800">Cerita Awal Petualangan</h2>
                    <div class="space-y-6 text-xl text-slate-500 font-medium leading-relaxed">
                        <p>
                            Dahulu kala, di sebuah desa kecil yang asri, banyak anak-anak pintar yang ingin belajar tentang komputer. Tapi, sinyal internet sangat sulit didapat, seperti mencari bintang jatuh!
                        </p>
                        <p>
                            Maka lahirlah <span class="text-primary font-bold">ZenUniverse</span>. Kami mengirimkan astronot ramah kami untuk membawa kotak-kotak teknologi ajaib ke desa-desa di seluruh Indonesia.
                        </p>
                        <p>
                            Kini, anak-anak tidak perlu lagi pergi ke kota besar. Lewat ZenUniverse, mereka bisa belajar koding, desain, dan sains sambil bermain game yang sangat seru!
                        </p>
                    </div>
                    <div class="flex items-center gap-4 p-6 bg-orange-50 rounded-3xl border-2 border-orange-100">
                        <span class="material-symbols-outlined text-4xl text-primary">volunteer_activism</span>
                        <p class="text-lg font-bold text-orange-800 italic">"Membawa cahaya teknologi ke setiap sudut bumi."</p>
                    </div>
                </div>
                <div class="relative min-h-[500px] bg-sky-100 flex items-center justify-center p-12">
                    <div class="absolute inset-0 bg-gradient-to-br from-transparent to-white/40"></div>
                    <img alt="Friendly astronaut helping kids" class="relative z-10 w-full h-full object-contain drop-shadow-2xl" src="{{ asset('images/hero.png') }}"/>
                    <div class="absolute top-10 right-10 w-32 h-32 bg-yellow-200/50 rounded-full blur-2xl"></div>
                    <div class="absolute bottom-10 left-10 w-40 h-40 bg-purple-200/50 rounded-full blur-2xl"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 py-24 bg-blue-50/50 border-y-4 border-blue-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-5xl font-black text-slate-800 mb-4">Nilai-Nilai Kami</h2>
                <p class="text-2xl text-slate-500 font-medium">Bahan bakar rahasia di balik roket kami!</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <div class="bg-white p-12 rounded-[3rem] border-4 border-white shadow-lg text-center group hover:-translate-y-4 transition-all duration-500">
                    <div class="size-28 mx-auto rounded-full bg-orange-100 flex items-center justify-center mb-8 shadow-inner">
                        <span class="material-symbols-outlined text-6xl text-primary">rocket</span>
                    </div>
                    <h3 class="text-3xl font-bold mb-4 text-slate-800">Pemberdayaan</h3>
                    <p class="text-xl text-slate-500 font-medium leading-relaxed">
                        Kami memberikan alat dan ilmu agar anak-anak desa bisa jadi pencipta teknologi masa depan.
                    </p>
                </div>
                <div class="bg-white p-12 rounded-[3rem] border-4 border-white shadow-lg text-center group hover:-translate-y-4 transition-all duration-500">
                    <div class="size-28 mx-auto rounded-full bg-purple-100 flex items-center justify-center mb-8 shadow-inner">
                        <span class="material-symbols-outlined text-6xl text-secondary">sentiment_very_satisfied</span>
                    </div>
                    <h3 class="text-3xl font-bold mb-4 text-slate-800">Kegembiraan</h3>
                    <p class="text-xl text-slate-500 font-medium leading-relaxed">
                        Belajar itu harus asyik! Kami mengubah pelajaran sulit menjadi petualangan galaksi yang lucu.
                    </p>
                </div>
                <div class="bg-white p-12 rounded-[3rem] border-4 border-white shadow-lg text-center group hover:-translate-y-4 transition-all duration-500">
                    <div class="size-28 mx-auto rounded-full bg-green-100 flex items-center justify-center mb-8 shadow-inner">
                        <span class="material-symbols-outlined text-6xl text-green-500">accessibility</span>
                    </div>
                    <h3 class="text-3xl font-bold mb-4 text-slate-800">Kemudahan</h3>
                    <p class="text-xl text-slate-500 font-medium leading-relaxed">
                        Siapapun, di mana pun, dan dengan perangkat apa pun bisa ikut belajar bersama kami.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 px-6">
        <div class="max-w-5xl mx-auto bg-gradient-to-r from-primary to-orange-400 rounded-[4rem] p-12 md:p-20 text-center space-y-10 relative overflow-hidden shadow-2xl">
            <div class="absolute top-0 left-0 w-full h-full opacity-20 pointer-events-none">
                <span class="material-symbols-outlined absolute top-10 left-10 text-9xl text-white">star</span>
                <span class="material-symbols-outlined absolute bottom-10 right-10 text-9xl text-white">flare</span>
            </div>
            <h2 class="text-5xl md:text-6xl font-black text-white tracking-tight relative z-10">
                Ayo Jadi Bagian dari Keluarga Besar Kami!
            </h2>
            <p class="text-2xl text-white/90 font-bold max-w-2xl mx-auto relative z-10 leading-relaxed">
                Mari bersama-sama mewujudkan mimpi anak-anak Indonesia untuk menguasai teknologi.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-6 pt-6 relative z-10">
                <a href="{{ route('register') }}" class="bg-white text-primary px-14 py-6 rounded-full text-2xl font-black hover:scale-105 transition-all shadow-xl">
                    Ikut Misi Kami
                </a>
                <button class="bg-primary/20 backdrop-blur-md border-4 border-white/50 text-white px-14 py-6 rounded-full text-2xl font-black hover:bg-white/20 transition-all">
                    Donasi Alat
                </button>
            </div>
        </div>
    </section>
</x-layouts.landing>
