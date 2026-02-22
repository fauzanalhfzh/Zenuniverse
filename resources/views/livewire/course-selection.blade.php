<div class="max-w-5xl mx-auto py-10 px-4">
    <div class="text-center mb-12">
        <h1 class="text-3xl font-black text-slate-800 mb-3">Pilih Jalur Belajarmu</h1>
        <p class="text-slate-500 font-medium max-w-2xl mx-auto">Sesuaikan materi pelajaran dengan peranmu. Apakah kamu ingin belajar atau mengajar?</p>
    </div>

    {{-- Role Tabs --}}
    <div class="flex justify-center mb-12">
        <div class="bg-white p-1.5 rounded-2xl border-2 border-slate-100 inline-flex shadow-sm">
            <button wire:click="setRole('student')" 
                    class="px-8 py-3 rounded-xl text-sm font-bold uppercase tracking-wider transition-all {{ $role === 'student' ? 'bg-primary text-white shadow-md' : 'text-slate-500 hover:bg-slate-50' }}">
                Siswa
            </button>
            <button wire:click="setRole('teacher')" 
                    class="px-8 py-3 rounded-xl text-sm font-bold uppercase tracking-wider transition-all {{ $role === 'teacher' ? 'bg-primary text-white shadow-md' : 'text-slate-500 hover:bg-slate-50' }}">
                Guru
            </button>
        </div>
    </div>

    {{-- Content Area --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 transition-all duration-300">
        @if($role === 'student')
            @foreach($studentCourses as $course)
                <div wire:key="course-{{ $course->id }}" class="group bg-white rounded-3xl border-2 border-slate-100 p-6 hover:border-primary hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-orange-100/50 to-transparent rounded-full -mr-10 -mt-10 transition-transform group-hover:scale-150"></div>
                    
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="size-14 rounded-2xl bg-orange-100 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-primary text-3xl">{{ $course->icon ?? 'school' }}</span>
                        </div>
                        
                        <h3 class="text-xl font-black text-slate-800 mb-2 leading-tight">{{ $course->title }}</h3>
                        <p class="text-slate-500 text-sm font-medium mb-6 line-clamp-2">Mulai petualangan belajarmu di sini. Kuasai dasar-dasar pemrograman web dari nol.</p>
                        
                        <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-slate-300 text-lg">auto_stories</span>
                                <span class="text-xs font-bold text-slate-400">{{ $course->lessons()->count() }} Pelajaran</span>
                            </div>
                            <button wire:click="selectCourse({{ $course->id }})" 
                                    class="bg-primary hover:bg-orange-600 text-white text-xs font-bold uppercase tracking-wider px-5 py-2.5 rounded-xl shadow-lg shadow-orange-500/20 transition-all hover:-translate-y-1">
                                Pilih
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            {{-- Teacher Content --}}
            @foreach($teacherCourses as $course)
                <div wire:key="teacher-course-{{ $course->id }}" class="group bg-white rounded-3xl border-2 border-slate-100 p-6 hover:border-blue-500 hover:shadow-xl hover:shadow-blue-500/10 transition-all duration-300 relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-gradient-to-br from-blue-100/50 to-transparent rounded-full -mr-10 -mt-10 transition-transform group-hover:scale-150"></div>
                    
                    <div class="relative z-10 flex flex-col h-full">
                        <div class="size-14 rounded-2xl bg-blue-100 flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <span class="material-symbols-outlined text-blue-500 text-3xl">{{ $course->icon ?? 'school' }}</span>
                        </div>
                        
                        <h3 class="text-xl font-black text-slate-800 mb-2 leading-tight">{{ $course->title }}</h3>
                        <p class="text-slate-500 text-sm font-medium mb-6 line-clamp-2">{{ $course->description }}</p>
                        
                        <div class="mt-auto pt-6 border-t border-slate-50 flex items-center justify-between">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-slate-300 text-lg">library_books</span>
                                    <span class="text-xs font-bold text-slate-400">{{ $course->lessons()->count() }} Modul</span>
                                </div>
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-slate-300 text-lg">school</span>
                                    <span class="text-xs font-bold text-slate-400">0 Guru</span>
                                </div>
                            </div>
                            <button wire:click="selectCourse({{ $course->id }})" class="bg-blue-500 hover:bg-blue-600 text-white text-xs font-bold uppercase tracking-wider px-5 py-2.5 rounded-xl shadow-lg shadow-blue-500/20 transition-all hover:-translate-y-1">
                                Gabung
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>
