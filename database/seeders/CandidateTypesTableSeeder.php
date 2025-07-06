<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CandidateTypesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('candidate_types')->insert([
            ['name' => 'General', 'note' => 'General inquiry', 'status' => 1, 'company_id' => 1, 'user_id' => 1],
            ['name' => 'Support', 'note' => 'Support related', 'status' => 1, 'company_id' => 1, 'user_id' => 1],
            ['name' => 'Sales', 'note' => 'Sales candidate', 'status' => 1, 'company_id' => 1, 'user_id' => 1],
            ['name' => 'Inquiry', 'note' => 'Information inquiry', 'status' => 1, 'company_id' => 1, 'user_id' => 1],
            ['name' => 'Complaint', 'note' => 'Complaint case', 'status' => 1, 'company_id' => 1, 'user_id' => 1],
            ['name' => 'Other', 'note' => 'Other types', 'status' => 1, 'company_id' => 1, 'user_id' => 1],
            ['name' => 'Follow-up', 'note' => 'Follow-up inquiry', 'status' => 1, 'company_id' => 1, 'user_id' => 1],
            ['name' => 'Interview', 'note' => 'Interview process', 'status' => 1, 'company_id' => 1, 'user_id' => 1],
            ['name' => 'Referral', 'note' => 'Referred candidate', 'status' => 1, 'company_id' => 1, 'user_id' => 1],
            ['name' => 'VIP', 'note' => 'VIP candidate', 'status' => 1, 'company_id' => 1, 'user_id' => 1],
        ]);
    }
}
