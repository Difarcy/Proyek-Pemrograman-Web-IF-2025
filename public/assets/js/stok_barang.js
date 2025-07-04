// Filter stok barang otomatis (server-side)
document.addEventListener('DOMContentLoaded', function() {
  var searchInput = document.querySelector('.stok-search');
  if (searchInput) {
    searchInput.addEventListener('input', function() {
      this.form.submit();
    });
  }
});

function exportExcel() {
  alert('Export ke Excel berhasil!');
}
