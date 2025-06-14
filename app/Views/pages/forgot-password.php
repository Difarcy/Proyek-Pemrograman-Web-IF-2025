<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Inventrack</title>
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
        .login-form-section .text-center.mt-4, .login-form-section .text-center.mt-4 a, .login-form-section .text-center.mt-4 div {
            font-size: 0.85rem !important;
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
                <div class="login-subtitle">Forgot your password?</div>
            </div>
            <form method="post" action="<?= base_url('forgot-password') ?>">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Username or Email" required autofocus>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-inventrack btn-lg">Send Reset Instructions</button>
                </div>
                <div class="text-center mt-4">
                    <div class="mb-2"><a href="<?= base_url('auth/login') ?>" style="color:#888;text-decoration:none;">Back to Login</a></div>
                    <div><a href="<?= base_url('register') ?>" style="color:#8f5aff;">Don't have an account? Sign up</a></div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/js/all.min.js"></script>
</body>
</html> 