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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call([
            BloodGroupTableSeeder::class,
            GenderTableSeeder::class,
            ProfessionTableSeeder::class,
            RelationTableSeeder::class,
            ReligionTableSeeder::class,
            // Add other seeders here
        ]);
    }
}
