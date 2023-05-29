<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartProduct;
use App\Models\Category;
use App\Models\OrderDetail;
use App\Models\OrderService;
use App\Models\Product;
use App\Models\ProductRating;
use App\Models\PromoBanner;
use App\Models\Service;
use App\Models\ServiceRating;
use App\Models\ShopRating;
use App\Models\TrackingLog;
use App\Models\TransactionDetail;
use App\Models\TransactionOrder;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    // fungsi beranda
    public function berandaPage()
    {
        $data = [
            // customer contain product & service on cart and order
            'list_product_carts' => CartProduct::orderBy('created_at', 'desc')->get(),
            'list_service_orders' => OrderService::orderBy('created_at', 'desc')->get(),

            // product & service rating
            'products' => Product::with('product_rating')->get(),
            'services' => Service::with('service_rating')->get(),

            // navbar requirement (search)
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),

            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),

            // variables ext
            'promo_banners' => PromoBanner::where('status', 'Aktif')->get(),
            'categories_products' => Product::with('category')->select('category_id')->groupBy('category_id')->get(),
            'categories_services' => Service::with('category')->select('category_id')->groupBy('category_id')->get(),

            'carts' => Cart::orderBy('created_at', 'desc')->get(),
        ];

        return view('pages.customer.beranda', $data);
    }

    // fungsi menu customer
    public function listTransaction($id)
    {
        $customerId = auth()->user()->id;

        $data = [
            'customer' => User::findOrFail($id),
            'customer_transactions' => TransactionOrder::where('type_transaction_order', 'product')->where('user_id', $customerId)->where('prof_order_payment', '!=', 'empty')->where('order_confirmed', 'Yes')->orderBy('created_at', 'desc')->with('user')->get(),
            'transaction_products' => TransactionDetail::whereHas('transaction_orders', function ($query) use ($customerId) {
                $query->where('user_id', $customerId);
            })->with('product')->get(),
        ];

        return view('pages.user.riwayat-pesanan.daftar-transaksi', $data);
    }

    public function listOrder($id)
    {
        $customerId = auth()->user()->id;

        $data = [
            'customer' => User::findOrFail($id),
            'customer_orders' => TransactionOrder::where('type_transaction_order', 'service')->where('user_id', $customerId)->where('prof_order_payment', '!=', 'empty')->where('order_confirmed', 'Yes')->orderBy('created_at', 'desc')->with('user')->get(),
            'order_services' => OrderDetail::whereHas('transaction_orders', function ($query) use ($customerId) {
                $query->where('user_id', $customerId);
            })->with('service')->get(),
        ];

        return view('pages.user.riwayat-pesanan.daftar-order', $data);
    }

    public function transactionProduct($id)
    {
        $customerId = auth()->user()->id;

        $data = [
            'customer' => User::findOrFail($id),
            'customer_transactions' => TransactionOrder::where('type_transaction_order', 'product')->where('user_id', $customerId)->where('prof_order_payment', '!=', 'empty')->where('order_confirmed', 'Yes')->orderBy('created_at', 'desc')->with('user')->get(),
            'tracking_transaction_log' => TrackingLog::with('transaction_order')->whereHas('transaction_order', function ($query) use ($customerId) {
                $query->where('type_transaction_order', 'product')
                    ->where('user_id', $customerId);
            })->get(),
        ];

        return view('pages.user.tracking-pesanan.transaksi-produk', $data);
    }

    public function orderService($id)
    {
        $customerId = auth()->user()->id;

        $data = [
            'customer' => User::findOrFail($id),
            'customer_orders' => TransactionOrder::where('type_transaction_order', 'service')->where('user_id', $customerId)->where('prof_order_payment', '!=', 'empty')->where('order_confirmed', 'Yes')->orderBy('created_at', 'desc')->with('user')->get(),
            'tracking_order_log' => TrackingLog::with('transaction_order')->whereHas('transaction_order', function ($query) use ($customerId) {
                $query->where('type_transaction_order', 'service')
                    ->where('user_id', $customerId);
            })->get(),
        ];

        return view('pages.user.tracking-pesanan.order-jasa', $data);
    }

    public function storePage()
    {
        $averageRating = ShopRating::avg('rating');

        $data = [
            'rating_store_count' => ShopRating::count(),
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'averageRating' => round($averageRating * 2) / 2,
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
        ];

        return view('pages.customer.toko-print-shop', $data);
    }

    public function detailProduct($id)
    {
        $averageRating = ProductRating::where('product_id', $id)->avg('rating');

        $data = [
            // contain product
            'list_product_carts' => CartProduct::orderBy('created_at', 'desc')->get(),

            'rating_product_count' => ProductRating::where('product_id', $id)->count(),
            'averageRating' => round($averageRating * 2) / 2,
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'latest_products' => Product::latest()->take(4)->get(),
            'ratings' => ProductRating::where('product_id', $id)->latest()->take(2)->get(),
            'carts' => Cart::orderBy('created_at', 'desc')->get(),
            'product' => Product::findOrFail($id),
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
        ];

        // dd($averageRating);
        return view('pages.customer.katalog.detail-produk', $data);
    }

    public function detailService($id)
    {
        $averageRating = ServiceRating::where('service_id', $id)->avg('rating');

        $data = [
            // contain and service
            'list_service_orders' => OrderService::orderBy('created_at', 'desc')->get(),

            'rating_service_count' => ServiceRating::where('service_id', $id)->count(),
            'averageRating' => round($averageRating * 2) / 2,
            'autocomplete_product_and_service' => Product::select('name')->union(Service::select('name'))->get(),
            'latest_services' => Service::latest()->take(4)->get(),
            'ratings' => ServiceRating::where('service_id', $id)->latest()->take(2)->get(),
            'carts' => Cart::orderBy('created_at', 'desc')->get(),
            'service' => Service::findOrFail($id),
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
        ];

        return view('pages.customer.katalog.detail-jasa', $data);
    }

    // fungsi menu admin
    public function manage_transaction()
    {
        $data = [
            'list_transactions' => TransactionOrder::where('type_transaction_order', 'product')->where('prof_order_payment', '!=', 'empty')->orderBy('created_at', 'desc')->with('user')->get(),
            'tracking_transaction_log' => TrackingLog::whereIn('id', function ($query) {
                $query->selectRaw('MAX(id)')->from('tracking_logs')->whereIn('transaction_order_id', function ($subquery) {
                    $subquery->select('id')->from('transaction_orders')->where('type_transaction_order', 'product');
                })->groupBy('transaction_order_id');
            })->get(),
        ];

        return view('pages.admin.transaksi-order.manage-transaction', $data);
    }

    public function manage_order()
    {
        $data = [
            'list_orders' => TransactionOrder::where('type_transaction_order', 'service')->where('prof_order_payment', '!=', 'empty')->orderBy('created_at', 'desc')->get(),
        ];

        return view('pages.admin.transaksi-order.manage-order', $data);
    }

    public function customer()
    {
        $data = [
            'customers' => User::where('role', 'customer')->orderBy('created_at', 'desc')->get(),
        ];

        return view('pages.admin.layanan-customer.cutomer', $data);
    }

    public function transactionOrder()
    {
        $data = [
            'transaction_orders' => TransactionOrder::whereHas('user', function ($query) {
                $query->where('role', 'customer');
            })->orderBy('created_at', 'desc')->with('user')->get(),
            'transaction_products' => TransactionDetail::whereHas('transaction_orders')->with('product')->get(),
            'order_services' => OrderDetail::whereHas('transaction_orders')->with('service')->get(),
        ];

        return view('pages.admin.layanan-customer.transaction-order', $data);
    }

    public function transactionDetails()
    {
        $data = [
            'list_detail_transactions' => TransactionDetail::with('transaction_orders.user', 'product')->get(),
        ];

        return view('pages.admin.layanan-customer.transaction-details', $data);
    }

    public function orderDetails()
    {
        $data = [
            'list_detail_orders' => OrderDetail::with('transaction_orders.user', 'service')->get(),
        ];

        return view('pages.admin.layanan-customer.order-details', $data);
    }

    // fungsi auth logout
    public function logout(Request $request)
    {
        // fungsi logout
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.beranda');
    }
}
