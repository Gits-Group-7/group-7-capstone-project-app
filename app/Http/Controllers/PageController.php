<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function berandaPage()
    {
        $data = [
            'carts' => Cart::orderBy('created_at', 'desc')->get(),
            'categories_products' => Product::with('category')->select('category_id')->groupBy('category_id')->get(),
            'categories_services' => Service::with('category')->select('category_id')->groupBy('category_id')->get(),
            'products' => Product::all(),
            'services' => Service::all(),
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
        ];

        return view('pages.customer.beranda', $data);
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
        return view('pages.admin.layanan-customer.transaction-order');
    }

    public function transactionDetails()
    {
        return view('pages.admin.layanan-customer.transaction-details');
    }

    public function orderDetails()
    {
        return view('pages.admin.layanan-customer.order-details');
    }

    public function logout(Request $request)
    {
        // fungsi logout
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('customer.beranda');
    }

    // template function route (tidak dipakai)
    public function buttonPage()
    {
        return view('template.button');
    }

    public function formPage()
    {
        return view('template.form');
    }

    public function chartPage()
    {
        return view('template.chart');
    }
}
