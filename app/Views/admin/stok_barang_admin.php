<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Stok Barang<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <h1 class="mb-4">Stok Barang</h1>
        
        <!-- Search and Filter Card -->
        <div class="search-filter-card">
            <h6 class="card-title">Pencarian & Filter</h6>
            <div class="search-filter-row">
                <div class="form-group">
                    <label>Pencarian</label>
                    <input type="text" class="form-control" id="searchInput" placeholder="Cari kode, nama, atau merek barang...">
                </div>
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" id="categoryFilter">
                        <option value="">Semua Kategori</option>
                        <option value="Elektronik">Elektronik</option>
                        <option value="Pakaian">Pakaian</option>
                        <option value="Makanan">Makanan</option>
                        <option value="Minuman">Minuman</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Merek</label>
                    <select class="form-control" id="brandFilter">
                        <option value="">Semua Merek</option>
                        <option value="Asus">Asus</option>
                        <option value="Logitech">Logitech</option>
                        <option value="Razer">Razer</option>
                        <option value="Samsung">Samsung</option>
                        <option value="HP">HP</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Status Stok</label>
                    <select class="form-control" id="stockFilter">
                        <option value="">Semua Status</option>
                        <option value="tersedia">Tersedia</option>
                        <option value="hampir_habis">Hampir Habis</option>
                        <option value="habis">Habis</option>
                    </select>
                </div>
            </div>
        </div>
        
        <div class="card mb-4">
            <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
                <h5 class="mb-0">Daftar Stok Barang</h5>
                <div>
                    <!-- Print Button -->
                    <button type="button" class="btn btn-print btn-primary" onclick="showPrintModal()">
                        <i class="fas fa-print"></i> Cetak
                    </button>
                    <!-- Main Action Buttons -->
                    <button type="button" class="btn btn-export btn-success" onclick="showExportModal()">
                        <i class="fas fa-download"></i> Export
                    </button>
                    <button type="button" class="btn btn-table-action btn-primary" onclick="showTambahBarangModal()">
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
                                            <a href="<?= base_url('admin/stok-barang/edit/' . ($item['id'] ?? 1)) ?>" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="<?= base_url('admin/stok-barang/delete/' . ($item['id'] ?? 1)) ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus barang ini?')">
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
                            <td>Monitor LED</td>
                            <td>Elektronik</td>
                            <td>Samsung</td>
                            <td>8</td>
                            <td>Rp 2.500.000</td>
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
                            <td><?= $hasData ? count($barang) + 5 : 5 ?></td>
                            <td>BRG005</td>
                            <td>Printer Laser</td>
                            <td>Elektronik</td>
                            <td>HP</td>
                            <td>0</td>
                            <td>Rp 3.200.000</td>
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
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                <div class="pagination-new">
                    <div class="pagination-info-new">
                        Showing 1 to 5 of 5 entries
                    </div>
                    <div class="pagination-controls">
                        <button class="btn" onclick="previousPage()" disabled>Previous</button>
                        <button class="btn active" onclick="goToPage(1)">1</button>
                        <button class="btn" onclick="goToPage(2)">2</button>
                        <button class="btn" onclick="goToPage(3)">3</button>
                        <button class="btn" onclick="goToPage(4)">4</button>
                        <button class="btn" onclick="goToPage(5)">5</button>
                        <span class="pagination-dots">...</span>
                        <button class="btn" onclick="nextPage()">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Print Modal -->
    <div class="modal fade print-modal" id="printModal" tabindex="-1" role="dialog" aria-labelledby="printModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="printModalLabel">
                        <i class="fas fa-print"></i> Cetak Data Stok Barang
                    </h5>
                    <button type="button" class="close" onclick="closePrintModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h6>Pilih format cetak yang diinginkan:</h6>
                    </div>
                    <div class="print-options">
                        <div class="print-option excel" onclick="selectPrintOption('excel')">
                            <i class="fas fa-file-excel"></i>
                            <span>Excel</span>
                        </div>
                        <div class="print-option pdf" onclick="selectPrintOption('pdf')">
                            <i class="fas fa-file-pdf"></i>
                            <span>PDF</span>
                        </div>
                        <div class="print-option csv" onclick="selectPrintOption('csv')">
                            <i class="fas fa-file-csv"></i>
                            <span>CSV</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closePrintModal()">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="executePrint()" id="executePrintBtn" disabled>
                        <i class="fas fa-download"></i> Cetak
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
                    <h5 class="modal-title" id="exportModalLabel">
                        <i class="fas fa-download"></i> Export Data Stok Barang
                    </h5>
                    <button type="button" class="close" onclick="closeExportModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h6>Pilih format export yang diinginkan:</h6>
                    </div>
                    <div class="print-options">
                        <div class="print-option excel" onclick="selectExportOption('excel')">
                            <i class="fas fa-file-excel"></i>
                            <span>Excel</span>
                        </div>
                        <div class="print-option pdf" onclick="selectExportOption('pdf')">
                            <i class="fas fa-file-pdf"></i>
                            <span>PDF</span>
                        </div>
                        <div class="print-option csv" onclick="selectExportOption('csv')">
                            <i class="fas fa-file-csv"></i>
                            <span>CSV</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeExportModal()">Batal</button>
                    <button type="button" class="btn btn-success" onclick="executeExport()" id="executeExportBtn" disabled>
                        <i class="fas fa-download"></i> Export
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
                    <h5 class="modal-title" id="tambahBarangModalLabel">
                        <i class="fas fa-plus"></i> Tambah Barang Baru
                    </h5>
                    <button type="button" class="close" onclick="closeTambahBarangModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="tambahBarangForm">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kodeBarang">Kode Barang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="kodeBarang" name="kodeBarang" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="namaBarang">Nama Barang <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="namaBarang" name="namaBarang" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategoriBarang">Kategori <span class="text-danger">*</span></label>
                                    <select class="form-control" id="kategoriBarang" name="kategoriBarang" required>
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
                                    <label for="merekBarang">Merek <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="merekBarang" name="merekBarang" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stokBarang">Stok <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="stokBarang" name="stokBarang" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="hargaBarang">Harga <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="hargaBarang" name="hargaBarang" min="0" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="deskripsiBarang">Deskripsi</label>
                            <textarea class="form-control" id="deskripsiBarang" name="deskripsiBarang" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="closeTambahBarangModal()">Batal</button>
                    <button type="button" class="btn btn-primary" onclick="submitTambahBarang()">
                        <i class="fas fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    let selectedPrintOption = null;
    let selectedExportOption = null;
    let currentPage = 1;
    const itemsPerPage = 5;
    const totalItems = 25; // Total dummy items for pagination
    
    // Export Modal Functions
    function showExportModal() {
        $('#exportModal').modal('show');
    }
    
    function closeExportModal() {
        const modal = document.getElementById('exportModal');
        modal.classList.add('fade-out');
        setTimeout(() => {
            $('#exportModal').modal('hide');
            modal.classList.remove('fade-out');
        }, 300);
    }
    
    function selectExportOption(option) {
        // Remove previous selection
        document.querySelectorAll('#exportModal .print-option').forEach(el => {
            el.classList.remove('selected');
        });
        
        // Add selection to clicked option
        document.querySelector(`#exportModal .print-option.${option}`).classList.add('selected');
        selectedExportOption = option;
        
        // Enable execute button
        document.getElementById('executeExportBtn').disabled = false;
    }
    
    function executeExport() {
        if (!selectedExportOption) {
            alert('Pilih format export terlebih dahulu!');
            return;
        }
        
        switch(selectedExportOption) {
            case 'excel':
                alert('Mengunduh file Excel...');
                break;
            case 'pdf':
                alert('Mengunduh file PDF...');
                break;
            case 'csv':
                alert('Mengunduh file CSV...');
                break;
        }
        
        // Close modal with animation
        closeExportModal();
        
        // Reset selection
        selectedExportOption = null;
        document.querySelectorAll('#exportModal .print-option').forEach(el => {
            el.classList.remove('selected');
        });
        document.getElementById('executeExportBtn').disabled = true;
    }
    
    // Tambah Barang Modal Functions
    function showTambahBarangModal() {
        $('#tambahBarangModal').modal('show');
    }
    
    function closeTambahBarangModal() {
        const modal = document.getElementById('tambahBarangModal');
        modal.classList.add('fade-out');
        setTimeout(() => {
            $('#tambahBarangModal').modal('hide');
            modal.classList.remove('fade-out');
        }, 300);
    }
    
    function submitTambahBarang() {
        const form = document.getElementById('tambahBarangForm');
        if (form.checkValidity()) {
            // Here you would normally submit the form data
            alert('Barang berhasil ditambahkan!');
            closeTambahBarangModal();
            form.reset();
        } else {
            form.reportValidity();
        }
    }
    
    // Search and Filter Functions
    function applyFilters() {
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        const category = document.getElementById('categoryFilter').value;
        const brand = document.getElementById('brandFilter').value;
        const stockStatus = document.getElementById('stockFilter').value;
        
        const rows = document.querySelectorAll('#barangTable tbody tr');
        
        rows.forEach(row => {
            const kode = row.cells[1].textContent.toLowerCase();
            const nama = row.cells[2].textContent.toLowerCase();
            const kategori = row.cells[3].textContent;
            const merek = row.cells[4].textContent;
            const stok = parseInt(row.cells[5].textContent);
            
            let show = true;
            
            // Search filter
            if (searchTerm && !kode.includes(searchTerm) && !nama.includes(searchTerm) && !merek.toLowerCase().includes(searchTerm)) {
                show = false;
            }
            
            // Category filter
            if (category && kategori !== category) {
                show = false;
            }
            
            // Brand filter
            if (brand && merek !== brand) {
                show = false;
            }
            
            // Stock status filter
            if (stockStatus) {
                if (stockStatus === 'habis' && stok > 0) show = false;
                if (stockStatus === 'hampir_habis' && (stok > 3 || stok === 0)) show = false;
                if (stockStatus === 'tersedia' && stok <= 3) show = false;
            }
            
            row.style.display = show ? '' : 'none';
        });
        
        updatePaginationInfo();
    }
    
    // Print Modal Functions
    function showPrintModal() {
        $('#printModal').modal('show');
    }
    
    function closePrintModal() {
        const modal = document.getElementById('printModal');
        modal.classList.add('fade-out');
        setTimeout(() => {
            $('#printModal').modal('hide');
            modal.classList.remove('fade-out');
        }, 300);
    }
    
    function selectPrintOption(option) {
        // Remove previous selection
        document.querySelectorAll('#printModal .print-option').forEach(el => {
            el.classList.remove('selected');
        });
        
        // Add selection to clicked option
        document.querySelector(`#printModal .print-option.${option}`).classList.add('selected');
        selectedPrintOption = option;
        
        // Enable execute button
        document.getElementById('executePrintBtn').disabled = false;
    }
    
    function executePrint() {
        if (!selectedPrintOption) {
            alert('Pilih format cetak terlebih dahulu!');
            return;
        }
        
        switch(selectedPrintOption) {
            case 'excel':
                alert('Mengunduh file Excel...');
                break;
            case 'pdf':
                alert('Mengunduh file PDF...');
                break;
            case 'csv':
                alert('Mengunduh file CSV...');
                break;
        }
        
        // Close modal with animation
        closePrintModal();
        
        // Reset selection
        selectedPrintOption = null;
        document.querySelectorAll('#printModal .print-option').forEach(el => {
            el.classList.remove('selected');
        });
        document.getElementById('executePrintBtn').disabled = true;
    }
    
    // Enhanced Pagination Functions
    function previousPage() {
        if (currentPage > 1) {
            currentPage--;
            updatePagination();
        }
    }
    
    function nextPage() {
        const maxPages = Math.ceil(totalItems / itemsPerPage);
        if (currentPage < maxPages) {
            currentPage++;
            updatePagination();
        }
    }
    
    function goToPage(page) {
        const maxPages = Math.ceil(totalItems / itemsPerPage);
        if (page >= 1 && page <= maxPages) {
            currentPage = page;
            updatePagination();
        }
    }
    
    function updatePagination() {
        const maxPages = Math.ceil(totalItems / itemsPerPage);
        
        // Update showing info
        const start = (currentPage - 1) * itemsPerPage + 1;
        const end = Math.min(currentPage * itemsPerPage, totalItems);
        document.querySelector('.pagination-info-new').textContent = 
            `Showing ${start} to ${end} of ${totalItems} entries`;
        
        // Update button states
        const prevBtn = document.querySelector('.pagination-controls .btn:first-child');
        const nextBtn = document.querySelector('.pagination-controls .btn:last-child');
        
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === maxPages;
        
        // Update page number buttons
        const pageButtons = document.querySelectorAll('.pagination-controls .btn:not(:first-child):not(:last-child)');
        pageButtons.forEach((btn, index) => {
            const pageNum = index + 1;
            btn.classList.remove('active');
            if (pageNum === currentPage) {
                btn.classList.add('active');
            }
        });
    }
    
    function updatePaginationInfo() {
        const totalRows = document.querySelectorAll('#barangTable tbody tr:not([style*="display: none"])').length;
        const end = Math.min(currentPage * itemsPerPage, totalRows);
        const start = totalRows > 0 ? (currentPage - 1) * itemsPerPage + 1 : 0;
        
        document.querySelector('.pagination-info-new').textContent = 
            `Showing ${start} to ${end} of ${totalRows} entries`;
    }
    
    // Search on input change
    document.getElementById('searchInput').addEventListener('input', applyFilters);
    document.getElementById('categoryFilter').addEventListener('change', applyFilters);
    document.getElementById('brandFilter').addEventListener('change', applyFilters);
    document.getElementById('stockFilter').addEventListener('change', applyFilters);
    
    // Initialize pagination
    document.addEventListener('DOMContentLoaded', function() {
        updatePaginationInfo();
    });
</script>
<?= $this->endSection() ?>