<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function posts()
    {
    	return $this->belongsToMany('App\Models\Backend\Post');
    }
}
