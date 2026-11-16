<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Menu;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $lauk = Category::where('slug', 'lauk-pauk')->first();
        $sarapan = Category::where('slug', 'sarapan-pagi')->first();
        $basah = Category::where('slug', 'makanan-basah')->first();
        $katering = Category::where('slug', 'menu-katering')->first();

        $menus = [
            // Lauk
            [
                'category_id' => $lauk->id,
                'name' => 'Ayam Geprek Sambal Bawang',
                'description' => 'Ayam goreng krispi dengan baluran sambal bawang pedas khas Kedai Agung',
                'price' => 18000,
                'image' => 'img/menu-1.jpg',
                'is_daily' => true,
                'is_popular' => true,
                'is_available' => true,
            ],
            [
                'category_id' => $lauk->id,
                'name' => 'Cincang Ayam Spesial',
                'description' => 'Cincang daging ayam gurih bumbu rempah tradisional padang',
                'price' => 20000,
                'image' => 'img/menu-2.jpg',
                'is_daily' => true,
                'is_popular' => true,
                'is_available' => true,
            ],
            [
                'category_id' => $lauk->id,
                'name' => 'Sarden Balado',
                'description' => 'Ikan sarden segar dipadukan dengan bumbu balado merah mantap',
                'price' => 15000,
                'image' => 'img/menu-3.jpg',
                'is_daily' => false,
                'is_popular' => false,
                'is_available' => true,
            ],
            [
                'category_id' => $lauk->id,
                'name' => 'Rendang Daging Sapi',
                'description' => 'Daging sapi pilihan dimasak empuk dengan santan dan rempah kelapa sangrai',
                'price' => 25000,
                'image' => 'img/menu-4.jpg',
                'is_daily' => true,
                'is_popular' => true,
                'is_available' => true,
            ],

            // Sarapan Pagi
            [
                'category_id' => $sarapan->id,
                'name' => 'Lontong Sayur Gulai Pakis',
                'description' => 'Lontong lembut berkuah santan gulai pakis gurih dengan telur balado',
                'price' => 14000,
                'image' => 'img/menu-5.jpg',
                'is_daily' => true,
                'is_popular' => true,
                'is_available' => true,
            ],
            [
                'category_id' => $sarapan->id,
                'name' => 'Nasi Gurih Komplit Telur Balado',
                'description' => 'Nasi uduk gurih wangi dengan sambal teri kacang, orek tempe, dan telur balado',
                'price' => 15000,
                'image' => 'img/menu-6.jpg',
                'is_daily' => true,
                'is_popular' => false,
                'is_available' => true,
            ],

            // Makanan Basah
            [
                'category_id' => $basah->id,
                'name' => 'Sop Daging Iga Sapi',
                'description' => 'Kuah kaldu bening gurih segar dengan iga empuk, wortel, dan kentang',
                'price' => 28000,
                'image' => 'img/menu-7.jpg',
                'is_daily' => true,
                'is_popular' => true,
                'is_available' => true,
            ],
            [
                'category_id' => $basah->id,
                'name' => 'Gulai Daun Singkong Teri',
                'description' => 'Daun singkong muda dimasak santan kuning bumbu gulai dan taburan teri',
                'price' => 10000,
                'image' => 'img/menu-8.jpg',
                'is_daily' => true,
                'is_popular' => false,
                'is_available' => true,
            ],

            // Menu Katering
            [
                'category_id' => $katering->id,
                'name' => 'Paket Nasi Kotak Ayam Bakar',
                'description' => 'Nasi putih, ayam bakar madu, tahu tempe bacem, lalapan, sambal terasi, kerupuk',
                'price' => 25000,
                'image' => 'img/menu-1.jpg',
                'is_daily' => false,
                'is_popular' => true,
                'is_available' => true,
            ],
            [
                'category_id' => $katering->id,
                'name' => 'Paket Nasi Kotak Rendang Komplit',
                'description' => 'Nasi putih, rendang sapi empuk, perkedel kentang, sayur gulai singkong, sambal ijo',
                'price' => 32000,
                'image' => 'img/menu-2.jpg',
                'is_daily' => false,
                'is_popular' => true,
                'is_available' => true,
            ],
        ];

        foreach ($menus as $m) {
            Menu::updateOrCreate(
                ['slug' => Str::slug($m['name'])],
                [
                    'category_id' => $m['category_id'],
                    'name' => $m['name'],
                    'description' => $m['description'],
                    'price' => $m['price'],
                    'image' => $m['image'],
                    'is_daily' => $m['is_daily'],
                    'is_popular' => $m['is_popular'],
                    'is_available' => $m['is_available'],
                ]
            );
        }
    }
}

