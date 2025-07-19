<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('districts')->insert([
            [
                'division_id' => 1,
                'name' => 'Dhaka',
                'code' => 'DHK',
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'division_id' => 2,
                'name' => 'Chittagong',
                'code' => 'CTG',
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 