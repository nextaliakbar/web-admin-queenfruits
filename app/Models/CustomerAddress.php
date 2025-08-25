<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    protected $table = 'customer_addresses';

    protected $fillable = [
        'id', 'user_id', 'address_type',
        'contact_person_name', 'contact_person_number',
        'address', 'latitude', 'longitude', 'is_default',
        'is_choosen'
    ];

    protected $casts = [
        'is_default' => 'boolean',
        'is_choosen' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
