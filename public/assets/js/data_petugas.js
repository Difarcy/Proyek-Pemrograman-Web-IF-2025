// File: data_petugas.js
// Fungsi: File ini digunakan untuk menangani interaksi dan logika pada halaman Data Petugas.
// Biasanya berisi script untuk menambah, mengedit, menghapus, menampilkan detail, dan ekspor data petugas.
// Tambahkan kode JavaScript Anda di bawah ini.

// =============================
// PENCARIAN DINAMIS DATA PETUGAS
// =============================

function renderPetugasTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!data || data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="8" class="empty-table-message">Tidak ada data petugas.</td></tr>';
    return;
  }
  data.forEach((item, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${item.kode_petugas}</td>
        <td>${item.nama_petugas}</td>
        <td>${item.jabatan}</td>
        <td>${item.telepon}</td>
        <td>${item.alamat}</td>
        <td>${item.kota}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editPetugas(${item.id})">Edit</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeletePetugas(${item.id}, '${item.nama_petugas}')">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

/**
 * Fungsi export data petugas (Excel, PDF, CSV)
 * Akan redirect ke endpoint export dengan format dan filter aktif
 */
function exportData(format) {
  const search = document.querySelector('input[name="search"]')?.value || '';
  const jabatan = document.querySelector('select[name="jabatan"]')?.value || '';
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  let url = `/${prefix}data-petugas/export?format=${format}`;
  if (search) url += `&search=${encodeURIComponent(search)}`;
  if (jabatan) url += `&jabatan=${encodeURIComponent(jabatan)}`;
  window.location.href = url;
}

let dataAwalEdit = {};

function editPetugas(id) {
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-petugas/get/${id}`)
    .then(res => res.json())
    .then(data => {
      if (data && data.success) {
        dataAwalEdit = data.data;
        document.getElementById('edit_petugas_id').value = data.data.id;
        document.getElementById('edit_kode_petugas').value = data.data.kode_petugas;
        document.getElementById('edit_nama_petugas').value = data.data.nama_petugas;
        document.getElementById('edit_jabatan').value = data.data.jabatan;
        document.getElementById('edit_telepon').value = data.data.telepon;
        document.getElementById('edit_alamat').value = data.data.alamat;
        document.getElementById('edit_kota').value = data.data.kota;
        openModal('editPetugas');
      }
    });
}

function fetchAndRender() {
  const searchInput = document.querySelector('input[name="search"]');
  const jabatanDropdown = document.querySelector('select[name="jabatan"]');
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-petugas/search?search=${encodeURIComponent(searchInput ? searchInput.value : '')}&jabatan=${encodeURIComponent(jabatanDropdown ? jabatanDropdown.value : '')}`)
    .then(res => res.json())
    .then(data => renderPetugasTable(data));
}

function confirmDeletePetugas(id, nama) {
  if (confirm('Yakin ingin menghapus petugas: ' + nama + '?')) {
    const currentPath = window.location.pathname;
    const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
    fetch(`/${prefix}data-petugas/delete/${id}`, { 
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Petugas berhasil dihapus.');
          fetchAndRender();
        } else {
          alert('Maaf, petugas gagal dihapus. Silakan coba lagi.');
        }
      });
  }
}

function openTambahPetugasModal() {
  var form = document.getElementById('formTambahPetugas');
  if (form) form.reset();
  openModal('tambahPetugas');
}

function handleEditPetugasSubmit() {
  var form = document.getElementById('formEditPetugas');
  if (!form) return;
  var id = document.getElementById('edit_petugas_id').value;
  var formData = new FormData();
  if (form['kode_petugas'].value !== dataAwalEdit.kode_petugas) formData.append('kode_petugas', form['kode_petugas'].value);
  if (form['nama_petugas'].value !== dataAwalEdit.nama_petugas) formData.append('nama_petugas', form['nama_petugas'].value);
  if (form['jabatan'].value !== dataAwalEdit.jabatan) formData.append('jabatan', form['jabatan'].value);
  if (form['telepon'].value !== dataAwalEdit.telepon) formData.append('telepon', form['telepon'].value);
  if (form['alamat'].value !== dataAwalEdit.alamat) formData.append('alamat', form['alamat'].value);
  if (form['kota'].value !== dataAwalEdit.kota) formData.append('kota', form['kota'].value);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-petugas/update/${id}`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Petugas berhasil diperbarui.');
        closeModal('editPetugas');
        fetchAndRender();
      } else {
        alert('Maaf, petugas gagal diperbarui. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
}

function handleAddPetugasSubmit() {
  var form = document.getElementById('formTambahPetugas');
  if (!form) return;
  var formData = new FormData(form);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-petugas/store`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Petugas berhasil ditambahkan.');
        closeModal('tambahPetugas');
        fetchAndRender();
      } else {
        alert('Maaf, petugas gagal ditambahkan. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
}

document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.querySelector('input[name="search"]');
  const jabatanDropdown = document.querySelector('select[name="jabatan"]');
  
  // Hanya gunakan AJAX untuk search dan filter
  if (searchInput) searchInput.addEventListener('input', fetchAndRender);
  if (jabatanDropdown) jabatanDropdown.addEventListener('change', fetchAndRender);
  
  // Entries dropdown akan ditangani oleh main.js dengan form submission normal
});
