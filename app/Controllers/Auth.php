<?php
namespace App\Controllers;

class Auth extends BaseController
{
    public function login()
    {
        return view('pages/login');
    }

    public function register()
    {
        return view('pages/register');
    }

    public function forgotPassword()
    {
        return view('pages/forgot-password');
    }
} 