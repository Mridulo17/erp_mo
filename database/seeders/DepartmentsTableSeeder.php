<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartmentsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('departments')->insert([
            [
                'company_id' => 1,
                'name' => 'HR',
                'code' => 'HR',
                'include_status' => '1',
                'bonous_type' => null,
                'bonous_amount' => null,
                'note' => null,
                'status' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 