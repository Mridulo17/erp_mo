<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DivisionsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('divisions')->insert([
            [
                'country_id' => 1,
                'name' => 'Dhaka',
                'code' => 'DHK',
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'country_id' => 1,
                'name' => 'Chittagong',
                'code' => 'CTG',
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'country_id' => 1,
                'name' => 'Sylhet',
                'code' => 'SYL',
                'status' => 'Inactive',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 