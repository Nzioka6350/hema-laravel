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
        Schema::create('coffee_bean_coffee_grade', function (Blueprint $table) {
            $table->foreignUuid('coffee_bean_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignUuid('coffee_grade_id')->nullable()->constrained()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coffee_bean_coffee_grade');
    }
};
