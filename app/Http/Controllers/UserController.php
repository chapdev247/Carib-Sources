<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//Custom Models
use App\Models\Category;
use App\Models\Product;

//Core Classes
use Validator;
use Auth;
use Image;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$page="",$action="",$id="")
    {
        $data["title"] = "Carib Sources : Dashboard ".($page?"| $page":"");
        $data["page"] = $page;
        $data["action"] = $action;
        $data["id"] = $id;
        $data["user_id"] = Auth::id();

        if ($page=="products") {
            $data["categories"] = Category::where('status',1)->orderBy('id', 'asc')->get();
            if (!empty($data['categories'])) {
                foreach ($data['categories'] as $cat){
                    if ($cat->parent!=0) {
                        $parent = $data['categories']->where('id',$cat->parent)->first()->name;
                        $data['cat_select'][$parent][$cat->id] = $cat->name;
                    }
                }
            }
            $data["products"] = Product::filter_products($request,$data["user_id"])->paginate(10);
            if ($data["action"]=='edit' && !empty($data['id'])) {
                $data["product"] = Product::find_user_product($id,$data["user_id"]);
                if (empty($data["product"])) {
                    return redirect()->route('dashboard',['products']);
                }
            }
        }
        elseif ($page=="profile") {
            $data["user"] = Auth::user();
        }
        return view('frontend/dashboard/index')->withData($data);
    }
    
    public function addproduct(Request $request)
    {
        $rules = array(
                'name' => 'required|max:150|unique:products',
                'category' => 'required',
                'price' => 'required|numeric|min:1',
                'description' => 'required|max:5000',
            );
        $input = $request->input();

        if (  $request->hasFile('image') ) {
            $files = $request->file('image');
            foreach($files as $index => $file) {
                $i_rules['image###'.($index+1)] = 'mimes:png,gif,jpeg,jpg|dimensions:min_width=440,min_height=480|max:2048';
                $i_input['image###'.($index+1)] = $file;
            }
            $input = array_merge($input,$i_input);
            $rules = array_merge($rules,$i_rules);
        }
        Validator::make($input, $rules)->validate();

        $product = new Product;
        $original_images = $thumb_images = array();
        
        if (  $request->hasFile('image') ) {
            $images = $request->file('image');
            foreach ($images as $key => $image) {
                $filename = substr(md5(rand()),0,9)."_".time().".".$image->getClientOriginalExtension();
                $img_path = 'uploads/products/'.$filename;
                $thumb_path = 'uploads/products/thumb/'.$filename;

                $img = Image::make($image);
                $img->save( public_path($img_path) );

                $img->resize(220,240);
                $img->save( public_path($thumb_path) );
                $thumb_images[$key] = $thumb_path;
                $original_images[$key] = $img_path;
            }
        }
        
        $product->image = json_encode($original_images);
        $product->thumb_image = json_encode($thumb_images);

        $product->name = $request->name;
        $product->slug = slugify($request->name);
        $product->description = $request->description;
        $product->category_id = $request->category;
        $product->user = Auth::id();
        $product->price = $request->price;

        $product->save();

        $request->session()->flash('success_msg','The product added successfully.');

        return response()->json(array('data'=> "Data Submitted successfully."),200);
    }

    public function editproduct(Request $request,$id)
    {
        $rules = array(
                'name' => 'required|max:190|unique:products,name,'.$id,
                'category' => 'required',
                'price' => 'required|numeric|min:1',
                'description' => 'required|max:5000',
            );
        $input = $request->input();

        if (  $request->hasFile('image') ) {
            $files = $request->file('image');
            foreach($files as $index => $file) {
                $i_rules['image###'.($index+1)] = 'mimes:png,gif,jpeg,jpg|dimensions:min_width=440,min_height=480|max:2048';
                $i_input['image###'.($index+1)] = $file;
            }
            $input = array_merge($input,$i_input);
            $rules = array_merge($rules,$i_rules);
        }
        Validator::make($input, $rules)->validate();

        $product = Product::where('user',Auth::id())->where('id',$id)->first();
        if (!empty($product)) {
            $product->name = $request->name;
            $product->category_id = $request->category;
            $product->slug = slugify($request->name);
            $product->price = $request->price;
            $product->description = $request->description;

            if (  $request->hasFile('image') ) {
                $old_thumbs = json_decode($product->thumb_image,TRUE);
                $old_imgs = json_decode($product->image,TRUE);
                $images = $request->file('image');
                foreach ($images as $key => $image) {
                    $filename = substr(md5(rand()),0,9)."_".time().".".$image->getClientOriginalExtension();
                    $img_path = 'uploads/products/'.$filename;
                    $thumb_path = 'uploads/products/thumb/'.$filename;

                    $img = Image::make($image);
                    $img->save( public_path($img_path) );
                    $img->resize(220,240);
                    $img->save( public_path($thumb_path) );
                    $thumb_images[$key] = $thumb_path;
                    $original_images[$key] = $img_path;
                }
                $product->thumb_image = json_encode(array_merge($old_thumbs,$thumb_images));
                $product->image = json_encode(array_merge($old_imgs,$original_images));
            }

            $product->save();

            $request->session()->flash('success_msg','The product updated successfully.');
            return response()->json(array('data'=> "Data Submitted successfully."),200);
        }
        else{
            $request->session()->flash('error_msg','No such product found.Please try again.');
            return response()->json(array('data'=> "Data Submitted successfully."),500);
        }

    }

    public function destroyproduct(Request $request,$id)
    {
        $product = Product::where('user',Auth::id())->where('id',$id)->first();
        if (!empty($product)) {
            $old_thumbs = json_decode($product->thumb_image);

            $old_imgs = json_decode($product->image);

            $product->delete();

            if (!empty($old_thumbs)) {
                foreach ($old_thumbs as $key => $old_thumb) {

                    @unlink( 'public/'.$old_thumb );
                    
                    @unlink( 'public/'.$old_imgs[$key] );
                }
            }
            $request->session()->flash('success_msg' , 'The Product deleted successfully');
        }
        else{
            $request->session()->flash('success_error' , 'The Product not found.Please try again.');
        }

        return redirect()->back();
    }

    public function statusproduct(Request $request,$id)
    {
        $product = Product::where('user',Auth::id())->where('id',$id)->first();
        if (!empty($product)) {

            if ($product->status) 
                $product->status = 0;
            else
                $product->status = 1;

            $product->save();

            $request->session()->flash('success_msg','The product status updated successfully.');
        }
        else{
            $request->session()->flash('error_msg','No such product found.Please try again.');
        }
        return redirect()->back();
    }
    
    public function delete_imageproduct(Request $request,$id,$img_id)
    {
        $product = Product::where('user',Auth::id())->where('id',$id)->first();
        if (!empty($product)) {

            $images = json_decode($product->image,TRUE);
            $thumb_images = json_decode($product->thumb_image,TRUE);
            if (!empty($images) && !empty($images[$img_id])) {

                @unlink( 'public/'.$thumb_images[$img_id] );
                
                @unlink( 'public/'.$images[$img_id] );

                unset($images[$img_id]);
                unset($thumb_images[$img_id]);

                $product->image = json_encode(array_values($images));
                $product->thumb_image = json_encode(array_values($thumb_images));

                $product->save();

                $request->session()->flash('success_msg' , 'The Product image deleted successfully.');
            }
            else{
                $request->session()->flash('success_error' , 'The image not found.Please try again.');
            }
        }
        else{
            $request->session()->flash('success_error' , 'The Product not found.Please try again.');
        }

        return redirect()->back();
    }

    public function profile(request $request)
    {
        $id = Auth::id();

        $this->validate($request, array(
                'f_name' => 'required|max:50',
                'l_name' => 'required|max:50',
                'email' => 'email|max:80|unique:users,email,'.$id.'',
                'mobile' => 'nullable|digits:10',
            ));

        $user = Auth::user();

        $user->f_name = $request->f_name;
        $user->l_name = $request->l_name;
        $user->email = $request->email;
        $user->mobile = $request->mobile;
        
        $user->save();

        $request->session()->flash('success_msg','Profile updated successfully!');

        return redirect()->back();
    }
}