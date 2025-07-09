<?= $this->extend($role === 'admin' ? 'layouts/admin' : 'layouts/user') ?>
<?= $this->section('title') ?>Data Customer<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Data Customer</h2>

<div class="main-container">
  <div class="main-card">
    <div class="main-content">
      <!-- Filter Section -->
      <div class="filter-section">
        <div class="filter-header">
          <div class="filter-controls">
            <button type="button" class="btn btn-success" onclick="openModal('export')">
              <i class="fas fa-file-excel"></i> Export
            </button>
            <button type="button" class="btn btn-info" onclick="printPage()">
              <i class="fas fa-print"></i> Cetak
            </button>
            <button type="button" class="btn btn-primary" onclick="openTambahCustomerModal();">
              <i class="fas fa-plus"></i> Tambah Customer
            </button>
          </div>
        </div>
        <form method="get" id="filterForm">
          <div class="filter-controls">
            <div class="filter-group">
              <label for="search">Pencarian</label>
              <input type="text" name="search" placeholder="Cari nama, alamat, telepon..." value="<?= esc($filterSearch) ?>">
            </div>
            <div class="filter-group">
              <label for="kota">Kota</label>
              <select name="kota" id="kota" onchange="this.form.submit()">
                <option value="">Semua Kota</option>
                <?php foreach ($kotaList as $kota): ?>
                  <option value="<?= esc($kota['kota']) ?>" <?= $filterKota == $kota['kota'] ? 'selected' : '' ?>><?= esc($kota['kota']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="filter-group">
              <label>&nbsp;</label>
              <button type="button" class="btn btn-outline-secondary" onclick="handleResetButton()">
                <i class="fas fa-refresh"></i> Reset
              </button>
            </div>
          </div>
        </form>
      </div>
      <!-- Show Entries Filter -->
      <div class="show-entries-bar" id="showEntriesBar">
        <form method="get" id="entriesForm" class="entries-form">
          <label for="entries">Show</label>
          <select id="entries" name="entries">
            <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
            <option value="25" <?= ($perPage == 25) ? 'selected' : '' ?>>25</option>
            <option value="50" <?= ($perPage == 50) ? 'selected' : '' ?>>50</option>
            <option value="100" <?= ($perPage == 100) ? 'selected' : '' ?>>100</option>
          </select>
          <span>entries</span>
          <input type="hidden" name="search" value="<?= esc($filterSearch) ?>">
          <input type="hidden" name="kota" value="<?= esc($filterKota) ?>">
        </form>
      </div>
      <!-- Profil Toko Print Only -->
      <?php if (!empty($profil_toko)): ?>
      <div class="profil-toko-print" style="display:none;text-align:center;margin-bottom:24px;">
        <div style="font-size:20px;font-weight:bold;"> <?= esc($profil_toko['nama_toko']) ?> </div>
        <div>Pemilik: <?= esc($profil_toko['nama_pemilik']) ?> | Telp: <?= esc($profil_toko['no_telepon']) ?></div>
        <div>Alamat: <?= esc($profil_toko['alamat']) ?></div>
      </div>
      <?php endif; ?>
      <!-- Table Section -->
      <div class="table-container" id="tableContainer">
        <table class="data-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Customer</th>
              <th>Nama Customer</th>
              <th>Alamat</th>
              <th>Telepon</th>
              <th>Kota</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php if (!empty($customers)): ?>
            <?php $no = 1 + (($currentPage - 1) * $perPage); foreach ($customers as $customer): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($customer['kode_customer']) ?></td>
              <td><?= esc($customer['nama_customer']) ?></td>
              <td><?= esc($customer['alamat']) ?></td>
              <td><?= esc($customer['telepon']) ?></td>
              <td><?= esc($customer['kota']) ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit" onclick="editCustomer(<?= $customer['id'] ?>)">Edit</a>
                  <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteCustomer(<?= $customer['id'] ?>, '<?= esc($customer['nama_customer']) ?>')">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="empty-table-message">Tidak ada data customer.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="pagination-bar" id="paginationBar">
        <div class="pagination-info">
          Showing <?= ($total > 0) ? ($perPage * ($currentPage - 1)) + 1 : 0 ?> to <?= min(($perPage * ($currentPage - 1)) + count($customers), $total) ?> of <?= $total ?> entries
        </div>
        <div class="pagination-nav">
          <?php
          $startPage = max(1, $currentPage - 1);
          $endPage = min($totalPages, $currentPage + 1);
          if ($currentPage <= 2) {
              $endPage = min($totalPages, 3);
          }
          if ($currentPage >= $totalPages - 1) {
              $startPage = max(1, $totalPages - 2);
          }
          ?>
          <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($filterSearch) ?>&kota=<?= urlencode($filterKota) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
              <i class="fas fa-chevron-left"></i>
            </a>
          <?php else: ?>
            <span class="pagination-link disabled">
              <i class="fas fa-chevron-left"></i>
            </span>
          <?php endif; ?>
          <?php for ($i = $startPage; $i <= $endPage; $i++): ?>
            <?php if ($i == $currentPage): ?>
              <span class="pagination-link active"><?= $i ?></span>
            <?php else: ?>
              <a href="?page=<?= $i ?>&search=<?= urlencode($filterSearch) ?>&kota=<?= urlencode($filterKota) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params"><?= $i ?></a>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($filterSearch) ?>&kota=<?= urlencode($filterKota) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
              <i class="fas fa-chevron-right"></i>
            </a>
          <?php else: ?>
            <span class="pagination-link disabled">
              <i class="fas fa-chevron-right"></i>
            </span>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal Tambah Customer -->
<div id="modalTambahCustomer" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Tambah Customer</h3>
      <span class="close" onclick="closeModal('tambahCustomer')">&times;</span>
    </div>
    <form id="formTambahCustomer" method="post" action="<?= base_url(($role === 'admin' ? 'admin' : 'user') . '/data-customer/store') ?>">
      <div class="modal-body">
        <div class="form-group">
          <label for="tambah_kode_customer">Kode Customer</label>
          <input type="text" id="tambah_kode_customer" name="kode_customer" required>
        </div>
        <div class="form-group">
          <label for="tambah_nama_customer">Nama Customer</label>
          <input type="text" id="tambah_nama_customer" name="nama_customer" required>
        </div>
        <div class="form-group">
          <label for="tambah_alamat">Alamat</label>
          <input type="text" id="tambah_alamat" name="alamat" required>
        </div>
        <div class="form-group">
          <label for="tambah_telepon">Telepon</label>
          <input type="text" id="tambah_telepon" name="telepon" required>
        </div>
        <div class="form-group">
          <label for="tambah_kota">Kota</label>
          <input type="text" id="tambah_kota" name="kota" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('tambahCustomer')">Batal</button>
        <button type="button" class="btn btn-primary" onclick="handleAddCustomerSubmit()">Simpan</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal Edit Customer -->
<div id="modalEditCustomer" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Edit Customer</h3>
      <span class="close" onclick="closeModal('editCustomer')">&times;</span>
    </div>
    <form id="formEditCustomer" method="post" action="<?= base_url(($role === 'admin' ? 'admin' : 'user') . '/data-customer/update') ?>">
      <input type="hidden" id="edit_customer_id" name="id">
      <div class="modal-body">
        <div class="form-group">
          <label for="edit_kode_customer">Kode Customer</label>
          <input type="text" id="edit_kode_customer" name="kode_customer">
        </div>
        <div class="form-group">
          <label for="edit_nama_customer">Nama Customer</label>
          <input type="text" id="edit_nama_customer" name="nama_customer">
        </div>
        <div class="form-group">
          <label for="edit_alamat">Alamat</label>
          <input type="text" id="edit_alamat" name="alamat">
        </div>
        <div class="form-group">
          <label for="edit_telepon">Telepon</label>
          <input type="text" id="edit_telepon" name="telepon">
        </div>
        <div class="form-group">
          <label for="edit_kota">Kota</label>
          <input type="text" id="edit_kota" name="kota">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('editCustomer')">Batal</button>
        <button type="button" class="btn btn-primary" onclick="handleEditCustomerSubmit()">Simpan</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal Export -->
<div id="modalExport" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Export Data Customer</h3>
      <span class="close" onclick="closeModal('export')">&times;</span>
    </div>
    <div class="modal-body">
      <p>Pilih format file yang ingin di-export:</p>
      <div class="export-options">
        <div class="export-option" onclick="exportCustomer('excel')">
          <div class="export-icon"><i class="fas fa-file-excel"></i></div>
          <div class="export-text">Excel</div>
        </div>
        <div class="export-option" onclick="exportCustomer('pdf')">
          <div class="export-icon"><i class="fas fa-file-pdf"></i></div>
          <div class="export-text">PDF</div>
        </div>
        <div class="export-option" onclick="exportCustomer('csv')">
          <div class="export-icon"><i class="fas fa-file-csv"></i></div>
          <div class="export-text">CSV</div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?> 