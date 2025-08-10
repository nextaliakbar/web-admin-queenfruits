<?php

namespace App\Livewire\Admin\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LoginLivewire extends Component
{
    public $email;

    public $password;

    public function render()
    {
        return view('livewire.admin.auth.index');
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
        ]);


        if (Auth::guard('admin')->attempt([
            'email' => $this->email, 
            'password' => $this->password
            ])) {
            session()->regenerate();
            return $this->redirect(route('admin.category.index'));
        }

         $this->dispatch('errorModal');
    }
}
