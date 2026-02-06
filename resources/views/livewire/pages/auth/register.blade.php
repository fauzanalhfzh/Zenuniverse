<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="space-y-4">
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Mulai Belajar! 🚀</h2>
        <p class="text-gray-500">Buat akun untuk menyimpan progressmu.</p>
    </div>

    <form wire:submit="register" class="space-y-4">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nama Lengkap')" class="text-gray-700" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50" type="text" name="name" required autofocus autocomplete="name" placeholder="Siapa namamu?" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50" type="email" name="email" required autocomplete="username" placeholder="nama@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700" />

            <x-text-input wire:model="password" id="password" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50"
                            type="password"
                            name="password"
                            required autocomplete="new-password" 
                            placeholder="********" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div>
            <x-input-label for="password_confirmation" :value="__('Konfirmasi Password')" class="text-gray-700" />

            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full rounded-xl border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 bg-white/50"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" 
                            placeholder="Tulis ulang password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-6">
            <a class="underline text-sm text-gray-500 hover:text-indigo-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Sudah punya akun?') }}
            </a>

            <button type="submit" class="px-6 py-2 bg-yellow-400 text-indigo-900 font-bold rounded-xl hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition shadow-lg transform hover:scale-105">
                {{ __('Daftar Sekarang') }}
            </button>
        </div>
    </form>
</div>
