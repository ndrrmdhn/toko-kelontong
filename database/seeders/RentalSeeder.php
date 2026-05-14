<?php

namespace Database\Seeders;

use App\Models\Rental;
use Illuminate\Database\Seeder;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        $sampleRentals = [
            [
                'name' => 'Kontrakan Jalan Sudirman No. 45',
                'description' => 'Kontrakan strategis di pusat kota dengan akses mudah ke transportasi umum. Dekat dengan pasar tradisional dan fasilitas umum.',
                'price_monthly' => 1500000,
                'price_yearly' => 15000000,
                'facilities' => ['Kamar Mandi Dalam', 'Dapur', 'Parkir Motor', 'Listrik', 'Air PDAM'],
                'images' => ['images/rental-placeholder.svg'],
                'status' => 'available',
                'whatsapp_message' => 'Halo, saya ingin menanyakan kontrakan di Jalan Sudirman No. 45.',
            ],
            [
                'name' => 'Kontrakan Jalan Merdeka No. 12',
                'description' => 'Kontrakan nyaman dan aman dekat dengan fasilitas pendidikan dan pasar tradisional.',
                'price_monthly' => 1200000,
                'price_yearly' => 12000000,
                'facilities' => ['Kamar Mandi Dalam', 'Dapur', 'Parkir Motor', 'Listrik', 'Air PDAM'],
                'images' => ['images/rental-placeholder.svg'],
                'status' => 'available',
                'whatsapp_message' => 'Halo, saya ingin menanyakan kontrakan di Jalan Merdeka No. 12.',
            ],
            [
                'name' => 'Kontrakan Jalan Gatot Subroto No. 8',
                'description' => 'Kontrakan dekat pusat kota dengan fasilitas lengkap dan lingkungan yang nyaman.',
                'price_monthly' => 1400000,
                'price_yearly' => 14000000,
                'facilities' => ['Kamar Mandi Dalam', 'Dapur', 'Parkir Motor', 'Listrik', 'Air PDAM'],
                'images' => ['images/rental-placeholder.svg'],
                'status' => 'available',
                'whatsapp_message' => 'Halo, saya ingin menanyakan kontrakan di Jalan Gatot Subroto No. 8.',
            ],
        ];

        foreach ($sampleRentals as $rental) {
            Rental::updateOrCreate(
                ['name' => $rental['name']],
                $rental
            );
        }
    }
}
