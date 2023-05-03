<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function berandaPage()
    {
        $data = [
            'carts' => Cart::orderBy('created_at', 'desc')->get(),
            'categories' => Product::with('category')->select('category_id')->groupBy('category_id')->get(),
            'products' => Product::all(),
            'category_products' => Category::select('name')->where('status', 'Aktif')->where('type', 'product')->orderBy('name', 'asc')->get(),
            'category_services' => Category::select('name')->where('status', 'Aktif')->where('type', 'service')->orderBy('name', 'asc')->get(),
        ];

        return view('pages.customer.beranda', $data);
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
    // public function buttonPage()
    // {
    //     return view('template.button');
    // }

    // public function formPage()
    // {
    //     return view('template.form');
    // }

    // public function chartPage()
    // {
    //     return view('template.chart');
    // }
}
