<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\OrderService;
use App\Models\Product;
use App\Models\Service;
use App\Models\TrackingLog;
use App\Models\TransactionDetail;
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

        // price transaction order
        $total_price_cart = CartProduct::where('user_id', $customerId)->where('is_checkout', true)->sum('total_price');

        $totalQuantityCart = CartProduct::where('user_id', $customerId)->sum('quantity');
        $totalQuantityOrder = OrderService::where('user_id', $customerId)->sum('quantity');

        // Menghitung delivery_price berdasarkan total kuantity
        $deliveryPriceCart = ($totalQuantityCart * 2000) + 5000;
        $deliveryPriceOrder = ($totalQuantityOrder * 2000) + 10000;

        $data = [
            // navbar
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_name' => Product::all(),
        ];

        return view('pages.customer.transaksi-order.daftar-transaksi-order', $data, compact('transaction_product_customers', 'order_service_customers', 'deliveryPriceCart', 'deliveryPriceOrder', 'total_price_cart'));
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
        // Mengambil data user customer
        $user = User::find($user_id);

        // Membuat transaksi baru dan mendapatkan ID transaksi
        $transactionOrder = TransactionOrder::create([
            'order_address' => '',
            'order_confirmed' => 'No',
            'type_transaction_order' => 'product',
            'status_delivery' => 'Start Order',
            'user_id' => $user->id,
        ]);

        // Mendapatkan ID transaksi yang baru saja dibuat
        $transactionOrderId = $transactionOrder->id;

        // Membuat entri baru pada tabel TrackingLog
        TrackingLog::create([
            'note' => 'Berhasil Melakukan Transaksi',
            'status' => 'Start Order',
            'transaction_order_id' => $transactionOrderId,
        ]);

        return redirect()->route('transaction.order.customer.list');
    }

    public function order_store_service($user_id)
    {
        // Mengambil data user customer
        $user = User::find($user_id);

        // Membuat transaksi baru dan mendapatkan ID transaksi
        $transactionOrder = TransactionOrder::create([
            'order_address' => '',
            'order_confirmed' => 'No',
            'type_transaction_order' => 'service',
            'status_delivery' => 'Start Order',
            'user_id' => $user->id,
        ]);

        // Mendapatkan ID transaksi yang baru saja dibuat
        $transactionOrderId = $transactionOrder->id;

        // Membuat entri baru pada tabel TrackingLog
        TrackingLog::create([
            'note' => 'Berhasil Melakukan Transaksi',
            'status' => 'Start Order',
            'transaction_order_id' => $transactionOrderId,
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

        // Menghitung total kuantity dari CartProduct
        $totalQuantity = CartProduct::where('user_id', $customerId)->sum('quantity');

        // Menghitung delivery_price berdasarkan total kuantity
        $deliveryPrice = ($totalQuantity * 2000) + 5000;

        // mengecek apakah data transaction product sudah di checkout atau belum
        $transactionOrder = TransactionOrder::findOrFail($transaction_id);

        $data = [
            // navbar
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_name' => Product::all(),

            // data transaction product
            'transaction_product' =>  TransactionOrder::findOrFail($transaction_id),
        ];

        if ($transactionOrder->status_delivery === 'Start Order') {
            // Izinkan akses ke halaman show
            return view('pages.customer.transaksi-order.checkout-transaksi-produk', $data, compact('cart_products', 'total_price_cart', 'deliveryPrice'));
        } else {
            // Redirect ke error 404
            abort(404);
        }
    }

    public function show_order_service($order_id)
    {
        $customerId = auth()->user()->id;
        $order_services = DB::table('order_services')->join('services', 'order_services.service_id', '=', 'services.id')->select('services.*', 'order_services.*')->where('order_services.user_id', $customerId)->where('is_checkout', true)->orderBy('order_services.service_id', 'desc')->get();
        $total_price_order = OrderService::where('user_id', $customerId)->where('is_checkout', true)->sum('total_price');

        // Menghitung total kuantity dari CartProduct
        $totalQuantity = OrderService::where('user_id', $customerId)->sum('quantity');

        // Menghitung delivery_price berdasarkan total kuantity
        $deliveryPrice = ($totalQuantity * 2000) + 10000;

        $data = [
            // navbar
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_name' => Product::all(),

            // data transaction product
            'transaction_order' =>  TransactionOrder::findOrFail($order_id),
        ];

        return view('pages.customer.transaksi-order.checkout-order-jasa', $data, compact('order_services', 'total_price_order', 'deliveryPrice'));
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

    // fungsi checkout transaction procuct
    public function update_transaction_product(Request $request, $transaction_id)
    {
        // variabel price transaction product
        $customerId = auth()->user()->id;
        $total_price_cart = CartProduct::where('user_id', $customerId)->where('is_checkout', true)->sum('total_price');
        $totalQuantityCart = CartProduct::where('user_id', $customerId)->sum('quantity');
        $deliveryPriceCart = ($totalQuantityCart * 2000) + 5000;

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
            'delivery_price' => $deliveryPriceCart,
            'total_price_transaction_order' => $total_price_cart + $deliveryPriceCart,
        ]);

        // Mendapatkan ID transaksi yang baru saja dibuat
        $transactionOrderId = $transaction_id;

        // Menambahkan informasi data cart product ke transaction details
        $cartProducts = CartProduct::where('user_id', auth()->user()->id)->where('is_checkout', true)->get();

        foreach ($cartProducts as $cartProduct) {
            $transactionDetail = new TransactionDetail();
            $transactionDetail->quantity = $cartProduct->quantity;
            $transactionDetail->total_price = $cartProduct->total_price;
            $transactionDetail->product_id = $cartProduct->product_id;
            $transactionDetail->transaction_order_id = $transactionOrderId;
            $transactionDetail->save();

            // Menghapus data cart product setelah berhasil ditambahkan ke transaction details
            $cartProduct->delete();
        }

        // Membuat entri baru pada tabel TrackingLog
        TrackingLog::create([
            'note' => 'Berhasil Checkout',
            'status' => 'Order Checkouted',
            'transaction_order_id' => $transactionOrderId,
        ]);

        return redirect()->route('transaction.order.customer.list');
    }

    // fungsi checkout order service
    public function update_order_service(Request $request, $order_id)
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
