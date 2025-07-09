<div class="sidebar-content">
    <div class="logo-details">
        <div class="sidebar-logo text-center mr-3">
            <img src="<?= base_url('assets/img/icon/vstock.png') ?>" alt="Logo" class="logo-img">
        </div>
        <div class="logo_name">VStock</div>
    </div>
    <ul class="nav-list">
        <li>
            <a href="<?= base_url('admin/dashboard') ?>" class="<?= service('uri')->getSegment(2) == 'dashboard' ? ' active' : '' ?>">
                <i class="fa-solid fa-gauge"></i>
                <span class="links_name">Dashboard</span>
            </a>
            <span class="tooltip">Dashboard</span>
        </li>
        <li>
            <a href="<?= base_url('admin/stok-barang') ?>" class="<?= service('uri')->getSegment(2) == 'stok-barang' ? ' active' : '' ?>">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span class="links_name">Stok Barang</span>
            </a>
            <span class="tooltip">Stok Barang</span>
        </li>
        <li>
            <a href="<?= base_url('admin/barang-masuk') ?>" class="<?= service('uri')->getSegment(2) == 'barang-masuk' ? ' active' : '' ?>">
                <i class="fa-solid fa-arrow-down"></i>
                <span class="links_name">Barang Masuk</span>
            </a>
            <span class="tooltip">Barang Masuk</span>
        </li>
        <li>
            <a href="<?= base_url('admin/barang-keluar') ?>" class="<?= service('uri')->getSegment(2) == 'barang-keluar' ? ' active' : '' ?>">
                <i class="fa-solid fa-arrow-up"></i>
                <span class="links_name">Barang Keluar</span>
            </a>
            <span class="tooltip">Barang Keluar</span>
        </li>

        <li>
            <a href="<?= base_url('admin/data-customer') ?>" class="<?= service('uri')->getSegment(2) == 'data-customer' ? ' active' : '' ?>">
                <i class="fa-solid fa-users"></i>
                <span class="links_name">Data Customer</span>
            </a>
            <span class="tooltip">Data Customer</span>
        </li>
        <li>
            <a href="<?= base_url('admin/data-supplier') ?>" class="<?= service('uri')->getSegment(2) == 'data-supplier' ? ' active' : '' ?>">
                <i class="fa-solid fa-truck"></i>
                <span class="links_name">Data Supplier</span>
            </a>
            <span class="tooltip">Data Supplier</span>
        </li>
        <li>
            <a href="<?= base_url('admin/data-petugas') ?>" class="<?= service('uri')->getSegment(2) == 'data-petugas' ? ' active' : '' ?>">
                <i class="fa-solid fa-user-tie"></i>
                <span class="links_name">Data Petugas</span>
            </a>
            <span class="tooltip">Data Petugas</span>
        </li>
        <li>
            <a href="<?= base_url('admin/kelola-pengguna') ?>" class="<?= service('uri')->getSegment(2) == 'kelola-pengguna' ? ' active' : '' ?>">
                <i class="fa-solid fa-users-gear"></i>
                <span class="links_name">Kelola Pengguna</span>
            </a>
            <span class="tooltip">Kelola Pengguna</span>
        </li>
        <li>
            <a href="<?= base_url('admin/profil-toko') ?>" class="<?= service('uri')->getSegment(2) == 'profil-toko' ? ' active' : '' ?>">
                <i class="fa-solid fa-store"></i>
                <span class="links_name">Profil Toko</span>
            </a>
            <span class="tooltip">Profil Toko</span>
        </li>
    </ul>
</div>
