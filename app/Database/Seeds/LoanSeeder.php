<?php

namespace App\Database\Seeds;

use App\Models\InvoiceModel;
use App\Models\LoanModel;
use CodeIgniter\Database\Seeder;

class LoanSeeder extends Seeder
{
    public function run()
    {
        $loanModel = new LoanModel();
        $invoiceModel = new InvoiceModel();
        
        $faker = \Faker\Factory::create('id_ID');

        $numberofLoans = 10;
        
        for ($i = 1; $i <= $numberofLoans; $i++) {
            $period = $faker->randomElement([1, 3, 6, 12]); // Random period

            // Determine interest rate based on period
            if ($period == 1) {
                $interest = 0.05;
            } elseif ($period == 3) {
                $interest = 0.04;
            } elseif ($period == 6) {
                $interest = 0.03;
            } else {
                $interest = 0.02;
            }
            
            $user_id = $faker->numberBetween(1, 10);
            $amount = $faker->numberBetween(1, 10) * 500000;

            $data = [
                'user_id' => $user_id,
                'period' => $period,
                'interest' => $interest,
                'amount' => $amount
            ];

            $loanModel->insert($data);

            $startdate = date('Y-m-d H:i:s');

            // Add invoices for the current loan
            for ($j = 1; $j <= $period; $j++) {
                $order = $j;
                $enddate = date('Y-m-d H:i:s', strtotime($startdate . ' +30 days'));
                $billnominal = ($amount / $period) * (1 + $interest);

                $invoicedata = [
                    'loan_id' => $i, // Use $i as loan_id to reference the current loan
                    'order' => $order,
                    'status' => 0,
                    'period' => $period,
                    'start_date' => $startdate,
                    'due_date' => $enddate,
                    'bill_nominal' => $billnominal,
                    'penalty' => 0,
                ];

                $invoiceModel->insert($invoicedata);

                $startdate = $enddate; // Update start date for the next invoice
            }
        }
    }
}
