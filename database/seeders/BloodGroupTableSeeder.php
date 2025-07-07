<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BloodGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bloodGroups = [
            'A+',
            'A-',
            'B+',
            'B-',
            'O+',
            'O-',
            'AB+',
            'AB-',
            'N/A',
            'Unknown',
        ];

        foreach ($bloodGroups as $group) {
            DB::table('blood_groups')->insert([
                'name' => $group,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
