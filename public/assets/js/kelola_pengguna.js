// File: kelola_pengguna.js
// Fungsi: File ini digunakan untuk menangani interaksi dan logika pada halaman Kelola Pengguna (admin).
// Biasanya berisi script untuk menambah, mengedit, menghapus, mengubah status, dan ekspor data pengguna.
// Tambahkan kode JavaScript Anda di bawah ini.

// =============================
// PENCARIAN DINAMIS KELOLA PENGGUNA
// =============================

function renderUserTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!data || data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7" class="empty-table-message">Tidak ada data pengguna.</td></tr>';
    return;
  }
  data.forEach((item, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${item.username}</td>
        <td>${item.nama}</td>
        <td><span class="status-${item.status === 'active' ? 'active' : 'inactive'}"><strong>${item.status === 'active' ? 'Aktif' : 'Tidak Aktif'}</strong></span></td>
        <td>${item.last_login ? item.last_login : '-'}</td>
        <td>${item.created_at ? item.created_at : '-'}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editUser(${item.id})">Edit</a>
            <a href="#" class="action-btn action-btn-${item.status === 'active' ? 'danger' : 'success'}" onclick="toggleUserStatus(${item.id})">${item.status === 'active' ? 'Nonaktif' : 'Aktif'}</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteUser(${item.id}, '${item.username}')">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

function fetchAndRender() {
  const searchInput = document.querySelector('input[name="search"]');
  const statusSelect = document.querySelector('select[name="status"]');
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? '' : (currentPath.includes('/user/') ? 'user/' : 'admin/');
  const searchVal = encodeURIComponent(searchInput ? searchInput.value : '');
  const statusVal = encodeURIComponent(statusSelect ? statusSelect.value : '');
  let url = `${prefix}kelola-pengguna/search?search=${searchVal}`;
  if (statusVal) url += `&status=${statusVal}`;
  fetch(url)
    .then(res => res.json())
    .then(data => renderUserTable(data));
}

document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.querySelector('input[name="search"]');
  const statusSelect = document.querySelector('select[name="status"]');
  
  // Hanya gunakan AJAX untuk search dan filter
  if (searchInput) searchInput.addEventListener('input', fetchAndRender);
  if (statusSelect) statusSelect.addEventListener('change', fetchAndRender);
  
  // Entries dropdown akan ditangani oleh main.js dengan form submission normal

  // Handle submit form tambah pengguna
  var formTambah = document.getElementById('formPengguna');
  if (formTambah) {
    formTambah.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Validasi password minimal 6 karakter
      var password = document.getElementById('password').value;
      if (password.length < 6) {
        alert('Password minimal 6 karakter.');
        return;
      }
      
      var formData = new FormData(formTambah);
      fetch('kelola-pengguna/store', {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('Pengguna berhasil ditambahkan.');
            closeModal('tambahPengguna');
            formTambah.reset();
            fetchAndRender();
          } else {
            alert(data.message || 'Maaf, pengguna gagal ditambahkan. Silakan coba lagi.');
          }
        })
        .catch(() => {
          alert('Terjadi kesalahan saat menghubungi server');
        });
    });
  }

  // Handle submit form edit pengguna
  var formEdit = document.getElementById('formEditPengguna');
  if (formEdit) {
    formEdit.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Validasi password minimal 6 karakter jika diisi
      var password = document.getElementById('edit_password').value;
      if (password && password.length < 6) {
        alert('Password minimal 6 karakter.');
        return;
      }
      
      var id = document.getElementById('edit_user_id').value;
      var formData = new FormData(formEdit);
      fetch('kelola-pengguna/update/' + id, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
      })
        .then(res => res.json())
        .then(data => {
          if (data.success) {
            alert('Data pengguna berhasil diperbarui.');
            closeModal('editPengguna');
            fetchAndRender();
          } else {
            alert(data.message || 'Maaf, data pengguna gagal diperbarui. Silakan coba lagi.');
          }
        })
        .catch(() => {
          alert('Terjadi kesalahan saat menghubungi server');
        });
    });
  }

  // Tampilkan icon mata hanya jika ada isi di password (tambah)
  var passwordInput = document.getElementById('password');
  if (passwordInput) {
    passwordInput.addEventListener('input', function() {
      var container = passwordInput.closest('.password-input-container');
      if (container) {
        if (passwordInput.value.length > 0) {
          container.classList.add('has-text');
        } else {
          container.classList.remove('has-text');
        }
      }
    });
    // Trigger sekali saat load (jika autofill)
    passwordInput.dispatchEvent(new Event('input'));
  }

  // Tampilkan icon mata hanya jika ada isi di password (edit)
  var editPasswordInput = document.getElementById('edit_password');
  if (editPasswordInput) {
    editPasswordInput.addEventListener('input', function() {
      var container = editPasswordInput.closest('.password-input-container');
      if (container) {
        if (editPasswordInput.value.length > 0) {
          container.classList.add('has-text');
        } else {
          container.classList.remove('has-text');
        }
      }
    });
    // Trigger sekali saat load (jika autofill)
    editPasswordInput.dispatchEvent(new Event('input'));
  }
});

/**
 * Fungsi export data pengguna (Excel, PDF, CSV)
 * Akan redirect ke endpoint export dengan format dan filter aktif
 */
function exportData(format) {
  const search = document.querySelector('input[name="search"]')?.value || '';
  const status = document.querySelector('select[name="status"]')?.value || '';
  let url = `kelola-pengguna/export?format=${format}`;
  if (search) url += `&search=${encodeURIComponent(search)}`;
  if (status) url += `&status=${encodeURIComponent(status)}`;
  window.location.href = url;
}

function editUser(id) {
  fetch('kelola-pengguna/get/' + id)
    .then(res => res.json())
    .then(data => {
      if (data && data.success) {
        document.getElementById('edit_user_id').value = data.data.id;
        document.getElementById('edit_username').value = data.data.username;
        document.getElementById('edit_nama').value = data.data.nama;
        document.getElementById('edit_password').value = '';
        openModal('editPengguna');
      }
    });
}

function confirmDeleteUser(id, nama) {
  if (confirm('Yakin ingin menghapus user: ' + nama + '?')) {
    const currentPath = window.location.pathname;
    const prefix = currentPath.includes('/admin/') ? '' : (currentPath.includes('/user/') ? 'user/' : 'admin/');
    fetch(prefix + 'kelola-pengguna/delete/' + id, { 
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('User berhasil dihapus.');
          fetchAndRender();
        } else {
          alert('Maaf, user gagal dihapus. Silakan coba lagi.');
        }
      });
  }
}

function toggleUserStatus(id) {
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? '' : (currentPath.includes('/user/') ? 'user/' : 'admin/');
  fetch(prefix + 'kelola-pengguna/toggle-status/' + id, {
    method: 'POST',
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Status pengguna berhasil diubah.');
        fetchAndRender();
      } else {
        alert('Maaf, status pengguna gagal diubah. Silakan coba lagi.');
      }
    });
}

function openTambahPenggunaModal() {
  var form = document.getElementById('formPengguna');
  if (form) form.reset();
  openModal('tambahPengguna');
}

function togglePasswordVisibility(inputId) {
  var input = document.getElementById(inputId);
  var eyeIcon = document.getElementById(inputId + '-eye-icon');
  // Cari tombol password-toggle yang merupakan parent dari icon
  var toggleBtn = eyeIcon ? eyeIcon.parentElement : null;
  if (input.type === 'password') {
    input.type = 'text';
    if (toggleBtn) toggleBtn.classList.add('showing');
  } else {
    input.type = 'password';
    if (toggleBtn) toggleBtn.classList.remove('showing');
  }
}
