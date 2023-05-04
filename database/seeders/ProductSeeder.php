<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Amazon Essentials Men Short-Sleeve Crewneck T-Shirt',
            'photo' => 'null',
            'price' => 160000,
            'stock' => 22,
            'condition' => 'New',
            'status' => 'Tersedia',
            'description' => 'Solids: 100% Cotton; Heathers: 60% Cotton, 40% Polyester. Imported. No Closure closure. Machine Wash.',
            'category_id' => '1',
        ]);
        Product::create([
            'name' => 'WHO IN SHOP Men Graphic Shirts Short Sleeve Button Up Hawaiian Graffiti Shirts',
            'photo' => 'null',
            'price' => 278000,
            'stock' => 34,
            'condition' => 'New',
            'status' => 'Tersedia',
            'description' => 'Brand: WHO IN SHOP. Style: Casual, Vintage. Sleeve Type: Short Sleeve. Collar: Spread Collar. Edition Type: Rugular Fit. Fabric: 95% Polyester and 5% Spandex. Gender: Male, Men. Size: Small, Medium, Large, X-Large, XX-Large, XXX-Large',
            'category_id' => '2',
        ]);
    }
}
