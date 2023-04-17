<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
            'name' => 'Smartphone',
            'description' => 'Meliputi Smartphone, Handphone Tablet dan Lain-lain',
            'status' => 'Aktif',
        ]);
        Category::create([
            'id' => '2',
            'name' => 'Laptop',
            'description' => 'Meliputi Perangkat Laptop, Mobile Device, dan PC',
            'status' => 'Aktif',
        ]);
        Category::create([
            'id' => '3',
            'name' => 'Kamera',
            'description' => 'Meliputi Kamera, Lensa dan Lain-lain',
            'status' => 'Aktif',
        ]);
        Category::create([
            'id' => '4',
            'name' => 'Monitor',
            'description' => 'Meliputi Monitor, LED TV dan Lain-lain',
            'status' => 'Aktif',
        ]);
        Category::create([
            'id' => '5',
            'name' => 'Storage Device',
            'description' => 'Meliputi Flashdisk, Memory Card, Harddisk & SSD',
            'status' => 'Aktif',
        ]);
        Category::create([
            'id' => '6',
            'name' => 'Gaming Device',
            'description' => 'Meliputi Device Gaming, Setup Gaming dan Sparepart Gaming',
            'status' => 'Aktif',
        ]);
    }
}
