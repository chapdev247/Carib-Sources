<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
    	return $this->belongsTo('App\Models\Backend\Category');
    }

    public static function filter_products($request)
    {
    	$result = self::where(function ($query) use ($request) {
				$query
				->where('category_id',($request->category_id!=""?"=":"!="),($request->category_id!=""?$request->category_id:null))
				->where('featured',($request->featured!=""?"=":"!="),($request->featured!=""?$request->featured:null))
				->where('status',($request->status!=""?"=":"!="),($request->status!=""?$request->status:null));
            })
			->where(function ($query) use ($request) {
	            $query->where('name','like','%'.$request->search.'%' )
	            ->orwhere('slug','like','%'.$request->search.'%' );
            })->orderby('id',$request->sort=='ASC'?'asc':'desc');
		return $result;
    }
}
