<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{

    public function index(): string
    {
        return view('index');
    }

    public function login_user()
    {
        $userModel = new UserModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $user = $userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            // Invalid credentials
            return redirect()->back()->withInput()->with('error', 'Invalid email or password');
        }
        
        $this->setUserSession($user);

        return redirect()->to('/dashboard');
    }

    private function setUserSession(array $user)
    {
        $userData = [
            'user_id' => $user['id'],
            'email' => $user['email'],
        ];

        session()->set($userData);
    }
    
}
