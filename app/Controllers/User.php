<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CustomerModel;
use App\Models\SupplierModel;
use App\Models\PetugasModel;
use App\Models\BarangMasukModel;
use App\Models\BarangKeluarModel;
use App\Models\TransaksiModel;

class User extends BaseController
{
    protected $barangModel;
    protected $customerModel;
    protected $supplierModel;
    protected $petugasModel;
    protected $barangMasukModel;
    protected $barangKeluarModel;
    protected $transaksiModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->customerModel = new CustomerModel();
        $this->supplierModel = new SupplierModel();
        $this->petugasModel = new PetugasModel();
        $this->barangMasukModel = new BarangMasukModel();
        $this->barangKeluarModel = new BarangKeluarModel();
        $this->transaksiModel = new TransaksiModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard User',
            'totalBarang' => $this->barangModel->countAll(),
            'totalCustomer' => $this->customerModel->countAll(),
            'totalSupplier' => $this->supplierModel->countAll(),
            'totalPetugas' => $this->petugasModel->countAll(),
            'stokMenipis' => $this->barangModel->where('stok <=', 10)->findAll(),
            'transaksiTerbaru' => $this->transaksiModel->orderBy('tanggal', 'DESC')->limit(5)->findAll()
        ];

        return view('user/dashboard_user', $data);
    }

    // Barang Management
    public function barang()
    {
        $data = [
            'title' => 'Stok Barang',
            'barang' => $this->barangModel->findAll()
        ];

        return view('user/stok_barang_user', $data);
    }

    public function detailBarang($id)
    {
        $data = [
            'title' => 'Detail Barang',
            'barang' => $this->barangModel->find($id)
        ];

        return view('user/detail_barang_user', $data);
    }

    // Customer Management
    public function customer()
    {
        $data = [
            'title' => 'Data Customer',
            'customer' => $this->customerModel->findAll()
        ];

        return view('user/data_customer_user', $data);
    }

    public function detailCustomer($id)
    {
        $data = [
            'title' => 'Detail Customer',
            'customer' => $this->customerModel->find($id),
            'transaksi' => $this->transaksiModel->where('customer_id', $id)->findAll()
        ];

        return view('user/detail_customer_user', $data);
    }

    // Supplier Management
    public function supplier()
    {
        $data = [
            'title' => 'Data Supplier',
            'supplier' => $this->supplierModel->findAll()
        ];

        return view('user/data_supplier_user', $data);
    }

    public function detailSupplier($id)
    {
        $data = [
            'title' => 'Detail Supplier',
            'supplier' => $this->supplierModel->find($id),
            'transaksi' => $this->transaksiModel->where('supplier_id', $id)->findAll()
        ];

        return view('user/detail_supplier_user', $data);
    }

    // Petugas Management
    public function petugas()
    {
        $data = [
            'title' => 'Data Petugas',
            'petugas' => $this->petugasModel->findAll()
        ];

        return view('user/data_petugas_user', $data);
    }

    public function detailPetugas($id)
    {
        $data = [
            'title' => 'Detail Petugas',
            'petugas' => $this->petugasModel->find($id),
            'aktivitas' => $this->transaksiModel->where('petugas_id', $id)->findAll()
        ];

        return view('user/detail_petugas_user', $data);
    }

    // Barang Masuk Management
    public function barangMasuk()
    {
        $data = [
            'title' => 'Barang Masuk',
            'barangMasuk' => $this->barangMasukModel->findAll()
        ];

        return view('user/barang_masuk_user', $data);
    }

    public function detailBarangMasuk($id)
    {
        $data = [
            'title' => 'Detail Barang Masuk',
            'barangMasuk' => $this->barangMasukModel->find($id),
            'barang' => $this->barangModel->find($this->barangMasukModel->find($id)['barang_id']),
            'supplier' => $this->supplierModel->find($this->barangMasukModel->find($id)['supplier_id'])
        ];

        return view('user/detail_barang_masuk_user', $data);
    }

    // Barang Keluar Management
    public function barangKeluar()
    {
        $data = [
            'title' => 'Barang Keluar',
            'barangKeluar' => $this->barangKeluarModel->findAll()
        ];

        return view('user/barang_keluar_user', $data);
    }

    public function detailBarangKeluar($id)
    {
        $data = [
            'title' => 'Detail Barang Keluar',
            'barangKeluar' => $this->barangKeluarModel->find($id),
            'barang' => $this->barangModel->find($this->barangKeluarModel->find($id)['barang_id']),
            'customer' => $this->customerModel->find($this->barangKeluarModel->find($id)['customer_id'])
        ];

        return view('user/detail_barang_keluar_user', $data);
    }

    // Laporan
    public function laporan()
    {
        $data = [
            'title' => 'Laporan',
            'barangMasuk' => $this->barangMasukModel->findAll(),
            'barangKeluar' => $this->barangKeluarModel->findAll()
        ];

        return view('user/laporan_user', $data);
    }

    public function exportExcel()
    {
        // Implementasi export Excel
    }

    public function exportPdf()
    {
        // Implementasi export PDF
    }
}
