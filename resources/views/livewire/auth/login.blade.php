<div class="max-w-6xl mx-auto px-6 w-full">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="hidden lg:flex flex-col items-center text-center space-y-8 relative">
            <div class="relative w-full max-w-md aspect-square">
                <div class="absolute inset-0 bg-blue-200/30 blur-[80px] rounded-full"></div>
                <img alt="Chibi astronaut mascot floating" class="relative z-10 w-full h-full object-cover drop-shadow-2xl animate-bounce" src="{{ asset('images/hero.png') }}" style="animation-duration: 3s;"/>
                {{-- <div class="absolute top-10 -right-4 bg-white border-4 border-yellow-200 px-6 py-3 rounded-full shadow-xl flex items-center gap-2 transform rotate-6 z-99">
                    <span class="material-symbols-outlined text-yellow-500 text-3xl">star</span>
                    <span class="text-slate-600 font-bold text-lg">Siap Belajar?</span>
                </div> --}}
            </div>
            <div class="space-y-4">
                <h1 class="text-5xl font-extrabold text-slate-800 tracking-tight">
                    Welcome Back, <br/>
                    <span class="text-primary">Explorer!</span>
                </h1>
                <p class="text-xl text-slate-500 font-medium max-w-sm mx-auto">
                    Roketmu sudah siap di landasan. Ayo lanjutkan petualangan coding yang seru!
                </p>
            </div>
        </div>
        <div class="w-full max-w-md mx-auto lg:mx-0 lg:ml-auto">
            <div class="bg-white rounded-[3rem] p-8 md:p-12 shadow-2xl border-4 border-blue-50 relative overflow-hidden">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-orange-100 rounded-full blur-2xl opacity-60"></div>
                <div class="text-center mb-8 relative z-10">
                    <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-blue-100 text-primary mb-4">
                        <span class="material-symbols-outlined text-4xl">lock_open</span>
                    </div>
                    <h2 class="text-3xl font-black text-slate-800">Masuk Akun</h2>
                    <p class="text-slate-500 font-medium">Masukkan kunci rahasiamu!</p>
                </div>

                <x-auth-session-status class="mb-4" :status="session('status')" />

                <form wire:submit="login" class="space-y-6 relative z-10">
                    <div class="space-y-2">
                        <label class="block text-slate-600 font-bold ml-2" for="email">Email atau Nama Pengguna</label>
                        <div class="relative">
                            <input wire:model="form.email" id="email" class="input-field w-full px-6 py-4 rounded-2xl bg-slate-50 text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-0 text-lg font-medium pl-14" type="text" name="email" required autofocus autocomplete="username" placeholder="kapten@zenuniverse.id" />
                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                <span class="material-symbols-outlined">person</span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('form.email')" class="mt-2 ml-2" />
                    </div>

                    <div class="space-y-2">
                        <label class="block text-slate-600 font-bold ml-2" for="password">Kata Sandi</label>
                        <div class="relative">
                            <input wire:model="form.password" id="password" class="input-field w-full px-6 py-4 rounded-2xl bg-slate-50 text-slate-700 placeholder-slate-400 focus:outline-none focus:ring-0 text-lg font-medium pl-14" type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                            <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                <span class="material-symbols-outlined">key</span>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('form.password')" class="mt-2 ml-2" />
                        
                        <div class="flex justify-between items-center pt-1 px-2">
                            <label for="remember" class="inline-flex items-center">
                                <input wire:model="form.remember" id="remember" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                                <span class="ms-2 text-sm text-gray-600">Ingat Saya</span>
                            </label>

                            @if (Route::has('password.request'))
                                <a class="text-sm font-bold text-primary hover:text-orange-600 transition-colors" href="{{ route('password.request') }}" wire:navigate>
                                    Lupa kata sandi?
                                </a>
                            @endif
                        </div>
                    </div>

                    <button class="bubbly-button w-full py-4 rounded-2xl bg-primary text-white text-xl font-black hover:brightness-110 flex items-center justify-center gap-2 mt-4" type="submit">
                        Ayo Meluncur!
                        <span class="material-symbols-outlined font-bold">rocket_launch</span>
                    </button>
                </form>

                <div class="mt-8 pt-6 border-t-2 border-slate-100 text-center">
                    <p class="text-slate-500 font-medium mb-4">Belum punya akun?</p>
                    <a class="inline-flex items-center gap-2 text-lg font-bold text-secondary hover:text-indigo-600 transition-colors bg-indigo-50 px-6 py-3 rounded-xl hover:bg-indigo-100" href="{{ route('register') }}" wire:navigate>
                        Daftar di sini
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
