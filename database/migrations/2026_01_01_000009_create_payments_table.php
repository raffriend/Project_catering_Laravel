<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->string('payment_number')->unique(); // e.g. PAY-20261109-001
            $table->decimal('amount', 12, 2);
            $table->string('payment_method'); // cash, transfer, qris
            $table->string('payment_type')->default('full'); // dp, pelunasan, full
            $table->string('proof_image')->nullable();
            $table->string('status')->default('menunggu_konfirmasi'); // menunggu_konfirmasi, diterima, ditolak
            $table->dateTime('payment_date');
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->dateTime('verified_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

