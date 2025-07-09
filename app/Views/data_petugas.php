<?= $this->extend($role === 'admin' ? 'layouts/admin' : 'layouts/user') ?>
<?= $this->section('title') ?>Data Petugas<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Data Petugas</h2>

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
            <button type="button" class="btn btn-primary" onclick="openTambahPetugasModal()">
              <i class="fas fa-plus"></i> Tambah Petugas
            </button>
          </div>
        </div>
        <form method="get" id="filterForm">
          <div class="filter-controls">
            <div class="filter-group">
              <label for="search">Pencarian</label>
              <input type="text" name="search" placeholder="Cari nama, telepon..." value="<?= esc($filterSearch) ?>">
            </div>
            <div class="filter-group">
              <label for="jabatan">Jabatan</label>
              <select name="jabatan" id="jabatan" onchange="this.form.submit()">
                <option value="">Semua Jabatan</option>
                <?php foreach ($jabatanList as $jabatan): ?>
                  <option value="<?= esc($jabatan['jabatan']) ?>" <?= $filterJabatan == $jabatan['jabatan'] ? 'selected' : '' ?>><?= esc($jabatan['jabatan']) ?></option>
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
          <input type="hidden" name="jabatan" value="<?= esc($filterJabatan) ?>">
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
              <th>Kode Petugas</th>
              <th>Nama Petugas</th>
              <th>Jabatan</th>
              <th>Telepon</th>
              <th>Alamat</th>
              <th>Kota</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php if (!empty($petugas)): ?>
            <?php $no = 1 + (($currentPage - 1) * $perPage); foreach ($petugas as $p): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($p['kode_petugas']) ?></td>
              <td><?= esc($p['nama_petugas']) ?></td>
              <td><?= esc($p['jabatan']) ?></td>
              <td><?= esc($p['telepon']) ?></td>
              <td><?= esc($p['alamat']) ?></td>
              <td><?= esc($p['kota']) ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit" onclick="editPetugas(<?= $p['id'] ?>)">Edit</a>
                  <a href="#" class="action-btn action-btn-delete" onclick="confirmDeletePetugas(<?= $p['id'] ?>, '<?= esc($p['nama_petugas']) ?>')">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" class="empty-table-message">Tidak ada data petugas.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="pagination-bar" id="paginationBar">
        <div class="pagination-info">
          Showing <?= ($total > 0) ? ($perPage * ($currentPage - 1)) + 1 : 0 ?> to <?= min(($perPage * ($currentPage - 1)) + count($petugas), $total) ?> of <?= $total ?> entries
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
            <a href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($filterSearch) ?>&jabatan=<?= urlencode($filterJabatan) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
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
              <a href="?page=<?= $i ?>&search=<?= urlencode($filterSearch) ?>&jabatan=<?= urlencode($filterJabatan) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params"><?= $i ?></a>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($filterSearch) ?>&jabatan=<?= urlencode($filterJabatan) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
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

<!-- Modal Tambah Petugas -->
<div id="modalTambahPetugas" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Tambah Petugas</h3>
      <span class="close" onclick="closeModal('tambahPetugas')">&times;</span>
    </div>
    <form id="formTambahPetugas" method="post" action="<?= base_url(($role === 'admin' ? 'admin' : 'user') . '/data-petugas/store') ?>">
      <div class="modal-body">
        <div class="form-group">
          <label>Kode Petugas</label>
          <input type="text" name="kode_petugas" required>
        </div>
        <div class="form-group">
          <label>Nama Petugas</label>
          <input type="text" name="nama_petugas" required>
        </div>
        <div class="form-group">
          <label>Jabatan</label>
          <input type="text" name="jabatan" required placeholder="Masukkan jabatan (bebas)">
        </div>
        <div class="form-group">
          <label>Telepon</label>
          <input type="text" name="telepon" required>
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" required>
        </div>
        <div class="form-group">
          <label>Kota</label>
          <input type="text" name="kota" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('tambahPetugas')">Batal</button>
        <button type="button" class="btn btn-primary" onclick="handleAddPetugasSubmit()">Simpan</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal Edit Petugas -->
<div id="modalEditPetugas" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Edit Petugas</h3>
      <span class="close" onclick="closeModal('editPetugas')">&times;</span>
    </div>
    <form id="formEditPetugas" method="post" action="<?= base_url(($role === 'admin' ? 'admin' : 'user') . '/data-petugas/update') ?>">
      <input type="hidden" name="id" id="edit_petugas_id">
      <div class="modal-body">
        <div class="form-group">
          <label>Kode Petugas</label>
          <input type="text" name="kode_petugas" id="edit_kode_petugas" required>
        </div>
        <div class="form-group">
          <label>Nama Petugas</label>
          <input type="text" name="nama_petugas" id="edit_nama_petugas" required>
        </div>
        <div class="form-group">
          <label>Jabatan</label>
          <input type="text" name="jabatan" id="edit_jabatan" required placeholder="Masukkan jabatan (bebas)">
        </div>
        <div class="form-group">
          <label>Telepon</label>
          <input type="text" name="telepon" id="edit_telepon" required>
        </div>
        <div class="form-group">
          <label>Alamat</label>
          <input type="text" name="alamat" id="edit_alamat" required>
        </div>
        <div class="form-group">
          <label>Kota</label>
          <input type="text" name="kota" id="edit_kota" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('editPetugas')">Batal</button>
        <button type="button" class="btn btn-primary" onclick="handleEditPetugasSubmit()">Simpan</button>
      </div>
    </form>
  </div>
</div>
<!-- Modal Export -->
<div id="modalExport" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Export Data Petugas</h3>
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