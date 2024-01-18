<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\City;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create(['cities_name' => 'Palangkaraya', 'province_id' => 1]);
        City::create(['cities_name' => 'Balikpapan', 'province_id' => 2]);
    }
}
