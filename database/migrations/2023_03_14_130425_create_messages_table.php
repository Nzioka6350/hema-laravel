<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('msg_id')->nullable();
            $table->enum('type', ['text', 'audio', 'image', 'video', 'sticker', 'document', 'contacts', 'interactive']);
            // $table->foreignId('contact_id')->nullable()->references('id')->on('contacts');
            $table->boolean('preview_url')->nullable()->default(null);
            $table->boolean('incoming')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
};