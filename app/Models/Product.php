<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category()
    {
    	return $this->belongsTo('App\Models\Category');
    }

    public static function filter_products($request,$user)
    {
    	$result = self::where('user',$user)
            ->where(function ($query) use ($request) {
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

    public static function featured_products()
    {
        $result = self::where('status',1)->where('featured',1)->latest()->get();
        return $result->where('category.status',1);
    }

    public static function latest_products()
    {
        $result = self::where('status',1)->where('featured',0)->latest()->get();
        return $result->where('category.status',1);
    }

    public static function find_user_product($id,$user)
    {
        $result = self::where('id',$id)->where('user',$user)->first();
        if ($result && $result->category && $result->category->status==0)
            $result->category = null;
        return $result;
    }
}
