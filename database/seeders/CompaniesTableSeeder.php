<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompaniesTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'company_name'   => 'Global Tech Ltd',
                'company_code'   => 'GT001',
                'start_date'     => '2020-01-01',
                'email'          => 'info@globaltech.com',
                'contact_number' => '0123456789',
                'alternate_number' => '0198765432',
                'country'        => 'Bangladesh',
                'district'       => 'Dhaka',
                'city'           => 'Dhaka',
                'zip_code'       => '1205',
                'owner_name'     => 'John Doe',
                'owner_number'   => '01711111111',
                'owner_email'    => 'owner@globaltech.com',
                'nid_no'         => '123456789',
                'nid_photo'      => null,
                'comments'       => 'Main Tech Partner',
                'checkbox'       => '1',
                'status'         => 'Active',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
