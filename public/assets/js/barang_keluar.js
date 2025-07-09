// File: barang_keluar.js
// Fungsi: File ini digunakan untuk menangani interaksi dan logika pada halaman Barang Keluar.
// Biasanya berisi script untuk menambah, mengedit, menghapus, menampilkan detail, dan ekspor data barang keluar.
// Tambahkan kode JavaScript Anda di bawah ini.

// =============================
// PENCARIAN DINAMIS BARANG KELUAR
// =============================

function renderBarangKeluarTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!data || data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="9" class="empty-table-message">Tidak ada data barang keluar.</td></tr>';
    return;
  }
  data.forEach((item, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${item.no_surat_jalan}</td>
        <td>${item.tanggal_keluar}</td>
        <td>${item.customer}</td>
        <td>${item.nama_barang}</td>
        <td>${item.jumlah}</td>
        <td>${item.satuan}</td>
        <td>${item.petugas}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editBarangKeluar(${item.id})">Edit</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteBarangKeluar(${item.id}, '${item.nama_barang}')">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

function fetchAndRender() {
  const searchInput = document.querySelector('input[name="search"]');
  const tanggalAwal = document.querySelector('input[name="tanggal_awal"]');
  const tanggalAkhir = document.querySelector('input[name="tanggal_akhir"]');
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}barang-keluar/search?search=${encodeURIComponent(searchInput ? searchInput.value : '')}&tanggal_awal=${encodeURIComponent(tanggalAwal ? tanggalAwal.value : '')}&tanggal_akhir=${encodeURIComponent(tanggalAkhir ? tanggalAkhir.value : '')}`)
    .then(res => res.json())
    .then(data => renderBarangKeluarTable(data));
}

document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.querySelector('input[name="search"]');
  const tanggalAwal = document.querySelector('input[name="tanggal_awal"]');
  const tanggalAkhir = document.querySelector('input[name="tanggal_akhir"]');
  
  // Hanya gunakan AJAX untuk search dan filter
  if (searchInput) searchInput.addEventListener('input', fetchAndRender);
  if (tanggalAwal) tanggalAwal.addEventListener('change', fetchAndRender);
  if (tanggalAkhir) tanggalAkhir.addEventListener('change', fetchAndRender);
  
  // Entries dropdown akan ditangani oleh main.js dengan form submission normal
});

/**
 * Fungsi export data barang keluar (Excel, PDF, CSV)
 * Akan redirect ke endpoint export dengan format dan filter aktif
 */
function exportData(format) {
  const search = document.querySelector('input[name="search"]')?.value || '';
  const tanggalAwal = document.querySelector('input[name="tanggal_awal"]')?.value || '';
  const tanggalAkhir = document.querySelector('input[name="tanggal_akhir"]')?.value || '';
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  let url = `/${prefix}barang-keluar/export?format=${format}`;
  if (search) url += `&search=${encodeURIComponent(search)}`;
  if (tanggalAwal) url += `&tanggal_awal=${encodeURIComponent(tanggalAwal)}`;
  if (tanggalAkhir) url += `&tanggal_akhir=${encodeURIComponent(tanggalAkhir)}`;
  window.location.href = url;
}

let dataAwalEdit = {};

function editBarangKeluar(id) {
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}barang-keluar/get/${id}`)
    .then(res => res.json())
    .then(data => {
      if (data && data.success) {
        dataAwalEdit = data.data;
        document.getElementById('edit_id').value = data.data.id;
        document.getElementById('edit_no_surat_jalan').value = data.data.no_surat_jalan;
        document.getElementById('edit_tanggal_keluar').value = data.data.tanggal_keluar;
        document.getElementById('edit_customer').value = data.data.customer;
        document.getElementById('edit_nama_barang').value = data.data.nama_barang;
        document.getElementById('edit_jumlah').value = data.data.jumlah;
        document.getElementById('edit_satuan').value = data.data.satuan;
        document.getElementById('edit_petugas').value = data.data.petugas;
        openModal('editBarangKeluar');
      }
    });
}

function confirmDeleteBarangKeluar(id, nama) {
  if (confirm('Yakin ingin menghapus barang keluar: ' + nama + '?')) {
    const currentPath = window.location.pathname;
    const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
    fetch(`/${prefix}barang-keluar/delete/${id}`, { 
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Barang keluar berhasil dihapus.');
          fetchAndRender();
        } else {
          alert('Maaf, barang keluar gagal dihapus. Silakan coba lagi.');
        }
      });
  }
}

function openTambahBarangKeluarModal() {
  var form = document.getElementById('formTambahBarangKeluar');
  if (form) form.reset();
  openModal('tambahBarangKeluar');
}

function handleTambahBarangKeluarSubmit() {
  var form = document.getElementById('formTambahBarangKeluar');
  if (!form) return;
  var formData = new FormData(form);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}barang-keluar/store`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Barang keluar berhasil ditambahkan.');
        closeModal('tambahBarangKeluar');
        location.reload();
      } else {
        alert('Maaf, barang keluar gagal ditambahkan. Silakan coba lagi.');
      }
    });
}

function handleEditBarangKeluarSubmit() {
  var form = document.getElementById('formEditBarangKeluar');
  if (!form) return;
  var id = document.getElementById('edit_id').value;
  var formData = new FormData();
  if (form['no_surat_jalan'].value !== dataAwalEdit.no_surat_jalan) formData.append('no_surat_jalan', form['no_surat_jalan'].value);
  if (form['tanggal_keluar'].value !== dataAwalEdit.tanggal_keluar) formData.append('tanggal_keluar', form['tanggal_keluar'].value);
  if (form['customer'].value !== dataAwalEdit.customer) formData.append('customer', form['customer'].value);
  if (form['nama_barang'].value !== dataAwalEdit.nama_barang) formData.append('nama_barang', form['nama_barang'].value);
  if (form['jumlah'].value !== String(dataAwalEdit.jumlah)) formData.append('jumlah', form['jumlah'].value);
  if (form['satuan'].value !== dataAwalEdit.satuan) formData.append('satuan', form['satuan'].value);
  if (form['petugas'].value !== dataAwalEdit.petugas) formData.append('petugas', form['petugas'].value);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}barang-keluar/update/${id}`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Barang keluar berhasil diperbarui.');
        closeModal('editBarangKeluar');
        location.reload();
      } else {
        alert('Maaf, barang keluar gagal diperbarui. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
}
