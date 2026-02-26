@props(['active' => 'dashboard'])

<nav class="lg:hidden fixed bottom-6 left-6 right-6 h-16 bg-white/95 backdrop-blur-xl border-2 border-orange-100 rounded-3xl shadow-[0_10px_30px_rgba(255,165,0,0.15)] flex items-center justify-around px-2 z-50">
    {{-- Learning Path (Beranda) --}}
    <a href="{{ route('dashboard') }}" class="flex flex-col items-center justify-center w-16 h-full transition-transform active:scale-95 group relative {{ ($active === 'dashboard' || $active === 'learn') ? 'text-primary' : 'text-slate-400 hover:text-slate-600' }}">
        @if($active === 'dashboard' || $active === 'learn')
            <div class="absolute -top-1 size-1 bg-primary rounded-full"></div>
        @endif
        <span class="material-symbols-outlined text-2xl {{ ($active === 'dashboard' || $active === 'learn') ? 'font-fill-1' : '' }}">map</span>
        <span class="text-[10px] font-bold mt-1">Belajar</span>
    </a>

    {{-- Leaderboard --}}
    <a href="{{ route('leaderboard') }}" class="flex flex-col items-center justify-center w-16 h-full transition-transform active:scale-95 group relative {{ $active === 'leaderboard' ? 'text-primary' : 'text-slate-400 hover:text-slate-600' }}">
        @if($active === 'leaderboard')
            <div class="absolute -top-1 size-1 bg-primary rounded-full"></div>
        @endif
        <span class="material-symbols-outlined text-2xl {{ $active === 'leaderboard' ? 'font-fill-1' : '' }}">leaderboard</span>
        <span class="text-[10px] font-bold mt-1">Skor</span>
    </a>

    {{-- Profile --}}
    <a href="{{ route('profile') }}" class="flex flex-col items-center justify-center w-16 h-full transition-transform active:scale-95 group relative {{ $active === 'profile' ? 'text-primary' : 'text-slate-400 hover:text-slate-600' }}">
        @if($active === 'profile')
            <div class="absolute -top-1 size-1 bg-primary rounded-full"></div>
        @endif
        <span class="material-symbols-outlined text-2xl {{ $active === 'profile' ? 'font-fill-1 relative' : '' }}">
            person
            @if($active === 'profile')
                {{-- Little notification dot placeholder --}}
                <span class="absolute top-0 right-0 size-2 bg-red-500 rounded-full border-2 border-white"></span>
            @endif
        </span>
        <span class="text-[10px] font-bold mt-1">Profil</span>
    </a>
</nav>
