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
        Schema::create('milling_registrations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name_of_miller');
            $table->string('physical_address');
            $table->date('month');
            $table->dateTime('milling_date');
            $table->foreignUuid('grower_id')->nullable()->references('id')->on('growers');
            $table->foreignUuid('purchase_receipt_id')->nullable()->references('id')->on('purchase_receipts');
            $table->foreignUuid('company_profile_id')->nullable()->references('id')->on('company_profiles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milling_registrations');
    }
};
