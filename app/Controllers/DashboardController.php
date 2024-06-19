<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LoanModel;
use App\Models\InvoiceModel;

class DashboardController extends BaseController
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

    public function profile(){
        $userId = session('user_id');
        $userData = $this->userModel->getUser($userId);

        $data = [
            'userData' => $userData,
        ];

        return view('profil', $data);
    }

    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/'); // Redirect to login if session data doesn't exist
        }

        $userId = session('user_id');
        // $userData = $this->userModel->find($userId);
        $userData = $this->userModel->getUser($userId);

        // mengambil data dari loans
        // $loanData = $this->loanModel->findAll();
        // $loanData = $this->loanModel->find($userId);
        $loanData = $this->userModel->getUserLoans($userId);

        $userInvoices = array();
        $userInvoicesData = array();
        // Loop melalui $loanData
        foreach ($loanData as $l) {
            // Panggil getUserInvoices dan simpan hasilnya ke dalam array
            $userInvoices[] = $this->loanModel->getUserInvoices($l['id']);
        }
        foreach ($userInvoices as $ui) {
            $userInvoicesData = array_merge($userInvoicesData, $ui);
        }

        $data = [
            'userData' => $userData,
            'userInvoicesData' => $userInvoicesData
        ];

        return view('dashboard', $data);
    }
}
