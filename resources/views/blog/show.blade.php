<x-layouts.landing :title="$post->title">
    <!-- Progress Bar -->
    <div class="fixed top-0 left-0 w-full h-1 bg-slate-100 z-[60]">
        <div class="h-full bg-primary" style="width: 0%" id="readingProgress"></div>
    </div>

    <div class="pt-32 pb-24 relative z-10">
        <!-- Floating Elements -->
        <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
            <div class="absolute top-40 right-10 w-20 h-20 bg-yellow-200/40 rounded-full blur-xl animate-pulse"></div>
            <div class="absolute bottom-1/3 left-10 w-32 h-32 bg-purple-200/40 rounded-full blur-2xl"></div>
        </div>

        <div class="max-w-4xl mx-auto px-6 relative z-10">
            <!-- Breadcrumb / Back -->
            <div class="mb-10">
                <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-2 text-slate-500 font-bold hover:text-primary transition-colors bg-white px-4 py-2 rounded-full shadow-sm border border-slate-100">
                    <span class="material-symbols-outlined">arrow_back</span>
                    Kembali ke Berita
                </a>
            </div>

            <!-- Article Header -->
            <header class="text-center mb-12">
                <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-purple-50 text-purple-600 font-bold text-sm mb-6 border border-purple-100">
                    <span class="material-symbols-outlined text-base">rocket_launch</span>
                    <span>Warta Galaksi</span>
                </div>
                
                <h1 class="text-4xl md:text-5xl md:leading-tight font-black text-slate-800 mb-8">
                    {{ $post->title }}
                </h1>

                <div class="flex flex-wrap items-center justify-center gap-6 text-slate-500 font-medium">
                    <div class="flex items-center gap-2">
                        <div class="w-10 h-10 rounded-full bg-slate-200 overflow-hidden border-2 border-white shadow-sm">
                             <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-400 font-bold text-lg">
                                {{ substr($post->author->name, 0, 1) }}
                             </div>
                        </div>
                        <span class="text-slate-700 font-bold">{{ $post->author->name }}</span>
                    </div>
                    
                    <div class="hidden md:block w-1.5 h-1.5 rounded-full bg-slate-300"></div>
                    
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary">calendar_today</span>
                        <span>{{ $post->published_at?->format('d F Y') ?? 'Draft' }}</span>
                    </div>

                    <div class="hidden md:block w-1.5 h-1.5 rounded-full bg-slate-300"></div>

                    <div class="flex items-center gap-2">
                         <span class="material-symbols-outlined text-secondary">schedule</span>
                         <span>{{ max(1, round(str_word_count(strip_tags($post->content)) / 200)) }} menit baca</span>
                    </div>
                </div>
            </header>

            <!-- Featured Image -->
            @if($post->thumbnail)
                <div class="mb-16 rounded-[2.5rem] overflow-hidden border-8 border-white shadow-2xl relative group">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    <img src="{{ str_starts_with($post->thumbnail, 'http') ? $post->thumbnail : asset('storage/' . $post->thumbnail) }}" alt="{{ $post->title }}" class="w-full h-[400px] md:h-[500px] object-cover group-hover:scale-105 transition-transform duration-700">
                </div>
            @endif

            <!-- Content -->
            <article class="prose prose-lg md:prose-xl prose-slate mx-auto prose-headings:font-black prose-headings:text-slate-800 prose-p:text-slate-600 prose-a:text-primary hover:prose-a:text-orange-600 prose-img:rounded-3xl prose-img:border-4 prose-img:border-blue-50 prose-img:shadow-lg bg-white p-8 md:p-12 rounded-[2.5rem] shadow-xl border-4 border-slate-50">
                {!! $post->content !!}
            </article>

            <!-- Share / Tags -->
            <div class="mt-16 pt-10 border-t-4 border-blue-50 flex flex-col md:flex-row justify-between items-center gap-6">
                <div class="font-bold text-slate-500">
                    Bagikan cerita ini:
                </div>
                <div class="flex gap-4">
                    <button class="w-12 h-12 rounded-full bg-blue-500 text-white flex items-center justify-center hover:-translate-y-1 transition-transform shadow-lg shadow-blue-500/30">
                        <i class="fa-brands fa-facebook-f text-xl"></i>
                    </button>
                    <button class="w-12 h-12 rounded-full bg-sky-400 text-white flex items-center justify-center hover:-translate-y-1 transition-transform shadow-lg shadow-sky-400/30">
                        <i class="fa-brands fa-twitter text-xl"></i>
                    </button>
                    <button class="w-12 h-12 rounded-full bg-green-500 text-white flex items-center justify-center hover:-translate-y-1 transition-transform shadow-lg shadow-green-500/30">
                        <i class="fa-brands fa-whatsapp text-xl"></i>
                    </button>
                    <button onclick="navigator.clipboard.writeText(window.location.href)" class="w-12 h-12 rounded-full bg-slate-200 text-slate-600 flex items-center justify-center hover:-translate-y-1 transition-transform shadow-lg">
                        <span class="material-symbols-outlined">link</span>
                    </button>
                </div>
            </div>

            <!-- More Posts -->
            <!-- We could add a "More like this" section here later -->
        </div>
    </div>

    <script>
        // Reading Progress Bar
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("readingProgress").style.width = scrolled + "%";
        };
    </script>
</x-layouts.landing>
