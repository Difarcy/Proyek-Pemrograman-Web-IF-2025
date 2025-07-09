<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Barang;
use App\Models\Customer;
use App\Models\BarangMasuk;
use App\Models\BarangKeluar;
use App\Models\Supplier;
use App\Models\Petugas;

class DashboardController extends Controller
{
    public function index()
    {
        $role = session()->get('role');
        if (!$role) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu');
        }
        $barangModel = new Barang();
        $barangMasukModel = new BarangMasuk();
        $barangKeluarModel = new BarangKeluar();
        $customerModel = new Customer();
        $supplierModel = new Supplier();
        $petugasModel = new Petugas();

        $data = [
            'role' => $role,
            'totalBarang' => $barangModel->countAll(),
            'totalCustomer' => $customerModel->countAll(),
            'totalSupplier' => $supplierModel->countAll(),
            'totalPetugas' => $petugasModel->countAll(),
            'totalBarangMasuk' => $barangMasukModel->countAll(),
            'totalBarangKeluar' => $barangKeluarModel->countAll(),
            'stokBarang' => $barangModel->findAll(5),
            'barangMasuk' => $barangMasukModel->findAll(5),
            'barangKeluar' => $barangKeluarModel->findAll(5),
        ];
        // Grafik Barang Masuk/Keluar per Bulan (6 bulan terakhir)
        $bulan = [];
        $masuk = [];
        $keluar = [];
        for ($i = 5; $i >= 0; $i--) {
            $label = date('M Y', strtotime("-$i month"));
            $bulan[] = $label;
            $start = date('Y-m-01', strtotime("-$i month"));
            $end = date('Y-m-t', strtotime("-$i month"));
            $masuk[] = $barangMasukModel
                ->where('tanggal_terima >=', $start)
                ->where('tanggal_terima <=', $end)
                ->countAllResults();
            $keluar[] = $barangKeluarModel
                ->where('tanggal_keluar >=', $start)
                ->where('tanggal_keluar <=', $end)
                ->countAllResults();
        }
        // Grafik Distribusi Kategori Barang
        $kategoriData = $barangModel
            ->select('kategori_barang, SUM(stok) as total')
            ->groupBy('kategori_barang')
            ->findAll();
        $kategoriLabels = array_column($kategoriData, 'kategori_barang');
        $kategoriTotals = array_map('intval', array_column($kategoriData, 'total'));
        $data['chartData'] = [
            'masukKeluar' => [
                'labels' => $bulan,
                'masuk' => $masuk,
                'keluar' => $keluar
            ],
            'total' => [
                'labels' => ['Total Barang', 'Total Customer', 'Total Supplier', 'Total Petugas', 'Barang Masuk', 'Barang Keluar'],
                'data' => [
                    $data['totalBarang'],
                    $data['totalCustomer'],
                    $data['totalSupplier'],
                    $data['totalPetugas'],
                    $data['totalBarangMasuk'],
                    $data['totalBarangKeluar']
                ]
            ]
        ];
        // Jika ingin ada data khusus admin/user, tambahkan di sini
        return view('dashboard', $data);
    }
} 