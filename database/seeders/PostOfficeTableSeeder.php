<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostOfficeTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('post_offices')->insert([
            [
                'district_id' => 1,
                'name' => 'Central Post',
                'code' => 'CPO',
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'district_id' => 2,
                'name' => 'West Post',
                'code' => 'WPO',
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 