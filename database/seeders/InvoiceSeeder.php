<?php

namespace Database\Seeders;

use App\Models\Invoice;
use App\Models\ClientCompany;
use App\Models\User;
use App\Enums\Invoice as InvoiceEnum;
use Illuminate\Database\Seeder;

class InvoiceSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::role('admin')->first();
        $companies = ClientCompany::all();

        foreach ($companies as $index => $company) {
            // Create 2-3 invoices per company
            for ($i = 1; $i <= rand(2, 3); $i++) {
                $amount = rand(5000, 50000);
                $tax = (int)($amount * 0.1); // 10% tax

                Invoice::create([
                    'client_company_id' => $company->id,
                    'created_by_user_id' => $admin->id,
                    'number' => 'INV-' . date('Y') . '-' . str_pad($index * 10 + $i, 4, '0', STR_PAD_LEFT),
                    'status' => $i == 1 ? InvoiceEnum::STATUS_PAID->value : ($i == 2 ? InvoiceEnum::STATUS_SENT->value : InvoiceEnum::STATUS_NEW->value),
                    'type' => InvoiceEnum::TYPE_DEFAULT->value,
                    'amount' => $amount,
                    'amount_with_tax' => $amount + $tax,
                    'hourly_rate' => 120,
                    'due_date' => now()->addDays(rand(15, 45)),
                    'note' => 'Invoice for project work - ' . $company->name,
                    'filename' => 'invoice-' . $index . '-' . $i . '.pdf',
                ]);
            }
        }
    }
}
