<?php

namespace Database\Seeders;

use App\Models\Admin\Profession;
use App\Models\Admin\Relation;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CompaniesTableSeeder::class,
            UserTableSeeder::class,
            RoleTableSeeder::class,
            ContinentsTableSeeder::class,
            CountriesTableSeeder::class,
            CandidateTypesTableSeeder::class,
            BloodGroupTableSeeder::class,
            GenderTableSeeder::class,
            ProfessionTableSeeder::class,
            RelationTableSeeder::class,
            ReligionTableSeeder::class,
        ]);
    }
}
