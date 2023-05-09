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
        Schema::create('join_invites', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('email');
            $table->integer('revokes_in')->nullable();
            $table->boolean('revoked')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('join_invites');
    }
};
