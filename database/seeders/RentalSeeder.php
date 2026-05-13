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
                'name' => 'Rumah Kontrakan Gang Melati',
                'description' => 'Rumah kontrakan nyaman dengan taman kecil di depan. Cocok untuk keluarga kecil dengan suasana tenang dan aman.',
                'price_monthly' => 1200000,
                'price_yearly' => 12000000,
                'facilities' => ['Kamar Mandi Dalam', 'Dapur', 'Taman', 'Parkir Mobil', 'Security 24 Jam'],
                'images' => ['images/rental-placeholder.svg'],
                'status' => 'available',
                'whatsapp_message' => 'Halo, saya ingin menanyakan rumah kontrakan di Gang Melati.',
            ],
            [
                'name' => 'Apartemen Studio Minimalis',
                'description' => 'Apartemen studio modern dengan desain minimalis. Dilengkapi dengan furniture basic siap huni.',
                'price_monthly' => 2000000,
                'price_yearly' => 20000000,
                'facilities' => ['AC', 'Kamar Mandi Dalam', 'Dapur', 'Lift', 'Gym', 'Kolam Renang'],
                'images' => ['images/rental-placeholder.svg'],
                'status' => 'rented',
                'whatsapp_message' => 'Halo, saya ingin menanyakan apartemen studio minimalis.',
            ],
            [
                'name' => 'Kontrakan Kost-an Murah',
                'description' => 'Kontrakan kost-an dengan harga terjangkau untuk mahasiswa atau pekerja. Fasilitas bersama dengan harga bersahabat.',
                'price_monthly' => 800000,
                'price_yearly' => 8000000,
                'facilities' => ['Kamar Mandi Luar', 'Dapur Bersama', 'Parkir Motor', 'WiFi', 'Laundry'],
                'images' => ['images/rental-placeholder.svg'],
                'status' => 'available',
                'whatsapp_message' => 'Halo, saya ingin menanyakan kontrakan kost-an murah.',
            ],
            [
                'name' => 'Villa Kontrakan Premium',
                'description' => 'Villa mewah dengan pemandangan pegunungan. Cocok untuk eksekutif atau keluarga yang menginginkan privasi dan kenyamanan maksimal.',
                'price_monthly' => 5000000,
                'price_yearly' => 50000000,
                'facilities' => ['Kolam Renang Pribadi', 'Taman', 'Garage', 'Security 24 Jam', 'Gym', 'Spa'],
                'images' => ['images/rental-placeholder.svg'],
                'status' => 'available',
                'whatsapp_message' => 'Halo, saya ingin menanyakan villa kontrakan premium.',
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
