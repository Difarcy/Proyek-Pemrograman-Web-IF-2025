document.addEventListener('DOMContentLoaded', function() {
    // Function to apply dark mode based on localStorage
    (function() {
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.classList.add('dark-mode');
            document.body.classList.add('dark-mode');
        } else {
            document.documentElement.classList.remove('dark-mode');
            document.body.classList.remove('dark-mode');
        }
    })();

    // Dark Mode Toggle
    const darkModeToggle = document.getElementById('darkModeToggle');
    if (darkModeToggle) {
        darkModeToggle.addEventListener('click', function() {
            document.documentElement.classList.toggle('dark-mode');
            document.body.classList.toggle('dark-mode');
            
            let theme = 'light';
            if (document.documentElement.classList.contains('dark-mode')) {
                theme = 'dark';
            }
            localStorage.setItem('theme', theme);
        });
    }

    // Password visibility toggle
    const passwordInput = document.getElementById('password');
    const passwordToggle = document.getElementById('password-toggle');

    if (passwordInput && passwordToggle) {
        // Sembunyikan ikon saat awal jika input kosong
        if (passwordInput.value.length === 0) {
            passwordToggle.classList.remove('visible');
        }
        passwordInput.addEventListener('input', function() {
            if (passwordInput.value.length > 0) {
                passwordToggle.classList.add('visible');
            } else {
                passwordToggle.classList.remove('visible');
            }
        });

        passwordToggle.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            if (type === 'text') {
                passwordToggle.classList.add('active');
            } else {
                passwordToggle.classList.remove('active');
            }
        });
    }

    // Alert auto-hide
    const alert = document.querySelector('.alert');
    if (alert) {
        setTimeout(function() {
            alert.style.transition = 'opacity 0.5s ease';
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 500);
        }, 5000); // 5 seconds
    }
}); 