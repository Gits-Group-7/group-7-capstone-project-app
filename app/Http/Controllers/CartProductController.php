<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class CartProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_home($user_id, $product_id)
    {
        //  mengambil data product dan user customer
        $product = Product::find($product_id);
        $user = User::find($user_id);

        // validasi field satu persatu sebelum melakukan insert
        CartProduct::create([
            'quantity' => 1,
            'total_price' => $product->price,
            'product_id' => $product->id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('cart.index');
    }

    public function store_detail(Request $request, $user_id, $product_id)
    {
        // validasi field
        $validated = $request->validate([
            'quantity' => 'required|numeric',
        ]);

        // mengambil data product dan user customer
        $product = Product::find($product_id);
        $user = User::find($user_id);

        // validasi stok produk
        if ($product->stock < $validated['quantity']) {
            return redirect()->back()->with('error', 'Maaf stok produk tidak mencukupi');
        }

        // validasi field satu persatu sebelum melakukan insert
        CartProduct::create([
            'quantity' => $validated['quantity'],
            'total_price' => $validated['quantity'] * $product->price,
            'product_id' => $product->id,
            'user_id' => $user->id,
        ]);

        return redirect()->route('cart.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        // mengambil data price product
        $cart = CartProduct::find($product_id);
        $searchProduct = $cart->product_id;
        $price = Product::where('id', $searchProduct)->value('price');

        // mengambil data field quantity
        $quantity = $request->input('quantity');
        $fix_quantity = intval($quantity);

        // validasi field
        $validated = $request->validate([
            'is_checkout_product' => 'required',
            'quantity' => 'required|numeric',
        ]);

        // validasi field satu persatu sebelum melakukan update
        CartProduct::where('id', $product_id)->update([
            'is_checkout' => $validated['is_checkout_product'],
            'quantity' => $validated['quantity'],
            'total_price' => $price * $fix_quantity,
        ]);

        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $data = CartProduct::findOrFail($product_id);
        $data->delete();

        return redirect()->route('cart.index');
    }
}
