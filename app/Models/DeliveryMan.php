<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeliveryMan extends Model
{
    protected $table = 'delivery_men';

    protected $fillable = [
        'id', 'name', 'email', 'phone',
        'password', 'branch_id', 'is_active',
        'created_at', 'updated_at'
    ];

    protected $casts = ['is_active' => 'boolean'];
}
