<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoffeeBeansTable extends Migration
{
    public function up()
    {
        Schema::create('coffee_beans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            // $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('coffee_beans');
    }
}
