<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.auth-custom')]
class Register extends Component
{
    public string $name = '';

    public string $email = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $role = 'student'; // Default role
    
    public string $age_group = '8-12'; // Default age group

    public int $step = 1;

    public function updatedEmail($value): void
    {
        $this->email = strtolower(trim($value));
    }

    public function nextStep(): void
    {
        $this->name = trim($this->name);
        $this->email = strtolower(trim($this->email));

        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'role' => ['required', 'string', 'in:student,teacher,parent'],
            'age_group' => ['required', 'string', 'in:4-7,8-12,12-16,adult'],
        ]);

        $this->step = 2;
    }

    public function register(): void
    {
        $validated = $this->validate([
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'age_group' => $this->age_group,
            'password' => Hash::make($this->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: false);
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
