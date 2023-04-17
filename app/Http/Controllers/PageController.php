<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;

class PageController extends Controller
{
    public function berandaPage()
    {
        $data = [
            'carts' => Cart::orderBy('created_at', 'desc')->get(),
            'categories' => Product::with('category')->select('category_id')->groupBy('category_id')->get(),
            'products' => Product::all(),
            'category_nav' => Category::select('name')->where('status', 'Aktif')->orderBy('name', 'asc')->get(),
        ];

        return view('pages.customer.beranda', $data);
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
