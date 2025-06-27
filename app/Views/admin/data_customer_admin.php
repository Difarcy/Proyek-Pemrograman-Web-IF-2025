<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Data Customer<?= $this->endSection() ?>

<?= $this->section('content') ?>
        <div class="container-fluid">
    <h1 class="mb-4">Data Customer</h1>
    <div class="card mb-4">
        <div class="card-header bg-white d-flex justify-content-between align-items-center border-0">
            <h5 class="mb-0">Daftar Customer</h5>
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah">
                            <i class="fas fa-plus"></i> Tambah Customer
                        </button>
                    </div>
        <div class="card-body p-3">
                    <div class="table-responsive">
                <table class="table table-bordered table-striped mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                            <th>Nama Customer</th>
                            <th>Email</th>
                            <th>Telepon</th>
                                    <th>Alamat</th>
                            <th>Kota</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                        <?php if (empty($customers)): ?>
                                <tr>
                                    <td>1</td>
                                    <td>John Doe</td>
                            <td>john.doe@email.com</td>
                                    <td>081234567890</td>
                            <td>Jl. Sudirman No. 123</td>
                            <td>Jakarta</td>
                            <td><span class="badge-status badge-status-aktif">aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Jane Smith</td>
                            <td>jane.smith@email.com</td>
                            <td>081234567891</td>
                            <td>Jl. Thamrin No. 456</td>
                            <td>Jakarta</td>
                            <td><span class="badge-status badge-status-aktif">aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>Bob Johnson</td>
                            <td>bob.johnson@email.com</td>
                            <td>081234567892</td>
                            <td>Jl. Gatot Subroto No. 789</td>
                            <td>Bandung</td>
                            <td><span class="badge-status badge-status-nonaktif">nonaktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>4</td>
                            <td>Alice Brown</td>
                            <td>alice.brown@email.com</td>
                            <td>081234567893</td>
                            <td>Jl. Asia Afrika No. 321</td>
                            <td>Bandung</td>
                            <td><span class="badge-status badge-status-aktif">aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>5</td>
                            <td>Charlie Wilson</td>
                            <td>charlie.wilson@email.com</td>
                            <td>081234567894</td>
                            <td>Jl. Malioboro No. 654</td>
                            <td>Yogyakarta</td>
                            <td><span class="badge-status badge-status-aktif">aktif</span></td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                        </button>
                                </div>
                            </td>
                        </tr>
                        <?php else: ?>
                        <?php foreach ($customers as $index => $customer): ?>
                        <tr>
                            <td><?= $index + 1 ?></td>
                            <td><?= $customer['nama'] ?? 'Nama Customer' ?></td>
                            <td><?= $customer['email'] ?? 'email@example.com' ?></td>
                            <td><?= $customer['telepon'] ?? '081234567890' ?></td>
                            <td><?= $customer['alamat'] ?? 'Jl. Contoh No. 123' ?></td>
                            <td><?= $customer['kota'] ?? 'Jakarta' ?></td>
                            <td>
                                <?php 
                                $status = $customer['status'] ?? 'Aktif';
                                if ($status === 'Aktif') {
                                    echo '<span class="badge-status badge-status-aktif">aktif</span>';
                                } else {
                                    echo '<span class="badge-status badge-status-nonaktif">nonaktif</span>';
                                }
                                ?>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <button class="btn btn-sm btn-primary" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                        </button>
                                    <button class="btn btn-sm btn-danger" title="Hapus">
                                        <i class="bi bi-trash"></i>
                                        </button>
                                </div>
                                    </td>
                                </tr>
                        <?php endforeach; ?>
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
                <h4 class="modal-title">Tambah Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/data-customer/store') ?>" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Customer</label>
                        <input type="text" class="form-control" name="kode_customer" required>
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
                <h4 class="modal-title">Edit Customer</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form-edit" method="post">
                <?= csrf_field() ?>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Kode Customer</label>
                        <input type="text" class="form-control" name="kode_customer" id="edit_kode_customer" required>
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
                <h4 class="modal-title">Riwayat Transaksi Customer</h4>
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
                                <th>No. Transaksi</th>
                                <th>Jenis</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-03-20</td>
                                <td>TRX001</td>
                                <td>Pembelian</td>
                                <td>Rp 1.500.000</td>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                            <tr>
                                <td>2024-03-18</td>
                                <td>TRX002</td>
                                <td>Pembelian</td>
                                <td>Rp 750.000</td>
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
        modal.find('#edit_kode_customer').val(kode);
        modal.find('#edit_nama').val(nama);
        modal.find('#edit_alamat').val(alamat);
        modal.find('#edit_no_telp').val(telepon);
        modal.find('#edit_email').val(email);
        modal.find('#edit_status').val(status);
        
        // Update form action
        modal.find('#form-edit').attr('action', '<?= base_url('admin/data-customer/update/') ?>' + id);
    });
    
    function confirmDelete(url) {
        if (confirm('Yakin ingin menghapus customer ini?')) {
                window.location.href = url;
            }
    }
</script>
<?= $this->endSection() ?> 