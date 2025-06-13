<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventrack - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f8f9fa;
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
            padding: 48px 40px;
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
        }
        .form-control, .form-select {
            border-radius: 8px;
        }
        .btn-inventrack {
            background: #8f5aff;
            color: #fff;
            border-radius: 8px;
            font-weight: 600;
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
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-illustration">
            <img src="<?= base_url('assets/img/inventory-management.png') ?>" alt="Inventory Illustration">
        </div>
        <div class="login-form-section">
            <div class="text-center mb-4">
                <div class="login-title">Inventrack</div>
                <div class="login-subtitle">Melihat stok barang yang tersedia</div>
            </div>
            <form method="post" action="<?= base_url('auth/login') ?>">
                <div class="mb-3">
                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required autofocus>
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" name="password" placeholder="Masukkan Password" required>
                </div>
                <div class="mb-3">
                    <select class="form-select" name="role" required>
                        <option value="" disabled selected>Masuk Sebagai</option>
                        <option value="admin">Admin</option>
                        <option value="staff">Staff</option>
                        <option value="viewer">Viewer</option>
                    </select>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-inventrack btn-lg">Login</button>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 