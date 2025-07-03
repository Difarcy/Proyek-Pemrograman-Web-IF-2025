<?= $this->extend('layouts/admin') ?>

<?= $this->section('title') ?>Profil Admin<?= $this->endSection() ?>

<?= $this->section('content') ?>
    <div class="v-container-fluid">
        <div class="v-card">
            <div class="v-card-header v-bg-white v-border-0">
                <h5 class="v-mb-0">Profil Saya</h5>
            </div>
            <div class="v-card-body">
                <div class="v-row">
                    <div class="v-col-md-4 v-text-center">
                        <div class="v-mb-4">
                            <div class="v-profile-photo-wrapper" onclick="changeProfilePhoto()" title="Klik untuk ganti foto">
                                <img src="<?= base_url('assets/img/profil.png') ?>" alt="Foto Profil" class="v-profile-photo v-rounded-circle">
                                <div class="v-photo-overlay">
                                    <i class="fas fa-camera"></i>
                                </div>
                            </div>
                        </div>
                        <h5><?= ucfirst(session('username') ?? 'Admin') ?></h5>
                        <p class="v-text-muted">Administrator</p>
                    </div>
                    <div class="v-col-md-8">
                        <form>
                            <div class="v-row">
                                <div class="v-col-md-6">
                                    <div class="v-form-group">
                                        <label>Nama Lengkap</label>
                                        <input type="text" class="v-form-control" value="<?= ucfirst(session('username') ?? 'Admin') ?>">
                                    </div>
                                </div>
                                <div class="v-col-md-6">
                                    <div class="v-form-group">
                                        <label>Username</label>
                                        <input type="text" class="v-form-control" value="<?= session('username') ?? 'admin' ?>" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="v-row">
                                <div class="v-col-md-6">
                                    <div class="v-form-group">
                                        <label>Email</label>
                                        <input type="email" class="v-form-control" value="admin@vstock.com">
                                    </div>
                                </div>
                                <div class="v-col-md-6">
                                    <div class="v-form-group">
                                        <label>No. Telepon</label>
                                        <input type="tel" class="v-form-control" value="081234567890">
                                    </div>
                                </div>
                            </div>
                            <div class="v-form-group">
                                <label>Alamat</label>
                                <textarea class="v-form-control" rows="3">Jl. Contoh No. 123, Kota, Provinsi</textarea>
                            </div>
                            <div class="v-form-group">
                                <label>Bio</label>
                                <textarea class="v-form-control" rows="3">Administrator sistem inventori VSTOCK</textarea>
                            </div>
                            <div class="v-form-group">
                                <button type="submit" class="v-btn v-btn-extended v-btn-blue">
                                    <i class="fas fa-save"></i> Simpan Perubahan
                                </button>
                                <a href="<?= base_url('admin/ubah-password') ?>" class="v-btn v-btn-extended v-btn-red">
                                    <i class="fas fa-key"></i> Ubah Password
                                </a>
                                <a href="<?= base_url('admin/dashboard') ?>" class="v-btn v-btn-extended v-btn-gray">
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
