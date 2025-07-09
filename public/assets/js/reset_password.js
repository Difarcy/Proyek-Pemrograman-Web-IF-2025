// File: reset_password.js
// Fungsi: File ini digunakan untuk menangani interaksi dan logika pada halaman Reset Password.
// Biasanya berisi script untuk validasi password lama, password baru, konfirmasi password, dan show/hide password.
// Tambahkan kode JavaScript Anda di bawah ini.
document.addEventListener('DOMContentLoaded', function() {
  // Tombol Clear
  var btnClear = document.getElementById('btnClear');
  var form = document.getElementById('resetPasswordForm');
  if (btnClear && form) {
    btnClear.addEventListener('click', function() {
      form.reset();
      // Pastikan input type kembali ke password jika sebelumnya show
      document.getElementById('password_lama').type = 'password';
      document.getElementById('password_baru').type = 'password';
      document.getElementById('konfirmasi_password').type = 'password';
      document.getElementById('showPassword').checked = false;
    });
  }

  // Checkbox Tampilkan Password
  var showPassword = document.getElementById('showPassword');
  if (showPassword) {
    showPassword.addEventListener('change', function() {
      var type = this.checked ? 'text' : 'password';
      document.getElementById('password_lama').type = type;
      document.getElementById('password_baru').type = type;
      document.getElementById('konfirmasi_password').type = type;
    });
  }

  // Submit form reset password via AJAX
  var form = document.getElementById('resetPasswordForm');
  if (form) {
    form.addEventListener('submit', function(e) {
      e.preventDefault();
      var passwordBaru = document.getElementById('password_baru').value;
      var konfirmasiPassword = document.getElementById('konfirmasi_password').value;
      if (passwordBaru !== konfirmasiPassword) {
        alert('Password baru dan konfirmasi password tidak sama!');
        return;
      }
      if (passwordBaru.length < 6) {
        alert('Password baru minimal 6 karakter.');
        return;
      }
      var formData = new FormData(form);
      fetch(resetPasswordActionUrl, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert(data.message);
            if (data.logout) {
              // Redirect ke halaman login setelah logout
              setTimeout(function() {
                window.location.href = '/login';
              }, 1500);
            } else {
              // Reset form jika tidak logout
              form.reset();
              document.getElementById('password_lama').type = 'password';
              document.getElementById('password_baru').type = 'password';
              document.getElementById('konfirmasi_password').type = 'password';
              document.getElementById('showPassword').checked = false;
            }
          } else {
            alert(data.message || (data.errors ? Object.values(data.errors).join('\n') : 'Gagal mengubah password'));
          }
        })
        .catch(() => {
          alert('Terjadi kesalahan saat menghubungi server');
        });
    });
  }
});
