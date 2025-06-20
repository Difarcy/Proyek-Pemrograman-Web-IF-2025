<?= $this->extend('layout/main') ?>

<?= $this->section('title') ?>profil<?= $this->endSection() ?>

<?= $this->section('content') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" type="image/x-icon" href="/assets/vstock.ico">
    <style>
        html, body {
            font-family: 'Inter', Arial, Helvetica, sans-serif;
            font-size: 15px;
            background: #f4f6f9;
        }
        .main-header {
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            height: 56px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            z-index: 1100;
            display: flex;
            align-items: center;
            padding: 0 1.5rem;
            transition: left 0.2s;
            font-size: 15px;
        }
        .main-header .app-title {
            font-size: 1.05rem;
            font-weight: 600;
            color: #007BFF;
            letter-spacing: 0.5px;
        }
        .main-header .user-info {
            margin-left: auto;
            display: flex;
            align-items: center;
            font-size: 0.97rem;
        }
        .main-header .user-info i {
            margin-right: 7px;
            color: #007BFF;
            font-size: 1.1rem;
        }
        .sidebar {
            min-height: 100vh;
            background: #007BFF;
            color: #fff;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1200;
            padding-bottom: 2rem;
            display: flex;
            flex-direction: column;
            box-shadow: 2px 0 8px rgba(0,0,0,0.06);
            overflow: hidden;
            transition: width 0.2s;
            font-size: 14px;
        }
        .sidebar-collapsed {
            width: 70px !important;
        }
        .sidebar .sidebar-content {
            flex: 1 1 auto;
            overflow-y: auto;
            padding-bottom: 1rem;
            height: 100vh;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE 10+ */
        }
        .sidebar .sidebar-content::-webkit-scrollbar {
            width: 0;
            height: 0;
        }
        .sidebar .brand-link {
            display: flex;
            align-items: center;
            padding: 1.1rem 1rem 0.8rem 1rem;
            font-size: 1.1rem;
            font-weight: 700;
            background: #0069d9;
            justify-content: flex-start;
            transition: padding 0.2s, font-size 0.2s;
            margin-bottom: 0.2rem;
        }
        .sidebar-collapsed .brand-link {
            justify-content: center;
            padding: 1.1rem 0 0.8rem 0;
        }
        .sidebar-collapsed .brand-link span {
            display: none;
        }
        .sidebar .brand-link img {
            height: 28px;
            margin-right: 10px;
            transition: margin 0.2s;
        }
        .sidebar-collapsed .brand-link img {
            margin-right: 0;
        }
        .sidebar .nav-header {
            padding: 1rem 1rem 0.3rem 1rem;
            font-size: 0.93rem;
            color: #cce3ff;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: padding 0.2s, font-size 0.2s;
        }
        .hide-on-collapse {
            transition: opacity 0.2s, width 0.2s;
        }
        .sidebar-collapsed .hide-on-collapse {
            display: none !important;
        }
        .sidebar-collapsed .nav-header {
            padding: 1rem 0.5rem 0.3rem 0.5rem;
            font-size: 0.85rem;
            text-align: center;
        }
        .sidebar .nav-link {
            color: #fff;
            padding: 0.55rem 1.2rem;
            display: flex;
            align-items: center;
            border-radius: 0.3rem;
            margin-bottom: 0.15rem;
            transition: background 0.25s cubic-bezier(.4,2,.6,1), box-shadow 0.25s, padding 0.2s, margin 0.2s, transform 0.18s;
            font-size: 0.97rem;
            white-space: nowrap;
            cursor: pointer;
        }
        .sidebar-collapsed .nav-link {
            justify-content: center;
            padding: 0.7rem 0.5rem;
            margin-bottom: 0.8rem;
        }
        .sidebar .nav-link.active, .sidebar .nav-link:hover {
            background: linear-gradient(90deg, #0056b3 60%, #007bff 100%);
            color: #fff;
            text-decoration: none;
            box-shadow: 0 4px 18px 0 rgba(0,123,255,0.13);
            transform: scale(1.08);
        }
        .sidebar .nav-link i {
            margin-right: 8px;
            font-size: 1.08rem;
            transition: margin 0.2s;
        }
        .sidebar-collapsed .nav-link i {
            margin-right: 0;
        }
        .sidebar .nav-link span {
            transition: opacity 0.2s, width 0.2s;
        }
        .sidebar-collapsed .nav-link span {
            display: none;
        }
        .content-wrapper {
            margin-left: 250px;
            padding: 56px 0.1rem 1.2rem 0.1rem !important;
            min-height: 100vh;
            transition: margin-left 0.2s;
            font-size: 0.97rem;
        }
        .collapsed-content {
            margin-left: 70px !important;
        }
        .main-header.collapsed-header {
            left: 70px !important;
        }
        .card {
            margin-top: 0.1rem !important;
            margin-left: 0 !important;
            border-radius: 0.6rem;
            box-shadow: 0 2px 12px rgba(0,0,0,0.07);
            border: none;
            font-size: 0.97rem;
        }
        .card-header, .card-footer {
            font-size: 0.97rem;
        }
        .table thead th {
            background: #e9f2ff;
            color: #007BFF;
            border-top: none;
            font-size: 0.97rem;
        }
        .table td, .table th {
            padding: 0.55rem 0.7rem;
            font-size: 0.97rem;
        }
        .btn, .btn-sm, .btn-info, .btn-primary, .btn-warning, .btn-danger {
            font-size: 0.89rem !important;
            padding: 0.18rem 0.55rem !important;
            border-radius: 0.2rem !important;
            line-height: 1.2 !important;
        }
        @media (max-width: 991.98px) {
            .sidebar, .main-header { left: 0; }
            .content-wrapper, .collapsed-content { margin-left: 0 !important; padding-top: 56px !important; }
        }
        /* Dark mode simple */
        .dark-mode {
            background: #181c24 !important;
            color: #e0e0e0 !important;
        }
        .dark-mode .main-header, .dark-mode .content-wrapper, .dark-mode .card, .dark-mode .dropdown-menu {
            background: #23272f !important;
            color: #e0e0e0 !important;
        }
        .dark-mode .sidebar {
            background: #232a36 !important;
        }
        .dark-mode .sidebar .brand-link {
            background: #1a1f27 !important;
        }
        .dark-mode .sidebar .nav-link.active, .dark-mode .sidebar .nav-link:hover {
            background: linear-gradient(90deg, #1a1f27 60%, #232a36 100%) !important;
        }
        .dark-mode .dropdown-menu { box-shadow: 0 2px 12px rgba(0,0,0,0.5) !important; }
        .bento-toggle-btn {
            background: transparent;
            border: none;
            outline: none;
            border-radius: 6px;
            box-shadow: none !important;
            outline: none !important;
        }
        .bento-toggle-btn:hover, .bento-toggle-btn:focus, .bento-toggle-btn:active {
            background: transparent !important;
            box-shadow: none !important;
            outline: none !important;
            border: none !important;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #0069d9;
            color: #fff;
        }
        .dropdown-toggle::after {
            display: none !important;
        }
        .profile-details-table {
            width: 100%;
        }
        .profile-details-table td {
            padding: 8px 0;
            font-size: 0.98rem;
        }
        .profile-details-table td:first-child {
            font-weight: 600;
            width: 150px;
            color: #6c757d;
        }
        .profile-pic-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
        }
        .profile-pic-wrapper .profile-pic {
            transition: filter 0.2s;
        }
        .profile-pic-wrapper .profile-pic-overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: rgba(30,30,30,0.35);
            border-radius: 50%;
            opacity: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.2s;
            pointer-events: none;
        }
        .profile-pic-wrapper:hover .profile-pic-overlay,
        .profile-pic-wrapper:focus .profile-pic-overlay {
            opacity: 1;
            pointer-events: auto;
        }
        .profile-pic-wrapper .profile-pic-overlay i {
            color: #fff;
            font-size: 2rem;
            opacity: 0.85;
        }
        .pl-18 { padding-left: 2.5rem !important; }
        .profile-divider {
            width: 2px;
            background: rgba(0,0,0,0.12);
            height: 100%;
            margin-left: 1rem;
            margin-right: 1rem;
            border-radius: 1px;
            opacity: 1;
            display: flex;
            align-items: center;
        }
        @media (max-width: 767.98px) {
            .pl-4 { padding-left: 1rem !important; }
            .profile-divider { display: none; }
        }
        .btn-modern {
            font-size: 1rem !important;
            padding: 0.36rem 1.2rem !important;
            border-radius: 0.25rem !important;
            border: 1.5px solid rgba(0,0,0,0.12) !important;
            box-shadow: none !important;
        }
        .input-balance {
            max-width: 400px;
            width: 100%;
            display: block;
        }
        .dropdown-notif {
            position: relative;
        }
        .dropdown-notif .dropdown-menu {
            opacity: 0;
            pointer-events: none;
            transform: translateY(10px);
            transition: opacity 0.22s cubic-bezier(.4,0,.2,1), transform 0.22s cubic-bezier(.4,0,.2,1);
            display: block !important;
            margin-top: 0.5rem;
            z-index: 1000;
        }
        .dropdown-notif.show-notif .dropdown-menu,
        .dropdown-notif:hover .dropdown-menu,
        .dropdown-notif:focus-within .dropdown-menu {
            opacity: 1;
            pointer-events: auto;
            transform: translateY(0);
        }
    </style>
</head>

<div class="content-wrapper" id="contentWrapper" style="padding-bottom:0 !important;">
    <div class="container-fluid p-0" style="padding-bottom:0 !important;">
        <div class="card shadow-sm" style="margin-top:0;margin-left:0;margin-right:0;margin-bottom:0;">
            <div class="card-body">
                <div class="d-flex flex-row align-items-stretch">
                    <div class="pl-4 d-flex flex-column align-items-center justify-content-start" style="min-width:160px;">
                        <div class="profile-pic-wrapper" tabindex="0" title="Klik untuk ganti foto">
                            <img src="<?= base_url('assets/img/profil.png') ?>" alt="Foto Profil" class="rounded-circle profile-pic" width="128" height="128" style="object-fit: cover;">
                            <div class="profile-pic-overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                        </div>
                    </div>
                    <div class="profile-divider"></div>
                    <div class="flex-grow-1">
                        <h5 class="font-weight-bold text-primary mb-4" style="letter-spacing:0.5px;">Detail Profil</h5>
                        <form>
                            <div class="form-group mb-3">
                                <label class="font-weight-500 mb-1" for="namaLengkap">Nama Lengkap</label>
                                <input type="text" readonly class="form-control-plaintext bg-light rounded px-3 py-2 input-balance" id="namaLengkap" value="Difarcy Ramadhan">
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-weight-500 mb-1" for="username">Username</label>
                                <input type="text" readonly class="form-control-plaintext bg-light rounded px-3 py-2 input-balance" id="username" value="difarcy">
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-weight-500 mb-1" for="email">Email</label>
                                <input type="text" readonly class="form-control-plaintext bg-light rounded px-3 py-2 input-balance" id="email" value="difarcy@email.com">
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-weight-500 mb-1" for="role">Role</label>
                                <input type="text" readonly class="form-control-plaintext bg-light rounded px-3 py-2 input-balance" id="role" value="Admin">
                            </div>
                            <div class="form-group mb-3">
                                <label class="font-weight-500 mb-1" for="bergabung">Bergabung Sejak</label>
                                <input type="text" readonly class="form-control-plaintext bg-light rounded px-3 py-2 input-balance" id="bergabung" value="12 Januari 2025">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white text-right" style="margin-bottom:1.2rem;">
                <button class="btn btn-primary btn-modern">Ubah Profil</button>
                <a href="<?= base_url('admin/dashboard') ?>" class="btn btn-danger btn-modern ml-2">Kembali</a>
            </div>
        </div>
    </div>
</div>


<script>
    const sidebar = document.getElementById('sidebar');
    const contentWrapper = document.getElementById('contentWrapper');
    const mainHeader = document.getElementById('mainHeader');
    const sidebarToggle = document.getElementById('sidebarToggle');
    let collapsed = false;
    sidebarToggle.addEventListener('click', function() {
        collapsed = !collapsed;
        sidebar.classList.toggle('sidebar-collapsed', collapsed);
        contentWrapper.classList.toggle('collapsed-content', collapsed);
        mainHeader.classList.toggle('collapsed-header', collapsed);
    });
    // Dark mode switch
    const darkSwitch = document.getElementById('darkSwitch');
    darkSwitch.addEventListener('change', function() {
        if (this.checked) {
            document.body.classList.add('dark-mode');
        } else {
            document.body.classList.remove('dark-mode');
        }
    });
    document.addEventListener('DOMContentLoaded', function() {
        var notifBtn = document.getElementById('notifDropdown');
        var notifDropdown = notifBtn.closest('.dropdown-notif');
        notifBtn.addEventListener('click', function(e) {
            e.preventDefault();
            notifDropdown.classList.toggle('show-notif');
        });
        document.addEventListener('mousedown', function(e) {
            if (!notifDropdown.contains(e.target)) {
                notifDropdown.classList.remove('show-notif');
            }
        });
        notifDropdown.addEventListener('mouseleave', function() {
            notifDropdown.classList.remove('show-notif');
        });
    });
</script>


<?= $this->endSection() ?>
