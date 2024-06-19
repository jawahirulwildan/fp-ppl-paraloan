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
}
