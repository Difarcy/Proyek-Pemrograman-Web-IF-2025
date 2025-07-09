<?= $this->extend($role === 'admin' ? 'layouts/admin' : 'layouts/user') ?>
<?= $this->section('title') ?>Profil<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Profil</h2>

<div class="main-container">
  <div class="main-card">
    <div class="main-content">
      <div class="profil-layout">
        <!-- Left side - Image -->
        <div class="profil-layout-image-section">
          <div class="profil-image-container">
            <img src="<?= ($user && $user['foto']) ? base_url('uploads/profil/' . $user['foto']) : base_url('assets/img/ui/blank_profil.png') ?>" 
                 alt="Profil Pengguna" 
                 class="profil-layout-image" 
                 id="profilImage">
            <div class="profil-image-overlay" id="cameraIcon">
              <i class="fas fa-camera profil-edit-icon"></i>
            </div>
            <input type="file" id="fotoInput" accept="image/*" style="display: none;">
          </div>
        </div>
        <!-- Right side - Form -->
        <div class="profil-layout-form-section">
          <div class="profil-layout-header">Informasi Profil Pengguna</div>
          <form id="profilForm" autocomplete="off">
            <div class="profil-layout-group">
              <label for="username">Username :</label>
              <input type="text" id="username" name="username" value="<?= $user ? esc($user['username']) : ($role === 'admin' ? 'admin' : 'user') ?>" readonly <?= $role === 'user' ? 'required' : 'class="admin-readonly"' ?>>
            </div>
            <div class="profil-layout-group">
              <label for="nama_lengkap">Nama Lengkap :</label>
              <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?= $user ? esc($user['nama']) : ($role === 'admin' ? 'Administrator' : 'User') ?>" readonly <?= $role === 'user' ? 'required' : '' ?>>
            </div>
            <div class="profil-layout-group">
              <label for="no_telepon">No Telepon :</label>
              <input type="text" id="no_telepon" name="no_telepon" value="<?= $user ? esc($user['no_telepon']) : ($role === 'admin' ? '08383838323' : '08123456789') ?>" readonly <?= $role === 'user' ? 'required' : '' ?>>
            </div>
            <div class="profil-layout-group">
              <label for="alamat">Alamat</label>
              <textarea id="alamat" name="alamat" rows="2" readonly <?= $role === 'user' ? 'required' : '' ?>><?= $user ? esc($user['alamat']) : ($role === 'admin' ? 'pangalengan' : 'Bandung') ?></textarea>
            </div>
            <div class="profil-layout-actions">
              <button type="button" id="btnSimpan" class="btn btn-primary" hidden><i class="fas fa-save"></i> Simpan</button>
              <button type="button" id="btnUbah" class="btn btn-success"><i class="fas fa-edit"></i> Ubah</button>
              <button type="button" id="btnBatal" class="btn btn-batal" hidden><i class="fas fa-times"></i> Batal</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?> 