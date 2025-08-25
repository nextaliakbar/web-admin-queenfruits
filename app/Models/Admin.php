<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'admins';
    protected $fillable = [
        'id', 'name', 'phone', 'email', 'password',
        'admin_role_id', 'status', 'remember_token',
        'created_at', 'updated_at' 
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function role()
    {
        return $this->belongsTo(AdminRole::class, 'admin_role_id', 'id');
    }
}
