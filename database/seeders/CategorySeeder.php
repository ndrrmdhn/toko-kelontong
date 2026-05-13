<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Makanan & Minuman', 'description' => 'Produk makanan dan minuman sehari-hari.'],
            ['name' => 'Perawatan Rumah', 'description' => 'Produk kebersihan dan perawatan rumah.'],
            ['name' => 'Kebutuhan Bayi', 'description' => 'Produk bayi dan balita.'],
            ['name' => 'Elektronik & Gadget', 'description' => 'Aksesori elektronik ringan.'],
            ['name' => 'Alat Tulis', 'description' => 'Kebutuhan kantor dan sekolah.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
