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
        Schema::create('grade_weighings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('bags');
            $table->integer('pockets');
            $table->string('classification');
            $table->string('bulk_outturns');
            $table->foreignUuid('purchase_receipt_id')->nullable()->references('id')->on('purchase_receipts');
            $table->foreignUuid('general_weighing_id')->nullable()->references('id')->on('general_weighings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grade_weighings');
    }
};
