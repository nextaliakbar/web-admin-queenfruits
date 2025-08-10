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
        Schema::create('delivery_charge_setups', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('branch_id');
            $table->string('delivery_charge_type');
            $table->double('delivery_charge_per_km')->nullable();
            $table->double('minimum_delivery_charge')->nullable();
            $table->double('maximum_distance_for_free_delivery')->nullable();
            $table->double('fixed_delivery_charge')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delivery_charge_setups');
    }
};
