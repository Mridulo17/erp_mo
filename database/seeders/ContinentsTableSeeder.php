<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContinentsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('continents')->insert([
            ['id' => 1, 'code' => 'AS', 'name' => 'Asia', 'status' => 'Active', 'user_id' => 1],
            ['id' => 2, 'code' => 'NA', 'name' => 'North America', 'status' => 'Active', 'user_id' => 1],
            ['id' => 3, 'code' => 'EU', 'name' => 'Europe', 'status' => 'Active', 'user_id' => 1],
            ['id' => 4, 'code' => 'AU', 'name' => 'Australia', 'status' => 'Active', 'user_id' => 1],
            ['id' => 5, 'code' => 'SA', 'name' => 'South America', 'status' => 'Active', 'user_id' => 1],
            ['id' => 6, 'code' => 'AF', 'name' => 'Africa', 'status' => 'Active', 'user_id' => 1],
            ['id' => 7, 'code' => 'AN', 'name' => 'Antarctica', 'status' => 'Active', 'user_id' => 1],
        ]);
    }
}
