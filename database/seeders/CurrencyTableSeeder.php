<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            ["id" => 3, "text" => "Afghanistan - Afghanis (AFN)"],
            ["id" => 1, "text" => "Albania - Leke (ALL)"],
            ["id" => 2, "text" => "American Samoa - Dollars (USD)"],
            ["id" => 4, "text" => "Argentina - Pesos (ARS)"],
            ["id" => 5, "text" => "Aruba - Guilders (AWG)"],
            ["id" => 6, "text" => "Australia - Dollars (AUD)"],
            ["id" => 7, "text" => "Azerbaijan - New Manats (AZN)"],
            ["id" => 8, "text" => "Bahamas - Dollars (BSD)"],
            ["id" => 133, "text" => "Bangladesh - Taka (BDT)"],
            ["id" => 9, "text" => "Barbados - Dollars (BBD)"],
            ["id" => 11, "text" => "Belgium - Euro (EUR)"],
            ["id" => 12, "text" => "Belize - Dollars (BZD)"],
            ["id" => 13, "text" => "Bermuda - Dollars (BMD)"],
            ["id" => 14, "text" => "Bolivia - Bolivianos (BOB)"],
            ["id" => 15, "text" => "Bosnia and Herzegovina - Convertible Marka (BAM)"],
            ["id" => 16, "text" => "Botswana - Pula (BWP)"],
            ["id" => 18, "text" => "Brazil - Reais (BRL)"],
            ["id" => 20, "text" => "Brunei Darussalam - Dollars (BND)"],
            ["id" => 17, "text" => "Bulgaria - Leva (BGN)"],
            ["id" => 21, "text" => "Cambodia - Riels (KHR)"],
            ["id" => 34, "text" => "Cameroon - Dollars (XCD)"],
            ["id" => 22, "text" => "Canada - Dollars (CAD)"],
            ["id" => 23, "text" => "Cayman Islands - Dollars (KYD)"],
            ["id" => 24, "text" => "Chile - Pesos (CLP)"],
            ["id" => 25, "text" => "China - Yuan Renminbi (CNY)"],
            ["id" => 26, "text" => "Colombia - Pesos (COP)"],
            ["id" => 27, "text" => "Costa Rica - Colón (CRC)"],
            ["id" => 28, "text" => "Croatia - Kuna (HRK)"],
            ["id" => 29, "text" => "Cuba - Pesos (CUP)"],
            ["id" => 30, "text" => "Cyprus - Euro (EUR)"],
            ["id" => 31, "text" => "Czech Republic - Koruny (CZK)"],
            ["id" => 32, "text" => "Denmark - Kroner (DKK)"],
            ["id" => 33, "text" => "Dominican Republic - Pesos (DOP )"],
            ["id" => 35, "text" => "Egypt - Pounds (EGP)"],
            ["id" => 36, "text" => "El Salvador - Colones (SVC)"],
            ["id" => 39, "text" => "Falkland Islands (Malvinas) - Pounds (FKP)"],
            ["id" => 41, "text" => "France - Euro (EUR)"],
            ["id" => 44, "text" => "Greece - Euro (EUR)"],
            ["id" => 127, "text" => "Holy See (Vatican City State) - Euro (EUR)"],
            ["id" => 132, "text" => "India - Rupees (INR)"],
            ["id" => 56, "text" => "Ireland - Euro (EUR)"],
            ["id" => 59, "text" => "Italy - Euro (EUR)"],
            ["id" => 61, "text" => "Japan - Yen (JPY)"],
            ["id" => 134, "text" => "Jordan - Dinar (JOD)"],
            ["id" => 73, "text" => "Luxembourg - Euro (EUR)"],
            ["id" => 75, "text" => "Malaysia - Ringgits (MYR)"],
            ["id" => 76, "text" => "Malta - Euro (EUR)"],
            ["id" => 48, "text" => "Netherlands - Euro (EUR)"],
            ["id" => 90, "text" => "Oman - Rials (OMR)"],
            ["id" => 38, "text" => "Reunion - Euro (EUR)"],
        ];
        $countryIds = DB::table('countries')->pluck('id')->toArray();
        foreach ($currencies as $currency) {
            // Extract values
            preg_match('/^(.*?)\s+-\s+(.*?)\s+\((.*?)\)$/', $currency['text'], $matches);
            if (count($matches) === 4) {
                DB::table('currencies')->insert([
                    'country_id' => fake()->randomElement($countryIds),
                    'name'       => $matches[2],
                    'code'       => $matches[3],
                    'symbol'     => '', 
                    'status'     => 'Active',
                    'user_id'    => 1, 
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
