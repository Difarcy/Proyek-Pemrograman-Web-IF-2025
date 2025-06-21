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
    <script>
        // Immediate dark mode check to prevent flash of unstyled content
        (function() {
            const savedDarkMode = localStorage.getItem('darkMode') === 'true';
            if (savedDarkMode) {
                document.documentElement.classList.add('dark-mode');
                document.body.classList.add('dark-mode');
            }
        })();
    </script>
    <style>
        html, body {
            font-family: 'Inter', Arial, Helvetica, sans-serif;
            font-size: 15px;
            background: #f4f6f9;
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        
        /* Immediate dark mode styles to prevent flash */
        html.dark-mode, body.dark-mode {
            background: #1a1d21 !important;
            color: #e0e0e0 !important;
        }
        
        /* Force immediate dark mode application */
        body.dark-mode * {
            transition: background-color 0.1s ease, color 0.1s ease, border-color 0.1s ease, box-shadow 0.1s ease !important;
        }
        
        /* Ensure all elements respond immediately to dark mode */
        body.dark-mode .main-header,
        body.dark-mode .content-wrapper,
        body.dark-mode .card,
        body.dark-mode .info-widget,
        body.dark-mode .dropdown-menu,
        body.dark-mode .form-control,
        body.dark-mode .btn,
        body.dark-mode .table,
        body.dark-mode .modal-content {
            transition: background-color 0.1s ease, color 0.1s ease, border-color 0.1s ease, box-shadow 0.1s ease !important;
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
            transition: left 0.2s, background-color 0.3s ease, color 0.3s ease;
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
            transition: margin-left 0.2s, background-color 0.3s ease, color 0.3s ease;
            font-size: 0.97rem;
        }
        .collapsed-content {
            margin-left: 70px !important;
        }
        .main-header.collapsed-header {
            left: 70px !important;
        }
        /* === SIDEBAR DARK MODE === */
        body.dark-mode .sidebar {
            background: #2a2f36 !important; /* abu gelap modern */
            color: #ffffff !important;
            box-shadow: 2px 0 8px rgba(0, 0, 0, 0.5);
        }

        /* === Brand / Logo Sidebar === */
        body.dark-mode .sidebar .brand-link {
            background: #1b1b1b !important; /* hitam pekat */
            color: #ffffff !important;
        }

        /* === Text, Icon, dan Header Sidebar === */
        body.dark-mode .sidebar .brand-link span,
        body.dark-mode .sidebar .nav-header,
        body.dark-mode .sidebar .nav-link,
        body.dark-mode .sidebar .nav-link i {
            color: #ffffff !important;
        }

        body.dark-mode .sidebar .nav-header {
            color: #cfd8dc !important; /* abu terang */
        }

        /* === Hover dan Active Sidebar Link === */
        body.dark-mode .sidebar .nav-link.active,
        body.dark-mode .sidebar .nav-link:hover {
            background: linear-gradient(90deg, #1b1b1b 60%, #2a2f36 100%) !important;
            color: #ffffff !important;
            text-decoration: none;
            box-shadow: 0 4px 18px 0 rgba(255, 255, 255, 0.06);
            transform: scale(1.08);
        }

        /* === Sidebar Collapse Handling === */
        body.dark-mode .sidebar-collapsed .brand-link span,
        body.dark-mode .sidebar-collapsed .nav-link span,
        body.dark-mode .sidebar-collapsed .hide-on-collapse {
            display: none !important;
        }

        body.dark-mode .sidebar .nav-link i {
            margin-right: 8px;
            font-size: 1.08rem;
            transition: margin 0.2s;
        }

        body.dark-mode .sidebar-collapsed .nav-link i {
            margin-right: 0;
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
            transition: box-shadow 0.18s, background-color 0.3s ease, color 0.3s ease;
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
        .card {
            border: none;
            border-radius: 0.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
        }
        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem 0.5rem 0 0;
        }
        .card-header h5 {
            margin: 0;
            font-weight: 600;
            color: #495057;
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-footer {
            background-color: #fff;
            border-top: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
            border-radius: 0 0 0.5rem 0.5rem;
        }
        .badge-primary { background: #007BFF; font-size: 0.85rem; }
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            padding: 0.75rem;
            font-size: 0.875rem;
        }
        .table tbody td {
            vertical-align: middle;
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
            font-size: 0.875rem;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }
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
        /* Dark mode support */
        .dark-mode {
            background: #1a1d21 !important;
            color: #e0e0e0 !important;
        }
        .dark-mode html {
            background: #1a1d21 !important;
        }
        .dark-mode .main-header {
            background: #2a2f3a !important;
            color: #e0e0e0 !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2) !important;
        }
        .dark-mode .content-wrapper {
            background: #1a1d21 !important;
            color: #e0e0e0 !important;
        }
        .dark-mode .info-widget {
            background: #2a2f3a !important;
            color: #e0e0e0 !important;
            box-shadow: 0 2px 12px 0 rgba(0,0,0,0.2) !important;
        }
        .dark-mode .card {
            background-color: #2d3748 !important;
            border-color: #4a5568 !important;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.2) !important;
        }
        /* Saat dark mode aktif */
        body.dark-mode .custom-control-label::before {
            background-color: #ffffff !important; /* track putih */
            border-color: #ffffff !important;
        }

        body.dark-mode .custom-switch .custom-control-input:checked ~ .custom-control-label::after {
            background-color: #000000 !important; /* bulat hitam */
        }
        .dark-mode .card-header {
            background-color: #2d3748 !important;
            border-bottom-color: #4a5568 !important;
            color: #e2e8f0 !important;
        }
        body.dark-mode .main-header .app-title,
        body.dark-mode .main-header .text-center,
        body.dark-mode .main-header i,
        body.dark-mode .main-header svg,
        body.dark-mode .main-header svg rect {
            color: #ffffff !important;
            fill: #ffffff !important;
        }
        .dark-mode .card-header h5 {
            color: #e2e8f0 !important;
        }
        .dark-mode .card-footer {
            background-color: #2d3748 !important;
            border-top-color: #4a5568 !important;
            color: #e2e8f0 !important;
        }
        .dark-mode .card-body {
            color: #e0e0e0 !important;
        }
        .dark-mode .form-control {
            background: #323742 !important;
            border-color: #3a3f4a !important;
            color: #e0e0e0 !important;
        }
        .dark-mode .form-control:focus {
            background: #323742 !important;
            border-color: #007bff !important;
            color: #e0e0e0 !important;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,0.25) !important;
        }
        .dark-mode .btn-secondary {
            background: #6c757d !important;
            border-color: #6c757d !important;
            color: #fff !important;
        }
        .dark-mode .btn-secondary:hover {
            background: #5a6268 !important;
            border-color: #545b62 !important;
        }
        .dark-mode .search-filter-card {
            background: #2a2f3a !important;
            border-color: #3a3f4a !important;
        }
        .dark-mode .search-filter-card .card-title {
            color: #e0e0e0 !important;
        }
        .dark-mode .table {
            color: #e0e0e0;
        }
        .dark-mode .table thead th {
            background-color: #374151;
            border-bottom-color: #4b5563;
            color: #e5e7eb;
        }
        .dark-mode .table tbody td {
            border-bottom-color: #4b5563;
            color: #e5e7eb;
        }
        .dark-mode .table tbody tr:hover {
            background-color: #374151;
        }
        .dark-mode .table-bordered {
            border-color: #4b5563;
        }
        .dark-mode .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.02);
        }
        .dark-mode .pagination-info-new {
            color: #b0b0b0;
        }
        .dark-mode .pagination-dots {
            color: #b0b0b0;
        }
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
        
        /* Warna status */
        .badge-status-tersedia { background: #28a745 !important; }
        .badge-status-habis { background: #ff6a8d !important; }
        .badge-status-hampirhabis { background: #ffc107 !important;}
        .badge-status-barumasuk { background: #4e9af1 !important; }
        .badge-status-tidakaktif { background: #adb5bd !important; }
        .badge-status {
            font-weight: 600;
            text-transform: capitalize;
            padding: 0.28em 0.9em;
            font-size: 0.85rem;
            border-radius: 0.25rem;
            letter-spacing: 0.01em;
            width: 109px; /* Atur sesuai lebar badge "Hampir Habis" */
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
        
        /* Special layout for profile and password pages */
        .content-wrapper.profile-layout {
            margin-left: 250px;
            padding: 56px 0 0 0 !important;
            min-height: 100vh;
            transition: margin-left 0.2s;
            font-size: 0.97rem;
        }
        .content-wrapper.profile-layout .container-fluid {
            padding: 0;
            margin: 0;
            height: calc(100vh - 56px);
        }
        .content-wrapper.profile-layout .card {
            margin: 0 !important;
            border-radius: 0;
            height: calc(100vh - 56px);
            display: flex;
            flex-direction: column;
        }
        .content-wrapper.profile-layout .card-body {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }
        .content-wrapper.profile-layout .card-header {
            border-radius: 0;
            border-bottom: 1px solid #e9ecef;
        }
        .content-wrapper.profile-layout .card-footer {
            border-radius: 0;
            border-top: 1px solid #e9ecef;
        }
        .collapsed-content.profile-layout {
            margin-left: 70px !important;
        }
        
        /* Dark mode for profile layout */
        .dark-mode .content-wrapper.profile-layout .card {
            background: #23272f !important;
            color: #e0e0e0 !important;
        }
        .dark-mode .content-wrapper.profile-layout .card-header,
        .dark-mode .content-wrapper.profile-layout .card-footer {
            border-color: #3a3f4a !important;
        }
        
        /* Profile photo styling */
        .profile-photo-wrapper {
            position: relative;
            display: inline-block;
            cursor: pointer;
            border-radius: 50%;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .profile-photo-wrapper:hover {
            transform: scale(1.05);
        }
        .profile-photo-wrapper .profile-photo {
            width: 150px;
            height: 150px;
            object-fit: cover;
            transition: filter 0.3s ease;
        }
        .profile-photo-wrapper .photo-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.6);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 50%;
        }
        .profile-photo-wrapper:hover .photo-overlay {
            opacity: 1;
        }
        .profile-photo-wrapper:hover .profile-photo {
            filter: brightness(0.7);
        }
        .profile-photo-wrapper .photo-overlay i {
            color: white;
            font-size: 2rem;
            opacity: 0.9;
        }
        
        /* Profile photo read-only */
        .profile-photo-readonly {
            cursor: default;
        }
        .profile-photo-readonly:hover {
            transform: none;
        }
        .profile-photo-readonly:hover .photo-overlay {
            opacity: 0;
        }
        .profile-photo-readonly:hover .profile-photo {
            filter: none;
        }
        
        /* Extended button styling */
        .btn-extended {
            min-width: 140px;
            padding: 0.5rem 1.5rem !important;
            font-weight: 500;
            border-radius: 0.375rem !important;
            transition: all 0.3s ease;
        }
        .btn-extended:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .btn-extended.btn-blue {
            background: #007BFF;
            border-color: #007BFF;
            color: white;
        }
        .btn-extended.btn-blue:hover {
            background: #0056b3;
            border-color: #0056b3;
        }
        .btn-extended.btn-red {
            background: #dc3545;
            border-color: #dc3545;
            color: white;
        }
        .btn-extended.btn-red:hover {
            background: #c82333;
            border-color: #c82333;
        }
        .btn-extended.btn-gray {
            background: #6c757d;
            border-color: #6c757d;
            color: white;
        }
        .btn-extended.btn-gray:hover {
            background: #5a6268;
            border-color: #5a6268;
        }
        
        /* Dark mode for profile photo */
        .dark-mode .profile-photo-wrapper .photo-overlay {
            background: rgba(0, 0, 0, 0.7);
        }
        
        /* Password page layout - same as profile page */
        .content-wrapper.password-layout {
            margin-left: 250px;
            padding: 56px 0 0 0 !important;
            min-height: 100vh;
            transition: margin-left 0.2s;
            font-size: 0.97rem;
        }
        .content-wrapper.password-layout .container-fluid {
            padding: 0;
            margin: 0;
            height: calc(100vh - 56px);
        }
        .content-wrapper.password-layout .card {
            margin: 0 !important;
            border-radius: 0;
            height: calc(100vh - 56px);
            display: flex;
            flex-direction: column;
        }
        .content-wrapper.password-layout .card-body {
            flex: 1;
            overflow-y: auto;
            padding: 1.5rem;
        }
        .content-wrapper.password-layout .card-header {
            border-radius: 0;
            border-bottom: 1px solid #e9ecef;
        }
        .content-wrapper.password-layout .card-footer {
            border-radius: 0;
            border-top: 1px solid #e9ecef;
        }
        .collapsed-content.password-layout {
            margin-left: 70px !important;
        }
        
        /* Password page photo positioning - same as profile */
        .password-layout .profile-photo-wrapper {
            margin-bottom: 1.5rem;
        }
        .password-layout .text-center {
            margin-bottom: 2rem;
        }
        
        /* Dark mode for password layout */
        .dark-mode .content-wrapper.password-layout .card {
            background: #23272f !important;
            color: #e0e0e0 !important;
        }
        .dark-mode .content-wrapper.password-layout .card-header,
        .dark-mode .content-wrapper.password-layout .card-footer {
            border-color: #3a3f4a !important;
        }
        
        /* Export button styling */
        .btn-export {
            min-width: 120px;
            padding: 0.5rem 1.2rem !important;
            font-weight: 500;
            border-radius: 0.375rem !important;
            transition: all 0.3s ease;
            margin-left: 0.5rem;
        }
        .btn-export:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        .btn-export.btn-success {
            background: #28a745;
            border-color: #28a745;
            color: white;
        }
        .btn-export.btn-success:hover {
            background: #218838;
            border-color: #218838;
        }
        
        /* Consistent button styling for table actions */
        .btn-table-action {
            min-width: 120px;
            padding: 0.5rem 1.2rem !important;
            font-weight: 500;
            border-radius: 0.375rem !important;
            transition: all 0.3s ease;
        }
        .btn-table-action:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        
        /* Vertical action buttons */
        .action-buttons {
            display: flex;
            flex-direction: column;
            gap: 0.25rem;
            min-width: 80px;
        }
        .action-buttons .btn {
            width: 100%;
            font-size: 0.8rem !important;
            padding: 0.25rem 0.5rem !important;
            border-radius: 0.25rem !important;
        }
        .btn-table-action,
        .btn-export,
        .btn-print {
            min-width: 80px;        /* lebih ramping */
            height: 26px;           /* lebih pendek */
            padding: 2px 6px;
            font-size: 11px;        /* lebih kecil lagi */
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 4px;
        }

        /* Spasi ikon */
        .btn-table-action i,
        .btn-export i,
        .btn-print i {
            margin-right: 4px;
            font-size: 12px;
        }

        /* Jarak antar tombol */
        .card-header .btn + .btn {
            margin-left: 5px;
        }

        /* Responsif HP */
        @media (max-width: 576px) {
            .card-header .btn {
                margin-top: 6px;
                width: 100%;
            }
        }
       /* Tombol Profil Admin */
        .btn-extended {
            min-width: 80px;
            height: 26px;
            padding: 2px 6px;
            font-size: 11px;
            font-weight: 500;
            border-radius: 4px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-right: 5px;
        }

        .btn-extended i {
            margin-right: 4px;
            font-size: 12px;
        }

        /* Warna tombol */
        .btn-blue { background-color: #007bff; color: #fff; }
        .btn-red { background-color: #dc3545; color: #fff; }
        .btn-gray { background-color: #6c757d; color: #fff; }

        /* Hover efek */
        .btn-blue:hover { background-color: #0056b3; }
        .btn-red:hover { background-color: #b52a37; }
        .btn-gray:hover { background-color: #5a6268; }
        /* Search and Filter Card Styles */
        .search-filter-card {
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        
        .search-filter-card .card-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: #495057;
            margin-bottom: 1rem;
        }
        
        .search-filter-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            align-items: end;
        }
        
        .search-filter-row .form-group {
            margin-bottom: 0;
        }
        
        .search-filter-row label {
            font-size: 0.875rem;
            font-weight: 500;
            color: #495057;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        /* Pagination Styles */
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            padding: 1rem 0;
            width: 100%;
        }
        
        .pagination-info-new {
            font-size: 0.875rem;
            color: #6c757d;
            flex-shrink: 0;
        }
        
        .pagination-controls {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            flex-shrink: 0;
        }
        
        .pagination-controls .btn {
            font-size: 0.875rem;
            padding: 0.375rem 0.75rem;
            border: none;
            background: transparent;
            color: #007bff;
            text-decoration: none;
            border-radius: 0.25rem;
            transition: none;
            cursor: default;
            box-shadow: none;
            outline: none;
        }
        
        .pagination-controls .btn:hover:not(:disabled) {
            background: transparent;
            color: #007bff;
            text-decoration: none;
            box-shadow: none;
            outline: none;
        }
        
        .pagination-controls .btn:focus {
            box-shadow: none;
            outline: none;
        }
        
        .pagination-controls .btn.active {
            background: transparent;
            color: #007bff;
            font-weight: bold;
            box-shadow: none;
            outline: none;
        }
        
        .pagination-controls .btn:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            color: #6c757d;
            box-shadow: none;
            outline: none;
        }
        
        .pagination-dots {
            display: none;
        }
        
        /* Print Options Styles */
        .print-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .print-option {
            border: 2px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1rem;
            text-align: center;
            cursor: pointer;
            transition: all 0.15s ease-in-out;
            background: #fff;
        }
        
        .print-option:hover {
            border-color: #007bff;
            background: #f8f9fa;
        }
        
        .print-option.selected {
            border-color: #007bff;
            background: #e3f2fd;
        }
        
        .print-option i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: block;
        }
        
        .print-option .option-title {
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .print-option .option-desc {
            font-size: 0.875rem;
            color: #6c757d;
        }
        
        /* Fade Animation */
        .fade-out {
            opacity: 0;
            transition: opacity 0.3s ease-out;
        }
        
        /* Dark mode styles for new components */
        .dark-mode .search-filter-card {
            background: #2d3748;
            border-color: #4a5568;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.2);
        }
        
        .dark-mode .search-filter-card .card-title {
            color: #e2e8f0;
        }
        
        .dark-mode .search-filter-row label {
            color: #e2e8f0;
        }
        
        .dark-mode .pagination-info-new {
            color: #a0aec0;
        }
        
        .dark-mode .pagination-controls .btn {
            background: transparent;
            border: none;
            color: #3182ce;
            box-shadow: none;
            outline: none;
        }
        
        .dark-mode .pagination-controls .btn:hover:not(:disabled) {
            background: transparent;
            color: #3182ce;
            box-shadow: none;
            outline: none;
        }
        
        .dark-mode .pagination-controls .btn:focus {
            box-shadow: none;
            outline: none;
        }
        
        .dark-mode .pagination-controls .btn.active {
            background: transparent;
            color: #3182ce;
            font-weight: bold;
            box-shadow: none;
            outline: none;
        }
        
        .dark-mode .pagination-dots {
            color: #a0aec0;
        }
        
        .dark-mode .modal-content {
            background: #2d3748;
            border-color: #4a5568;
        }
        
        .dark-mode .modal-header {
            border-bottom-color: #4a5568;
        }
        
        .dark-mode .modal-footer {
            border-top-color: #4a5568;
        }
        
        .dark-mode .print-option {
            background: #2d3748;
            border-color: #4a5568;
            color: #e2e8f0;
        }
        
        .dark-mode .print-option:hover {
            border-color: #3182ce;
            background: #4a5568;
        }
        
        .dark-mode .print-option.selected {
            border-color: #3182ce;
            background: #2c5282;
        }
        
        .dark-mode .print-option .option-desc {
            color: #a0aec0;
        }
        
        /* Table Styles - Consistent with Stok Barang */
        .table {
            margin-bottom: 0;
            vertical-align: middle;
        }
        
        .table thead th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            padding: 0.75rem;
            font-size: 0.875rem;
        }
        
        .table tbody td {
            vertical-align: middle;
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
            text-align: center;
            font-size: 0.875rem;
        }
        
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        
        .table-bordered {
            border: 1px solid #dee2e6;
        }
        
        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.02);
        }
        
        /* Dark mode table styles */
        .dark-mode .table thead th {
            background-color: #374151;
            border-bottom-color: #4b5563;
            color: #e5e7eb;
        }
        
        .dark-mode .table tbody td {
            border-bottom-color: #4b5563;
            color: #e5e7eb;
        }
        
        .dark-mode .table tbody tr:hover {
            background-color: #374151;
        }
        
        .dark-mode .table-bordered {
            border-color: #4b5563;
        }
        
        .dark-mode .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.02);
        }
        
        /* Search and Filter Input Styles */
        .search-filter-card .form-control,
        .search-filter-card .form-select,
        .dropdown-menu,
        .dropdown-item,
        .form-control,
        .form-select {
            font-size: 0.875rem !important;
        }
        
        /* Profile dropdown specific styles */
        .dropdown-profile .dropdown-menu,
        .dropdown-profile .dropdown-item {
            font-size: 0.875rem !important;
        }
        
        /* Dark mode for search and filter inputs */
        .dark-mode .search-filter-card .form-control,
        .dark-mode .search-filter-card .form-select,
        .dark-mode .dropdown-menu,
        .dark-mode .dropdown-item,
        .dark-mode .form-control,
        .dark-mode .form-select {
            font-size: 0.875rem !important;
        }
        
        /* Action Buttons Styles */
        .action-buttons {
            display: flex;
            gap: 0.25rem;
            justify-content: center;
            flex-wrap: wrap;
        }
        
        .action-buttons .btn {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            margin: 0.125rem;
        }
        
        .btn-print, .btn-export, .btn-table-action {
            margin-left: 0.5rem;
        }
        
        /* Modal positioning - center all modals */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 250px;
            top: 56px;
            width: calc(100% - 250px);
            height: calc(100vh - 56px);
            overflow: hidden;
            background-color: rgba(0,0,0,0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .modal.show {
            display: flex !important;
            align-items: center;
            justify-content: center;
            opacity: 1;
        }
        .modal.fade-out {
            opacity: 0;
        }
        .modal-dialog {
            margin: 0;
            max-width: 500px;
            width: 90%;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .modal-dialog::-webkit-scrollbar {
            width: 0;
            height: 0;
        }
        .modal-content {
            border-radius: 0.5rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            max-height: calc(100vh - 120px);
            overflow-y: auto;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }
        .modal-content::-webkit-scrollbar {
            width: 0;
            height: 0;
        }
        
        /* Handle collapsed sidebar for modals */
        .sidebar-collapsed ~ .content-wrapper .modal {
            left: 70px;
            width: calc(100% - 70px);
        }
        
        /* Modal Content Styles */
        .modal-header {
            border-bottom: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
        }
        /* === TABEL DARK MODE === */
        body.dark-mode table.table-bordered,
        body.dark-mode table.table-bordered th,
        body.dark-mode table.table-bordered td {
            border-color: #ffffff !important;
            color: #ffffff !important;
            background-color: #2b2b2b !important; /* abu gelap modern */
        }

        /* === CARD DARK MODE === */
        body.dark-mode .card,
        body.dark-mode .card-header,
        body.dark-mode .card-body,
        body.dark-mode .card-footer {
            background-color: #2b2b2b !important;
            color: #ffffff !important;
        }

        /* === LEGEND KUSTOM GRAFIK (Teks) === */
        body.dark-mode .custom-legend-masukkeluar span {
            color: #ffffff !important;
        }

        /* === LINK FOOTER === */
        body.dark-mode .card-footer a {
            color: #ffffff !important;
        }

        /* === CIRCLE & BAR LEGEND KATEGORI === */
        body.dark-mode .legend-circle,
        body.dark-mode .legend-bar {
            border-color: #ffffff !important;
        }
        /* Dark mode dropdown styles */
        .dark-mode .dropdown-menu {
            background: #2d3748 !important;
            border-color: #4a5568 !important;
            color: #e2e8f0 !important;
        }
        
        .dark-mode .dropdown-item {
            color: #e2e8f0 !important;
        }
        
        .dark-mode .dropdown-item:hover {
            background: #4a5568 !important;
        }
        
        .dark-mode .dropdown-item:active {
            background: #3182ce !important;
            color: #fff !important;
        }
        
        .dark-mode .dropdown-divider {
            border-color: #4a5568 !important;
        }
        
        /* Dark mode notification dropdown specific */
        .dark-mode .dropdown-notif .dropdown-menu {
            background: #2d3748 !important;
            border-color: #4a5568 !important;
        }
        
        .dark-mode .dropdown-notif .dropdown-item {
            color: #e2e8f0 !important;
        }
        
        .dark-mode .dropdown-notif .dropdown-item:hover {
            background: #4a5568 !important;
        }
        
        /* Dark mode profile dropdown specific */
        .dark-mode .dropdown-profile .dropdown-menu {
            background: #2d3748 !important;
            border-color: #4a5568 !important;
        }
        
        .dark-mode .dropdown-profile .dropdown-item {
            color: #e2e8f0 !important;
        }
        
        .dark-mode .dropdown-profile .dropdown-item:hover {
            background: #4a5568 !important;
        }
        
        /* Notification dropdown styles */
        .dropdown-notif .dropdown-item {
            padding: 0.75rem 1rem;
            border-bottom: 1px solid #f8f9fa;
        }
        
        .dropdown-notif .dropdown-item:last-child {
            border-bottom: none;
        }
        
        .dropdown-notif .dropdown-item:hover {
            background: #f8f9fa;
        }
        
        .dropdown-notif .dropdown-item .font-weight-bold {
            font-size: 0.875rem;
            margin-bottom: 0.25rem;
        }
        
        .dropdown-notif .dropdown-item small {
            font-size: 0.75rem;
            line-height: 1.3;
        }
        
        .dropdown-notif .dropdown-item i {
            font-size: 1rem;
            margin-top: 0.125rem;
        }
        
        /* Dark mode notification styles */
        .dark-mode .dropdown-notif .dropdown-item {
            border-bottom-color: #4a5568;
        }
        
        .dark-mode .dropdown-notif .dropdown-item:hover {
            background: #4a5568 !important;
        }
        
        .dark-mode .dropdown-notif .dropdown-item small.text-muted {
            color: #a0aec0 !important;
        }
        /* === PAGINATION TEXT STYLE (DARK MODE) === */
        body.dark-mode .pagination-controls .btn {
            background: none !important;
            border: none !important;
            color: #ffffff !important;
            box-shadow: none !important;
            cursor: pointer;
            padding: 6px 12px;
            font-weight: 500;
        }

        /* Aktif (halaman sekarang) */
        body.dark-mode .pagination-controls .btn.active {
            color: #007BFF !important;
            text-decoration: underline;
        }

        /* Disabled (misalnya Previous saat di halaman 1) */
        body.dark-mode .pagination-controls .btn:disabled {
            color: #888888 !important;
            cursor: not-allowed;
            text-decoration: none;
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
        // Immediate dark mode check to prevent flash of unstyled content
        (function() {
            const savedDarkMode = localStorage.getItem('darkMode') === 'true';
            if (savedDarkMode) {
                document.documentElement.classList.add('dark-mode');
                document.body.classList.add('dark-mode');
            }
        })();
        
        // Enhanced dark mode management
        function initializeDarkMode() {
            const darkSwitch = document.getElementById('darkSwitch');
            if (!darkSwitch) return;
            
            const savedDarkMode = localStorage.getItem('darkMode') === 'true';
            
            // Apply saved preference
            if (savedDarkMode) {
                document.documentElement.classList.add('dark-mode');
                document.body.classList.add('dark-mode');
                darkSwitch.checked = true;
            } else {
                document.documentElement.classList.remove('dark-mode');
                document.body.classList.remove('dark-mode');
                darkSwitch.checked = false;
            }
            
            // Single event listener for dark mode toggle
            darkSwitch.addEventListener('change', function() {
                const isDarkMode = this.checked;
                
                // Immediately update localStorage
                localStorage.setItem('darkMode', isDarkMode.toString());
                
                // Immediately update DOM classes
                if (isDarkMode) {
                    document.documentElement.classList.add('dark-mode');
                    document.body.classList.add('dark-mode');
                } else {
                    document.documentElement.classList.remove('dark-mode');
                    document.body.classList.remove('dark-mode');
                }
                
                // Force immediate visual update by triggering reflow
                document.body.offsetHeight;
                
                // Dispatch custom event for any other components that need to know
                const event = new CustomEvent('darkModeChanged', { detail: { isDarkMode } });
                document.dispatchEvent(event);
                
                // Debug log
                console.log('Dark mode toggled:', isDarkMode);
            });
        }
        
        // Initialize when DOM is ready
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initializeDarkMode);
        } else {
            initializeDarkMode();
        }
        
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
                
                // Handle profile-layout class
                if (contentWrapper.classList.contains('profile-layout')) {
                    contentWrapper.classList.toggle('collapsed-content', collapsed);
                }
                
                // Handle password-layout class
                if (contentWrapper.classList.contains('password-layout')) {
                    contentWrapper.classList.toggle('collapsed-content', collapsed);
                }
            });
        }
        
        document.addEventListener('DOMContentLoaded', function() {
            // Ensure dark mode is properly applied on page load
            const savedDarkMode = localStorage.getItem('darkMode') === 'true';
            const darkSwitch = document.getElementById('darkSwitch');
            
            if (savedDarkMode && darkSwitch) {
                document.documentElement.classList.add('dark-mode');
                document.body.classList.add('dark-mode');
                darkSwitch.checked = true;
            } else if (!savedDarkMode && darkSwitch) {
                document.documentElement.classList.remove('dark-mode');
                document.body.classList.remove('dark-mode');
                darkSwitch.checked = false;
            }
            
            // Force immediate visual update
            document.body.offsetHeight;
            
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
        <script>
        // Fungsi deteksi dark mode
        const isDarkMode = () => document.body.classList.contains('dark-mode');

        document.addEventListener('DOMContentLoaded', () => {
            const charts = Chart.instances;

            const updateChartColors = () => {
                Object.values(charts).forEach(chart => {
                    // Ubah warna angka (ticks) di sumbu X & Y
                    if (chart.options.scales) {
                        ['x', 'y'].forEach(axis => {
                            if (chart.options.scales[axis]?.ticks) {
                                chart.options.scales[axis].ticks.color = isDarkMode() ? '#ffffff' : '#666666';
                            }
                            if (chart.options.scales[axis]?.grid) {
                                chart.options.scales[axis].grid.color = isDarkMode() ? '#444444' : '#f0f2f7';
                            }
                        });
                    }

                    // Ubah warna teks legend
                    if (chart.options.plugins?.legend?.labels) {
                        chart.options.plugins.legend.labels.color = isDarkMode() ? '#ffffff' : '#666666';
                    }

                    chart.update();
                });
            };

            // Pertama kali muat
            updateChartColors();

            // Pantau perubahan class "dark-mode"
            const observer = new MutationObserver(updateChartColors);
            observer.observe(document.body, {
                attributes: true,
                attributeFilter: ['class']
            });
        });
    </script>
    <?= $this->renderSection('scripts') ?>
</body>
</html> 