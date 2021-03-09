<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class UserProfile extends Model
{
    protected $guarded = [];
    protected $table = 'profiles';
    public function user(){
    	return $this->belongsTo(User::class, 'user_id','id');
    }
}
