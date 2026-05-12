<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$companies = \App\Models\OwnerCompany::limit(5)->get();
echo "Available Companies:\n";

if($companies->isEmpty()) {
    echo "  Creating companies...\n";
    $company1 = \App\Models\OwnerCompany::create(['name' => 'Tech Solutions Inc']);
    $company2 = \App\Models\OwnerCompany::create(['name' => 'Digital Innovations Ltd']);
    echo "  - {$company1->name} (ID: {$company1->id})\n";
    echo "  - {$company2->name} (ID: {$company2->id})\n";
} else {
    foreach($companies as $company) {
        echo "  - {$company->name} (ID: {$company->id})\n";
    }
}
