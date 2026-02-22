<x-layouts.student title="Papan Skor" active="dashboard">
    <div class="max-w-3xl mx-auto">

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center gap-3 mb-2">
                <span class="material-symbols-outlined text-primary text-3xl font-fill-1">emoji_events</span>
                <h1 class="text-3xl font-black text-slate-800">Papan Skor</h1>
            </div>
            <p class="text-slate-400 font-medium">Top 20 penjelajah dengan XP tertinggi 🚀</p>
        </div>

        {{-- Current User Rank Card --}}
        @if($currentUser && $currentUserRank)
            <div class="bg-gradient-to-r from-primary to-orange-400 rounded-2xl p-5 mb-8 shadow-lg shadow-orange-200/50">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="size-14 rounded-2xl bg-white/20 flex items-center justify-center">
                            <span class="text-white text-2xl font-black">#{{ $currentUserRank }}</span>
                        </div>
                        <div>
                            <p class="text-orange-100 text-xs font-bold uppercase tracking-wider">Peringkat Kamu</p>
                            <p class="text-white text-lg font-black">{{ $currentUser->name }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-orange-100 text-xs font-bold uppercase tracking-wider">Total XP</p>
                        <p class="text-white text-2xl font-black">{{ number_format($currentUser->total_xp) }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Leaderboard Table --}}
        <div class="bg-white rounded-2xl border-2 border-slate-100 overflow-hidden">
            <div class="divide-y divide-slate-50">
                @forelse($topUsers as $index => $user)
                    @php
                        $rank = $index + 1;
                        $isCurrentUser = $currentUser && $user->id === $currentUser->id;
                        $medal = match($rank) {
                            1 => '🥇',
                            2 => '🥈',
                            3 => '🥉',
                            default => null,
                        };
                        $levelIcon = $user->currentLevel?->icon ?? '🌱';
                    @endphp

                    <div class="flex items-center gap-4 px-6 py-4 transition-colors {{ $isCurrentUser ? 'bg-orange-50 border-l-4 border-primary' : 'hover:bg-slate-50' }}">
                        {{-- Rank --}}
                        <div class="w-10 flex-shrink-0 text-center">
                            @if($medal)
                                <span class="text-2xl">{{ $medal }}</span>
                            @else
                                <span class="text-lg font-black text-slate-300">{{ $rank }}</span>
                            @endif
                        </div>

                        {{-- Avatar --}}
                        <div class="size-10 rounded-full {{ $rank <= 3 ? 'bg-primary' : 'bg-slate-200' }} flex items-center justify-center flex-shrink-0">
                            <span class="material-symbols-outlined text-white text-lg font-fill-1">person</span>
                        </div>

                        {{-- Name & Level --}}
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-black text-slate-800 truncate {{ $isCurrentUser ? 'text-primary' : '' }}">
                                {{ $user->name }}
                                @if($isCurrentUser)
                                    <span class="text-[10px] font-bold text-primary bg-orange-100 px-2 py-0.5 rounded-full ml-1">KAMU</span>
                                @endif
                            </p>
                            <p class="text-xs text-slate-400 font-medium">{{ $levelIcon }} {{ $user->currentLevel?->name ?? 'Pemula' }}</p>
                        </div>

                        {{-- Streak --}}
                        <div class="flex items-center gap-1 flex-shrink-0">
                            <span class="material-symbols-outlined text-orange-400 text-sm font-fill-1">local_fire_department</span>
                            <span class="text-xs font-bold text-slate-400">{{ $user->current_streak ?? 0 }}</span>
                        </div>

                        {{-- XP --}}
                        <div class="w-24 text-right flex-shrink-0">
                            <p class="text-sm font-black {{ $rank <= 3 ? 'text-primary' : 'text-slate-700' }}">
                                {{ number_format($user->total_xp) }} XP
                            </p>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16">
                        <span class="material-symbols-outlined text-6xl text-slate-200 mb-4">emoji_events</span>
                        <p class="text-slate-400 font-bold text-lg">Belum ada data</p>
                        <p class="text-slate-300 text-sm mt-1">Mulai belajar untuk masuk papan skor!</p>
                    </div>
                @endforelse
            </div>
        </div>

        {{-- Back to Dashboard --}}
        <div class="mt-8 text-center">
            <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-2 text-primary font-bold text-sm hover:underline">
                <span class="material-symbols-outlined text-base">arrow_back</span>
                Kembali ke Peta Belajar
            </a>
        </div>
    </div>
</x-layouts.student>
