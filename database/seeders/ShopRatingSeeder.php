<?php

namespace Database\Seeders;

use App\Models\ShopRating;
use Illuminate\Database\Seeder;

class ShopRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User Customer Rating Toko
        ShopRating::create([
            'rating' => 5,
            'comment' => 'Toko sangat keren dan memiliki banyak produk menarik',
            'user_id' => 3,
        ]);
        ShopRating::create([
            'rating' => 4,
            'comment' => 'Pelayanan Jasa toko bagus, dan promo yang ditawarkan cukup menarik',
            'user_id' => 4,
        ]);
    }
}
