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
        Service::create([
            'name' => 'Men Sun & Japanese Letter Graphic Tee',
            'photo' => 'null',
            'price_per_pcs' => 45000,
            'price_per_dozen' => 540000,
            'estimation' => '5 Hari',
            'description' => 'White Casual Short Sleeve Polyester Graphic Letter Slight Stretch Summer Men Tops',
            'category_id' => '3',
        ]);
        Service::create([
            'name' => 'Men Letter Graphic Tee',
            'photo' => 'null',
            'price_per_pcs' => 30000,
            'price_per_dozen' => 540000,
            'estimation' => '4 Hari',
            'description' => 'Black Casual Short Sleeve Polyester Letter Embellished Slight Stretch Summer Men Tops',
            'category_id' => '3',
        ]);
    }
}
