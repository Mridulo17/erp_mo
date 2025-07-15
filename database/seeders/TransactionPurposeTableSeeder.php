<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionPurposeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $purposes = [
            "Test Medical On Going",
            "Test Medical Report",
            "Training On Going",
            "Final Medical On Going",
            "Final Medical Report Delivery Date",
            "Final Medical Report",
            "Police Clearence",
            "Musaned Contact_0",
            "Bio Finger",
            "eVisa",
            "Wakala",
            "Finger of Tasheer Center",
            "Mufa",
            "Training card",
            "Manpower",
            "Apron"
        ];

        foreach ($purposes as $name) {
            DB::table('transaction_purposes')->insert([
                'name' => $name,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
