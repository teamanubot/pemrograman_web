<?php

namespace App\Livewire\Akun;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AkunLogin extends Component
{
    public $email;
    public $password;
    public $showPassword = false;

    public function toggleShowPassword()
    {
        $this->showPassword = !$this->showPassword;
    }

    public function login()
    {
        $credentials = [
            'email' => $this->email,
            'password' => $this->password,
        ];

        if (Auth::guard('akun')->attempt($credentials)) {
            session()->regenerate();
            return redirect('/');
        }

        $this->addError('email', 'Email atau password salah.');
    }

    public function render()
    {
        return view('livewire.akun.login');
    }
}
