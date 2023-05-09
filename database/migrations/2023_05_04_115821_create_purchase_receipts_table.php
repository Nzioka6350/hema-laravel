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
        Schema::create('purchase_receipts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // $table->foreignUuid('grower_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUuid('grower_id')->nullable()->references('id')->on('growers');
            $table->foreignUuid('coffee_bean_id')->nullable()->references('id')->on('coffee_beans');
            $table->integer('bags_in_outturn');
            $table->integer('bags_in_delivery');
            $table->string('delivery_vehicle_no');
            $table->string('store');
            $table->string('floor');
            $table->string('row');
            $table->string('bay');
            $table->string('bags_in');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase_receipts');
    }
};
