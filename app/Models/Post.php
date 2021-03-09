<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Models\UserProfile;
use App\Models\Post;
use App\Models\Category;

class Post extends Model
{
	protected $guarded = [];

	public function user()
	{
		return $this->belongsTo(User::class,'user_id','id');
	}

	public function profile()
	{
		return $this->hasOneThrough(UserProfile::class,'id','user_id','user_id','id');
	}

	public function categories()
	{
		return $this->belongsToMany(Category::class,'post_categories','post_id','category_id','id','id');
	}

	// Mutetor
	public function setSlugAttribute($val)
    {
    	$slug = trim(preg_replace("/[^\d\w]+/i","-",$val),"");
    	$count = $this->where('slug','like',"%{$slug}%")->count();
    	if($slug>0)
    		$slug = $slug."_".($count+1);
    	
    	$this->attributes['slug'] = strtolower($slug);
    }

    // Accessor
    public function getSlugAttribute($val)
    {
    	if($val == null)
    	{
    		return $this->id;
    	}
    	return $val;
    }
}
