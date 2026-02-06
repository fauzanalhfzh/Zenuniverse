<div class="bg-background-light dark:bg-background-dark min-h-screen py-8 font-display">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            {{-- Left Column: Profile Card & Streak --}}
            <div class="lg:col-span-4 flex flex-col gap-6">
                {{-- Profile Card --}}
                <div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6 flex flex-col items-center text-center relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-b from-primary/10 to-transparent"></div>
                    <div class="relative mb-4">
                        <div class="h-32 w-32 rounded-full p-1 bg-white dark:bg-card-dark ring-4 ring-primary/20">
                            {{-- Avatar Placeholder --}}
                            <div class="h-full w-full rounded-full bg-gray-200 flex items-center justify-center text-4xl">
                                🧑‍🚀
                            </div>
                        </div>
                        <div class="absolute bottom-0 right-0 flex h-8 w-8 items-center justify-center rounded-full bg-primary text-background-dark shadow-lg border-2 border-white dark:border-card-dark">
                            <span class="material-symbols-outlined text-sm font-bold">edit</span>
                        </div>
                    </div>
                    <h1 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $user->name }}</h1>
                    <p class="text-primary-dark dark:text-primary font-medium mb-4">{{ $user->currentLevel->name ?? 'Level Dasar' }}</p>
                    
                    {{-- Level Progress --}}
                    <div class="w-full mb-2">
                        <div class="flex justify-between text-xs font-semibold text-slate-500 dark:text-gray-400 mb-1">
                            <span>Level {{ $user->currentLevel->order ?? 1 }}</span>
                            <span>Level {{ ($user->currentLevel->order ?? 1) + 1 }}</span>
                        </div>
                        <div class="h-3 w-full rounded-full bg-gray-100 dark:bg-gray-700 overflow-hidden">
                            <div class="h-full bg-primary rounded-full" style="width: {{ min(100, ($user->current_xp / 1000) * 100) }}%"></div>
                        </div>
                        <p class="text-xs text-slate-400 dark:text-gray-500 mt-2">{{ $user->current_xp }} / 1000 XP to next level</p>
                    </div>
                    <button class="mt-6 w-full rounded-lg bg-slate-900 dark:bg-white text-white dark:text-slate-900 py-2.5 px-4 text-sm font-bold hover:opacity-90 transition-opacity">
                        View Public Profile
                    </button>
                </div>

                {{-- Daily Streak --}}
                <div class="bg-card-light dark:bg-card-dark rounded-xl shadow-sm border border-gray-100 dark:border-gray-800 p-6 flex items-center justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500 dark:text-gray-400">Current Streak</p>
                        <div class="flex items-baseline gap-1">
                            <h3 class="text-3xl font-bold text-slate-900 dark:text-white">3</h3>
                            <span class="text-sm font-medium text-slate-900 dark:text-white">Days</span>
                        </div>
                        <p class="text-xs text-primary mt-1 font-medium">Keep it up! 🔥</p>
                    </div>
                    <div class="h-16 w-16 rounded-full bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center text-orange-500 dark:text-orange-400">
                        <span class="material-symbols-outlined text-3xl">local_fire_department</span>
                    </div>
                </div>
            </div>

            {{-- Right Column: Stats, Graph, Badges --}}
            <div class="lg:col-span-8 flex flex-col gap-8">
                {{-- Learning Stats --}}
                <div>
                    <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Learning Stats</h3>
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        {{-- Stat 1 --}}
                        <div class="bg-card-light dark:bg-card-dark p-4 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col gap-2">
                            <div class="h-10 w-10 rounded-lg bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400">
                                <span class="material-symbols-outlined">schedule</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white">2h</p>
                                <p class="text-xs font-medium text-slate-500 dark:text-gray-400">Time Spent</p>
                            </div>
                        </div>
                        {{-- Stat 2 --}}
                        <div class="bg-card-light dark:bg-card-dark p-4 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col gap-2">
                            <div class="h-10 w-10 rounded-lg bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center text-purple-600 dark:text-purple-400">
                                <span class="material-symbols-outlined">school</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ $user->progress->count() }}</p>
                                <p class="text-xs font-medium text-slate-500 dark:text-gray-400">Lessons Done</p>
                            </div>
                        </div>
                        {{-- Stat 3 --}}
                        <div class="bg-card-light dark:bg-card-dark p-4 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col gap-2">
                            <div class="h-10 w-10 rounded-lg bg-yellow-100 dark:bg-yellow-900/30 flex items-center justify-center text-yellow-600 dark:text-yellow-400">
                                <span class="material-symbols-outlined">star</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white">{{ number_format($user->total_xp) }}</p>
                                <p class="text-xs font-medium text-slate-500 dark:text-gray-400">Total XP</p>
                            </div>
                        </div>
                        {{-- Stat 4 --}}
                        <div class="bg-card-light dark:bg-card-dark p-4 rounded-xl border border-gray-100 dark:border-gray-800 shadow-sm flex flex-col gap-2">
                            <div class="h-10 w-10 rounded-lg bg-primary/20 flex items-center justify-center text-primary-dark dark:text-primary">
                                <span class="material-symbols-outlined">leaderboard</span>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-slate-900 dark:text-white">#1</p>
                                <p class="text-xs font-medium text-slate-500 dark:text-gray-400">Global Rank</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Course Catalog (Reintegrated into Grid) --}}
                <div>
                   <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Course Catalog</h3>
                        <a class="text-sm font-semibold text-primary hover:text-primary-dark dark:hover:text-white transition-colors" href="#">View All</a>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @foreach($catalogLevels as $level)
                             @foreach($level->courses as $course)
                                <div class="bg-card-light dark:bg-card-dark p-4 rounded-xl border border-gray-100 dark:border-gray-800 hover:shadow-md transition-all group cursor-pointer relative overflow-hidden">
                                     <div class="absolute top-0 right-0 p-2 opacity-50 text-6xl transform translate-x-4 -translate-y-4 grayscale group-hover:grayscale-0 transition opacity-20 group-hover:opacity-40">
                                        {{ $course->icon ?? '🧩' }}
                                     </div>

                                    <div class="relative z-10 flex gap-4">
                                        <div class="h-12 w-12 rounded-lg bg-gray-100 dark:bg-gray-800 flex items-center justify-center text-3xl shadow-sm">
                                            {{ $course->icon ?? '📘' }}
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-slate-900 dark:text-white mb-1 group-hover:text-primary transition-colors">{{ $course->title }}</h4>
                                            <p class="text-xs text-slate-500 dark:text-gray-400 line-clamp-2 mb-2">{{ $course->description }}</p>
                                            
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-400">
                                                    {{ $course->xp_reward }} XP
                                                </span>
                                                @if($user->current_level_id >= $level->id)
                                                    <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">Available</span>
                                                @else
                                                     <span class="text-[10px] font-bold px-2 py-0.5 rounded-full bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400">Locked</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                             @endforeach
                        @endforeach
                    </div>
                </div>

                {{-- Badges Section --}}
                <div>
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Badges Earned</h3>
                        <a class="text-sm font-semibold text-primary hover:text-primary-dark dark:hover:text-white transition-colors" href="#">View All</a>
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        {{-- Static Badge - First Code --}}
                        <div class="flex items-center gap-4 rounded-xl border border-gray-100 dark:border-gray-800 bg-card-light dark:bg-card-dark p-4 hover:shadow-md transition-shadow">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400">
                                <span class="material-symbols-outlined text-2xl">code</span>
                            </div>
                            <div class="flex flex-col">
                                <h4 class="text-base font-bold text-slate-900 dark:text-white leading-tight">First Code</h4>
                                <p class="text-xs text-slate-500 dark:text-gray-400">Completed first exercise</p>
                            </div>
                        </div>
                        
                         {{-- Static Badge - Quiz Master --}}
                        <div class="flex items-center gap-4 rounded-xl border border-gray-100 dark:border-gray-800 bg-card-light dark:bg-card-dark p-4 hover:shadow-md transition-shadow">
                            <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-yellow-100 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400">
                                <span class="material-symbols-outlined text-2xl">emoji_events</span>
                            </div>
                            <div class="flex flex-col">
                                <h4 class="text-base font-bold text-slate-900 dark:text-white leading-tight">Quiz Master</h4>
                                <p class="text-xs text-slate-500 dark:text-gray-400">Passed a quiz</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
