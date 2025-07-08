<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\People\Agent;

class AgentsTableSeeder extends Seeder
{
    public function run(): void
    {
        Agent::insert([
            [
                'company_id' => 1,
                'branch_id' => 1,
                'first_name' => 'John',
                'last_name' => 'Doe',
                'agent_code' => 'AGT001',
                'phone_number' => '01710000001',
                'email' => 'john@example.com',
                'opening_balance' => 1000.00,
                'date_of_birth' => '1990-01-01',
                'take_registration_fee' => 1,
                'registration_fee_amount' => 500.00,
                'country_id' => 1,
                'division_id' => 1,
                'district_id' => 1,
                'thana_id' => 1,
                'employee_id' => 1,
                'user_id' => 1,
                'agent_photo' => null,
                'passport_scan_copy' => null,
                'attachment' => null,
                'opening_balance_sheet' => null,
                'current_address' => 'Dhaka, Bangladesh',
                'parmanent_address' => 'Dhaka, Bangladesh',
                'note' => 'Top agent',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 1,
                'branch_id' => 1,
                'first_name' => 'Jane',
                'last_name' => 'Smith',
                'agent_code' => 'AGT002',
                'phone_number' => '01710000002',
                'email' => 'jane@example.com',
                'opening_balance' => 2000.00,
                'date_of_birth' => '1992-02-02',
                'take_registration_fee' => 0,
                'registration_fee_amount' => 0.00,
                'country_id' => 1,
                'division_id' => 2,
                'district_id' => 2,
                'thana_id' => 2,
                'employee_id' => 1,
                'user_id' => 1,
                'agent_photo' => null,
                'passport_scan_copy' => null,
                'attachment' => null,
                'opening_balance_sheet' => null,
                'current_address' => 'Chittagong, Bangladesh',
                'parmanent_address' => 'Chittagong, Bangladesh',
                'note' => 'Handles Chittagong region',
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 