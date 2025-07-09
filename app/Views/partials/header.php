<?php
  $foto = session()->get('foto');
  $fotoPath = FCPATH . 'uploads/profil/' . $foto;
  if ($foto && file_exists($fotoPath)) {
    $imgSrc = base_url('uploads/profil/' . $foto);
  } else {
    $imgSrc = base_url('assets/img/ui/blank_profil.png');
  }
?>
<header class="main-header">
  <div class="header-section header-left">
    <span class="header-login-time" id="header-login-time">
      <?php 
        $lastLogin = session()->get('last_login');
        if ($lastLogin) {
          echo date('d M Y H:i', strtotime($lastLogin));
        } else {
          echo '-';
        }
      ?>
    </span>
  </div>
  <div class="header-section header-center">
    <span class="header-title">Sistem Informasi Stok Barang</span>
  </div>
  <div class="header-section header-right" style="position: relative;">
    <img src="<?= $imgSrc ?>" alt="Profil" class="header-profile-img" id="profileDropdownBtn" style="cursor:pointer;">
    <div class="profile-dropdown" id="profileDropdown">
      <div class="profile-dropdown-username">
        <i class="fa-solid fa-user" style="min-width:20px;text-align:center;"></i> <?= ucfirst(session()->get('username') ?? 'User') ?>
      </div>
      <?php $role = session()->get('role'); ?>
      <a href="<?= base_url(($role === 'admin' ? 'admin' : 'user') . '/profil') ?>" class="profile-dropdown-link">
        <i class="fa-solid fa-id-badge"></i> Profil
      </a>
      <a href="<?= base_url(($role === 'admin' ? 'admin' : 'user') . '/reset-password') ?>" class="profile-dropdown-link">
        <i class="fa-solid fa-key"></i> Reset Password
      </a>
      <div class="profile-dropdown-divider"></div>
      <a href="<?= base_url('logout') ?>" class="profile-dropdown-link">
        <i class="fa-solid fa-right-from-bracket" style="min-width:20px;text-align:center;"></i> Log Out
      </a>
    </div>
  </div>
</header>
