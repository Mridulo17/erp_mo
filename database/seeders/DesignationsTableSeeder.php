<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DesignationsTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('designations')->insert([
            [
                'company_id' => 1,
                'name' => 'Manager',
                'code' => 'MGR',
                'note' => null,
                'status' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 