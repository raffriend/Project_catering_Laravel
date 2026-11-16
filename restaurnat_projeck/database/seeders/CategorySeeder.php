<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Lauk Pauk',
                'description' => 'Aneka pilihan lauk lezat khas rumah makan',
                'image' => 'img/menu-1.jpg',
            ],
            [
                'name' => 'Sarapan Pagi',
                'description' => 'Menu sarapan pagi segar dan berenergi mulai jam 08.00',
                'image' => 'img/menu-2.jpg',
            ],
            [
                'name' => 'Makanan Basah',
                'description' => 'Sayur berkuah, gulai, dan aneka masakan basah kaya rasa',
                'image' => 'img/menu-3.jpg',
            ],
            [
                'name' => 'Menu Katering',
                'description' => 'Pilihan menu katering untuk acara dan langganan harian',
                'image' => 'img/menu-4.jpg',
            ],
        ];

        foreach ($categories as $cat) {
            Category::updateOrCreate(
                ['slug' => Str::slug($cat['name'])],
                [
                    'name' => $cat['name'],
                    'description' => $cat['description'],
                    'image' => $cat['image'],
                    'is_active' => true,
                ]
            );
        }
    }
}

