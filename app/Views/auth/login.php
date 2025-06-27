<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VSTOCK</title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('vstock.ico') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/css/auth.css') ?>" rel="stylesheet">
    <script>
        // Render-blocking script to apply dark mode without flashing
        (function() {
            if (localStorage.getItem('theme') === 'dark') {
                document.documentElement.classList.add('dark-mode');
            }
        })();
    </script>
</head>
<body class="bg-light">
    <div class="container-fluid min-vh-100 d-flex align-items-center justify-content-center">
        <div class="row shadow rounded-4 overflow-hidden bg-white w-100" style="max-width:900px; min-height:500px;">
            <div class="col-md-6 bg-primary p-0 position-relative" style="min-height:300px;">
                <img src="/assets/img/inventory_stock.png" alt="Inventory Management System" class="w-100 h-100" style="object-fit:cover; min-height:100%; min-width:100%;">
            </div>
            <div class="col-md-6 d-flex flex-column align-items-center justify-content-center p-4 position-relative">
                <!-- Dark Mode Toggle -->
                <div class="position-absolute top-0 end-0 p-3">
                    <button id="darkModeToggle" class="btn btn-sm btn-outline-secondary rounded-circle" title="Dark Mode" style="width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50% !important;">
                        <i class="fas fa-moon" style="font-size: 0.8rem;"></i>
                    </button>
                </div>

                <div class="w-100 text-center mb-5 mt-4">
                    <div class="mb-1">
                        <h3 class="fw-bold text-primary mb-0">VSTOCK</h3>
                        <div class="text-muted small">Manage Your Inventory with Ease and Efficiency</div>
                    </div>
                </div>
                <div class="form-container">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger py-2 small">
                            Username dan password salah
                        </div>
                    <?php endif; ?>
                    <form method="post" action="/login">
                        <?= csrf_field(); ?>
                        <div class="mb-3">
                            <input type="text" class="form-control form-control-sm" name="username" placeholder="Username" required autofocus>
                        </div>
                        <div class="mb-3">
                            <div class="password-container">
                                <input type="password" class="form-control form-control-sm" name="password" id="password" placeholder="Password" required>
                                <button type="button" class="password-toggle" id="password-toggle">
                                    <i class="fa-solid fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 btn-sm fw-bold">LOGIN</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('assets/js/dark_mode.js') ?>"></script>
    <script src="<?= base_url('assets/js/auth.js') ?>"></script>
</body>
</html>
