<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('smuheroday'),
        ]);
        User::create([
            'name' => 'Customer',
            'role' => 'customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        User::create([
            'name' => 'Taufik Hidayat',
            'role' => 'customer',
            'birthdate' => '2001-09-12',
            'gender' => 'Laki-laki',
            'email' => 'taufikhidayat@gmail.com',
            'phone' => '082332743884',
            'password' => bcrypt('smuheroday'),
        ]);
    }
}
