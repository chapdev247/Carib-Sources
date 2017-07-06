<?php

namespace App\Models\Backend;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
	protected $table ="users";

	public static function filter_users($request)
	{
		$result = self::where(function ($query) use ($request) {
				$query->where('role',($request->role?'=':'>'),($request->role?$request->role:0))
	            ->where('status',($request->status!=''?'=':'!='),($request->status!=''?$request->status:null));
            })
			->where(function ($query) use ($request) {
	            $query->where('f_name',($request->search?'like':'!='),($request->search?"%{$request->search}%":null))
	            ->orwhere('l_name',($request->search?'like':'!='),($request->search?"%{$request->search}%":null))
	            ->orwhere('email',($request->search?'like':'!='),($request->search?"%{$request->search}%":null));
            });
		return $result;
	}

}