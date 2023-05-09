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
        Schema::create('employee_onboardings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->string('name');
            $table->date('date_of_joining');
            $table->boolean('notify');
            $table->boolean('aborted')->default(false);
            $table->foreignUuid('employee_id')->nullable()->references('id')->on('employees');
            $table->foreignUuid('user_id')->nullable()->references('id')->on('users');
            $table->foreignUuid('company_id')->nullable()->references('id')->on('companies');
            $table->foreignUuid('department_id')->nullable()->references('id')->on('departments');
            $table->foreignUuid('designation_id')->nullable()->references('id')->on('designations');
            $table->foreignUuid('holiday_list_id')->nullable()->references('id')->on('holiday_lists');

            $table->unique([
                'company_id',
                'user_id',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_onboardings');
    }
};
