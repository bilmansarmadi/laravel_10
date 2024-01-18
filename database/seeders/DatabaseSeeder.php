<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('m_users')->insert([
            'users_name' => 'John Doe',
            'users_email' => 'john.doe@example.com',
            'users_password' => Hash::make('password123'),
            'users_token' => '1234', // Sesuaikan dengan token yang sesuai
            'location' => '-8.640233,115.228221',
            'balance' => 100,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Tambahkan pengguna lain jika diperlukan
        DB::table('m_users')->insert([
            'users_name' => 'Jane Doe',
            'users_email' => 'jane.doe@example.com',
            'users_password' => Hash::make('password456'),
            'users_token' => '12345', // Sesuaikan dengan token yang sesuai
            'location' => '-7.123456,110.987654',
            'balance' => 150,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
