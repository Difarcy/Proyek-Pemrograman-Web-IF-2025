<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>data_petugas<?= $this->endSection() ?>

<?= $this->section('content') ?>
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
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Petugas</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah">
                            <i class="fas fa-plus"></i> Tambah Petugas
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Petugas</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Jabatan</th>
                                    <th>Alamat</th>
                                    <th>Kota</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($petugas)): ?>
                                <tr>
                                    <td>1</td>
                                    <td>Ahmad Rizki</td>
                                    <td>ahmad.rizki@email.com</td>
                                    <td>081234567890</td>
                                    <td>Admin</td>
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
                                    <td>Siti Nurhaliza</td>
                                    <td>siti.nurhaliza@email.com</td>
                                    <td>081234567891</td>
                                    <td>Kasir</td>
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
                                    <td>Budi Santoso</td>
                                    <td>budi.santoso@email.com</td>
                                    <td>081234567892</td>
                                    <td>Petugas Gudang</td>
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
                                    <td>Dewi Sartika</td>
                                    <td>dewi.sartika@email.com</td>
                                    <td>081234567893</td>
                                    <td>Kasir</td>
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
                                    <td>Rudi Hermawan</td>
                                    <td>rudi.hermawan@email.com</td>
                                    <td>081234567894</td>
                                    <td>Petugas Gudang</td>
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
                                <?php foreach ($petugas as $index => $petugas_item): ?>
                                <tr>
                                    <td><?= $index + 1 ?></td>
                                    <td><?= $petugas_item['nama'] ?? 'Nama Petugas' ?></td>
                                    <td><?= $petugas_item['email'] ?? 'email@example.com' ?></td>
                                    <td><?= $petugas_item['telepon'] ?? '081234567890' ?></td>
                                    <td><?= $petugas_item['jabatan'] ?? 'Petugas' ?></td>
                                    <td><?= $petugas_item['alamat'] ?? 'Jl. Contoh No. 123' ?></td>
                                    <td><?= $petugas_item['kota'] ?? 'Jakarta' ?></td>
                                    <td>
                                        <?php 
                                        $status = $petugas_item['status'] ?? 'Aktif';
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
    </section>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modal-tambah">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Petugas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/data-petugas/tambah') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" name="nip" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan" required>
                            <option value="">Pilih Jabatan</option>
                            <option value="Staff Gudang">Staff Gudang</option>
                            <option value="Kasir">Kasir</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="tel" class="form-control" name="telepon" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
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
                <h4 class="modal-title">Edit Petugas</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/data-petugas/edit/1') ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>NIP</label>
                        <input type="text" class="form-control" name="nip" value="PEG001" required>
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama" value="Andi Wijaya" required>
                    </div>
                    <div class="form-group">
                        <label>Jabatan</label>
                        <select class="form-control" name="jabatan" required>
                            <option value="Staff Gudang" selected>Staff Gudang</option>
                            <option value="Kasir">Kasir</option>
                            <option value="Admin">Admin</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required>Jl. Petugas No. 123</textarea>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="tel" class="form-control" name="telepon" value="081234567890" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="andi@example.com" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select class="form-control" name="status" required>
                            <option value="Aktif" selected>Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
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
                <h4 class="modal-title">Riwayat Aktivitas Petugas</h4>
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
                                <th>Waktu</th>
                                <th>Aktivitas</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>2024-03-20</td>
                                <td>09:30</td>
                                <td>Input Barang Masuk</td>
                                <td>5 item barang masuk</td>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                            <tr>
                                <td>2024-03-20</td>
                                <td>14:15</td>
                                <td>Input Barang Keluar</td>
                                <td>3 item barang keluar</td>
                                <td><span class="badge badge-success">Selesai</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->

<!-- Bootstrap 4 -->

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
</script>
<link rel="icon" type="image/x-icon" href="/assets/vstock.ico">
 
<?= $this->endSection() ?>
