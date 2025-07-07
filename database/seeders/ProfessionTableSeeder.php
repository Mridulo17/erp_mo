<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProfessionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $professionNames = [
            "Agriculture",
            "Air Ticket",
            "Airport Load & Unload",
            "Aramco project General Labour",
            "Business Visa",
            "Company Electrician",
            "Company CARPENTER",
            "Company Driver",
            "Company Meason",
            "Company Plumber",
            "Company ACCOUNTANT",
            "Company Welder",
            "Company University cleaner/Hospital cleaner",
            "Company General worker",
            "Company Painter",
            "Company LOADING & UNLOADING WORKER",
            "Company Coffee Shop",
            "Company Tabuk Mason",
            "Company Factory Worker",
            "Company Plantation",
            "Company Food Delivery",
            "Company Finishing carpenter",
            "Company mason",
            "Company HOSPITAL CLEANER",
            "Company CAR WASH CLEANER",
            "Company Bike Driver",
            "Company construction",
            "Company Construction labour",
            "Company AC TECHNICIAN",
            "Company Aluminium febricator",
            "COMPANY FACTORY WORKER Palm oil worker",
            "Engineer",
            "Factory Cleaner",
            "Factory Steal fixer",
            "Factory Labour",
            "Factory Driver",
            "Factory Food Packer",
            "Factory Cosmetics & Perfume",
            "Forklift Operator",
            "Free Visa",
            "Garments  Tailor",
            "Garments  Sewing Operator",
            "Garments  Worker",
            "Garments  Embroidery work",
            "Hazz",
            "House Maid (P)",
            "House Cook",
        ];

        foreach ($professionNames as $index => $name) {
            DB::table('professions')->insert([
                'name' => $name,
                'code' => 'P' . str_pad($index + 1, 4, '0', STR_PAD_LEFT), // Auto-generated code e.g. P0001
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
