// File: data_customer.js
// Fungsi: File ini digunakan untuk menangani interaksi dan logika pada halaman Data Customer.
// Biasanya berisi script untuk menambah, mengedit, menghapus, menampilkan detail, dan ekspor data customer.
// Tambahkan kode JavaScript Anda di bawah ini.

// =============================
// PENCARIAN DINAMIS DATA CUSTOMER
// =============================

function renderCustomerTable(data) {
  const tbody = document.querySelector('#tableContainer tbody');
  if (!tbody) return;
  tbody.innerHTML = '';
  if (!data || data.length === 0) {
    tbody.innerHTML = '<tr><td colspan="7" class="empty-table-message">Tidak ada data customer.</td></tr>';
    return;
  }
  data.forEach((item, idx) => {
    tbody.innerHTML += `
      <tr>
        <td>${idx + 1}</td>
        <td>${item.kode_customer}</td>
        <td>${item.nama_customer}</td>
        <td>${item.alamat}</td>
        <td>${item.telepon}</td>
        <td>${item.kota}</td>
        <td>
          <div class="table-actions">
            <a href="#" class="action-btn action-btn-edit" onclick="editCustomer(${item.id})">Edit</a>
            <a href="#" class="action-btn action-btn-delete" onclick="confirmDeleteCustomer(${item.id}, '${item.nama_customer}')">Hapus</a>
          </div>
        </td>
      </tr>
    `;
  });
}

function fetchAndRender() {
  const searchInput = document.querySelector('input[name="search"]');
  const kotaDropdown = document.querySelector('select[name="kota"]');
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-customer/search?search=${encodeURIComponent(searchInput ? searchInput.value : '')}&kota=${encodeURIComponent(kotaDropdown ? kotaDropdown.value : '')}`)
    .then(res => res.json())
    .then(data => renderCustomerTable(data));
}

document.addEventListener('DOMContentLoaded', function() {
  const searchInput = document.querySelector('input[name="search"]');
  const kotaDropdown = document.querySelector('select[name="kota"]');
  
  // Hanya gunakan AJAX untuk search dan filter
  if (searchInput) searchInput.addEventListener('input', fetchAndRender);
  if (kotaDropdown) kotaDropdown.addEventListener('change', fetchAndRender);
  
  // Entries dropdown akan ditangani oleh main.js dengan form submission normal
});

/**
 * Fungsi export data customer (Excel, PDF, CSV)
 * Akan redirect ke endpoint export dengan format dan filter aktif
 */
function exportCustomer(format) {
  const search = document.querySelector('input[name="search"]')?.value || '';
  const kota = document.querySelector('select[name="kota"]')?.value || '';
  let url = `/data-customer/export?format=${format}`;
  if (search) url += `&search=${encodeURIComponent(search)}`;
  if (kota) url += `&kota=${encodeURIComponent(kota)}`;
  window.location.href = url;
}

let dataAwalEdit = {};

function editCustomer(id) {
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-customer/get/${id}`)
    .then(res => res.json())
    .then(data => {
      if (data && data.success) {
        dataAwalEdit = data.data;
        document.getElementById('edit_customer_id').value = data.data.id;
        document.getElementById('edit_kode_customer').value = data.data.kode_customer;
        document.getElementById('edit_nama_customer').value = data.data.nama_customer;
        document.getElementById('edit_alamat').value = data.data.alamat;
        document.getElementById('edit_telepon').value = data.data.telepon;
        document.getElementById('edit_kota').value = data.data.kota;
        openModal('editCustomer');
      }
    });
}

function confirmDeleteCustomer(id, nama) {
  if (confirm('Yakin ingin menghapus customer: ' + nama + '?')) {
    const currentPath = window.location.pathname;
    const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
    fetch(`/${prefix}data-customer/delete/${id}`, { 
      method: 'POST',
      headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          alert('Customer berhasil dihapus.');
          fetchAndRender();
        } else {
          alert('Maaf, customer gagal dihapus. Silakan coba lagi.');
        }
      });
  }
}

function openTambahCustomerModal() {
  var form = document.getElementById('formTambahCustomer');
  if (form) form.reset();
  openModal('tambahCustomer');
}

function handleEditCustomerSubmit() {
  var form = document.getElementById('formEditCustomer');
  if (!form) return;
  var id = document.getElementById('edit_customer_id').value;
  var formData = new FormData();
  if (form['kode_customer'].value !== dataAwalEdit.kode_customer) formData.append('kode_customer', form['kode_customer'].value);
  if (form['nama_customer'].value !== dataAwalEdit.nama_customer) formData.append('nama_customer', form['nama_customer'].value);
  if (form['alamat'].value !== dataAwalEdit.alamat) formData.append('alamat', form['alamat'].value);
  if (form['telepon'].value !== dataAwalEdit.telepon) formData.append('telepon', form['telepon'].value);
  if (form['kota'].value !== dataAwalEdit.kota) formData.append('kota', form['kota'].value);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-customer/update/${id}`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Customer berhasil diperbarui.');
        closeModal('editCustomer');
        fetchAndRender();
      } else {
        alert('Maaf, customer gagal diperbarui. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
}

function handleAddCustomerSubmit() {
  var form = document.getElementById('formTambahCustomer');
  if (!form) return;
  var formData = new FormData(form);
  const currentPath = window.location.pathname;
  const prefix = currentPath.includes('/admin/') ? 'admin/' : (currentPath.includes('/user/') ? 'user/' : '');
  fetch(`/${prefix}data-customer/store`, {
    method: 'POST',
    body: formData,
    headers: { 'X-Requested-With': 'XMLHttpRequest' }
  })
    .then(res => res.json())
    .then(data => {
      if (data.success) {
        alert('Customer berhasil ditambahkan.');
        closeModal('tambahCustomer');
        fetchAndRender();
      } else {
        alert('Maaf, customer gagal ditambahkan. ' + (data.message || 'Silakan coba lagi.'));
      }
    });
}
