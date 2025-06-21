<?= $this->extend('layout/main') ?>

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
    <input type="file" id="profilePhotoInput" accept="image/*" style="display: none;">
<?= $this->endSection() ?>

<?= $this->section('scripts') ?>
<script>
    // Add profile-layout class to content wrapper
    document.addEventListener('DOMContentLoaded', function() {
    const contentWrapper = document.getElementById('contentWrapper');
        if (contentWrapper) {
            contentWrapper.classList.add('profile-layout');
        }
    });
    
    // Function to handle profile photo change
    function changeProfilePhoto() {
        document.getElementById('profilePhotoInput').click();
    }
    
    // Handle file selection
    document.getElementById('profilePhotoInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            // Here you can add logic to upload the file to server
            // For now, we'll just show a preview
            const reader = new FileReader();
            reader.onload = function(e) {
                document.querySelector('.profile-photo').src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>
<?= $this->endSection() ?>
