<div class="w-full max-w-4xl mx-auto flex flex-col items-center space-y-6 animate-fade-in-up">
    {{-- Header area --}}
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md p-6 rounded-3xl shadow-xl w-full border border-white/50 dark:border-slate-700">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-xl flex items-center justify-center text-blue-500 text-2xl shadow-inner">
                🧩
            </div>
            <h2 class="text-2xl md:text-3xl font-display font-bold text-slate-800 dark:text-white">
                {{ $currentSlide['title'] ?? 'Susun Kode' }}
            </h2>
        </div>
        <p class="text-lg text-slate-600 dark:text-slate-300">
            {!! nl2br(e($currentSlide['content'])) !!}
        </p>
    </div>

    {{-- Sortable area --}}
    <div class="w-full">
        <div x-ref="sortableList"
             x-init="initSortable($el, 'arrange')"
             class="space-y-3 w-full max-w-2xl mx-auto">
            @foreach($minigameData['blocks'] as $block)
                <div wire:key="block-{{ $block['id'] }}" 
                     data-id="{{ $block['id'] }}" 
                     class="group flex items-center gap-3 bg-slate-800 dark:bg-slate-900 text-slate-100 p-4 rounded-xl font-sans font-semibold text-base md:text-lg lg:text-xl shadow-lg cursor-grab active:cursor-grabbing border-l-4 border-blue-500 transition-transform duration-200">
                    <span class="drag-handle material-symbols-outlined text-slate-500 group-hover:text-blue-400 cursor-grab active:cursor-grabbing">drag_indicator</span>
                    <span class="step-number w-6 h-6 rounded-full bg-slate-700/50 text-slate-400 flex items-center justify-center text-xs shrink-0">{{ $loop->iteration }}</span>
                    <span class="flex-1">{{ $block['text'] }}</span>
                </div>
            @endforeach
        </div>

        <script>
            // Simple script to update step numbers visually without Alpine re-render
            function updateStepNumbers() {
                document.querySelectorAll('.step-number').forEach((span, i) => {
                    span.innerText = i + 1;
                });
            }
            // Initial call
            setTimeout(updateStepNumbers, 100);
        </script>
        
    </div>

    {{-- Submit / check --}}
    <div class="w-full max-w-2xl mx-auto pt-6 flex flex-col gap-4">
        @if($isChecked)
            <div class="space-y-4">
                {{-- Result banner --}}
                <div @class([
                    'p-4 rounded-xl flex items-start gap-3 animate-fade-in-up',
                    'bg-green-50 border-2 border-green-400 dark:bg-green-900/30 dark:border-green-600' => $isCorrect,
                    'bg-red-50 border-2 border-red-400 dark:bg-red-900/30 dark:border-red-600' => !$isCorrect
                ])>
                    <span @class([
                        'material-symbols-outlined text-2xl mt-0.5 shrink-0',
                        'text-green-600 dark:text-green-400' => $isCorrect,
                        'text-red-500 dark:text-red-400' => !$isCorrect,
                    ])>{{ $isCorrect ? 'check_circle' : 'cancel' }}</span>
                    <div class="text-left">
                        <p @class([
                            'font-black text-lg',
                            'text-green-700 dark:text-green-300' => $isCorrect,
                            'text-red-700 dark:text-red-300' => !$isCorrect,
                        ])>{{ $isCorrect ? 'Susunan Tepat! 🎉' : 'Urutan belum tepat. Coba lagi! 💡' }}</p>
                        @if(!empty($currentSlide['explanation']))
                        <div @class([
                            'mt-1 text-sm leading-relaxed prose prose-sm max-w-none',
                            'text-green-800 dark:text-green-200 prose-green' => $isCorrect,
                            'text-red-800 dark:text-red-200 prose-red' => !$isCorrect,
                        ])>
                            {!! \Illuminate\Support\Str::markdown($currentSlide['explanation']) !!}
                        </div>
                        @endif
                    </div>
                </div>
                
                @if($isCorrect)
                    <button wire:click="nextStep" class="w-full py-4 rounded-xl bg-green-500 hover:bg-green-600 text-white font-bold text-xl transition-all shadow-lg shadow-green-500/30 active:scale-95">Lanjut</button>
                @else
                    <button wire:click="resetMinigameCheck" class="w-full py-4 rounded-xl bg-slate-700 hover:bg-slate-800 text-white font-bold text-xl transition-all shadow-lg active:scale-95">Coba Lagi</button>
                @endif
            </div>
        @else
            <button wire:click="checkMinigame" class="w-full py-4 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-bold text-xl transition-all shadow-lg shadow-blue-500/30 active:scale-95 flex justify-center items-center gap-2">
                <span wire:loading.remove wire:target="checkMinigame">Periksa Susunan</span>
                <span wire:loading wire:target="checkMinigame" class="flex items-center gap-2">
                    <span class="animate-spin material-symbols-outlined">refresh</span> Memeriksa...
                </span>
            </button>
        @endif
    </div>
</div>
