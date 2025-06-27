<!-- ========================================
     HEADER COMPONENT
     File: app/Views/components/header.php
     Deskripsi: Komponen header yang digunakan di seluruh aplikasi
     ======================================== -->
<div class="main-header d-flex align-items-center" id="mainHeader">
    <button id="sidebarToggle" class="btn btn-link p-0 bento-toggle-btn">
        <svg class="bento-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="2" y="2" width="5" height="5" rx="1.2" fill="#007BFF"/>
            <rect x="2" y="9.5" width="5" height="5" rx="1.2" fill="#007BFF"/>
            <rect x="2" y="17" width="5" height="5" rx="1.2" fill="#007BFF"/>
            <rect x="13" y="2" width="5" height="5" rx="1.2" fill="#007BFF"/>
            <rect x="13" y="9.5" width="5" height="5" rx="1.2" fill="#007BFF"/>
            <rect x="13" y="17" width="5" height="5" rx="1.2" fill="#007BFF"/>
        </svg>
    </button>
    <span class="app-title d-flex align-items-center">
        VSTOCK Inventory
    </span>
    <div class="flex-grow-1 text-center">
        <?php
        // Mendeteksi halaman yang sedang aktif berdasarkan URL
        $current_url = current_url();
        $menu_text = '';
        
        if (strpos($current_url, 'dashboard') !== false) {
            $menu_text = 'Menu Utama';
        } elseif (strpos($current_url, 'stok-barang') !== false || 
                  strpos($current_url, 'barang-masuk') !== false || 
                  strpos($current_url, 'barang-keluar') !== false ||
                  strpos($current_url, 'laporan') !== false) {
            $menu_text = 'Manajemen Stok';
        } elseif (strpos($current_url, 'data-customer') !== false || 
                  strpos($current_url, 'data-supplier') !== false || 
                  strpos($current_url, 'data-petugas') !== false) {
            $menu_text = 'Data Master';
        } elseif (strpos($current_url, 'profil') !== false || 
                  strpos($current_url, 'ubah-password') !== false || 
                  strpos($current_url, 'manajemen-pengguna') !== false ||
                  strpos($current_url, 'profil-toko') !== false) {
            $menu_text = 'Pengaturan';
        } else {
            $menu_text = 'Menu Utama';
        }
        ?>
        <?= $menu_text ?>
    </div>
    <div class="user-info d-flex align-items-center ml-auto">
        <!-- Notifikasi -->
        <div class="dropdown mr-3 dropdown-notif">
            <button class="btn btn-link position-relative p-0" id="notifDropdown" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell"></i>
                <span class="badge badge-danger position-absolute d-flex align-items-center justify-content-center">1</span>
            </button>
            <div class="dropdown-menu dropdown-menu-right shadow-sm" aria-labelledby="notifDropdown">
                <span class="dropdown-item font-weight-bold notification-header">Notifikasi</span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-exclamation-circle text-danger mr-2"></i>
                    <div>
                        <div class="font-weight-bold">Stok Habis</div>
                        <small class="text-muted">Stok barang <b>BRG002 - Mouse Gaming</b> telah habis!</small>
                        <small class="text-muted d-block">2 menit yang lalu</small>
                    </div>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-plus-circle text-success mr-2"></i>
                    <div>
                        <div class="font-weight-bold">Barang Ditambahkan</div>
                        <small class="text-muted">Admin berhasil menambahkan <b>Laptop Asus ROG</b></small>
                        <small class="text-muted d-block">15 menit yang lalu</small>
                    </div>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-arrow-down text-info mr-2"></i>
                    <div>
                        <div class="font-weight-bold">Barang Masuk</div>
                        <small class="text-muted">Barang masuk: <b>Keyboard Mechanical</b> dari PT Supplier Jaya</small>
                        <small class="text-muted d-block">1 jam yang lalu</small>
                    </div>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-arrow-up text-warning mr-2"></i>
                    <div>
                        <div class="font-weight-bold">Barang Keluar</div>
                        <small class="text-muted">Barang keluar: <b>Monitor LED</b> untuk Customer John Doe</small>
                        <small class="text-muted d-block">2 jam yang lalu</small>
                    </div>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user-plus text-primary mr-2"></i>
                    <div>
                        <div class="font-weight-bold">User Baru</div>
                        <small class="text-muted">Kasir baru <b>Siti Nurhaliza</b> telah ditambahkan</small>
                        <small class="text-muted d-block">3 jam yang lalu</small>
                    </div>
                </a>
                <a class="dropdown-item" href="#">
                    <i class="fas fa-edit text-info mr-2"></i>
                    <div>
                        <div class="font-weight-bold">Data Diperbarui</div>
                        <small class="text-muted">Data supplier <b>PT Supplier Makmur</b> telah diperbarui</small>
                        <small class="text-muted d-block">5 jam yang lalu</small>
                    </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item notification-view-all" href="#">
                    Lihat Semua
                </a>
            </div>
        </div>
        <!-- Dark Mode Toggle -->
        <button id="darkModeToggle" class="btn btn-sm btn-outline-secondary rounded-circle mr-4" title="Dark Mode">
            <i class="fas fa-moon"></i>
        </button>
        <!-- Profile -->
        <div class="dropdown">
            <a href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="rounded-circle" src="<?= base_url('assets/img/profil.png') ?>" alt="Avatar" width="32" height="32">
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow-sm mt-3" aria-labelledby="userDropdown">
                <span class="dropdown-item-text dropdown-item font-weight-bold text-primary" style="pointer-events: none; cursor: default;">
                    <i class="fas fa-user-tie fa-sm fa-fw mr-2 text-primary"></i>
                    <?= ucfirst(session('username') ?? 'Admin') ?>
                </span>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url(session('role') === 'admin' ? 'admin/profil' : 'user/profil') ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                    Profil Saya
                </a>
                <a class="dropdown-item" href="<?= base_url(session('role') === 'admin' ? 'admin/ubah-password' : 'user/ubah-password') ?>">
                    <i class="fas fa-key fa-sm fa-fw mr-2 text-primary"></i>
                    Ubah Password
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?= base_url('logout') ?>">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-primary"></i>
                    Logout
                </a>
            </div>
        </div>
    </div>
</div> 