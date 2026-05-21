<div
    class="min-h-screen flex flex-col items-center p-0 overflow-x-hidden relative font-sans transition-colors duration-300 bg-sky-50 text-slate-800 dark:bg-slate-900 dark:text-white">





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
    <header class="relative z-20 w-full max-w-5xl px-4 md:px-6 py-4 md:py-8 flex items-center justify-between">
        <a href="{{ route('dashboard') }}" wire:navigate
            class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 transition-colors">
            <span class="material-symbols-outlined text-4xl">close</span>
        </a>

        {{-- Step dots indicator --}}
        <div class="flex-1 mx-4 md:mx-8 flex flex-col items-center justify-center gap-1 overflow-hidden">
            @php $totalSteps = count($slides); @endphp
            <div class="flex items-center justify-center gap-1.5">
                @for ($i = 0; $i < $totalSteps; $i++)
                    @if ($i === $step)
                        <div
                            class="h-3 w-6 rounded-full transition-all duration-300 shrink-0 {{ $isRetrying ? 'bg-orange-400' : 'bg-green-500' }}">
                        </div>
                    @elseif($i < $step)
                        <div class="h-3 w-3 rounded-full shrink-0 {{ $isRetrying ? 'bg-orange-300' : 'bg-green-400' }}">
                        </div>
                    @else
                        <div class="h-3 w-3 rounded-full bg-blue-100 dark:bg-slate-700 shrink-0"></div>
                    @endif
                @endfor
            </div>
            @if ($isRetrying)
                <div
                    class="flex items-center gap-1 bg-orange-100 dark:bg-orange-900/30 text-orange-600 dark:text-orange-400 text-[10px] font-black uppercase tracking-wider px-2 py-0.5 rounded-full">
                    <span class="material-symbols-outlined text-xs">replay</span> Ulangi soal salah
                </div>
            @endif
        </div>

        <div class="flex items-center gap-3">
            {{-- Earned XP display --}}
            <div
                class="flex items-center gap-1 bg-yellow-50 dark:bg-yellow-900/20 px-3 py-2 rounded-full border border-yellow-200 dark:border-yellow-700">
                <span class="text-sm">⭐</span>
                <span class="font-bold text-yellow-600 dark:text-yellow-400 text-sm">{{ $earnedXp }}</span>
            </div>
            {{-- Hearts --}}
            <div
                class="flex items-center gap-2 bg-white/50 dark:bg-red-900/20 px-4 py-2 rounded-full border border-blue-100 dark:border-red-900/30">
                <span class="material-symbols-outlined text-red-500 font-variation-settings: 'FILL' 1">favorite</span>
                <span class="font-bold text-red-600 dark:text-red-400 text-xl">{{ $hearts }}</span>
            </div>
        </div>

        {{-- Audio Elements --}}
        <audio id="sound-correct" src="{{ asset('sounds/correct-answer.mp3') }}" preload="auto"></audio>
        <audio id="sound-incorrect" src="{{ asset('sounds/wrong-answer.mp3') }}" preload="auto"></audio>
        <audio id="sound-completed" src="{{ asset('sounds/lesson-complete.mp3') }}" preload="auto"></audio>
    </header>

    {{-- Main Content --}}
    <main
        class="relative z-10 w-full max-w-4xl flex-1 flex flex-col items-center justify-center p-4 md:p-8 text-center space-y-6 md:space-y-10"
        x-data="{ showXp: false }" x-init="window.addEventListener('show-xp-pop', () => { showXp = true;
            setTimeout(() => showXp = false, 1400); });">

        {{-- Global Floating XP pop --}}
        <div class="fixed top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 pointer-events-none z-60">
            <div x-show="showXp" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100"
                class="xp-pop bg-yellow-400 text-white font-display font-black text-2xl px-8 py-3 rounded-full shadow-2xl shadow-yellow-400/50 whitespace-nowrap"
                style="display:none">
                ⭐ +10 XP
            </div>
        </div>

        @if ($currentSlide['type'] === 'intro' || $currentSlide['type'] === 'text')
            <div wire:key="slide-intro-{{ $step }}"
                class="flex flex-col items-center space-y-6 animate-fade-in-up w-full">
                @if ($currentSlide['image'])
                    <div class="relative">
                        <img alt="Illustration" class="w-64 h-64 md:w-80 md:h-80 object-contain floating"
                            src="{{ asset($currentSlide['image']) }}" />
                    </div>
                @endif

                <div class="space-y-6 max-w-2xl">
                    <h1
                        class="font-display text-3xl md:text-4xl lg:text-6xl font-bold text-slate-800 dark:text-white leading-tight">
                        {!! nl2br(e($currentSlide['title'])) !!}
                    </h1>
                    <div
                        class="space-y-4 text-slate-600 dark:text-slate-300 text-base md:text-lg lg:text-2xl leading-relaxed prose-custom">
                        {!! \Illuminate\Support\Str::markdown($currentSlide['content']) !!}
                    </div>
                </div>

                {{-- Player Audio --}}
                @if ($currentSlide['audio_url'])
                    <div class="w-full max-w-md bg-white/80 dark:bg-slate-800/80 backdrop-blur-md rounded-2xl p-4 md:p-6 shadow-xl border border-white/50 dark:border-slate-700 animate-fade-in-up"
                        style="animation-delay: 0.2s;">
                        <audio controls class="w-full h-12" src="{{ asset('storage/' . $currentSlide['audio_url']) }}">
                            Your browser does not support the audio element.
                        </audio>
                    </div>
                @endif

                <div class="pt-8 w-full flex justify-center">
                    <button type="button" wire:click="nextStep" wire:loading.attr="disabled"
                        class="flex items-center justify-center gap-3 bg-green-500 hover:bg-green-600 text-white font-display text-lg md:text-2xl font-bold py-4 px-10 md:py-5 md:px-20 rounded-2xl transition-all duration-200 active:scale-95 uppercase tracking-wide shadow-lg shadow-green-500/30">
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

        @if ($currentSlide['type'] === 'quiz')
            <div wire:key="slide-quiz-{{ $step }}" x-data="{}"
                class="flex flex-col items-center space-y-6 md:space-y-8 animate-fade-in-up w-full max-w-2xl">
                <div
                    class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md p-5 md:p-8 rounded-2xl md:rounded-3xl shadow-xl border border-white/50 dark:border-slate-700 w-full">
                    <h2 class="text-xl md:text-3xl font-display font-bold text-slate-800 dark:text-white mb-4 md:mb-8">
                        {{ $currentSlide['title'] }}
                    </h2>
                    <p class="text-base md:text-xl text-slate-600 dark:text-slate-300 mb-4 md:mb-8">
                        {{ $currentSlide['content'] }}
                    </p>

                    <div class="space-y-4">
                        @foreach ($currentSlide['options'] as $option)
                            @php $isCorrectStr = $option['correct'] ? 'true' : 'false'; @endphp
                            <button x-on:click="if(!$wire.isChecked) $wire.selectedAnswer = '{{ $option['id'] }}'"
                                class="w-full p-4 md:p-6 rounded-xl md:rounded-2xl border-2 flex items-center gap-3 md:gap-4 text-base md:text-xl font-bold transition-all transform active:scale-95 text-left relative overflow-hidden"
                                :class="{
                                    'bg-white dark:bg-slate-700 border-slate-200 dark:border-slate-600 text-slate-600 dark:text-slate-200 hover:bg-slate-50 dark:hover:bg-slate-600': $wire
                                        .selectedAnswer !== '{{ $option['id'] }}' && (!($wire.isChecked) || ($wire
                                            .isChecked && !{{ $isCorrectStr }})),
                                    'bg-blue-50 dark:bg-blue-900/30 border-blue-400 text-blue-500 dark:text-blue-300 ring-2 ring-blue-400 ring-offset-2 dark:ring-offset-slate-800': $wire
                                        .selectedAnswer === '{{ $option['id'] }}' && !$wire.isChecked,
                                    'bg-green-100 dark:bg-green-900/30 border-green-500 text-green-700 dark:text-green-300': $wire
                                        .isChecked && {{ $isCorrectStr }},
                                    'bg-red-100 dark:bg-red-900/30 border-red-500 text-red-700 dark:text-red-300': $wire
                                        .isChecked && $wire.selectedAnswer === '{{ $option['id'] }}' && !
                                        {{ $isCorrectStr }},
                                    'opacity-50 cursor-not-allowed': $wire.isChecked && $wire
                                        .selectedAnswer !== '{{ $option['id'] }}' && !{{ $isCorrectStr }}
                                }"
                                :disabled="$wire.isChecked">
                                <div class="w-8 h-8 md:w-10 md:h-10 rounded-lg md:rounded-xl border-2 flex items-center justify-center text-base md:text-lg font-black shrink-0"
                                    :class="{
                                        'border-slate-200 dark:border-slate-500 text-slate-400 dark:text-slate-500': $wire
                                            .selectedAnswer !== '{{ $option['id'] }}' && (!($wire.isChecked) || ($wire
                                                .isChecked && !{{ $isCorrectStr }})),
                                        'border-blue-400 text-blue-400': $wire
                                            .selectedAnswer === '{{ $option['id'] }}' && !$wire.isChecked,
                                        'border-green-600 bg-green-500 text-white border-none': $wire.isChecked &&
                                            {{ $isCorrectStr }},
                                        'border-red-500 bg-red-500 text-white border-none': $wire.isChecked && $wire
                                            .selectedAnswer === '{{ $option['id'] }}' && !{{ $isCorrectStr }}
                                    }">
                                    {{ $option['id'] }}
                                </div>
                                <span>{{ $option['text'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="mt-6 md:mt-8 pt-4 md:pt-6 border-t border-slate-100 dark:border-slate-700">
                        @if ($isChecked)
                            <div class="space-y-4">
                                {{-- Result banner --}}
                                <div @class([
                                    'p-4 rounded-xl flex items-start gap-3',
                                    'bg-green-50 border-2 border-green-400 dark:bg-green-900/30 dark:border-green-600' => $isCorrect,
                                    'bg-red-50 border-2 border-red-400 dark:bg-red-900/30 dark:border-red-600' => !$isCorrect,
                                ])>
                                    <span
                                        @class([
                                            'material-symbols-outlined text-2xl mt-0.5 shrink-0',
                                            'text-green-600 dark:text-green-400' => $isCorrect,
                                            'text-red-500 dark:text-red-400' => !$isCorrect,
                                        ])>{{ $isCorrect ? 'check_circle' : 'cancel' }}</span>
                                    <div class="text-left">
                                        <p @class([
                                            'font-black text-lg',
                                            'text-green-700 dark:text-green-300' => $isCorrect,
                                            'text-red-700 dark:text-red-300' => !$isCorrect,
                                        ])>
                                            {{ $isCorrect ? 'Jawaban Tepat! 🎉' : 'Yah, kurang tepat.' }}
                                        </p>
                                        @if (!empty($currentSlide['explanation']))
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
                                <button wire:click="nextStep"
                                    class="w-full py-4 rounded-xl font-bold text-xl transition-all shadow-lg active:scale-95 {{ $isCorrect ? 'bg-green-500 hover:bg-green-600 text-white' : 'bg-slate-700 hover:bg-slate-800 text-white' }}">Lanjut</button>
                            </div>
                        @else
                            <button wire:click="checkAnswer"
                                class="w-full py-4 rounded-xl font-bold text-xl transition-all shadow-lg active:scale-95"
                                :class="{
                                    'bg-green-500 hover:bg-green-600 text-white': $wire.selectedAnswer !== null,
                                    'bg-slate-200 dark:bg-slate-700 text-slate-400 cursor-not-allowed': $wire
                                        .selectedAnswer === null
                                }"
                                :disabled="$wire.selectedAnswer === null">
                                <span wire:loading.remove wire:target="checkAnswer">Periksa Jawaban</span>
                                <span wire:loading wire:target="checkAnswer"
                                    class="flex items-center justify-center gap-2">
                                    <span class="animate-spin material-symbols-outlined">refresh</span> Memeriksa...
                                </span>
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        @if (
            $currentSlide['type'] === 'code_arrange' ||
                $currentSlide['type'] === 'code_fillblank' ||
                $currentSlide['type'] === 'block_code')
            <div wire:key="minigame-container-{{ $step }}" x-data="minigameHandler(@json(count($minigameData['workspaceBlocks'] ?? [])))"
                class="w-full flex flex-col items-center">

                @if ($currentSlide['type'] === 'code_arrange')
                    @include('livewire.partials._minigame-code-arrange')
                @elseif($currentSlide['type'] === 'code_fillblank')
                    @include('livewire.partials._minigame-code-fillblank')
                @elseif($currentSlide['type'] === 'block_code')
                    @include('livewire.partials._minigame-block-code')
                @endif
            </div>
        @endif
    </main>

    {{-- Lesson Completion Overlay --}}
    @if ($showCompletion)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-data="completionScreen()"
            x-init="init()">

            {{-- Backdrop --}}
            <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-md"></div>

            {{-- Confetti particles --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
                @for ($i = 0; $i < 20; $i++)
                    <div class="absolute animate-confetti-{{ $i % 5 }}"
                        style="left: {{ rand(0, 100) }}%; top: -20px; animation-delay: {{ rand(0, 20) * 0.1 }}s; animation-duration: {{ rand(15, 30) * 0.1 }}s;">
                        <div class="w-3 h-3 rounded-sm"
                            style="background: hsl({{ rand(0, 360) }}, 80%, 60%); transform: rotate({{ rand(0, 360) }}deg);">
                        </div>
                    </div>
                @endfor
            </div>

            {{-- Card --}}
            <div class="relative z-10 w-full max-w-md mx-auto" x-ref="card"
                style="opacity: 0; transform: scale(0.85) translateY(30px); transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);">

                <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden">

                    {{-- Top banner --}}
                    <div
                        class="bg-linear-to-br from-yellow-400 via-orange-400 to-pink-500 p-8 text-center relative overflow-hidden">
                        <div class="absolute inset-0 opacity-20"
                            style="background-image: radial-gradient(circle at 20% 50%, white 1px, transparent 1px), radial-gradient(circle at 80% 20%, white 1px, transparent 1px); background-size: 30px 30px;">
                        </div>
                        <div class="relative text-6xl mb-3 animate-bounce-slow">🏆</div>
                        <h1 class="relative font-display text-3xl font-bold text-white drop-shadow-lg">Misi Selesai!
                        </h1>
                        <p class="relative text-white/80 mt-1 text-sm">{{ $completionData['title'] }}</p>
                    </div>

                    {{-- Stats --}}
                    <div class="p-6 space-y-4">

                        {{-- XP Earned card --}}
                        <div
                            class="flex items-center gap-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-2xl p-4 border-2 border-yellow-200 dark:border-yellow-700">
                            <div
                                class="w-14 h-14 rounded-xl bg-yellow-400 flex items-center justify-center shadow-lg shadow-yellow-300/50 shrink-0">
                                <span class="text-2xl">⭐</span>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">XP Diperoleh</p>
                                <p class="text-3xl font-display font-bold text-yellow-500 dark:text-yellow-400">
                                    +{{ $completionData['xp'] }} <span class="text-xl">XP</span>
                                </p>
                            </div>
                        </div>

                        {{-- XP Progress Bar --}}
                        @if (isset($completionData['gamification']))
                            <div
                                class="bg-slate-50 dark:bg-slate-900/50 rounded-2xl p-4 border border-slate-100 dark:border-slate-700/50">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="text-xs font-bold text-slate-400 uppercase tracking-tighter">Level
                                        Progress</span>
                                    <span class="text-xs font-bold text-slate-500"
                                        x-text="'Next: ' + '{{ $completionData['gamification']['next_level_name'] }}'"></span>
                                </div>
                                <div class="h-4 bg-slate-200 dark:bg-slate-700 rounded-full overflow-hidden relative">
                                    {{-- The bar itself --}}
                                    <div class="xp-bar-fill absolute inset-y-0 left-0 bg-linear-to-r from-yellow-400 to-orange-500 shadow-[0_0_10px_rgba(245,158,11,0.5)]"
                                        :style="'width: ' + xpPercent + '%'">
                                    </div>
                                </div>
                                <div class="flex justify-between mt-1">
                                    <span class="text-[10px] text-slate-400 font-medium">Lvl
                                        {{ auth()->user()->currentLevel?->name ?? '1' }}</span>
                                    <span
                                        class="text-[10px] text-slate-400 font-medium text-right">{{ $completionData['gamification']['xp_to_next'] }}
                                        XP to Level Up</span>
                                </div>
                            </div>
                        @endif

                        {{-- Time card --}}
                        <div
                            class="flex items-center gap-4 bg-blue-50 dark:bg-blue-900/20 rounded-2xl p-4 border-2 border-blue-200 dark:border-blue-700">
                            <div
                                class="w-14 h-14 rounded-xl bg-blue-500 flex items-center justify-center shadow-lg shadow-blue-300/50 shrink-0">
                                <span class="material-symbols-outlined text-white text-3xl">timer</span>
                            </div>
                            <div>
                                <p class="text-sm text-slate-500 dark:text-slate-400 font-medium">Waktu Pengerjaan</p>
                                <p class="text-3xl font-display font-bold text-blue-500 dark:text-blue-400">
                                    {{ $completionData['time'] }}
                                </p>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="mt-4">
                            {{-- Share Button --}}
                            <button @click="openShare()"
                                class="w-full py-4 mb-3 rounded-2xl bg-linear-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 active:scale-95 text-white font-display text-lg font-bold transition-all duration-200 flex items-center justify-center gap-2 shadow-lg shadow-pink-400/30">
                                <span class="material-symbols-outlined">share</span> Bagikan Pencapaian!
                            </button>

                            <div class="flex gap-3 mt-2">
                                {{-- Back to Dashboard --}}
                                <button wire:click="goToDashboard" wire:loading.attr="disabled"
                                    class="{{ $completionData['nextSlug'] ? 'flex-1' : 'w-full' }} py-5 rounded-2xl bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 active:scale-95 text-slate-700 dark:text-slate-200 font-display text-lg font-bold transition-all duration-200 flex items-center justify-center gap-2">
                                    <span wire:loading.remove wire:target="goToDashboard"
                                        class="flex items-center gap-2">
                                        <span class="material-symbols-outlined">home</span>
                                        Dashboard
                                    </span>
                                    <span wire:loading wire:target="goToDashboard" class="flex items-center gap-2">
                                        <span class="animate-spin material-symbols-outlined">refresh</span> Tunggu...
                                    </span>
                                </button>

                                {{-- Next Lesson (only if exists) --}}
                                @if ($completionData['nextSlug'])
                                    <a href="{{ route('missions.player', $completionData['nextSlug']) }}"
                                        wire:navigate
                                        class="flex-1 py-5 rounded-2xl bg-blue-500 hover:bg-blue-600 active:scale-95 text-white font-display text-lg font-bold transition-all duration-200 shadow-lg shadow-blue-400/30 flex items-center justify-center gap-2">
                                        <span class="text-center leading-tight">
                                            <span class="block text-xs font-normal opacity-80">Selanjutnya</span>
                                            {{ Str::limit($completionData['nextTitle'], 18) }}
                                        </span>
                                        <span class="material-symbols-outlined shrink-0">arrow_forward</span>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Level Up Overlay --}}
                @if (isset($completionData['gamification']['new_level']))
                    <template x-if="showLevelUp">
                        <div class="fixed inset-0 z-60 flex items-center justify-center p-4">
                            <div class="absolute inset-0 bg-yellow-400/20 backdrop-blur-sm"
                                @click="showLevelUp = false; checkNextAchievements()"></div>
                            <div
                                class="relative z-10 w-full max-w-sm bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden animate-pop-in">
                                <div class="bg-linear-to-br from-yellow-400 to-orange-500 p-8 text-center text-white">
                                    <div class="text-6xl mb-4 animate-bounce">🆙</div>
                                    <h2 class="text-3xl font-display font-black">NAIK LEVEL!</h2>
                                    <p class="opacity-80">Kamu sekarang Level
                                        {{ $completionData['gamification']['new_level']['name'] }}
                                    </p>
                                </div>
                                <div class="p-6 text-center">
                                    <p class="text-slate-600 dark:text-slate-300 mb-6 font-medium">Hebat! Kamu terus
                                        berkembang.
                                        Teruskan belajarmu!</p>
                                    <button @click="showLevelUp = false; checkNextAchievements()"
                                        class="w-full py-4 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white font-bold text-lg shadow-lg active:scale-95 transition-all">Mantap!</button>
                                </div>
                            </div>
                        </div>
                    </template>
                @endif

                {{-- Badge Unlock Overlay --}}
                @if (isset($completionData['gamification']['new_badges']) && count($completionData['gamification']['new_badges']) > 0)
                    <template x-if="showBadge">
                        <div class="fixed inset-0 z-70 flex items-center justify-center p-4">
                            <div class="absolute inset-0 bg-indigo-500/20 backdrop-blur-sm"
                                @click="showBadge = false; checkNextAchievements()"></div>
                            <div
                                class="relative z-10 w-full max-w-sm bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden animate-pop-in">
                                <div class="bg-linear-to-br from-indigo-500 to-purple-600 p-8 text-center text-white">
                                    <div class="text-6xl mb-4 animate-bounce-slow">🏅</div>
                                    <h2 class="text-2xl font-display font-black">BADGE TERBUKA!</h2>
                                    <p class="opacity-80">Pencapaian baru berhasil dibuka!</p>
                                </div>
                                <div class="p-6">
                                    @foreach ($completionData['gamification']['new_badges'] as $badge)
                                        <div
                                            class="flex items-center gap-4 mb-4 bg-slate-50 dark:bg-slate-700/50 p-3 rounded-2xl border border-slate-100 dark:border-slate-600/50">
                                            <div
                                                class="w-12 h-12 bg-white dark:bg-slate-800 rounded-xl flex items-center justify-center text-2xl shadow-sm">
                                                {{ $badge['icon'] ?? '🏆' }}
                                            </div>
                                            <div class="flex-1">
                                                <h3
                                                    class="font-bold text-slate-800 dark:text-white leading-tight font-sans">
                                                    {{ $badge['name'] }}
                                                </h3>
                                                <p class="text-[10px] text-slate-500 dark:text-slate-400 mt-0.5">
                                                    {{ $badge['description'] }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                    <button @click="showBadge = false; checkNextAchievements()"
                                        class="w-full py-4 mt-2 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white font-bold text-lg shadow-lg active:scale-95 transition-all">Luar
                                        Biasa!</button>
                                </div>
                            </div>
                        </div>
                    </template>
                @endif

                {{-- Share Modal Overlay --}}
                <template x-if="showShare">
                    <div class="fixed inset-0 z-80 flex items-center justify-center p-4">
                        <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-md" @click="showShare = false">
                        </div>
                        <div
                            class="relative z-10 w-full max-w-md bg-white ml-auto mr-auto dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden animate-pop-in flex flex-col max-h-[90vh]">
                            {{-- Header --}}
                            <div
                                class="flex justify-between items-center p-4 border-b border-slate-100 dark:border-slate-700">
                                <h3 class="font-display font-bold text-lg text-slate-800 dark:text-white">Bagikan
                                    Pencapaian!</h3>
                                <button @click="showShare = false"
                                    class="text-slate-400 hover:text-slate-600 bg-slate-100 hover:bg-slate-200 p-2 rounded-full transition-colors">
                                    <span class="material-symbols-outlined text-sm">close</span>
                                </button>
                            </div>

                            {{-- Scrollable Content --}}
                            <div class="p-6 overflow-y-auto custom-scrollbar flex-1">
                                {{-- Achievement Card to Render --}}
                                <div id="achievement-card"
                                    class="rounded-2xl p-6 text-center relative shadow-xl overflow-hidden mb-6 border-4"
                                    style="background: linear-gradient(to bottom, #312e81, #581c87, #0f172a); color: #ffffff; border-color: #ffffff;">
                                    {{-- Decorative Background Elements --}}
                                    <div class="absolute top-0 right-0 w-32 h-32 rounded-full mix-blend-screen filter blur-3xl opacity-30"
                                        style="background-color: #ec4899;"></div>
                                    <div class="absolute bottom-0 left-0 w-32 h-32 rounded-full mix-blend-screen filter blur-3xl opacity-30"
                                        style="background-color: #3b82f6;"></div>

                                    {{-- Content --}}
                                    <div class="relative z-10">
                                        <h1 class="font-display font-black text-2xl tracking-widest drop-shadow-sm mb-4"
                                            style="background: linear-gradient(to right, #fde047, #eab308); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                                            ZENUNIVERSE</h1>

                                        <img src="/images/hero.png" alt="Mascbot"
                                            class="w-48 h-48 mx-auto mb-4 object-contain drop-shadow-lg">

                                        <div class="inline-block backdrop-blur-md px-4 py-1.5 rounded-full text-xs font-bold tracking-wider mb-2"
                                            style="background-color: rgba(255, 255, 255, 0.2);">
                                            🏆 Visi Selesai!
                                        </div>
                                        <h2 class="font-bold text-xl mb-4 leading-snug" style="color: #ffffff;">
                                            "{{ $completionData['title'] }}"</h2>

                                        <div class="flex justify-center gap-4 mb-6">
                                            <div class="rounded-xl p-3 flex-1 backdrop-blur-sm border"
                                                style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.1);">
                                                <div class="text-2xl mb-1">⭐</div>
                                                <div class="font-bold" style="color: #fde047;">
                                                    +{{ $completionData['xp'] }}
                                                </div>
                                                <div class="text-[10px] uppercase font-bold tracking-wider"
                                                    style="color: rgba(255, 255, 255, 0.7);">XP</div>
                                            </div>
                                            <div class="rounded-xl p-3 flex-1 backdrop-blur-sm border"
                                                style="background-color: rgba(255, 255, 255, 0.1); border-color: rgba(255, 255, 255, 0.1);">
                                                <div class="text-2xl mb-1">⏱</div>
                                                <div class="font-bold" style="color: #93c5fd;">
                                                    {{ $completionData['time'] }}
                                                </div>
                                                <div class="text-[10px] uppercase font-bold tracking-wider"
                                                    style="color: rgba(255, 255, 255, 0.7);">Waktu</div>
                                            </div>
                                        </div>

                                        <div class="border-t pt-4 text-left"
                                            style="border-color: rgba(255, 255, 255, 0.2);">
                                            <p class="text-[10px] mb-0.5 uppercase tracking-widest font-bold"
                                                style="color: rgba(255, 255, 255, 0.6);">Diselesaikan Oleh</p>
                                            <p class="font-bold text-sm mb-1" style="color: #fde047;">
                                                {{ auth()->user()->name }}
                                            </p>
                                            <p class="text-xs" style="color: rgba(255, 255, 255, 0.8);"><span
                                                    style="opacity: 0.6;">Level:</span>
                                                {{ auth()->user()->currentLevel?->name ?? '1' }}</p>
                                        </div>

                                        <div class="mt-6 pt-4 border-t text-center"
                                            style="border-color: rgba(255, 255, 255, 0.1);">
                                            <p class="text-[10px] italic" style="color: rgba(255, 255, 255, 0.7);">
                                                "Bergabunglah di Zenuniverse — belajar coding dengan cara yang
                                                menyenangkan!"</p>
                                            <p class="text-xs font-bold tracking-widest mt-1"
                                                style="color: rgba(255, 255, 255, 0.9);">zenuniverse.app</p>
                                        </div>
                                    </div>
                                </div>

                                {{-- Share Actions --}}
                                <div class="grid grid-cols-2 gap-3">
                                    <button @click="downloadCard()"
                                        class="col-span-2 py-3 rounded-xl bg-slate-800 dark:bg-slate-700 hover:bg-slate-900 text-white font-bold flex items-center justify-center gap-2 transition-all">
                                        <span class="material-symbols-outlined text-sm"
                                            x-show="!isDownloading">download</span>
                                        <span class="material-symbols-outlined text-sm animate-spin"
                                            x-show="isDownloading" style="display: none;">refresh</span>
                                        <span x-text="isDownloading ? 'Memproses...' : 'Download Gambar'"></span>
                                    </button>

                                    <button @click="shareWhatsApp()"
                                        class="py-3 rounded-xl bg-wa-green hover:bg-[#1DA851] text-white font-bold flex items-center justify-center gap-2 transition-all">
                                        📱 WhatsApp
                                    </button>

                                    <button @click="shareInstagram()"
                                        class="py-3 rounded-xl bg-linear-to-tr from-[#f09433] via-[#e6683c] to-[#bc1888] text-white font-bold flex items-center justify-center gap-2 transition-all">
                                        📷 Instagram
                                    </button>

                                    <button @click="shareTikTok()"
                                        class="py-3 rounded-xl bg-black dark:bg-slate-900 border dark:border-slate-700 hover:bg-zinc-800 text-white font-bold flex items-center justify-center gap-2 transition-all">
                                        🎵 TikTok
                                    </button>

                                    <button @click="copyLink()"
                                        class="py-3 rounded-xl bg-slate-100 hover:bg-slate-200 dark:bg-slate-700 dark:hover:bg-slate-600 text-slate-700 dark:text-white font-bold flex items-center justify-center gap-2 transition-all relative">
                                        <span class="material-symbols-outlined text-sm">link</span>
                                        <span x-text="linkCopied ? 'Tersalin!' : 'Salin Link'"></span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
        </template>
</div>
@endif

{{-- Game Over Overlay --}}
@if ($showGameOver)
    <div class="fixed inset-0 z-50 flex items-center justify-center p-4" x-data="gameOverScreen()"
        x-init="init()">

        {{-- Dark red backdrop --}}
        <div class="absolute inset-0 bg-red-950/90 backdrop-blur-md"></div>

        {{-- Floating heart particles --}}
        <div class="absolute inset-0 overflow-hidden pointer-events-none" aria-hidden="true">
            @for ($i = 0; $i < 8; $i++)
                <div class="absolute text-2xl animate-float-up"
                    style="left: {{ rand(5, 95) }}%; bottom: {{ rand(10, 40) }}%; animation-delay: {{ $i * 0.4 }}s; animation-duration: {{ rand(18, 28) * 0.1 }}s;">
                    💔
                </div>
            @endfor
        </div>

        {{-- Card --}}
        <div class="relative z-10 w-full max-w-sm mx-auto" x-ref="card"
            style="opacity: 0; transform: scale(0.85) translateY(30px); transition: all 0.5s cubic-bezier(0.34, 1.56, 0.64, 1);">

            <div class="bg-white dark:bg-slate-800 rounded-3xl shadow-2xl overflow-hidden">

                {{-- Top banner --}}
                <div
                    class="bg-linear-to-br from-red-600 via-rose-600 to-pink-700 p-8 text-center relative overflow-hidden">
                    {{-- subtle dot pattern --}}
                    <div class="absolute inset-0 opacity-10"
                        style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 24px 24px;">
                    </div>

                    {{-- Pulsing circle behind heart --}}
                    <div class="relative flex justify-center mb-3">
                        <div
                            class="w-24 h-24 rounded-full bg-red-500/40 flex items-center justify-center animate-pulse-red">
                            <div class="text-6xl animate-shake-heart">💔</div>
                        </div>
                    </div>
                    <h1 class="relative font-display text-3xl font-bold text-white drop-shadow-lg">Nyawa Habis!</h1>
                    <p class="relative text-white/70 mt-2 text-sm px-4">Jangan menyerah! Nyawamu akan pulih seiring
                        waktu.
                    </p>
                </div>

                {{-- Empty hearts display --}}
                <div class="px-6 pt-5 pb-2">
                    <p class="text-center text-slate-500 dark:text-slate-400 text-sm font-medium mb-3">Sisa nyawa</p>
                    <div class="flex justify-center gap-3">
                        @for ($i = 0; $i < 5; $i++)
                            <span class="text-3xl"
                                style="animation: bounce-slow 2s ease-in-out infinite; animation-delay: {{ $i * 0.15 }}s; display: inline-block;">🤍</span>
                        @endfor
                    </div>
                </div>

                {{-- CTA --}}
                <div class="p-6 pt-4">
                    <button wire:click="goToDashboard" wire:loading.attr="disabled"
                        class="w-full py-5 rounded-2xl bg-red-500 hover:bg-red-600 active:scale-95 text-white font-display text-xl font-bold transition-all duration-200 shadow-lg shadow-red-400/30 flex items-center justify-center gap-2">
                        <span wire:loading.remove wire:target="goToDashboard" class="flex items-center gap-2">
                            <span class="material-symbols-outlined">home</span>
                            Kembali ke Dashboard
                        </span>
                        <span wire:loading wire:target="goToDashboard" class="flex items-center gap-2">
                            <span class="animate-spin material-symbols-outlined">refresh</span> Tunggu...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endif

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

        <div
            class="absolute inset-0 bg-linear-to-tr from-blue-500/10 to-purple-500/10 dark:from-blue-400/10 dark:to-purple-400/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
        </div>

        <span
            class="material-symbols-outlined text-[20px] transition-all duration-500 rotate-0 scale-100 dark:-rotate-90 dark:scale-0 absolute">
            dark_mode
        </span>
        <span
            class="material-symbols-outlined text-[20px] transition-all duration-500 rotate-90 scale-0 dark:rotate-0 dark:scale-100 absolute text-yellow-400">
            light_mode
        </span>
    </button>
</div>
@once
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
    <script>
        window.minigameHandler = (initialCount = 0) => ({
            workspaceCount: initialCount,

            init() {
                if (typeof updateStepNumbers === 'function') updateStepNumbers();
                // Ensure workspaceCount is at least initialized to 0 if not provided
                if (this.workspaceCount === undefined) this.workspaceCount = 0;
            },

            initSortable(el, type) {
                if (!el) return;
                if (el._sortable) return; // Prevent double initialization

                if (typeof Sortable === 'undefined') {
                    setTimeout(() => this.initSortable(el, type), 300);
                    return;
                }

                if (type === 'arrange') {
                    el._sortable = new Sortable(el, {
                        animation: 150,
                        ghostClass: 'opacity-50',
                        dragClass: 'scale-105',
                        onEnd: (evt) => {
                            const ids = Array.from(el.querySelectorAll('[data-id]'))
                                .map(item => item.dataset.id);
                            @this.call('updateBlockOrder', ids);
                            if (typeof updateStepNumbers === 'function') updateStepNumbers();
                        }
                    });
                } else if (type === 'block-palette') {
                    el._sortable = new Sortable(el, {
                        group: {
                            name: 'shared',
                            pull: 'clone',
                            put: false
                        },
                        animation: 150,
                        sort: false,
                        ghostClass: 'opacity-50'
                    });
                } else if (type === 'block-workspace') {
                    el._sortable = new Sortable(el, {
                        group: 'shared',
                        animation: 150,
                        ghostClass: 'opacity-50',
                        onAdd: () => this.syncWorkspace(),
                        onUpdate: () => this.syncWorkspace(),
                        onRemove: () => this.syncWorkspace()
                    });
                } else if (type === 'block-trash') {
                    el._sortable = new Sortable(el, {
                        group: 'shared',
                        onAdd: (evt) => {
                            evt.item.remove();
                            this.syncWorkspace();
                        }
                    });
                }
            },

            syncWorkspace() {
                const workspace = this.$refs.workspaceList || document.querySelector('[x-ref="workspaceList"]');
                if (!workspace) return;

                const items = workspace.querySelectorAll('[data-id]');
                const ids = Array.from(items).map(el => el.dataset.id);

                this.workspaceCount = ids.length;
                @this.call('updateWorkspaceOrder', ids);

                const hint = document.getElementById('workspace-hint');
                if (hint) {
                    if (this.workspaceCount > 0) hint.classList.add('hidden');
                    else hint.classList.remove('hidden');
                }
            },

            removeBlock(el) {
                if (el) el.remove();
                this.syncWorkspace();
            },

            selectFillAnswer(optionId) {
                @this.call('selectFillAnswer', optionId);
            },

            removeFillAnswer(blankId) {
                @this.call('removeFillAnswer', blankId);
            }
        });

        // Handle sound events globally
        window.addEventListener('play-sound', (event) => {
            const sounds = {
                'correct': 'sound-correct',
                'incorrect': 'sound-incorrect',
                'completed': 'sound-completed'
            };
            const soundId = sounds[event.detail.type];
            const audio = document.getElementById(soundId);
            if (audio) {
                audio.currentTime = 0;
                audio.play().catch(e => console.error('Error playing sound:', e));
            }
        });

        document.addEventListener('alpine:init', () => {
            Alpine.data('minigameHandler', window.minigameHandler);

            Alpine.data('completionScreen', () => ({
                xpPercent: @js($completionData['gamification']['old_percent'] ?? 0),
                newXpPercent: @js($completionData['gamification']['new_percent'] ?? 0),
                showLevelUp: false,
                hasLevelUp: @js(isset($completionData['gamification']['new_level'])),
                showBadge: false,
                hasBadges: @js(isset($completionData['gamification']['new_badges']) && count($completionData['gamification']['new_badges']) > 0),
                showShare: false,
                isDownloading: false,
                linkCopied: false,

                init() {
                    this.$nextTick(() => {
                        const card = this.$refs.card;
                        if (card) {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1) translateY(0)';

                            // Start XP bar animation after card pops in
                            setTimeout(() => {
                                this.xpPercent = this.newXpPercent;

                                // Show achievements after XP animation
                                setTimeout(() => {
                                    this.checkNextAchievements();
                                }, 1800);
                            }, 800);
                        }
                    });
                },

                checkNextAchievements() {
                    if (this.hasLevelUp) {
                        this.showLevelUp = true;
                        this.hasLevelUp = false; // Only show once
                    } else if (this.hasBadges) {
                        this.showBadge = true;
                        this.hasBadges = false; // Only show once
                    }
                },

                openShare() {
                    this.showShare = true;
                },

                getShareText() {
                    const title = @js($completionData['title'] ?? '');
                    const xp = @js($completionData['xp'] ?? 0);
                    return `Saya baru saja menyelesaikan misi "${title}" di *Zenuniverse* dan mendapatkan +${xp} XP!\n\nYuk belajar coding sambil bermain sekarang: ${window.location.origin}`;
                },

                async downloadCard(andShare = false, shareTitle = '') {
                    if (this.isDownloading) return null;
                    this.isDownloading = true;

                    try {
                        const el = document.getElementById('achievement-card');

                        // Load html2canvas if not loaded yet
                        if (typeof html2canvas === 'undefined') {
                            await new Promise((resolve, reject) => {
                                const script = document.createElement('script');
                                script.src =
                                    'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js';
                                script.onload = resolve;
                                script.onerror = reject;
                                document.head.appendChild(script);
                            });
                        }

                        // Small delay to ensure images are loaded
                        await new Promise(r => setTimeout(r, 200));

                        const canvas = await html2canvas(el, {
                            scale: 2,
                            backgroundColor: '#0f172a', // slate-900 to ensure background
                            logging: false,
                            useCORS: true
                        });

                        const dataUrl = canvas.toDataURL('image/png');

                        // If just downloading
                        if (!andShare) {
                            const link = document.createElement('a');
                            link.download = 'zenuniverse-pencapaian.png';
                            link.href = dataUrl;
                            link.click();
                            this.isDownloading = false;
                            return true;
                        } else {
                            // If sharing (return blob for Web Share API)
                            return new Promise(resolve => canvas.toBlob(resolve, 'image/png'));
                        }
                    } catch (error) {
                        console.error('Error generating image:', error);
                        alert('Gagal membuat gambar: ' + (error.message ||
                            'Kesalahan tidak diketahui.'));
                        this.isDownloading = false;
                        return null;
                    }
                },

                shareWhatsApp() {
                    const text = encodeURIComponent(this.getShareText());
                    window.open(`https://wa.me/?text=${text}`, '_blank');
                },

                async triggerNativeShare(platformName) {
                    // Try to copy the caption first
                    try {
                        await navigator.clipboard.writeText(this.getShareText());
                    } catch (e) {
                        console.log('Clipboard write failed', e);
                    }

                    // Check if native Web Share API with files is supported
                    if (navigator.canShare && typeof navigator.share === 'function') {
                        const blob = await this.downloadCard(true);
                        if (blob) {
                            try {
                                const file = new File([blob], 'zenuniverse-pencapaian.png', {
                                    type: 'image/png'
                                });
                                if (navigator.canShare({
                                        files: [file]
                                    })) {
                                    await navigator.share({
                                        title: 'Pencapaian Zenuniverse',
                                        text: `Pencapaian saya di Zenuniverse!`,
                                        files: [file]
                                    });
                                    this.isDownloading = false;
                                    return;
                                }
                            } catch (error) {
                                console.log('Share failed or was aborted', error);
                            }
                        }
                    }

                    // Fallback: Download and alert
                    this.downloadCard();
                    alert(
                        `Caption telah disalin ke clipboard! Buka aplikasi ${platformName} kamu, lalu upload gambar yang baru didownload dan paste caption-nya.`);
                },

                shareInstagram() {
                    this.triggerNativeShare('Instagram');
                },

                shareTikTok() {
                    this.triggerNativeShare('TikTok');
                },

                async copyLink() {
                    try {
                        await navigator.clipboard.writeText(window.location.origin);
                        this.linkCopied = true;
                        setTimeout(() => this.linkCopied = false, 2000);
                    } catch (err) {
                        console.error('Failed to copy link: ', err);
                    }
                }
            }));

            Alpine.data('gameOverScreen', () => ({
                init() {
                    this.$nextTick(() => {
                        const card = this.$refs.card;
                        if (card) {
                            card.style.opacity = '1';
                            card.style.transform = 'scale(1) translateY(0)';
                        }
                    });
                }
            }));
        });

        // Ensure step numbers are updated correctly
        document.addEventListener('livewire:navigated', () => {
            if (typeof updateStepNumbers === 'function') updateStepNumbers();
        });

        function updateStepNumbers() {
            document.querySelectorAll('.step-number').forEach((span, i) => {
                span.innerText = i + 1;
            });
        }
    </script>
@endonce
</div>
