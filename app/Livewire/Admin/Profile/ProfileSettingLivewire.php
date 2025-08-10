<?php

namespace App\Livewire\Admin\Profile;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Rule;
use Livewire\Component;

class ProfileSettingLivewire extends Component
{
    public $name, $telp, $email, $password, $passwordConfirmation;
    public function mount()
    {
        $admin = Admin::findOrFail(auth()->guard('admin')->user()->id);
        $this->name = $admin->name;
        $this->telp = substr($admin->phone, 3);
        $this->email = $admin->email;
    }

    public function render()
    {
        return view('livewire.admin.profile.index');
    }

    public function updateProfile()
    {
        $this->validate([
            'name' => 'required',
            'telp' => 'required|numeric',
            'email' => 'required|email|unique:admins,email,' . auth()->guard('admin')->user()->id
        ], [
            'name.required' => 'Nama tidak boleh kosong',
            'telp.required' => 'No.telp tidak boleh kosong',
            'telp.numeric' => 'No.telp harus berupa angka',
            'email.required' => 'Email tidak boleh kosong',
            'email.email' => 'Format email tidak cocok',
            'email.unique' => 'Email sudah tersedia'
        ]);

        $admin = Admin::findOr(auth()->guard('admin')->user()->id);

        $admin->name = $this->name;
        $admin->phone = '+62' . $this->telp;
        $admin->email = $this->email;
        
        $update = $admin->update();

        if($update) {
            $this->dispatch('profileUpdated');
            $this->dispatch('toastUpdateProfile', success: true, message: 'Informai profil berhasil diperbarui');
        } else {
            $this->dispatch('toastUpdateProfile', success: false, message: 'Informai profil gagal diperbarui');
        }
    }

    public function updatePassword()
    {
        $this->validate([
            'password' => 'required|min:8',
            'passwordConfirmation' => 'required|min:8|same:password'
        ], [
            'password.required' => 'Password tidak boleh kosong',
            'password.min' => 'Password minimal 8 karakter',
            'passwordConfirmation.required' => 'Konfirmasi password tidak boleh kosong',
            'passwordConfirmation.min' => 'Konfirmasi password minimal 8 karakter',
            'passwordConfirmation.same' => 'Konfirmasi password tidak cocok'
        ]);

        $admin = Admin::findOr(auth()->guard('admin')->user()->id);

        $admin->password = Hash::make($this->password);

        $update = $admin->update();

        if($update) {
            $this->dispatch('toastUpdatePassword', success: true, message: 'Password berhasil diperbarui');
        } else {
            $this->dispatch('toastUpdatePassword', success: false, message: 'Password gagal diperbarui');
        }
    }
}
