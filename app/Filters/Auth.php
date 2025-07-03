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