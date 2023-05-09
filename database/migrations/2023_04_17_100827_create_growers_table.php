<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrowersTable extends Migration
{
    public function up()
    {
        Schema::create('growers', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('code')->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('growers');
    }
}
