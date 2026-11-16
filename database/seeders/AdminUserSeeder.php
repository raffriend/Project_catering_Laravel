<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Akun Pemilik (Owner) - Full Fitur
        User::updateOrCreate(
            ['email' => 'pemilik@kedaiagung.com'],
            [
                'name' => 'H. Agung (Pemilik)',
                'password' => Hash::make('admin123'),
                'phone' => '081234567890',
                'address' => 'Jl. Kedai Agung No. 1, Kota',
                'role' => 'owner',
            ]
        );

        // Akun Admin (alias Pemilik)
        User::updateOrCreate(
            ['email' => 'admin@kedaiagung.com'],
            [
                'name' => 'Administrator Kedai Agung',
                'password' => Hash::make('admin123'),
                'phone' => '081234567891',
                'address' => 'Jl. Kedai Agung No. 1, Kota',
                'role' => 'admin',
            ]
        );

        // 2. Akun Kasir / Karyawan Kasir
        User::updateOrCreate(
            ['email' => 'kasir@kedaiagung.com'],
            [
                'name' => 'Siti Rahma (Kasir)',
                'password' => Hash::make('kasir123'),
                'phone' => '081299887766',
                'address' => 'Jl. Mawar No. 4, Kota',
                'role' => 'cashier',
            ]
        );

        // 3. Akun Pelanggan
        $customerUser = User::updateOrCreate(
            ['email' => 'pelanggan@gmail.com'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('pelanggan123'),
                'phone' => '089876543210',
                'address' => 'Jl. Melati No. 15, Komp. Griya Indah, Kota',
                'role' => 'customer',
            ]
        );

        // Pastikan customer profile terbuat
        Customer::updateOrCreate(
            ['phone' => '089876543210'],
            [
                'user_id' => $customerUser->id,
                'name' => 'Budi Santoso',
                'email' => 'pelanggan@gmail.com',
                'address' => 'Jl. Melati No. 15, Komp. Griya Indah, Kota',
                'customer_type' => 'individual',
                'is_regular' => true,
            ]
        );
    }
}
