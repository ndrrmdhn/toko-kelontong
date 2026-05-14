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
                'name' => 'Kontrakan Jalan Sukun Kebondalem',
                'description' => 'Kontrakan dengan akses mudah jalan pantura. Dekat dengan pasar fasilitas kesehatan.',
                'price_monthly' => 500000,
                'price_yearly' => 6000000,
                'facilities' => ['Listrik', 'Air PDAM', 'Kamar Mandi Dalam', 'Dapur', 'Dua Kamar Tidur', 'Wifi'],
                'images' => ['images/rental-placeholder.svg'],
                'status' => 'available',
                'whatsapp_message' => 'Halo, saya ingin menanyakan kontrakan di Jalan Sukun Kebondalem.',
            ],
            [
                'name' => 'Kontrakan Jalan Brantas Kebondalem',
                'description' => 'Kontrakan nyaman dan aman dekat dengan fasilitas pendidikan dan pasar tradisional.',
                'price_monthly' => 700000,
                'price_yearly' => 7500000,
                'facilities' => ['Listrik', 'Air PDAM', 'Kamar Mandi Dalam', 'Dapur', 'Dua Kamar Tidur'],
                'images' => ['images/rental-placeholder.svg'],
                'status' => 'available',
                'whatsapp_message' => 'Halo, saya ingin menanyakan kontrakan di Jalan Brantas Kebondalem.',
            ],
            [
                'name' => 'Kontrakan Jalan Progo',
                'description' => 'Kontrakan dekat pusat kota dengan fasilitas lengkap dan lingkungan yang nyaman.',
                'price_monthly' => 850000,
                'price_yearly' => 10000000,
                'facilities' => ['Listrik', 'Air PDAM', 'Kamar Mandi Dalam', 'Dapur', 'Dua Kamar Tidur', 'Parkir Motor'],
                'images' => ['images/rental-placeholder.svg'],
                'status' => 'available',
                'whatsapp_message' => 'Halo, saya ingin menanyakan kontrakan di Jalan Progo Kebondalem.',
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
