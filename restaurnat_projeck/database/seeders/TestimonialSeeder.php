<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $customer = User::where('role', 'customer')->first();

        $testimonials = [
            [
                'user_id' => $customer?->id,
                'customer_name' => 'Budi Santoso',
                'customer_title' => 'Koordinator Acara Kantor PT. Sentosa',
                'rating' => 5,
                'comment' => 'Pesan 150 box nasi katering untuk seminar kantor, rasanya mantap sekali! Ayam bumbu meresap, sambalnya pas, dan tepat waktu. Dapat bonus bolu juga yang lembut banget.',
                'photo' => 'img/testimonial-1.jpg',
                'is_active' => true,
            ],
            [
                'user_id' => null,
                'customer_name' => 'Hj. Mardiah',
                'customer_title' => 'Pelanggan Katering Tasyakuran',
                'rating' => 5,
                'comment' => 'Katering aqiqah dan tasyakuran keluarga kami serahkan ke CV. Kedai Agung. Masakan basah dan gulai cincangnya juara! Tamu-tamu banyak yang memuji.',
                'photo' => 'img/testimonial-2.jpg',
                'is_active' => true,
            ],
            [
                'user_id' => null,
                'customer_name' => 'Deni Prasetyo',
                'customer_title' => 'Pelanggan Setia Ampera Siang',
                'rating' => 5,
                'comment' => 'Langganan makan siang di Ampera Kedai Agung hampir setiap hari kerja. Pilihan lauknya lengkap, bersih, porsi mengenyangkan, dan harganya sangat bersahabat!',
                'photo' => 'img/testimonial-3.jpg',
                'is_active' => true,
            ],
            [
                'user_id' => null,
                'customer_name' => 'Siti Nurhaliza',
                'customer_title' => 'Panitia Reuni Akbar Alumni',
                'rating' => 5,
                'comment' => 'Pelayanan pemesanan via website sangat gampang dan transparan. Status pesanan terpantau jelas dari konfirmasi sampai tiba di lokasi gedung. Sangat direkomendasikan!',
                'photo' => 'img/testimonial-4.jpg',
                'is_active' => true,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(
                ['customer_name' => $t['customer_name']],
                $t
            );
        }
    }
}

