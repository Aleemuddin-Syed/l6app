<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $guarded = [];

    public function children()
    {
    	return $this->hasMany(Category::class,'parent_id','id');
    }

    public function parent()
    {
    	return $this->belongsTo(Category::class,'parent_id','id');
    }

    public function categires()
    {
    	return $this->belongsTo(Category::class);
    }
}
