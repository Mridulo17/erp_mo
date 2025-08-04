<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtherOfficeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('other_offices')->insert([
            ['id' => 1, 'name' => 'Air Arabia', 'budget_carrier' => 'Enabled', 'status' => 'Active'],
            ['id' => 2, 'name' => 'Thai Air Asia', 'budget_carrier' => 'Enabled', 'status' => 'Active'],
            ['id' => 3, 'name' => 'Air Asia', 'budget_carrier' => 'Enabled', 'status' => 'Active'],
            ['id' => 4, 'name' => 'IndiGo', 'budget_carrier' => 'Enabled', 'status' => 'Active'],
            ['id' => 5, 'name' => 'Fly Dubai', 'budget_carrier' => 'Enabled', 'status' => 'Active'],
            ['id' => 6, 'name' => 'Salam Air', 'budget_carrier' => 'Enabled', 'status' => 'Active']
           ]);
    }
}
