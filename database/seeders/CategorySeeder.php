<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    \App\Models\TourCategory::insert([
        ['name' => 'Du lịch Hạ Long', 'slug' => 'du-lich-ha-long', 'status' => 'active'],
        ['name' => 'Du lịch Đà Lạt', 'slug' => 'du-lich-da-lat', 'status' => 'active'],
        ['name' => 'Du lịch Phú Quốc', 'slug' => 'du-lich-phu-quoc', 'status' => 'active'],
    ]);
}
}
