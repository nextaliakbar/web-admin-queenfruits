<?php

namespace App\Livewire\Admin\BusinessSetting;

use App\Models\BusinessSetting;
use Livewire\Component;

class BusinessInfoLivewire extends Component
{
    
    public $name, $telp, $email;

    public function render()
    {
        
        $this->name = BusinessSetting::where('key', '=', 'name')->value('value');

        $this->telp = BusinessSetting::where('key', '=', 'telp')->value('value');

        $this->telp = substr($this->telp, 3);

        $this->email = BusinessSetting::where('key', '=', 'email')->value('value');

        return view('livewire.admin.business-setting.business-setting-info');
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'telp' => 'required',
            'email' => 'required'
        ];
    }

    public function refresh()
    {
        $this->reset(['name', 'telp', 'email']);
    }

    public function update()
    {
        $this->validate();

        $name = BusinessSetting::updateOrCreate([
            'key' => 'name'
        ], [
            'key' => 'name',
            'value' => $this->name
        ]);

        $telp = BusinessSetting::updateOrCreate([
            'key' => 'telp'
        ], [
            'key' => 'telp',
            'value' => '+62'. $this->telp
        ]);

        $email = BusinessSetting::updateOrCreate([
            'key' => 'email'
        ], [
            'key' => 'email',
            'value' => $this->email
        ]);

        if($name && $telp && $email) {
            $this->dispatch('toastUpdate', success: true, message: 'Informasi bisnis berhasil diperbarui');
        } else {
            $this->dispatch('toastUpdate', success: false, message: 'Informasi bisnis gagal diperbarui');
        }

    }
}
