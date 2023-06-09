<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use App\Models\Service;
use App\Models\ShopRating;
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
        $latest_rating = ShopRating::latest()->take(2)->with('user')->get();
        $categories = Category::orderBy('type', 'asc')->where('status', 'Aktif')->whereHas('product')->orWhereHas('service')->get();

        $query_products = Product::query();
        $query_services = Service::query();

        $query_products->when($this->byCategories, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        });
        $query_services->when($this->byCategories, function ($query, $categoryId) {
            return $query->where('category_id', $categoryId);
        });

        $products = $query_products->with('product_rating')->get();
        $services = $query_services->with('service_rating')->get();

        // dd($this->byCategories);
        return view('livewire.filter-product-service', compact('products', 'services', 'categories', 'latest_rating'));
    }

    public function filterByCategories($categoryId)
    {
        $this->byCategories = $categoryId;
    }
}
