<?= $this->include('components/header') ?>
<?= $this->include('components/sidebar_user') ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data Petugas</h1>
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
                    <form action="<?= base_url('user/data-petugas') ?>" method="get">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Jabatan</label>
                                    <select class="form-control" name="jabatan">
                                        <option value="">Semua Jabatan</option>
                                        <option value="admin">Admin</option>
                                        <option value="kasir">Kasir</option>
                                        <option value="gudang">Staff Gudang</option>
                                    </select>
                                </div>
                            </div>
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
                                    <input type="text" class="form-control" name="search" placeholder="Cari petugas...">
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

            <!-- Tabel Petugas -->
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Petugas</h3>
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
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>No. Telepon</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>P001</td>
                                    <td>Budi Santoso</td>
                                    <td>Admin</td>
                                    <td>081234567890</td>
                                    <td>budi@example.com</td>
                                    <td><span class="badge badge-success">Aktif</span></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('P001')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-aktivitas" onclick="showAktivitas('P001')">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>P002</td>
                                    <td>Ani Wijaya</td>
                                    <td>Kasir</td>
                                    <td>089876543210</td>
                                    <td>ani@example.com</td>
                                    <td><span class="badge badge-success">Aktif</span></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('P002')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#modal-aktivitas" onclick="showAktivitas('P002')">
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
                <h4 class="modal-title">Detail Petugas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <tr>
                        <th style="width: 150px;">NIP</th>
                        <td id="detail-nip">P001</td>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <td id="detail-nama">Budi Santoso</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td id="detail-jabatan">Admin</td>
                    </tr>
                    <tr>
                        <th>No. Telepon</th>
                        <td id="detail-telepon">081234567890</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td id="detail-email">budi@example.com</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td id="detail-status"><span class="badge badge-success">Aktif</span></td>
                    </tr>
                    <tr>
                        <th>Terakhir Login</th>
                        <td id="detail-login">20 Feb 2024 10:30</td>
                    </tr>
                    <tr>
                        <th>Total Aktivitas</th>
                        <td id="detail-total-aktivitas">150 Aktivitas</td>
                    </tr>
                </table>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Aktivitas -->
<div class="modal fade" id="modal-aktivitas">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Riwayat Aktivitas</h4>
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
                                <th>Waktu</th>
                                <th>Aktivitas</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>
                        <tbody id="aktivitas-body">
                            <!-- Data aktivitas akan diisi melalui JavaScript -->
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
    function showDetail(nip) {
        // Simulate API call
        const data = {
            'P001': {
                nip: 'P001',
                nama: 'Budi Santoso',
                jabatan: 'Admin',
                telepon: '081234567890',
                email: 'budi@example.com',
                status: '<span class="badge badge-success">Aktif</span>',
                login: '20 Feb 2024 10:30',
                totalAktivitas: '150 Aktivitas'
            },
            'P002': {
                nip: 'P002',
                nama: 'Ani Wijaya',
                jabatan: 'Kasir',
                telepon: '089876543210',
                email: 'ani@example.com',
                status: '<span class="badge badge-success">Aktif</span>',
                login: '20 Feb 2024 09:15',
                totalAktivitas: '75 Aktivitas'
            }
        };

        const petugas = data[nip];
        $('#detail-nip').text(petugas.nip);
        $('#detail-nama').text(petugas.nama);
        $('#detail-jabatan').text(petugas.jabatan);
        $('#detail-telepon').text(petugas.telepon);
        $('#detail-email').text(petugas.email);
        $('#detail-status').html(petugas.status);
        $('#detail-login').text(petugas.login);
        $('#detail-total-aktivitas').text(petugas.totalAktivitas);
    }

    // Function to show aktivitas
    function showAktivitas(nip) {
        // Simulate API call
        const data = {
            'P001': [
                {
                    no: 1,
                    tanggal: '2024-02-20',
                    waktu: '10:30',
                    aktivitas: 'Login Sistem',
                    keterangan: 'Login berhasil'
                },
                {
                    no: 2,
                    tanggal: '2024-02-20',
                    waktu: '10:35',
                    aktivitas: 'Tambah Barang',
                    keterangan: 'Menambah 5 item baru'
                }
            ],
            'P002': [
                {
                    no: 1,
                    tanggal: '2024-02-20',
                    waktu: '09:15',
                    aktivitas: 'Login Sistem',
                    keterangan: 'Login berhasil'
                },
                {
                    no: 2,
                    tanggal: '2024-02-20',
                    waktu: '09:20',
                    aktivitas: 'Transaksi Penjualan',
                    keterangan: 'Melakukan transaksi TRX001'
                }
            ]
        };

        const aktivitas = data[nip];
        let html = '';
        aktivitas.forEach(item => {
            html += `
                <tr>
                    <td>${item.no}</td>
                    <td>${item.tanggal}</td>
                    <td>${item.waktu}</td>
                    <td>${item.aktivitas}</td>
                    <td>${item.keterangan}</td>
                </tr>
            `;
        });
        $('#aktivitas-body').html(html);
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