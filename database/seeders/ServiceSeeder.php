<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Jasa Sablon Kaos
        Service::create([
            'id' => 1,
            'name' => 'Men Cartoon & Slogan Graphic Drop Shoulder Tee',
            'photo' => 'null',
            'price_per_pcs' => 120000,
            'price_per_dozen' => 1400000,
            'estimation' => 4,
            'description' => '
            Color: White.
            Style: Casual.
            Pattern Type: Cartoon, Slogan.
            Material: Fabric.
            Composition: 100% Polyester.
            Care Instructions: Machine wash or professional dry clean.',
            'category_id' => '3',
        ]);
        Service::create([
            'id' => 2,
            'name' => 'Men Figure & Letter Graphic Tee',
            'photo' => 'null',
            'price_per_pcs' => 125000,
            'price_per_dozen' => 1450000,
            'estimation' => 5,
            'description' => '
            Color: Khaki.
            Style: Casual.
            Pattern Type: Figure.
            Material: Fabric.
            Composition: 95% Polyester, 5% Elastane.
            Care Instructions: Machine wash, do not dry clean.',
            'category_id' => '3',
        ]);
        Service::create([
            'id' => 3,
            'name' => 'Men Cartoon Graphic Drop Shoulder Tee',
            'photo' => 'null',
            'price_per_pcs' => 115000,
            'price_per_dozen' => 1350000,
            'estimation' => 4,
            'description' => '
            Color: Grey.
            Style: Casual.
            Pattern Type: Cartoon.
            Material: Fabric.
            Composition: 100% Polyester.
            Care Instructions: Machine wash or professional dry clean.',
            'category_id' => '3',
        ]);
        Service::create([
            'id' => 4,
            'name' => 'Men Astronaut & Letter Graphic Tee',
            'photo' => 'null',
            'price_per_pcs' => 150000,
            'price_per_dozen' => 1750000,
            'estimation' => 5,
            'description' => '
            Color: Blue.
            Style: Casual.
            Pattern Type: Letter, Figure.
            Material: Fabric.
            Composition: 100% Polyester.
            Care Instructions: Machine wash or professional dry clean.',
            'category_id' => '3',
        ]);

        // Jasa Konveksi
        Service::create([
            'id' => 5,
            'name' => 'Men Gold Plaid Print Shirt',
            'photo' => 'null',
            'price_per_pcs' => 145000,
            'price_per_dozen' => 1700000,
            'estimation' => 7,
            'description' => '
            Color: Navy Blue.
            Style: Work.
            Pattern Type: Plaid.
            Type: Shirt.
            Material: Fabric.
            Composition: 100% Polyester.
            Care Instructions: Machine wash or professional dry clean.',
            'category_id' => '4',
        ]);
        Service::create([
            'id' => 6,
            'name' => 'Men Contrast Panel Polo Shirt',
            'photo' => 'null',
            'price_per_pcs' => 100000,
            'price_per_dozen' => 1200000,
            'estimation' => 7,
            'description' => '
            Color: Multicolor.
            Style: Casual.
            Pattern Type: Colorblock.
            Material: Fabric.
            Composition: 97% Polyester, 3% Spandex.
            Care Instructions: Machine wash or professional dry clean.',
            'category_id' => '4',
        ]);
        Service::create([
            'id' => 7,
            'name' => 'Men Plaid Print Pocket Patched Shirt',
            'photo' => 'null',
            'price_per_pcs' => 230000,
            'price_per_dozen' => 2700000,
            'estimation' => 7,
            'description' => '
            Color: Navy Blue.
            Style: Casual.
            Pattern Type: Plaid.
            Type: Shirt.
            Material: Fabric.
            Composition: 100% Polyester.
            Care Instructions: Machine wash or professional dry clean.',
            'category_id' => '4',
        ]);
        Service::create([
            'id' => 8,
            'name' => 'Men Color Block Graphic Embroidery Polo Shirt',
            'photo' => 'null',
            'price_per_pcs' => 90000,
            'price_per_dozen' => 1000000,
            'estimation' => 7,
            'description' => '
            Color: Navy Blue.
            Style: Casual.
            Pattern Type: Graphic.
            Material: Fabric.
            Composition: 97% Polyester, 3% Spandex.
            Care Instructions: Machine wash or professional dry clean.',
            'category_id' => '4',
        ]);
    }
}
