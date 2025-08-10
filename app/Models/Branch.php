<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Branch extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'branches';

    protected $fillable = [
        'id', 'name', 'telp', 'email',
        'preparation_time', 'password',
        'branch_image', 'address',
        'lat', 'lng', 'coverage'
    ];

    protected $casts = [
        'status' => 'boolean',
        'promotion_campaign' => 'boolean'
    ];

    public function delivery_charge_setup()
    {
        return $this->hasOne(DeliveryChargeSetup::class, 'branch_id', 'id');
    }
}
