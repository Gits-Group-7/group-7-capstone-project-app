<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product Category
        Category::create([
            'id' => '1',
            'name' => 'Kaos',
            'description' => 'Meliputi Produk berjenis Kaos dan lain-lain',
            'type' => 'product',
            'status' => 'Aktif',
        ]);
        Category::create([
            'id' => '2',
            'name' => 'Jaket',
            'description' => 'Meliputi Produk berjenis Jacket dan lain-lain',
            'type' => 'product',
            'status' => 'Aktif',
        ]);

        // Service Category
        Category::create([
            'id' => '3',
            'name' => 'Sablon Kaos',
            'description' => 'Meliputi Layanan Jasa Sablon Kaos dan lain-lain',
            'type' => 'service',
            'status' => 'Aktif',
        ]);
        Category::create([
            'id' => '4',
            'name' => 'Konveksi Baju',
            'description' => 'Meliputi Layanan Jasa Konveksi Baju dan lain-lain',
            'type' => 'service',
            'status' => 'Aktif',
        ]);
    }
}
