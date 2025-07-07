<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run(): void
    {
         DB::table('users')->insert([
            'company_id' => 1,                   // Adjust based on your existing company_id
            'username'   => 'admin',             
            'name'       => 'Admin',             
            'role'       => 'admin',             
            'email'      => 'admin@gmail.com',   
            'email_verified_at' => now(),
            'password'   => Hash::make('12345678'),
            'remember_token' => null,
            'isActive'   => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
