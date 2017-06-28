<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Backend\Product;
use Hassansin\DBCart\Models\Cart;
class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $cart = "";

    public function __construct()
    {
    }

    public function getindex(Request $request)
    {
        $products = '';
        $this->cart = Cart::current('default');
        //$products = Product::whereIn('id', [1, 2, 3])->get();
        return view('frontend.cart.index')->withCart($this->cart)->withProducts($products);
    }

    public function postaddtocart(Request $request)
    {
        if (empty($request->id)) dd("Error");

        $product = Product::find($request->id);
        $item = $this->cart->add([
            'id' => $product->id,
            'name' => $product->name,
            'qty' => 1,
            'price' => $product->price
        ]); 

        $this->cart->setTax($item->rowId, 1);
        /*$discount = new Discount(5);
        $item->setDiscount($discount);*/
        //$this->cart->store($item->rowId);

        $request->session()->flash('success_msg','The product added to cart successfully.');
        return redirect()->route("CartController.getindex");
    }

    public function postupdatecart(Request $request)
    {
        if (empty($request->product)) dd("Error");
        foreach ($request->product as $rowId => $qty) {
            if ($qty<1) {
                $this->cart->remove($rowId); 
            }
            else{
                $this->cart->update($rowId, [
                    'qty' => $qty
                ]); 
            }
        }
        $request->session()->flash('success_msg','Cart Updated successfully.');
        return redirect()->route("CartController.getindex");
    }

    public function getemptycart(Request $request)
    {
        $this->cart->destroy();
        $request->session()->flash('success_msg','Cart updated successfully.');
        return redirect()->route("CartController.getindex");
    }

    public function getremovecart($rowId,Request $request)
    {
        if ( empty($rowId) || empty($this->cart->content()->has($rowId)) ) dd("Error");
        $this->cart->remove($rowId);
        $request->session()->flash('success_msg','Product removed successfully.');
        return redirect()->route("CartController.getindex");
    }
    
}
