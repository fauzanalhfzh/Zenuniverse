<div class="min-h-screen flex flex-col items-center p-0 overflow-x-hidden relative font-sans transition-colors duration-300 bg-sky-50 text-slate-800 dark:bg-slate-900 dark:text-white">

    {{-- Inline Styles at the top --}}
    <style>
        .space-bg {
            background-image: radial-gradient(circle at 20% 30%, rgba(100, 200, 255, 0.15) 0%, transparent 40%),
                              radial-gradient(circle at 80% 70%, rgba(255, 200, 100, 0.1) 0%, transparent 40%);
        }
        .rocket-path { position: relative; }
        .rocket-path::after {
            content: '🚀';
            position: absolute;
            right: -10px;
            top: -12px;
            font-size: 20px;
        }
        .floating { animation: floating 3s ease-in-out infinite; }
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.5s ease-out forwards;
        }
        .font-display { font-family: 'Fredoka', sans-serif; }
        .prose-custom p { margin-bottom: 1rem; }
    </style>

    {{-- Background --}}
    <div class="fixed inset-0 pointer-events-none space-bg z-0" wire:ignore>
        <div class="absolute top-40 left-[10%] opacity-20 dark:opacity-40 floating" style="animation-delay: 0s;">
            <span class="material-symbols-outlined text-6xl text-blue-400">rocket_launch</span>
        </div>
        <div class="absolute bottom-40 right-[15%] opacity-20 dark:opacity-40 floating" style="animation-delay: 1s;">
            <span class="material-symbols-outlined text-7xl text-purple-400">language</span>
        </div>
        <div class="absolute top-1/2 left-10 opacity-10 dark:opacity-30 floating" style="animation-delay: 2s;">
            <span class="material-symbols-outlined text-5xl text-yellow-400">star</span>
        </div>
        <div class="absolute top-60 right-20 opacity-10 dark:opacity-30 floating" style="animation-delay: 1.5s;">
            <span class="material-symbols-outlined text-5xl text-pink-400">code</span>
        </div>
    </div>

    {{-- Header --}}
    <header class="relative z-20 w-full max-w-5xl px-6 py-8 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" wire:navigate class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
            <span class="material-symbols-outlined text-4xl">close</span>
        </a>
        
        <div class="flex-1 mx-8 h-4 bg-blue-100 dark:bg-slate-800 rounded-full relative">
            <div class="rocket-path absolute left-0 top-0 h-full bg-green-500 rounded-full transition-all duration-500 ease-out" style="width: {{ $progress }}%;"></div>
        </div>

        <div class="flex items-center gap-2 bg-white/50 dark:bg-red-900/20 px-4 py-2 rounded-full border border-blue-100 dark:border-red-900/30">
            <span class="material-symbols-outlined text-red-500 font-variation-settings: 'FILL' 1">favorite</span>
            <span class="font-bold text-red-600 dark:text-red-400 text-xl">{{ $hearts }}</span>
        </div>
    </header>

    {{-- Main Content --}}
    <main class="relative z-10 w-full max-w-4xl flex-1 flex flex-col items-center justify-center p-8 text-center space-y-10">
        
        @if($currentSlide['type'] === 'intro' || $currentSlide['type'] === 'text')
            <div wire:key="slide-intro-{{ $step }}" class="flex flex-col items-center space-y-6 animate-fade-in-up w-full">
                @if($currentSlide['image'])
                    <div class="relative">
                        <img alt="Illustration" class="w-64 h-64 md:w-80 md:h-80 object-contain floating" src="{{ asset($currentSlide['image']) }}"/>
                    </div>
                @endif

                <div class="space-y-6 max-w-2xl">
                    <h1 class="font-display text-4xl md:text-6xl font-bold text-slate-800 dark:text-white leading-tight">
                        {!! nl2br(e($currentSlide['title'])) !!}
                    </h1>
                    <div class="space-y-4 text-slate-600 dark:text-slate-300 text-lg md:text-2xl leading-relaxed prose-custom">
                        {!! \Illuminate\Support\Str::markdown($currentSlide['content']) !!}
                    </div>
                </div>

                <div class="pt-8 w-full flex justify-center">
                    <button 
                        type="button"
                        wire:click="nextStep"
                        wire:loading.attr="disabled"
                        class="flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 text-white font-display text-2xl font-bold py-5 px-20 rounded-2xl transition-all duration-200 active:scale-95 uppercase tracking-wide shadow-lg shadow-green-500/30">
                        <span wire:loading.remove wire:target="nextStep" class="flex items-center gap-3">
                            {{ $currentSlide['button_text'] ?? 'Lanjut' }}
                            <span class="material-symbols-outlined">arrow_forward</span>
                        </span>
                        <span wire:loading wire:target="nextStep" class="flex items-center gap-2">
                             <span class="animate-spin material-symbols-outlined">refresh</span>
                             Tunggu...
                        </span>
                    </button>
                </div>
            </div>
        @endif

        @if($currentSlide['type'] === 'quiz')
            <div wire:key="slide-quiz-{{ $step }}" x-data="{}" class="flex flex-col items-center space-y-8 animate-fade-in-up w-full max-w-2xl">
                <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md p-8 rounded-3xl shadow-xl border border-white/50 dark:border-slate-700 w-full">
                    <h2 class="text-3xl font-display font-bold text-slate-800 dark:text-white mb-8">{{ $currentSlide['title'] }}</h2>
                    <p class="text-xl text-slate-600 dark:text-slate-300 mb-8">{{ $currentSlide['content'] }}</p>
                    
                    <div class="space-y-4">
                        @foreach($currentSlide['options'] as $option)
                            @php $isCorrectStr = $option['correct'] ? 'true' : 'false'; @endphp
                            <button 
                                x-on:click="if(!$wire.isChecked) $wire.selectedAnswer = '{{ $option['id'] }}'"
                                class="w-full p-6 rounded-2xl border-2 flex items-center gap-4 text-xl font-bold transition-all transform active:scale-95 text-left relative overflow-hidden"
                                :class="{
                                    'bg-white dark:bg-slate-700 border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-600': $wire.selectedAnswer !== '{{ $option['id'] }}' && (!($wire.isChecked) || ($wire.isChecked && !{{ $isCorrectStr }})),
                                    'bg-blue-50 dark:bg-blue-900/30 border-blue-400 text-blue-500 dark:text-blue-300 ring-2 ring-blue-400 ring-offset-2 dark:ring-offset-slate-800': $wire.selectedAnswer === '{{ $option['id'] }}' && !$wire.isChecked,
                                    'bg-green-100 dark:bg-green-900/30 border-green-500 text-green-700 dark:text-green-300': $wire.isChecked && {{ $isCorrectStr }},
                                    'bg-red-100 dark:bg-red-900/30 border-red-500 text-red-700 dark:text-red-300': $wire.isChecked && $wire.selectedAnswer === '{{ $option['id'] }}' && !{{ $isCorrectStr }},
                                    'opacity-50 cursor-not-allowed': $wire.isChecked && $wire.selectedAnswer !== '{{ $option['id'] }}' && !{{ $isCorrectStr }}
                                }"
                                :disabled="$wire.isChecked"
                            >
                                <div class="w-10 h-10 rounded-xl border-2 flex items-center justify-center text-lg font-black shrink-0"
                                     :class="{
                                        'border-slate-200 dark:border-slate-500 text-slate-400 dark:text-slate-500': $wire.selectedAnswer !== '{{ $option['id'] }}' && (!($wire.isChecked) || ($wire.isChecked && !{{ $isCorrectStr }})),
                                        'border-blue-400 text-blue-400': $wire.selectedAnswer === '{{ $option['id'] }}' && !$wire.isChecked,
                                        'border-green-600 bg-green-500 text-white border-none': $wire.isChecked && {{ $isCorrectStr }},
                                        'border-red-500 bg-red-500 text-white border-none': $wire.isChecked && $wire.selectedAnswer === '{{ $option['id'] }}' && !{{ $isCorrectStr }}
                                     }">
                                    {{ $option['id'] }}
                                </div>
                                <span>{{ $option['text'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 dark:border-slate-700">
                         @if($isChecked)
                            <div class="space-y-4">
                                <div @class([
                                    'p-4 rounded-xl flex items-center gap-3',
                                    'bg-green-100 text-green-800 dark:bg-green-900/50 dark:text-green-200' => $isCorrect,
                                    'bg-red-100 text-red-800 dark:bg-red-900/50 dark:text-red-200' => !$isCorrect
                                ])>
                                    <span class="material-symbols-outlined text-2xl">{{ $isCorrect ? 'check_circle' : 'cancel' }}</span>
                                    <p class="font-bold text-lg">{{ $isCorrect ? 'Jawaban Tepat!' : 'Yah, kurang tepat.' }}</p>
                                </div>
                                <p class="text-slate-600 dark:text-slate-400 text-sm">{{ $currentSlide['explanation'] ?? '' }}</p>
                                <button wire:click="nextStep" class="w-full py-4 rounded-xl bg-green-500 hover:bg-green-600 text-white font-bold text-xl transition-all shadow-lg active:scale-95">Lanjut</button>
                            </div>
                        @else
                             <button wire:click="checkAnswer" 
                                class="w-full py-4 rounded-xl font-bold text-xl transition-all shadow-lg active:scale-95"
                                :class="{
                                    'bg-green-500 hover:bg-green-600 text-white': $wire.selectedAnswer !== null,
                                    'bg-slate-200 dark:bg-slate-700 text-slate-400 cursor-not-allowed': $wire.selectedAnswer === null
                                }"
                                :disabled="$wire.selectedAnswer === null">
                                <span wire:loading.remove wire:target="checkAnswer">Periksa Jawaban</span>
                                <span wire:loading wire:target="checkAnswer" class="flex items-center justify-center gap-2">
                                    <span class="animate-spin material-symbols-outlined">refresh</span> Memeriksa...
                                </span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif
    </main>

    {{-- Dark Mode Toggle --}}
    <div class="fixed bottom-6 left-6 z-50" x-data="{ 
        darkMode: localStorage.getItem('darkMode') === 'true',
        toggle() {
            this.darkMode = !this.darkMode;
            document.documentElement.classList.toggle('dark', this.darkMode);
            localStorage.setItem('darkMode', this.darkMode);
        },
        init() {
            if (this.darkMode) {
                document.documentElement.classList.add('dark');
            }
        }
    }">
        <button @click="toggle()" 
            class="group relative w-12 h-12 rounded-full bg-white/90 dark:bg-slate-800/90 backdrop-blur-md border border-slate-200 dark:border-slate-700 text-slate-500 dark:text-slate-400 shadow-lg shadow-slate-200/50 dark:shadow-black/30 hover:shadow-xl hover:scale-105 transition-all duration-300 flex items-center justify-center overflow-hidden">
            
            <div class="absolute inset-0 bg-gradient-to-tr from-blue-500/10 to-purple-500/10 dark:from-blue-400/10 dark:to-purple-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>

            <span class="material-symbols-outlined text-[20px] transition-all duration-500 rotate-0 scale-100 dark:-rotate-90 dark:scale-0 absolute">
                dark_mode
            </span>
            <span class="material-symbols-outlined text-[20px] transition-all duration-500 rotate-90 scale-0 dark:rotate-0 dark:scale-100 absolute text-yellow-400">
                light_mode
            </span>
        </button>
    </div>
</div>
