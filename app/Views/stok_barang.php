<?= $this->extend($role === 'admin' ? 'layouts/admin' : 'layouts/user') ?>
<?= $this->section('title') ?>Stok Barang<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Stok Barang</h2>

<div class="main-container">
  <div class="main-card">
    <div class="main-content">
      <!-- Profil Toko Print Only -->
      <?php if (!empty($profil_toko)): ?>
      <div class="profil-toko-print" style="display:none;text-align:center;margin-bottom:24px;">
        <div style="font-size:20px;font-weight:bold;"> <?= esc($profil_toko['nama_toko']) ?> </div>
        <div>Pemilik: <?= esc($profil_toko['nama_pemilik']) ?> | Telp: <?= esc($profil_toko['no_telepon']) ?></div>
        <div>Alamat: <?= esc($profil_toko['alamat']) ?></div>
      </div>
      <?php endif; ?>
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
            <button type="button" class="btn btn-primary" onclick="openModal('tambahBarang')">
              <i class="fas fa-plus"></i> Tambah Barang
            </button>
          </div>
        </div>
        <form method="get" id="filterForm">
          <div class="filter-controls">
            <div class="filter-group">
              <label for="search">Pencarian</label>
              <input type="text" name="search" placeholder="Cari kode, nama, kategori..." value="<?= esc($filterSearch) ?>">
            </div>
            <div class="filter-group">
              <label for="kategori">Kategori</label>
              <select name="kategori">
                <option value="">Semua Kategori</option>
                <?php foreach ($kategoriList as $kat): ?>
                  <option value="<?= esc($kat) ?>" <?= $filterKategori == $kat ? 'selected' : '' ?>><?= esc($kat) ?></option>
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
          <input type="hidden" name="kategori" value="<?= esc($filterKategori) ?>">
        </form>
      </div>
      <!-- Table Section -->
      <div class="table-container" id="tableContainer">
        <table class="data-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Kategori</th>
              <th>Stok</th>
              <th>Satuan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php if (!empty($stokBarang)): ?>
            <?php $no = 1 + (($currentPage - 1) * $perPage); foreach ($stokBarang as $barang): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($barang['kode_barang']) ?></td>
              <td><?= esc($barang['nama_barang']) ?></td>
              <td><?= esc($barang['kategori_barang']) ?></td>
              <td><?= esc($barang['stok']) ?></td>
              <td><?= esc($barang['satuan']) ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit" onclick="editStokBarang(<?= $barang['id'] ?>)">Edit</a>
                  <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteStokBarang(<?= $barang['id'] ?>, '<?= esc($barang['nama_barang']) ?>')">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="empty-table-message">Tidak ada data barang.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="pagination-bar" id="paginationBar">
        <div class="pagination-info">
          Showing <?= ($total > 0) ? ($perPage * ($currentPage - 1)) + 1 : 0 ?> to <?= min(($perPage * ($currentPage - 1)) + count($stokBarang), $total) ?> of <?= $total ?> entries
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
            <a href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($filterSearch) ?>&kategori=<?= urlencode($filterKategori) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
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
              <a href="?page=<?= $i ?>&search=<?= urlencode($filterSearch) ?>&kategori=<?= urlencode($filterKategori) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params"><?= $i ?></a>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($filterSearch) ?>&kategori=<?= urlencode($filterKategori) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
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

<!-- Modal Tambah/Edit Barang -->
<div id="modalTambahBarang" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3 id="modalTitle">Tambah Barang</h3>
      <span class="close" onclick="closeModal('tambahBarang')">&times;</span>
    </div>
    <form id="formBarang" method="post">
      <input type="hidden" id="barang_id" name="id">
      <div class="modal-body">
        <div class="form-group">
          <label for="kode_barang">Kode Barang</label>
          <input type="text" id="kode_barang" name="kode_barang">
        </div>
        <div class="form-group">
          <label for="nama_barang">Nama Barang</label>
          <input type="text" id="nama_barang" name="nama_barang">
        </div>
        <div class="form-group">
          <label for="kategori_barang">Kategori</label>
          <input type="text" id="kategori_barang" name="kategori_barang" placeholder="Masukkan kategori barang">
        </div>
        <div class="form-group">
          <label for="stok">Stok</label>
          <input type="number" id="stok" name="stok" min="0">
        </div>
        <div class="form-group">
          <label for="satuan">Satuan</label>
          <input type="text" id="satuan" name="satuan">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('tambahBarang')">Batal</button>
        <button type="button" class="btn btn-primary" onclick="handleFormSubmit()">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Export -->
<div id="modalExport" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Export Data Barang</h3>
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