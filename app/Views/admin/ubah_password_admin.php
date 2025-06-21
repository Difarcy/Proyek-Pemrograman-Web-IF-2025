<?= $this->extend('layout/main') ?>

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
                                <input type="password" class="form-control" placeholder="Masukkan password lama">
                            </div>
                            <div class="form-group">
                                <label>Password Baru</label>
                                <input type="password" class="form-control" placeholder="Masukkan password baru">
                            </div>
                            <div class="form-group">
                                <label>Konfirmasi Password Baru</label>
                                <input type="password" class="form-control" placeholder="Konfirmasi password baru">
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
<script>
    // Add password-layout class to content wrapper
    document.addEventListener('DOMContentLoaded', function() {
        const contentWrapper = document.getElementById('contentWrapper');
        if (contentWrapper) {
            contentWrapper.classList.add('password-layout');
        }
    });
</script>
<?= $this->endSection() ?>
