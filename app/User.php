<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserProfile;
use App\Models\Post;
use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username','api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // One to One relationship 
    public function profile()
    {
        return $this->hasOne(UserProfile::class,'user_id','id');
    }

    public function posts(){
        return $this->hasMany(Post::class, 'user_id', 'id');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_user', 'user_id', 'role_id','id');
    }

    //Slug for username at the time of registration
    public function setUsernameAttribut($username)
    {
        $username = trim(preg_replace("/[^\d\w]+/i","-",$username),"");
        $count = $this->where('username','like',"%{$username}%")->count();
        if($username>0)
            $username = $username."_".($count+1);
        
        $this->attributes['username'] = strtolower($username);
    }
}
