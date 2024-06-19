<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LoanModel;
use App\Models\InvoiceModel;

class LoanController extends BaseController
{
    protected $userModel;
    protected $loanModel;
    protected $invoiceModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->loanModel = new LoanModel();
        $this->invoiceModel = new InvoiceModel();
    }

    public function index()
    {
        $userId = session('user_id');

        $userData = $this->userModel->getUser($userId);

        $data = [
            'userData' => $userData
        ];

        return view('request_loan', $data);
    }

    public function continue()
    {
        $userId = session('user_id');
        $userData = $this->userModel->getUser($userId);

        $userChoice = $this->request->getVar();

        $interest = 0;
        if ($userChoice['installment_period'] == 1) {
            $interest = 0.05;
        } elseif ($userChoice['installment_period'] == 3) {
            $interest = 0.04;
        } elseif ($userChoice['installment_period'] == 6) {
            $interest = 0.03;
        } elseif ($userChoice['installment_period'] == 12) {
            $interest = 0.02;
        }

        $data = [
            'userData' => $userData,
            'userChoice' => $userChoice,
            'interest' => $interest
        ];

        if ($userChoice['loan_amount'] > $userData['balance']) {
            return redirect()->to('/request-loan')->with('error', 'Please fill in the loan nominal according to your account balance limit');
        }

        return view('confirmation_loan', $data);
    }

    public function confirm()
    {
        $userId = session('user_id');
        $isian = $this->request->getVar();
        $start_date = date('Y-m-d H:i:s'); // Format standar untuk penyimpanan di database

        // save ke loanModel
        $this->loanModel->save([
            'user_id' => $userId,
            'period' => $isian['period'],
            'interest' => $isian['interest'],
            'amount' => $isian['nominal']
        ]);

        //mengambil loan_id yang baru saja disimpan
        $loanId = $this->loanModel->getInsertID();

        //save ke invoiceModel
        for ($i = 1; $i <= $isian['period']; $i++) {
            $end_date = date('Y-m-d H:i:s', strtotime($start_date . ' +30 days'));
            // ['loan_id', 'order', 'period', 'status', 'start_date', 'due_date', 'bill_nominal', 'penalty', 'payment_date'];
            $this->invoiceModel->save([
                'loan_id' => $loanId,
                'order' => $i,
                'period' => $isian['period'],
                'status' => 0,
                'start_date' => $start_date,
                'due_date' => $end_date,
                'bill_nominal' => $isian['nominal'] * (1 + $isian['interest']) / $isian['period'],
                'penalty' => 0
            ]);
            $start_date = $end_date;
        }

        $u = $this->userModel->getUser($userId);
        $ub = $u['balance'] - $isian['nominal'];
        $this->userModel->updateBalance($ub, $userId);

        return redirect()->to('/dashboard');
    }
}
