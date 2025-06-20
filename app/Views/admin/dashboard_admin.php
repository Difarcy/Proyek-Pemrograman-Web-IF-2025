<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
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
            overflow: hidden;
            transition: width 0.2s;
            font-size: 14px;
        }
        .sidebar-collapsed {
            width: 70px !important;
        }
        .sidebar .sidebar-content {
            flex: 1 1 auto;
            overflow-y: auto;
            padding-bottom: 1rem;
            height: 100vh;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE 10+ */
        }
        .sidebar .sidebar-content::-webkit-scrollbar {
            width: 0;
            height: 0;
        }
        .sidebar .brand-link {
            display: flex;
            align-items: center;
            padding: 1.1rem 1rem 0.8rem 1rem;
            font-size: 1.1rem;
            font-weight: 700;
            background: #0069d9;
            justify-content: flex-start;
            transition: padding 0.2s, font-size 0.2s;
            margin-bottom: 0.2rem;
        }
        .sidebar-collapsed .brand-link {
            justify-content: center;
            padding: 1.1rem 0 0.8rem 0;
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
        .sidebar .nav-header {
            padding: 1rem 1rem 0.3rem 1rem;
            font-size: 0.93rem;
            color: #cce3ff;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: padding 0.2s, font-size 0.2s;
        }
        .hide-on-collapse {
            transition: opacity 0.2s, width 0.2s;
        }
        .sidebar-collapsed .hide-on-collapse {
            display: none !important;
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
            transition: background 0.25s cubic-bezier(.4,2,.6,1), box-shadow 0.25s, padding 0.2s, margin 0.2s, transform 0.18s;
            font-size: 0.97rem;
            white-space: nowrap;
            cursor: pointer;
        }
        .sidebar-collapsed .nav-link {
            justify-content: center;
            padding: 0.7rem 0.5rem;
            margin-bottom: 0.8rem;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: linear-gradient(90deg, #0056b3 60%, #007bff 100%);
            color: #fff;
            text-decoration: none;
            box-shadow: 0 4px 18px 0 rgba(0,123,255,0.13);
            transform: scale(1.08);
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
        .info-box {
            background: #fff;
            border-radius: 0.6rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            padding: 0.9rem;
            margin-bottom: 1.1rem;
            display: flex;
            align-items: center;
            transition: box-shadow 0.2s;
            font-size: 0.97rem;
        }
        .info-box:hover {
            box-shadow: 0 4px 24px rgba(0,123,255,0.13);
        }
        .info-box-icon {
            font-size: 1.25rem;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.6rem;
            margin-right: 0.8rem;
        }
        .bg-info { background: #17a2b8 !important; color: #fff; }
        .bg-danger { background: #dc3545 !important; color: #fff; }
        .bg-success { background: #28a745 !important; color: #fff; }
        .bg-warning { background: #ffc107 !important; color: #212529; }
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
        .btn, .btn-sm, .btn-info, .btn-primary, .btn-warning, .btn-danger {
            font-size: 0.89rem !important;
            padding: 0.18rem 0.55rem !important;
            border-radius: 0.2rem !important;
            line-height: 1.2 !important;
        }
        .btn i { font-size: 0.98em; margin-right: 2px; }
        .btn:last-child i { margin-right: 0; }
        .btn-group .btn { margin-right: 2px; }
        h1, h5 { font-size: 1.15rem; font-weight: 600; }
        @media (max-width: 991.98px) {
            .sidebar, .main-header { left: 0; }
            .content-wrapper, .collapsed-content { margin-left: 0 !important; padding-top: 70px; }
        }
        /* Dark mode simple */
        .dark-mode {
            background: #181c24 !important;
            color: #e0e0e0 !important;
        }
        .dark-mode .main-header, .dark-mode .content-wrapper, .dark-mode .card, .dark-mode .dropdown-menu {
            background: #23272f !important;
            color: #e0e0e0 !important;
        }
        .dark-mode .sidebar {
            background: #232a36 !important;
        }
        .dark-mode .sidebar .brand-link {
            background: #1a1f27 !important;
        }
        .dark-mode .sidebar .nav-link.active, .dark-mode .sidebar .nav-link:hover {
            background: linear-gradient(90deg, #1a1f27 60%, #232a36 100%) !important;
        }
        .dark-mode .breadcrumb {
            background: transparent !important;
            color: #e0e0e0 !important;
        }
        .dark-mode .dropdown-menu { box-shadow: 0 2px 12px rgba(0,0,0,0.5) !important; }
        .bento-toggle-btn {
            background: transparent;
            border: none;
            outline: none;
            border-radius: 6px;
            box-shadow: none !important;
            outline: none !important;
        }
        .bento-toggle-btn:hover, .bento-toggle-btn:focus, .bento-toggle-btn:active {
            background: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            border: none !important;
        }
        .bento-toggle-btn .bento-icon {
            transition: none;
        }
        .bento-toggle-btn:hover .bento-icon, .bento-toggle-btn:focus .bento-icon, .bento-toggle-btn:active .bento-icon {
            transform: none;
            outline: none !important;
            box-shadow: none !important;
            border: none !important;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #0069d9;
            color: #fff;
        }
        .dropdown-toggle::after {
            display: none !important;
        }
    </style>
</head>
<body>
<div class="sidebar" id="sidebar">
    <div class="sidebar-content">
        <div class="brand-link">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo">
            <span>VSTOCK</span>
        </div>
        <div class="nav-header hide-on-collapse">Menu Utama</div>
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-link active"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        <div class="nav-header hide-on-collapse">Manajemen Stok</div>
        <a href="<?= base_url('admin/stok-barang') ?>" class="nav-link"><i class="fas fa-boxes"></i> <span>Stok Barang</span></a>
        <a href="<?= base_url('admin/barang-masuk') ?>" class="nav-link"><i class="fas fa-arrow-down"></i> <span>Barang Masuk</span></a>
        <a href="<?= base_url('admin/barang-keluar') ?>" class="nav-link"><i class="fas fa-arrow-up"></i> <span>Barang Keluar</span></a>
        <a href="<?= base_url('admin/laporan') ?>" class="nav-link"><i class="fas fa-file-alt"></i> <span>Laporan</span></a>
        <div class="nav-header hide-on-collapse">Data Master</div>
        <a href="<?= base_url('admin/data-customer') ?>" class="nav-link"><i class="fas fa-users"></i> <span>Data Customer</span></a>
        <a href="<?= base_url('admin/data-supplier') ?>" class="nav-link"><i class="fas fa-truck"></i> <span>Data Supplier</span></a>
        <a href="<?= base_url('admin/data-petugas') ?>" class="nav-link"><i class="fas fa-user-tie"></i> <span>Data Petugas</span></a>
        <div class="nav-header hide-on-collapse">Pengaturan</div>
        <a href="<?= base_url('admin/manajemen-pengguna') ?>" class="nav-link"><i class="fas fa-user-cog"></i> <span>Manajemen Pengguna</span></a>
        <a href="<?= base_url('admin/profil-toko') ?>" class="nav-link"><i class="fas fa-store"></i> <span>Profil Toko</span></a>
    </div>
</div>
<div class="main-header d-flex align-items-center" id="mainHeader" style="padding-left:0;">
    <button id="sidebarToggle" class="btn btn-link p-0 bento-toggle-btn" style="font-size:1.5rem;color:#007BFF;display:flex;align-items:center;justify-content:center;width:34px;height:34px;margin-right:6px;margin-left:8px;">
        <!-- Bento menu icon: 6 kotak tebal, 2 kolom x 3 baris, vertikal, jarak antar kotak -->
        <svg class="bento-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="2" y="2" width="5" height="5" rx="1.2" fill="#007BFF"/>
            <rect x="2" y="9.5" width="5" height="5" rx="1.2" fill="#007BFF"/>
            <rect x="2" y="17" width="5" height="5" rx="1.2" fill="#007BFF"/>
            <rect x="13" y="2" width="5" height="5" rx="1.2" fill="#007BFF"/>
            <rect x="13" y="9.5" width="5" height="5" rx="1.2" fill="#007BFF"/>
            <rect x="13" y="17" width="5" height="5" rx="1.2" fill="#007BFF"/>
        </svg>
    </button>
    <span class="app-title d-flex align-items-center" style="margin-left:0;font-size:1.05rem;font-weight:600;color:#007BFF;letter-spacing:0.5px;">
        <i class="fas fa-layer-group mr-2" style="font-size:1.1rem;"></i>VSTOCK Inventory
    </span>
    <div class="flex-grow-1 text-center" style="font-size:1.05rem;font-weight:700;letter-spacing:0.5px;position:absolute;left:0;right:0;margin:auto;pointer-events:none;z-index:0;color:#007BFF;">
        Menu Utama
    </div>
    <div class="user-info d-flex align-items-center ml-auto" style="z-index:1;">
        <!-- Notifikasi -->
        <div class="dropdown mr-2">
            <button class="btn btn-link position-relative p-0" id="notifDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="font-size:1.4rem;color:#343a40;outline:none!important;box-shadow:none!important;">
                <i class="fas fa-bell"></i>
                <span class="badge badge-danger position-absolute d-flex align-items-center justify-content-center" style="top: 0.1px; right: 6px; font-size: 0.5rem; border-radius: 50%; width: 12px; height: 12px; border: 1px solid white;">1</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="notifDropdown" style="min-width:270px;">
                <span class="dropdown-item-text font-weight-bold">Notifikasi</span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item small" href="#"><i class="fas fa-exclamation-circle text-danger mr-2"></i>Stok barang <b>BRG002</b> habis!</a>
                <a class="dropdown-item small" href="#"><i class="fas fa-arrow-down text-info mr-2"></i>Barang masuk: <b>Laptop Asus</b></a>
                <a class="dropdown-item small" href="#"><i class="fas fa-arrow-up text-success mr-2"></i>Barang keluar: <b>Mouse Gaming</b></a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-center small text-gray-500" href="#">Lihat Semua Notifikasi</a>
            </div>
        </div>
        <!-- Dark Mode Switch -->
        <div class="custom-control custom-switch mr-2" style="transform: scale(0.85);">
            <input type="checkbox" class="custom-control-input" id="darkSwitch">
            <label class="custom-control-label" for="darkSwitch" title="Dark Mode" style="cursor:pointer;"></label>
        </div>
        <!-- Profile -->
        <div class="dropdown">
            <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle" src="<?= base_url('assets/img/profil.png') ?>" alt="Avatar" width="32" height="32">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-sm mt-3" aria-labelledby="userDropdown">
                <span class="dropdown-item-text">
                    <i class="fas fa-user-tie fa-sm fa-fw mr-2 text-gray-400"></i>
                    <?= ucfirst(session('username') ?? 'Admin') ?>
                </span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil Saya
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-gray-400"></i>
                    Ubah Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('logout') ?>">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</div>
<div class="content-wrapper" id="contentWrapper">
    <div class="container-fluid">
        <h1 class="mb-4">Dashboard <span class="badge badge-primary">Admin</span></h1>
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info"><i class="fas fa-boxes"></i></span>
                    <div>
                        <span class="info-box-text">Total Barang</span><br>
                        <span class="info-box-number">150</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-danger"><i class="fas fa-arrow-down"></i></span>
                    <div>
                        <span class="info-box-text">Barang Masuk</span><br>
                        <span class="info-box-number">25</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-success"><i class="fas fa-arrow-up"></i></span>
                    <div>
                        <span class="info-box-text">Barang Keluar</span><br>
                        <span class="info-box-number">15</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
                    <div>
                        <span class="info-box-text">Total Customer</span><br>
                        <span class="info-box-number">50</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-white border-0"><h5 class="mb-0">Stok Menipis</h5></div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Stok</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>BRG001</td>
                                    <td>Laptop Asus</td>
                                    <td>5</td>
                                    <td><span class="badge badge-warning">Hampir Habis</span></td>
                                </tr>
                                <tr>
                                    <td>BRG002</td>
                                    <td>Mouse Gaming</td>
                                    <td>3</td>
                                    <td><span class="badge badge-danger">Kritis</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white text-right border-0">
                        <a href="<?= base_url('admin/stok-barang') ?>" class="btn btn-sm btn-info">Lihat Semua</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-white border-0"><h5 class="mb-0">Transaksi Terbaru</h5></div>
                    <div class="card-body p-0">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Jenis</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>VST20240320001</td>
                                    <td>20/03/2024</td>
                                    <td>Barang Masuk</td>
                                    <td><span class="badge badge-success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <td>VST20240320002</td>
                                    <td>20/03/2024</td>
                                    <td>Barang Keluar</td>
                                    <td><span class="badge badge-warning">Proses</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white text-right border-0">
                        <a href="<?= base_url('admin/laporan') ?>" class="btn btn-sm btn-info">Lihat Semua</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Grafik placeholder -->
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-white border-0"><h5 class="mb-0">Grafik Barang Masuk/Keluar</h5></div>
                    <div class="card-body">
                        <div style="height:250px;display:flex;align-items:center;justify-content:center;color:#aaa;">[Grafik Barang Masuk/Keluar]</div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header bg-white border-0"><h5 class="mb-0">Grafik Kategori Barang</h5></div>
                    <div class="card-body">
                        <div style="height:250px;display:flex;align-items:center;justify-content:center;color:#aaa;">[Grafik Kategori Barang]</div>
                    </div>
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
    // Dark mode switch
    const darkSwitch = document.getElementById('darkSwitch');
    darkSwitch.addEventListener('change', function() {
        if (this.checked) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });
</script>
</body>
</html>
