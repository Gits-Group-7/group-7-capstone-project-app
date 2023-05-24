<?php

namespace App\Http\Controllers;

use App\Models\CartProduct;
use App\Models\Category;
use App\Models\OrderService;
use App\Models\Product;
use App\Models\Service;
use App\Models\Transaction;
use App\Models\TransactionOrder;
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
        // cart and order total price
        $customerId = auth()->user()->id;
        $total_price_cart = CartProduct::where('user_id', $customerId)->where('is_checkout', true)->sum('total_price');
        $total_price_order = OrderService::where('user_id', $customerId)->where('is_checkout', true)->sum('total_price');
        $cart_products = DB::table('cart_products')->join('products', 'cart_products.product_id', '=', 'products.id')->select('products.*', 'cart_products.*')->where('cart_products.user_id', $customerId)->orderBy('cart_products.product_id', 'desc')->get();
        $order_services = DB::table('order_services')->join('services', 'order_services.service_id', '=', 'services.id')->select('services.*', 'order_services.*')->where('order_services.user_id', $customerId)->orderBy('order_services.service_id', 'desc')->get();

        // transaction & order
        $last_transaction_product = TransactionOrder::where('user_id', $customerId)->where('type_transaction_order', 'product')->where('order_confirmed', 'No')->latest('created_at')->first();
        $last_order_service = TransactionOrder::where('user_id', $customerId)->where('type_transaction_order', 'service')->where('order_confirmed', 'No')->latest('created_at')->first();

        $cart_products_check = DB::table('cart_products')
            ->join('products', 'cart_products.product_id', '=', 'products.id')
            ->select('products.*', 'cart_products.*')
            ->where('cart_products.user_id', $customerId)
            ->where('cart_products.is_checkout', true)
            ->orderBy('cart_products.product_id', 'desc')
            ->get();

        $order_services_check = DB::table('order_services')
            ->join('services', 'order_services.service_id', '=', 'services.id')
            ->select('services.*', 'order_services.*')
            ->where('order_services.user_id', $customerId)
            ->where('order_services.is_checkout', true)
            ->orderBy('order_services.service_id', 'desc')
            ->get();

        // rekommended product and service
        $randomProducts = Product::inRandomOrder()->with('category')->limit(5)->get();
        $randomServices = Service::inRandomOrder()->with('category')->limit(5)->get();
        $recommend_items = $randomProducts->concat($randomServices);

        $data = [
            // navbar
            'category_nav' => Category::select('name')->where('status', 'Aktif')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),

            // contain product & service
            'list_product_carts' => CartProduct::orderBy('created_at', 'desc')->get(),
            'list_service_orders' => OrderService::orderBy('created_at', 'desc')->get(),

            // transaksi
            'transaction' => Transaction::all(),
            'last_transaction' => Transaction::latest()->first(),

            'category_product_name' => Product::all(),
            'category_service_name' => Service::all(),

            // product & services, contain
            // 'carts' => CartProduct::orderBy('created_at', 'desc')->get(),
            // 'orders' => OrderService::orderBy('created_at', 'desc')->get(),
            // 'products' => Product::where('status', '!=', 'Habis')->get(),
        ];

        return view('pages.customer.cart-and-order', $data, compact(
            'total_price_cart',
            'total_price_order',
            'cart_products',
            'order_services',
            'recommend_items',
            'cart_products_check',
            'order_services_check',
            'last_transaction_product',
            'last_order_service'
        ));
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
