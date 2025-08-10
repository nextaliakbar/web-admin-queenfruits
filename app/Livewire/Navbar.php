<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class Navbar extends Component
{
    #[On('profileUpdated')]
    public function refreshNavbar(){}

    public function render()
    {
        return view('livewire.navbar');
    }

    public function logout()
    {
        auth()->guard('admin')->logout();

        return $this->redirect(route('admin.login'));
    }
}
