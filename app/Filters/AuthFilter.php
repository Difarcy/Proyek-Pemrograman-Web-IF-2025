<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // Jika user belum login
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        // Jika user sudah login, cek role
        if (isset($arguments[0])) {
            $role = session()->get('role');
            if ($role !== $arguments[0]) {
                return redirect()->back();
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
} 