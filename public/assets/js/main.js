// File: main.js
// Fungsi: File ini digunakan untuk script utama yang bersifat global di aplikasi.
// Biasanya berisi fungsi-fungsi utilitas, event handler global, atau inisialisasi fitur umum.
// Tambahkan kode JavaScript Anda di bawah ini.

// =============================
// FUNGSI GLOBAL UNTUK FITUR UMUM (main.js)
// =============================

/**
 * Fungsi global untuk tombol reset filter/pencarian
 * Akan mengosongkan semua input dan select di form filter, lalu submit form
 * Dapat dipanggil langsung dari HTML: onclick="handleResetButton()"
 */
window.handleResetButton = function() {
  // Cari form filter terdekat dari tombol yang diklik
  // Asumsi: hanya ada satu form filter per halaman dengan id 'filterForm'
  var form = document.getElementById('filterForm');
  if (!form) return;
  // Reset semua input text dan select di dalam form
  var inputs = form.querySelectorAll('input[type="text"], input[type="search"], input[type="date"], select');
  inputs.forEach(function(input) {
    if (input.tagName.toLowerCase() === 'select') {
      input.selectedIndex = 0;
    } else {
      input.value = '';
    }
  });
  form.submit();
};

/**
 * Fungsi global untuk tombol cetak (print)
 * Akan mencetak halaman saat ini dengan menyembunyikan elemen yang tidak perlu
 * Dapat dipanggil langsung dari HTML: onclick="printPage()"
 */
window.printPage = function() {
  // Sembunyikan semua elemen kecuali tabel utama saat cetak
  const style = document.createElement('style');
  style.id = 'print-style';
  style.innerHTML = `
    @media print {
      body * {
        visibility: hidden !important;
      }
      .main-card, .main-card * {
        visibility: visible !important;
      }
      .profil-toko-print {
        display: block !important;
      }
      .main-header, .sidebar, .filter-section, .show-entries-bar, .pagination-bar, .table-actions, .modal, .btn, .dashboard-page-title, .main-page-title, h2, .lihat-semua-bar, .dashboard-widgets, .dashboard-graph-row, .dashboard-graph-card, .dashboard-content > :not(.table-container), .dashboard-content > :not(.data-table) {
        display: none !important;
      }
      .main-card {
        position: absolute !important;
        left: 0; top: 0; width: 100vw !important; margin: 0 !important; padding: 0 !important; box-shadow: none !important; border: none !important;
      }
      .data-table {
        width: 100% !important;
        border-collapse: collapse !important;
      }
      .data-table th, .data-table td {
        border: 1px solid #000 !important;
        padding: 8px !important;
        text-align: left !important;
      }
      .data-table th {
        background-color: #f0f0f0 !important;
        font-weight: bold !important;
      }
      /* Hide Aksi column by header text */
      .data-table th, .data-table td {
        /* fallback for all cells */
      }
      .data-table th, .data-table td {
        /* fallback for all cells */
      }
      .data-table th, .data-table td {
        /* fallback for all cells */
      }
      /* Hide th and td with text 'Aksi' (header) and all corresponding cells */
      .data-table th, .data-table td {
        /* fallback for all cells */
      }
      .data-table th.aksi-column, .data-table td.aksi-column {
        display: none !important;
      }
      /* Hide by header text (for static HTML) */
      .data-table th {
        /* Hide th with text 'Aksi' */
      }
      .data-table th, .data-table td {
        /* fallback for all cells */
      }
      /* Hide by nth-child if needed (7th or 8th col) */
      .data-table th:nth-child(7), .data-table td:nth-child(7),
      .data-table th:nth-child(8), .data-table td:nth-child(8) {
        /* fallback for tables where Aksi is last col */
      }
      /* Hide th and td with exact text 'Aksi' (JS will add class for print) */
      .data-table th.print-hide, .data-table td.print-hide {
        display: none !important;
      }
      body {
        margin: 0 !important;
        padding: 0 !important;
      }
    }
  `;
  document.head.appendChild(style);

  // Add print-hide class to th/td with text 'Aksi' and all corresponding tds
  document.querySelectorAll('.data-table').forEach(function(table) {
    let aksiIndex = -1;
    table.querySelectorAll('th').forEach(function(th, idx) {
      if (th.textContent.trim().toLowerCase() === 'aksi') {
        th.classList.add('print-hide');
        aksiIndex = idx;
      }
    });
    if (aksiIndex !== -1) {
      table.querySelectorAll('tr').forEach(function(tr) {
        const tds = tr.querySelectorAll('td,th');
        if (tds[aksiIndex]) {
          tds[aksiIndex].classList.add('print-hide');
        }
      });
    }
  });

  window.print();
  setTimeout(function() {
    const printStyle = document.getElementById('print-style');
    if (printStyle) {
      printStyle.remove();
    }
    // Remove print-hide class after print
    document.querySelectorAll('.print-hide').forEach(function(el) {
      el.classList.remove('print-hide');
    });
  }, 1000);
};

/**
 * Menangani dropdown show entries (jumlah data per halaman)
 * Akan menggunakan AJAX untuk update data tanpa reload halaman
 */
document.addEventListener('DOMContentLoaded', function() {
  // Cari dropdown entries dengan berbagai kemungkinan selector
  const entriesDropdowns = document.querySelectorAll('select[name="entries"], select#entries, select[data-entries]');
  
  entriesDropdowns.forEach(function(dropdown) {
    dropdown.addEventListener('change', function() {
      const entriesValue = this.value;
      const currentUrl = new URL(window.location);
      
      // Update URL parameter entries
      currentUrl.searchParams.set('entries', entriesValue);
      
      // Preserve other parameters
      const searchInput = document.querySelector('input[name="search"]');
      const kategoriDropdown = document.querySelector('select[name="kategori"]');
      const kotaDropdown = document.querySelector('select[name="kota"]');
      const jabatanDropdown = document.querySelector('select[name="jabatan"]');
      const tanggalAwal = document.querySelector('input[name="tanggal_awal"]');
      const tanggalAkhir = document.querySelector('input[name="tanggal_akhir"]');
      
      if (searchInput && searchInput.value) {
        currentUrl.searchParams.set('search', searchInput.value);
      }
      if (kategoriDropdown && kategoriDropdown.value) {
        currentUrl.searchParams.set('kategori', kategoriDropdown.value);
      }
      if (kotaDropdown && kotaDropdown.value) {
        currentUrl.searchParams.set('kota', kotaDropdown.value);
      }
      if (jabatanDropdown && jabatanDropdown.value) {
        currentUrl.searchParams.set('jabatan', jabatanDropdown.value);
      }
      if (tanggalAwal && tanggalAwal.value) {
        currentUrl.searchParams.set('tanggal_awal', tanggalAwal.value);
      }
      if (tanggalAkhir && tanggalAkhir.value) {
        currentUrl.searchParams.set('tanggal_akhir', tanggalAkhir.value);
      }
      
      // Reset to page 1 when changing entries
      currentUrl.searchParams.set('page', '1');
      
      // Update browser URL without reload
      window.history.pushState({}, '', currentUrl.toString());
      
      // Fetch new data with AJAX
      fetch(currentUrl.toString())
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.text();
        })
        .then(html => {
          // Parse the HTML response
          const parser = new DOMParser();
          const doc = parser.parseFromString(html, 'text/html');
          
          // Update table content
          const newTableContainer = doc.querySelector('#tableContainer');
          const currentTableContainer = document.querySelector('#tableContainer');
          if (newTableContainer && currentTableContainer) {
            currentTableContainer.innerHTML = newTableContainer.innerHTML;
          }
          
          // Update pagination
          const newPaginationBar = doc.querySelector('#paginationBar');
          const currentPaginationBar = document.querySelector('#paginationBar');
          if (newPaginationBar && currentPaginationBar) {
            currentPaginationBar.innerHTML = newPaginationBar.innerHTML;
          }
          
          // Update entries dropdown to show selected value
          const newEntriesDropdown = doc.querySelector('select[name="entries"]');
          const currentEntriesDropdown = document.querySelector('select[name="entries"]');
          if (newEntriesDropdown && currentEntriesDropdown) {
            currentEntriesDropdown.value = newEntriesDropdown.value;
          }
        })
        .catch(error => {
          console.error('Error updating entries:', error);
          
          // Fallback to normal form submission
          const form = document.getElementById('entriesForm');
          if (form) {
            form.submit();
          } else {
            window.location.href = currentUrl.toString();
          }
        });
    });
  });
  
  // Handle pagination links with AJAX
  document.addEventListener('click', function(e) {
    // Check if clicked element is a pagination link or inside one
    let paginationLink = null;
    
    if (e.target.matches('.pagination-link-with-params')) {
      paginationLink = e.target;
    } else if (e.target.closest('.pagination-link-with-params')) {
      paginationLink = e.target.closest('.pagination-link-with-params');
    }
    
    if (paginationLink) {
      e.preventDefault();
      const href = paginationLink.getAttribute('href');
      console.log('Pagination link clicked:', href); // Debug log
      
      if (href) {
        // Fetch new page with AJAX
        fetch(href)
          .then(response => {
            if (!response.ok) {
              throw new Error('Network response was not ok');
            }
            return response.text();
          })
          .then(html => {
            // Parse the HTML response
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            
            // Update table content
            const newTableContainer = doc.querySelector('#tableContainer');
            const currentTableContainer = document.querySelector('#tableContainer');
            if (newTableContainer && currentTableContainer) {
              currentTableContainer.innerHTML = newTableContainer.innerHTML;
            }
            
            // Update pagination
            const newPaginationBar = doc.querySelector('#paginationBar');
            const currentPaginationBar = document.querySelector('#paginationBar');
            if (newPaginationBar && currentPaginationBar) {
              currentPaginationBar.innerHTML = newPaginationBar.innerHTML;
            }
            
            // Update entries dropdown to show selected value
            const newEntriesDropdown = doc.querySelector('select[name="entries"]');
            const currentEntriesDropdown = document.querySelector('select[name="entries"]');
            if (newEntriesDropdown && currentEntriesDropdown) {
              currentEntriesDropdown.value = newEntriesDropdown.value;
            }
            
            // Update browser URL without reload
            window.history.pushState({}, '', href);
            console.log('Pagination updated successfully'); // Debug log
          })
          .catch(error => {
            console.error('Error updating page:', error);
            
            // Fallback to normal navigation
            window.location.href = href;
          });
      }
    }
  });
});

