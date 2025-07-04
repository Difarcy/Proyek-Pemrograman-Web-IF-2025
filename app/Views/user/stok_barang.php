<?= $this->extend('layouts/user') ?>
<?= $this->section('title') ?>Stok Barang<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="stok-barang-page-title">Stok Barang</h2>

<div class="stok-barang-container">
  <div class="stok-barang-card">
    <div class="stok-barang-content">
      <!-- Filter Section -->
      <div class="filter-section">
        <div class="filter-header" style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 20px; gap: 10px;">
          <div class="filter-controls" style="display: flex; gap: 15px; align-items: center;">
            <button type="button" class="btn btn-success" onclick="exportExcel()">
              <i class="fas fa-file-excel"></i> Export
            </button>
            <button type="button" class="btn btn-primary" onclick="window.location.href='tambah_barang_url';">
              <i class="fas fa-plus"></i> Tambah
            </button>
          </div>
        </div>
        
        <form method="get" id="filterForm">
          <div class="filter-controls">
            <div class="filter-group">
              <label for="search">Pencarian</label>
              <input type="text" name="search" placeholder="Cari kode/nama barang..." value="<?= esc($filterSearch) ?>">
            </div>

            <div class="filter-group">
              <label for="jenis">Jenis</label>
              <select name="jenis" onchange="this.form.submit()">
                <option value="">Semua Jenis</option>
                <option value="Elektronik" <?= $filterJenis=='Elektronik'?'selected':'' ?>>Elektronik</option>
                <option value="Pakaian" <?= $filterJenis=='Pakaian'?'selected':'' ?>>Pakaian</option>
              </select>
            </div>

            <div class="filter-group">
              <label for="merek">Merek</label>
              <select name="merek" onchange="this.form.submit()">
                <option value="">Semua Merek</option>
                <option value="Samsung" <?= $filterMerek=='Samsung'?'selected':'' ?>>Samsung</option>
                <option value="LG" <?= $filterMerek=='LG'?'selected':'' ?>>LG</option>
              </select>
            </div>

            <div class="filter-group">
              <label>&nbsp;</label>
              <button type="button" class="btn btn-outline-secondary" onclick="window.location.href='<?= current_url() ?>?entries=<?= $perPage ?>'">
                <i class="fas fa-refresh"></i> Reset
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- Show Entries Filter -->
      <div class="show-entries-bar">
        <form method="get" id="entriesForm" style="display: flex; align-items: center; gap: 8px; margin: 8px 0;">
          <label for="entries">Show</label>
          <select id="entries" name="entries" onchange="this.form.submit();">
            <option value="10" <?= ($perPage == 10) ? 'selected' : '' ?>>10</option>
            <option value="25" <?= ($perPage == 25) ? 'selected' : '' ?>>25</option>
            <option value="50" <?= ($perPage == 50) ? 'selected' : '' ?>>50</option>
            <option value="100" <?= ($perPage == 100) ? 'selected' : '' ?>>100</option>
          </select>
          <span>entries</span>
          <input type="hidden" name="search" value="<?= esc($filterSearch) ?>">
          <input type="hidden" name="jenis" value="<?= esc($filterJenis) ?>">
          <input type="hidden" name="merek" value="<?= esc($filterMerek) ?>">
        </form>
      </div>

      <!-- Table Section -->
      <div class="table-container">
        <table class="data-table">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jenis Barang</th>
              <th>Merek Barang</th>
              <th>Stok</th>
              <th>Keterangan</th>
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
              <td><?= esc($barang['jenis_barang']) ?></td>
              <td><?= esc($barang['merek_barang']) ?></td>
              <td><?= esc($barang['stok']) ?></td>
              <td><?= esc($barang['keterangan']) ?></td>
              <td>
                <div class="table-actions">
                  <a href="#" class="action-btn action-btn-edit">Edit</a>
                  <a href="#" class="action-btn action-btn-delete">Hapus</a>
                </div>
              </td>
            </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="8" style="text-align:center; color:#9ca3af; font-size:15px;">Tidak ada data barang.</td>
            </tr>
          <?php endif; ?>
          </tbody>
        </table>
      </div>
      <div class="pagination-bar">
        <div class="pagination-info">
          Showing <?= ($total > 0) ? ($perPage * ($currentPage - 1)) + 1 : 0 ?> to <?= min(($perPage * ($currentPage - 1)) + count($stokBarang), $total) ?> of <?= $total ?> entries
        </div>
        <div class="pagination-nav">
          <?php if ($currentPage > 1): ?>
            <a href="?page=<?= $currentPage - 1 ?>&search=<?= urlencode($filterSearch) ?>&jenis=<?= urlencode($filterJenis) ?>&merek=<?= urlencode($filterMerek) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
              <i class="fas fa-chevron-left"></i>
            </a>
          <?php endif; ?>
          <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <?php if ($i == $currentPage): ?>
              <span class="pagination-link active"><?= $i ?></span>
            <?php else: ?>
              <a href="?page=<?= $i ?>&search=<?= urlencode($filterSearch) ?>&jenis=<?= urlencode($filterJenis) ?>&merek=<?= urlencode($filterMerek) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params"><?= $i ?></a>
            <?php endif; ?>
          <?php endfor; ?>
          <?php if ($currentPage < $totalPages): ?>
            <a href="?page=<?= $currentPage + 1 ?>&search=<?= urlencode($filterSearch) ?>&jenis=<?= urlencode($filterJenis) ?>&merek=<?= urlencode($filterMerek) ?>&entries=<?= $perPage ?>" class="pagination-link-with-params">
              <i class="fas fa-chevron-right"></i>
            </a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>