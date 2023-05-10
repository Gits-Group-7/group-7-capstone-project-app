<?php

namespace App\Http\Livewire;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use Livewire\Component;

class FilterProductService extends Component
{
    public $byCategories;

    public function mount()
    {
        $this->byCategories = '';
    }

    public function render()
    {
        // controller variables
        $categories = Category::orderBy('type', 'asc')->where('status', 'Aktif')->get();
        $carts = Cart::orderBy('created_at', 'desc')->get();

        $query_products = Product::query();
        $query_services = Service::query();

        $query_products->when($this->byCategories, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        });
        $query_services->when($this->byCategories, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        });

        $products = $query_products->get();
        $services = $query_services->get();

        // dd($this->byCategories);
        return view('livewire.filter-product-service', compact('products', 'services', 'categories', 'carts'));
    }

    public function filterByCategories($categoryId)
    {
        $this->byCategories = $categoryId;
    }
}
