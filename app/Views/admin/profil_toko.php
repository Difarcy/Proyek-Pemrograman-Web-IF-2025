<?= $this->extend('layouts/admin') ?>
<?= $this->section('title') ?>Profil Toko<?= $this->endSection() ?>
<?= $this->section('content') ?>

<h2 class="main-page-title">Profil Toko</h2>

<div class="main-container">
  <div class="main-card">
    <div class="main-content">
      <div class="profil-toko-layout">
        <!-- Left side - Image -->
        <div class="profil-toko-image-section">
          <div class="profil-image-container">
            <img src="<?= base_url(($profil_toko && $profil_toko['foto'] && $profil_toko['foto'] !== 'blank_profil_toko.png') ? 'uploads/profil/' . $profil_toko['foto'] : 'assets/img/ui/blank_profil_toko.png') ?>" alt="Profil Toko" class="profil-layout-image" id="profilTokoImage">
            <div class="profil-image-overlay" id="cameraIcon">
              <i class="fas fa-camera"></i>
            </div>
            <input type="file" id="fotoTokoInput" accept="image/*" style="display: none;">
          </div>
        </div>
        
        <!-- Right side - Form -->
        <div class="profil-toko-form-section">
          <div class="profil-toko-header">Informasi Profil Toko</div>
          <form id="profilTokoForm" autocomplete="off">
            <div class="profil-toko-group">
              <label for="nama_toko">Nama Toko :</label>
              <input type="text" id="nama_toko" name="nama_toko" value="<?= $profil_toko ? esc($profil_toko['nama_toko']) : 'Toko Bangunan Putra Jaya Perkasa II' ?>" readonly>
            </div>
            <div class="profil-toko-group">
              <label for="nama_pemilik">Nama Pemilik :</label>
              <input type="text" id="nama_pemilik" name="nama_pemilik" value="<?= $profil_toko ? esc($profil_toko['nama_pemilik']) : 'Muhammad Inggyran' ?>" readonly>
            </div>
            <div class="profil-toko-group">
              <label for="no_telepon">No Telepon :</label>
              <input type="text" id="no_telepon" name="no_telepon" value="<?= $profil_toko ? esc($profil_toko['no_telepon']) : '08383838323' ?>" readonly>
            </div>
            <div class="profil-toko-group">
              <label for="alamat">Alamat</label>
              <textarea id="alamat" name="alamat" rows="2" readonly><?= $profil_toko ? esc($profil_toko['alamat']) : 'pangalengan' ?></textarea>
            </div>
            <div class="profil-toko-actions">
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