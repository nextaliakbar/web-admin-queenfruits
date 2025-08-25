<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminRole extends Model
{
    protected $table = 'admin_roles';

    protected $fillable = ['id', 'name', 'module_access'];

    public function admins()
    {
        return $this->hasOne(Admin::class, 'admin_role_id', 'id');
    }
}
