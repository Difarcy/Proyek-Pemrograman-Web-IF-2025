<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('user/dashboard') ?>" class="brand-link">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="VSTOCK Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">VSTOCK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= base_url('assets/img/user.png') ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= base_url('user/profil') ?>" class="d-block"><?= session()->get('nama') ?></a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('user/dashboard') ?>" class="nav-link <?= current_url() == base_url('user/dashboard') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user/stok-barang') ?>" class="nav-link <?= current_url() == base_url('user/stok-barang') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-boxes"></i>
                        <p>Stok Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user/data-customer') ?>" class="nav-link <?= current_url() == base_url('user/data-customer') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data Customer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user/data-supplier') ?>" class="nav-link <?= current_url() == base_url('user/data-supplier') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Data Supplier</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user/data-petugas') ?>" class="nav-link <?= current_url() == base_url('user/data-petugas') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Data Petugas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user/barang-masuk') ?>" class="nav-link <?= current_url() == base_url('user/barang-masuk') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-arrow-down"></i>
                        <p>Barang Masuk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user/barang-keluar') ?>" class="nav-link <?= current_url() == base_url('user/barang-keluar') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-arrow-up"></i>
                        <p>Barang Keluar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('user/laporan') ?>" class="nav-link <?= current_url() == base_url('user/laporan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Laporan</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('auth/logout') ?>" class="nav-link text-danger">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
