<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id(); // Use a regular auto-incremental primary key
            $table->string('employee_code')->default('EMP-0000')->unique(); // Set a default value and make it unique
            $table->string('first_name');
            $table->string('last_name');
            $table->date('joining_date')->nullable();
            $table->string('profile_image')->nullable();
            $table->timestamps(); // Created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
