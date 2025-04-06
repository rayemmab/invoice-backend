<?php

namespace Database\Seeders;

use App\Models\Invoice;
use Illuminate\Database\Seeder;

class InvoicesTableSeeder extends Seeder
{
    public function run()
    {
        $invoices = [
            [
                'invoice_number' => 'INV-2023-001',
                'client_id' => 1,
                'user_id' => 2,
                'currency_id' => 1,
                'issue_date' => '2023-01-15',
                'due_date' => '2023-02-15',
                'status' => 'paid',
                'subtotal' => 1500.00,
                'tax_amount' => 300.00,
                'discount_amount' => 0.00,
                'total_amount' => 1800.00,
                'notes' => 'Payment via bank transfer',
                'terms_and_conditions' => 'Payment due within 30 days',
                'line_items' => json_encode([
                    [
                        'description' => 'Web Development Services',
                        'quantity' => 30,
                        'unit_price' => 50.00,
                        'tax_rate' => 20,
                        'amount' => 1500.00
                    ]
                ]),
                'original_currency_id' => 1
            ],
            [
                'invoice_number' => 'INV-2023-002',
                'client_id' => 2,
                'user_id' => 3,
                'currency_id' => 2,
                'issue_date' => '2023-02-01',
                'due_date' => '2023-03-01',
                'status' => 'sent',
                'subtotal' => 2400.00,
                'tax_amount' => 480.00,
                'discount_amount' => 100.00,
                'total_amount' => 2780.00,
                'notes' => 'Merci pour votre confiance',
                'terms_and_conditions' => 'Paiement dans les 30 jours',
                'line_items' => json_encode([
                    [
                        'description' => 'Conseil en stratégie',
                        'quantity' => 20,
                        'unit_price' => 100.00,
                        'tax_rate' => 20,
                        'amount' => 2000.00
                    ],
                    [
                        'description' => 'Formation équipe',
                        'quantity' => 2,
                        'unit_price' => 200.00,
                        'tax_rate' => 20,
                        'amount' => 400.00
                    ]
                ]),
                'original_currency_id' => 2
            ]
        ];

        foreach ($invoices as $invoice) {
            Invoice::create($invoice);
        }
    }
}