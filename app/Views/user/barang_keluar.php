<?= $this->extend('layouts/user') ?>
<?= $this->section('title') ?>Barang Keluar<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Barang Keluar</h1>
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
                    <form action="<?= base_url('user/barang-keluar') ?>" method="get">
                        <div class="row">
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
                                    <label>Customer</label>
                                    <select class="form-control" name="customer">
                                        <option value="">Semua Customer</option>
                                        <option value="1">PT Customer A</option>
                                        <option value="2">PT Customer B</option>
                                    </select>
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

            <!-- Tabel Barang Keluar -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Barang Keluar</h3>
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
                                    <th>No. Transaksi</th>
                                    <th>Tanggal</th>
                                    <th>Customer</th>
                                    <th>Total Item</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('TRX-20240220-001')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>TRX-20240220-002</td>
                                    <td>20 Feb 2024</td>
                                    <td>PT Customer B</td>
                                    <td>2 Item</td>
                                    <td>Rp 2.000.000</td>
                                    <td><span class="badge badge-warning">Proses</span></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('TRX-20240220-002')">
                                            <i class="fas fa-eye"></i>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Detail Barang Keluar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th style="width: 150px;">No. Transaksi</th>
                                <td id="detail-no-transaksi">TRX-20240220-001</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td id="detail-tanggal">20 Feb 2024</td>
                            </tr>
                            <tr>
                                <th>Customer</th>
                                <td id="detail-customer">PT Customer A</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td id="detail-status"><span class="badge badge-success">Selesai</span></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th style="width: 150px;">Total Item</th>
                                <td id="detail-total-item">3 Item</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td id="detail-total-harga">Rp 3.000.000</td>
                            </tr>
                            <tr>
                                <th>Petugas</th>
                                <td id="detail-petugas">Budi Santoso</td>
                            </tr>
                            <tr>
                                <th>Keterangan</th>
                                <td id="detail-keterangan">-</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Barang</th>
                                <th>Nama Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="detail-items">
                            <!-- Data item akan diisi melalui JavaScript -->
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
    function showDetail(noTransaksi) {
        // Simulate API call
        const data = {
            'TRX-20240220-001': {
                noTransaksi: 'TRX-20240220-001',
                tanggal: '20 Feb 2024',
                customer: 'PT Customer A',
                status: '<span class="badge badge-success">Selesai</span>',
                totalItem: '3 Item',
                totalHarga: 'Rp 3.000.000',
                petugas: 'Budi Santoso',
                keterangan: '-',
                items: [
                    {
                        no: 1,
                        kode: 'BRG001',
                        nama: 'Laptop Asus',
                        jumlah: 1,
                        harga: 'Rp 2.000.000',
                        subtotal: 'Rp 2.000.000'
                    },
                    {
                        no: 2,
                        kode: 'BRG002',
                        nama: 'Mouse Logitech',
                        jumlah: 2,
                        harga: 'Rp 500.000',
                        subtotal: 'Rp 1.000.000'
                    }
                ]
            },
            'TRX-20240220-002': {
                noTransaksi: 'TRX-20240220-002',
                tanggal: '20 Feb 2024',
                customer: 'PT Customer B',
                status: '<span class="badge badge-warning">Proses</span>',
                totalItem: '2 Item',
                totalHarga: 'Rp 2.000.000',
                petugas: 'Ani Wijaya',
                keterangan: 'Menunggu konfirmasi',
                items: [
                    {
                        no: 1,
                        kode: 'BRG003',
                        nama: 'Keyboard Mechanical',
                        jumlah: 2,
                        harga: 'Rp 1.000.000',
                        subtotal: 'Rp 2.000.000'
                    }
                ]
            }
        };

        const transaksi = data[noTransaksi];
        $('#detail-no-transaksi').text(transaksi.noTransaksi);
        $('#detail-tanggal').text(transaksi.tanggal);
        $('#detail-customer').text(transaksi.customer);
        $('#detail-status').html(transaksi.status);
        $('#detail-total-item').text(transaksi.totalItem);
        $('#detail-total-harga').text(transaksi.totalHarga);
        $('#detail-petugas').text(transaksi.petugas);
        $('#detail-keterangan').text(transaksi.keterangan);

        let html = '';
        transaksi.items.forEach(item => {
            html += `
                <tr>
                    <td>${item.no}</td>
                    <td>${item.kode}</td>
                    <td>${item.nama}</td>
                    <td>${item.jumlah}</td>
                    <td>${item.harga}</td>
                    <td>${item.subtotal}</td>
                </tr>
            `;
        });
        $('#detail-items').html(html);
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