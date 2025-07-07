<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            'company_id' => 1,                   // Adjust based on your existing company_id
            'guard_name'   => 'admin',             
            'name'       => 'admin',             
            'status'       => 1,
            'user_id'       => 1,
        ]);
    }
}
