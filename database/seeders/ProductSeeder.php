<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // product smartphone
        Product::create([
            'category_id' => '1',
            'name' => 'Google Pixel 4a Smartphone',
            'photo' => 'null',
            'price' => 1775000,
            'stock' => 10,
            'warranty' => 3,
            'condition' => 'Baru',
            'description' => 'Google Pixel 4a merupakan HP dengan layar 5.8" dan tingkat densitas piksel sebesar 413ppi. Ia dilengkapi dengan kamera belakang 12.2MP dan kamera depan 8MP. HP ini juga hadir dengan kapasitas baterai 3140mAh. Google Pixel 4a dirilis pada: 2020',
            'status' => 'Tersedia',
        ]);

        // product laptop
        Product::create([
            'category_id' => '2',
            'name' => 'Apple MacBook Air with 1.1GHz Core i3',
            'photo' => 'null',
            'price' => 9400000,
            'stock' => 20,
            'warranty' => 2,
            'condition' => 'Baru',
            'description' => 'Intel Core i3 processor1.1GHz dual-core 10th-generation, 13.3 inch 1440 x 900 LED IPS, 8 GB LPDDR3 2133 MHz, SSD 256GB-IND, macOS',
            'status' => 'Tersedia',
        ]);

        // product kamera
        Product::create([
            'category_id' => '3',
            'name' => 'Logitech C920x HD Pro Webcam, Full HD 1080p/30fps',
            'photo' => 'null',
            'price' => 1045000,
            'stock' => 1,
            'warranty' => 1,
            'condition' => 'Like a New',
            'description' => 'Resolusi Maks.: 1080 p/30 fps - 720p/ 30 fps, Kamera mega pixel: 3, Jenis fokus: Autofocus, Jenis lensa: Kaca, Mikrofon internal: Stereo, Jangkauan mikrofon: Maksimal 1 m, Bidang pandang diagonal (dFoV):: 78°, Universal clip yang kompatibel dengan tripod ini cocok dengan berbagai laptop, LCD, atau monitor 1Tripod tidak disertakan',
            'status' => 'Habis',
        ]);


        // product monitor
        Product::create([
            'category_id' => '4',
            'name' => 'SAMSUNG 32" Odyssey G55A QHD 165Hz 1ms FreeSync Curved',
            'photo' => 'null',
            'price' => 6415000,
            'stock' => 15,
            'warranty' => 3,
            'condition' => 'Baru',
            'description' => 'WQHD resolution and HDR10 boasts incredibly detailed, pin-sharp images, 165Hz refresh rate and 1ms response time to reduce lag and ghosting, Adaptive Sync technology allows fast-action and stutter-free with AMD FreeSync Premium',
            'status' => 'Pre Order',
        ]);

        // product storage device
        Product::create([
            'category_id' => '5',
            'name' => '850 PRO SATA III 2.5 inch SSD',
            'photo' => 'null',
            'price' => 1595000,
            'stock' => 25,
            'warranty' => 1,
            'condition' => 'Baru',
            'description' => 'Samsung SSD 870 EVO 250GB 500GB 1TB 2.5" SATA III Internal SSD. The perfect choice for creators, IT professionals or everyday users, the latest 870 EVO has indisputable performance, reliability and compatibility built upon Samsungs pioneering technology.',
            'status' => 'Pre Order',
        ]);

        // product gaming device
        Product::create([
            'category_id' => '6',
            'name' => 'NUBWO G06 Wireless Gaming Headset with Microphone for PS5, PS4, PC',
            'photo' => 'null',
            'price' => 745000,
            'stock' => 5,
            'warranty' => 1,
            'condition' => 'Baru',
            'description' => 'The Ultimate In-game Sound Experience - Benamkan diri Anda dalam audio stereo yang kaya dengan headset gaming nirkabel NUBWO, yang dirancang khusus untuk PS5, PS4, dan perangkat gaming lainnya. Driver 50mm dan 2 driver kamar ganda menghasilkan suara yang tajam dan kuat yang menempatkan Anda tepat di tengah-tengah aksi. Lossless Wireless Connectivity - Ucapkan selamat tinggal pada kabel yang kusut dan nikmati kenyamanan permainan nirkabel. Headset NUBWO memiliki konektivitas nirkabel 2.4GHz melalui dongle USB untuk konsol dan PC, memastikan koneksi yang stabil dan bebas lag.',
            'status' => 'Tersedia',
        ]);
    }
}
