<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->bigInteger('category_id');
            $table->string('product_type', 20);
            $table->double('price');
            $table->string('discount_type', 50)->nullable();
            $table->double('discount')->nullable()->default(0);
            $table->string('tax_type', 50)->nullable();
            $table->double('tax')->nullable()->default(0);
            $table->string('stock_type', 20)->nullable();
            $table->integer('stock')->nullable()->default(0);
            $table->tinyInteger('is_active')->default(true);
            $table->json('images');
            $table->time('available_time_start');
            $table->time('available_time_end');
            $table->tinyInteger('is_recommend')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
