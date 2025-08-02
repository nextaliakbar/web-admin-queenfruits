<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banners';

    protected $fillable = [
        'id', 'title', 'image',
        'status', 'category_id',
        'product_id'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}
