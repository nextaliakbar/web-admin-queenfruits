<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = [
        'id', 'order_id', 'product_id',
        'product_details', 'price',
        'price', 'discount_type',
        'discount', 'quantity',
        'tax_amount', 'created_at',
        'updated_at'
    ];

    protected $casts = [
        'product_details' => 'array'
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }
}
