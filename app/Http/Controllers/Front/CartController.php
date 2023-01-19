<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Repositories\Cart\CartModelRepository;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CartRepository $cart)
    {
       
        return view('front.cart', [
            'cart' => $cart,
        ]);
    }

    public function store(Request $request, CartRepository $cart)
    {
        $request ->validate([
            'product_id' => ['required','int', 'exists:products,id'],
            'quantity' => ['nullable','int', 'min:1'],
        ]);
        $product = Product::findorfail($request->post('product_id'));
        $cart->add( $product, ($request->post('quantity')));

        return redirect()->route('cart.index')->with('success', 'Product added to catr');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request ->validate([
            'product_id' => ['required','int', 'exists:products,id'],
            'quantity' => ['nullable','int', 'min:1'],
        ]);
        $product = Product::findorfail($request->post('product_id'));
        $repository = new CartModelRepository();
        $repository->update( $product, ($request->post('quantity')));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CartRepository $cart, $id)
    {
        $cart->delete($id); 
    }
}
