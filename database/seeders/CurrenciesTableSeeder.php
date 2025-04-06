<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    public function run()
    {
        $currencies = [
            [
                'code' => 'USD',
                'name' => 'US Dollar',
                'symbol' => '$',
                'rate' => 1.00,
                'decimal_places' => 2,
                'is_default' => true
            ],
            [
                'code' => 'EUR',
                'name' => 'Euro',
                'symbol' => '€',
                'rate' => 0.85,
                'decimal_places' => 2
            ],
            [
                'code' => 'GBP',
                'name' => 'British Pound',
                'symbol' => '£',
                'rate' => 0.75,
                'decimal_places' => 2
            ],
            [
                'code' => 'JPY',
                'name' => 'Japanese Yen',
                'symbol' => '¥',
                'rate' => 110.50,
                'decimal_places' => 0
            ],
            [
                'code' => 'CAD',
                'name' => 'Canadian Dollar',
                'symbol' => 'CA$',
                'rate' => 1.25,
                'decimal_places' => 2
            ]
        ];

        foreach ($currencies as $currency) {
            Currency::create($currency);
        }
    }
}