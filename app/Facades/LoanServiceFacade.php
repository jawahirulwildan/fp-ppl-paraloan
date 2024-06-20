<?php

namespace App\Facades;

use App\Models\UserModel;
use App\Models\LoanModel;
use App\Models\InvoiceModel;

class LoanServiceFacade
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

    public function getUserData($userId)
    {
        return $this->userModel->getUser($userId);
    }

    public function applyForLoan($userId, $loanAmount, $period, $interest)
    {
        // Save to loanModel
        $this->loanModel->save([
            'user_id' => $userId,
            'period' => $period,
            'interest' => $interest,
            'amount' => $loanAmount
        ]);

        // Get the newly inserted loan ID
        $loanId = $this->loanModel->getInsertID();
        $start_date = date('Y-m-d H:i:s'); // Standard format for database storage

        // Save to invoiceModel
        for ($i = 1; $i <= $period; $i++) {
            $end_date = date('Y-m-d H:i:s', strtotime($start_date . ' +30 days'));
            $this->invoiceModel->save([
                'loan_id' => $loanId,
                'order' => $i,
                'period' => $period,
                'status' => 0,
                'start_date' => $start_date,
                'due_date' => $end_date,
                'bill_nominal' => $loanAmount * (1 + $interest) / $period,
                'penalty' => 0
            ]);
            $start_date = $end_date;
        }

        // Update user balance
        $user = $this->userModel->getUser($userId);
        $newBalance = $user['balance'] - $loanAmount;
        $this->userModel->updateBalance($newBalance, $userId);
    }

    public function getInvoiceData($id)
    {
        return $this->invoiceModel->getInvoice($id);
    }

    public function getLoanData($loanId)
    {
        return $this->loanModel->getUserLoan($loanId);
    }

    public function payInvoice($id, $userId)
    {
        $invoiceData = $this->getInvoiceData($id);
        $loan = $this->getLoanData($invoiceData['loan_id']);

        // Update invoice status
        $this->invoiceModel->update($id, [
            'status' => 1,
            'payment_date' => date('Y-m-d H:i:s')
        ]);

        // Update user balance
        $user = $this->userModel->getUser($userId);
        $addBalance = $loan['amount'] / $loan['period'];
        $newBalance = $user['balance'] + $addBalance;
        $this->userModel->updateBalance($newBalance, $userId);

        return $addBalance;
    }
}
