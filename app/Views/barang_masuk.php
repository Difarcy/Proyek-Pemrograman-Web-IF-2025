<?= $this->extend($role === 'admin' ? 'layouts/admin' : 'layouts/user') ?>
<?= $this->section('title') ?>Barang Masuk<?= $this->endSection() ?>
<?= $this->section('content') ?>

<?php
$filterSearch = $filterSearch ?? '';
$filterTanggalAwal = $filterTanggalAwal ?? '';
$filterTanggalAkhir = $filterTanggalAkhir ?? '';
$perPage = $perPage ?? 10;
$currentPage = $currentPage ?? 1;
$totalPages = $totalPages ?? 1;
$total = $total ?? 0;
$barangMasuk = $barangMasuk ?? [];
?>

<h2 class="main-page-title">Barang Masuk</h2>

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
            <button type="button" class="btn btn-primary" onclick="openModal('tambahBarangMasuk')">
              <i class="fas fa-plus"></i> Input Barang Masuk
            </button>
          </div>
        </div>
        <form method="get" id="filterForm">
          <div class="filter-controls">
            <div class="filter-group">
              <label for="search">Pencarian</label>
              <input type="text" id="search" name="search" placeholder="Cari no surat jalan, supplier, nama barang..." value="<?= esc($filterSearch) ?>">
            </div>
            <div class="filter-group">
              <label for="filter_tanggal_awal">Tanggal Awal</label>
              <input type="date" id="filter_tanggal_awal" name="tanggal_awal" value="<?= esc($filterTanggalAwal ?? '') ?>">
            </div>
            <div class="filter-group">
              <label for="filter_tanggal_akhir">Tanggal Akhir</label>
              <input type="date" id="filter_tanggal_akhir" name="tanggal_akhir" value="<?= esc($filterTanggalAkhir ?? '') ?>">
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
          <input type="hidden" name="tanggal_awal" value="<?= esc($filterTanggalAwal ?? '') ?>">
          <input type="hidden" name="tanggal_akhir" value="<?= esc($filterTanggalAkhir ?? '') ?>">
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
                <th>No.</th>
                <th>No Surat Jalan</th>
                <th>Tanggal</th>
                <th>Supplier</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Satuan</th>
                <th>Petugas</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php if (!empty($barangMasuk)): ?>
            <?php $no = 1 + (($currentPage - 1) * $perPage); foreach ($barangMasuk as $barang): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($barang['no_surat_jalan']) ?></td>
              <td><?= esc($barang['tanggal_terima']) ?></td>
              <td><?= esc($barang['supplier']) ?></td>
              <td><?= esc($barang['nama_barang']) ?></td>
              <td><?= esc($barang['jumlah']) ?></td>
              <td><?= esc($barang['satuan']) ?></td>
              <td><?= esc($barang['petugas']) ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit" onclick="editBarangMasuk(<?= $barang['id'] ?>)">Edit</a>
                  <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteBarangMasuk(<?= $barang['id'] ?>, '<?= esc($barang['nama_barang']) ?>')">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="9" class="empty-table-message">Tidak ada data barang.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="pagination-bar" id="paginationBar">
        <div class="pagination-info">
          Showing <?= ($total > 0) ? ($perPage * ($currentPage - 1)) + 1 : 0 ?> to <?= min(($perPage * ($currentPage - 1)) + count($barangMasuk), $total) ?> of <?= $total ?> entries
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
            <a href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($filterSearch) ?>&tanggal_awal=<?= urlencode($filterTanggalAwal) ?>&tanggal_akhir=<?= urlencode($filterTanggalAkhir) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
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
              <a href="?page=<?= $i ?>&search=<?= urlencode($filterSearch) ?>&tanggal_awal=<?= urlencode($filterTanggalAwal) ?>&tanggal_akhir=<?= urlencode($filterTanggalAkhir) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params"><?= $i ?></a>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($filterSearch) ?>&tanggal_awal=<?= urlencode($filterTanggalAwal) ?>&tanggal_akhir=<?= urlencode($filterTanggalAkhir) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
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
      <h3>Export Data Barang Masuk</h3>
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
<!-- Modal Tambah Barang Masuk -->
<div id="modalTambahBarangMasuk" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Input Barang Masuk</h3>
      <span class="close" onclick="closeModal('tambahBarangMasuk')">&times;</span>
    </div>
    <form id="formTambahBarangMasuk" method="post" action="<?= base_url(($role === 'admin' ? 'admin' : 'user') . '/barang-masuk/store') ?>">
      <div class="modal-body">
        <div class="form-group">
          <label>No Surat Jalan</label>
          <input type="text" name="no_surat_jalan" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Tanggal Terima</label>
          <input type="date" name="tanggal_terima" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Supplier</label>
          <input type="text" name="supplier" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" name="nama_barang" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Jumlah</label>
          <input type="number" name="jumlah" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <input type="text" name="satuan" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Petugas</label>
          <input type="text" name="petugas" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('tambahBarangMasuk')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Barang Masuk -->
<div id="modalEditBarangMasuk" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Edit Barang Masuk</h3>
      <span class="close" onclick="closeModal('editBarangMasuk')">&times;</span>
    </div>
    <form id="formEditBarangMasuk" method="post" onsubmit="handleEditBarangMasukSubmit(); return false;">
      <div class="modal-body">
        <input type="hidden" name="id" id="edit_id">
        <div class="form-group">
          <label>No Surat Jalan</label>
          <input type="text" name="no_surat_jalan" id="edit_no_surat_jalan" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Tanggal Terima</label>
          <input type="date" name="tanggal_terima" id="edit_tanggal_terima" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Supplier</label>
          <input type="text" name="supplier" id="edit_supplier" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Nama Barang</label>
          <input type="text" name="nama_barang" id="edit_nama_barang" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Jumlah</label>
          <input type="number" name="jumlah" id="edit_jumlah" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Satuan</label>
          <input type="text" name="satuan" id="edit_satuan" class="form-control" required>
        </div>
        <div class="form-group">
          <label>Petugas</label>
          <input type="text" name="petugas" id="edit_petugas" class="form-control" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('editBarangMasuk')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<?= $this->endSection() ?> 