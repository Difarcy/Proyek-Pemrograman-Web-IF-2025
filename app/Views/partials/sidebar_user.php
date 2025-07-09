<aside class="sidebar sidebar-user">
  <div class="sidebar-content">
    <div class="logo-details">
      <div class="sidebar-logo text-center mr-3">
        <img src="<?= base_url('assets/img/icon/vstock.png') ?>" alt="Logo" class="logo-img">
      </div>
      <div class="logo_name">VStock</div>
    </div>
    <ul class="nav-list">
      <li>
        <a href="<?= base_url('user/dashboard') ?>" class="<?= service('uri')->getSegment(2) == 'dashboard' ? ' active' : '' ?>">
          <i class="fa-solid fa-gauge"></i>
          <span class="links_name">Dashboard</span>
        </a>
        <span class="tooltip">Dashboard</span>
      </li>
      <li>
        <a href="<?= base_url('user/stok-barang') ?>" class="<?= service('uri')->getSegment(2) == 'stok-barang' ? ' active' : '' ?>">
          <i class="fa-solid fa-boxes-stacked"></i>
          <span class="links_name">Stok Barang</span>
        </a>
        <span class="tooltip">Stok Barang</span>
      </li>
      <li>
        <a href="<?= base_url('user/barang-masuk') ?>" class="<?= service('uri')->getSegment(2) == 'barang-masuk' ? ' active' : '' ?>">
          <i class="fa-solid fa-arrow-down"></i>
          <span class="links_name">Barang Masuk</span>
        </a>
        <span class="tooltip">Barang Masuk</span>
      </li>
      <li>
        <a href="<?= base_url('user/barang-keluar') ?>" class="<?= service('uri')->getSegment(2) == 'barang-keluar' ? ' active' : '' ?>">
          <i class="fa-solid fa-arrow-up"></i>
          <span class="links_name">Barang Keluar</span>
        </a>
        <span class="tooltip">Barang Keluar</span>
      </li>

      <li>
        <a href="<?= base_url('user/data-customer') ?>" class="<?= service('uri')->getSegment(2) == 'data-customer' ? ' active' : '' ?>">
          <i class="fa-solid fa-users"></i>
          <span class="links_name">Data Customer</span>
        </a>
        <span class="tooltip">Data Customer</span>
      </li>
      <li>
        <a href="<?= base_url('user/data-supplier') ?>" class="<?= service('uri')->getSegment(2) == 'data-supplier' ? ' active' : '' ?>">
          <i class="fa-solid fa-truck"></i>
          <span class="links_name">Data Supplier</span>
        </a>
        <span class="tooltip">Data Supplier</span>
      </li>
      <li>
        <a href="<?= base_url('user/data-petugas') ?>" class="<?= service('uri')->getSegment(2) == 'data-petugas' ? ' active' : '' ?>">
          <i class="fa-solid fa-user-tie"></i>
          <span class="links_name">Data Petugas</span>
        </a>
        <span class="tooltip">Data Petugas</span>
      </li>
    </ul>
  </div>
</aside>
