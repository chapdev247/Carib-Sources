<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
 	protected $table='categories';   

 	public function products()
 	{
 		return $this->hasMany('App\Models\Backend\Product');
 	}

 	public static function filter_category($request)
	{
		$result = self::where(function ($query) use ($request) {
				$query->where('parent',($request->root==1?"=":"!="),($request->root?0:null))
	            ->where('parent',($request->parent?"=":"!="),$request->parent?$request->parent:null)
	            ->where('status',($request->status!=""?"=":"!="),($request->status!=""?$request->status:null));
            })
			->where(function ($query) use ($request) {
	            $query->where('name','like','%'.$request->search.'%' )
	            ->orwhere('slug','like','%'.$request->search.'%' );
            });
		return $result;
	}
}