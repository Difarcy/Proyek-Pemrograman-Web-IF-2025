<div class="sidebar" id="sidebar">
    <div class="sidebar-content">
        <div class="brand-link" style="pointer-events: none;">
            <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo">
            <span>VSTOCK</span>
        </div>
        <div class="nav-header hide-on-collapse">Menu Utama</div>
        <a href="<?= base_url('admin/dashboard') ?>" class="nav-link<?= service('uri')->getSegment(2) == 'dashboard' ? ' active' : '' ?>"><i class="fas fa-tachometer-alt"></i> <span>Dashboard</span></a>
        <div class="nav-header hide-on-collapse">Manajemen Stok</div>
        <a href="<?= base_url('admin/stok-barang') ?>" class="nav-link<?= service('uri')->getSegment(2) == 'stok-barang' ? ' active' : '' ?>"><i class="fas fa-boxes"></i> <span>Stok Barang</span></a>
        <a href="<?= base_url('admin/barang-masuk') ?>" class="nav-link<?= service('uri')->getSegment(2) == 'barang-masuk' ? ' active' : '' ?>"><i class="fas fa-arrow-down"></i> <span>Barang Masuk</span></a>
        <a href="<?= base_url('admin/barang-keluar') ?>" class="nav-link<?= service('uri')->getSegment(2) == 'barang-keluar' ? ' active' : '' ?>"><i class="fas fa-arrow-up"></i> <span>Barang Keluar</span></a>
        <a href="<?= base_url('admin/laporan') ?>" class="nav-link<?= service('uri')->getSegment(2) == 'laporan' ? ' active' : '' ?>"><i class="fas fa-file-alt"></i> <span>Laporan</span></a>
        <div class="nav-header hide-on-collapse">Data Master</div>
        <a href="<?= base_url('admin/data-customer') ?>" class="nav-link<?= service('uri')->getSegment(2) == 'data-customer' ? ' active' : '' ?>"><i class="fas fa-users"></i> <span>Data Customer</span></a>
        <a href="<?= base_url('admin/data-supplier') ?>" class="nav-link<?= service('uri')->getSegment(2) == 'data-supplier' ? ' active' : '' ?>"><i class="fas fa-truck"></i> <span>Data Supplier</span></a>
        <a href="<?= base_url('admin/data-petugas') ?>" class="nav-link<?= service('uri')->getSegment(2) == 'data-petugas' ? ' active' : '' ?>"><i class="fas fa-user-tie"></i> <span>Data Petugas</span></a>
        <div class="nav-header hide-on-collapse">Pengaturan</div>
        <a href="<?= base_url('admin/manajemen-pengguna') ?>" class="nav-link<?= service('uri')->getSegment(2) == 'manajemen-pengguna' ? ' active' : '' ?>"><i class="fas fa-user-cog"></i> <span>Manajemen Pengguna</span></a>
        <a href="<?= base_url('admin/profil-toko') ?>" class="nav-link<?= service('uri')->getSegment(2) == 'profil-toko' ? ' active' : '' ?>"><i class="fas fa-store"></i> <span>Profil Toko</span></a>
    </div>
</div> 