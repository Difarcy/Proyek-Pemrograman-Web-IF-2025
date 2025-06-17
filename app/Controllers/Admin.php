<?php

namespace App\Controllers;

use App\Models\BarangModel;
use App\Models\CustomerModel;
use App\Models\SupplierModel;
use App\Models\PetugasModel;
use App\Models\BarangMasukModel;
use App\Models\BarangKeluarModel;
use App\Models\TransaksiModel;
use App\Models\UserModel;
use App\Models\ProfilModel;

class Admin extends BaseController
{
    protected $barangModel;
    protected $customerModel;
    protected $supplierModel;
    protected $petugasModel;
    protected $barangMasukModel;
    protected $barangKeluarModel;
    protected $transaksiModel;
    protected $userModel;
    protected $profilModel;

    public function __construct()
    {
        $this->barangModel = new BarangModel();
        $this->customerModel = new CustomerModel();
        $this->supplierModel = new SupplierModel();
        $this->petugasModel = new PetugasModel();
        $this->barangMasukModel = new BarangMasukModel();
        $this->barangKeluarModel = new BarangKeluarModel();
        $this->transaksiModel = new TransaksiModel();
        $this->userModel = new UserModel();
        $this->profilModel = new ProfilModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Dashboard Admin',
            'totalBarang' => $this->barangModel->countAll(),
            'totalCustomer' => $this->customerModel->countAll(),
            'totalSupplier' => $this->supplierModel->countAll(),
            'totalPetugas' => $this->petugasModel->countAll(),
            'stokMenipis' => $this->barangModel->where('stok <=', 10)->findAll(),
            'transaksiTerbaru' => $this->transaksiModel->orderBy('tanggal', 'DESC')->limit(5)->findAll()
        ];

        return view('admin/dashboard_admin', $data);
    }

    // Barang Management
    public function barang()
    {
        $data = [
            'title' => 'Stok Barang',
            'barang' => $this->barangModel->findAll()
        ];

        return view('admin/stok_barang_admin', $data);
    }

    public function createBarang()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'kode_barang' => 'required|is_unique[barang.kode_barang]',
                'nama_barang' => 'required',
                'kategori' => 'required',
                'stok' => 'required|numeric',
                'satuan' => 'required',
                'harga' => 'required|numeric'
            ];

            if ($this->validate($rules)) {
                $this->barangModel->insert([
                    'kode_barang' => $this->request->getPost('kode_barang'),
                    'nama_barang' => $this->request->getPost('nama_barang'),
                    'kategori' => $this->request->getPost('kategori'),
                    'stok' => $this->request->getPost('stok'),
                    'satuan' => $this->request->getPost('satuan'),
                    'harga' => $this->request->getPost('harga'),
                    'deskripsi' => $this->request->getPost('deskripsi')
                ]);

                return redirect()->to('admin/stok-barang')->with('success', 'Barang berhasil ditambahkan');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return view('admin/tambah_barang');
    }

    public function editBarang($id)
    {
        $barang = $this->barangModel->find($id);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama_barang' => 'required',
                'kategori' => 'required',
                'stok' => 'required|numeric',
                'satuan' => 'required',
                'harga' => 'required|numeric'
            ];

            if ($this->validate($rules)) {
                $this->barangModel->update($id, [
                    'nama_barang' => $this->request->getPost('nama_barang'),
                    'kategori' => $this->request->getPost('kategori'),
                    'stok' => $this->request->getPost('stok'),
                    'satuan' => $this->request->getPost('satuan'),
                    'harga' => $this->request->getPost('harga'),
                    'deskripsi' => $this->request->getPost('deskripsi')
                ]);

                return redirect()->to('admin/stok-barang')->with('success', 'Barang berhasil diperbarui');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return view('admin/edit_barang', ['barang' => $barang]);
    }

    public function deleteBarang($id)
    {
        $this->barangModel->delete($id);
        return redirect()->to('admin/stok-barang')->with('success', 'Barang berhasil dihapus');
    }

    // Customer Management
    public function customer()
    {
        $data = [
            'title' => 'Data Customer',
            'customer' => $this->customerModel->findAll()
        ];

        return view('admin/data_customer_admin', $data);
    }

    public function createCustomer()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'kode_customer' => 'required|is_unique[customer.kode_customer]',
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'email' => 'required|valid_email'
            ];

            if ($this->validate($rules)) {
                $this->customerModel->insert([
                    'kode_customer' => $this->request->getPost('kode_customer'),
                    'nama' => $this->request->getPost('nama'),
                    'alamat' => $this->request->getPost('alamat'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'email' => $this->request->getPost('email'),
                    'status' => 'aktif'
                ]);

                return redirect()->to('admin/data-customer')->with('success', 'Customer berhasil ditambahkan');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return view('admin/tambah_customer');
    }

    public function editCustomer($id)
    {
        $customer = $this->customerModel->find($id);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'email' => 'required|valid_email'
            ];

            if ($this->validate($rules)) {
                $this->customerModel->update($id, [
                    'nama' => $this->request->getPost('nama'),
                    'alamat' => $this->request->getPost('alamat'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'email' => $this->request->getPost('email'),
                    'status' => $this->request->getPost('status')
                ]);

                return redirect()->to('admin/data-customer')->with('success', 'Customer berhasil diperbarui');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return view('admin/edit_customer', ['customer' => $customer]);
    }

    public function deleteCustomer($id)
    {
        $this->customerModel->delete($id);
        return redirect()->to('admin/data-customer')->with('success', 'Customer berhasil dihapus');
    }

    // Supplier Management
    public function supplier()
    {
        $data = [
            'title' => 'Data Supplier',
            'supplier' => $this->supplierModel->findAll()
        ];

        return view('admin/data_supplier_admin', $data);
    }

    public function createSupplier()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'kode_supplier' => 'required|is_unique[supplier.kode_supplier]',
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'email' => 'required|valid_email'
            ];

            if ($this->validate($rules)) {
                $this->supplierModel->insert([
                    'kode_supplier' => $this->request->getPost('kode_supplier'),
                    'nama' => $this->request->getPost('nama'),
                    'alamat' => $this->request->getPost('alamat'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'email' => $this->request->getPost('email'),
                    'status' => 'aktif'
                ]);

                return redirect()->to('admin/data-supplier')->with('success', 'Supplier berhasil ditambahkan');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return view('admin/tambah_supplier');
    }

    public function editSupplier($id)
    {
        $supplier = $this->supplierModel->find($id);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'email' => 'required|valid_email'
            ];

            if ($this->validate($rules)) {
                $this->supplierModel->update($id, [
                    'nama' => $this->request->getPost('nama'),
                    'alamat' => $this->request->getPost('alamat'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'email' => $this->request->getPost('email'),
                    'status' => $this->request->getPost('status')
                ]);

                return redirect()->to('admin/data-supplier')->with('success', 'Supplier berhasil diperbarui');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return view('admin/edit_supplier', ['supplier' => $supplier]);
    }

    public function deleteSupplier($id)
    {
        $this->supplierModel->delete($id);
        return redirect()->to('admin/data-supplier')->with('success', 'Supplier berhasil dihapus');
    }

    // Petugas Management
    public function petugas()
    {
        $data = [
            'title' => 'Data Petugas',
            'petugas' => $this->petugasModel->findAll()
        ];

        return view('admin/data_petugas_admin', $data);
    }

    public function createPetugas()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nip' => 'required|is_unique[petugas.nip]',
                'nama' => 'required',
                'jabatan' => 'required',
                'no_telp' => 'required',
                'email' => 'required|valid_email',
                'password' => 'required|min_length[6]'
            ];

            if ($this->validate($rules)) {
                $this->petugasModel->insert([
                    'nip' => $this->request->getPost('nip'),
                    'nama' => $this->request->getPost('nama'),
                    'jabatan' => $this->request->getPost('jabatan'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'email' => $this->request->getPost('email'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'status' => 'aktif'
                ]);

                return redirect()->to('admin/data-petugas')->with('success', 'Petugas berhasil ditambahkan');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return view('admin/tambah_petugas');
    }

    public function editPetugas($id)
    {
        $petugas = $this->petugasModel->find($id);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama' => 'required',
                'jabatan' => 'required',
                'no_telp' => 'required',
                'email' => 'required|valid_email'
            ];

            if ($this->validate($rules)) {
                $data = [
                    'nama' => $this->request->getPost('nama'),
                    'jabatan' => $this->request->getPost('jabatan'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'email' => $this->request->getPost('email'),
                    'status' => $this->request->getPost('status')
                ];

                if ($this->request->getPost('password')) {
                    $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
                }

                $this->petugasModel->update($id, $data);

                return redirect()->to('admin/data-petugas')->with('success', 'Petugas berhasil diperbarui');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return view('admin/edit_petugas', ['petugas' => $petugas]);
    }

    public function deletePetugas($id)
    {
        $this->petugasModel->delete($id);
        return redirect()->to('admin/data-petugas')->with('success', 'Petugas berhasil dihapus');
    }

    // Barang Masuk Management
    public function barangMasuk()
    {
        $data = [
            'title' => 'Barang Masuk',
            'barangMasuk' => $this->barangMasukModel->findAll()
        ];

        return view('admin/barang_masuk_admin', $data);
    }

    public function createBarangMasuk()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'no_transaksi' => 'required|is_unique[barang_masuk.no_transaksi]',
                'tanggal' => 'required',
                'supplier_id' => 'required',
                'barang_id' => 'required',
                'jumlah' => 'required|numeric',
                'harga_beli' => 'required|numeric'
            ];

            if ($this->validate($rules)) {
                $jumlah = $this->request->getPost('jumlah');
                $hargaBeli = $this->request->getPost('harga_beli');
                $total = $jumlah * $hargaBeli;

                $this->barangMasukModel->insert([
                    'no_transaksi' => $this->request->getPost('no_transaksi'),
                    'tanggal' => $this->request->getPost('tanggal'),
                    'supplier_id' => $this->request->getPost('supplier_id'),
                    'barang_id' => $this->request->getPost('barang_id'),
                    'jumlah' => $jumlah,
                    'harga_beli' => $hargaBeli,
                    'total' => $total,
                    'status' => 'proses'
                ]);

                // Update stok barang
                $barang = $this->barangModel->find($this->request->getPost('barang_id'));
                $this->barangModel->update($barang['id'], [
                    'stok' => $barang['stok'] + $jumlah
                ]);

                return redirect()->to('admin/barang-masuk')->with('success', 'Barang masuk berhasil ditambahkan');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'suppliers' => $this->supplierModel->findAll(),
            'barang' => $this->barangModel->findAll()
        ];

        return view('admin/tambah_barang_masuk', $data);
    }

    public function editBarangMasuk($id)
    {
        $barangMasuk = $this->barangMasukModel->find($id);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'tanggal' => 'required',
                'supplier_id' => 'required',
                'barang_id' => 'required',
                'jumlah' => 'required|numeric',
                'harga_beli' => 'required|numeric'
            ];

            if ($this->validate($rules)) {
                $jumlah = $this->request->getPost('jumlah');
                $hargaBeli = $this->request->getPost('harga_beli');
                $total = $jumlah * $hargaBeli;

                // Update stok barang
                $barang = $this->barangModel->find($barangMasuk['barang_id']);
                $this->barangModel->update($barang['id'], [
                    'stok' => $barang['stok'] - $barangMasuk['jumlah'] + $jumlah
                ]);

                $this->barangMasukModel->update($id, [
                    'tanggal' => $this->request->getPost('tanggal'),
                    'supplier_id' => $this->request->getPost('supplier_id'),
                    'barang_id' => $this->request->getPost('barang_id'),
                    'jumlah' => $jumlah,
                    'harga_beli' => $hargaBeli,
                    'total' => $total,
                    'status' => $this->request->getPost('status')
                ]);

                return redirect()->to('admin/barang-masuk')->with('success', 'Barang masuk berhasil diperbarui');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'barangMasuk' => $barangMasuk,
            'suppliers' => $this->supplierModel->findAll(),
            'barang' => $this->barangModel->findAll()
        ];

        return view('admin/edit_barang_masuk', $data);
    }

    public function deleteBarangMasuk($id)
    {
        $barangMasuk = $this->barangMasukModel->find($id);

        // Update stok barang
        $barang = $this->barangModel->find($barangMasuk['barang_id']);
        $this->barangModel->update($barang['id'], [
            'stok' => $barang['stok'] - $barangMasuk['jumlah']
        ]);

        $this->barangMasukModel->delete($id);
        return redirect()->to('admin/barang-masuk')->with('success', 'Barang masuk berhasil dihapus');
    }

    // Barang Keluar Management
    public function barangKeluar()
    {
        $data = [
            'title' => 'Barang Keluar',
            'barangKeluar' => $this->barangKeluarModel->findAll()
        ];

        return view('admin/barang_keluar_admin', $data);
    }

    public function createBarangKeluar()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'no_transaksi' => 'required|is_unique[barang_keluar.no_transaksi]',
                'tanggal' => 'required',
                'customer_id' => 'required',
                'barang_id' => 'required',
                'jumlah' => 'required|numeric',
                'harga_jual' => 'required|numeric'
            ];

            if ($this->validate($rules)) {
                $jumlah = $this->request->getPost('jumlah');
                $hargaJual = $this->request->getPost('harga_jual');
                $total = $jumlah * $hargaJual;

                // Cek stok
                $barang = $this->barangModel->find($this->request->getPost('barang_id'));
                if ($barang['stok'] < $jumlah) {
                    return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi');
                }

                $this->barangKeluarModel->insert([
                    'no_transaksi' => $this->request->getPost('no_transaksi'),
                    'tanggal' => $this->request->getPost('tanggal'),
                    'customer_id' => $this->request->getPost('customer_id'),
                    'barang_id' => $this->request->getPost('barang_id'),
                    'jumlah' => $jumlah,
                    'harga_jual' => $hargaJual,
                    'total' => $total,
                    'status' => 'proses'
                ]);

                // Update stok barang
                $this->barangModel->update($barang['id'], [
                    'stok' => $barang['stok'] - $jumlah
                ]);

                return redirect()->to('admin/barang-keluar')->with('success', 'Barang keluar berhasil ditambahkan');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'customers' => $this->customerModel->findAll(),
            'barang' => $this->barangModel->findAll()
        ];

        return view('admin/tambah_barang_keluar', $data);
    }

    public function editBarangKeluar($id)
    {
        $barangKeluar = $this->barangKeluarModel->find($id);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'tanggal' => 'required',
                'customer_id' => 'required',
                'barang_id' => 'required',
                'jumlah' => 'required|numeric',
                'harga_jual' => 'required|numeric'
            ];

            if ($this->validate($rules)) {
                $jumlah = $this->request->getPost('jumlah');
                $hargaJual = $this->request->getPost('harga_jual');
                $total = $jumlah * $hargaJual;

                // Cek stok
                $barang = $this->barangModel->find($barangKeluar['barang_id']);
                if ($barang['stok'] + $barangKeluar['jumlah'] < $jumlah) {
                    return redirect()->back()->withInput()->with('error', 'Stok tidak mencukupi');
                }

                // Update stok barang
                $this->barangModel->update($barang['id'], [
                    'stok' => $barang['stok'] + $barangKeluar['jumlah'] - $jumlah
                ]);

                $this->barangKeluarModel->update($id, [
                    'tanggal' => $this->request->getPost('tanggal'),
                    'customer_id' => $this->request->getPost('customer_id'),
                    'barang_id' => $this->request->getPost('barang_id'),
                    'jumlah' => $jumlah,
                    'harga_jual' => $hargaJual,
                    'total' => $total,
                    'status' => $this->request->getPost('status')
                ]);

                return redirect()->to('admin/barang-keluar')->with('success', 'Barang keluar berhasil diperbarui');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'barangKeluar' => $barangKeluar,
            'customers' => $this->customerModel->findAll(),
            'barang' => $this->barangModel->findAll()
        ];

        return view('admin/edit_barang_keluar', $data);
    }

    public function deleteBarangKeluar($id)
    {
        $barangKeluar = $this->barangKeluarModel->find($id);

        // Update stok barang
        $barang = $this->barangModel->find($barangKeluar['barang_id']);
        $this->barangModel->update($barang['id'], [
            'stok' => $barang['stok'] + $barangKeluar['jumlah']
        ]);

        $this->barangKeluarModel->delete($id);
        return redirect()->to('admin/barang-keluar')->with('success', 'Barang keluar berhasil dihapus');
    }

    // Laporan
    public function laporan()
    {
        $data = [
            'title' => 'Laporan',
            'barangMasuk' => $this->barangMasukModel->findAll(),
            'barangKeluar' => $this->barangKeluarModel->findAll()
        ];

        return view('admin/laporan_admin', $data);
    }

    public function exportExcel()
    {
        // Implementasi export Excel
    }

    public function exportPdf()
    {
        // Implementasi export PDF
    }

    // Manajemen Pengguna
    public function manajemenPengguna()
    {
        $data = [
            'title' => 'Manajemen Pengguna',
            'users' => $this->userModel->findAll()
        ];

        return view('admin/manajemen_pengguna_admin', $data);
    }

    public function createUser()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required|is_unique[users.username]',
                'password' => 'required|min_length[6]',
                'role' => 'required'
            ];

            if ($this->validate($rules)) {
                $this->userModel->insert([
                    'username' => $this->request->getPost('username'),
                    'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                    'role' => $this->request->getPost('role'),
                    'status' => 'aktif'
                ]);

                return redirect()->to('admin/manajemen-pengguna')->with('success', 'Pengguna berhasil ditambahkan');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return view('admin/tambah_pengguna');
    }

    public function editUser($id)
    {
        $user = $this->userModel->find($id);

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'username' => 'required',
                'role' => 'required'
            ];

            if ($this->validate($rules)) {
                $data = [
                    'username' => $this->request->getPost('username'),
                    'role' => $this->request->getPost('role'),
                    'status' => $this->request->getPost('status')
                ];

                if ($this->request->getPost('password')) {
                    $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
                }

                $this->userModel->update($id, $data);

                return redirect()->to('admin/manajemen-pengguna')->with('success', 'Pengguna berhasil diperbarui');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return view('admin/edit_pengguna', ['user' => $user]);
    }

    public function deleteUser($id)
    {
        $this->userModel->delete($id);
        return redirect()->to('admin/manajemen-pengguna')->with('success', 'Pengguna berhasil dihapus');
    }

    // Profil Toko
    public function profilToko()
    {
        $data = [
            'title' => 'Profil Toko',
            'profil' => $this->profilModel->first()
        ];

        return view('admin/profil_toko_admin', $data);
    }

    public function updateProfilToko()
    {
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'nama_toko' => 'required',
                'alamat' => 'required',
                'no_telp' => 'required',
                'email' => 'required|valid_email'
            ];

            if ($this->validate($rules)) {
                $data = [
                    'nama_toko' => $this->request->getPost('nama_toko'),
                    'alamat' => $this->request->getPost('alamat'),
                    'no_telp' => $this->request->getPost('no_telp'),
                    'email' => $this->request->getPost('email'),
                    'deskripsi' => $this->request->getPost('deskripsi')
                ];

                // Handle logo upload
                $logo = $this->request->getFile('logo');
                if ($logo->isValid() && !$logo->hasMoved()) {
                    $newName = $logo->getRandomName();
                    $logo->move('uploads/logo', $newName);
                    $data['logo'] = 'uploads/logo/' . $newName;
                }

                if ($this->profilModel->countAll() > 0) {
                    $this->profilModel->update(1, $data);
                } else {
                    $this->profilModel->insert($data);
                }

                return redirect()->to('admin/profil-toko')->with('success', 'Profil toko berhasil diperbarui');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        return redirect()->to('admin/profil-toko');
    }
}
