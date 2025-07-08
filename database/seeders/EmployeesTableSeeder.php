<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('employees')->insert([
            [
                'company_id' => 1,
                'branch_id' => 1,
                'first_name' => 'Employee',
                'last_name' => 'One',
                'employee_code' => 'EMP001',
                'religion' => 'Islam',
                'gender' => 'Male',
                'marital_status' => 'Single',
                'date_of_birth' => '1990-01-01',
                'date_of_joining' => '2020-01-01',
                'blood_group' => 'A+',
                'personal_phone' => '01710000001',
                'personal_email' => 'employee1@example.com',
                'contact_person_number' => '01710000002',
                'photo' => null,
                'office_phone' => '01710000003',
                'office_email' => 'employee1office@example.com',
                'nid_number' => '1234567890',
                'current_address' => 'Dhaka',
                'permanent_address' => 'Dhaka',
                'note' => null,
                'role_id' => 1,
                'department_id' => 1,
                'designation_id' => 1,
                'roster_id' => 1,
                'basic_salary_monthly' => 10000.00,
                'basic_salary_daily' => 400.00,
                'mobile_allowance' => 500.00,
                'salary_pay_method' => 'Bank',
                'contract_type' => 'Permanent',
                'access_card' => null,
                'white_list' => 0,
                'weekend_day' => 'Friday',
                'status' => 1,
                'user_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
} 