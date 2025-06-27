<!-- ========================================
     STYLES PARTIAL
     File: app/Views/partials/styles.php
     Deskripsi: CSS links yang digunakan di seluruh aplikasi
     ======================================== -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<!-- Custom CSS Files -->
<link rel="stylesheet" href="<?= base_url('assets/css/auth.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/dark_mode.css') ?>">

<!-- Page Specific CSS -->
<?php if (isset($page_css)): ?>
    <?php foreach ($page_css as $css): ?>
        <link rel="stylesheet" href="<?= base_url($css) ?>">
    <?php endforeach; ?>
<?php endif; ?>
