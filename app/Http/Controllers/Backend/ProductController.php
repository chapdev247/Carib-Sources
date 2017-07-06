<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Controller;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use Storage;
use Image;
use Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data["title"] = "Admin: Products";
        $data["products"] = Product::filter_products($request)->paginate(30);
        $data["categories"] = Category::where('status',1)->orderBy('id', 'asc')->get();
        if (!empty($data['categories'])) {
            $data['cat_select'][""] = "select category";
            foreach ($data['categories'] as $cat){
                if ($cat->parent!=0) {
                    $parent = $data['categories']->where('id',$cat->parent)->first()->name;
                    $data['cat_select'][$parent][$cat->id] = $cat->name;
                }
            }
        }
        return view('backend.products.index')->with('data',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data["title"] = "Admin: Product Edit";
        $data["product"] = Product::find($id);
        $data["categories"] = Category::where('status',1)->orderBy('id', 'asc')->get();
        if (!empty($data['categories'])) {
            foreach ($data['categories'] as $cat){
                if ($cat->parent!=0) {
                    $parent = $data['categories']->where('id',$cat->parent)->first()->name;
                    $data['cat_select'][$parent][$cat->id] = $cat->name;
                }
            }
        }
        return view('backend.products.edit')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update_product(Request $request, $id)
    {
        $rules = array(
                'name' => 'required|max:190|unique:products,name,'.$id,
                'category' => 'required',
                'slug' => 'required|unique:products,slug,'.$id.'|alpha_dash',
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

        $product = Product::find($id);
        
        $product->name = $request->name;
        $product->category_id = $request->category;
        $product->slug = slugify($request->slug);
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $product = Product::find($id);

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

        return redirect()->back();
    }

    public function status(Request $request,$id)
    {
        $product = Product::find($id);
        if (!empty($product)) {
            if ($product->status) 
                $product->status = 0;
            else
                $product->status = 1;

            $product->save();

            $request->session()->flash('success_msg' , 'The Product status updated successfully.');
        }
        else{
            $request->session()->flash('success_error' , 'The Product not found.Please try again.');
        }

        return redirect()->route('products.index');
    }
    
    public function delete_image(Request $request,$id,$img_id)
    {
        $product = Product::find($id);
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
}
