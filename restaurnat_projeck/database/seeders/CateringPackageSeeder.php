<?php

namespace Database\Seeders;

use App\Models\CateringPackage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CateringPackageSeeder extends Seeder
{
    public function run(): void
    {
        $packages = [
            [
                'name' => 'Paket Katering Hemat',
                'description' => 'Paket ekonomis cocok untuk syukuran kecil, rapat harian kantor, dan pengajian.',
                'price_per_package' => 22000,
                'min_order' => 15,
                'image' => 'img/menu-3.jpg',
                'includes' => "• Nasi Putih Wangi\n• Ayam Goreng Kalasan / Geprek\n• Tahu & Tempe Bacem\n• Sayur Urap / Capcay\n• Sambal & Kerupuk\n• Air Mineral Cup",
                'is_active' => true,
            ],
            [
                'name' => 'Paket Katering Spesial Kedai Agung',
                'description' => 'Paket favorit terlaris dengan pilihan lauk daging atau ayam komplit beserta buah segar.',
                'price_per_package' => 30000,
                'min_order' => 20,
                'image' => 'img/menu-4.jpg',
                'includes' => "• Nasi Putih Pulen\n• Ayam Bakar Madu / Cincang Ayam\n• Telur Balado / Sambal Goreng Ati\n• Perkedel Kentang\n• Sayur Gulai Singkong / Sop\n• Buah Pisang / Jeruk\n• Sambal Terasi & Kerupuk Udang\n• Air Mineral Cup",
                'is_active' => true,
            ],
            [
                'name' => 'Paket Katering Prasmanan / Acara Besar',
                'description' => 'Paket premium untuk pesta pernikahan, khitanan, gathering instansi dan acara besar.',
                'price_per_package' => 45000,
                'min_order' => 50,
                'image' => 'img/menu-5.jpg',
                'includes' => "• Nasi Putih & Nasi Gurih\n• Rendang Sapi Spesial\n• Ayam Goreng Kremes / Woku\n• Ikan Fillet Asam Manis\n• Sop Kimlo / Sop Iga Kaldu\n• Aneka Puding & Buah Potong\n• Kerupuk Udang & Sambal\n• Es Manis / Es Teh Buah\n• Bonus 1 Loyang Bolu (Min 50 Pax)",
                'is_active' => true,
            ],
        ];

        foreach ($packages as $pkg) {
            CateringPackage::updateOrCreate(
                ['slug' => Str::slug($pkg['name'])],
                [
                    'name' => $pkg['name'],
                    'description' => $pkg['description'],
                    'price_per_package' => $pkg['price_per_package'],
                    'min_order' => $pkg['min_order'],
                    'image' => $pkg['image'],
                    'includes' => $pkg['includes'],
                    'is_active' => $pkg['is_active'],
                ]
            );
        }
    }
}

