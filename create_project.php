<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Set authenticated user
$admin = \App\Models\User::where('email', 'admin@mail.com')->first();
if ($admin) {
    auth()->setUser($admin);
    echo "✓ Authenticated as: {$admin->name}\n";
}

// First, ensure we have companies
$ownerCompany = \App\Models\OwnerCompany::first();
if (!$ownerCompany) {
    $ownerCompany = \App\Models\OwnerCompany::create(['name' => 'Our Company Inc']);
}

$clientCompany = \App\Models\ClientCompany::first();
if (!$clientCompany) {
    $clientCompany = \App\Models\ClientCompany::create(['name' => 'Tech Solutions Inc']);
}

echo "✓ Using owner company: {$ownerCompany->name}\n";
echo "✓ Using client company: {$clientCompany->name}\n";

// Create project
$project = \App\Models\Project::create([
    'name' => 'Web Platform Development',
    'description' => 'Complete redesign and development of the web platform with modern technologies and best practices.',
    'owner_company_id' => $ownerCompany->id,
    'client_company_id' => $clientCompany->id,
    'pricing_type' => 'hourly',
    'hourly_rate' => 50.00,
]);

echo "✓ Created project: {$project->name} (ID: {$project->id})\n";

// Get all users and add them to the project
$users = \App\Models\User::all();
echo "\n✓ Adding users to project:\n";
foreach ($users as $user) {
    $project->users()->attach($user->id);
    echo "  - {$user->name}\n";
}

echo "\nProject created successfully!\n";
