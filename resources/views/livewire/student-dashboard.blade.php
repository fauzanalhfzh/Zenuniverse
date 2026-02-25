<div class="max-w-7xl mx-auto">
    <div class="flex flex-col lg:flex-row gap-10">

        {{-- MAIN: Lesson Path --}}
        <div class="flex-1">
            {{-- Course Selection Header --}}
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center gap-4">
                     {{-- Current Course Indicator --}}
                     <div class="flex items-center gap-3 px-5 py-3 rounded-2xl bg-primary text-white shadow-lg shadow-orange-500/30 transition-transform hover:scale-105 cursor-default">
                        <div class="size-8 rounded-lg bg-white/20 flex items-center justify-center">
                            <span class="material-symbols-outlined text-white">{{ $currentCourse->title == 'Dasar Pemrograman Web' ? 'language' : ($currentCourse->icon ?? 'school') }}</span>
                        </div>
                        <div class="text-left">
                            <p class="text-[10px] font-bold uppercase tracking-wider opacity-80">Track Saat Ini</p>
                            <p class="font-black text-sm whitespace-nowrap">{{ $currentCourse->title }}</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('tracks') }}" class="group flex items-center gap-2 px-4 py-2 rounded-xl text-slate-500 hover:text-primary hover:bg-orange-50 font-bold text-sm transition-all">
                    <span class="material-symbols-outlined group-hover:rotate-180 transition-transform duration-500">swap_horiz</span>
                    Ganti Jalur
                </a>
            </div>

            {{-- Greeting --}}
            <div class="mb-6">
                <h1 class="text-2xl font-black text-slate-800">Halo, {{ explode(' ', $user->name)[0] }}! 👋</h1>
                <p class="text-sm text-slate-400 mt-1 font-medium">Yuk lanjutkan petualangan belajarmu hari ini!</p>
            </div>

            {{-- Section Header --}}
            <div class="flex items-center justify-between bg-primary rounded-2xl px-6 py-4 mb-8 shadow-sm">
                <div>
                    <p class="text-orange-100 text-xs font-bold uppercase tracking-wider">
                        BAGIAN {{ $user->currentLevel->order ?? 1 }}, UNIT 1
                    </p>
                    <h2 class="text-white text-lg font-black mt-0.5">{{ $currentCourse->title ?? 'Mulai Belajar' }}</h2>
                </div>
                <a href="{{ route('dashboard') }}" class="bg-white/20 hover:bg-white/30 text-white text-xs font-bold uppercase tracking-wider px-4 py-2 rounded-xl transition-colors flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">menu_book</span>
                    Buku Panduan
                </a>
            </div>

            {{-- Zigzag Lesson Path --}}
            <div wire:loading.class="opacity-50 transition-opacity" class="flex flex-col items-center gap-6 py-4">
                @foreach($lessons as $index => $lesson)
                    @php
                        $isCompleted = in_array($lesson->id, $completedLessonIds);
                        $isCurrent = $lesson->id === $currentLessonId;
                        $isLocked = !$isCompleted && !$isCurrent;

                        // Zigzag offset: alternate left/center/right
                        $positions = [0, 50, 70, 50, 0, -50, -70, -50];
                        $offset = $positions[$index % count($positions)];
                    @endphp

                    <div wire:key="lesson-{{ $lesson->id }}" class="relative flex flex-col items-center" style="transform: translateX({{ $offset }}px);">
                        {{-- Connector line (not on first item) --}}
                        @if($index > 0)
                            <div class="w-1 h-6 {{ $isLocked ? 'bg-slate-200' : 'bg-green-400' }} -mt-6 mb-1 rounded-full"></div>
                        @endif

                        {{-- "MULAI" label for current lesson --}}
                        @if($isCurrent)
                            <div class="mb-2 px-4 py-1 bg-white border-2 border-primary rounded-xl shadow-sm">
                                <span class="text-primary text-xs font-black uppercase tracking-wider">Mulai</span>
                            </div>
                        @endif

                        {{-- Lesson Node --}}
                        @if($isCompleted)
                            {{-- Completed: green with checkmark --}}
                            <a href="{{ route('missions.player', $lesson->slug ?? 'temp-'.$lesson->id) }}" 
                               class="group size-16 rounded-full bg-green-500 border-4 border-green-400 shadow-lg flex items-center justify-center hover:scale-110 transition-transform cursor-pointer"
                               title="{{ $lesson->title }}">
                                <span class="material-symbols-outlined text-white text-2xl font-fill-1">check</span>
                            </a>
                        @elseif($isCurrent)
                            {{-- Current: orange, highlighted, bouncing --}}
                            @if($user->hearts > 0)
                                <a href="{{ route('missions.player', $lesson->slug ?? 'temp-'.$lesson->id) }}" 
                                   class="group size-20 rounded-full bg-primary border-4 border-orange-300 shadow-xl shadow-orange-300/40 flex items-center justify-center hover:scale-105 transition-transform cursor-pointer animate-bounce" style="animation-duration: 2s;"
                                   title="{{ $lesson->title }}">
                                    <span class="material-symbols-outlined text-white text-3xl font-fill-1">{{ $lesson->icon ?? 'star' }}</span>
                                </a>
                            @else
                                <button x-data x-on:click="$dispatch('open-modal', 'empty-hearts')" 
                                   class="group size-20 rounded-full bg-primary border-4 border-orange-300 shadow-xl shadow-orange-300/40 flex items-center justify-center hover:scale-105 transition-transform cursor-pointer animate-bounce grayscale" style="animation-duration: 2s;"
                                   title="Nyawa Habis">
                                    <span class="material-symbols-outlined text-white text-3xl font-fill-1">{{ $lesson->icon ?? 'star' }}</span>
                                </button>
                            @endif
                        @else
                            {{-- Locked: gray --}}
                            <div class="size-16 rounded-full bg-slate-200 border-4 border-slate-100 flex items-center justify-center cursor-not-allowed" title="Terkunci">
                                <span class="material-symbols-outlined text-slate-400 text-2xl font-fill-1">lock</span>
                            </div>
                        @endif

                        {{-- Lesson title (show on hover for completed, always for current) --}}
                        @if($isCurrent)
                            <p class="mt-2 text-sm font-bold text-slate-700 text-center max-w-[160px]">{{ $lesson->title }}</p>
                        @endif
                    </div>
                @endforeach

                {{-- End of path marker --}}
                @if($lessons->count() > 0)
                    <div class="mt-4 flex flex-col items-center gap-2">
                        <div class="w-1 h-6 bg-slate-200 rounded-full"></div>
                        <div class="size-12 rounded-full bg-slate-100 border-2 border-slate-200 flex items-center justify-center">
                            <span class="material-symbols-outlined text-slate-300 text-xl">flag</span>
                        </div>
                    </div>
                @else
                    <div class="text-center py-16">
                        <span class="material-symbols-outlined text-6xl text-slate-200 mb-4">rocket_launch</span>
                        <p class="text-slate-400 font-bold text-lg">Belum ada pelajaran tersedia</p>
                        <p class="text-slate-300 text-sm mt-1">Kembali lagi nanti ya!</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- SIDEBAR --}}
        <div class="w-full lg:w-72 space-y-5 flex-shrink-0">

            {{-- Papan Skor --}}
            <div class="bg-white rounded-2xl border-2 border-slate-100 p-5">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-3">Papan Skor</p>
                <div class="flex items-start gap-3">
                    <div class="flex-1">
                        <p class="text-base font-black text-slate-800 leading-snug">Peringkat #{{ $leaderboardRank }}</p>
                        <p class="text-base text-slate-400 mt-1 leading-relaxed">Kamu di peringkat ke-{{ $leaderboardRank }}. Terus belajar!</p>
                    </div>
                    <div class="size-10 rounded-xl bg-red-100 flex items-center justify-center flex-shrink-0">
                        <span class="material-symbols-outlined text-red-400 text-xl font-fill-1">emoji_events</span>
                    </div>
                </div>
                <a href="{{ route('leaderboard') }}" class="block mt-4 text-center text-primary text-sm font-bold uppercase tracking-wider hover:underline">
                    Ke Papan Skor
                </a>
            </div>

            {{-- Misi Harian --}}
            <div class="bg-white rounded-2xl border-2 border-slate-100 p-5">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-xl font-black text-slate-800">Misi Harian</p>
                    <a href="#" class="text-primary text-base font-bold hover:underline">Lihat Semua</a>
                </div>

                <div class="space-y-4">
                    {{-- Quest 1: Earn XP --}}
                    @php
                        $xpTarget = 10;
                        $xpProgress = min($todayXpEarned, $xpTarget);
                        $xpPercent = ($xpProgress / $xpTarget) * 100;
                    @endphp
                    <div class="flex items-center gap-3">
                        <div class="size-9 rounded-lg bg-yellow-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-yellow-500 text-lg font-fill-1">bolt</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-bold text-slate-700">Dapatkan {{ $xpTarget }} XP</p>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex-1 bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-yellow-400 h-full rounded-full transition-all" style="width: {{ $xpPercent }}%"></div>
                                </div>
                                <span class="text-[10px] font-bold text-slate-400">{{ $xpProgress }}/{{ $xpTarget }}</span>
                            </div>
                        </div>
                    </div>

                    {{-- Quest 2: Complete a lesson --}}
                    <div class="flex items-center gap-3">
                        <div class="size-9 rounded-lg bg-green-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-green-500 text-lg font-fill-1">check_circle</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-bold text-slate-700">Selesaikan 1 pelajaran</p>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex-1 bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-green-400 h-full rounded-full transition-all" style="width: {{ min($lessonsDoneToday, 1) * 100 }}%"></div>
                                </div>
                                <span class="text-[10px] font-bold text-slate-400">{{ min($lessonsDoneToday, 1) }}/1</span>
                            </div>
                        </div>
                    </div>

                    {{-- Quest 3: Maintain streak --}}
                    <div class="flex items-center gap-3">
                        <div class="size-9 rounded-lg bg-orange-100 flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-orange-500 text-lg font-fill-1">local_fire_department</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-base font-bold text-slate-700">Jaga streak {{ $user->current_streak ?? 0 }} hari</p>
                            <div class="flex items-center gap-2 mt-1">
                                <div class="flex-1 bg-slate-100 h-2 rounded-full overflow-hidden">
                                    <div class="bg-orange-400 h-full rounded-full transition-all" style="width: {{ min(($user->current_streak ?? 0) * 20, 100) }}%"></div>
                                </div>
                                <span class="text-[10px] font-bold text-slate-400">{{ $user->current_streak ?? 0 }}/5</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    {{-- Empty Hearts Modal --}}
    <x-modal name="empty-hearts" maxWidth="md">
        <div class="p-8 text-center space-y-6 bg-white transition-colors">
            <div class="size-24 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-2">
                <span class="material-symbols-outlined text-6xl text-red-500 font-variation-settings: 'FILL' 1">heart_broken</span>
            </div>
            <h3 class="text-2xl font-black text-slate-800">Nyawa Kamu Habis!</h3>
            <p class="text-slate-500 font-medium">Jangan sedih, <strong class="text-slate-700">1 nyawa</strong> akan otomatis terisi setiap <strong class="text-slate-700">5 menit</strong>. Istirahat sejenak dan kembali lagi nanti!</p>
            
            <div class="bg-blue-50 p-4 rounded-xl flex items-center justify-center gap-3 border border-blue-100">
                <span class="material-symbols-outlined text-blue-500">timer</span>
                <span class="font-bold text-blue-700" 
                      x-data="{ seconds: Math.min({{ $remainingSeconds }}, 300) }" 
                      x-init="setInterval(() => { if(seconds > 0) seconds-- }, 1000)">
                    Waktu Tunggu Tersisa: 
                    <span x-text="Math.floor(seconds / 60)"></span> menit 
                    <span x-text="seconds % 60"></span> detik
                </span>
            </div>

            <button x-on:click="$dispatch('close-modal', 'empty-hearts')" class="w-full py-4 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-colors active:scale-95">
                Mengerti
            </button>
        </div>
    </x-modal>
</div>
