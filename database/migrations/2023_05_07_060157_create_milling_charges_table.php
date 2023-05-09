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
        Schema::create('milling_charges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->integer('milling');
            $table->integer('handling');
            $table->integer('drying');
            $table->integer('export_bags');
            $table->integer('clean_coffee_transport');
            $table->integer('parchment_transport');
            $table->integer('advance');
            $table->integer('seedlings');
            $table->integer('machine_repair');
            $table->foreignUuid('quality_analysis_id')->nullable()->references('id')->on('quality_analyses');
            $table->foreignUuid('currency_id')->nullable()->references('id')->on('currencies');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milling_charges');
    }
};
