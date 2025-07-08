<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RostersTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rosters')->insert([
            [
                'company_id' => 1,
                'name' => 'Default Roster',
                'code' => 'RST',
                'duty_hours' => 8,
                'start_time' => '09:00:00',
                'end_time' => '17:00:00',
                'meal_break' => 1,
                'note' => null,
                'status' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 