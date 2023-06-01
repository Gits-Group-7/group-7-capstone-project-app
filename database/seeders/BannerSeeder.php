<?php

namespace Database\Seeders;

use App\Models\PromoBanner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Promo Banner untuk Produk
        PromoBanner::create([
            'title' => 'Promo Free Ongkir - Special Eid Mubarak 1444 H',
            'photo' => 'null',
            'status' => 'Aktif',
            // 'product_id' => '1',
        ]);

        // Promo Banner untuk Jasa
        PromoBanner::create([
            'title' => 'Promo Terbatas Free Jasa Pelayanan Order Jasa',
            'photo' => 'null',
            'status' => 'Non-Aktif',
            // 'service_id' => '1',
        ]);
    }
}
