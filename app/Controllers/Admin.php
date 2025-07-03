<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Admin extends Controller
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
        return view('admin/dashboard', $data);
    }

    public function stok()
    {
        return view('admin/stok_barang');
    }

    public function barangMasuk()
    {
        return view('admin/barang_masuk');
    }

    public function barangKeluar()
    {
        return view('admin/barang_keluar');
    }

    public function dataCustomer()
    {
        return view('admin/data_customer');
    }

    public function dataSupplier()
    {
        return view('admin/data_supplier');
    }

    public function dataPetugas()
    {
        return view('admin/data_petugas');
    }

    public function laporan()
    {
        return view('admin/laporan');
    }

    public function manajemenPengguna()
    {
        return view('admin/kelola_pengguna');
    }

    public function profil()
    {
        return view('admin/profil');
    }

    public function profilToko()
    {
        return view('admin/profil_toko');
    }

    public function resetPassword()
    {
        return view('admin/reset_password');
    }

    public function index()
    {
        return view('admin/dashboard');
    }
}
