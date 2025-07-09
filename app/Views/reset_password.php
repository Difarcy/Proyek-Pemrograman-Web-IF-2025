<?= $this->extend($role === 'admin' ? 'layouts/admin' : 'layouts/user') ?>
<?= $this->section('title') ?>Reset Password<?= $this->endSection() ?>
<?= $this->section('content') ?>

<script>
  var resetPasswordActionUrl = "<?= $role === 'admin' ? '/admin/reset-password-action' : '/user/reset-password-action' ?>";
</script>

<h2 class="main-page-title">Reset Password</h2>

<div class="main-container">
  <div class="main-card">
    <div class="main-content">
      <div class="reset-password-layout">
        <!-- Left side - Image -->
        <div class="reset-password-image-section">
          <img src="<?= ($user && $user['foto']) ? base_url('uploads/profil/' . $user['foto']) : base_url('assets/img/ui/blank_profil.png') ?>" alt="Reset Password" class="reset-password-image">
        </div>
        <!-- Right side - Form -->
        <div class="reset-password-form-section">
          <div class="reset-password-header">Reset Password</div>
          <form id="resetPasswordForm" autocomplete="off">
            <div class="reset-password-group">
              <label for="password_lama">Password Lama :</label>
              <input type="password" id="password_lama" name="password_lama" required>
            </div>
            <div class="reset-password-group">
              <label for="password_baru">Password Baru :</label>
              <input type="password" id="password_baru" name="password_baru" required>
            </div>
            <div class="reset-password-group">
              <label for="konfirmasi_password">Konfirmasi Password Baru :</label>
              <input type="password" id="konfirmasi_password" name="konfirmasi_password" required>
            </div>
            <div class="reset-password-show-password">
              <label class="show-password-checkbox">
                <input type="checkbox" id="showPassword">
                <span class="checkmark"></span>
                Tampilkan Password
              </label>
            </div>
            <div class="reset-password-actions">
              <button type="submit" id="btnSimpan" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
              <button type="button" id="btnClear" class="btn btn-batal"><i class="fas fa-eraser"></i> Clear</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?> 