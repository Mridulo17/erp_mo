<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HowFindUsTableSeeder extends Seeder
{
    public function run()
    {
        $options = [
            'Listen from neighbor',
            'Walking Candidate',
            'Online Marketing link',
            'News Paper',
            'Google',
            'Facebook',
            'Instagram',
            'Linkedin',
            'TikTok',
            'SMS',
            'WhatsApp',
            'Telegram',
            'Youtube',
            'Parents',
            'TVC',
            'Friends',
            'Colleague',
            'I do not Know',
            'Other',
        ];
        foreach ($options as $option) {
            DB::table('how_find_us')->insert([
                'name' => $option,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
} 