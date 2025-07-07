<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReligionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            'Islam',
            'Hinduism',
            'Christianity',
            'Buddhism',
            'Judaism',
            'Not Specified',
            'Other',
        ];

        foreach ($religions as $religion) {
            DB::table('religions')->insert([
                'name' => $religion,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
