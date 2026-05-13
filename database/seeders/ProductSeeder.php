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
                'name' => 'Susu UHT Full Cream',
                'description' => 'Susu cair praktis dengan rasa lembut untuk konsumsi sehari-hari.',
                'price' => 21000,
                'stock' => 20,
                'category' => 'Makanan & Minuman',
                'expired_date' => Carbon::now()->addMonths(3)->toDateString(),
                'whatsapp_message' => 'Saya ingin memesan Susu UHT Full Cream.',
                'active' => true,
            ],
            [
                'name' => 'Sabun Cuci Piring',
                'description' => 'Sabun cuci piring lembut untuk tangan dan efektif membersihkan.',
                'price' => 9000,
                'stock' => 35,
                'category' => 'Perawatan Rumah',
                'expired_date' => null,
                'whatsapp_message' => 'Saya ingin memesan Sabun Cuci Piring.',
                'active' => true,
            ],
            [
                'name' => 'Popok Bayi Ukuran M',
                'description' => 'Popok sekali pakai dengan daya serap tinggi untuk bayi aktif.',
                'price' => 52000,
                'stock' => 12,
                'category' => 'Kebutuhan Bayi',
                'expired_date' => null,
                'whatsapp_message' => 'Saya ingin memesan Popok Bayi Ukuran M.',
                'active' => true,
            ],
            [
                'name' => 'Pulpen Hitam+',
                'description' => 'Pulpen tinta gel halus, ideal untuk menulis harian dan rapat.',
                'price' => 4500,
                'stock' => 50,
                'category' => 'Alat Tulis',
                'expired_date' => null,
                'whatsapp_message' => 'Saya ingin memesan Pulpen Hitam+.',
                'active' => false,
            ],
            [
                'name' => 'Baterai AA 4-pack',
                'description' => 'Baterai tahan lama untuk remote dan perangkat kecil.',
                'price' => 38000,
                'stock' => 10,
                'category' => 'Elektronik & Gadget',
                'expired_date' => null,
                'whatsapp_message' => 'Saya ingin memesan Baterai AA 4-pack.',
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
