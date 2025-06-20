<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $this->renderSection('title') ?: 'VSTOCK Inventory' ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('vstock.ico') ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
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
            padding: 76px 1.2rem 1.2rem 1.2rem;
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
        .info-widget {
            background: #fff;
            border-radius: 1.1rem;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.06);
            padding: 1.3rem 1.3rem 0.7rem 1.3rem;
            margin-bottom: 1.1rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 170px;
            position: relative;
            border: none;
            transition: box-shadow 0.18s;
        }
        .info-widget .widget-icon {
            position: absolute;
            top: 1.1rem;
            right: 1.1rem;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: rgba(0,123,255,0.07);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 1;
        }
        .info-widget .widget-icon i, .info-widget .widget-icon svg {
            font-size: 1.6rem;
            color: #0d6efd;
        }
        .info-widget .widget-value {
            font-size: 2.1rem;
            font-weight: 700;
            color: #222;
            margin-bottom: 0.15rem;
            margin-top: 0.1rem;
        }
        .info-widget .widget-label {
            font-size: 1.08rem;
            color: #555;
            margin-bottom: 0.7rem;
            font-weight: 500;
        }
        .info-widget .widget-link {
            display: flex;
            align-items: center;
            color: #0d6efd;
            font-size: 1.01rem;
            font-weight: 600;
            text-decoration: none;
            border-top: 1px solid #f0f2f7;
            margin-left: -1.3rem;
            margin-right: -1.3rem;
            margin-top: 1.1rem;
            padding: 0.7rem 1.3rem 0.1rem 1.3rem;
            border-bottom-left-radius: 1.1rem;
            border-bottom-right-radius: 1.1rem;
            transition: background 0.13s;
        }
        .info-widget .widget-link:hover {
            background: #f5f8ff;
            text-decoration: underline;
        }
        .info-widget .widget-link i {
            font-size: 1.1rem;
            margin-left: 0.5rem;
            transition: transform 0.13s;
        }
        .info-widget .widget-link:hover i {
            transform: translateX(2px);
        }
        .bg-info { background: #17a2b8 !important; color: #fff; }
        .bg-danger { background: #dc3545 !important; color: #fff; }
        .bg-success { background: #28a745 !important; color: #fff; }
        .bg-warning { background: #ffc107 !important; color: #212529; }
        .card { border-radius: 0.6rem; box-shadow: 0 2px 12px rgba(0,0,0,0.07); border: none; font-size: 0.97rem; }
        .badge-primary { background: #007BFF; font-size: 0.85rem; }
        .card-header, .card-footer { font-size: 0.97rem; }
        .table thead th {
            background: #e9f2ff;
            color: #007BFF;
            border-top: none;
            font-size: 0.97rem;
        }
        .table td, .table th { padding: 0.55rem 0.7rem; font-size: 0.97rem; }
        .btn, .btn-sm, .btn-info, .btn-primary, .btn-warning, .btn-danger {
            font-size: 0.89rem !important;
            padding: 0.18rem 0.55rem !important;
            border-radius: 0.2rem !important;
            line-height: 1.2 !important;
        }
        .btn i { font-size: 0.98em; margin-right: 2px; }
        .btn:last-child i { margin-right: 0; }
        .btn-group .btn { margin-right: 2px; }
        h1, h5 { font-size: 1.15rem; font-weight: 600; }
        @media (max-width: 991.98px) {
            .sidebar, .main-header { left: 0; }
            .content-wrapper, .collapsed-content { margin-left: 0 !important; padding-top: 70px; }
            .info-widget { min-height: 120px; padding: 1rem 1rem 0.5rem 1rem; }
            .info-widget .widget-icon { width: 38px; height: 38px; font-size: 1.1rem; }
            .info-widget .widget-value { font-size: 1.3rem; }
            .info-widget .widget-label { font-size: 0.98rem; }
            .info-widget .widget-link { font-size: 0.97rem; padding: 0.5rem 1rem 0.1rem 1rem; }
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
        .dark-mode .breadcrumb {
            background: transparent !important;
            color: #e0e0e0 !important;
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
        .bento-toggle-btn .bento-icon {
            transition: none;
        }
        .bento-toggle-btn:hover .bento-icon, .bento-toggle-btn:focus .bento-icon, .bento-toggle-btn:active .bento-icon {
            transform: none;
            outline: none !important;
            box-shadow: none !important;
            border: none !important;
        }
        .sidebar .nav-link:hover, .sidebar .nav-link.active {
            background-color: #0069d9;
            color: #fff;
        }
        .dropdown-toggle::after {
            display: none !important;
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
        .widget-gradient {
            border-radius: 1.1rem;
            color: #fff;
            padding: 1rem 1.1rem 0.6rem 1.1rem;
            margin-bottom: 0.7rem;
            min-height: 110px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.04);
            width: 100%;
            max-width: 100%;
        }
        .widget-gradient.bg1 {
            background: linear-gradient(135deg, #4e9af1 0%, #5bb6f9 100%);
        }
        .widget-gradient.bg2 {
            background: linear-gradient(135deg, #2ed8b6 0%, #59e6c2 100%);
        }
        .widget-gradient.bg3 {
            background: linear-gradient(135deg, #f6c445 0%, #f9d37c 100%);
        }
        .widget-gradient.bg4 {
            background: linear-gradient(135deg, #ff6a8d 0%, #ff8ca8 100%);
        }
        .widget-title {
            font-size: 0.98rem;
            font-weight: 700;
            margin-bottom: 0.4rem;
            letter-spacing: 0.01em;
        }
        .widget-row {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            margin-bottom: 0.4rem;
        }
        .widget-icon {
            font-size: 1.35rem;
            opacity: 0.85;
            margin-bottom: 0.1rem;
        }
        .widget-value {
            font-size: 1.45rem;
            font-weight: 800;
            letter-spacing: 0.01em;
            text-align: right;
            margin-left: 0.7rem;
        }
        .widget-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 0.93rem;
            opacity: 0.93;
            font-weight: 500;
            margin-top: 0.1rem;
        }
        .widget-footer-label {
            font-size: 0.91rem;
        }
        .widget-footer-value {
            font-size: 0.93rem;
            font-weight: 600;
        }
        .row.tight-widgets {
            margin-left: -0.3rem;
            margin-right: -0.3rem;
        }
        .tight-widgets > [class^='col-'] {
            padding-left: 0.3rem;
            padding-right: 0.3rem;
        }
        @media (max-width: 991.98px) {
            .widget-gradient { min-height: 80px; padding: 0.7rem 0.7rem 0.4rem 0.7rem; }
            .widget-title { font-size: 0.91rem; }
            .widget-icon { font-size: 1.05rem; }
            .widget-value { font-size: 1.05rem; }
            .widget-footer { font-size: 0.85rem; }
        }
        .badge-status-tersedia,
        .badge-status-habis,
        .badge-status-hampirhabis,
        .badge-status-barumasuk,
        .badge-status-tidakaktif {
            font-weight: 600;
            text-transform: capitalize;
            padding: 0.28em 0.9em;
            font-size: 0.85rem;
            border-radius: 0.25rem;
            letter-spacing: 0.01em;
            min-width: 100px;
            display: inline-block;
            text-align: center;
        }
        .badge-status-tersedia { background: #28a745 !important; color: #fff !important; }
        .badge-status-habis { background: #ff6a8d !important; color: #fff !important; }
        .badge-status-hampirhabis { background: #ffc107 !important; color: #fff !important; }
        .badge-status-barumasuk { background: #4e9af1 !important; color: #fff !important; }
        .badge-status-tidakaktif { background: #adb5bd !important; color: #fff !important; }
        .badge-status-menunggu,
        .badge-status-diproses,
        .badge-status-selesai,
        .badge-status-dibatalkan,
        .badge-status-pending,
        .badge-status-retur {
            font-weight: 600;
            text-transform: capitalize;
            padding: 0.28em 0.9em;
            font-size: 0.85rem;
            border-radius: 0.25rem;
            letter-spacing: 0.01em;
            min-width: 100px;
            display: inline-block;
            text-align: center;
            color: #fff !important;
        }
        .badge-status-menunggu { background: #adb5bd !important; }
        .badge-status-diproses { background: #4e9af1 !important; }
        .badge-status-selesai { background: #28a745 !important; }
        .badge-status-dibatalkan { background: #ff6a8d !important; }
        .badge-status-pending { background: #ffc107 !important; }
        .badge-status-retur { background: #fd7e14 !important; }
        .badge-status-dikirim,
        .badge-status-ditolak {
            font-weight: 600;
            text-transform: capitalize;
            padding: 0.28em 0.9em;
            font-size: 0.85rem;
            border-radius: 0.25rem;
            letter-spacing: 0.01em;
            min-width: 100px;
            display: inline-block;
            text-align: center;
            color: #fff !important;
        }
        .badge-status-dikirim { background: #ffc107 !important; }
        .badge-status-ditolak {
            background: #ff6a8d !important;
            color: #fff !important;
            font-weight: 600;
            text-transform: capitalize;
            padding: 0.28em 0.9em;
            font-size: 0.85rem;
            border-radius: 0.25rem;
            letter-spacing: 0.01em;
            min-width: 100px;
            display: inline-block;
            text-align: center;
        }
        .custom-legend-masukkeluar {
            display: flex;
            gap: 1.2rem;
            margin-top: 0.4rem;
            margin-bottom: 0.1rem;
            align-items: center;
            justify-content: center;
        }
        .legend-line {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.82rem;
            font-weight: 400;
            color: #888;
        }
        .legend-shape {
            display: flex;
            align-items: center;
        }
        .legend-circle {
            width: 9px;
            height: 9px;
            border-radius: 50%;
            background: var(--legend-color);
            border: 1.5px solid #fff;
            box-shadow: 0 0 0 1px var(--legend-color);
        }
        .legend-bar {
            width: 22px;
            height: 3px;
            background: var(--legend-color);
            border-radius: 1.5px;
            margin: 0 1px;
        }
    </style>
    <?= $this->renderSection('head') ?>
</head>
<body>
    <?= $this->include('components/header') ?>
    <?= $this->include('components/sidebar_admin') ?>
    <div class="content-wrapper" id="contentWrapper">
        <?= $this->renderSection('content') ?>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const contentWrapper = document.getElementById('contentWrapper');
        const mainHeader = document.getElementById('mainHeader');
        const sidebarToggle = document.getElementById('sidebarToggle');
        let collapsed = false;
        
        if (sidebarToggle) {
            sidebarToggle.addEventListener('click', function() {
                collapsed = !collapsed;
                sidebar.classList.toggle('sidebar-collapsed', collapsed);
                contentWrapper.classList.toggle('collapsed-content', collapsed);
                if (mainHeader) {
                    mainHeader.classList.toggle('collapsed-header', collapsed);
                }
            });
        }
        
        // Dark mode switch
        const darkSwitch = document.getElementById('darkSwitch');
        if (darkSwitch) {
            darkSwitch.addEventListener('change', function() {
                if (this.checked) {
                    document.body.classList.add('dark-mode');
                } else {
                    document.body.classList.remove('dark-mode');
                }
            });
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            var notifBtn = document.getElementById('notifDropdown');
            if (notifBtn) {
                var notifDropdown = notifBtn.closest('.dropdown-notif');
                notifBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    notifDropdown.classList.toggle('show-notif');
                });
                // Close on click outside
                document.addEventListener('mousedown', function(e) {
                    if (!notifDropdown.contains(e.target)) {
                        notifDropdown.classList.remove('show-notif');
                    }
                });
                // Close on mouseleave (optional, for hover out)
                notifDropdown.addEventListener('mouseleave', function() {
                    notifDropdown.classList.remove('show-notif');
                });
            }
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html> 