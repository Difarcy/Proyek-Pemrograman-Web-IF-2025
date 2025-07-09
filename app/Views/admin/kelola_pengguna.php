<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Kelola Pengguna<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Kelola Pengguna</h2>

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
            <button type="button" class="btn btn-primary" onclick="openModal('tambahPengguna')">
              <i class="fas fa-plus"></i> Tambah Pengguna
            </button>
          </div>
        </div>
        
        <form method="get" id="filterForm">
          <div class="filter-controls">
            <div class="filter-group">
              <label for="search">Pencarian</label>
              <input type="text" name="search" placeholder="Cari username, nama lengkap..." value="<?= esc($filterSearch ?? '') ?>">
            </div>

            <div class="filter-group">
              <label for="status">Status Pengguna</label>
              <select name="status">
                <option value="">Semua Status</option>
                <?php if (!empty($statusOptions)): ?>
                  <?php foreach ($statusOptions as $opt): ?>
                    <option value="<?= esc($opt) ?>" <?= ($filterStatus ?? '') == $opt ? 'selected' : '' ?>>
                      <?= $opt === 'active' ? 'Aktif' : ($opt === 'inactive' ? 'Tidak Aktif' : ucfirst($opt)) ?>
                    </option>
                  <?php endforeach; ?>
                <?php endif; ?>
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

      <!-- Profil Toko Print Only -->
      <?php if (!empty($profil_toko)): ?>
      <div class="profil-toko-print" style="display:none;text-align:center;margin-bottom:24px;">
        <div style="font-size:20px;font-weight:bold;"> <?= esc($profil_toko['nama_toko']) ?> </div>
        <div>Pemilik: <?= esc($profil_toko['nama_pemilik']) ?> | Telp: <?= esc($profil_toko['no_telepon']) ?></div>
        <div>Alamat: <?= esc($profil_toko['alamat']) ?></div>
      </div>
      <?php endif; ?>

      <!-- Show Entries Filter -->
      <div class="show-entries-bar" id="showEntriesBar">
        <form method="get" id="entriesForm" class="entries-form">
          <label for="entries">Show</label>
          <select id="entries" name="entries">
            <option value="10" <?= ($perPage ?? 10) == 10 ? 'selected' : '' ?>>10</option>
            <option value="25" <?= ($perPage ?? 10) == 25 ? 'selected' : '' ?>>25</option>
            <option value="50" <?= ($perPage ?? 10) == 50 ? 'selected' : '' ?>>50</option>
            <option value="100" <?= ($perPage ?? 10) == 100 ? 'selected' : '' ?>>100</option>
          </select>
          <span>entries</span>
          <input type="hidden" name="search" value="<?= esc($filterSearch ?? '') ?>">
          <input type="hidden" name="status" value="<?= esc($filterStatus ?? '') ?>">
        </form>
      </div>

      <!-- Table Section -->
      <div class="table-container" id="tableContainer">
        <table class="data-table">
          <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Nama Lengkap</th>
                <th>Status</th>
                <th>Login Terakhir</th>
                <th>Terdaftar</th>
                <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
          <?php if (!empty($users ?? [])): ?>
            <?php $no = 1 + (($currentPage ?? 1) - 1) * ($perPage ?? 10); foreach ($users as $user): ?>
            <tr>
              <td><?= $no++ ?></td>
              <td><?= esc($user['username']) ?></td>
              <td><?= esc($user['nama']) ?></td>
              <td>
                <span class="status-<?= $user['status'] == 'active' ? 'active' : 'inactive' ?>">
                  <strong><?= $user['status'] == 'active' ? 'Aktif' : 'Tidak Aktif' ?></strong>
                </span>
              </td>
              <td><?= $user['last_login'] ? date('d/m/Y H:i', strtotime($user['last_login'])) : '-' ?></td>
              <td><?= date('d/m/Y', strtotime($user['created_at'])) ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit" onclick="editUser(<?= $user['id'] ?>)">Edit</a>
                  <a href="#" class="action-btn action-btn-<?= $user['status'] == 'active' ? 'danger' : 'success' ?>" onclick="toggleUserStatus(<?= $user['id'] ?>)">
                    <?= $user['status'] == 'active' ? 'Nonaktif' : 'Aktif' ?>
                  </a>
                  <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteUser(<?= $user['id'] ?>, '<?= esc($user['username']) ?>')">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="empty-table-message">Tidak ada data pengguna.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="pagination-bar" id="paginationBar">
        <div class="pagination-info">
          Showing <?= ($total ?? 0) > 0 ? (($perPage ?? 10) * (($currentPage ?? 1) - 1)) + 1 : 0 ?> to <?= min((($perPage ?? 10) * (($currentPage ?? 1) - 1)) + count($users ?? []), $total ?? 0) ?> of <?= $total ?? 0 ?> entries
        </div>
        <div class="pagination-nav">
          <?php
          $currentPage = $currentPage ?? 1;
          $totalPages = $totalPages ?? 1;
          $filterSearch = $filterSearch ?? '';
          $filterStatus = $filterStatus ?? '';
          $perPage = $perPage ?? 10;
          
          // Calculate page range for better pagination
          $startPage = max(1, $currentPage - 1);
          $endPage = min($totalPages, $currentPage + 1);
          
          // Adjust range if we're at the beginning or end
          if ($currentPage <= 2) {
              $endPage = min($totalPages, 3);
          }
          if ($currentPage >= $totalPages - 1) {
              $startPage = max(1, $totalPages - 2);
          }
          ?>
          
          <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($filterSearch) ?>&status=<?= urlencode($filterStatus) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
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
              <a href="?page=<?= $i ?>&search=<?= urlencode($filterSearch) ?>&status=<?= urlencode($filterStatus) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params"><?= $i ?></a>
            <?php endif; ?>
          <?php endfor; ?>
          
          <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($filterSearch) ?>&status=<?= urlencode($filterStatus) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
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

<!-- Modal Tambah Pengguna -->
<div id="modalTambahPengguna" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3 id="modalTitle">Tambah Pengguna</h3>
      <span class="close" onclick="closeModal('tambahPengguna')">&times;</span>
    </div>
    <form id="formPengguna" method="post">
      <input type="hidden" id="user_id" name="id">
      <div class="modal-body">
        <div class="form-group">
          <label for="username" class="required">Username</label>
          <input type="text" id="username" name="username" required>
        </div>
        <div class="form-group">
          <label for="nama" class="required">Nama Lengkap</label>
          <input type="text" id="nama" name="nama" required>
        </div>
        <div class="form-group">
          <label for="password" class="required" id="passwordLabel">Password</label>
          <div class="password-input-container">
            <input type="password" id="password" name="password" required>
            <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
              <i class="fas fa-eye" id="password-eye-icon"></i>
            </button>
          </div>
          <div id="passwordErrorContainer"></div>
          <small id="passwordHelp" style="display:none;color:#888;">Kosongkan jika tidak ingin mengubah password</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('tambahPengguna')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Edit Pengguna -->
<div id="modalEditPengguna" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Edit Pengguna</h3>
      <span class="close" onclick="closeModal('editPengguna')">&times;</span>
    </div>
    <form id="formEditPengguna" method="post">
      <input type="hidden" id="edit_user_id" name="id">
      <div class="modal-body">
        <div class="form-group">
          <label for="edit_username" class="required">Username</label>
          <input type="text" id="edit_username" name="username" required>
        </div>
        <div class="form-group">
          <label for="edit_nama" class="required">Nama Lengkap</label>
          <input type="text" id="edit_nama" name="nama" required>
        </div>
        <div class="form-group">
          <label for="edit_password" id="edit_passwordLabel">Password</label>
          <div class="password-input-container">
            <input type="password" id="edit_password" name="password">
            <button type="button" class="password-toggle" onclick="togglePasswordVisibility('edit_password')">
              <i class="fas fa-eye" id="edit-password-eye-icon"></i>
            </button>
          </div>
          <div id="edit_passwordErrorContainer"></div>
          <small id="edit_passwordHelp" style="color:#888;">Kosongkan jika tidak ingin mengubah password</small>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-secondary" onclick="closeModal('editPengguna')">Batal</button>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
    </form>
  </div>
</div>

<!-- Modal Export -->
<div id="modalExport" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h3>Export Data Pengguna</h3>
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
    <div class="modal-footer">
      <button type="button" class="btn btn-outline-secondary" onclick="closeModal('export')">Batal</button>
    </div>
  </div>
</div>

<?= $this->endSection() ?>