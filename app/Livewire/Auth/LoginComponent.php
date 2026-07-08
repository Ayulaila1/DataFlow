<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginComponent extends Component
{
    public string $email = '';

    public string $password = '';

    public function login()
    {
        $validated = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($validated)) {

            session()->flash(
                'error',
                'Email atau password salah.'
            );

            return;
        }

        session()->regenerate();

        return $this->redirectRoute('dashboard', navigate: true);
    }

    public function render()
    {
        return view('livewire.auth.login-component')
            ->layout('layouts.guest');
    }
}