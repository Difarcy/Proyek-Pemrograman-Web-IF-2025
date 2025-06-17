<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= base_url('admin/dashboard') ?>" class="brand-link">
        <img src="<?= base_url('assets/img/logo.png') ?>" alt="VSTOCK Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">VSTOCK</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="<?= base_url('admin/dashboard') ?>" class="nav-link <?= current_url() == base_url('admin/dashboard') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/stok-barang') ?>" class="nav-link <?= current_url() == base_url('admin/stok-barang') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-box"></i>
                        <p>Stok Barang</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/data-customer') ?>" class="nav-link <?= current_url() == base_url('admin/data-customer') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Data Customer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/data-supplier') ?>" class="nav-link <?= current_url() == base_url('admin/data-supplier') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>Data Supplier</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/data-petugas') ?>" class="nav-link <?= current_url() == base_url('admin/data-petugas') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>Data Petugas</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/barang-masuk') ?>" class="nav-link <?= current_url() == base_url('admin/barang-masuk') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-arrow-down"></i>
                        <p>Barang Masuk</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/barang-keluar') ?>" class="nav-link <?= current_url() == base_url('admin/barang-keluar') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-arrow-up"></i>
                        <p>Barang Keluar</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/manajemen-pengguna') ?>" class="nav-link <?= current_url() == base_url('admin/manajemen-pengguna') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-user-cog"></i>
                        <p>Manajemen Pengguna</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/profil-toko') ?>" class="nav-link <?= current_url() == base_url('admin/profil-toko') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-store"></i>
                        <p>Profil Toko</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= base_url('admin/laporan') ?>" class="nav-link <?= current_url() == base_url('admin/laporan') ? 'active' : '' ?>">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Laporan</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
