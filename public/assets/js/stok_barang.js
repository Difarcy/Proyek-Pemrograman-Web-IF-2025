// File: stok_barang.js
// Fungsi: File ini digunakan untuk menangani interaksi dan logika pada halaman Stok Barang.
// Biasanya berisi script untuk menambah, mengedit, menghapus, menampilkan detail, dan ekspor data stok barang.
// Tambahkan kode JavaScript Anda di bawah ini.

// =============================
// FUNGSI GLOBAL
// =============================

let barangDataAwal = {};

// Fungsi handle form submit untuk tambah/edit barang
window.handleFormSubmit = function() {
  const id = document.getElementById('barang_id').value;
  const kode_barang = document.getElementById('kode_barang').value;
  const nama_barang = document.getElementById('nama_barang').value;
  const kategori_barang = document.getElementById('kategori_barang').value;
  const stok = document.getElementById('stok').value;
  const satuan = document.getElementById('satuan').value;
  const formData = new FormData();

  if (id) {
    formData.append('id', id);
    if (kode_barang !== barangDataAwal.kode_barang) formData.append('kode_barang', kode_barang);
    if (nama_barang !== barangDataAwal.nama_barang) formData.append('nama_barang', nama_barang);
    if (kategori_barang !== barangDataAwal.kategori_barang) formData.append('kategori_barang', kategori_barang);
    if (stok !== String(barangDataAwal.stok)) formData.append('stok', stok);
    if (satuan !== barangDataAwal.satuan) formData.append('satuan', satuan);
  } else {
    formData.append('kode_barang', kode_barang);
    formData.append('nama_barang', nama_barang);
    formData.append('kategori_barang', kategori_barang);
    formData.append('stok', stok);
    formData.append('satuan', satuan);
  }

  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  let url = '/' + prefix + 'stok-barang/store';
  if (id) {
    url = '/' + prefix + 'stok-barang/update/' + id;
  }
  fetch(url, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Data barang berhasil disimpan.');
        closeModal('tambahBarang');
        fetchAndRender();
      } else {
        alert('Maaf, data barang gagal disimpan. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
};

// =============================
// PENCARIAN DINAMIS STOK BARANG
// =============================

function renderStokBarangTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  if (!Array.isArray(data)) {
    tbody.innerHTML = '<tr><td colspan="7" class="empty-table-message">Terjadi kesalahan saat memuat data.</td></tr>';
    return;
  }
  tbody.innerHTML = '';
  if (data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7" class="empty-table-message">Tidak ada data barang.</td></tr>';
    return;
  }
  data.forEach((barang, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${barang.kode_barang}</td>
        <td>${barang.nama_barang}</td>
        <td>${barang.kategori_barang}</td>
        <td>${barang.stok}</td>
        <td>${barang.satuan}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editStokBarang(${barang.id})">Edit</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteStokBarang(${barang.id}, '${barang.nama_barang}')">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

/**
 * Fungsi export data stok barang (Excel, PDF, CSV)
 * Akan redirect ke endpoint export dengan format dan filter aktif
 */
function exportData(format) {
  const search = document.querySelector('input[name="search"]')?.value || '';
  const kategori = document.querySelector('select[name="kategori"]')?.value || '';
  let url = `stok-barang/export?format=${format}`;
  if (search) url += `&search=${encodeURIComponent(search)}`;
  if (kategori) url += `&kategori=${encodeURIComponent(kategori)}`;
  window.location.href = url;
}

function editStokBarang(id) {
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch('/' + prefix + 'stok-barang/get/' + id)
    .then(res => res.json())
    .then(data => {
      if (data && data.success) {
        barangDataAwal = data.data; // simpan data awal
        document.getElementById('barang_id').value = data.data.id;
        document.getElementById('kode_barang').value = data.data.kode_barang;
        document.getElementById('nama_barang').value = data.data.nama_barang;
        document.getElementById('kategori_barang').value = data.data.kategori_barang;
        document.getElementById('stok').value = data.data.stok;
        document.getElementById('satuan').value = data.data.satuan;
        document.getElementById('modalTitle').textContent = 'Edit Barang';
        openModal('tambahBarang');
      }
    });
}

function openTambahBarangModal() {
  var form = document.getElementById('formBarang');
  if (form) form.reset();
  document.getElementById('barang_id').value = '';
  document.getElementById('modalTitle').textContent = 'Tambah Barang';
  openModal('tambahBarang');
}

function fetchAndRender() {
  const searchInput = document.querySelector('input[name="search"]');
  const kategoriDropdown = document.querySelector('select[name="kategori"]');
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  let url = `/${prefix}stok-barang/search?search=${encodeURIComponent(searchInput ? searchInput.value : '')}&kategori=${encodeURIComponent(kategoriDropdown ? kategoriDropdown.value : '')}`;
  fetch(url)
    .then(res => res.json())
    .then(data => renderStokBarangTable(data));
}

function confirmDeleteStokBarang(id, nama) {
  if (confirm('Yakin ingin menghapus barang: ' + nama + '?')) {
    const currentPath = window.location.pathname;
    const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
    fetch('/' + prefix + 'stok-barang/delete/' + id, { 
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Data barang berhasil dihapus.');
          fetchAndRender();
        } else {
          alert('Maaf, data barang gagal dihapus. Silakan coba lagi.');
        }
      });
  }
}

document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.querySelector('input[name="search"]');
  const kategoriDropdown = document.querySelector('select[name="kategori"]');
  
  // Hanya gunakan AJAX untuk search dan filter
  if (searchInput) searchInput.addEventListener('input', fetchAndRender);
  if (kategoriDropdown) kategoriDropdown.addEventListener('change', fetchAndRender);
  
  // Entries dropdown akan ditangani oleh main.js dengan form submission normal
});
