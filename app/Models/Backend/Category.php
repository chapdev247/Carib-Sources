<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
 	protected $table='categories';   

 	public function posts()
 	{
 		return $this->hasMany('App\Models\Backend\Post');
 	}
}