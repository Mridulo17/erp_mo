<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BranchesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('branches')->insert([
            [
                'company_id' => 1,
                'name' => 'Main Branch',
                'code' => 'BR001',
                'phone' => '0123456789',
                'email' => 'branch@example.com',
                'picture' => null,
                'address' => 'Dhaka',
                'note' => null,
                'status' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 