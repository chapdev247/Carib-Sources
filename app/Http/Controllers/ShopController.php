<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backend\Product;
use Session;
class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Product::orderBy('id','desc')->paginate(12);
        return view('frontend.shop.index')->withProducts($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function single($sku)
    {
        $product = Product::where("sku" ,$sku)->first();
        return view('frontend.shop.single')->withProduct($product);
    }
    
}
