<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Profil Admin<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Profil Saya</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="mb-4">
                            <div class="profile-photo-wrapper" onclick="changeProfilePhoto()" title="Klik untuk ganti foto">
                                <img src="<?= base_url('assets/img/profil.png') ?>" alt="Foto Profil" class="profile-photo rounded-circle">
                                <div class="photo-overlay">
                                <i class="fas fa-camera"></i>
                                </div>
                            </div>
                        </div>
                        <h5><?= ucfirst(session('username') ?? 'Admin') ?></h5>
                        <p class="text-muted">Administrator</p>
                    </div>
                    <div class="col-md-8">
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="form-control" value="<?= ucfirst(session('username') ?? 'Admin') ?>">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Username</label>
                                        <input type="text" class="form-control" value="<?= session('username') ?? 'admin' ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control" value="admin@vstock.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>No. Telepon</label>
                                        <input type="tel" class="form-control" value="081234567890">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Alamat</label>
                                <textarea class="form-control" rows="3">Jl. Contoh No. 123, Kota, Provinsi</textarea>
                            </div>
                            <div class="form-group">
                                <label>Bio</label>
                                <textarea class="form-control" rows="3">Administrator sistem inventori VSTOCK</textarea>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-extended btn-blue">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="<?= base_url('admin/ubah-password') ?>" class="btn btn-extended btn-red">
                                    <i class="fas fa-key"></i> Ubah Password
                                </a>
                                <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-extended btn-gray">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>

    <!-- Hidden file input for photo upload -->
    <input type="file" id="profilePhotoInput" accept="image/*">
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script src="<?= base_url('assets/js/profil_admin.js') ?>"></script>
<?= $this->endSection() ?>
