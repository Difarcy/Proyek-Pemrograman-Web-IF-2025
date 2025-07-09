<?php
namespace App\Controllers;
use App\Models\User;
use CodeIgniter\Controller;

class Auth extends Controller
{
    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        $session = session();
        if ($session->get('isLoggedIn')) {
            if ($session->get('role') === 'admin') {
                return redirect()->to('/admin/dashboard');
            } else {
                return redirect()->to('/user/dashboard');
            }
        }
        return view('auth/login');
    }

    public function attemptLogin()
    {
        $session = session();
        $userModel = new User();
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $user = $userModel->where('username', $username)->first();
        if ($user) {
            // Cek status user terlebih dahulu
            if ($user['status'] === 'inactive') {
                $session->setFlashdata('error', 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.');
                return redirect()->to('/');
            }
            
            if (password_verify($password, $user['password'])) {
                // Update last_login
                $userModel->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);
                
                $session->set([
                    'user_id'   => $user['id'],
                    'username'  => $user['username'],
                    'nama'      => $user['nama'],
                    'role'      => $user['role'],
                    'foto'      => $user['foto'] ?? null,
                    'last_login'=> date('Y-m-d H:i:s'),
                    'isLoggedIn'=> true
                ]);
                if ($user['role'] === 'admin') {
                    return redirect()->to('/admin/dashboard');
                } else {
                    return redirect()->to('/user/dashboard');
                }
            }
        }
        // Jika gagal
        $session->setFlashdata('error', 'Username atau Password Salah!');
        return redirect()->to('/');
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }
}
