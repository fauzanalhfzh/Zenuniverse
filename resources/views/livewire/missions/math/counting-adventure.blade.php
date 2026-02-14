<div class="min-h-screen bg-sky-100 flex flex-col items-center justify-center p-4 relative overflow-hidden font-lexend">
    <!-- Background Elements -->
    <div class="absolute top-0 left-0 w-full h-full pointer-events-none">
        <div class="absolute top-10 left-10 text-6xl opacity-20 animate-bounce">☁️</div>
        <div class="absolute top-20 right-20 text-8xl opacity-20 animate-pulse">☀️</div>
        <div class="absolute bottom-0 w-full h-1/3 bg-green-200 rounded-t-[50%] scale-150"></div>
    </div>

    <!-- Game Container -->
    <div class="relative z-10 w-full max-w-2xl bg-white/80 backdrop-blur-sm rounded-3xl shadow-2xl border-8 border-white p-6 md:p-10">
        
        <!-- Header: Progress & Hearts -->
        <div class="flex justify-between items-center mb-8">
            <div class="flex gap-2">
                @for($i=0; $i<$hearts; $i++)
                    <span class="text-3xl animate-pulse text-red-500">❤️</span>
                @endfor
            </div>
            <div class="text-2xl font-black text-slate-700 bg-white px-6 py-2 rounded-full shadow-sm border-2 border-slate-100">
                Level {{ $currentLevel }} / {{ $maxLevels }}
            </div>
        </div>

        <!-- Question Area -->
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-black text-slate-800 mb-6">Ayo Hitung Buah Apel! 🍎</h2>
            
            <!-- Visual Counting Object -->
            <div class="flex flex-wrap justify-center gap-4 bg-blue-50 p-8 rounded-3xl border-4 border-blue-100 min-h-[200px] items-center">
                @for($i=0; $i<$targetNumber; $i++)
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-red-400 rounded-full shadow-lg relative flex items-center justify-center animate-bounce" style="animation-delay: {{ $i * 100 }}ms">
                        <span class="absolute top-0 right-2 w-4 h-6 bg-green-500 rounded-full rotate-45"></span>
                        <span class="text-white font-black text-2xl opacity-50">{{ $i + 1 }}</span>
                    </div>
                @endfor
            </div>
        </div>

        <!-- Options Grid -->
        <div class="grid grid-cols-3 gap-4 md:gap-8">
            @foreach($options as $option)
                <button 
                    wire:click="selectAnswer({{ $option }})"
                    class="sound-click group relative w-full aspect-square rounded-3xl border-b-8 transition-all active:border-b-0 active:translate-y-2
                    {{ $isChecked && $option === $targetNumber ? 'bg-green-500 border-green-700 text-white' : '' }}
                    {{ $isChecked && $option === $selectedAnswer && $option !== $targetNumber ? 'bg-red-500 border-red-700 text-white' : '' }}
                    {{ !$isChecked ? 'bg-white border-slate-200 hover:border-blue-400 hover:-translate-y-1' : '' }}
                    "
                    {{ $isChecked ? 'disabled' : '' }}
                >
                    <span class="text-4xl md:text-6xl font-black">{{ $option }}</span>
                    
                    @if($isChecked && $option === $targetNumber)
                        <div class="absolute -top-4 -right-4 bg-yellow-400 text-white p-2 rounded-full shadow-lg animate-bounce">
                            <span class="material-symbols-outlined text-2xl">star</span>
                        </div>
                    @endif
                </button>
            @endforeach
        </div>

        <!-- Next Level Button -->
        @if($isChecked)
            <div class="mt-8 text-center animate-fade-in-up">
                <button wire:click="nextLevel" class="sound-click bubbly-button px-10 py-4 bg-yellow-400 text-yellow-900 border-b-4 border-yellow-600 rounded-2xl text-2xl font-black hover:brightness-110 active:border-b-0 active:translate-y-1">
                    {{ $currentLevel < $maxLevels ? 'Lanjut Level! 🚀' : 'Selesai! 🎉' }}
                </button>
            </div>
        @endif
    </div>
</div>
