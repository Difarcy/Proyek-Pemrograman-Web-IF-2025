<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Barang;

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
        $barangModel = new Barang();
        $search = $this->request->getGet('search');
        $jenis = $this->request->getGet('jenis');
        $merek = $this->request->getGet('merek');
        $page = $this->request->getGet('page') ?? 1;
        $perPage = $this->request->getGet('entries') ?? 10;
        
        // Get total count for pagination
        $builder = $barangModel;
        if ($search) {
            $builder = $builder->groupStart()
                ->like('kode_barang', $search)
                ->orLike('nama_barang', $search)
                ->groupEnd();
        }
        if ($jenis) {
            $builder = $builder->where('jenis_barang', $jenis);
        }
        if ($merek) {
            $builder = $builder->where('merek_barang', $merek);
        }
        $total = $builder->countAllResults();
        
        // Get paginated data
        $stokBarang = $barangModel->filterBarang($search, $jenis, $merek, $perPage, ($page - 1) * $perPage);
        
        $totalPages = ceil($total / $perPage);
        
        return view('admin/stok_barang', [
            'stokBarang' => $stokBarang,
            'filterSearch' => $search,
            'filterJenis' => $jenis,
            'filterMerek' => $merek,
            'total' => $total,
            'currentPage' => $page,
            'perPage' => $perPage,
            'totalPages' => $totalPages
        ]);
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
