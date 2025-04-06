<?php

namespace Database\Seeders;

use App\Models\Client;
use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        $clients = [
            [
                'name' => 'Acme Corporation',
                'email' => 'contact@acme.com',
                'phone' => '+1 555 123 4567',
                'address_line_1' => '123 Main Street',
                'city' => 'New York',
                'state_province' => 'NY',
                'postal_code' => '10001',
                'country' => 'USA',
                'tax_number' => 'US123456789',
                'preferred_currency_id' => 1, // USD
                'preferred_language' => 'en'
            ],
            [
                'name' => 'Entreprise Dubois',
                'email' => 'compta@dubois.fr',
                'phone' => '+33 1 23 45 67 89',
                'address_line_1' => '45 Rue de la Paix',
                'city' => 'Paris',
                'state_province' => 'Île-de-France',
                'postal_code' => '75002',
                'country' => 'France',
                'tax_number' => 'FR12345678901',
                'preferred_currency_id' => 2, // EUR
                'preferred_language' => 'fr'
            ],
            [
                'name' => 'Tech Solutions Ltd',
                'email' => 'accounts@techsolutions.co.uk',
                'phone' => '+44 20 1234 5678',
                'address_line_1' => '88 Tech Park',
                'city' => 'London',
                'state_province' => 'England',
                'postal_code' => 'SW1A 1AA',
                'country' => 'UK',
                'tax_number' => 'GB123456789',
                'preferred_currency_id' => 3, // GBP
                'preferred_language' => 'en'
            ]
        ];

        foreach ($clients as $client) {
            Client::create($client);
        }
    }
}