<?php

namespace App\Livewire\Admin\BusinessSetting;

use App\Models\DeliveryChargeSetup;
use Livewire\Component;

class StoreDeliveryFeesLivewire extends Component
{
    public $branchId, $isFixedCharge, $isPerKmCharge, $fixedCharge,
    $chargePerKm, $minCharge, $maxKmForFreeDelivery;

    public function mount($branchId)
    {
        $this->getData($branchId);
    }

    public function getData($branchId)
    {
        $deliveryChargeSetup = DeliveryChargeSetup::where('branch_id', '=', $branchId)->first();
        $this->isFixedCharge = $deliveryChargeSetup->delivery_charge_type == 'Tetap';
        $this->isPerKmCharge = $deliveryChargeSetup->delivery_charge_type == 'Biaya Per Km';
        $this->fixedCharge = $deliveryChargeSetup->fixed_delivery_charge;
        $this->chargePerKm = $deliveryChargeSetup->delivery_charge_per_km;
        $this->minCharge = $deliveryChargeSetup->minimum_delivery_charge;
        $this->maxKmForFreeDelivery = $deliveryChargeSetup->maximum_distance_for_free_delivery;
        $this->branchId = $deliveryChargeSetup->branch_id;
    }

    public function render()
    {
        return view('livewire.admin.business-setting.store-delivery-fees');
    }

    public function updatedIsFixedCharge($value)
    {
        if($value) {
            $this->isPerKmCharge = false;
        } else {
            $this->isPerKmCharge = true;
        }

        $this->updateChargeType();
    }

    public function updatedIsPerKmCharge($value)
    {
        if($value) {
            $this->isFixedCharge = false;
        } else {
            $this->isFixedCharge = true;
        }

        $this->updateChargeType();
    }

    private function updateChargeType()
    {  
        $deliveryChargeSetup = DeliveryChargeSetup::where('branch_id', '=', $this->branchId)->first();
        $deliveryChargeType = null;

        if($this->isFixedCharge) {
            $deliveryChargeType = 'Tetap';
        } elseif($this->isPerKmCharge) {
            $deliveryChargeType = 'Biaya Per Km';
        }

        $deliveryChargeSetup->delivery_charge_type = $deliveryChargeType;
        $update = $deliveryChargeSetup->update();

        if($update) {
            $this->dispatch('toastUpdateDeliveryChargeType', success: true, message: 'Jenis biaya pengiriman berhasil diubah');
        } else {
            $this->dispatch('toastUpdateDeliveryChargeType', success: false, message: 'Jenis biaya pengiriman gagal diubah');
        }
    }

    public function rules()
    {
        $rules = [];

        if($this->isFixedCharge) {
            $rules['fixedCharge'] = 'required|numeric';
        } elseif($this->isPerKmCharge) {
            $rules['chargePerKm'] = 'required|numeric';
            $rules['minCharge'] = 'required|numeric';
            $rules['maxKmForFreeDelivery'] = 'required|numeric';
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'fixedCharge.required' => 'Biaya pengiriman tetap tidak boleh kosong',
            'fixedCharge.numeric' => 'Biaya pengiriman harus berupa angka',
            'chargePerKm.required' => 'Biaya pengriman per km tidak boleh kosong',
            'chargePerKm.numeric' => 'Biaya pengiriman per km harus berupa angka',
            'minCharge.required' => 'Minimal biaya pengiriman tidak boleh kosong',
            'minCharge.numeric' => 'Minimal biaya pengiriman harus berupa angka',
            'maxKmForFreeDelivery.required' => 'Maksimal jarak untuk gratis pengiriman tidak boleh kosong',
            'maxKmForFreeDelivery.numeric' => 'Maksimal jarak untuk gratis pengiriman harus berupa angka'
        ];
    }

    public function update()
    {
        $this->validate();

        $deliveryChargeSetup = DeliveryChargeSetup::where('branch_id', '=', $this->branchId)->first();

        if($this->isFixedCharge) {
            $deliveryChargeSetup->fixed_delivery_charge = $this->fixedCharge;
        } elseif($this->isPerKmCharge) {
            $deliveryChargeSetup->delivery_charge_per_km = $this->chargePerKm;
            $deliveryChargeSetup->minimum_delivery_charge = $this->minCharge;
            $deliveryChargeSetup->maximum_distance_for_free_delivery = $this->maxKmForFreeDelivery;
        }

        $update = $deliveryChargeSetup->update();

        if($update) {
            $this->resetValidation();
            $this->dispatch('toastUpdateDeliveryCharge', success: true, message: 'Biaya pengiriman berhasil diperbarui');
        } else {
            $this->dispatch('toastUpdateDeliveryCharge', success: false, message: 'Biaya pengiriman gagal diperbarui');
        }
    }
}
