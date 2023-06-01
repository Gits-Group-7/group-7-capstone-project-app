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
        // Product for Kaos Category
        Product::create([
            'id' => 1,
            'name' => 'Men Slogan & Cartoon Graphic Tee Ver One',
            'photo' => 'null',
            'price' => 140000,
            'stock' => 75,
            'condition' => 'New',
            'status' => 'Tersedia',
            'description' =>
            'Color:	Black.
            Style: Casual.
            Pattern Type: Slogan.
            Material: Fabric.
            Composition: 95% Polyester, 5% Elastane.
            Care Instructions: Hand wash,do not dry clean.',
            'category_id' => '1',
        ]);
        Product::create([
            'id' => 2,
            'name' => 'SHEIN Men Japanese Letter & Cartoon Graphic Tee',
            'photo' => 'null',
            'price' => 160000,
            'stock' => 84,
            'condition' => 'New',
            'status' => 'Tersedia',
            'description' =>
            'Color: Black.
            Style: Casual.
            Pattern Type: Letter, Cartoon.
            Material: Fabric.
            Composition: 100% Polyester.
            Care Instructions: Machine wash or professional dry clean.',
            'category_id' => '1',
        ]);
        Product::create([
            'id' => 3,
            'name' => 'Men Slogan & Cartoon Graphic Tee Ver Two',
            'photo' => 'null',
            'price' => 145000,
            'stock' => 65,
            'condition' => 'New',
            'status' => 'Tersedia',
            'description' =>
            'Color: Black.
            Style: Street.
            Pattern Type: Slogan.
            Material:	Fabric
            Composition: 95% Polyester, 5% Elastane.
            Care Instructions: Hand wash,do not dry clean.',
            'category_id' => '1',
        ]);
        Product::create([
            'id' => 4,
            'name' => 'Men Cartoon Graphic Tee',
            'photo' => 'null',
            'price' => 135000,
            'stock' => 40,
            'condition' => 'New',
            'status' => 'Tersedia',
            'description' =>
            'Color: Blue.
            Style: Casual.
            Pattern Type: Cartoon.
            Material: Fabric.
            Composition: 95% Polyester, 5% Elastane.
            Care Instructions: Hand wash,do not dry clean.',
            'category_id' => '1',
        ]);

        // Product for Jacket Category
        Product::create([
            'id' => 5,
            'name' => 'Men Slogan Graphic Jacket Without Hoodie',
            'photo' => 'null',
            'price' => 375000,
            'stock' => 55,
            'condition' => 'New',
            'status' => 'Tersedia',
            'description' =>
            'Color: Apricot.
            Style: Casual.
            Pattern Type: Cartoon, Slogan.
            Details: Pocket, Button Front.
            Type: Varsity.
            Material: Fabric.
            Composition: 100% Polyester.
            Care Instructions: Hand wash or professional dry clean.',
            'category_id' => '2',
        ]);
        Product::create([
            'id' => 6,
            'name' => 'Men Letter Graphic Drop Shoulder Varsity Jacket Without Hoodie',
            'photo' => 'null',
            'price' => 320000,
            'stock' => 40,
            'condition' => 'New',
            'status' => 'Tersedia',
            'description' =>
            'Color: Navy Blue.
            Style: Casual.
            Pattern Type: Colorblock, Letter.
            Details: Pocket, Button Front.
            Type: Varsity.
            Material: Fabric.
            Composition: 100% Polyester.
            Care Instructions: Hand wash or professional dry clean.',
            'category_id' => '2',
        ]);
        Product::create([
            'id' => 7,
            'name' => 'Men Letter Graphic Two Tone Varsity Jacket Without Hoodie',
            'photo' => 'null',
            'price' => 300000,
            'stock' => 70,
            'condition' => 'New',
            'status' => 'Tersedia',
            'description' =>
            'Color: Black and White.
            Style: Casual.
            Pattern Type: Colorblock, Letter.
            Details: Pocket, Button Front.
            Type: Varsity.
            Material: Fabric.
            Composition: 100% Polyester.
            Care Instructions: Hand wash or professional dry clean.',
            'category_id' => '2',
        ]);
        Product::create([
            'id' => 8,
            'name' => 'SHEIN Men Colorblock Letter Patched Striped Trim Varsity Jacket',
            'photo' => 'null',
            'price' => 280000,
            'stock' => 35,
            'condition' => 'New',
            'status' => 'Tersedia',
            'description' =>
            'Color: Multicolor.
            Style: Casual.
            Pattern Type: Colorblock, Letter.
            Details: Patched, Pocket, Button Front.
            Type: Varsity.
            Material: Knitted Fabric.
            Composition: 100% Polyester.
            Care Instructions: Machine wash or professional dry clean.',
            'category_id' => '2',
        ]);
    }
}
