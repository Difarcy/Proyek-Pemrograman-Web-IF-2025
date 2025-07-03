<?= $this->extend('layouts/user') ?>
<?= $this->section('title') ?>Data Supplier<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="v-container-fluid">
            <div class="v-row v-mb-2">
                <div class="v-col-sm-6">
                    <h1 class="v-m-0">Data Supplier</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="v-container-fluid">
            <!-- Filter -->
            <div class="v-card">
                <div class="v-card-header">
                    <h3 class="v-card-title">Filter</h3>
                </div>
                <div class="v-card-body">
                    <form action="<?= base_url('user/data-supplier') ?>" method="get">
                        <div class="v-row">
                            <div class="v-col-md-3">
                                <div class="v-form-group">
                                    <label>Status</label>
                                    <select class="v-form-control" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="aktif">Aktif</option>
                                        <option value="nonaktif">Nonaktif</option>
                                    </select>
                                </div>
                            </div>
                            <div class="v-col-md-3">
                                <div class="v-form-group">
                                    <label>Pencarian</label>
                                    <input type="text" class="v-form-control" name="search" placeholder="Cari supplier...">
                                </div>
                            </div>
                            <div class="v-col-md-3">
                                <div class="v-form-group">
                                    <label>&nbsp;</label>
                                    <button type="submit" class="v-btn v-btn-primary v-btn-block">
                                        <i class="fas fa-search"></i> Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Tabel Supplier -->
            <div class="v-card">
                <div class="v-card-header">
                    <h3 class="v-card-title">Data Supplier</h3>
                    <div class="v-card-tools">
                        <button type="button" class="v-btn v-btn-success" onclick="exportExcel()">
                            <i class="fas fa-file-excel"></i> Export Excel
                        </button>
                        <button type="button" class="v-btn v-btn-danger" onclick="exportPDF()">
                            <i class="fas fa-file-pdf"></i> Export PDF
                        </button>
                    </div>
                </div>
                <div class="v-card-body">
                    <div class="v-table-responsive">
                        <table class="v-table v-table-bordered v-table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode Supplier</th>
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
                                    <td>SUP001</td>
                                    <td>PT Supplier Jaya</td>
                                    <td>Jl. Contoh No. 123</td>
                                    <td>081234567890</td>
                                    <td>supplier@example.com</td>
                                    <td><span class="v-badge v-badge-success">Aktif</span></td>
                                    <td>
                                        <button type="button" class="v-btn v-btn-info v-btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('SUP001')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="v-btn v-btn-warning v-btn-sm" data-toggle="modal" data-target="#modal-riwayat" onclick="showRiwayat('SUP001')">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>SUP002</td>
                                    <td>CV Supplier Makmur</td>
                                    <td>Jl. Sample No. 456</td>
                                    <td>089876543210</td>
                                    <td>cvmakmur@example.com</td>
                                    <td><span class="v-badge v-badge-success">Aktif</span></td>
                                    <td>
                                        <button type="button" class="v-btn v-btn-info v-btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('SUP002')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="v-btn v-btn-warning v-btn-sm" data-toggle="modal" data-target="#modal-riwayat" onclick="showRiwayat('SUP002')">
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
<div class="v-modal v-fade" id="modal-detail">
    <div class="v-modal-dialog">
        <div class="v-modal-content">
            <div class="v-modal-header">
                <h4 class="v-modal-title">Detail Supplier</h4>
                <button type="button" class="v-btn v-btn-default" data-dismiss="modal">Tutup</button>
            </div>
            <div class="v-modal-body">
                <table class="v-table">
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
                        <td id="detail-status"><span class="v-badge v-badge-success">Aktif</span></td>
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
        </div>
    </div>
</div>

<!-- Modal Riwayat -->
<div class="v-modal v-fade" id="modal-riwayat">
    <div class="v-modal-dialog v-modal-lg">
        <div class="v-modal-content">
            <div class="v-modal-header">
                <h4 class="v-modal-title">Riwayat Transaksi</h4>
                <button type="button" class="v-btn v-btn-default" data-dismiss="modal">Tutup</button>
            </div>
            <div class="v-modal-body">
                <div class="v-table-responsive">
                    <table class="v-table v-table-bordered">
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
            'SUP001': {
                kode: 'SUP001',
                namaPerusahaan: 'PT Supplier Jaya',
                namaKontak: 'Budi Santoso',
                alamat: 'Jl. Supplier No. 123',
                telepon: '081234567890',
                email: 'info@supplierjaya.com',
                status: '<span class="v-badge v-badge-success">Aktif</span>',
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
                status: '<span class="v-badge v-badge-success">Aktif</span>',
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
                    status: '<span class="v-badge v-badge-success">Selesai</span>'
                },
                {
                    no: 2,
                    tanggal: '2024-02-19',
                    noTransaksi: 'TRX002',
                    jumlahItem: 3,
                    total: 'Rp 6.000.000',
                    status: '<span class="v-badge v-badge-success">Selesai</span>'
                }
            ],
            'SUP002': [
                {
                    no: 1,
                    tanggal: '2024-02-18',
                    noTransaksi: 'TRX003',
                    jumlahItem: 2,
                    total: 'Rp 4.000.000',
                    status: '<span class="v-badge v-badge-success">Selesai</span>'
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
                        <button type="button" class="v-btn v-btn-info v-btn-sm" onclick="viewTransaction('${item.noTransaksi}')">
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