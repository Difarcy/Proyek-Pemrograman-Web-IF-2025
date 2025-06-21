<div class="main-header d-flex align-items-center" id="mainHeader" style="padding-left:0;">
    <button id="sidebarToggle" class="btn btn-link p-0 bento-toggle-btn" style="font-size:1.5rem;color:#007BFF;display:flex;align-items:center;justify-content:center;width:34px;height:34px;margin-right:6px;margin-left:8px;">
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
    <div class="user-info d-flex align-items-center ml-auto" style="z-index:1;">
        <!-- Notifikasi -->
        <div class="dropdown mr-2 dropdown-notif">
            <button class="btn btn-link position-relative p-0" id="notifDropdown" type="button" aria-haspopup="true" aria-expanded="false" style="font-size:1.4rem;color:#343a40;outline:none!important;box-shadow:none!important;">
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
                <a class="dropdown-item" href="<?= base_url('admin/profil') ?>">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                    Profil Saya
                </a>
                <a class="dropdown-item" href="<?= base_url('admin/ubah-password') ?>">
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