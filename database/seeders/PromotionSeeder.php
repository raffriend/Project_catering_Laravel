<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    public function run(): void
    {
        $promos = [
            [
                'title' => 'Bonus 1 Loyang Bolu Spesial',
                'code' => 'BOLU50',
                'description' => 'Pesan minimal 50 box katering mendapatkan GRATIS 1 loyang bolu spesial khas CV. Kedai Agung.',
                'promo_type' => 'bonus',
                'min_order_qty' => 50,
                'min_order_amount' => 1000000,
                'bonus_description' => 'Gratis 1 Loyang Bolu Panggang Lembut',
                'discount_percent' => null,
                'discount_amount' => null,
                'start_date' => Carbon::now()->subDays(10)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(6)->format('Y-m-d'),
                'is_active' => true,
            ],
            [
                'title' => 'Diskon Pembukaan 10%',
                'code' => 'KEDAI10',
                'description' => 'Dapatkan potongan harga 10% untuk pemesanan katering dengan minimal belanja Rp 500.000.',
                'promo_type' => 'discount',
                'min_order_qty' => 20,
                'min_order_amount' => 500000,
                'bonus_description' => null,
                'discount_percent' => 10,
                'discount_amount' => null,
                'start_date' => Carbon::now()->subDays(5)->format('Y-m-d'),
                'end_date' => Carbon::now()->addMonths(3)->format('Y-m-d'),
                'is_active' => true,
            ],
        ];

        foreach ($promos as $promo) {
            Promotion::updateOrCreate(
                ['code' => $promo['code']],
                $promo
            );
        }
    }
}

