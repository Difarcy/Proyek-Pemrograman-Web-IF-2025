<?= $this->extend('layouts/main') ?>

<?= $this->section('title') ?>Ubah Password<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-white border-0">
                <h5 class="mb-0">Ubah Password</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <div class="mb-4">
                            <div class="profile-photo-wrapper profile-photo-readonly" title="Foto Profil">
                                <img src="<?= base_url('assets/img/profil.png') ?>" alt="Foto Profil" class="profile-photo rounded-circle">
                                <div class="photo-overlay">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                        </div>
                        <h5><?= ucfirst(session('username') ?? 'Admin') ?></h5>
                        <p class="text-muted">Administrator</p>
                    </div>
                    <div class="col-md-8">
                        <form>
                            <div class="form-group">
                                <label>Password Lama</label>
                                <div class="password-field-wrapper">
                                    <input type="password" class="form-control" id="oldPassword" placeholder="Masukkan password lama">
                                    <button type="button" class="password-toggle" data-toggle="oldPassword" onclick="togglePasswordVisibility('oldPassword')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <div class="password-field-wrapper">
                                    <input type="password" class="form-control" id="newPassword" placeholder="Masukkan password baru">
                                    <button type="button" class="password-toggle" data-toggle="newPassword" onclick="togglePasswordVisibility('newPassword')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div id="passwordStrength" class="password-strength"></div>
                                <div id="passwordStrengthMeter" class="password-strength-meter">
                                    <div class="meter-fill"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password Baru</label>
                                <div class="password-field-wrapper">
                                    <input type="password" class="form-control" id="confirmPassword" placeholder="Konfirmasi password baru">
                                    <button type="button" class="password-toggle" data-toggle="confirmPassword" onclick="togglePasswordVisibility('confirmPassword')">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-extended btn-blue">
                                    <i class="fas fa-save"></i> Ubah Password
                                </button>
                                <a href="<?= base_url('admin/profil') ?>" class="btn btn-extended btn-gray">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
    <script src="<?= base_url('assets/js/ubah_password_admin.js') ?>"></script>
<?= $this->endSection() ?>
