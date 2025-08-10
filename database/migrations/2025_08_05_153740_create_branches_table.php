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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('telp', 20);
            $table->string('email')->unique();
            $table->integer('preparation_time');
            $table->string('password');
            $table->string('branch_image');
            $table->text('address');
            $table->string('lat');
            $table->string('lng');
            $table->integer('coverage');
            $table->tinyInteger('status')->default(1);
            $table->tinyInteger('promotion_campaign')->default(1);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
