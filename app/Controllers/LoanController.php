<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Facades\LoanServiceFacade;

class LoanController extends BaseController
{
    protected $loanService;

    public function __construct()
    {
        $this->loanService = new LoanServiceFacade();
    }

    public function index()
    {
        $userId = session('user_id');
        $userData = $this->loanService->getUserData($userId);

        $data = [
            'userData' => $userData
        ];

        return view('request_loan', $data);
    }

    public function continue()
    {
        $userId = session('user_id');
        $userData = $this->loanService->getUserData($userId);

        $userChoice = $this->request->getVar();
        $interest = $this->calculateInterest($userChoice['installment_period']);

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

    private function calculateInterest($period)
    {
        switch ($period) {
            case 1:
                return 0.05;
            case 3:
                return 0.04;
            case 6:
                return 0.03;
            case 12:
                return 0.02;
            default:
                return 0;
        }
    }

    public function confirm()
    {
        $userId = session('user_id');
        $isian = $this->request->getVar();

        $this->loanService->applyForLoan($userId, $isian['nominal'], $isian['period'], $isian['interest']);

        return redirect()->to('/dashboard');
    }

    public function indexPay($id)
    {
        $invoiceData = $this->loanService->getInvoiceData($id);
        $userId = session('user_id');
        $loan = $this->loanService->getLoanData($invoiceData['loan_id']);

        // Check if the loan exists and belongs to the current user
        if ($loan['user_id'] != $userId) {
            return redirect()->to('/dashboard')->with('error', 'Unauthorized access.');
        }

        if ($invoiceData['status'] == 1) {
            return redirect()->to('/dashboard')->with('error', 'Loan already paid.');
        }

        $data = [
            'invoiceData' => $invoiceData,
            'loan' => $loan
        ];

        return view('payment_loan', $data);
    }

    public function payment($id)
    {
        $userId = session('user_id');
        $addBalance = $this->loanService->payInvoice($id, $userId);

        return redirect()->to('/dashboard')->with('success', 'Added Rp '. number_format($addBalance, 0, '', '.') . ' to account');
    }
}
