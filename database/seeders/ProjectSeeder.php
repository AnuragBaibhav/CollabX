<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\ClientCompany;
use App\Enums\PricingType;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        // Project 1 - TechStart Inc
        $project1 = Project::create([
            'name' => 'E-Commerce Platform Redesign',
            'description' => 'Complete redesign of the e-commerce platform with modern UI/UX and performance improvements',
            'client_company_id' => ClientCompany::where('name', 'TechStart Inc')->first()->id,
            'default_pricing_type' => PricingType::HOURLY,
            'rate' => 150,
        ]);

        // Project 2 - GlobalTrade Solutions
        $project2 = Project::create([
            'name' => 'Inventory Management System',
            'description' => 'Development of a comprehensive inventory management system with real-time tracking',
            'client_company_id' => ClientCompany::where('name', 'GlobalTrade Solutions')->first()->id,
            'default_pricing_type' => PricingType::FIXED,
            'rate' => 5000,
        ]);

        // Project 3 - Creative Studio Pro
        $project3 = Project::create([
            'name' => 'Mobile App Development',
            'description' => 'Native iOS and Android app for creative project management',
            'client_company_id' => ClientCompany::where('name', 'Creative Studio Pro')->first()->id,
            'default_pricing_type' => PricingType::HOURLY,
            'rate' => 120,
        ]);

        // Assign developers to projects
        $developers = \App\Models\User::role('developer')->get();
        
        $project1->users()->attach($developers);
        $project2->users()->attach($developers);
        $project3->users()->attach($developers);
    }
}
