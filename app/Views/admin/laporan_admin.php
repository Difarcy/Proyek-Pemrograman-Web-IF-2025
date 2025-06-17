<?= $this->include('components/header') ?>
<?= $this->include('components/sidebar_admin') ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Filter Laporan -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Filter Laporan</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/laporan') ?>" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis Laporan</label>
                                    <select class="form-control" name="jenis_laporan" id="jenis_laporan" required>
                                        <option value="stok">Laporan Stok</option>
                                        <option value="barang_masuk">Laporan Barang Masuk</option>
                                        <option value="barang_keluar">Laporan Barang Keluar</option>
                                        <option value="penjualan">Laporan Penjualan</option>
                                        <option value="pembelian">Laporan Pembelian</option>
                                        <option value="customer">Laporan Customer</option>
                                        <option value="supplier">Laporan Supplier</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Mulai</label>
                                    <input type="date" class="form-control" name="tanggal_mulai" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="tanggal_selesai" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-search"></i> Tampilkan
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Laporan Stok -->
            <div class="card" id="laporan-stok">
                <div class="card-header">
                    <h3 class="card-title">Laporan Stok</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success" onclick="exportExcel('stok')">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button type="button" class="btn btn-danger" onclick="exportPDF('stok')">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Kategori</th>
                                <th>Stok Awal</th>
                                <th>Barang Masuk</th>
                                <th>Barang Keluar</th>
                                <th>Stok Akhir</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>BRG001</td>
                                <td>Laptop Asus</td>
                                <td>Elektronik</td>
                                <td>10</td>
                                <td>5</td>
                                <td>3</td>
                                <td>12</td>
                                <td><span class="badge badge-success">Aman</span></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>BRG002</td>
                                <td>Mouse Gaming</td>
                                <td>Aksesoris</td>
                                <td>20</td>
                                <td>10</td>
                                <td>15</td>
                                <td>15</td>
                                <td><span class="badge badge-warning">Hampir Habis</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Laporan Barang Masuk -->
            <div class="card" id="laporan-barang-masuk" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">Laporan Barang Masuk</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success" onclick="exportExcel('barang_masuk')">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button type="button" class="btn btn-danger" onclick="exportPDF('barang_masuk')">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No. Transaksi</th>
                                <th>Supplier</th>
                                <th>Jumlah Item</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2024-03-20</td>
                                <td>VST20240320001</td>
                                <td>PT Supplier Jaya</td>
                                <td>5</td>
                                <td>Rp 25.000.000</td>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Laporan Barang Keluar -->
            <div class="card" id="laporan-barang-keluar" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">Laporan Barang Keluar</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success" onclick="exportExcel('barang_keluar')">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button type="button" class="btn btn-danger" onclick="exportPDF('barang_keluar')">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No. Transaksi</th>
                                <th>Customer</th>
                                <th>Jumlah Item</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2024-03-20</td>
                                <td>VST20240320002</td>
                                <td>John Doe</td>
                                <td>3</td>
                                <td>Rp 15.000.000</td>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Laporan Penjualan -->
            <div class="card" id="laporan-penjualan" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">Laporan Penjualan</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success" onclick="exportExcel('penjualan')">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button type="button" class="btn btn-danger" onclick="exportPDF('penjualan')">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-shopping-cart"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Penjualan</span>
                                    <span class="info-box-number">Rp 50.000.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-box"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Jumlah Item</span>
                                    <span class="info-box-number">150</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-users"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Customer</span>
                                    <span class="info-box-number">25</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-chart-line"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Rata-rata Transaksi</span>
                                    <span class="info-box-number">Rp 2.000.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No. Transaksi</th>
                                <th>Customer</th>
                                <th>Jumlah Item</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2024-03-20</td>
                                <td>VST20240320002</td>
                                <td>John Doe</td>
                                <td>3</td>
                                <td>Rp 15.000.000</td>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Laporan Pembelian -->
            <div class="card" id="laporan-pembelian" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">Laporan Pembelian</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success" onclick="exportExcel('pembelian')">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button type="button" class="btn btn-danger" onclick="exportPDF('pembelian')">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-info"><i class="fas fa-shopping-cart"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Pembelian</span>
                                    <span class="info-box-number">Rp 35.000.000</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-success"><i class="fas fa-box"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Jumlah Item</span>
                                    <span class="info-box-number">100</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-warning"><i class="fas fa-truck"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Total Supplier</span>
                                    <span class="info-box-number">10</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="info-box">
                                <span class="info-box-icon bg-danger"><i class="fas fa-chart-line"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Rata-rata Transaksi</span>
                                    <span class="info-box-number">Rp 3.500.000</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No. Transaksi</th>
                                <th>Supplier</th>
                                <th>Jumlah Item</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2024-03-20</td>
                                <td>VST20240320001</td>
                                <td>PT Supplier Jaya</td>
                                <td>5</td>
                                <td>Rp 25.000.000</td>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Laporan Customer -->
            <div class="card" id="laporan-customer" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">Laporan Customer</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success" onclick="exportExcel('customer')">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button type="button" class="btn btn-danger" onclick="exportPDF('customer')">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Customer</th>
                                <th>Nama</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                <th>Total Transaksi</th>
                                <th>Total Pembelian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>CUST001</td>
                                <td>John Doe</td>
                                <td>Jl. Customer No. 1</td>
                                <td>081234567890</td>
                                <td>john@example.com</td>
                                <td>5</td>
                                <td>Rp 25.000.000</td>
                                <td><span class="badge badge-success">Aktif</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Laporan Supplier -->
            <div class="card" id="laporan-supplier" style="display: none;">
                <div class="card-header">
                    <h3 class="card-title">Laporan Supplier</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success" onclick="exportExcel('supplier')">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button type="button" class="btn btn-danger" onclick="exportPDF('supplier')">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Supplier</th>
                                <th>Nama Perusahaan</th>
                                <th>Nama Kontak</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th>Email</th>
                                <th>Total Transaksi</th>
                                <th>Total Pembelian</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>SUP001</td>
                                <td>PT Supplier Jaya</td>
                                <td>Jane Smith</td>
                                <td>Jl. Supplier No. 1</td>
                                <td>081234567891</td>
                                <td>jane@supplier.com</td>
                                <td>10</td>
                                <td>Rp 50.000.000</td>
                                <td><span class="badge badge-success">Aktif</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTables
        $('.table').DataTable({
            "responsive": true,
            "autoWidth": false
        });

        // Show/hide report based on selection
        $('#jenis_laporan').change(function() {
            $('.card[id^="laporan-"]').hide();
            $('#laporan-' + $(this).val()).show();
        });
    });

    // Function to export to Excel
    function exportExcel(type) {
        Swal.fire({
            title: 'Mengekspor ke Excel',
            text: 'Mohon tunggu sebentar...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Simulate export process
        setTimeout(() => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Laporan berhasil diekspor ke Excel',
                showConfirmButton: false,
                timer: 2000
            });
        }, 2000);
    }

    // Function to export to PDF
    function exportPDF(type) {
        Swal.fire({
            title: 'Mengekspor ke PDF',
            text: 'Mohon tunggu sebentar...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Simulate export process
        setTimeout(() => {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: 'Laporan berhasil diekspor ke PDF',
                showConfirmButton: false,
                timer: 2000
            });
        }, 2000);
    }
</script>
</body>
</html> 