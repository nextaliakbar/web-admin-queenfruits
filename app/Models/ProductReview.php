<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    protected $table = 'product_reviews';

    protected $fillable = [
        'id', 'order_id', 'user_id', 'product_id', 
        'comment', 'attachment', 'rating'
    ];

    protected $casts = ['attachment' => 'array'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
