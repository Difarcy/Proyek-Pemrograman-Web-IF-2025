<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Barang Masuk<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="mb-4">Barang Masuk</h1>
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
            <h5 class="mb-0">Daftar Barang Masuk</h5>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah">
                <i class="fas fa-plus"></i> Tambah Barang Masuk
            </button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($barang_masuk) && is_array($barang_masuk)): ?>
                            <?php foreach ($barang_masuk as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $item['tanggal'] ?? '2024-03-20' ?></td>
                                    <td><?= $item['no_transaksi'] ?? 'BM20240320001' ?></td>
                                    <td><?= $item['supplier'] ?? 'PT Supplier Jaya' ?></td>
                                    <td><?= $item['jumlah_item'] ?? 5 ?></td>
                                    <td><?= 'Rp ' . number_format($item['total_harga'] ?? 5000000, 0, ',', '.') ?></td>
                                    <td>
                                        <span class="badge badge-<?= ($item['status'] ?? 'selesai') === 'selesai' ? 'success' : 'warning' ?>">
                                            <?= ucfirst($item['status'] ?? 'selesai') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <a href="<?= base_url('admin/barang-masuk/delete/' . ($item['id'] ?? 1)) ?>" 
                                           class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Yakin ingin menghapus data ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <button type="button" class="btn btn-success btn-sm" onclick="printInvoice('<?= $item['no_transaksi'] ?? 'BM20240320001' ?>')">
                                            <i class="fas fa-print"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td>1</td>
                                <td>2024-03-20</td>
                                <td>BM20240320001</td>
                                <td>PT Supplier Jaya</td>
                                <td>5</td>
                                <td>Rp 5.000.000</td>
                                <td><span class="badge badge-success">Selesai</span></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-detail">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= base_url('admin/barang-masuk/delete/1') ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="printInvoice('BM20240320001')">
                                        <i class="fas fa-print"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Barang Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/barang-masuk/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="date" class="form-control" name="tanggal" required>
                            </div>
                            <div class="form-group">
                                <label>Supplier</label>
                                <select class="form-control" name="supplier_id" required>
                                    <option value="">Pilih Supplier</option>
                                    <option value="1">PT Supplier Jaya</option>
                                    <option value="2">CV Maju Bersama</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>No. Transaksi</label>
                                <input type="text" class="form-control" name="no_transaksi" value="BM<?= date('YmdHis') ?>" readonly>
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
                                            <th>Jumlah</th>
                                            <th>Harga</th>
                                            <th>Subtotal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <select class="form-control" name="barang_id[]" required>
                                                    <option value="">Pilih Barang</option>
                                                    <option value="1">Laptop Asus</option>
                                                    <option value="2">Monitor LG</option>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control jumlah" name="jumlah[]" required>
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
                                            <td colspan="5">
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
                <h4 class="modal-title">Detail Barang Masuk</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>No. Transaksi</strong></td>
                                <td>: BM20240320001</td>
                            </tr>
                            <tr>
                                <td><strong>Tanggal</strong></td>
                                <td>: 2024-03-20</td>
                            </tr>
                            <tr>
                                <td><strong>Supplier</strong></td>
                                <td>: PT Supplier Jaya</td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-borderless">
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>: <span class="badge badge-success">Selesai</span></td>
                            </tr>
                            <tr>
                                <td><strong>Total Item</strong></td>
                                <td>: 5</td>
                            </tr>
                            <tr>
                                <td><strong>Total Harga</strong></td>
                                <td>: Rp 5.000.000</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Barang</th>
                                <th>Jumlah</th>
                                <th>Harga</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Laptop Asus</td>
                                <td>2</td>
                                <td>Rp 2.000.000</td>
                                <td>Rp 4.000.000</td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Monitor LG</td>
                                <td>3</td>
                                <td>Rp 333.333</td>
                                <td>Rp 1.000.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Hitung subtotal
    $(document).on('input', '.jumlah, .harga', function() {
        var row = $(this).closest('tr');
        var jumlah = parseFloat(row.find('.jumlah').val()) || 0;
        var harga = parseFloat(row.find('.harga').val()) || 0;
        var subtotal = jumlah * harga;
        row.find('.subtotal').val('Rp ' + subtotal.toLocaleString('id-ID'));
        hitungTotal();
    });

    // Tambah baris baru
    $('#tambah-baris').click(function() {
        var newRow = `
            <tr>
                <td>
                    <select class="form-control" name="barang_id[]" required>
                        <option value="">Pilih Barang</option>
                        <option value="1">Laptop Asus</option>
                        <option value="2">Monitor LG</option>
                    </select>
                </td>
                <td>
                    <input type="number" class="form-control jumlah" name="jumlah[]" required>
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
        `;
        $('#detail-table tbody').append(newRow);
    });

    // Hapus baris
    $(document).on('click', '.hapus-baris', function() {
        $(this).closest('tr').remove();
        hitungTotal();
    });

    // Hitung total
    function hitungTotal() {
        var total = 0;
        $('.subtotal').each(function() {
            var value = $(this).val().replace('Rp ', '').replace(/\./g, '');
            total += parseFloat(value) || 0;
        });
        $('#total').val('Rp ' + total.toLocaleString('id-ID'));
    }

    function confirmDelete(url) {
        if (confirm('Yakin ingin menghapus data ini?')) {
            window.location.href = url;
        }
    }

    function printInvoice(noTransaksi) {
        window.open('<?= base_url('admin/barang-masuk/print/') ?>' + noTransaksi, '_blank');
    }
</script>
<?= $this->endSection() ?>
