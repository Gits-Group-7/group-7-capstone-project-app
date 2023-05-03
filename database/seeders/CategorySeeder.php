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
        Category::create([
            'id' => '1',
            'name' => 'Kaos',
            'description' => 'Meliputi Distro, Oblong dan lain-lain',
            'type' => 'product',
            'status' => 'Aktif',
        ]);
        Category::create([
            'id' => '2',
            'name' => 'Sablon Kaos',
            'description' => 'Meliputi jasa pemesanan baju untuk sablon kaos',
            'type' => 'service',
            'status' => 'Aktif',
        ]);
    }
}
