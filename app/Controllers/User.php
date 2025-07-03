<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class User extends Controller
{
    public function dashboard()
    {
        // Data dummy, ganti dengan query model sesuai kebutuhan
        $data = [
            'totalBarang' => 0,
            'totalCustomer' => 0,
            'totalBarangMasuk' => 0,
            'totalBarangKeluar' => 0,
            'stokBarang' => []
        ];
        return view('user/dashboard', $data);
    }

    public function stok()
    {
        return view('user/stok_barang');
    }

    public function barangMasuk()
    {
        return view('user/barang_masuk');
    }

    public function barangKeluar()
    {
        return view('user/barang_keluar');
    }

    public function dataCustomer()
    {
        return view('user/data_customer');
    }

    public function dataSupplier()
    {
        return view('user/data_supplier');
    }

    public function dataPetugas()
    {
        return view('user/data_petugas');
    }

    public function laporan()
    {
        return view('user/laporan');
    }

    public function profil()
    {
        return view('user/profil');
    }

    public function resetPassword()
    {
        return view('user/reset_password');
    }

    public function index()
    {
        return view('user/dashboard');
    }
}
