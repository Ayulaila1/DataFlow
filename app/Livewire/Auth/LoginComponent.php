<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginComponent extends Component
{
    public $email = '';

    public $password = '';

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $this->email)->first();

        if (!$user) {

            session()->flash('error', 'Email tidak ditemukan.');

            return;
        }

        if (!Hash::check($this->password, $user->password)) {

            session()->flash('error', 'Password salah.');

            return;
        }

        session([
            'iduser' => $user->iduser,
            'name' => $user->name,
            'email' => $user->email
        ]);

        return redirect('/dashboard');
    }

    public function render()
    {
        return view('livewire.auth.login-component')
            ->layout('layouts.app');
    }
}