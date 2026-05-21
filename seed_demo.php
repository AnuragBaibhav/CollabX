<?php

require_once __DIR__ . '/bootstrap/app.php';

$app = app();
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$status = $kernel->call('db:seed', ['--class' => 'Database\\Seeders\\TaskGroupSeeder']);
echo "TaskGroupSeeder: " . ($status == 0 ? "SUCCESS" : "FAILED") . "\n";

$status = $kernel->call('db:seed', ['--class' => 'Database\\Seeders\\TasksSeeder']);
echo "TasksSeeder: " . ($status == 0 ? "SUCCESS" : "FAILED") . "\n";

$status = $kernel->call('db:seed', ['--class' => 'Database\\Seeders\\InvoiceSeeder']);
echo "InvoiceSeeder: " . ($status == 0 ? "SUCCESS" : "FAILED") . "\n";

echo "\nDatabase seeding complete!\n";
?>
