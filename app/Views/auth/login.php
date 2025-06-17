<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - VSTOCK</title>
    <link rel="icon" type="image/x-icon" href="/vstock.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --primary-dark: #2e59d9;
            --primary-light: #eaecf4;
            --secondary-color: #858796;
            --success-color: #1cc88a;
            --info-color: #36b9cc;
            --warning-color: #f6c23e;
            --danger-color: #e74a3b;
            --light-color: #f8f9fc;
            --dark-color: #5a5c69;
            --font-primary: 'Inter', sans-serif;
        }

        body {
            background-color: #f8f9fc;
            font-family: var(--font-primary);
            font-weight: 400;
            line-height: 1.6;
        }

        .container-fluid {
            min-height: 100vh;
        }

        .rounded-4 {
            border-radius: 1rem !important;
        }

        .bg-primary {
            background-color: var(--primary-color) !important;
        }

        h3.fw-bold {
            font-family: var(--font-primary);
            font-size: 1.75rem;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        .text-muted.small {
            font-family: var(--font-primary);
            font-size: 0.875rem;
            font-weight: 400;
            letter-spacing: 0.01em;
        }

        .form-control, .form-select {
            font-family: var(--font-primary);
            font-size: 0.875rem;
            font-weight: 400;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            border: 1px solid #e2e8f0;
            transition: all 0.2s ease;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.15);
        }

        .form-control::placeholder {
            color: #a0aec0;
            font-weight: 400;
        }

        .btn-primary {
            font-family: var(--font-primary);
            font-weight: 600;
            font-size: 0.875rem;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            background-color: var(--primary-color);
            border: none;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-dark);
            transform: translateY(-1px);
        }

        .alert {
            font-family: var(--font-primary);
            font-size: 0.875rem;
            font-weight: 500;
            border-radius: 0.5rem;
            padding: 0.75rem 1rem;
        }

        .btn.position-absolute {
            font-size: 0.875rem;
            color: var(--secondary-color);
            transition: all 0.2s ease;
        }

        .btn.position-absolute:hover {
            color: var(--dark-color);
        }

        .transition-opacity {
            transition: opacity 0.2s ease;
        }
    </style>
</head>
<body class="bg-light">
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row shadow rounded-4 overflow-hidden bg-white w-100" style="max-width:900px; min-height:500px;">
            <div class="col-md-6 bg-primary p-0 position-relative" style="min-height:300px;">
                <img src="/assets/img/inventory-management-system.png" alt="Inventory Management System" class="w-100 h-100" style="object-fit:cover; min-height:100%; min-width:100%;">
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center p-4">
                <div class="w-100 text-center mb-5">
                    <div class="mb-1">
                        <h3 class="fw-bold text-primary mb-0">VSTOCK</h3>
                        <div class="text-muted small">Manage Your Inventory with Ease and Efficiency</div>
                    </div>
                </div>
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger py-2 w-100 small">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>
                <form method="post" action="/login" class="w-100" style="max-width:320px;">
                    <div class="mb-3">
                        <input type="text" class="form-control form-control-sm" name="username" placeholder="Username" required autofocus>
                    </div>
                    <div class="mb-3">
                        <div class="mb-3 position-relative">
                            <input type="password" class="form-control form-control-sm" name="password" id="passwordInput" placeholder="Password" required>
                            <button class="btn position-absolute end-0 top-50 translate-middle-y px-2 text-secondary opacity-0 transition-opacity" type="button" id="togglePassword" tabindex="-1" style="border:none;">
                                <i class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 py-2 btn-sm fw-bold">LOGIN</button>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('passwordInput');
        let show = false;

        passwordInput.addEventListener('input', function() {
            if (this.value.length > 0) {
                togglePassword.classList.remove('opacity-0');
                togglePassword.classList.add('opacity-50');
            } else {
                togglePassword.classList.add('opacity-0');
                togglePassword.classList.remove('opacity-50');
            }
        });

        togglePassword.addEventListener('click', function() {
            show = !show;
            passwordInput.type = show ? 'text' : 'password';
            togglePassword.querySelector('i').className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
            this.classList.toggle('opacity-50');
            this.classList.toggle('opacity-100');
        });

        togglePassword.addEventListener('mouseenter', function() {
            if (passwordInput.value.length > 0) {
                this.classList.remove('opacity-50');
                this.classList.add('opacity-100');
            }
        });

        togglePassword.addEventListener('mouseleave', function() {
            if (!show && passwordInput.value.length > 0) {
                this.classList.add('opacity-50');
                this.classList.remove('opacity-100');
            }
        });
    });
    </script>
</body>
</html> 