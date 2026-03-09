<div class="w-full max-w-5xl mx-auto flex flex-col items-center space-y-4 md:space-y-6 animate-fade-in-up">
    {{-- Header --}}
    <div class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md p-4 md:p-6 rounded-2xl md:rounded-3xl shadow-xl w-full border border-white/50 dark:border-slate-700">
        <div class="flex items-center gap-3 md:gap-4 mb-2 md:mb-4">
            <div class="w-10 h-10 md:w-12 md:h-12 bg-orange-100 dark:bg-orange-900 rounded-lg md:rounded-xl flex items-center justify-center text-orange-500 text-xl md:text-2xl shadow-inner">
                🔲
            </div>
            <h2 class="text-xl md:text-2xl lg:text-3xl font-display font-bold text-slate-800 dark:text-white">
                {{ $currentSlide['title'] ?? 'Pemrograman Blok' }}
            </h2>
        </div>
        <p class="text-base md:text-lg text-slate-600 dark:text-slate-300">
            {!! nl2br(e($currentSlide['content'])) !!}
        </p>
    </div>

    {{-- Block Workspace Container --}}
    <div x-data="{
        blocks: @js(array_values($minigameData['workspaceBlocks'] ?? [])).map(b => ({...b, _key: b._key || (Date.now() + '-' + Math.random())})),
        addBlock(block) {
            this.blocks.push({...block, _key: Date.now() + '-' + Math.random()});
            this.sync();
        },
        removeBlock(index) {
            this.blocks.splice(index, 1);
            this.sync();
        },
        sync() {
            this.workspaceCount = this.blocks.length;
            @this.call('updateWorkspaceOrder', this.blocks.map(b => b.id));
        }
    }" class="w-full flex flex-col lg:flex-row gap-4 md:gap-6 min-h-[400px]">
        
        {{-- Left: Block Palette --}}
        <div class="w-full lg:w-1/3 flex flex-col gap-4">
            <div class="bg-slate-100 dark:bg-slate-800 rounded-2xl p-4 shadow-inner min-h-[150px] lg:min-h-full border border-slate-200 dark:border-slate-700 flex flex-col">
                <h3 class="font-bold text-slate-500 uppercase tracking-widest text-xs md:text-sm mb-4">Blok Kode (Klik untuk tambah)</h3>
                
                <div class="space-y-3 min-h-[200px] p-2 overflow-y-auto pr-2">
                    @foreach($minigameData['paletteBlocks'] as $block)
                        <button type="button" 
                             @click="addBlock(@js($block))"
                             class="w-full flex items-center gap-2 p-3 rounded-lg md:rounded-xl font-bold font-sans text-sm md:text-base text-white shadow-[0_4px_0_rgba(0,0,0,0.2)] transform hover:-translate-y-1 transition-transform active:scale-95 text-left
                                {{ ($block['type'] ?? '') === 'action' ? 'bg-blue-500' : '' }}
                                {{ ($block['type'] ?? '') === 'logic' ? 'bg-orange-500' : '' }}
                                {{ ($block['type'] ?? '') === 'loop' ? 'bg-green-500' : '' }}
                                {{ ($block['type'] ?? '') === 'math' ? 'bg-purple-500' : '' }}
                                {{ !isset($block['type']) || !$block['type'] ? 'bg-indigo-500' : '' }}">
                            <span class="material-symbols-outlined text-white/50 text-sm md:text-base pointer-events-none">extension</span>
                            <span class="pointer-events-none">{{ $block['text'] }}</span>
                        </button>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Right: Workspace & Output --}}
        <div class="w-full lg:w-2/3 flex flex-col gap-4">
            
            {{-- Drop Area (Workspace) --}}
            <div class="bg-white dark:bg-[#1e1e2e] rounded-2xl p-4 md:p-6 shadow-xl border-2 border-dashed border-slate-300 dark:border-slate-600 min-h-[250px] md:min-h-[300px] flex flex-col group overflow-hidden">
                
                {{-- Header --}}
                <div class="flex items-center justify-between mb-2 md:mb-4">
                    <div class="flex items-center gap-2 text-slate-400 font-bold uppercase text-xs tracking-widest">
                        <span class="material-symbols-outlined text-lg">integration_instructions</span>
                        Area Kerja
                    </div>

                    {{-- Trash Can / Clear All --}}
                    <button type="button" x-show="blocks.length > 0" x-transition @click="blocks = []; sync()" class="px-3 py-1.5 md:px-4 md:py-2 bg-red-100 hover:bg-red-200 dark:bg-red-900/30 dark:hover:bg-red-900/50 text-red-600 dark:text-red-400 rounded-lg flex items-center gap-1.5 transition-colors active:scale-95 z-30 font-bold text-xs md:text-sm cursor-pointer" title="Hapus semua blok">
                         <span class="material-symbols-outlined text-[16px] md:text-[18px]">delete</span>
                         Hapus Semua
                    </button>
                </div>
                
                <div class="flex-1 w-full overflow-y-auto">
                    <div wire:ignore class="space-y-2 pb-10 min-h-[150px] flex flex-col items-start px-2">
                        
                        {{-- Render blocks dynamically from Alpine state --}}
                        <template x-for="(block, index) in blocks" :key="block._key">
                            <div class="flex items-center gap-2 p-3 md:p-4 rounded-xl font-bold font-sans text-sm md:text-base text-white shadow-[0_4px_0_rgba(0,0,0,0.2)] w-fit relative group/block"
                                 :class="{
                                     'bg-blue-500': block.type === 'action',
                                     'bg-orange-500': block.type === 'logic',
                                     'bg-green-500': block.type === 'loop',
                                     'bg-purple-500': block.type === 'math',
                                     'bg-indigo-500': !block.type
                                 }">
                                 
                                <div class="absolute -left-2 top-1/2 -translate-y-1/2 w-4 h-6 bg-slate-900/20 rounded-r-md pointer-events-none"></div>
                                <span class="material-symbols-outlined text-white/50 text-sm md:text-base pointer-events-none">extension</span>
                                <span class="pointer-events-none" x-text="block.text"></span>
                            </div>
                        </template>
                        
                        {{-- Empty state hint --}}
                        <div x-show="blocks.length === 0" class="w-full flex items-center justify-center py-8 px-2 text-slate-400 dark:text-slate-500 text-sm md:text-base italic pointer-events-none text-center leading-relaxed">
                            Klik blok di sebelah kiri untuk menambah...
                        </div>
                    </div>
                </div>
            </div>

            {{-- Execution Result / Validation --}}
            <div class="w-full flex flex-col gap-4">
                 @if($isChecked)
                    <div class="space-y-4 animate-fade-in-up">
                        <div @class([
                            'p-4 md:p-6 rounded-2xl flex items-center gap-3 md:gap-4 shadow-lg',
                            'bg-green-100/80 text-green-800 dark:bg-green-900/50 dark:text-green-200 border border-green-200 dark:border-green-800' => $isCorrect,
                            'bg-red-100/80 text-red-800 dark:bg-red-900/50 dark:text-red-200 border border-red-200 dark:border-red-800' => !$isCorrect
                        ])>
                            <span class="material-symbols-outlined text-4xl md:text-5xl">{{ $isCorrect ? 'check_circle' : 'cancel' }}</span>
                            <div>
                                <h4 class="font-display font-bold text-xl md:text-2xl">{{ $isCorrect ? 'Program Berhasil! 🎉' : 'Oops, ada yang salah! 💡' }}</h4>
                                <p class="text-sm md:text-base opacity-80">{{ $isCorrect ? 'Blok kode kamu tersusun dengan benar.' : 'Coba periksa lagi urutan atau blok yang kamu gunakan.' }}</p>
                            </div>
                        </div>
                        
                        @if($isCorrect && $currentSlide['explanation'])
                            <div class="bg-blue-50 dark:bg-blue-900/20 p-4 md:p-5 rounded-xl text-blue-800 dark:text-blue-200 border border-blue-100 dark:border-blue-800">
                                <p class="text-sm md:text-base">{{ $currentSlide['explanation'] }}</p>
                             </div>
                        @endif
                        
                        @if($isCorrect)
                            <button wire:click="nextStep" class="w-full py-4 md:py-5 rounded-2xl bg-green-500 hover:bg-green-600 text-white font-bold text-xl md:text-2xl transition-all shadow-lg shadow-green-500/30 active:scale-95 flex justify-center items-center gap-2">
                                Lanjut <span class="material-symbols-outlined">arrow_forward</span>
                            </button>
                        @else
                            <button wire:click="resetMinigameCheck" class="w-full py-4 md:py-5 rounded-2xl bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-xl md:text-2xl transition-all shadow-lg shadow-yellow-500/30 active:scale-95 flex justify-center items-center gap-2">
                                <span class="material-symbols-outlined">refresh</span> Coba Lagi
                            </button>
                        @endif
                    </div>
                @else
                    <button wire:click="checkMinigame" 
                            class="w-full py-4 md:py-5 rounded-2xl text-white font-bold text-xl md:text-2xl transition-all shadow-lg active:scale-95 flex justify-center items-center gap-3 group"
                            :class="blocks.length > 0 ? 'bg-indigo-500 hover:bg-indigo-600 shadow-indigo-500/30' : 'bg-slate-300 dark:bg-slate-700 text-slate-500 cursor-not-allowed'"
                            :disabled="blocks.length === 0">
                        <span wire:loading.remove wire:target="checkMinigame" class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-3xl group-hover:scale-110 transition-transform">play_arrow</span> Jalankan Program
                        </span>
                        <span wire:loading wire:target="checkMinigame" class="flex items-center gap-2">
                            <span class="animate-spin material-symbols-outlined">refresh</span> Menjalankan...
                        </span>
                    </button>
                @endif
            </div>

        </div>
        
    </div>
</div>
