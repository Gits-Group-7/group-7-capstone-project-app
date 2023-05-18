<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Category;
use App\Models\OrderService;
use App\Models\Product;
use App\Models\Service;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CartOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            // navbar
            'category_nav' => Category::select('name')->where('status', 'Aktif')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),

            // product & services, contain
            'cart_products' => DB::table('cart_products')->join('products', 'cart_products.product_id', '=', 'products.id')->select('products.*', 'cart_products.*')->orderBy('cart_products.product_id', 'desc')->get(),
            'carts' => CartProduct::orderBy('created_at', 'desc')->get(),
            'order_services' => DB::table('order_services')->join('services', 'order_services.service_id', '=', 'services.id')->select('services.*', 'order_services.*')->orderBy('order_services.service_id', 'desc')->get(),
            'orders' => OrderService::orderBy('created_at', 'desc')->get(),

            'category_product_name' => Product::all(),
            'category_service_name' => Service::all(),

            'products' => Product::where('status', '!=', 'Habis')->get(),
            'total_price_cart' => DB::table('carts')->sum('total_price'),
            'transaction' => Transaction::all(),
            'last_transaction' => Transaction::latest()->first(),
        ];

        // dd($data['cart_products']);

        return view('pages.customer.cart-and-order', $data);
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
    public function store(Request $request)
    {
        //
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
