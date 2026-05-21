<?php

namespace Database\Seeders;

use App\Models\ClientCompany;
use App\Models\User;
use Illuminate\Database\Seeder;

class ClientCompanySeeder extends Seeder
{
    public function run(): void
    {
        // Client Company 1
        $company1 = ClientCompany::create([
            'name' => 'TechStart Inc',
            'address' => '456 Innovation Ave',
            'postal_code' => '94105',
            'city' => 'San Francisco',
            'country_id' => 1,
            'currency_id' => 1,
            'email' => 'contact@techstart.com',
            'phone' => '+1-555-0301',
            'web' => 'https://techstart.com',
            'iban' => 'US89 3704 0044 0532 0130 01',
            'swift' => 'CHASUS33',
            'business_id' => 'BID-2023-101',
            'tax_id' => 'TAX-2023-101',
            'vat' => 'VAT-2023-101',
        ]);

        // Client Company 2
        $company2 = ClientCompany::create([
            'name' => 'GlobalTrade Solutions',
            'address' => '789 Commerce Blvd',
            'postal_code' => '60601',
            'city' => 'Chicago',
            'country_id' => 1,
            'currency_id' => 1,
            'email' => 'hello@globaltrade.com',
            'phone' => '+1-555-0302',
            'web' => 'https://globaltrade.com',
            'iban' => 'US89 3704 0044 0532 0130 02',
            'swift' => 'CHASUS33',
            'business_id' => 'BID-2023-102',
            'tax_id' => 'TAX-2023-102',
            'vat' => 'VAT-2023-102',
        ]);

        // Client Company 3
        $company3 = ClientCompany::create([
            'name' => 'Creative Studio Pro',
            'address' => '321 Design Lane',
            'postal_code' => '10010',
            'city' => 'New York',
            'country_id' => 1,
            'currency_id' => 1,
            'email' => 'team@creativestudio.com',
            'phone' => '+1-555-0303',
            'web' => 'https://creativestudio.com',
            'iban' => 'US89 3704 0044 0532 0130 03',
            'swift' => 'CHASUS33',
            'business_id' => 'BID-2023-103',
            'tax_id' => 'TAX-2023-103',
            'vat' => 'VAT-2023-103',
        ]);

        // Attach client users to companies
        $client1 = User::where('email', 'client1@example.com')->first();
        $client2 = User::where('email', 'client2@example.com')->first();

        $company1->clients()->attach($client1);
        $company2->clients()->attach($client2);
        $company3->clients()->attach($client1);
    }
}
