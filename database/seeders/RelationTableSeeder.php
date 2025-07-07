<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RelationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $relations = [
            'Father',
            'Mother',
            'Brother',
            'Sister',
            'Cousin',
            'Friends',
            'Husband',
            'Wife',
            'Uncle',
            'Aunty',
            'Daughter',
            'Son',
            'Other',
        ];

        foreach ($relations as $relation) {
            DB::table('relations')->insert([
                'name' => $relation,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
