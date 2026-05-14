<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $placeholderImage = 'images/product-placeholder.svg';
        $categories = Category::all();

        if ($categories->isEmpty()) {
            $this->call(CategorySeeder::class);
            $categories = Category::all();
        }

        $sampleProducts = [
            [
                'name' => 'Beras Putih',
                'description' => 'Beras berkualitas untuk kebutuhan sehari-hari.',
                'price' => 15000,
                'stock' => 10,
                'category' => 'Bahan Pokok',
                'whatsapp_message' => 'Saya ingin memesan Beras Putih.',
                'active' => true,
            ],
            [
                'name' => 'Minyak Goreng',
                'description' => 'Minyak goreng berkualitas untuk memasak.',
                'price' => 25000,
                'stock' => 10,
                'category' => 'Bahan Pokok',
                'whatsapp_message' => 'Saya ingin memesan Minyak Goreng.',
                'active' => true,
            ],
            [
                'name' => 'Gula Pasir',
                'description' => 'Gula pasir untuk kebutuhan rumah tangga.',
                'price' => 19000,
                'stock' => 10,
                'category' => 'Bahan Pokok',
                'whatsapp_message' => 'Saya ingin memesan Gula Pasir.',
                'active' => true,
            ],
            [
                'name' => 'Garam',
                'description' => 'Garam dapur untuk memasak.',
                'price' => 5000,
                'stock' => 10,
                'category' => 'Bahan Pokok',
                'whatsapp_message' => 'Saya ingin memesan Garam.',
                'active' => true,
            ],
            [
                'name' => 'Telur Ayam',
                'description' => 'Telur ayam segar untuk konsumsi.',
                'price' => 35000,
                'stock' => 20,
                'category' => 'Protein',
                'whatsapp_message' => 'Saya ingin memesan Telur Ayam.',
                'active' => true,
            ],
            [
                'name' => 'Kopi Bubuk',
                'description' => 'Kopi bubuk untuk seduhan.',
                'price' => 22000,
                'stock' => 20,
                'category' => 'Minuman',
                'whatsapp_message' => 'Saya ingin memesan Kopi Bubuk.',
                'active' => true,
            ],
            [
                'name' => 'Sabun Mandi',
                'description' => 'Sabun mandi untuk kebutuhan harian.',
                'price' => 5000,
                'stock' => 20,
                'category' => 'Kebutuhan Pokok',
                'whatsapp_message' => 'Saya ingin memesan Sabun Mandi.',
                'active' => true,
            ],
            [
                'name' => 'Pasta Gigi',
                'description' => 'Pasta gigi untuk kebersihan gigi.',
                'price' => 15000,
                'stock' => 10,
                'category' => 'Kebutuhan Pokok',
                'whatsapp_message' => 'Saya ingin memesan Pasta Gigi.',
                'active' => true,
            ],
            [
                'name' => 'Air Mineral',
                'description' => 'Air mineral kemasan botol untuk kebutuhan minum.',
                'price' => 3000,
                'stock' => 30,
                'category' => 'Minuman',
                'whatsapp_message' => 'Saya ingin memesan Air Mineral.',
                'active' => true,
            ],
            [
                'name' => 'Snack Kentang',
                'description' => 'Snack kentang goreng untuk camilan.',
                'price' => 5000,
                'stock' => 20,
                'category' => 'Snack & Cemilan',
                'whatsapp_message' => 'Saya ingin memesan Snack Kentang.',
                'active' => true,
            ],
        ];

        foreach ($sampleProducts as $item) {
            $category = $categories->firstWhere('name', $item['category']);

            Product::updateOrCreate(
                ['name' => $item['name']],
                [
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'image' => $placeholderImage,
                    'category_id' => $category->id,
                    'whatsapp_message' => $item['whatsapp_message'],
                    'active' => $item['active'],
                ]
            );
        }
    }
}
