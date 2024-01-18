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
        Schema::create('employees', function (Blueprint $table) {
        $table->id();
        $table->string('first_name');
        $table->string('last_name');
        $table->date('date_of_birth');
        $table->string('phone_number');
        $table->string('email')->unique();
        $table->unsignedBigInteger('province_id');
        $table->unsignedBigInteger('city_id');
        $table->string('street_address');
        $table->string('zip_code');
        $table->string('ktp_number')->unique();
        $table->unsignedBigInteger('position_id');
        $table->unsignedBigInteger('bank_id');
        $table->string('bank_account_number');
        $table->string('image_path')->nullable();
        $table->foreign('position_id')->references('id')->on('positions');
        $table->foreign('province_id')->references('id')->on('provinces');
        $table->foreign('city_id')->references('id')->on('cities');
        $table->foreign('bank_id')->references('id')->on('banks');
        $table->timestamps();
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
