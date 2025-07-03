// =============================
// AUTH LOGIN PAGE SCRIPTS (VStock)
// =============================

// Toggle show/hide password pada input password

document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.getElementById('togglePassword');
    const password = document.getElementById('password');
    const icon = document.getElementById('togglePasswordIcon');
    if (togglePassword && password && icon) {
        // Sembunyikan icon mata saat input kosong
        function updateEyeVisibility() {
            if (password.value.length > 0) {
                togglePassword.style.visibility = 'visible';
            } else {
                togglePassword.style.visibility = 'hidden';
            }
        }
        updateEyeVisibility();
        password.addEventListener('input', updateEyeVisibility);

        togglePassword.addEventListener('mousedown', function () {
            togglePassword.classList.add('active');
        });
        togglePassword.addEventListener('mouseup', function () {
            togglePassword.classList.remove('active');
        });
        togglePassword.addEventListener('mouseleave', function () {
            togglePassword.classList.remove('active');
        });

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // Icon selalu fa-eye, tidak berubah
        });
    }
});
