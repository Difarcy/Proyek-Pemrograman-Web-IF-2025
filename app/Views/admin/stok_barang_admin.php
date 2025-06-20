<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stok Barang Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        html, body {
            font-family: 'Inter', Arial, Helvetica, sans-serif;
            font-size: 15px;
            background: #f4f6f9;
        }
        .main-header {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 56px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            z-index: 1100;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            border-bottom-left-radius: 16px;
            border-bottom-right-radius: 16px;
            transition: left 0.2s;
            font-size: 15px;
        }
        .main-header .app-title {
            font-size: 1.05rem;
            font-weight: 600;
            color: #007BFF;
            letter-spacing: 0.5px;
        }
        .main-header .user-info {
            margin-left: auto;
            display: flex;
            align-items: center;
            font-size: 0.97rem;
        }
        .main-header .user-info i {
            margin-right: 7px;
            color: #007BFF;
            font-size: 1.1rem;
        }
        .sidebar {
            min-height: 100vh;
            background: #007BFF;
            color: #fff;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1200;
            padding-bottom: 2rem;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 8px rgba(0,0,0,0.06);
            border-top-right-radius: 18px;
            border-bottom-right-radius: 18px;
            overflow: hidden;
            transition: width 0.2s;
            font-size: 14px;
        }
        .sidebar-collapsed {
            width: 70px !important;
        }
        .sidebar .brand-link {
            display: flex;
            align-items: center;
            padding: 1.1rem 1rem 0.8rem 1rem;
            font-size: 1.1rem;
            font-weight: 700;
            background: #0069d9;
            border-top-right-radius: 18px;
            transition: padding 0.2s, font-size 0.2s;
        }
        .sidebar-collapsed .brand-link span {
            display: none;
        }
        .sidebar .brand-link img {
            height: 28px;
            margin-right: 10px;
            transition: margin 0.2s;
        }
        .sidebar-collapsed .brand-link img {
            margin-right: 0;
        }
        .sidebar .sidebar-content {
            flex: 1 1 auto;
            overflow-y: auto;
            padding-bottom: 1rem;
            height: calc(100vh - 70px);
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE 10+ */
        }
        .sidebar .sidebar-content::-webkit-scrollbar {
            width: 0;
            height: 0;
        }
        .sidebar .nav-header {
            padding: 1rem 1rem 0.3rem 1rem;
            font-size: 0.93rem;
            color: #cce3ff;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: padding 0.2s, font-size 0.2s;
        }
        .sidebar-collapsed .nav-header {
            padding: 1rem 0.5rem 0.3rem 0.5rem;
            font-size: 0.85rem;
            text-align: center;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 0.55rem 1.2rem;
            display: flex;
            align-items: center;
            border-radius: 0.3rem;
            margin-bottom: 0.15rem;
            transition: background 0.2s, box-shadow 0.2s, padding 0.2s;
            font-size: 0.97rem;
            white-space: nowrap;
        }
        .sidebar-collapsed .nav-link {
            justify-content: center;
            padding: 0.55rem 0.5rem;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: #0056b3;
            color: #fff;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.10);
        }
        .sidebar .nav-link i {
            margin-right: 8px;
            font-size: 1.08rem;
            transition: margin 0.2s;
        }
        .sidebar-collapsed .nav-link i {
            margin-right: 0;
        }
        .sidebar .nav-link span {
            transition: opacity 0.2s, width 0.2s;
        }
        .sidebar-collapsed .nav-link span {
            display: none;
        }
        .content-wrapper {
            margin-left: 250px;
            padding: 76px 1.2rem 1.2rem 1.2rem;
            min-height: 100vh;
            transition: margin-left 0.2s;
            font-size: 0.97rem;
        }
        .collapsed-content {
            margin-left: 70px !important;
        }
        .main-header.collapsed-header {
            left: 70px !important;
        }
        .card { border-radius: 0.6rem; box-shadow: 0 2px 12px rgba(0,0,0,0.07); border: none; font-size: 0.97rem; }
        .badge-primary { background: #007BFF; font-size: 0.85rem; }
        .card-header, .card-footer { font-size: 0.97rem; }
        .table thead th {
            background: #e9f2ff;
            color: #007BFF;
            border-top: none;
            font-size: 0.97rem;
        }
        .table td, .table th { padding: 0.55rem 0.7rem; font-size: 0.97rem; }
        .btn-warning, .btn-danger { box-shadow: 0 1px 4px rgba(0,0,0,0.07); font-size: 0.93rem; }
        .btn-warning:hover, .btn-danger:hover { opacity: 0.9; }
        h1, h5 { font-size: 1.15rem; font-weight: 600; }
        @media (max-width: 991.98px) {
            .sidebar, .main-header { left: 0; }
            .content-wrapper, .collapsed-content { margin-left: 0 !important; padding-top: 70px; }
        }
    </style>
</head>
<body>
<div class="sidebar" id="sidebar">
    <div class="brand-link">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo">
        <span>VSTOCK</span>
    </div>
    <div class="sidebar-content">
        <div class="nav-header">Menu Utama</div>
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-link"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        <div class="nav-header">Manajemen Stok</div>
        <a href="<?= base_url('admin/stok-barang') ?>" class="nav-link active"><i class="fas fa-boxes"></i> <span>Stok Barang</span></a>
        <a href="<?= base_url('admin/barang-masuk') ?>" class="nav-link"><i class="fas fa-arrow-down"></i> <span>Barang Masuk</span></a>
        <a href="<?= base_url('admin/barang-keluar') ?>" class="nav-link"><i class="fas fa-arrow-up"></i> <span>Barang Keluar</span></a>
        <a href="<?= base_url('admin/laporan') ?>" class="nav-link"><i class="fas fa-file-alt"></i> <span>Laporan</span></a>
        <div class="nav-header">Data Master</div>
        <a href="<?= base_url('admin/data-customer') ?>" class="nav-link"><i class="fas fa-users"></i> <span>Data Customer</span></a>
        <a href="<?= base_url('admin/data-supplier') ?>" class="nav-link"><i class="fas fa-truck"></i> <span>Data Supplier</span></a>
        <a href="<?= base_url('admin/data-petugas') ?>" class="nav-link"><i class="fas fa-user-tie"></i> <span>Data Petugas</span></a>
        <div class="nav-header">Pengaturan</div>
        <a href="<?= base_url('admin/manajemen-pengguna') ?>" class="nav-link"><i class="fas fa-user-cog"></i> <span>Manajemen Pengguna</span></a>
        <a href="<?= base_url('admin/profil-toko') ?>" class="nav-link"><i class="fas fa-store"></i> <span>Profil Toko</span></a>
    </div>
</div>
<div class="main-header" id="mainHeader">
    <button id="sidebarToggle" class="btn btn-link p-0 mr-3" style="font-size:1.5rem;color:#007BFF;"><i class="fas fa-bars"></i></button>
    <span class="app-title"><i class="fas fa-layer-group"></i> VSTOCK Inventory</span>
    <div class="user-info">
        <i class="fas fa-user-circle"></i> Admin
    </div>
</div>
<div class="content-wrapper" id="contentWrapper">
    <div class="container-fluid">
        <h1 class="mb-4">Stok Barang <span class="badge badge-primary">Admin</span></h1>
        <div class="card">
            <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
                <h5 class="mb-0">Daftar Stok Barang</h5>
                <a href="<?= base_url('admin/stok-barang/create') ?>" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah Barang</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Satuan</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Contoh data statis, ganti dengan data dinamis dari controller -->
                            <tr>
                                <td>BRG001</td>
                                <td>Laptop Asus</td>
                                <td>Elektronik</td>
                                <td>5</td>
                                <td>Unit</td>
                                <td>10.000.000</td>
                                <td>Laptop untuk kerja</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <tr>
                                <td>BRG002</td>
                                <td>Mouse Gaming</td>
                                <td>Elektronik</td>
                                <td>3</td>
                                <td>Unit</td>
                                <td>250.000</td>
                                <td>Mouse untuk gaming</td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            <!-- Data dinamis bisa di-loop di sini -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const sidebar = document.getElementById('sidebar');
    const contentWrapper = document.getElementById('contentWrapper');
    const mainHeader = document.getElementById('mainHeader');
    const sidebarToggle = document.getElementById('sidebarToggle');
    let collapsed = false;
    sidebarToggle.addEventListener('click', function() {
        collapsed = !collapsed;
        sidebar.classList.toggle('sidebar-collapsed', collapsed);
        contentWrapper.classList.toggle('collapsed-content', collapsed);
        mainHeader.classList.toggle('collapsed-header', collapsed);
    });
</script>
</body>
</html>
