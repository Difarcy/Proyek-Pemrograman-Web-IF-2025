<?= $this->extend('layouts/main') ?>
<?= $this->section('title') ?>Data Supplier<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Supplier</h1>
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
                    <h3 class="card-title">Filter</h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('user/data-supplier') ?>" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status</label>
                                    <select class="form-control" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Pencarian</label>
                                    <input type="text" class="form-control" name="search" placeholder="Cari supplier...">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="btn btn-primary btn-block">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Supplier -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Supplier</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-success" onclick="exportExcel()">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button type="button" class="btn btn-danger" onclick="exportPDF()">
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
                                    <th>Nama Perusahaan</th>
                                    <th>Nama Kontak</th>
                                    <th>Alamat</th>
                                    <th>No. Telepon</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>SUP001</td>
                                    <td>PT Supplier Jaya</td>
                                    <td>Budi Santoso</td>
                                    <td>Jl. Supplier No. 123</td>
                                    <td>081234567890</td>
                                    <td>info@supplierjaya.com</td>
                                    <td><span class="badge badge-success">Aktif</span></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('SUP001')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-riwayat" onclick="showRiwayat('SUP001')">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>SUP002</td>
                                    <td>CV Supplier Makmur</td>
                                    <td>Ani Wijaya</td>
                                    <td>Jl. Makmur No. 456</td>
                                    <td>089876543210</td>
                                    <td>info@suppliermakmur.com</td>
                                    <td><span class="badge badge-success">Aktif</span></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('SUP002')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-riwayat" onclick="showRiwayat('SUP002')">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Detail -->
<div class="modal fade" id="modal-detail">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th style="width: 150px;">Kode Supplier</th>
                        <td id="detail-kode">SUP001</td>
                    </tr>
                    <tr>
                        <th>Nama Perusahaan</th>
                        <td id="detail-nama-perusahaan">PT Supplier Jaya</td>
                    </tr>
                    <tr>
                        <th>Nama Kontak</th>
                        <td id="detail-nama-kontak">Budi Santoso</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td id="detail-alamat">Jl. Supplier No. 123</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td id="detail-telepon">081234567890</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td id="detail-email">info@supplierjaya.com</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td id="detail-status"><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <th>Total Transaksi</th>
                        <td id="detail-total-transaksi">25 Transaksi</td>
                    </tr>
                    <tr>
                        <th>Total Pembelian</th>
                        <td id="detail-total-pembelian">Rp 50.000.000</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Riwayat -->
<div class="modal fade" id="modal-riwayat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Riwayat Transaksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>No. Transaksi</th>
                                <th>Jumlah Item</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="riwayat-body">
                            <!-- Data riwayat akan diisi melalui JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
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
    });

    // Function to show detail
    function showDetail(kode) {
        // Simulate API call
        const data = {
            'SUP001': {
                kode: 'SUP001',
                namaPerusahaan: 'PT Supplier Jaya',
                namaKontak: 'Budi Santoso',
                alamat: 'Jl. Supplier No. 123',
                telepon: '081234567890',
                email: 'info@supplierjaya.com',
                status: '<span class="badge badge-success">Aktif</span>',
                totalTransaksi: '25 Transaksi',
                totalPembelian: 'Rp 50.000.000'
            },
            'SUP002': {
                kode: 'SUP002',
                namaPerusahaan: 'CV Supplier Makmur',
                namaKontak: 'Ani Wijaya',
                alamat: 'Jl. Makmur No. 456',
                telepon: '089876543210',
                email: 'info@suppliermakmur.com',
                status: '<span class="badge badge-success">Aktif</span>',
                totalTransaksi: '15 Transaksi',
                totalPembelian: 'Rp 30.000.000'
            }
        };

        const supplier = data[kode];
        $('#detail-kode').text(supplier.kode);
        $('#detail-nama-perusahaan').text(supplier.namaPerusahaan);
        $('#detail-nama-kontak').text(supplier.namaKontak);
        $('#detail-alamat').text(supplier.alamat);
        $('#detail-telepon').text(supplier.telepon);
        $('#detail-email').text(supplier.email);
        $('#detail-status').html(supplier.status);
        $('#detail-total-transaksi').text(supplier.totalTransaksi);
        $('#detail-total-pembelian').text(supplier.totalPembelian);
    }

    // Function to show riwayat
    function showRiwayat(kode) {
        // Simulate API call
        const data = {
            'SUP001': [
                {
                    no: 1,
                    tanggal: '2024-02-20',
                    noTransaksi: 'TRX001',
                    jumlahItem: 5,
                    total: 'Rp 10.000.000',
                    status: '<span class="badge badge-success">Selesai</span>'
                },
                {
                    no: 2,
                    tanggal: '2024-02-19',
                    noTransaksi: 'TRX002',
                    jumlahItem: 3,
                    total: 'Rp 6.000.000',
                    status: '<span class="badge badge-success">Selesai</span>'
                }
            ],
            'SUP002': [
                {
                    no: 1,
                    tanggal: '2024-02-18',
                    noTransaksi: 'TRX003',
                    jumlahItem: 2,
                    total: 'Rp 4.000.000',
                    status: '<span class="badge badge-success">Selesai</span>'
                }
            ]
        };

        const riwayat = data[kode];
        let html = '';
        riwayat.forEach(item => {
            html += `
                <tr>
                    <td>${item.no}</td>
                    <td>${item.tanggal}</td>
                    <td>${item.noTransaksi}</td>
                    <td>${item.jumlahItem} Item</td>
                    <td>${item.total}</td>
                    <td>${item.status}</td>
                    <td>
                        <button type="button" class="btn btn-info btn-sm" onclick="viewTransaction('${item.noTransaksi}')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </td>
                </tr>
            `;
        });
        $('#riwayat-body').html(html);
    }

    // Function to view transaction
    function viewTransaction(noTransaksi) {
        // Implementasi view transaction
        Swal.fire({
            title: 'Detail Transaksi',
            text: `Menampilkan detail transaksi ${noTransaksi}`,
            icon: 'info'
        });
    }

    // Function to export to Excel
    function exportExcel() {
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
    function exportPDF() {
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