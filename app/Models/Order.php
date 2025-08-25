<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'id', 'branch_id', 'delivery_man_id',
        'user_id', 'delivery_address_id',
        'order_type', 'order_amount', 'payment_status',
        'order_status', 'total_discount','total_tax_amount', 
        'payment_method', 'cheked', 'delivery_date', 'delivery_time',
        'delivery_address', 'delivery_charge',
        'preparation_time', 'order_note', 'created_at',
        'updated_at'
    ];

    protected $casts = [
        'delivery_address' => 'array'
    ];

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }
}
