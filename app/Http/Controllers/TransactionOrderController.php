<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\OrderService;
use App\Models\Product;
use App\Models\Service;
use App\Models\TrackingLog;
use App\Models\TransactionDetail;
use App\Models\TransactionOrder;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $total_price_order = OrderService::where('user_id', $customerId)->where('is_checkout', true)->sum('total_price');

        $totalQuantityCart = CartProduct::where('user_id', $customerId)->sum('quantity');
        $totalQuantityOrder = OrderService::where('user_id', $customerId)->sum('quantity');

        // Menghitung delivery_price berdasarkan total kuantity
        $deliveryPriceCart = ($totalQuantityCart * 2000) + 5000;
        $deliveryPriceOrder = ($totalQuantityOrder * 2000) + 5000;
        $servicePrice = 15000;

        $data = [
            // navbar
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_name' => Product::all(),
        ];

        return view('pages.customer.transaksi-order.daftar-transaksi-order', $data, compact('transaction_product_customers', 'order_service_customers', 'deliveryPriceCart', 'deliveryPriceOrder', 'total_price_cart', 'total_price_order', 'servicePrice'));
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
            'note' => 'Berhasil Melakukan Order',
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
        $deliveryPrice = ($totalQuantity * 2000) + 5000;
        $servicePrice = 15000;

        // mengecek apakah data transaction product sudah di checkout atau belum
        $transactionOrder = TransactionOrder::findOrFail($order_id);

        $data = [
            // navbar
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'category_name' => Product::all(),

            // data transaction product
            'transaction_order' =>  TransactionOrder::findOrFail($order_id),
        ];

        if ($transactionOrder->status_delivery === 'Start Order') {
            // Izinkan akses ke halaman show
            return view('pages.customer.transaksi-order.checkout-order-jasa', $data, compact('order_services', 'total_price_order', 'deliveryPrice', 'servicePrice'));
        } else {
            // Redirect ke error 404
            abort(404);
        }
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
        // variabel price transaction product
        $customerId = auth()->user()->id;
        $total_price_order = OrderService::where('user_id', $customerId)->where('is_checkout', true)->sum('total_price');
        $totalQuantityOrder = OrderService::where('user_id', $customerId)->sum('quantity');
        $deliveryPriceOrder = ($totalQuantityOrder * 2000) + 5000;
        $servicePrice = 15000;

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
            'delivery_price' => $deliveryPriceOrder,
            'total_price_transaction_order' => $total_price_order + $deliveryPriceOrder + $servicePrice,
        ]);

        // Mendapatkan ID transaksi yang baru saja dibuat
        $transactionOrderId = $order_id;

        // Menambahkan informasi data cart product ke transaction details
        $OrderServices = OrderService::where('user_id', auth()->user()->id)->where('is_checkout', true)->get();

        foreach ($OrderServices as $orderService) {
            $transactionDetail = new OrderDetail();
            $transactionDetail->quantity = $orderService->quantity;
            $transactionDetail->total_price = $orderService->total_price;
            $transactionDetail->material = $orderService->material;
            $transactionDetail->deadline = $orderService->deadline;
            $transactionDetail->service_id = $orderService->service_id;
            $transactionDetail->transaction_order_id = $transactionOrderId;
            $transactionDetail->save();

            // Menghapus data cart product setelah berhasil ditambahkan ke transaction details
            $orderService->delete();
        }

        // Membuat entri baru pada tabel TrackingLog
        TrackingLog::create([
            'note' => 'Berhasil Checkout',
            'status' => 'Order Checkouted',
            'transaction_order_id' => $transactionOrderId,
        ]);

        return redirect()->route('transaction.order.customer.list');
    }

    public function upload_transaction_order_payment(Request $request, $transaction_order_id)
    {
        // get data photo transaction order
        $data = TransactionOrder::findOrFail($transaction_order_id);

        // fungsi validasi update product
        $request->validate([
            'prof_order_payment' => 'required|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        // mengecek apakah field untuk upload photo sudah upload atau belum
        if ($request->file('prof_order_payment')) {
            // hapus data photo sebelumnya terlbih dahulu
            Storage::delete($data->prof_order_payment);

            // simpan photo yang baru
            $saveData['prof_order_payment'] = Storage::putFile('public/prof-order-payment', $request->file('prof_order_payment'));
        } else {
            $saveData['prof_order_payment'] = $data->prof_order_payment;
        }

        // validasi field satu persatu sebelum melakukan update
        TransactionOrder::where('id', $transaction_order_id)->update([
            'prof_order_payment' => $saveData['prof_order_payment'],
            'status_delivery' => 'Payment Success',
        ]);

        if ($data->type_transaction_order == 'product') {
            // Mendapatkan data Transaction Detail
            $transactionDetails = TransactionDetail::where('transaction_order_id', $transaction_order_id)->get();

            // Update stok produk berdasarkan data Transaction Detail
            foreach ($transactionDetails as $transactionDetail) {
                $product = Product::find($transactionDetail->product_id);
                $product->stock -= $transactionDetail->quantity;
                $product->save();
            }
        }

        // Membuat entri baru pada tabel TrackingLog
        TrackingLog::create([
            'note' => 'Berhasil Upload Pembayaran',
            'status' => 'Success Upload Payment',
            'transaction_order_id' => $transaction_order_id,
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

        if ($data->prof_order_payment != 'empty') {
            Storage::delete($data->prof_order_payment);
        }

        $data->delete();

        return redirect()->route('transaction.order.customer.list');
    }
}
