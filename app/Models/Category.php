<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'id',
        'name',
        'status',
        'priority',
        'image',
        'banner_image'
    ];

    protected $casts = ['status' => 'boolean'];
}
