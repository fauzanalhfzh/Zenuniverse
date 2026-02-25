<x-layouts.student title="Profil Pilot" active="profile">
    <div class="max-w-6xl mx-auto space-y-12">
        {{-- Profile Hero Card --}}
        <div class="bg-white rounded-[3rem] shadow-xl overflow-hidden border-4 border-slate-50 relative">
            <div class="bg-indigo-600 px-8 py-3 flex items-center justify-between text-white">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-sm font-fill-1">verified_user</span>
                    <span class="text-[10px] font-black uppercase tracking-widest">Identitas Pilot Galaksi</span>
                </div>
                <div class="text-[10px] font-black uppercase tracking-widest opacity-60">
                    ID: ZEN-992-ALPHA
                </div>
            </div>
            
            <div class="p-12 flex flex-col md:flex-row items-center gap-12">
                <div class="relative">
                    <div class="size-64 rounded-full bg-blue-50 border-8 border-white shadow-lg p-4 overflow-hidden">
                        <img src="https://lh3.googleusercontent.com/aida-public/AB6AXuAF5Wc58uqrZLOcAMMPTi744lEnr8F7UISKzw1XBa3zrDvc-H3NCE83ZOuB_LCU5OjTpex7Mu82dRPBQADeCEilogLt0inD02SxMydy9GXQnewHWrR4NLAUL71u7xdPVzTH62TfagJXCQem0_7rdiVO-HKd5N7u0pkoTUBIZ1V_4UQ3DzCxzdrujPbGnq8ogtT05ebgsFJbM5rTHfDZdjW-LPcV3-AbNh_DQlI1n-dgG3yRI8AuQian86HtFo33t7F_PQHiJL0ivww" alt="Pilot Character" class="w-full h-full object-contain">
                    </div>
                    <button class="absolute -bottom-4 left-1/2 -translate-x-1/2 px-6 py-3 bg-primary text-white text-sm font-black rounded-2xl shadow-lg bubbly-button flex items-center gap-2 whitespace-nowrap">
                        <span class="material-symbols-outlined text-sm">checkroom</span>
                        Lemari Kostum
                    </button>
                </div>

                <div class="flex-1 space-y-8 text-center md:text-left">
                    <div>
                        <h3 class="text-5xl font-black text-slate-800 mb-4">{{ auth()->user()->name }}</h3>
                        <div class="inline-flex items-center gap-2 px-4 py-2 bg-orange-50 text-primary rounded-xl border border-orange-100">
                            <span class="material-symbols-outlined text-sm font-fill-1">military_tech</span>
                            <span class="text-sm font-black italic">Pangkat Saat Ini: {{ $rankTitle }}</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-slate-50 p-6 rounded-3xl border-2 border-slate-100 flex items-center gap-4">
                            <div class="size-12 rounded-2xl bg-yellow-400 text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined font-fill-1">star</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase">Total Bintang</p>
                                <p class="text-2xl font-black text-slate-800">{{ number_format(auth()->user()->total_xp) }}</p>
                            </div>
                        </div>
                        <div class="bg-slate-50 p-6 rounded-3xl border-2 border-slate-100 flex items-center gap-4">
                            <div class="size-12 rounded-2xl bg-blue-500 text-white flex items-center justify-center shadow-md">
                                <span class="material-symbols-outlined font-fill-1">rocket_launch</span>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-slate-400 uppercase">Misi Selesai</p>
                                <p class="text-2xl font-black text-slate-800">{{ number_format($completedCount) }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center text-xs font-black uppercase tracking-widest text-slate-400">
                            <span>Progres Level {{ auth()->user()->currentLevel->order ?? 1 }}</span>
                            <span class="text-primary">{{ number_format($currentXp) }} / {{ number_format($nextLevelXp) }} XP</span>
                        </div>
                        <div class="w-full bg-slate-100 h-4 rounded-full overflow-hidden border border-slate-200">
                            <div class="bg-primary h-full rounded-full transition-all duration-1000" style="width: {{ $xpPercent }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Badges Section --}}
        <section class="space-y-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary text-3xl font-fill-1">military_tech</span>
                    <h4 class="text-3xl font-black text-slate-800">Koleksi Medali</h4>
                </div>
                <a href="#" class="text-primary font-black text-sm hover:underline">Lihat Semua Galeri</a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-6">
                @foreach($badges as $badge)
                    @php
                        $isUnlocked = in_array($badge->id, $unlockedBadgeIds);
                        
                        // Theme mapping for unlocked badges
                        $themeWrapper = '';
                        $iconColor = '';
                        switch ($badge->color_theme) {
                            case 'yellow': $themeWrapper = 'bg-yellow-50'; $iconColor = 'text-yellow-500'; break;
                            case 'blue': $themeWrapper = 'bg-blue-50'; $iconColor = 'text-blue-500'; break;
                            case 'purple': $themeWrapper = 'bg-purple-50'; $iconColor = 'text-purple-500'; break;
                            case 'orange': $themeWrapper = 'bg-orange-50'; $iconColor = 'text-orange-500'; break;
                            case 'slate': $themeWrapper = 'bg-slate-50'; $iconColor = 'text-slate-500'; break;
                            default: $themeWrapper = 'bg-blue-50'; $iconColor = 'text-blue-500'; break;
                        }
                    @endphp

                    @if($isUnlocked)
                        {{-- Unlocked Badge Option --}}
                        <div class="bg-white p-6 rounded-[2rem] border-4 border-slate-50 flex flex-col items-center text-center gap-4 card-hover shadow-sm group">
                            <div class="relative size-24 rounded-full {{ $themeWrapper }} flex items-center justify-center mb-2">
                                <div class="absolute -top-1 -right-1 size-8 rounded-full bg-green-500 border-4 border-white flex items-center justify-center">
                                    <span class="material-symbols-outlined font-black text-white text-xs">check</span>
                                </div>
                                <span class="material-symbols-outlined text-4xl {{ $iconColor }} font-fill-1">{{ $badge->icon }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-black text-slate-800 group-hover:text-primary transition-colors hover:cursor-help" title="{{ $badge->description }}">{{ $badge->name }}</p>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $badge->rarity }}</p>
                            </div>
                        </div>
                    @else
                        {{-- Locked Badge Option --}}
                        <div class="bg-slate-50 p-6 rounded-[2rem] border-4 border-slate-100 flex flex-col items-center text-center gap-4 opacity-40 group filter grayscale">
                            <div class="size-24 rounded-full bg-slate-200 flex items-center justify-center mb-2">
                                <span class="material-symbols-outlined text-4xl text-slate-400 font-fill-1">{{ $badge->icon }}</span>
                            </div>
                            <div>
                                <p class="text-sm font-black text-slate-400 hover:cursor-help" title="{{ $badge->description }}">{{ $badge->name }}</p>
                                <p class="text-[10px] font-black uppercase tracking-widest text-red-500">Terkunci</p>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </section>

        {{-- Bottom Profile Settings Link --}}
        <div class="pt-12 border-t-2 border-slate-50 flex justify-center">
            <p class="text-sm font-medium text-slate-400">Ingin mengubah pengaturan akun? 
                <a href="#" class="text-primary font-bold hover:underline">Klik di sini</a>
            </p>
        </div>
    </div>
</x-layouts.student>

