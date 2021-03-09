<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(User::class, 'role_user', 'user_id', 'role_id', 'id', 'id');
    }
}