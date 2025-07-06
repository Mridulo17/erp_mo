<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GenderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $genders = [
            'Male',
            'Female',
            'Haji',
            'Transgender',
            'Neutralgender',
            'NON-binary',
            'Agender',
            'Pangender',
            'Genderqueer',
            'Two-spirit',
            'Third gender',
            'None',
        ];

        foreach ($genders as $gender) {
            DB::table('genders')->insert([
                'name' => $gender,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
