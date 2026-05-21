<?php

namespace Database\Seeders;

use App\Models\OwnerCompany;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class ProductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin credentials are provided
        $adminEmail = config('auth.admin.email');
        $adminName = config('auth.admin.name');
        $adminPassword = config('auth.admin.password');

        if (!empty($adminEmail) && !empty($adminPassword)) {
            // Create admin user only if credentials are provided
            $admin = User::create([
                'email' => $adminEmail,
                'name' => $adminName ?: 'Administrator',
                'phone' => '',
                'rate' => 0,
                'job_title' => 'Owner',
                'avatar' => null,
                'password' => bcrypt($adminPassword),
                'remember_token' => null,
            ]);
            
            $admin->assignRole(Role::firstWhere('name', 'admin'));
        } else {
            // If no admin credentials provided, create a default admin
            $admin = User::firstOrCreate(
                ['email' => 'admin@collabx.local'],
                [
                    'name' => 'Administrator',
                    'phone' => '',
                    'rate' => 0,
                    'job_title' => 'Owner',
                    'avatar' => null,
                    'password' => bcrypt('admin@123'),
                    'remember_token' => null,
                ]
            );
            
            if (!$admin->hasRole('admin')) {
                $admin->assignRole(Role::firstWhere('name', 'admin'));
            }
        }

        // Check if second admin credentials are provided
        $admin2Email = config('auth.admin2.email');
        $admin2Name = config('auth.admin2.name');
        $admin2Password = config('auth.admin2.password');

        if (!empty($admin2Email) && !empty($admin2Password)) {
            // Create second admin user if credentials are provided
            $admin2 = User::create([
                'email' => $admin2Email,
                'name' => $admin2Name ?: 'Administrator',
                'phone' => '',
                'rate' => 0,
                'job_title' => 'Owner',
                'avatar' => null,
                'password' => bcrypt($admin2Password),
                'remember_token' => null,
            ]);
            
            $admin2->assignRole(Role::firstWhere('name', 'admin'));
        }

        OwnerCompany::firstOrCreate(
            ['id' => 1],
            [
                'name' => '',
                'logo' => null,
                'address' => '',
                'postal_code' => '',
                'city' => '',
                'country_id' => null,
                'currency_id' => 97,
                'phone' => '',
                'web' => '',
                'tax' => 0,
                'email' => '',
                'iban' => '',
                'swift' => '',
                'business_id' => '',
                'tax_id' => '',
                'vat' => '',
            ]
        );
    }
}
