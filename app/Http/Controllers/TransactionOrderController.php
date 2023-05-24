<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\OrderService;
use App\Models\Product;
use App\Models\Service;
use App\Models\TransactionOrder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TransactionOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // transaction customer
        $customerId = auth()->user()->id;
        $transaction_product_customers = TransactionOrder::where('user_id', $customerId)->where('type_transaction_order', 'product')->where('order_confirmed', 'No')->orderBy('order_date', 'desc')->get();
        $order_service_customers = TransactionOrder::where('user_id', $customerId)->where('type_transaction_order', 'service')->where('order_confirmed', 'No')->orderBy('order_date', 'desc')->get();

        $data = [
            // navbar
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_name' => Product::all(),
        ];

        return view('pages.customer.transaksi-order.daftar-transaksi-order', $data, compact('transaction_product_customers', 'order_service_customers'));
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

    public function transaction_store_product($user_id)
    {
        // mengambil data user customer
        $user = User::find($user_id);

        // validasi field satu persatu sebelum melakukan insert
        TransactionOrder::create([
            'order_address' => '',
            'order_confirmed' => 'No',
            'type_transaction_order' => 'product',
            'status_delivery' => 'Start Order',
            'user_id' => $user->id,
        ]);

        return redirect()->route('transaction.order.customer.list');
    }

    public function order_store_service($user_id)
    {
        // mengambil data user customer
        $user = User::find($user_id);

        // validasi field satu persatu sebelum melakukan insert
        TransactionOrder::create([
            'order_address' => '',
            'order_confirmed' => 'No',
            'type_transaction_order' => 'service',
            'status_delivery' => 'Start Order',
            'user_id' => $user->id,
        ]);

        return redirect()->route('transaction.order.customer.list');
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

    public function show_transaction_product($transaction_id)
    {
        $customerId = auth()->user()->id;
        $cart_products = DB::table('cart_products')->join('products', 'cart_products.product_id', '=', 'products.id')->select('products.*', 'cart_products.*')->where('cart_products.user_id', $customerId)->where('is_checkout', true)->orderBy('cart_products.product_id', 'desc')->get();
        $total_price_cart = CartProduct::where('user_id', $customerId)->where('is_checkout', true)->sum('total_price');

        $data = [
            // navbar
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_name' => Product::all(),

            // data transaction product
            'transaction_product' =>  TransactionOrder::findOrFail($transaction_id),
        ];

        return view('pages.customer.transaksi-order.checkout-transaksi-produk', $data, compact('cart_products', 'total_price_cart'));
    }

    public function show_order_service($order_id)
    {
        $customerId = auth()->user()->id;
        $order_services = DB::table('order_services')->join('services', 'order_services.service_id', '=', 'services.id')->select('services.*', 'order_services.*')->where('order_services.user_id', $customerId)->where('is_checkout', true)->orderBy('order_services.service_id', 'desc')->get();
        $total_price_order = OrderService::where('user_id', $customerId)->where('is_checkout', true)->sum('total_price');

        $data = [
            // navbar
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_name' => Product::all(),

            // data transaction product
            'transaction_order' =>  TransactionOrder::findOrFail($order_id),
        ];

        return view('pages.customer.transaksi-order.checkout-order-jasa', $data, compact('order_services', 'total_price_order'));
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

    public function update_transaction_product(Request $request, $transaction_id)
    {
        // validasi field
        $validated = $request->validate([
            'order_address' => 'required',
            'order_note' => 'nullable',
        ]);

        // validasi field satu persatu sebelum melakukan update
        TransactionOrder::where('id', $transaction_id)->update([
            'order_address' => $validated['order_address'],
            'order_note' => $validated['order_note'],
            'status_delivery' => 'Order Checkouted',
        ]);

        return redirect()->route('transaction.order.customer.list');
    }

    public function update_order_jasa(Request $request, $order_id)
    {
        // validasi field
        $validated = $request->validate([
            'order_address' => 'required',
            'order_note' => 'nullable',
        ]);

        // validasi field satu persatu sebelum melakukan update
        TransactionOrder::where('id', $order_id)->update([
            'order_address' => $validated['order_address'],
            'order_note' => $validated['order_note'],
            'status_delivery' => 'Order Checkouted',
        ]);

        return redirect()->route('transaction.order.customer.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($transaction_order_id)
    {
        $data = TransactionOrder::findOrFail($transaction_order_id);
        $data->delete();

        return redirect()->route('transaction.order.customer.list');
    }
}
