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
        Schema::create('quality_analyses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('liqour');
            $table->string('moisture');
            $table->string('defects');
            $table->string('roast');
            $table->foreignUuid('grade_weighing_id')->nullable()->references('id')->on('grade_weighings');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quality_analyses');
    }
};
