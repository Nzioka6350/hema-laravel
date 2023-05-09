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
        Schema::create('general_weighings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('outrun_no');
            $table->date('crop_year');
            $table->string('bags_weight_before');
            $table->string('bags_weight_after');
            $table->string('name_of_marketing');
            $table->foreignUuid('purchase_receipt_id')->nullable()->references('id')->on('purchase_receipts');
            $table->foreignUuid('milling_registration_id')->nullable()->references('id')->on('milling_registrations');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('general_weighings');
    }
};
