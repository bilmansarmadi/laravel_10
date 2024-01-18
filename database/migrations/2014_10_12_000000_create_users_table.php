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
        Schema::create('m_users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('users_name', 100);
            $table->string('users_email', 100)->unique();
            $table->string('users_password', 100); // Anda mungkin ingin menggunakan Hash::make() pada Laravel untuk mengenkripsi password
            $table->string('users_token')->nullable()->unique("users_token_unique");
            $table->string('location', 100); // Tipe data POINT untuk menyimpan lokasi
            $table->integer('balance')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('m_users');
    }
};
