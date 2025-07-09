<!DOCTYPE html>
<html lang="id">
<head>
    <title><?= $this->renderSection('title') ?> | VStock</title>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/img/icon/vstock.ico') ?>">

    <!-- CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/alert.css') ?>">

    <!-- Font Awesome (CDN) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-papm6Q+..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Tambahan CSS dari halaman -->
    <?= $this->renderSection('styles') ?>

</head>
<body>
    <!-- Main Content -->
    <main>
        <?= $this->renderSection('content') ?>
    </main>

    <!-- JavaScript -->
    <script src="<?= base_url('assets/js/auth.js') ?>"></script>

    <!-- Tambahan Script dari halaman -->
    <?= $this->renderSection('scripts') ?>
</body>
</html>