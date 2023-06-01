<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // pemanggilan seeder
        $this->call([
            UserSeeder::class, // Seeder User Admin and Customer
            CategorySeeder::class, // Seeder Category Product and Service
            ProductSeeder::class, // Seeder Product Kaos and Jaket
            ServiceSeeder::class, // Seeder Service Sablon Kaos and Konveksi Baju
            BannerSeeder::class, // Seeder Banner Produk and Jasa\
            ShopRatingSeeder::class, // Seeder Rating Toko
            ProductRatingSeeder::class, // Seeder untuk Rating Produk
            ServiceRatingSeeder::class, // Seeder untuk Rating Jasa
        ]);
    }
}
