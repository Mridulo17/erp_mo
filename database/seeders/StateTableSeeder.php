<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('states')->insert([
            [
                'country_id' => 1,
                'name' => 'CA',
                'code' => '123',
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'country_id' => 1,
                'name' => 'DA',
                'code' => '125',
                'status' => 'Active',
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 