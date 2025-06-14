<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Inventrack</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            background: #f3f0ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
            overflow: hidden;
            max-width: 900px;
            width: 100%;
            display: flex;
            min-height: 500px;
        }
        .login-illustration {
            background: #f3f0ff;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50%;
            min-height: 500px;
        }
        .login-illustration img {
            max-width: 90%;
            height: auto;
        }
        .login-form-section {
            width: 50%;
            padding: 28px 14px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .login-title {
            font-size: 2rem;
            font-weight: 700;
            color: #8f5aff;
        }
        .login-subtitle {
            color: #888;
            margin-bottom: 32px;
            font-size: 0.85rem !important;
        }
        .form-control, .form-select {
            border-radius: 8px;
            font-size: 0.85rem;
        }
        .btn-inventrack {
            background: #8f5aff;
            color: #fff;
            border-radius: 8px;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 0.4rem 1rem;
        }
        .btn-inventrack.btn-lg {
            font-size: 0.95rem;
            padding: 0.5rem 1rem;
        }
        .btn-inventrack:hover {
            background: #7a4fd6;
        }
        #togglePasswordIcon, #toggleConfirmPasswordIcon {
            color: #888;
            opacity: 0.7;
            transition: color 0.2s, opacity 0.2s;
        }
        #togglePasswordIcon:hover, #toggleConfirmPasswordIcon:hover {
            color: #8f5aff;
            opacity: 1;
        }
        .login-form-section .text-center.mt-4, .login-form-section .text-center.mt-4 a, .login-form-section .text-center.mt-4 div {
            font-size: 0.85rem !important;
        }
        @media (max-width: 768px) {
            .login-container {
                flex-direction: column;
                min-height: unset;
            }
            .login-illustration, .login-form-section {
                width: 100%;
                min-height: 250px;
                padding: 32px 16px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-illustration">
            <img src="<?= base_url('assets/inventory-management.png') ?>" alt="Inventory Illustration">
        </div>
        <div class="login-form-section">
            <div class="text-center mb-4">
                <div class="login-title"><a href="<?= base_url() ?>" style="text-decoration:none;color:#8f5aff;">Inventrack</a></div>
                <div class="login-subtitle">Create your Inventrack account</div>
            </div>
            <form method="post" action="<?= base_url('auth/register') ?>">
                <div class="mb-3">
                    <input type="text" class="form-control" name="fullname" placeholder="Full Name" required autofocus>
                </div>
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username or Email" required>
                </div>
                <div class="mb-3 position-relative">
                    <input type="password" class="form-control" name="password" id="passwordInput" placeholder="Password" required>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="togglePassword()">
                        <i class="fa fa-eye" id="togglePasswordIcon"></i>
                    </span>
                </div>
                <div class="mb-3 position-relative">
                    <input type="password" class="form-control" name="confirm_password" id="confirmPasswordInput" placeholder="Confirm Password" required>
                    <span class="position-absolute top-50 end-0 translate-middle-y me-3" style="cursor:pointer;" onclick="toggleConfirmPassword()">
                        <i class="fa fa-eye" id="toggleConfirmPasswordIcon"></i>
                    </span>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="role" required>
                        <option value="" disabled selected>Select Role</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="viewer">Viewer</option>
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-inventrack btn-lg">Register</button>
                </div>
                <div class="text-center mt-4">
                    <div class="mb-2"><a href="<?= base_url('auth/login') ?>" style="color:#888;text-decoration:none;">Already have an account? Login</a></div>
                    <div><a href="<?= base_url('forgot-password') ?>" style="color:#8f5aff;">Forgot password?</a></div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
    <script>
    function togglePassword() {
        const passwordInput = document.getElementById('passwordInput');
        const icon = document.getElementById('togglePasswordIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    function toggleConfirmPassword() {
        const passwordInput = document.getElementById('confirmPasswordInput');
        const icon = document.getElementById('toggleConfirmPasswordIcon');
        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            passwordInput.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
    </script>
</body>
</html> 