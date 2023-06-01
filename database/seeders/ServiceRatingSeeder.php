<?php

namespace Database\Seeders;

use App\Models\ServiceRating;
use Illuminate\Database\Seeder;

class ServiceRatingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Customer Rating Jasa Sablon kaos
        ServiceRating::create([
            'rating' => 5,
            'comment' => 'Pelayanan Jasa Cepat dan Sangat Bagus!',
            'service_id' => 1,
            'user_id' => 3,
        ]);
        ServiceRating::create([
            'rating' => 4,
            'comment' => 'Pelayanan Jasa Cepat dan Sangat Bagus!',
            'service_id' => 2,
            'user_id' => 4,
        ]);
        ServiceRating::create([
            'rating' => 4,
            'comment' => 'Pelayanan Jasa Cepat dan Sangat Bagus!',
            'service_id' => 3,
            'user_id' => 3,
        ]);
        ServiceRating::create([
            'rating' => 5,
            'comment' => 'Pelayanan Jasa Cepat dan Sangat Bagus!',
            'service_id' => 4,
            'user_id' => 4,
        ]);

        // Customer Rating Jasa Konveksi Baju
        ServiceRating::create([
            'rating' => 4,
            'comment' => 'Pelayanan Jasa Cepat dan Sangat Bagus!',
            'service_id' => 5,
            'user_id' => 4,
        ]);
        ServiceRating::create([
            'rating' => 5,
            'comment' => 'Pelayanan Jasa Cepat dan Sangat Bagus!',
            'service_id' => 6,
            'user_id' => 3,
        ]);
        ServiceRating::create([
            'rating' => 4,
            'comment' => 'Pelayanan Jasa Cepat dan Sangat Bagus!',
            'service_id' => 7,
            'user_id' => 3,
        ]);
        ServiceRating::create([
            'rating' => 5,
            'comment' => 'Pelayanan Jasa Cepat dan Sangat Bagus!',
            'service_id' => 8,
            'user_id' => 4,
        ]);
    }
}
