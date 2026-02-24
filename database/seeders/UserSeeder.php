<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User ADMIN
        User::create([
            'name'     => 'Admin Tour',
            'email'    => 'admin@tour.com',
            'phone'    => '0900000001',
            'password' => Hash::make('123456'),
            'role'     => 'admin',
            'status'   => 'active',
        ]);

        // User KHÁCH HÀNG
        User::create([
            'name'     => 'Nguyễn Văn A',
            'email'    => 'user@tour.com',
            'phone'    => '0900000002',
            'password' => Hash::make('123456'),
            'role'     => 'user',
            'status'   => 'active',
        ]);
    }
}
