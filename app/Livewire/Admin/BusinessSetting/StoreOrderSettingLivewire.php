<?php

namespace App\Livewire\Admin\BusinessSetting;

use App\Models\BusinessSetting;
use Livewire\Component;

class StoreOrderSettingLivewire extends Component
{
    public $minOrder, $timeSlot;

    public function render()
    {
        $this->minOrder = BusinessSetting::where('key', '=', 'min_order')->value('value');

        $this->timeSlot = BusinessSetting::where('key', '=', 'time_slot')->value('value');

        return view('livewire.admin.business-setting.store-order-setting');
    }

    public function update()
    {
        $minOrder = BusinessSetting::updateOrCreate([
            'key' => 'min_order'
        ], [
            'key' => 'min_order',
            'value' => $this->minOrder
        ]);

        $timeSlot = BusinessSetting::updateOrCreate([
            'key' => 'time_slot'
        ], [
            'key' => 'time_slot',
            'value' => $this->timeSlot
        ]);

        if($minOrder && $timeSlot) {
            $this->dispatch('toastUpdate', success: true, message: 'Pengaturan pesanan toko berhasil diperbarui');
        } else {
            $this->dispatch('toastUpdate', success: true, message: 'Pengaturan pesanan toko berhasil diperbarui');
        }
    }
}
