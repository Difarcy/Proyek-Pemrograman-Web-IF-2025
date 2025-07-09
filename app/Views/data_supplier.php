<?= $this->extend($role === 'admin' ? 'layouts/admin' : 'layouts/user') ?>
<?= $this->section('title') ?>Data Supplier<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Data Supplier</h2>

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
            <button type="button" class="btn btn-primary" onclick="openTambahSupplierModal()">
              <i class="fas fa-plus"></i> Tambah Supplier
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
              <select name="kota">
                <option value="">Semua Kota</option>
                <option value="Bandung" <?= $filterKota=='Bandung'?'selected':'' ?>>Bandung</option>
                <option value="Jakarta" <?= $filterKota=='Jakarta'?'selected':'' ?>>Jakarta</option>
                <option value="Surabaya" <?= $filterKota=='Surabaya'?'selected':'' ?>>Surabaya</option>
                <option value="Semarang" <?= $filterKota=='Semarang'?'selected':'' ?>>Semarang</option>
                <option value="Yogyakarta" <?= $filterKota=='Yogyakarta'?'selected':'' ?>>Yogyakarta</option>
                <option value="Malang" <?= $filterKota=='Malang'?'selected':'' ?>>Malang</option>
                <option value="Medan" <?= $filterKota=='Medan'?'selected':'' ?>>Medan</option>
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
              <th>Kode Supplier</th>
              <th>Nama Supplier</th>
              <th>Alamat</th>
              <th>Telepon</th>
              <th>Kota</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php if (!empty($suppliers)): ?>
            <?php $no = 1 + (($currentPage - 1) * $perPage); foreach ($suppliers as $supplier): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($supplier['kode_supplier']) ?></td>
              <td><?= esc($supplier['nama_supplier']) ?></td>
              <td><?= esc($supplier['alamat']) ?></td>
              <td><?= esc($supplier['telepon']) ?></td>
              <td><?= esc($supplier['kota']) ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit" onclick="editSupplier(<?= $supplier['id'] ?>)">Edit</a>
                  <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteSupplier(<?= $supplier['id'] ?>, '<?= esc($supplier['nama_supplier']) ?>')">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="empty-table-message">Tidak ada data supplier.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="pagination-bar" id="paginationBar">
        <div class="pagination-info">
          Showing <?= ($total > 0) ? ($perPage * ($currentPage - 1)) + 1 : 0 ?> to <?= min(($perPage * ($currentPage - 1)) + count($suppliers), $total) ?> of <?= $total ?> entries
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

<!-- Modal Export -->
<div id="modalExport" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Export Data Supplier</h3>
      <span class="close" onclick="closeModal('export')">&times;</span>
    </div>
    <div class="modal-body">
      <p>Pilih format file yang ingin di-export:</p>
      <div class="export-options">
        <div class="export-option" onclick="exportData('excel')">
          <div class="export-icon"><i class="fas fa-file-excel"></i></div>
          <div class="export-text">Excel</div>
        </div>
        <div class="export-option" onclick="exportData('pdf')">
          <div class="export-icon"><i class="fas fa-file-pdf"></i></div>
          <div class="export-text">PDF</div>
        </div>
        <div class="export-option" onclick="exportData('csv')">
          <div class="export-icon"><i class="fas fa-file-csv"></i></div>
          <div class="export-text">CSV</div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal Tambah Supplier -->
<div id="modalTambahSupplier" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Tambah Supplier</h3>
      <span class="close" onclick="closeModal('tambahSupplier')">&times;</span>
    </div>
    <form id="formTambahSupplier" method="post" action="<?= base_url(($role === 'admin' ? 'admin' : 'user') . '/data-supplier/store') ?>">
      <div class="modal-body">
        <div class="form-group">
          <label>Kode Supplier</label>
          <input type="text" name="kode_supplier" required>
        </div>
        <div class="form-group">
          <label>Nama Supplier</label>
          <input type="text" name="nama_supplier" required>
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" required>
        </div>
        <div class="form-group">
          <label>Telepon</label>
          <input type="text" name="telepon" required>
        </div>
        <div class="form-group">
          <label>Kota</label>
          <input type="text" name="kota" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('tambahSupplier')">Batal</button>
        <button type="button" class="btn btn-primary" onclick="handleAddSupplierSubmit()">Simpan</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal Edit Supplier -->
<div id="modalEditSupplier" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Edit Supplier</h3>
      <span class="close" onclick="closeModal('editSupplier')">&times;</span>
    </div>
    <form id="formEditSupplier" method="post" action="<?= base_url(($role === 'admin' ? 'admin' : 'user') . '/data-supplier/update') ?>">
      <input type="hidden" name="id" id="edit_supplier_id">
      <div class="modal-body">
        <div class="form-group">
          <label>Kode Supplier</label>
          <input type="text" name="kode_supplier" id="edit_kode_supplier" required>
        </div>
        <div class="form-group">
          <label>Nama Supplier</label>
          <input type="text" name="nama_supplier" id="edit_nama_supplier" required>
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" id="edit_alamat" required>
        </div>
        <div class="form-group">
          <label>Telepon</label>
          <input type="text" name="telepon" id="edit_telepon" required>
        </div>
        <div class="form-group">
          <label>Kota</label>
          <input type="text" name="kota" id="edit_kota" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('editSupplier')">Batal</button>
        <button type="button" class="btn btn-primary" onclick="handleEditSupplierSubmit()">Simpan</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal Export -->
<div id="modalExport" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Export Data Supplier</h3>
      <span class="close" onclick="closeModal('export')">&times;</span>
    </div>
    <div class="modal-body">
      <p>Pilih format file yang ingin di-export:</p>
      <div class="export-options">
        <div class="export-option" onclick="exportData('excel')">
          <div class="export-icon"><i class="fas fa-file-excel"></i></div>
          <div class="export-text">Excel</div>
        </div>
        <div class="export-option" onclick="exportData('pdf')">
          <div class="export-icon"><i class="fas fa-file-pdf"></i></div>
          <div class="export-text">PDF</div>
        </div>
        <div class="export-option" onclick="exportData('csv')">
          <div class="export-icon"><i class="fas fa-file-csv"></i></div>
          <div class="export-text">CSV</div>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?> 