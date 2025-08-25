<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DMReview extends Model
{
    protected $table = 'd_m_reviews';

    protected $fillable = [
        'id', 'order_id', 'user_id', 
        'comment', 'attachment', 'rating'
    ];

    protected $casts = ['attachment' => 'array'];
}
