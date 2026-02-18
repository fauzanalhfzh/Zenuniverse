<div class="min-h-screen flex flex-col bg-white max-w-2xl mx-auto shadow-2xl relative overflow-hidden">
    <!-- Top Bar -->
    <div class="px-6 py-6 flex items-center gap-4">
        <a href="{{ route('dashboard') }}" wire:navigate class="text-slate-300 hover:text-slate-400 transition-colors">
            <span class="material-symbols-outlined">arrow_back</span>
        </a>
        <div class="flex-1 h-4 bg-slate-100 rounded-full overflow-hidden">
            <div class="h-full bg-green-500 transition-all duration-500 ease-out rounded-full" style="width: {{ $progress }}%"></div>
        </div>
        <div class="flex items-center gap-1 text-red-500 font-bold text-lg">
            <span class="material-symbols-outlined font-fill-1 text-2xl">favorite</span>
            <span>{{ $hearts }}</span>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col px-6 pb-32 overflow-y-auto">
        <!-- Intro Slide -->
        @if($currentSlide['type'] === 'intro')
            <div wire:key="slide-intro-{{ $step }}" class="flex-1 flex flex-col items-center justify-center text-center space-y-8 animate-fade-in-up">
                <div class="relative w-64 h-64">
                    <div class="absolute inset-0 bg-blue-100 rounded-full blur-2xl opacity-60"></div>
                    <img src="{{ asset($currentSlide['image']) }}" alt="Illustration" class="relative z-10 w-full h-full object-contain animate-bounce" style="animation-duration: 3s">
                </div>
                
                <h1 class="text-3xl font-black text-slate-800">{{ $currentSlide['title'] }}</h1>
                <p class="text-xl text-slate-500 font-medium leading-relaxed max-w-md">
                    {{ $currentSlide['content'] }}
                </p>
            </div>
        @endif

        <!-- Quiz Slide -->
        @if($currentSlide['type'] === 'quiz')
            <div wire:key="slide-quiz-{{ $step }}" class="flex-1 flex flex-col justify-center animate-fade-in-up">
                <h2 class="text-2xl font-black text-slate-800 mb-8">{{ $currentSlide['question'] }}</h2>
                
                <div class="space-y-4">
                    @foreach($currentSlide['options'] as $option)
                        <button 
                            wire:click="selectAnswer('{{ $option['id'] }}')"
                            @class([
                                'w-full p-4 rounded-2xl border-b-4 border-2 flex items-center gap-4 text-lg font-bold transition-all transform active:scale-95 text-left',
                                'bg-white border-slate-200 text-slate-600 hover:bg-slate-50' => $selectedAnswer !== $option['id'],
                                'bg-blue-50 border-blue-400 border-b-blue-400 text-blue-500 ring-2 ring-blue-400 ring-offset-2' => $selectedAnswer === $option['id'] && !$isChecked,
                                'bg-green-100 border-green-500 text-green-700' => $isChecked && $option['correct'],
                                'bg-red-100 border-red-500 text-red-700' => $isChecked && $selectedAnswer === $option['id'] && !$option['correct'],
                                'opacity-50 cursor-not-allowed' => $isChecked && $selectedAnswer !== $option['id'] && !$option['correct']
                            ])
                            {{ $isChecked ? 'disabled' : '' }}
                        >
                            <div @class([
                                'w-8 h-8 rounded-lg border-2 flex items-center justify-center text-sm font-black',
                                'border-slate-200 text-slate-400' => $selectedAnswer !== $option['id'] && !$isChecked,
                                'border-blue-400 text-blue-400' => $selectedAnswer === $option['id'] && !$isChecked,
                                'border-green-600 bg-green-500 text-white border-none' => $isChecked && $option['correct'],
                                'border-red-500 bg-red-500 text-white border-none' => $isChecked && $selectedAnswer === $option['id'] && !$option['correct']
                            ])>
                                {{ chr(64 + $loop->iteration) }}
                            </div>
                            {{ $option['text'] }}
                        </button>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- Bottom Action Bar -->
    <div class="border-t-2 border-slate-100 bg-white p-6 relative z-20 min-h-[120px] flex flex-col justify-center">
        @if($isChecked)
            <!-- Feedback State -->
            <div wire:key="feedback-bar-{{ $step }}" @class([
                'p-4 rounded-2xl flex flex-col justify-between gap-4',
                'bg-green-100 text-green-700' => $isCorrect,
                'bg-red-100 text-red-700' => !$isCorrect
            ])>
                <div class="flex items-center gap-4">
                    <div @class([
                        'w-10 h-10 rounded-full flex items-center justify-center text-xl shadow-sm bg-white',
                        'text-green-500' => $isCorrect,
                        'text-red-500' => !$isCorrect
                    ])>
                        <span class="material-symbols-outlined font-black">
                            {{ $isCorrect ? 'check' : 'close' }}
                        </span>
                    </div>
                    <h3 class="text-lg font-black italic">
                        {{ $isCorrect ? 'Kerja Bagus!' : 'Kurang Tepat...' }}
                    </h3>
                </div>
                
                <button type="button" 
                    wire:click.prevent="nextStep()" 
                    wire:key="btn-next-feedback-{{ $step }}" 
                    wire:loading.attr="disabled"
                    @class([
                        'w-full py-4 rounded-2xl text-white text-xl font-black uppercase tracking-widest shadow-lg transform transition-transform active:translate-y-1 flex items-center justify-center gap-2',
                        'bg-green-500 shadow-green-700' => $isCorrect,
                        'bg-red-500 shadow-red-700' => !$isCorrect
                    ])>
                    <span wire:loading.remove wire:target="nextStep">Lanjut</span>
                    <span wire:loading wire:target="nextStep" class="animate-spin">🔄</span>
                </button>
            </div>
        @else
            <!-- Default State -->
            <div wire:key="default-bar-{{ $step }}" class="flex justify-end items-center">
                @if($currentSlide['type'] === 'intro')
                    <button type="button" 
                        wire:click.prevent="nextStep()" 
                        wire:key="btn-next-intro-{{ $step }}" 
                        wire:loading.attr="disabled"
                        class="w-full md:w-auto px-12 py-4 rounded-2xl bg-green-500 text-white text-xl font-black uppercase tracking-widest shadow-[0_4px_0_#15803d] active:shadow-none active:translate-y-[4px] transition-all flex items-center justify-center gap-2"
                    >
                        <span wire:loading.remove wire:target="nextStep">Lanjut</span>
                        <span wire:loading wire:target="nextStep" class="animate-spin">🔄</span>
                    </button>
                @else
                    <button type="button" 
                        wire:click.prevent="checkAnswer()" 
                        wire:key="btn-check-{{ $step }}"
                        wire:loading.attr="disabled"
                        @class([
                            'w-full md:w-auto px-12 py-4 rounded-2xl text-white text-xl font-black uppercase tracking-widest shadow-[0_4px_0_rgb(0,0,0,0.2)] transition-all flex items-center justify-center gap-2',
                            'bg-green-500 shadow-[0_4px_0_#15803d] active:shadow-none active:translate-y-[4px]' => $selectedAnswer !== null,
                            'bg-slate-200 text-slate-400 cursor-not-allowed shadow-[0_4px_0_#e2e8f0]' => $selectedAnswer === null
                        ])
                        {{ $selectedAnswer === null ? 'disabled' : '' }}
                    >
                        <span wire:loading.remove wire:target="checkAnswer">Periksa</span>
                        <span wire:loading wire:target="checkAnswer" class="animate-spin">🔄</span>
                    </button>
                @endif
            </div>
        @endif
    </div>


    <style>
        @keyframes fade-in-up {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fade-in-up 0.5s ease-out forwards;
        }
        @keyframes slide-up {
            from { transform: translateY(100%); }
            to { transform: translateY(0); }
        }
        .animate-slide-up {
            animation: slide-up 0.3s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</div>
