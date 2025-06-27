<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Laporan<?= $this->endSection() ?>
<?= $this->section('content') ?>
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
            <!-- Filter -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Filter Laporan</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/laporan') ?>" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jenis Laporan</label>
                                    <select class="form-control" name="jenis_laporan" id="jenis_laporan">
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
                                    <input type="date" class="form-control" name="tanggal_mulai">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" class="form-control" name="tanggal_selesai">
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
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
                                    <td>Unit</td>
                                    <td>Rp 2.000.000</td>
                                    <td><span class="badge badge-success">Aman</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>BRG002</td>
                                    <td>Mouse Logitech</td>
                                    <td>Aksesoris</td>
                                    <td>5</td>
                                    <td>Unit</td>
                                    <td>Rp 500.000</td>
                                    <td><span class="badge badge-warning">Menipis</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>TRX-20240220-001</td>
                                    <td>20 Feb 2024</td>
                                    <td>PT Supplier A</td>
                                    <td>5 Item</td>
                                    <td>Rp 5.000.000</td>
                                    <td><span class="badge badge-success">Selesai</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>TRX-20240220-001</td>
                                    <td>20 Feb 2024</td>
                                    <td>PT Customer A</td>
                                    <td>3 Item</td>
                                    <td>Rp 3.000.000</td>
                                    <td><span class="badge badge-success">Selesai</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                    <!-- Ringkasan -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Rp 10.000.000</h3>
                                    <p>Total Penjualan</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>50</h3>
                                    <p>Total Transaksi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>30</h3>
                                    <p>Total Customer</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>Rp 200.000</h3>
                                    <p>Rata-rata Transaksi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Detail -->
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>TRX-20240220-001</td>
                                    <td>20 Feb 2024</td>
                                    <td>PT Customer A</td>
                                    <td>3 Item</td>
                                    <td>Rp 3.000.000</td>
                                    <td><span class="badge badge-success">Selesai</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                    <!-- Ringkasan -->
                    <div class="row">
                        <div class="col-md-3">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>Rp 8.000.000</h3>
                                    <p>Total Pembelian</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>30</h3>
                                    <p>Total Transaksi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-file-invoice"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>10</h3>
                                    <p>Total Supplier</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>Rp 266.667</h3>
                                    <p>Rata-rata Transaksi</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Tabel Detail -->
                    <div class="table-responsive mt-3">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Supplier</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>TRX-20240220-001</td>
                                    <td>20 Feb 2024</td>
                                    <td>PT Supplier A</td>
                                    <td>5 Item</td>
                                    <td>Rp 5.000.000</td>
                                    <td><span class="badge badge-success">Selesai</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Customer</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Total Transaksi</th>
                                    <th>Total Pembelian</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>CUST001</td>
                                    <td>PT Customer A</td>
                                    <td>Jl. Contoh No. 1</td>
                                    <td>081234567890</td>
                                    <td>10 Transaksi</td>
                                    <td>Rp 5.000.000</td>
                                    <td><span class="badge badge-success">Aktif</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Supplier</th>
                                    <th>Nama</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Total Transaksi</th>
                                    <th>Total Pembelian</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>SUP001</td>
                                    <td>PT Supplier A</td>
                                    <td>Jl. Contoh No. 1</td>
                                    <td>081234567890</td>
                                    <td>5 Transaksi</td>
                                    <td>Rp 3.000.000</td>
                                    <td><span class="badge badge-success">Aktif</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
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

        // Handle jenis laporan change
        $('#jenis_laporan').change(function() {
            const jenis = $(this).val();
            $('.card[id^="laporan-"]').hide();
            $(`#laporan-${jenis}`).show();
        });
    });

    // Function to export to Excel
    function exportExcel(jenis) {
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
                text: 'Data berhasil diekspor ke Excel',
                showConfirmButton: false,
                timer: 2000
            });
        }, 2000);
    }

    // Function to export to PDF
    function exportPDF(jenis) {
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
                text: 'Data berhasil diekspor ke PDF',
                showConfirmButton: false,
                timer: 2000
            });
        }, 2000);
    }
</script>
</body>
</html> 