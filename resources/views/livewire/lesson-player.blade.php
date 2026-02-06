<div class="min-h-screen bg-gray-50 dark:bg-gray-900 flex flex-col">
    {{-- Header Navigation --}}
    <div class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 p-4 flex items-center justify-between sticky top-0 z-50">
        <a href="{{ route('dashboard') }}" class="flex items-center text-gray-500 hover:text-indigo-600 dark:hover:text-indigo-400 transition">
            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            <span class="font-bold">Kembali ke Dashboard</span>
        </a>
        <div class="text-sm font-medium text-gray-500 dark:text-gray-400">
            {{ $lesson->course->title }} • Pelajaran {{ $lesson->order }}
        </div>
    </div>

    {{-- Content Area --}}
    <main class="flex-grow max-w-4xl mx-auto w-full p-6 md:p-10">
        <div class="bg-white dark:bg-gray-800 shadow-xl rounded-2xl overflow-hidden">
            
            {{-- Result Screen --}}
            @if($quizCompleted)
                <div class="p-8 text-center space-y-6">
                    <div class="text-6xl">{{ $score >= 70 ? '🎉' : '😢' }}</div>
                    <h2 class="text-3xl font-bold {{ $score >= 70 ? 'text-green-600' : 'text-red-500' }}">
                        Nilai Kamu: {{ $score }}
                    </h2>
                    
                    @if($score >= 70)
                        <div class="bg-green-100 text-green-800 p-4 rounded-xl inline-block">
                            +{{ $lesson->xp_reward }} XP Ditambahkan!
                        </div>
                        <div class="pt-4">
                            @if($this->nextLesson)
                                <a href="{{ route('lesson.show', $this->nextLesson->id) }}" class="px-8 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 shadow-lg">Lanjut Materi Berikutnya →</a>
                            @else
                                <a href="{{ route('dashboard') }}" class="px-8 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 shadow-lg">Kembali ke Dashboard</a>
                            @endif
                        </div>
                    @else
                        <p class="text-gray-600">Yah, belum lulus. Coba baca materi lagi ya!</p>
                        <button wire:click="$set('quizCompleted', false); $set('isQuizMode', false)" class="px-8 py-3 rounded-xl bg-gray-200 text-gray-800 font-bold hover:bg-gray-300">Ulangi Materi 📚</button>
                    @endif
                </div>

            {{-- Quiz Mode --}}
            @elseif($isQuizMode)
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Kuis: {{ $lesson->title }}</h2>
                    
                    <div class="space-y-8">
                        @foreach($lesson->questions as $questions)
                            <div class="bg-gray-50 dark:bg-gray-700/50 p-6 rounded-xl border border-gray-200 dark:border-gray-600">
                                <p class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">{{ $loop->iteration }}. {{ $questions->question }}</p>
                                <div class="space-y-3">
                                    @foreach($questions->options as $key => $option)
                                        <label class="flex items-center space-x-3 p-3 rounded-lg border cursor-pointer hover:bg-indigo-50 dark:hover:bg-indigo-900/30 transition {{ isset($userAnswers[$questions->id]) && $userAnswers[$questions->id] == $key ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/30 ring-1 ring-indigo-500' : 'border-gray-200 dark:border-gray-600' }}">
                                            <input type="radio" name="question_{{ $questions->id }}" value="{{ $key }}" wire:click="selectAnswer({{ $questions->id }}, '{{ $key }}')" class="text-indigo-600 focus:ring-indigo-500">
                                            <span class="text-gray-700 dark:text-gray-300">{{ $key }}. {{ $option }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8 flex justify-end">
                        <button wire:click="submitQuiz" class="px-8 py-3 rounded-xl bg-green-500 text-white font-bold hover:bg-green-600 shadow-lg transform hover:scale-105 transition">
                            Kirim Jawaban 🚀
                        </button>
                    </div>
                </div>

            {{-- Learning Mode (Video + Text) --}}
            @else
                {{-- Video Section --}}
                @if($lesson->video_url)
                    <div class="aspect-video w-full bg-black">
                        <iframe class="w-full h-full" src="{{ $lesson->video_url }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
                    </div>
                @endif

                {{-- Text Content --}}
                <div class="p-8 prose dark:prose-invert max-w-none">
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-4">{{ $lesson->title }}</h1>
                    <div class="text-gray-600 dark:text-gray-300 leading-relaxed text-lg">
                        {!! nl2br(e($lesson->content)) !!}
                    </div>
                </div>
            @endif

            {{-- Navigation Footer (Only show in Learning Mode) --}}
            @if(!$isQuizMode && !$quizCompleted)
                <div class="bg-gray-50 dark:bg-gray-700/50 p-6 flex justify-between items-center border-t border-gray-100 dark:border-gray-700">
                    
                    {{-- Previous Button --}}
                    @if($this->prevLesson)
                        <a href="{{ route('lesson.show', $this->prevLesson->id) }}" class="px-6 py-3 rounded-xl bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 font-bold hover:bg-gray-50 dark:hover:bg-gray-700 transition shadow-sm">
                            ← Sebelumnya
                        </a>
                    @else
                        <div></div> {{-- Spacer --}}
                    @endif

                    {{-- Next / Start Quiz Button --}}
                    @if(count($lesson->questions) > 0)
                        <button wire:click="startQuiz" class="px-8 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition shadow-lg animate-pulse">
                            Mulai Kuis 📝
                        </button>
                    @elseif($this->nextLesson)
                         {{-- No Quiz, just next --}}
                        <a href="{{ route('lesson.show', $this->nextLesson->id) }}" wire:click="completeLesson" class="px-6 py-3 rounded-xl bg-indigo-600 text-white font-bold hover:bg-indigo-700 transition shadow-lg flex items-center">
                            Selesai & Lanjut <span class="ml-2">→</span>
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" wire:click="completeLesson" class="px-6 py-3 rounded-xl bg-green-600 text-white font-bold hover:bg-green-700 transition shadow-lg flex items-center">
                            Selesai Semua! 🏆
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </main>
</div>
