<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function helpCenter()
    {
        $data = [
            'title' => 'Help Center - Inventrack'
        ];
        return view('pages/help-center', $data);
    }

    public function documentation()
    {
        $data = [
            'title' => 'Documentation - Inventrack'
        ];
        return view('pages/documentation', $data);
    }

    public function apiReference()
    {
        $data = [
            'title' => 'API Reference - Inventrack'
        ];
        return view('pages/api-reference', $data);
    }

    public function community()
    {
        $data = [
            'title' => 'Community - Inventrack'
        ];
        return view('pages/community', $data);
    }

    public function contact()
    {
        $data = [
            'title' => 'Contact Us - Inventrack'
        ];
        return view('pages/contact', $data);
    }
} 