<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryChargeSetup extends Model
{
    protected $table = 'delivery_charge_setups';

    protected $fillable = [
        'id', 'branch_id', 'delivery_charge_type',
        'delivery_charge_per_km', 'minimum_delivery_charge',
        'maximum_distance_for_free_delivery',
        'fixed_delivery_charge'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
}
