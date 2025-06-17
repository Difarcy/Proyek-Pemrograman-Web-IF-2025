<?= $this->include('components/header') ?>
<?= $this->include('components/sidebar_admin') ?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <!-- Content Header -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Profil Toko</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Profil Toko -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Informasi Toko</h3>
                            <div class="card-tools">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-edit-profil">
                                    <i class="fas fa-edit"></i> Edit Profil
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="text-center mb-4">
                                <img src="<?= base_url('assets/img/logo.png') ?>" alt="Logo Toko" class="img-fluid" style="max-height: 150px;">
                            </div>
                            <table class="table">
                                <tr>
                                    <th style="width: 200px;">Nama Toko</th>
                                    <td>VSTOCK Store</td>
                                </tr>
                                <tr>
                                    <th>Alamat</th>
                                    <td>Jl. Toko No. 123, Kota, Provinsi</td>
                                </tr>
                                <tr>
                                    <th>No. Telepon</th>
                                    <td>081234567890</td>
                                </tr>
                                <tr>
                                    <th>Email</th>
                                    <td>info@vstock.com</td>
                                </tr>
                                <tr>
                                    <th>Website</th>
                                    <td>www.vstock.com</td>
                                </tr>
                                <tr>
                                    <th>Deskripsi</th>
                                    <td>Toko elektronik terpercaya dengan berbagai produk berkualitas</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Pengaturan -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pengaturan Sistem</h3>
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('admin/profil-toko/pengaturan') ?>" method="post">
                                <div class="form-group">
                                    <label>Format Nomor Transaksi</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Prefix</span>
                                        </div>
                                        <input type="text" class="form-control" name="prefix_transaksi" value="VST" required>
                                    </div>
                                    <small class="form-text text-muted">Contoh: VST20240320001</small>
                                </div>

                                <div class="form-group">
                                    <label>Stok Minimum</label>
                                    <input type="number" class="form-control" name="stok_minimum" value="5" required>
                                    <small class="form-text text-muted">Jumlah minimum stok sebelum peringatan</small>
                                </div>

                                <div class="form-group">
                                    <label>Mata Uang</label>
                                    <select class="form-control" name="mata_uang" required>
                                        <option value="IDR" selected>Rupiah (IDR)</option>
                                        <option value="USD">US Dollar (USD)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Zona Waktu</label>
                                    <select class="form-control" name="zona_waktu" required>
                                        <option value="Asia/Jakarta" selected>Asia/Jakarta (WIB)</option>
                                        <option value="Asia/Makassar">Asia/Makassar (WITA)</option>
                                        <option value="Asia/Jayapura">Asia/Jayapura (WIT)</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Notifikasi Email</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="notif_email" name="notif_email" checked>
                                        <label class="custom-control-label" for="notif_email">Aktifkan notifikasi email</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Backup Otomatis</label>
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="backup_otomatis" name="backup_otomatis" checked>
                                        <label class="custom-control-label" for="backup_otomatis">Aktifkan backup otomatis</label>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Simpan Pengaturan
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Backup Database -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Backup Database</h3>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success btn-block" onclick="backupDatabase()">
                                        <i class="fas fa-download"></i> Backup Sekarang
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-info btn-block" data-toggle="modal" data-target="#modal-restore">
                                        <i class="fas fa-upload"></i> Restore Database
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal Edit Profil -->
<div class="modal fade" id="modal-edit-profil">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Profil Toko</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/profil-toko/update') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Logo Toko</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo" name="logo">
                            <label class="custom-file-label" for="logo">Pilih file</label>
                        </div>
                        <small class="form-text text-muted">Format: JPG, PNG, atau GIF. Maksimal 2MB</small>
                    </div>
                    <div class="form-group">
                        <label>Nama Toko</label>
                        <input type="text" class="form-control" name="nama_toko" value="VSTOCK Store" required>
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea class="form-control" name="alamat" rows="3" required>Jl. Toko No. 123, Kota, Provinsi</textarea>
                    </div>
                    <div class="form-group">
                        <label>No. Telepon</label>
                        <input type="tel" class="form-control" name="telepon" value="081234567890" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" value="info@vstock.com" required>
                    </div>
                    <div class="form-group">
                        <label>Website</label>
                        <input type="url" class="form-control" name="website" value="www.vstock.com">
                    </div>
                    <div class="form-group">
                        <label>Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3">Toko elektronik terpercaya dengan berbagai produk berkualitas</textarea>
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

<!-- Modal Restore Database -->
<div class="modal fade" id="modal-restore">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Restore Database</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/profil-toko/restore') ?>" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label>File Backup</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="backup_file" name="backup_file" required>
                            <label class="custom-file-label" for="backup_file">Pilih file backup</label>
                        </div>
                        <small class="form-text text-muted">Format: SQL. Maksimal 10MB</small>
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle"></i> Peringatan: Proses restore akan menimpa semua data yang ada. Pastikan Anda telah membackup data terbaru.
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Restore</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap 4 -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
<!-- bs-custom-file-input -->
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Initialize custom file input
        bsCustomFileInput.init();

        // Show file name in custom file input
        $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
        });
    });

    // Function to backup database
    function backupDatabase() {
        Swal.fire({
            title: 'Memulai Backup',
            text: 'Mohon tunggu sebentar...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        // Simulate backup process
        setTimeout(() => {
            Swal.fire({
                icon: 'success',
                title: 'Backup Berhasil',
                text: 'Database berhasil dibackup',
                showConfirmButton: false,
                timer: 2000
            });
        }, 2000);
    }

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

    // Function to confirm restore
    function confirmRestore() {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Semua data akan ditimpa dengan data backup!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, restore!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                $('#modal-restore form').submit();
            }
        });
    }
</script>
</body>
</html> 