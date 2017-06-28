<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Backend\Controller;
use App\Models\Backend\Product;
use Storage;
use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getindex()
    {
        $products = Product::orderBy('id','desc')->paginate(30);
        return view('backend.products.index')->withProducts($products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getcreate($type)
    {
        if ($type!=0 && $type!=1) dd("Not My Type");
        return view('backend.products.create')->withType($type);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function poststore(Request $request)
    {
        $this->validate($request, array(
                'name' => 'required|max:190',
                'sku' => 'required|unique:products,sku|alpha_dash|min:5|max:190',
                'qty' => 'required',
                'price' => 'required',
                'featured_image' => 'image|dimensions:min_width=350,min_height=350',
                'description' => 'required',
                'product_info' => 'required',
            ));

        $product = new Product;
        
        $product->name = $request->name;
        if ($request->sku) 
            $product->sku = $request->sku;
        else
            $product->sku = slugify($request->name);
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_info = $request->product_info;

        if (  $request->hasFile('featured_image') ) {

            $image = $request->file('featured_image');
            $filename = time().".".$image->getClientOriginalExtension();
            $img_path = 'uploads/products/'.$filename;
            $thumb_path = 'uploads/products/thumb/'.$filename;

            $img = Image::make($image);
            $img->save( public_path($img_path) );

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save( public_path($thumb_path) );
            
            $product->thumb_image = $thumb_path;
            $product->image = $img_path;
        }
        $product->save();

        $request->session()->flash('success_msg','The product added successfully.');

        return redirect()->route('ProductController.getedit',$product->id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getedit($id)
    {
        $product = Product::find($id);
        return view('backend.products.edit')->withProduct($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function postupdate(Request $request, $id)
    {
        $this->validate($request, array(
                'name' => 'required|max:190',
                'sku' => 'required|unique:products,sku,'.$id.'|alpha_dash|min:5|max:190',
                'qty' => 'required',
                'price' => 'required',
                'featured_image' => 'image|dimensions:min_width=350,min_height=350',
                'description' => 'required',
                'product_info' => 'required',
            ));

        $product = Product::find($id);
        
        $product->name = $request->name;
        if ($request->sku) 
            $product->sku = $request->sku;
        else
            $product->sku = slugify($request->name);
        $product->qty = $request->qty;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->product_info = $request->product_info;

        if (  $request->hasFile('featured_image') ) {

            $old_thumb = $product->thumb_image;
            $old_img = $product->image;
            $image = $request->file('featured_image');
            $filename = time().".".$image->getClientOriginalExtension();
            $img_path = 'uploads/products/'.$filename;
            $thumb_path = 'uploads/products/thumb/'.$filename;

            $img = Image::make($image);
            $img->save( public_path($img_path) );

            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save( public_path($thumb_path) );
                
            Storage::delete( $old_thumb );
            Storage::delete( $old_img );

            $product->thumb_image = $thumb_path;
            $product->image = $img_path;
        }
        $product->save();

        $request->session()->flash('success_msg','The product Updated successfully!');

        return redirect()->route('ProductController.getedit',$product->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getdestroy($id)
    {
        $product = Product::find($id);

        $old_thumb = $product->thumb_image;

        $old_img = $product->image;

        $product->delete();

        Storage::delete( $old_thumb );
        
        Storage::delete( $old_img );

        $request->session()->flash('success_msg' , 'The Product deleted successfully');

        return redirect()->route('ProductController.getindex');
    }
}
