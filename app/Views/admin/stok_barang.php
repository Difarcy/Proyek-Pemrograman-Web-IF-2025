<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Stok Barang<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <h1 class="mb-4">Stok Barang</h1>
        
        <!-- Search and Filter Card -->
        <div class="card search-filter-card mb-4">
            <div class="card-body">
                <h6 class="card-title mb-3">Pencarian & Filter</h6>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="searchInput">Pencarian</label>
                            <input type="text" class="form-control form-control-sm" id="searchInput" placeholder="Cari kode, nama...">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="categoryFilter">Kategori</label>
                            <select class="form-control form-control-sm" id="categoryFilter">
                                <option value="">Semua Kategori</option>
                                <option value="Elektronik">Elektronik</option>
                                <option value="Pakaian">Pakaian</option>
                                <option value="Makanan">Makanan</option>
                                <option value="Minuman">Minuman</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="brandFilter">Merek</label>
                            <select class="form-control form-control-sm" id="brandFilter">
                                <option value="">Semua Merek</option>
                                <option value="Asus">Asus</option>
                                <option value="Logitech">Logitech</option>
                                <option value="Razer">Razer</option>
                                <option value="Samsung">Samsung</option>
                                <option value="HP">HP</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="stockFilter">Status Stok</label>
                            <select class="form-control form-control-sm" id="stockFilter">
                                <option value="">Semua Status</option>
                                <option value="tersedia">Tersedia</option>
                                <option value="hampir_habis">Hampir Habis</option>
                                <option value="habis">Habis</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dateFromFilter">Tanggal (Dari)</label>
                            <input type="date" class="form-control form-control-sm" id="dateFromFilter">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="dateToFilter">Tanggal (Sampai)</label>
                            <input type="date" class="form-control form-control-sm" id="dateToFilter">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
                <h5 class="mb-0">Daftar Stok Barang</h5>
                <div>
                    <!-- Print Button -->
                    <button type="button" class="btn btn-extended btn-secondary" onclick="showPrintModal()">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                    <!-- Main Action Buttons -->
                    <button type="button" class="btn btn-extended btn-success" onclick="showExportModal()">
                        <i class="fas fa-download"></i> Export
                    </button>
                    <button type="button" class="btn btn-extended btn-primary" onclick="showTambahBarangModal()">
                        <i class="fas fa-plus"></i> Tambah Barang
                    </button>
                </div>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped mb-0" id="barangTable">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Merek</th>
                                <th>Stok</th>
                                <th>Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        // Debug: Check if $barang exists and has data
                        $hasData = isset($barang) && is_array($barang) && !empty($barang);
                        
                        if ($hasData): ?>
                            <?php foreach ($barang as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $item['kode_barang'] ?? 'BRG001' ?></td>
                                    <td><?= $item['nama_barang'] ?? 'Laptop Asus' ?></td>
                                    <td><?= $item['kategori'] ?? 'Elektronik' ?></td>
                                    <td><?= $item['merek'] ?? 'Asus' ?></td>
                                    <td><?= $item['stok'] ?? 5 ?></td>
                                    <td><?= 'Rp ' . number_format($item['harga'] ?? 10000000, 0, ',', '.') ?></td>
                                    <td>
                                        <?php 
                                        $stok = $item['stok'] ?? 5;
                                        if ($stok == 0) {
                                            echo '<span class="badge-status badge-status-habis">habis</span>';
                                        } elseif ($stok <= 3) {
                                            echo '<span class="badge-status badge-status-hampirhabis">hampir habis</span>';
                                        } else {
                                            echo '<span class="badge-status badge-status-tersedia">tersedia</span>';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="<?= base_url('admin/stok-barang/edit/' . ($item['id'] ?? 1)) ?>" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/stok-barang/delete/' . ($item['id'] ?? 1)) ?>" class="btn btn-danger btn-sm" onclick="return confirmDelete('Yakin ingin menghapus barang ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        
                        <!-- Data Dummy - Always Show -->
                        <tr>
                            <td><?= $hasData ? count($barang) + 1 : 1 ?></td>
                                <td>BRG001</td>
                                <td>Laptop Asus</td>
                                <td>Elektronik</td>
                            <td>Asus</td>
                                <td>5</td>
                            <td>Rp 10.000.000</td>
                            <td><span class="badge-status badge-status-tersedia">tersedia</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                                </td>
                            </tr>
                            <tr>
                            <td><?= $hasData ? count($barang) + 2 : 2 ?></td>
                                <td>BRG002</td>
                                <td>Mouse Gaming</td>
                                <td>Elektronik</td>
                            <td>Logitech</td>
                                <td>3</td>
                            <td>Rp 250.000</td>
                            <td><span class="badge-status badge-status-hampirhabis">hampir habis</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $hasData ? count($barang) + 3 : 3 ?></td>
                            <td>BRG003</td>
                            <td>Keyboard Mechanical</td>
                            <td>Elektronik</td>
                            <td>Razer</td>
                            <td>2</td>
                            <td>Rp 1.500.000</td>
                            <td><span class="badge-status badge-status-hampirhabis">hampir habis</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $hasData ? count($barang) + 4 : 4 ?></td>
                            <td>BRG004</td>
                            <td>Monitor Gaming</td>
                            <td>Elektronik</td>
                            <td>Samsung</td>
                            <td>0</td>
                            <td>Rp 3.500.000</td>
                            <td><span class="badge-status badge-status-habis">habis</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><?= $hasData ? count($barang) + 5 : 5 ?></td>
                            <td>BRG005</td>
                            <td>Headset Gaming</td>
                            <td>Elektronik</td>
                            <td>HP</td>
                            <td>8</td>
                            <td>Rp 800.000</td>
                            <td><span class="badge-status badge-status-tersedia">tersedia</span></td>
                            <td>
                                <div class="action-buttons">
                                    <a href="#" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="#" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i> Hapus
                                    </a>
                                </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="pagination-container">
                    <div class="d-flex justify-content-between align-items-center">
                    <div class="pagination-info-new">
                        Showing 1 to 5 of 25 entries
                    </div>
                    <div class="pagination-controls">
                        <button class="btn" onclick="previousPage()" disabled>&laquo; Previous</button>
                        <button class="btn active" onclick="goToPage(1)">1</button>
                        <button class="btn" onclick="goToPage(2)">2</button>
                        <button class="btn" onclick="goToPage(3)">3</button>
                        <button class="btn" onclick="goToPage(4)">4</button>
                        <button class="btn" onclick="goToPage(5)">5</button>
                        <button class="btn" onclick="nextPage()">Next &raquo;</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Print Modal -->
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel">Pilih Format Cetak</h5>
                    <button type="button" class="modal-close" onclick="closePrintModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="export-options">
                        <div class="export-option excel" onclick="selectPrintOption('excel')">
                            <i class="fas fa-file-excel"></i>
                            <div>Excel</div>
                        </div>
                        <div class="export-option pdf" onclick="selectPrintOption('pdf')">
                            <i class="fas fa-file-pdf"></i>
                            <div>PDF</div>
                        </div>
                        <div class="export-option csv" onclick="selectPrintOption('csv')">
                            <i class="fas fa-file-csv"></i>
                            <div>CSV</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closePrintModal()">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="executePrint()" id="executePrintBtn" disabled>
                        Cetak
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Export Modal -->
    <div class="modal fade" id="exportModal" tabindex="-1" role="dialog" aria-labelledby="exportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Pilih Format Export</h5>
                    <button type="button" class="modal-close" onclick="closeExportModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="export-options">
                        <div class="export-option excel" onclick="selectExportOption('excel')">
                            <i class="fas fa-file-excel"></i>
                            <div>Excel</div>
                        </div>
                        <div class="export-option pdf" onclick="selectExportOption('pdf')">
                            <i class="fas fa-file-pdf"></i>
                            <div>PDF</div>
                        </div>
                        <div class="export-option csv" onclick="selectExportOption('csv')">
                            <i class="fas fa-file-csv"></i>
                            <div>CSV</div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeExportModal()">Batal</button>
                    <button type="button" class="btn btn-success" onclick="executeExport()" id="executeExportBtn" disabled>
                        Export
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Tambah Barang Modal -->
    <div class="modal fade" id="tambahBarangModal" tabindex="-1" role="dialog" aria-labelledby="tambahBarangModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBarangModalLabel">Tambah Barang Baru</h5>
                    <button type="button" class="modal-close" onclick="closeTambahBarangModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="tambahBarangForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kodeBarang">Kode Barang *</label>
                                    <input type="text" class="form-control" id="kodeBarang" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="namaBarang">Nama Barang *</label>
                                    <input type="text" class="form-control" id="namaBarang" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategoriBarang">Kategori *</label>
                                    <select class="form-control" id="kategoriBarang" required>
                                        <option value="">Pilih Kategori</option>
                                        <option value="Elektronik">Elektronik</option>
                                        <option value="Pakaian">Pakaian</option>
                                        <option value="Makanan">Makanan</option>
                                        <option value="Minuman">Minuman</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="merekBarang">Merek *</label>
                                    <input type="text" class="form-control" id="merekBarang" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stokBarang">Stok *</label>
                                    <input type="number" class="form-control" id="stokBarang" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hargaBarang">Harga *</label>
                                    <input type="number" class="form-control" id="hargaBarang" min="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deskripsiBarang">Deskripsi</label>
                            <textarea class="form-control" id="deskripsiBarang" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeTambahBarangModal()">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="submitTambahBarang()">
                        Simpan
                    </button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script src="<?= base_url('assets/js/stok_barang_admin.js') ?>"></script>
<?= $this->endSection() ?>