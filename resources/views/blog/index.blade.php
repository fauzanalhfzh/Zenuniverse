<x-layouts.landing title="ZenUniverse: Berita Galaksi">
    <div class="pt-32 pb-24 relative z-10">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Hero Section -->
            <div class="text-center mb-16 relative">
                 <div class="absolute top-0 right-[20%] w-32 h-32 bg-pink-200/50 rounded-full blur-3xl -z-10"></div>
                 <div class="absolute bottom-0 left-[20%] w-40 h-40 bg-blue-200/50 rounded-full blur-3xl -z-10"></div>

                <div class="inline-flex items-center gap-2 px-6 py-2 rounded-full bg-white shadow-md border-2 border-blue-100 text-secondary font-bold text-lg mb-6">
                    <span class="material-symbols-outlined text-xl">newspaper</span>
                    <span>Warta Luar Angkasa</span>
                </div>
                <h1 class="text-5xl md:text-6xl font-black text-slate-800 mb-6">
                    Berita <span class="text-primary">Galaksi</span>
                </h1>
                <p class="text-xl md:text-2xl text-slate-500 max-w-2xl mx-auto font-medium">
                    Temukan rahasia teknologi terbaru dan cerita seru dari seluruh penjuru semesta!
                </p>

                <!-- Search Bar (Visual) -->
                <div class="max-w-2xl mx-auto mt-10">
                    <div class="relative group">
                        <div class="absolute -inset-1 bg-gradient-to-r from-blue-300 to-purple-300 rounded-full blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200"></div>
                        <div class="relative flex items-center bg-white rounded-full shadow-xl border-4 border-white overflow-hidden p-2">
                           <span class="material-symbols-outlined text-slate-400 text-3xl ml-4">search</span>
                           <input type="text" placeholder="Teropong berita apa hari ini?" class="w-full border-none focus:ring-0 text-lg font-medium text-slate-600 placeholder:text-slate-400 bg-transparent px-4">
                           <button class="bg-primary hover:bg-orange-600 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center transition-colors">
                                <span class="material-symbols-outlined">visibility</span>
                           </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($posts as $post)
                    <div class="bg-white rounded-[2.5rem] overflow-hidden border-4 border-blue-50 hover:border-blue-200 shadow-lg hover:shadow-xl transition-all duration-300 group flex flex-col h-full">
                        <div class="relative h-64 overflow-hidden">
                            @if($post->thumbnail)
                                <img src="{{ str_starts_with($post->thumbnail, 'http') ? $post->thumbnail : asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                                    <span class="material-symbols-outlined text-blue-300 text-6xl">image</span>
                                </div>
                            @endif
                            
                            <!-- Date Badge -->
                            <div class="absolute top-4 left-4 inline-flex items-center gap-1 px-4 py-2 rounded-full bg-white/90 backdrop-blur border-2 border-white shadow-sm text-slate-600 text-sm font-bold">
                                <span class="material-symbols-outlined text-primary text-lg">calendar_today</span>
                                <span>{{ $post->published_at?->format('d M Y') ?? 'Draft' }}</span>
                            </div>
                        </div>
                        
                        <div class="p-8 flex-1 flex flex-col">
                            <h3 class="text-2xl font-black text-slate-800 mb-3 group-hover:text-primary transition-colors line-clamp-2">
                                <a href="{{ route('blog.show', $post->slug) }}">
                                    {{ $post->title }}
                                </a>
                            </h3>
                            <p class="text-slate-500 font-medium mb-6 line-clamp-3 flex-1">
                                {{ $post->excerpt }}
                            </p>
                            
                            <div class="flex items-center justify-between mt-auto">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-full bg-purple-100 flex items-center justify-center text-purple-600 font-bold border-2 border-white shadow-sm">
                                        {{ substr($post->author->name, 0, 1) }}
                                    </div>
                                    <span class="text-sm font-bold text-slate-400">{{ $post->author->name }}</span>
                                </div>
                                <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-1 text-primary font-black hover:gap-2 transition-all">
                                    Baca <span class="material-symbols-outlined">arrow_forward_ios</span>
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-20">
                        <div class="bg-blue-50 w-32 h-32 rounded-full flex items-center justify-center mx-auto mb-6">
                            <span class="material-symbols-outlined text-blue-300 text-6xl">sentiment_dissatisfied</span>
                        </div>
                        <h3 class="text-2xl font-bold text-slate-700">Belum ada berita nih!</h3>
                        <p class="text-slate-500 mt-2">Astronot kami sedang sibuk menulis di angkasa...</p>
                    </div>
                @endforelse
            </div>

            <!-- Load More (Visual) -->
             @if($posts->count() > 9)
                <div class="mt-16 text-center">
                    <button class="px-8 py-3 rounded-full border-4 border-slate-200 text-slate-500 font-bold hover:bg-slate-50 hover:border-slate-300 transition-colors">
                        Lihat Berita Lainnya
                    </button>
                </div>
             @endif
        </div>
    </div>
</x-layouts.landing>
