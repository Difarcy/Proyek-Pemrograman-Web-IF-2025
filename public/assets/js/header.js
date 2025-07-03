document.addEventListener('DOMContentLoaded', function() {
  const btn = document.getElementById('profileDropdownBtn');
  const dropdown = document.getElementById('profileDropdown');

  if (btn && dropdown) {
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      dropdown.classList.toggle('show');
    });
    document.addEventListener('click', function(e) {
      if (!dropdown.contains(e.target)) {
        dropdown.classList.remove('show');
      }
    });
  }
});
