<!-- ========================================
     SCRIPTS PARTIAL
     File: app/Views/partials/scripts.php
     Deskripsi: JavaScript links yang digunakan di seluruh aplikasi
     ======================================== -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>

<!-- Custom JS Files -->
<script src="<?= base_url('assets/js/dark_mode.js') ?>"></script>
<script src="<?= base_url('assets/js/auth.js') ?>"></script>
<!-- Page Specific JS -->
<?php if (isset($page_js)): ?>
    <?php foreach ($page_js as $js): ?>
        <script src="<?= base_url($js) ?>"></script>
    <?php endforeach; ?>
<?php endif; ?>
