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
            UsersTableSeeder::class,
            RolesTableSeeder::class,
            ContinentsTableSeeder::class,
            CountriesTableSeeder::class,
            CandidateTypesTableSeeder::class,
            BloodGroupTableSeeder::class,
            GenderTableSeeder::class,
            ProfessionTableSeeder::class,
            RelationTableSeeder::class,
            ReligionTableSeeder::class,
            CurrencyTableSeeder::class,
            DivisionsTableSeeder::class,
            DistrictsTableSeeder::class,
            ThanasTableSeeder::class,
            BranchesTableSeeder::class,
            DepartmentsTableSeeder::class,
            DesignationsTableSeeder::class,
            RostersTableSeeder::class,
            EmployeesTableSeeder::class,
            AgentsTableSeeder::class,
            StateTableSeeder::class,
            PostOfficeTableSeeder::class,
            HowFindUsTableSeeder::class,
            TransactionPurposeTableSeeder::class
        ]);
    }
}
