<?php

namespace Database\Seeders;

use App\Models\ProductRating;
use Illuminate\Database\Seeder;

class ProductRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User Customer Rating Product Kaos
        ProductRating::create([
            'rating' => 5,
            'comment' => 'Produk Keren banget!',
            'product_id' => 1,
            'user_id' => 3,
        ]);
        ProductRating::create([
            'rating' => 5,
            'comment' => 'Produk Keren banget!',
            'product_id' => 2,
            'user_id' => 4,
        ]);
        ProductRating::create([
            'rating' => 5,
            'comment' => 'Produk Keren banget!',
            'product_id' => 3,
            'user_id' => 3,
        ]);
        ProductRating::create([
            'rating' => 5,
            'comment' => 'Produk Keren banget!',
            'product_id' => 4,
            'user_id' => 4,
        ]);

        // User Customer Rating Produk Jacket
        ProductRating::create([
            'rating' => 5,
            'comment' => 'Produk Keren banget!',
            'product_id' => 5,
            'user_id' => 4,
        ]);
        ProductRating::create([
            'rating' => 5,
            'comment' => 'Produk Keren banget!',
            'product_id' => 6,
            'user_id' => 3,
        ]);
        ProductRating::create([
            'rating' => 5,
            'comment' => 'Produk Keren banget!',
            'product_id' => 7,
            'user_id' => 4,
        ]);
        ProductRating::create([
            'rating' => 5,
            'comment' => 'Produk Keren banget!',
            'product_id' => 8,
            'user_id' => 3,
        ]);
    }
}
