<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Bahan Pokok', 'description' => 'Kebutuhan bahan pokok sehari-hari untuk memasak dan konsumsi rumah tangga.'],

            ['name' => 'Bumbu & Rempah', 'description' => 'Berbagai bumbu dapur dan rempah pilihan untuk menambah cita rasa masakan.'],

            ['name' => 'Protein', 'description' => 'Sumber protein seperti daging, telur, ikan, dan produk olahan lainnya.'],

            ['name' => 'Minuman', 'description' => 'Aneka minuman segar, instan, dan kebutuhan minum harian.'],

            ['name' => 'Kebutuhan Pokok', 'description' => 'Berbagai kebutuhan penting rumah tangga untuk aktivitas sehari-hari.'],

            ['name' => 'Snack & Cemilan', 'description' => 'Pilihan snack dan cemilan lezat untuk teman santai dan berkumpul.'],

            ['name' => 'Perlengkapan Rumah Tangga', 'description' => 'Peralatan dan perlengkapan rumah tangga untuk kebutuhan harian.'],

            ['name' => 'Kesehatan & Kebersihan', 'description' => 'Produk kesehatan, perawatan diri, dan kebersihan keluarga.'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
