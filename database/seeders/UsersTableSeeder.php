<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Admin principal
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'preferred_language' => 'fr',
            'default_currency_id' => 1, // USD
            'email_verified_at' => now()
        ]);

        // Staff 1
        User::create([
            'name' => 'Employé Commercial',
            'email' => 'staff1@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'preferred_language' => 'fr',
            'default_currency_id' => 2, // EUR
            'email_verified_at' => now()
        ]);

        // Staff 2
        User::create([
            'name' => 'Assistante Comptable',
            'email' => 'staff2@example.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'preferred_language' => 'en',
            'default_currency_id' => 1, // USD
            'email_verified_at' => now()
        ]);
    }
}