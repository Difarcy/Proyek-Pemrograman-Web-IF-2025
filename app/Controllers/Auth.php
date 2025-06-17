<?php

namespace App\Controllers;

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

        $db = \Config\Database::connect();
        $user = $db->table('users')
                  ->where('username', $username)
                  ->get()
                  ->getRow();

        if ($user && password_verify($password, $user->password)) {
            $sessionData = [
                'user_id' => $user->id,
                'username' => $user->username,
                'role' => $user->role,
                'logged_in' => true
            ];
            
            session()->set($sessionData);

            if ($user->role === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/user/dashboard');
            }
        }

        return redirect()->back()->with('error', 'Username atau password salah');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
} 