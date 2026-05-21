<?php

namespace Database\Seeders;

use App\Models\OwnerCompany;
use Illuminate\Database\Seeder;

class OwnerCompanySeeder extends Seeder
{
    public function run(): void
    {
        OwnerCompany::create([
            'name' => 'CollabX Agency',
            'address' => '123 Tech Street',
            'postal_code' => '10001',
            'city' => 'New York',
            'country_id' => 1, // Assuming USA is ID 1
            'currency_id' => 1, // Assuming USD is ID 1
            'email' => 'info@collabx-agency.com',
            'phone' => '+1-555-0100',
            'web' => 'https://collabx-agency.com',
            'iban' => 'US89 3704 0044 0532 0130 00',
            'swift' => 'CHASUS33',
            'business_id' => 'BID-2023-001',
            'tax_id' => 'TAX-2023-001',
            'vat' => 'VAT-2023-001',
        ]);
    }
}
