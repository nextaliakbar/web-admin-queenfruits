<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'id', 'name', 'description',
        'category_id', 'product_type',
        'price', 'discount_type',
        'discount', 'tax_type',
        'tax', 'stock_type', 'stock',
        'is_active', 'images', 'available_time_start',
        'available_time_end', 'is_recommend',
        'created_at', 'updated_at'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'images' => 'array',
        'is_recommend' => 'boolean'
    ];
}
