<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>Data Supplier<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="container-fluid">
    <h1 class="mb-4">Data Supplier</h1>
    <div class="card">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
            <h5 class="mb-0">Daftar Supplier</h5>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah">
                <i class="fas fa-plus"></i> Tambah Supplier
            </button>
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
                            <th>Email</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($supplier) && is_array($supplier)): ?>
                            <?php foreach ($supplier as $index => $item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $item['kode_supplier'] ?? 'SUP001' ?></td>
                                    <td><?= $item['nama'] ?? 'PT Maju Jaya' ?></td>
                                    <td><?= $item['alamat'] ?? 'Jl. Industri No. 45' ?></td>
                                    <td><?= $item['no_telp'] ?? '081234567890' ?></td>
                                    <td><?= $item['email'] ?? 'info@majujaya.com' ?></td>
                                    <td>
                                        <span class="badge badge-<?= ($item['status'] ?? 'aktif') === 'aktif' ? 'success' : 'secondary' ?>">
                                            <?= ucfirst($item['status'] ?? 'aktif') ?>
                                        </span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit" 
                                                data-id="<?= $item['id'] ?? 1 ?>"
                                                data-kode="<?= $item['kode_supplier'] ?? 'SUP001' ?>"
                                                data-nama="<?= $item['nama'] ?? 'PT Maju Jaya' ?>"
                                                data-alamat="<?= $item['alamat'] ?? 'Jl. Industri No. 45' ?>"
                                                data-telepon="<?= $item['no_telp'] ?? '081234567890' ?>"
                                                data-email="<?= $item['email'] ?? 'info@majujaya.com' ?>"
                                                data-status="<?= $item['status'] ?? 'aktif' ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <a href="<?= base_url('admin/data-supplier/delete/' . ($item['id'] ?? 1)) ?>" 
                                           class="btn btn-danger btn-sm" 
                                           onclick="return confirm('Yakin ingin menghapus supplier ini?')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-riwayat">
                                            <i class="fas fa-history"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td>1</td>
                                <td>SUP001</td>
                                <td>PT Maju Jaya</td>
                                <td>Jl. Industri No. 45</td>
                                <td>081234567890</td>
                                <td>info@majujaya.com</td>
                                <td><span class="badge badge-success">Aktif</span></td>
                                <td>
                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#modal-edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('<?= base_url('admin/data-supplier/delete/1') ?>')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-riwayat">
                                        <i class="fas fa-history"></i>
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/data-supplier/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Supplier</label>
                        <input type="text" class="form-control" name="kode_supplier" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="tel" class="form-control" name="no_telp" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Tidak Aktif</option>
                        </select>
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

<!-- Modal Edit -->
<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-edit" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Supplier</label>
                        <input type="text" class="form-control" name="kode_supplier" id="edit_kode_supplier" required>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <input type="text" class="form-control" name="nama" id="edit_nama" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" id="edit_alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="tel" class="form-control" name="no_telp" id="edit_no_telp" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" id="edit_email" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" id="edit_status" required>
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Tidak Aktif</option>
                        </select>
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

<!-- Modal Riwayat -->
<div class="modal fade" id="modal-riwayat">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Riwayat Pembelian dari Supplier</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>No. Pembelian</th>
                                <th>Jumlah Item</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-03-20</td>
                                <td>PBL001</td>
                                <td>5</td>
                                <td>Rp 2.500.000</td>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                            <tr>
                                <td>2024-03-18</td>
                                <td>PBL002</td>
                                <td>3</td>
                                <td>Rp 1.200.000</td>
                                <td><span class="badge badge-warning">Proses</span></td>
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
    // Handle modal edit data
    $('#modal-edit').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var kode = button.data('kode');
        var nama = button.data('nama');
        var alamat = button.data('alamat');
        var telepon = button.data('telepon');
        var email = button.data('email');
        var status = button.data('status');
        
        var modal = $(this);
        modal.find('#edit_kode_supplier').val(kode);
        modal.find('#edit_nama').val(nama);
        modal.find('#edit_alamat').val(alamat);
        modal.find('#edit_no_telp').val(telepon);
        modal.find('#edit_email').val(email);
        modal.find('#edit_status').val(status);
        
        // Update form action
        modal.find('#form-edit').attr('action', '<?= base_url('admin/data-supplier/update/') ?>' + id);
    });
    
    function confirmDelete(url) {
        if (confirm('Yakin ingin menghapus supplier ini?')) {
            window.location.href = url;
        }
    }
</script>
<?= $this->endSection() ?> 