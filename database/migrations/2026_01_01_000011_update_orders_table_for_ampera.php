<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->text('delivery_address')->nullable()->change();
            $table->date('delivery_date')->nullable()->change();
            $table->time('delivery_time')->nullable()->change();
            $table->decimal('cash_received', 12, 2)->nullable()->after('total_amount');
            $table->decimal('change_amount', 12, 2)->nullable()->after('cash_received');
        });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['cash_received', 'change_amount']);
        });
    }
};

