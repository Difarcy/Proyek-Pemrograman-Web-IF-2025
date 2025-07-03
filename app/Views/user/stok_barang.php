<?= $this->extend('layouts/user') ?>
<?= $this->section('title') ?>Stok Barang<?= $this->endSection() ?>
<?= $this->section('content') ?>
<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="v-container-fluid">
            <div class="v-row v-mb-2">
                <div class="v-col-sm-6">
                    <h1 class="v-m-0">Stok Barang</h1>
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
                    <form action="<?= base_url('user/stok-barang') ?>" method="get">
                        <div class="v-row">
                            <div class="v-col-md-3">
                                <div class="v-form-group">
                                    <label>Kategori</label>
                                    <select class="v-form-control" name="kategori">
                                        <option value="">Semua Kategori</option>
                                        <option value="elektronik">Elektronik</option>
                                        <option value="aksesoris">Aksesoris</option>
                                        <option value="komponen">Komponen</option>
                                        <option value="peripheral">Peripheral</option>
                                    </select>
                                </div>
                            </div>
                            <div class="v-col-md-3">
                                <div class="v-form-group">
                                    <label>Status Stok</label>
                                    <select class="v-form-control" name="status">
                                        <option value="">Semua Status</option>
                                        <option value="aman">Aman</option>
                                        <option value="hampir_habis">Hampir Habis</option>
                                        <option value="habis">Habis</option>
                                    </select>
                                </div>
                            </div>
                            <div class="v-col-md-3">
                                <div class="v-form-group">
                                    <label>Pencarian</label>
                                    <input type="text" class="v-form-control" name="search" placeholder="Cari barang...">
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

            <!-- Tabel Stok -->
            <div class="v-card">
                <div class="v-card-header">
                    <h3 class="v-card-title">Data Stok Barang</h3>
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
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Kategori</th>
                                    <th>Stok</th>
                                    <th>Satuan</th>
                                    <th>Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
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
                                    <td>Rp 15.000.000</td>
                                    <td><span class="v-badge v-badge-success">Aman</span></td>
                                    <td>
                                        <button type="button" class="v-btn v-btn-info v-btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('BRG001')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="v-btn v-btn-primary v-btn-sm" data-toggle="modal" data-target="#modal-barang-masuk" onclick="prepareBarangMasuk('BRG001')">
                                            <i class="fas fa-arrow-down"></i>
                                        </button>
                                        <button type="button" class="v-btn v-btn-warning v-btn-sm" data-toggle="modal" data-target="#modal-barang-keluar" onclick="prepareBarangKeluar('BRG001')">
                                            <i class="fas fa-arrow-up"></i>
                                        </button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>BRG002</td>
                                    <td>Mouse Gaming</td>
                                    <td>Aksesoris</td>
                                    <td>5</td>
                                    <td>Unit</td>
                                    <td>Rp 500.000</td>
                                    <td><span class="v-badge v-badge-warning">Hampir Habis</span></td>
                                    <td>
                                        <button type="button" class="v-btn v-btn-info v-btn-sm" data-toggle="modal" data-target="#modal-detail" onclick="showDetail('BRG002')">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="v-btn v-btn-primary v-btn-sm" data-toggle="modal" data-target="#modal-barang-masuk" onclick="prepareBarangMasuk('BRG002')">
                                            <i class="fas fa-arrow-down"></i>
                                        </button>
                                        <button type="button" class="v-btn v-btn-warning v-btn-sm" data-toggle="modal" data-target="#modal-barang-keluar" onclick="prepareBarangKeluar('BRG002')">
                                            <i class="fas fa-arrow-up"></i>
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
                <h4 class="v-modal-title">Detail Barang</h4>
                <button type="button" class="v-btn v-btn-default" data-dismiss="modal">Tutup</button>
            </div>
            <div class="v-modal-body">
                <table class="v-table">
                    <tr>
                        <th style="width: 150px;">Kode Barang</th>
                        <td id="detail-kode">BRG001</td>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <td id="detail-nama">Laptop Asus</td>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <td id="detail-kategori">Elektronik</td>
                    </tr>
                    <tr>
                        <th>Stok</th>
                        <td id="detail-stok">10 Unit</td>
                    </tr>
                    <tr>
                        <th>Harga</th>
                        <td id="detail-harga">Rp 15.000.000</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td id="detail-status"><span class="v-badge v-badge-success">Aman</span></td>
                    </tr>
                    <tr>
                        <th>Deskripsi</th>
                        <td id="detail-deskripsi">Laptop Asus dengan spesifikasi tinggi</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Barang Masuk -->
<div class="v-modal v-fade" id="modal-barang-masuk">
    <div class="v-modal-dialog">
        <div class="v-modal-content">
            <div class="v-modal-header">
                <h4 class="v-modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="v-btn v-btn-default" data-dismiss="modal">Batal</button>
            </div>
            <form action="<?= base_url('user/barang-masuk/tambah') ?>" method="post">
                <div class="v-modal-body">
                    <input type="hidden" name="kode_barang" id="masuk-kode">
                    <div class="v-form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="v-form-control" id="masuk-nama" readonly>
                    </div>
                    <div class="v-form-group">
                        <label>Supplier</label>
                        <select class="v-form-control" name="supplier" required>
                            <option value="">Pilih Supplier</option>
                            <option value="SUP001">PT Supplier Jaya</option>
                            <option value="SUP002">CV Supplier Makmur</option>
                        </select>
                    </div>
                    <div class="v-form-group">
                        <label>Jumlah</label>
                        <input type="number" class="v-form-control" name="jumlah" required min="1">
                    </div>
                    <div class="v-form-group">
                        <label>Harga Beli</label>
                        <input type="number" class="v-form-control" name="harga_beli" required min="0">
                    </div>
                    <div class="v-form-group">
                        <label>Keterangan</label>
                        <textarea class="v-form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="v-modal-footer v-justify-content-between">
                        <button type="button" class="v-btn v-btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="v-btn v-btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Barang Keluar -->
<div class="v-modal v-fade" id="modal-barang-keluar">
    <div class="v-modal-dialog">
        <div class="v-modal-content">
            <div class="v-modal-header">
                <h4 class="v-modal-title">Tambah Barang Keluar</h4>
                <button type="button" class="v-btn v-btn-default" data-dismiss="modal">Batal</button>
            </div>
            <form action="<?= base_url('user/barang-keluar/tambah') ?>" method="post">
                <div class="v-modal-body">
                    <input type="hidden" name="kode_barang" id="keluar-kode">
                    <div class="v-form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="v-form-control" id="keluar-nama" readonly>
                    </div>
                    <div class="v-form-group">
                        <label>Stok Tersedia</label>
                        <input type="text" class="v-form-control" id="keluar-stok" readonly>
                    </div>
                    <div class="v-form-group">
                        <label>Customer</label>
                        <select class="v-form-control" name="customer" required>
                            <option value="">Pilih Customer</option>
                            <option value="CUST001">John Doe</option>
                            <option value="CUST002">Jane Smith</option>
                        </select>
                    </div>
                    <div class="v-form-group">
                        <label>Jumlah</label>
                        <input type="number" class="v-form-control" name="jumlah" required min="1" id="keluar-jumlah">
                    </div>
                    <div class="v-form-group">
                        <label>Harga Jual</label>
                        <input type="number" class="v-form-control" name="harga_jual" required min="0">
                    </div>
                    <div class="v-form-group">
                        <label>Keterangan</label>
                        <textarea class="v-form-control" name="keterangan" rows="3"></textarea>
                    </div>
                    <div class="v-modal-footer v-justify-content-between">
                        <button type="button" class="v-btn v-btn-default" data-dismiss="modal">Batal</button>
                        <button type="submit" class="v-btn v-btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
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
        $('.v-table').DataTable({
            "responsive": true,
            "autoWidth": false
        });
    });

    // Function to show detail
    function showDetail(kode) {
        // Simulate API call
        const data = {
            'BRG001': {
                kode: 'BRG001',
                nama: 'Laptop Asus',
                kategori: 'Elektronik',
                stok: '10 Unit',
                harga: 'Rp 15.000.000',
                status: '<span class="v-badge v-badge-success">Aman</span>',
                deskripsi: 'Laptop Asus dengan spesifikasi tinggi'
            },
            'BRG002': {
                kode: 'BRG002',
                nama: 'Mouse Gaming',
                kategori: 'Aksesoris',
                stok: '5 Unit',
                harga: 'Rp 500.000',
                status: '<span class="v-badge v-badge-warning">Hampir Habis</span>',
                deskripsi: 'Mouse gaming dengan DPI tinggi'
            }
        };

        const item = data[kode];
        $('#detail-kode').text(item.kode);
        $('#detail-nama').text(item.nama);
        $('#detail-kategori').text(item.kategori);
        $('#detail-stok').text(item.stok);
        $('#detail-harga').text(item.harga);
        $('#detail-status').html(item.status);
        $('#detail-deskripsi').text(item.deskripsi);
    }

    // Function to prepare barang masuk
    function prepareBarangMasuk(kode) {
        // Simulate API call
        const data = {
            'BRG001': {
                kode: 'BRG001',
                nama: 'Laptop Asus'
            },
            'BRG002': {
                kode: 'BRG002',
                nama: 'Mouse Gaming'
            }
        };

        const item = data[kode];
        $('#masuk-kode').val(item.kode);
        $('#masuk-nama').val(item.nama);
    }

    // Function to prepare barang keluar
    function prepareBarangKeluar(kode) {
        // Simulate API call
        const data = {
            'BRG001': {
                kode: 'BRG001',
                nama: 'Laptop Asus',
                stok: 10
            },
            'BRG002': {
                kode: 'BRG002',
                nama: 'Mouse Gaming',
                stok: 5
            }
        };

        const item = data[kode];
        $('#keluar-kode').val(item.kode);
        $('#keluar-nama').val(item.nama);
        $('#keluar-stok').val(item.stok + ' Unit');
        $('#keluar-jumlah').attr('max', item.stok);
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