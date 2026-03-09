<div class="max-w-5xl mx-auto py-10 px-4">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-black text-slate-800 dark:text-slate-200 mb-3 transition-colors duration-300">Pilih Jalur Belajarmu</h1>
        <p class="text-slate-500 dark:text-slate-400 font-medium max-w-2xl mx-auto transition-colors duration-300">Selesaikan materi pelajaran untuk membuka petualangan baru di ZenUniverse!</p>
    </div>

    {{-- Content Area --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 transition-all duration-300">
        @foreach($studentCourses as $course)
            <div wire:key="course-{{ $course->id }}" class="group bg-white dark:bg-slate-800 rounded-3xl border-2 border-slate-100 dark:border-slate-700 p-6 hover:border-primary dark:hover:border-primary hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-100/50 dark:from-orange-900/20 to-transparent rounded-full -mr-10 -mt-10 transition-transform group-hover:scale-150"></div>
                
                <div class="relative z-10 flex flex-col h-full">
                    <div class="size-14 rounded-2xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                        <span class="material-symbols-outlined text-primary dark:text-orange-400 text-3xl">{{ $course->icon ?? 'school' }}</span>
                    </div>
                    
                    <h3 class="text-xl font-black text-slate-800 dark:text-slate-200 mb-2 leading-tight transition-colors duration-300">{{ $course->title }}</h3>
                    <p class="text-slate-500 dark:text-slate-400 text-sm font-medium mb-6 line-clamp-2 transition-colors duration-300">{{ $course->description }}</p>
                    
                    <div class="mt-auto pt-6 border-t border-slate-50 dark:border-slate-700 flex items-center justify-between transition-colors duration-300">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-slate-300 dark:text-slate-500">auto_stories</span>
                            <span class="text-xs font-bold text-slate-400 dark:text-slate-500">{{ $course->lessons()->count() }} Pelajaran</span>
                        </div>
                        <button wire:click="selectCourse({{ $course->id }})" 
                                class="bg-primary hover:bg-orange-600 text-white text-xs font-bold uppercase tracking-wider px-5 py-2.5 rounded-xl shadow-lg shadow-orange-500/20 transition-all hover:-translate-y-1">
                            Pilih
                        </button>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
