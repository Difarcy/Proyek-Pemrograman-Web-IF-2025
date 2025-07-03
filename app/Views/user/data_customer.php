<?= $this->extend('layouts/user') ?>
<?= $this->section('title') ?>Data Customer<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Content Wrapper -->
<div class="v-content-wrapper">
    <!-- Content Header -->
    <div class="v-content-header">
        <div class="v-container-fluid">
            <div class="v-row v-mb-2">
                <div class="v-col-sm-6">
                    <h1 class="v-m-0">Data Customer</h1>
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
                    <form action="<?= base_url('user/data-customer') ?>" method="get">
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
                                    <input type="text" class="form-control" name="search" placeholder="Cari customer...">
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

            <!-- Tabel Customer -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Customer</h3>
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
                                    <th>Kode Customer</th>
                                    <th>Nama</th>
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
                                    <td>CUST001</td>
                                    <td>John Doe</td>
                                    <td>Jl. Contoh No. 123</td>
                                    <td>081234567890</td>
                                    <td>john@example.com</td>
                                    <td><span class="badge badge-success">Aktif</span></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('CUST001')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-riwayat" onclick="showRiwayat('CUST001')">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>CUST002</td>
                                    <td>Jane Smith</td>
                                    <td>Jl. Sample No. 456</td>
                                    <td>089876543210</td>
                                    <td>jane@example.com</td>
                                    <td><span class="badge badge-success">Aktif</span></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('CUST002')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-riwayat" onclick="showRiwayat('CUST002')">
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
                <h4 class="modal-title">Detail Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th style="width: 150px;">Kode Customer</th>
                        <td id="detail-kode">CUST001</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td id="detail-nama">John Doe</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td id="detail-alamat">Jl. Contoh No. 123</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td id="detail-telepon">081234567890</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td id="detail-email">john@example.com</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td id="detail-status"><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <th>Total Transaksi</th>
                        <td id="detail-total-transaksi">15 Transaksi</td>
                    </tr>
                    <tr>
                        <th>Total Pembelian</th>
                        <td id="detail-total-pembelian">Rp 25.000.000</td>
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
            'CUST001': {
                kode: 'CUST001',
                nama: 'John Doe',
                alamat: 'Jl. Contoh No. 123',
                telepon: '081234567890',
                email: 'john@example.com',
                status: '<span class="badge badge-success">Aktif</span>',
                totalTransaksi: '15 Transaksi',
                totalPembelian: 'Rp 25.000.000'
            },
            'CUST002': {
                kode: 'CUST002',
                nama: 'Jane Smith',
                alamat: 'Jl. Sample No. 456',
                telepon: '089876543210',
                email: 'jane@example.com',
                status: '<span class="badge badge-success">Aktif</span>',
                totalTransaksi: '8 Transaksi',
                totalPembelian: 'Rp 15.000.000'
            }
        };

        const customer = data[kode];
        $('#detail-kode').text(customer.kode);
        $('#detail-nama').text(customer.nama);
        $('#detail-alamat').text(customer.alamat);
        $('#detail-telepon').text(customer.telepon);
        $('#detail-email').text(customer.email);
        $('#detail-status').html(customer.status);
        $('#detail-total-transaksi').text(customer.totalTransaksi);
        $('#detail-total-pembelian').text(customer.totalPembelian);
    }

    // Function to show riwayat
    function showRiwayat(kode) {
        // Simulate API call
        const data = {
            'CUST001': [
                {
                    no: 1,
                    tanggal: '2024-02-20',
                    noTransaksi: 'TRX001',
                    jumlahItem: 3,
                    total: 'Rp 5.000.000',
                    status: '<span class="badge badge-success">Selesai</span>'
                },
                {
                    no: 2,
                    tanggal: '2024-02-19',
                    noTransaksi: 'TRX002',
                    jumlahItem: 2,
                    total: 'Rp 3.000.000',
                    status: '<span class="badge badge-success">Selesai</span>'
                }
            ],
            'CUST002': [
                {
                    no: 1,
                    tanggal: '2024-02-18',
                    noTransaksi: 'TRX003',
                    jumlahItem: 1,
                    total: 'Rp 2.000.000',
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