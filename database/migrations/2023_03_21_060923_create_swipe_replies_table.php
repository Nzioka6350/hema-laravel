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
        Schema::create('swipe_replies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->nullableUuidMorphs('swipe_repliable');
            $table->string('field');
            $table->string('field_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('swipe_replies');
    }
};
