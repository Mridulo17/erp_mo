<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ThanasTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('thanas')->insert([
            [
                'district_id' => 1,
                'code' => 'DHK',
                'name' => 'Dhanmondi',
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'district_id' => 2,
                'code' => 'CTG',
                'name' => 'Pahartali',
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 