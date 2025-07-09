<?php
namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class Auth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = session();
        if (!$session->get('isLoggedIn')) {
            return redirect()->to('/login');
        }
        
        // Cek status user yang sudah login
        $userModel = new \App\Models\User();
        $userId = $session->get('user_id');
        $user = $userModel->find($userId);
        
        if ($user) {
            if ($user['force_logout'] == 1) {
                // Reset force_logout agar tidak logout terus-menerus
                $userModel->update($userId, ['force_logout' => 0]);
                $session->destroy();
                $session->setFlashdata('error', 'Akun Anda telah dinonaktifkan oleh admin. Silakan hubungi administrator.');
                return redirect()->to('/login');
            }
            if ($user['status'] === 'inactive') {
                // Logout user yang dinonaktifkan
                $session->destroy();
                $session->setFlashdata('error', 'Akun Anda telah dinonaktifkan. Silakan hubungi administrator.');
                return redirect()->to('/login');
            }
        }
        
        // Cek role jika $arguments diberikan
        if ($arguments && isset($arguments[0])) {
            $expectedRole = $arguments[0];
            $userRole = $session->get('role');
            if ($userRole !== $expectedRole) {
                // Redirect ke dashboard sesuai role
                if ($userRole === 'admin') {
                    return redirect()->to('/admin/dashboard');
                } elseif ($userRole === 'user') {
                    return redirect()->to('/user/dashboard');
                } else {
                    return redirect()->to('/');
                }
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Tidak perlu diisi untuk filter auth dasar
    }
} 