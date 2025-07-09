<!DOCTYPE html>
<html lang="id">
<head>
    <title><?= $this->renderSection('title') ?> | VStock</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/icon/vstock.ico') ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/sidebar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/header.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/alert.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/dashboard.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/layout.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/tabel.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/pagination.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/button.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/grafik.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/modal.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/kelola_pengguna.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/profil.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/reset_password.css') ?>">
    <?php if (service('uri')->getSegment(2) === 'profil-toko'): ?>
    <!-- <link rel="stylesheet" href="<?= base_url('assets/css/profil.css') ?>"> -->
    <?php endif; ?>

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-papm6Q+..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Tambahan CSS dari halaman -->
    <?= $this->renderSection('styles') ?>

</head>
<body>
    <div class="layout-root">
        <!-- Sidebar -->
        <?= $this->include('partials/sidebar_admin') ?>

        <!-- Header -->
        <?= $this->include('partials/header') ?>

        <div class="layout-main">
            <main>
                <?= $this->renderSection('content') ?>
            </main>
        </div>
    </div>

    <!-- JavaScript -->

    <script src="<?= base_url('assets/js/header.js') ?>"></script>
    <script src="<?= base_url('assets/js/main.js') ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= base_url('assets/js/dashboard.js') ?>"></script>
    <script src="<?= base_url('assets/js/modal.js') ?>"></script>
    <?php if (service('uri')->getSegment(2) === 'kelola-pengguna'): ?>
    <script src="<?= base_url('assets/js/kelola_pengguna.js') ?>"></script>
    <?php endif; ?>
    <?php if (service('uri')->getSegment(2) === 'stok-barang'): ?>
    <script src="<?= base_url('assets/js/stok_barang.js') ?>"></script>
    <?php endif; ?>
    <script src="<?= base_url('assets/js/reset_password.js') ?>"></script>
    <?php 
    $segment2 = service('uri')->getSegment(2);
    echo "<!-- Debug: Segment 2 = '$segment2' -->";
    ?>
    <?php if ($segment2 === 'profil-toko' || $segment2 === 'profil'): ?>
        <script src="<?= base_url('assets/js/profil.js') ?>"></script>
    <?php endif; ?>
    <?php if (service('uri')->getSegment(2) === 'data-customer'): ?>
    <script src="<?= base_url('assets/js/data_customer.js') ?>"></script>
    <?php endif; ?>
    <?php if (service('uri')->getSegment(2) === 'data-petugas'): ?>
    <script src="<?= base_url('assets/js/data_petugas.js') ?>"></script>
    <?php endif; ?>
    <?php if (service('uri')->getSegment(2) === 'data-supplier'): ?>
    <script src="<?= base_url('assets/js/data_supplier.js') ?>"></script>
    <?php endif; ?>
    <?php if (service('uri')->getSegment(2) === 'barang-masuk'): ?>
    <script src="<?= base_url('assets/js/barang_masuk.js') ?>"></script>
    <?php endif; ?>
    <?php if (service('uri')->getSegment(2) === 'barang-keluar'): ?>
    <script src="<?= base_url('assets/js/barang_keluar.js') ?>"></script>
    <?php endif; ?>
    
    <!-- Tambahan Script dari halaman -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>