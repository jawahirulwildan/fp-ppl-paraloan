<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class DashboardController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    
    public function index()
    {
        if (!session()->has('user_id')) {
            return redirect()->to('/'); // Redirect to login if session data doesn't exist
        }

        $userId = session('user_id');
        $userData = $this->userModel->find($userId);

        $data = [
            'userData' => $userData,
        ];
        
        return view('dashboard', $data);
    }
}
