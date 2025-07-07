<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('countries')->insert([
            ['name' => 'Bangladesh', 'country_code' => 'BD', 'phone_code' => '+880', 'status' => 'Active', 'continent_id' => 1, 'user_id' => 1],
            ['name' => 'India', 'country_code' => 'IN', 'phone_code' => '+91', 'status' => 'Active', 'continent_id' => 1, 'user_id' => 1],
            ['name' => 'Canada', 'country_code' => 'CA', 'phone_code' => '+1', 'status' => 'Active', 'continent_id' => 2, 'user_id' => 1],
            ['name' => 'United States', 'country_code' => 'US', 'phone_code' => '+1', 'status' => 'Active', 'continent_id' => 2, 'user_id' => 1],
            ['name' => 'United Kingdom', 'country_code' => 'GB', 'phone_code' => '+44', 'status' => 'Active', 'continent_id' => 3, 'user_id' => 1],
            ['name' => 'Australia', 'country_code' => 'AU', 'phone_code' => '+61', 'status' => 'Active', 'continent_id' => 4, 'user_id' => 1],
            ['name' => 'Germany', 'country_code' => 'DE', 'phone_code' => '+49', 'status' => 'Active', 'continent_id' => 3, 'user_id' => 1],
            ['name' => 'France', 'country_code' => 'FR', 'phone_code' => '+33', 'status' => 'Active', 'continent_id' => 3, 'user_id' => 1],
            ['name' => 'Italy', 'country_code' => 'IT', 'phone_code' => '+39', 'status' => 'Active', 'continent_id' => 3, 'user_id' => 1],
            ['name' => 'Brazil', 'country_code' => 'BR', 'phone_code' => '+55', 'status' => 'Active', 'continent_id' => 5, 'user_id' => 1],
        ]);
    }
}
