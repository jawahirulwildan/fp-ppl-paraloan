<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\LoanModel;

class DashboardController extends BaseController
{
    protected $userModel;
    protected $loanModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->loanModel = new LoanModel();
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

        $data = [
            'userData' => $userData,
            'loanData' => $loanData
        ];

        return view('dashboard', $data);
    }
}
