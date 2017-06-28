<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function category()
    {
    	return $this->belongsTo('App\Models\Backend\Category');
    }
    
    public function tags()
    {
    	return $this->belongsToMany('App\Models\Backend\Tag');
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }
}