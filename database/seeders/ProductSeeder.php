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
                'price' => 12000,
                'stock' => 50,
                'category' => 'Bahan Pokok',
                'expired_date' => Carbon::now()->addMonths(6)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Beras Putih.',
                'active' => true,
            ],
            [
                'name' => 'Minyak Goreng',
                'description' => 'Minyak goreng berkualitas untuk memasak.',
                'price' => 15000,
                'stock' => 30,
                'category' => 'Bahan Pokok',
                'expired_date' => Carbon::now()->addMonths(12)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Minyak Goreng.',
                'active' => true,
            ],
            [
                'name' => 'Gula Pasir',
                'description' => 'Gula pasir untuk kebutuhan rumah tangga.',
                'price' => 10000,
                'stock' => 40,
                'category' => 'Bahan Pokok',
                'expired_date' => Carbon::now()->addMonths(12)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Gula Pasir.',
                'active' => true,
            ],
            [
                'name' => 'Garam',
                'description' => 'Garam dapur untuk memasak.',
                'price' => 5000,
                'stock' => 50,
                'category' => 'Bahan Pokok',
                'expired_date' => Carbon::now()->addMonths(12)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Garam.',
                'active' => true,
            ],
            [
                'name' => 'Bawang Merah',
                'description' => 'Bawang merah segar untuk masakan.',
                'price' => 20000,
                'stock' => 25,
                'category' => 'Bumbu & Rempah',
                'expired_date' => Carbon::now()->addMonths(1)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Bawang Merah.',
                'active' => true,
            ],
            [
                'name' => 'Bawang Putih',
                'description' => 'Bawang putih segar untuk masakan.',
                'price' => 20000,
                'stock' => 25,
                'category' => 'Bumbu & Rempah',
                'expired_date' => Carbon::now()->addMonths(1)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Bawang Putih.',
                'active' => true,
            ],
            [
                'name' => 'Cabe Rawit',
                'description' => 'Cabe rawit segar untuk bumbu masakan.',
                'price' => 15000,
                'stock' => 30,
                'category' => 'Bumbu & Rempah',
                'expired_date' => Carbon::now()->addMonths(1)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Cabe Rawit.',
                'active' => true,
            ],
            [
                'name' => 'Telur Ayam',
                'description' => 'Telur ayam segar untuk konsumsi.',
                'price' => 20000,
                'stock' => 40,
                'category' => 'Protein',
                'expired_date' => Carbon::now()->addWeeks(2)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Telur Ayam.',
                'active' => true,
            ],
            [
                'name' => 'Ikan Asin Madura',
                'description' => 'Ikan asin khas Madura, cocok untuk masakan.',
                'price' => 25000,
                'stock' => 20,
                'category' => 'Protein',
                'expired_date' => Carbon::now()->addMonths(6)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Ikan Asin Madura.',
                'active' => true,
            ],
            [
                'name' => 'Teh Manis',
                'description' => 'Teh celup manis siap seduh.',
                'price' => 8000,
                'stock' => 50,
                'category' => 'Minuman',
                'expired_date' => Carbon::now()->addMonths(12)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Teh Manis.',
                'active' => true,
            ],
            [
                'name' => 'Kopi Bubuk',
                'description' => 'Kopi bubuk khas Madura untuk seduhan.',
                'price' => 12000,
                'stock' => 40,
                'category' => 'Minuman',
                'expired_date' => Carbon::now()->addMonths(12)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Kopi Bubuk.',
                'active' => true,
            ],
            [
                'name' => 'Sabun Mandi',
                'description' => 'Sabun mandi untuk kebutuhan harian.',
                'price' => 5000,
                'stock' => 50,
                'category' => 'Kebutuhan Pokok',
                'expired_date' => Carbon::now()->addYears(2)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Sabun Mandi.',
                'active' => true,
            ],
            [
                'name' => 'Pasta Gigi',
                'description' => 'Pasta gigi untuk kebersihan gigi.',
                'price' => 15000,
                'stock' => 30,
                'category' => 'Kebutuhan Pokok',
                'expired_date' => Carbon::now()->addYears(2)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Pasta Gigi.',
                'active' => true,
            ],
            [
                'name' => 'Air Mineral',
                'description' => 'Air mineral kemasan botol untuk kebutuhan minum.',
                'price' => 3000,
                'stock' => 100,
                'category' => 'Minuman',
                'expired_date' => Carbon::now()->addYears(1)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Air Mineral.',
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
                    'expired_date' => $item['expired_date'],
                    'whatsapp_message' => $item['whatsapp_message'],
                    'active' => $item['active'],
                ]
            );
        }
    }
}
