<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;

class UserController extends BaseController
{
    public function index()
    {
        return view('register');
    }

    public function register_user()
    {        
        $userModel = new UserModel();
        $validation = \Config\Services::validation();
        $validation->setRules($userModel->validationRules);

        if (!$validation->withRequest($this->request)->run()) {
            // Validation failed, redirect back to registration form with errors
            return redirect()->to('/register')->withInput()->with('errors', $validation->getErrors());
        }

        // Handle file uploads
        // $idCard = $this->request->getFile('id_card');
        // $npwp = $this->request->getFile('npwp');
        // $selfieId = $this->request->getFile('selfie_id');

        // Move uploaded files to desired directory
        // Example:
        // $idCard->move(ROOTPATH . 'public/uploads', 'id_card.jpg');

        

        // Prepare user data for insertion
        $userData = array(
            'email' => $this->request->getVar('email'),
            'password' => $this->request->getVar('password'),
            'full_name' => $this->request->getVar('full_name'),
            'nik' => $this->request->getVar('nik'),
            'phone_number' => $this->request->getVar('phone_number'),
            'address' => $this->request->getVar('address'),
            'occupation' => $this->request->getVar('occupation'),
            'salary' => $this->request->getVar('salary'),
            'bank' => $this->request->getVar('bank'),
            'account_number' => $this->request->getVar('account_number'),
            'emergency_phone' => $this->request->getVar('emergency_phone'),
            'emergency_relation' => $this->request->getVar('emergency_relation'),
            'created_at' => date('Y-m-d H:i:s'),
            'balance' => '500000'
        );

        // Insert user data into database
        $userModel->insert($userData);

        return redirect()->to('/');
    }
}
