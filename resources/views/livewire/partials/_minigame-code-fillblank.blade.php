<div class="w-full max-w-4xl mx-auto flex flex-col items-center space-y-6 animate-fade-in-up"
    x-data="{
        answers: @entangle('minigameData.answers'),
        options: @js($minigameData['options'] ?? []),
        selectFill(optionId) {
            for (let blankId in this.answers) {
                if (this.answers[blankId] === null || this.answers[blankId] === undefined) {
                    this.answers[blankId] = optionId;
                    break;
                }
            }
        },
        removeFill(blankId) {
            this.answers[blankId] = null;
        },
        isOptionUsed(optionId) {
            return Object.values(this.answers).includes(optionId);
        },
        getOptionText(ansId) {
            let opt = this.options.find(o => o.id === ansId);
            return opt ? opt.text : '?';
        }
    }">
    {{-- Header --}}
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md p-6 rounded-3xl shadow-xl w-full border border-white/50 dark:border-slate-700">
        <div class="flex items-center gap-4 mb-4">
            <div class="w-12 h-12 bg-pink-100 dark:bg-pink-900 rounded-xl flex items-center justify-center text-pink-500 text-2xl shadow-inner">
                📝
            </div>
            <h2 class="text-2xl md:text-3xl font-display font-bold text-slate-800 dark:text-white">
                {{ $currentSlide['title'] ?? 'Lengkapi Kode' }}
            </h2>
        </div>
        <p class="text-lg text-slate-600 dark:text-slate-300">
            {!! nl2br(e($currentSlide['content'])) !!}
        </p>
    </div>

    {{-- Code Block --}}
    <div class="w-full max-w-2xl mx-auto flex flex-col items-center gap-6">
        
        {{-- Terminal / Code view --}}
        <div class="w-full bg-slate-50 dark:bg-[#1e1e2e] p-6 rounded-2xl shadow-xl font-sans font-semibold text-lg md:text-xl text-slate-800 dark:text-[#cdd6f4] border-2 border-slate-200 dark:border-slate-700 leading-loose text-left overflow-x-auto">
            @foreach($minigameData['snippet'] as $index => $part)
                @if($part['type'] === 'text')
                    <span>{!! nl2br(e(str_replace('\n', "\n", $part['value']))) !!}</span>
                @else
                    {{-- Blank Slot --}}
                    <span 
                        @click="removeFill({{ $part['id'] }})"
                        class="inline-flex items-center justify-center min-w-[80px] h-10 px-4 mx-1 rounded-lg border-2 cursor-pointer transition-all active:scale-95"
                        :class="answers[{{ $part['id'] }}] !== null && answers[{{ $part['id'] }}] !== undefined 
                            ? 'bg-green-200 border-green-400 text-green-900 dark:bg-[#a6e3a1] dark:border-[#a6e3a1] dark:text-[#1e1e2e] font-bold shadow-md dark:shadow-[0_0_15px_rgba(166,227,161,0.5)]' 
                            : 'bg-transparent border-dashed border-slate-400 dark:border-[#585b70] hover:border-blue-400 hover:bg-blue-50 dark:hover:border-[#89b4fa] dark:hover:bg-[#89b4fa]/10'"
                    >
                        <span x-text="getOptionText(answers[{{ $part['id'] }}])"></span>
                    </span>
                @endif
            @endforeach
        </div>

        {{-- Options Box --}}
        <div class="w-full bg-slate-100 dark:bg-slate-800 p-6 rounded-2xl border border-slate-200 dark:border-slate-700">
            <h3 class="font-bold text-slate-500 mb-4 text-sm uppercase tracking-widest text-center">Pilihan Jawaban</h3>
            <div class="flex flex-wrap justify-center gap-3">
                @foreach($minigameData['options'] as $option)
                    @php
                        $bgClass = 'bg-blue-500 text-white border-blue-700 hover:bg-blue-400';
                    @endphp
                    <button 
                        @click="selectFill({{ $option['id'] }})"
                        :disabled="isOptionUsed({{ $option['id'] }})"
                        class="px-5 py-3 rounded-xl font-bold font-sans text-sm md:text-base border-b-4 transition-all active:scale-95 disabled:opacity-40 disabled:cursor-not-allowed {{ $bgClass }}">
                        {{ $option['text'] }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Validation --}}
    <div class="w-full max-w-2xl mx-auto pt-4 flex flex-col gap-4">
        @if($isChecked)
            <div class="space-y-4 animate-fade-in-up">
                {{-- Result banner --}}
                <div @class([
                    'p-4 rounded-xl flex items-start gap-3',
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
                        ])>{{ $isCorrect ? 'Kode Berhasil Dilengkapi! 🎉' : 'Ada yang masih salah. Periksa kembali! 💡' }}</p>
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
                    <button wire:click="nextStep" class="w-full py-4 rounded-xl bg-green-500 hover:bg-green-600 text-white font-bold text-xl transition-all shadow-lg active:scale-95">Lanjut</button>
                @else
                    <button wire:click="resetMinigameCheck" class="w-full py-4 rounded-xl bg-slate-700 hover:bg-slate-800 text-white font-bold text-xl transition-all shadow-lg active:scale-95">Coba Lagi</button>
                @endif
            </div>
        @else
            <button wire:click="checkMinigame" class="w-full py-4 rounded-xl bg-blue-500 hover:bg-blue-600 text-white font-bold text-xl transition-all shadow-lg shadow-blue-500/30 active:scale-95 flex justify-center items-center gap-2">
                <span wire:loading.remove wire:target="checkMinigame">Jalankan Kode</span>
                <span wire:loading wire:target="checkMinigame" class="flex items-center gap-2">
                    <span class="animate-spin material-symbols-outlined">refresh</span> Memeriksa...
                </span>
            </button>
        @endif
    </div>
</div>
