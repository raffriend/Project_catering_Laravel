<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('code')->nullable()->unique();
            $table->text('description')->nullable();
            $table->string('promo_type')->default('bonus'); // bonus, discount
            $table->integer('min_order_qty')->default(0); // Misal: 50 box
            $table->decimal('min_order_amount', 12, 2)->default(0);
            $table->string('bonus_description')->nullable(); // Misal: "1 Loyang Bolu"
            $table->decimal('discount_percent', 5, 2)->nullable();
            $table->decimal('discount_amount', 12, 2)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('promotions');
    }
};

