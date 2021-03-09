<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\UserProfile;

class Country extends Model
{
    protected $guarded = [];

    public function posts()
    {
    	return $this->hasManyThrough(
    		Post::class,
    		UserProfile::class,
    		'country_id',
    		'user_id',
    		'id',
    		'user_id'
    	);
    }
}
