<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@collabx.test',
            'password' => Hash::make('password'),
            'job_title' => 'Project Manager',
            'phone' => '+1-555-0100',
            'rate' => 150,
            'email_verified_at' => now(),
        ]);
        $admin->assignRole('admin');

        // Developer/Worker users
        $developer1 = User::create([
            'name' => 'John Developer',
            'email' => 'john@collabx.test',
            'password' => Hash::make('password'),
            'job_title' => 'Senior Developer',
            'phone' => '+1-555-0101',
            'rate' => 120,
            'email_verified_at' => now(),
        ]);
        $developer1->assignRole('developer');

        $developer2 = User::create([
            'name' => 'Sarah Designer',
            'email' => 'sarah@collabx.test',
            'password' => Hash::make('password'),
            'job_title' => 'UI/UX Designer',
            'phone' => '+1-555-0102',
            'rate' => 100,
            'email_verified_at' => now(),
        ]);
        $developer2->assignRole('developer');

        $developer3 = User::create([
            'name' => 'Mike QA Engineer',
            'email' => 'mike@collabx.test',
            'password' => Hash::make('password'),
            'job_title' => 'QA Engineer',
            'phone' => '+1-555-0103',
            'rate' => 90,
            'email_verified_at' => now(),
        ]);
        $developer3->assignRole('developer');

        // Client users
        User::create([
            'name' => 'Client Manager 1',
            'email' => 'client1@example.com',
            'password' => Hash::make('password'),
            'job_title' => 'Project Lead',
            'phone' => '+1-555-0201',
            'rate' => 0,
            'email_verified_at' => now(),
        ])->assignRole('client');

        User::create([
            'name' => 'Client Manager 2',
            'email' => 'client2@example.com',
            'password' => Hash::make('password'),
            'job_title' => 'Business Analyst',
            'phone' => '+1-555-0202',
            'rate' => 0,
            'email_verified_at' => now(),
        ])->assignRole('client');
    }
}
