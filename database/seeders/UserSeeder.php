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
        // User Role Admin
        User::create([
            'name' => 'Admin Print-Shop',
            'role' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123'),
        ]);
        User::create([
            'name' => 'Manager Print-Shop',
            'role' => 'admin',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('manager123'),
        ]);

        // User Role Customer
        User::create([
            'name' => 'Customer Rabbit',
            'role' => 'customer',
            'email' => 'customerrabbit@gmail.com',
            'password' => bcrypt('rabbit123'),
        ]);
        User::create([
            'name' => 'Customer Bunny',
            'role' => 'customer',
            'email' => 'customerbunny@gmail.com',
            'password' => bcrypt('bunny123'),
        ]);
    }
}
