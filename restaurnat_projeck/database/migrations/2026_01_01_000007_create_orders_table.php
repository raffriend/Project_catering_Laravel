<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique(); // ID Pesanan Unik, e.g. ORD-20261109-001
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('order_type')->default('catering'); // catering_harian, catering_acara, reguler
            
            // Pengiriman & Kontak
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->text('delivery_address');
            $table->date('delivery_date');
            $table->time('delivery_time');
            
            // Finansial
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('discount_amount', 12, 2)->default(0);
            $table->decimal('total_amount', 12, 2)->default(0);
            
            // Status
            // Status Pesanan: masuk, dikonfirmasi, diproses, dikirim, selesai, dibatalkan
            $table->string('status')->default('masuk');
            // Status Pembayaran: belum_bayar, dp, lunas
            $table->string('payment_status')->default('belum_bayar');
            
            // Catatan & Promo
            $table->text('notes')->nullable();
            $table->foreignId('promotion_id')->nullable()->constrained('promotions')->onDelete('set null');
            $table->string('bonus_info')->nullable(); // e.g. "Mendapatkan 1 Loyang Bolu"
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

