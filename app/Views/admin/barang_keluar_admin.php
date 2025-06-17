<?= $this->include('components/header') ?>
<?= $this->include('components/sidebar_admin') ?>

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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Barang Keluar</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                            <i class="fas fa-plus"></i> Tambah Barang Keluar
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>No. Transaksi</th>
                                    <th>Customer</th>
                                    <th>Jumlah Item</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>2024-03-20</td>
                                    <td>BK20240320001</td>
                                    <td>PT Customer Sejahtera</td>
                                    <td>3</td>
                                    <td>Rp 3.500.000</td>
                                    <td><span class="badge badge-success">Selesai</span></td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= base_url('admin/barang-keluar/delete/1') ?>')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <button type="button" class="btn btn-success btn-sm" onclick="printInvoice('BK20240320001')">
                                            <i class="fas fa-print"></i>
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

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Keluar</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/barang-keluar/tambah') ?>" method="post">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label>Customer</label>
                                <select class="form-control" name="customer" required>
                                    <option value="">Pilih Customer</option>
                                    <option value="1">PT Customer Sejahtera</option>
                                    <option value="2">CV Pelanggan Setia</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No. Transaksi</label>
                                <input type="text" class="form-control" name="no_transaksi" value="BK<?= date('YmdHis') ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" name="keterangan" rows="3"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-12">
                            <h5>Detail Barang</h5>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="detail-table">
                                    <thead>
                                        <tr>
                                            <th>Barang</th>
                                            <th>Stok Tersedia</th>
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control barang-select" name="barang[]" required>
                                                    <option value="">Pilih Barang</option>
                                                    <option value="1" data-stok="10">Laptop Asus</option>
                                                    <option value="2" data-stok="15">Monitor LG</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control stok-tersedia" readonly>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control jumlah" name="jumlah[]" required min="1">
                                            </td>
                                            <td>
                                                <input type="number" class="form-control harga" name="harga[]" required>
                                            </td>
                                            <td>
                                                <input type="text" class="form-control subtotal" readonly>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger btn-sm hapus-baris">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="6">
                                                <button type="button" class="btn btn-success btn-sm" id="tambah-baris">
                                                    <i class="fas fa-plus"></i> Tambah Barang
                                                </button>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6 offset-md-6">
                            <table class="table">
                                <tr>
                                    <th>Total</th>
                                    <td>
                                        <input type="text" class="form-control" id="total" name="total" readonly>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
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
                                <th>No. Transaksi</th>
                                <td>BK20240320001</td>
                            </tr>
                            <tr>
                                <th>Tanggal</th>
                                <td>2024-03-20</td>
                            </tr>
                            <tr>
                                <th>Customer</th>
                                <td>PT Customer Sejahtera</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table">
                            <tr>
                                <th>Status</th>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                            <tr>
                                <th>Total Item</th>
                                <td>3</td>
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <td>Rp 3.500.000</td>
                            </tr>
                        </table>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-12">
                        <h5>Detail Barang</h5>
                        <div class="table-responsive">
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
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>BRG001</td>
                                        <td>Laptop Asus</td>
                                        <td>1</td>
                                        <td>Rp 2.000.000</td>
                                        <td>Rp 2.000.000</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>BRG002</td>
                                        <td>Monitor LG</td>
                                        <td>2</td>
                                        <td>Rp 750.000</td>
                                        <td>Rp 1.500.000</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-success" onclick="printInvoice('BK20240320001')">
                    <i class="fas fa-print"></i> Cetak
                </button>
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
    // Initialize DataTables
    $(document).ready(function() {
        $('.datatable').DataTable({
            "responsive": true,
            "autoWidth": false
        });

        // Format currency
        function formatRupiah(angka) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(angka);
        }

        // Calculate subtotal
        function hitungSubtotal(row) {
            var jumlah = parseInt(row.find('.jumlah').val()) || 0;
            var harga = parseInt(row.find('.harga').val()) || 0;
            var subtotal = jumlah * harga;
            row.find('.subtotal').val(formatRupiah(subtotal));
            hitungTotal();
        }

        // Calculate total
        function hitungTotal() {
            var total = 0;
            $('.subtotal').each(function() {
                var subtotal = $(this).val().replace(/[^\d]/g, '');
                total += parseInt(subtotal) || 0;
            });
            $('#total').val(formatRupiah(total));
        }

        // Add new row
        $('#tambah-baris').click(function() {
            var newRow = $('#detail-table tbody tr:first').clone();
            newRow.find('input').val('');
            $('#detail-table tbody').append(newRow);
        });

        // Delete row
        $(document).on('click', '.hapus-baris', function() {
            if ($('#detail-table tbody tr').length > 1) {
                $(this).closest('tr').remove();
                hitungTotal();
            }
        });

        // Calculate on input change
        $(document).on('input', '.jumlah, .harga', function() {
            hitungSubtotal($(this).closest('tr'));
        });

        // Update stok tersedia when barang is selected
        $(document).on('change', '.barang-select', function() {
            var stok = $(this).find(':selected').data('stok');
            $(this).closest('tr').find('.stok-tersedia').val(stok);
        });
    });

    // Function to show success message
    function showSuccess(message) {
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: message,
            timer: 2000,
            showConfirmButton: false
        });
    }

    // Function to show error message
    function showError(message) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: message
        });
    }

    // Function to confirm delete
    function confirmDelete(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak dapat dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    // Function to print invoice
    function printInvoice(noTransaksi) {
        window.open('<?= base_url('admin/barang-keluar/cetak/') ?>' + noTransaksi, '_blank');
    }
</script>
</body>
</html> 