<div class="max-w-4xl mx-auto px-4 md:px-6 w-full py-8">
    <!-- Progress Header -->
    <div class="mb-8">
        <div class="flex justify-between items-center text-sm font-bold text-slate-400 mb-2 px-2">
            <span class="{{ $step >= 1 ? 'text-primary' : '' }}">Langkah 1: Identitas</span>
            <span class="{{ $step >= 2 ? 'text-primary' : '' }}">Langkah 2: Keamanan</span>
        </div>
        <div class="h-4 bg-blue-100 rounded-full relative">
            <div class="absolute top-0 left-0 h-full bg-gradient-to-r from-orange-400 to-primary transition-all duration-500 ease-out rounded-full" style="width: {{ $step === 1 ? '50%' : '100%' }}">
                <div class="absolute right-0 top-1/2 -translate-y-1/2 bg-white rounded-full p-1 shadow-sm border border-orange-200" style="transform: translate(50%, -50%);">
                    <span class="material-symbols-outlined text-primary text-[10px] font-bold block">rocket_launch</span>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-3xl md:rounded-[3rem] p-6 md:p-12 shadow-2xl border-4 border-blue-50 dark:border-slate-700 relative overflow-hidden transition-all duration-500">
        <!-- Floating Elements -->
        <div class="absolute -top-10 -right-10 w-32 h-32 bg-yellow-100 dark:bg-yellow-900/20 rounded-full blur-2xl opacity-60"></div>
        <div class="absolute bottom-10 -left-10 w-24 h-24 bg-purple-100 dark:bg-purple-900/20 rounded-full blur-xl opacity-60"></div>

        <!-- Step 1: Identity -->
        @if($step === 1)
        <div class="relative z-10 animate-fade-in-up">
            <div class="text-center mb-10">
                <div class="inline-block relative">
                   <h2 class="text-4xl font-black text-slate-800 dark:text-white mb-2">Buat Akun Baru</h2>
                   <div class="absolute -top-6 -right-12 rotate-12 bg-yellow-100 dark:bg-yellow-900/50 rounded-full p-3 shadow-sm animate-bounce" style="animation-duration: 3s;">
                        <span class="material-symbols-outlined text-yellow-500 text-3xl">sentiment_satisfied</span>
                   </div>
                </div>
                <p class="text-slate-500 dark:text-slate-400 font-medium text-lg">Ayo bergabung dan mulai petualangan bersama kami!</p>
            </div>

            <form wire:submit="nextStep" class="space-y-6 max-w-md mx-auto">

                <div class="space-y-2">
                    <label class="block text-slate-600 dark:text-slate-300 font-bold ml-2" for="name">Nama Lengkap</label>
                    <div class="relative">
                        <input wire:model="name" id="name" class="input-field w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-700/50 text-slate-700 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-0 text-lg font-medium pl-14" type="text" name="name" required placeholder="Ketik nama kerenmu di sini..." />
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 pointer-events-none">
                            <span class="material-symbols-outlined">badge</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('name')" class="mt-2 ml-2" />
                </div>

                <div class="space-y-2">
                    <label class="block text-slate-600 dark:text-slate-300 font-bold ml-2" for="email">Email</label>
                    <div class="relative">
                        <input wire:model="email" id="email" class="input-field w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-700/50 text-slate-700 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-0 text-lg font-medium pl-14" type="email" name="email" required placeholder="contoh: astronot@zenuniverse.id" />
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 pointer-events-none">
                            <span class="material-symbols-outlined">mail</span>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('email')" class="mt-2 ml-2" />
                </div>

                <div class="pt-4">
                    <button class="bubbly-button w-full py-4 rounded-2xl bg-primary text-white text-xl font-black hover:brightness-110 flex items-center justify-center gap-2 group" type="submit" wire:loading.attr="disabled">
                        <span wire:loading.remove>Lanjut ke Misi</span>
                        <span wire:loading>Memproses...</span>
                        <span class="material-symbols-outlined font-bold group-hover:translate-x-1 transition-transform">arrow_forward</span>
                    </button>
                </div>
                
                <div class="text-center pt-2">
                     <a class="text-sm font-bold text-slate-400 dark:text-slate-500 hover:text-primary transition-colors" href="{{ route('login') }}" wire:navigate>
                        Sudah punya akun? Masuk di sini
                    </a>
                </div>
            </form>
        </div>
        @endif

        <!-- Step 2: Security -->
        @if($step === 2)
        <div class="relative z-10 animate-fade-in-up">
             <div class="text-center mb-10">
                <button wire:click="$set('step', 1)" class="absolute top-0 left-0 text-slate-400 dark:text-slate-500 hover:text-primary transition-colors flex items-center gap-1 font-bold text-sm bg-slate-50 dark:bg-slate-700/50 px-3 py-1.5 rounded-xl hover:bg-blue-50 dark:hover:bg-slate-600/50">
                    <span class="material-symbols-outlined text-lg">arrow_back</span>
                    Kembali
                </button>
                
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-green-100 dark:bg-green-900/50 text-green-500 mb-4">
                    <span class="material-symbols-outlined text-4xl">shield_lock</span>
                </div>
                <h2 class="text-3xl font-black text-slate-800 dark:text-white">Amankan Akunmu</h2>
                <p class="text-slate-500 dark:text-slate-400 font-medium">Buat sandi rahasia yang kuat!</p>
            </div>

            <form wire:submit="register" class="space-y-6 max-w-md mx-auto">
                 <div class="space-y-2" x-data="{ show: false }" wire:key="register-password-wrapper">
                    <label class="block text-slate-600 dark:text-slate-300 font-bold ml-2" for="password">Kata Sandi</label>
                    <div class="relative">
                        <input wire:model="password" id="password" class="input-field w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-700/50 text-slate-700 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-0 text-lg font-medium pl-14" :type="show ? 'text' : 'password'" name="password" required placeholder="••••••••" />
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 pointer-events-none">
                            <span class="material-symbols-outlined">key</span>
                        </div>
                        <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 hover:text-primary transition-colors focus:outline-none">
                            <span class="material-symbols-outlined" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password')" class="mt-2 ml-2" />
                </div>

                <div class="space-y-2" x-data="{ show: false }" wire:key="register-confirm-wrapper">
                    <label class="block text-slate-600 dark:text-slate-300 font-bold ml-2" for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <div class="relative">
                        <input wire:model="password_confirmation" id="password_confirmation" class="input-field w-full px-6 py-4 rounded-2xl bg-slate-50 dark:bg-slate-700/50 text-slate-700 placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-0 text-lg font-medium pl-14" :type="show ? 'text' : 'password'" name="password_confirmation" required placeholder="Ketik ulang sandi..." />
                        <div class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 pointer-events-none">
                            <span class="material-symbols-outlined">lock_reset</span>
                        </div>
                        <button type="button" @click="show = !show" class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 dark:text-slate-500 hover:text-primary transition-colors focus:outline-none">
                            <span class="material-symbols-outlined" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                        </button>
                    </div>
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 ml-2" />
                </div>

                <div class="pt-6">
                    <button class="bubbly-button w-full py-4 rounded-2xl bg-green-500 text-white text-xl font-black hover:brightness-110 flex items-center justify-center gap-2 group" type="submit" wire:loading.attr="disabled">
                        <span wire:loading.remove>Mulai Petualangan!</span>
                        <span wire:loading>Menyiapkan Roket...</span>
                        <span class="material-symbols-outlined font-bold group-hover:rotate-12 transition-transform">rocket_launch</span>
                    </button>
                </div>
            </form>
        </div>
        @endif
    </div>
</div>
