<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('username', $username)->first();

        if ($user) {
            // Debug: Log the password verification
            log_message('debug', 'Attempting login for user: ' . $username);
            log_message('debug', 'Password verification result: ' . (password_verify($password, $user['password']) ? 'true' : 'false'));
            
            if (password_verify($password, $user['password'])) {
            $sessionData = [
                'user_id' => $user['id'],
                'username' => $user['username'],
                'role' => $user['role'],
                'logged_in' => true
            ];
            
            session()->set($sessionData);

            if ($user['role'] === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/user/dashboard');
                }
            }
        }

        return redirect()->back()->with('error', 'Username dan password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
} 