<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductByBranch extends Model
{
    protected $table = 'product_by_branches';

    protected $fillable = [
        'product_id',
        'branch_id',
        'price',
        'discount_type',
        'discount',
        'stock_type',
        'stock',
        'is_available',
    ];

    protected $casts = ['is_available' => 'boolean'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id', 'id');
    }
    
}
