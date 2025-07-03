<header class="main-header">
  <div class="header-section header-left">
    <span class="header-login-time" id="header-login-time">Waktu Login</span>
  </div>
  <div class="header-section header-center">
    <span class="header-title">Sistem Informasi Stok Barang</span>
  </div>
  <div class="header-section header-right" style="position: relative;">
    <img src="<?= base_url('assets/img/ui/profil.png') ?>" alt="Profil" class="header-profile-img" id="profileDropdownBtn" style="cursor:pointer;">
    <div class="profile-dropdown" id="profileDropdown">
      <div class="profile-dropdown-username">
        <i class="fa-solid fa-user" style="min-width:20px;text-align:center;"></i> <?= ucfirst(session()->get('username') ?? 'User') ?>
      </div>
      <a href="<?= base_url('profil') ?>" class="profile-dropdown-link">
        <i class="fa-solid fa-id-badge"></i> Profil
      </a>
      <a href="<?= base_url('ubah-password') ?>" class="profile-dropdown-link">
        <i class="fa-solid fa-key"></i> Reset Password
      </a>
      <div class="profile-dropdown-divider"></div>
      <a href="<?= base_url('logout') ?>" class="profile-dropdown-link">
        <i class="fa-solid fa-right-from-bracket" style="min-width:20px;text-align:center;"></i> Log Out
      </a>
    </div>
  </div>
</header>
