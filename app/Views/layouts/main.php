<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ========================================
         META TAGS & BASIC SETUP
         ======================================== -->
    <?= $this->include('partials/meta') ?>
    <title><?= $this->renderSection('title') ?: 'VSTOCK Inventory' ?></title>
    <?= $this->include('partials/styles') ?>
    
    <!-- ========================================
         PAGE SPECIFIC STYLES (CSS khusus halaman)
         ======================================== -->
    <?php
    if (isset($page_css) && is_array($page_css)) {
        foreach ($page_css as $css) {
            echo '<link rel="stylesheet" href="' . base_url($css) . '">' . "\n";
        }
    }
    ?>
    
    <!-- ========================================
         GLOBAL CSS STYLES (CSS yang di-embed langsung)
         ======================================== -->
    <style>
        /* ========================================
         * GLOBAL BASE STYLES
         * Font, background, dan transisi dasar
         * ======================================== */
        html, body {
            font-family: 'Inter', Arial, Helvetica, sans-serif;
            font-size: 15px;
            background: #f4f6f9;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        /* ========================================
         * MAIN STRUCTURE
         * Layout utama konten dan sidebar
         * ======================================== */
        .content-wrapper {
            position: relative;
            background: #f4f6f9;
            min-height: 100vh;
            top: 0;
            left: 78px;
            width: calc(100% - 78px);
            transition: all 0.5s ease;
            z-index: 2;
            padding: 76px 1.2rem 1.2rem 1.2rem;
        }
        .sidebar-wrapper.open ~ .content-wrapper {
            left: 250px;
            width: calc(100% - 250px);
        }

        /* ========================================
         * SIDEBAR STRUCTURE
         * ======================================== */
        .sidebar-wrapper {
            position: fixed;
            left: 0;
            top: 0;
            height: 100%;
            width: 78px;
            background: #007BFF;
            padding: 6px 14px;
            z-index: 99;
            transition: all 0.5s ease;
            overflow-y: auto;
            height: 100vh;
        }
        .sidebar-wrapper.open {
            width: 250px;
        }
        .sidebar-wrapper .logo-details {
            height: 60px;
            display: flex;
            align-items: center;
            position: relative;
        }
        .sidebar-wrapper .logo-details .logo_name {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            opacity: 0;
            transition: all 0.5s ease;
        }
        .sidebar-wrapper.open .logo-details .logo_name {
            opacity: 1;
        }
        .sidebar-wrapper .logo-details .logo-img {
            height: 32px;
            width: 32px;
            margin-right: 0;
            object-fit: contain;
            display: inline-block;
        }
        .sidebar-wrapper .nav-list {
            margin-top: 20px;
            height: 100%;
            padding: 0;
        }
        .sidebar-wrapper li {
            position: relative;
            margin: 8px 0;
            list-style: none;
        }
        .sidebar-wrapper li .tooltip {
            position: absolute;
            top: -20px;
            left: calc(100% + 15px);
            z-index: 100;
            background: #fff;
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.3);
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 15px;
            font-weight: 400;
            opacity: 0;
            white-space: nowrap;
            pointer-events: none;
            transition: 0s;
        }
        .sidebar-wrapper li:hover .tooltip {
            opacity: 1;
            pointer-events: auto;
            transition: all 0.4s ease;
            top: 50%;
            transform: translateY(-50%);
        }
        .sidebar-wrapper.open li .tooltip {
            display: none;
        }
        .sidebar-wrapper li a {
            display: flex;
            height: 100%;
            width: 100%;
            border-radius: 12px;
            align-items: center;
            text-decoration: none;
            transition: all 0.4s ease;
            background: transparent;
        }
        .sidebar-wrapper li a:hover, .sidebar-wrapper li a.active {
            background: #0069d9;
        }
        .sidebar-wrapper li a .links_name {
            color: #fff;
            font-size: 15px;
            font-weight: 400;
            white-space: nowrap;
            opacity: 0;
            pointer-events: none;
            transition: 0.4s;
        }
        .sidebar-wrapper.open li a .links_name {
            opacity: 1;
            pointer-events: auto;
        }
        .sidebar-wrapper li a:hover .links_name,
        .sidebar-wrapper li a:hover i,
        .sidebar-wrapper li a.active .links_name,
        .sidebar-wrapper li a.active i {
            color: #fff;
        }
        .sidebar-wrapper i {
            color: #fff;
            height: 50px;
            min-width: 50px;
            font-size: 18px;
            text-align: center;
            line-height: 50px;
        }

        /* ========================================
         * UTILITY CLASSES
         * ======================================== */
        .bg-info { background: #17a2b8 !important; color: #fff; }
        .bg-danger { background: #dc3545 !important; color: #fff; }
        .bg-success { background: #28a745 !important; color: #fff; }
        .bg-warning { background: #ffc107 !important; color: #212529; }

        /* ========================================
         * TABLE STYLES
         * ======================================== */
        .badge-primary { background: #007BFF; font-size: 0.85rem; }
        .table thead th, .table th {
            background-color: #f8f9fa;
            border-bottom: 2px solid #dee2e6;
            color: #495057;
            font-weight: 600;
            text-align: center;
            vertical-align: middle;
            padding: 0.75rem;
            font-size: 0.875rem;
        }
        .table tbody td, .table td {
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

        /* ========================================
         * BUTTON STYLES
         * ======================================== */
        .btn, .btn-sm, .btn-info, .btn-primary, .btn-warning, .btn-danger {
            font-size: 0.89rem !important;
            padding: 0.18rem 0.55rem !important;
            border-radius: 0.2rem !important;
            line-height: 1.2 !important;
        }
        .btn i { font-size: 0.98em; margin-right: 2px; }
        .btn:last-child i { margin-right: 0; }
        .btn-group .btn { margin-right: 2px; }

        /* ========================================
         * TYPOGRAPHY
         * ======================================== */
        h1, h5 { font-size: 1.15rem; font-weight: 600; }

        /* ========================================
         * RESPONSIVE DESIGN
         * ======================================== */
        @media (max-width: 991.98px) {
            .sidebar-wrapper, .main-header { left: 0; }
            .content-wrapper, .sidebar-collapse .content-wrapper { margin-left: 0 !important; padding-top: 70px; }
            .info-widget { min-height: 120px; padding: 1rem 1rem 0.5rem 1rem; }
            .info-widget .widget-icon { width: 38px; height: 38px; font-size: 1.1rem; }
            .info-widget .widget-value { font-size: 1.3rem; }
            .info-widget .widget-label { font-size: 0.98rem; }
            .info-widget .widget-link { font-size: 0.97rem; padding: 0.5rem 1rem 0.1rem 1rem; }
        }

        /* ========================================
         * HEADER STYLES
         * ======================================== */
        .main-header {
            position: fixed;
            top: 0;
            left: 78px;
            right: 0;
            height: 56px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            z-index: 1100;
            display: flex;
            align-items: center;
            padding: 0 0.75rem 0 0.5rem;
            transition: left 0.5s cubic-bezier(.77,0,.18,1), width 0.5s cubic-bezier(.77,0,.18,1), background-color 0.3s, color 0.3s;
            font-size: 15px;
            width: calc(100% - 78px);
        }
        .sidebar-wrapper.open ~ .content-wrapper .main-header,
        .sidebar-wrapper.open ~ .main-header {
            left: 250px;
            width: calc(100% - 250px);
        }
        body.dark-mode .main-header {
            background: #2a2f3a !important;
            color: #e0e0e0 !important;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2) !important;
        }

        /* ========================================
         * HEADER COMPONENTS
         * ======================================== */
        .bento-toggle-btn {
            font-size: 1.5rem !important;
            color: #007BFF !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 35px !important;
            height: 35px !important;
            margin-right: 0 !important;
            border: none !important;
            background: transparent !important;
            cursor: pointer !important;
            outline: none !important;
            box-shadow: none !important;
        }
        .bento-toggle-btn:hover {
            background: transparent !important;
            border-radius: 0 !important;
        }
        .bento-toggle-btn:focus {
            outline: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }
        .bento-toggle-btn:active {
            outline: none !important;
            box-shadow: none !important;
            background: transparent !important;
        }
        .app-title {
            font-size: 1.05rem !important;
            font-weight: 600 !important;
            color: #007BFF !important;
            letter-spacing: 0.5px !important;
            white-space: nowrap !important;
            margin-right: 2rem !important;
        }
        .main-header .text-center {
            font-size: 1.05rem !important;
            font-weight: 700 !important;
            letter-spacing: 0.5px !important;
            position: absolute !important;
            left: 0 !important;
            right: 0 !important;
            margin: auto !important;
            pointer-events: none !important;
            z-index: 0 !important;
            color: #007BFF !important;
            text-align: center !important;
        }
        .user-info {
            z-index: 1 !important;
            display: flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
        }

        /* ========================================
         * NOTIFICATION DROPDOWN
         * ======================================== */
        .dropdown-notif .btn {
            color: #007BFF !important;
            outline: none !important;
            box-shadow: none !important;
            border: none !important;
            background: transparent !important;
            padding: 0.5rem !important;
            border-radius: 6px !important;
            transition: all 0.2s ease !important;
        }
        .dropdown-notif .btn:hover {
            background: rgba(52, 58, 64, 0.1) !important;
        }
        .dropdown-notif .btn i {
            font-size: 16px !important;
        }
        .dropdown-notif .badge {
            top: 0px !important;
            right: 0px !important;
            font-size: 6px !important;
            font-weight: 700 !important;
            border-radius: 50% !important;
            width: 12px !important;
            height: 12px !important;
            border: 1.5px solid white !important;
        }
        .dropdown-notif .dropdown-menu {
            min-width: 320px !important;
            max-height: 400px !important;
            overflow-y: auto !important;
            scrollbar-width: thin !important;
            scrollbar-color: #cbd5e0 transparent !important;
        }
        .dropdown-notif .dropdown-item {
            display: flex;
            align-items: flex-start;
            gap: 0.75rem;
            color: #333 !important;
        }
        .dropdown-notif .dropdown-item i {
            margin-top: 0.25rem;
        }
        .dropdown-notif .dropdown-item > div > .font-weight-bold {
            font-size: 0.9rem;
            color: #333 !important;
        }
        .dropdown-notif .dropdown-item > div > .text-muted {
            font-size: 0.85rem;
            line-height: 1.3;
            color: #666 !important;
        }
        .dropdown-notif .dropdown-item.text-center {
            font-size: 0.9rem;
            font-weight: 500;
            color: #333 !important;
        }
        .notification-view-all {
            font-size: 0.9rem !important;
            font-weight: 500 !important;
            color: #000 !important;
            text-align: center !important;
            width: 100%;
            display: block;
            margin-left: auto !important;
            margin-right: auto !important;
            justify-content: center !important;
            align-items: center !important;
        }
        .notification-header {
            color: #333 !important;
            font-size: 0.9rem !important;
        }

        /* ========================================
         * RESPONSIVE HEADER
         * ======================================== */
        @media (max-width: 991.98px) {
            .main-header {
                left: 78px;
                width: calc(100% - 78px);
            }
            .sidebar-wrapper.open ~ .content-wrapper .main-header,
            .sidebar-wrapper.open ~ .main-header {
                left: 250px;
                width: calc(100% - 250px);
            }
        }

        /* ========================================
         * SIDEBAR ENHANCEMENTS
         * ======================================== */
        .sidebar-wrapper {
            overflow-y: auto;
            height: 100vh;
        }
        .logo-details {
            display: flex;
            align-items: center;
            height: 60px;
        }
        .logo-img {
            height: 32px;
            width: 32px;
            margin-right: 12px;
            object-fit: contain;
            display: block;
        }
        .logo_name {
            color: #fff;
            font-size: 20px;
            font-weight: 600;
            opacity: 0;
            transition: all 0.5s ease;
        }
        .sidebar-wrapper.open .logo_name {
            opacity: 1;
        }
        .sidebar-wrapper::-webkit-scrollbar {
            display: none;
        }
        .sidebar-wrapper {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        body.preload .sidebar-wrapper,
        body.preload .content-wrapper,
        body.preload .main-header {
            transition: none !important;
        }
        .sidebar-logo {
            min-width: 50px;
            text-align: center;
            margin-right: 12px;
        }

        /* ========================================
         * STATUS BADGES
         * ======================================== */
        .badge-status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .badge-status-tersedia {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .badge-status-habis {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .badge-status-hampirhabis {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        .badge-status-barumasuk {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .badge-status-tidakaktif {
            background-color: #e2e3e5;
            color: #383d41;
            border: 1px solid #d6d8db;
        }
        .badge-status-menunggu {
            background-color: #fff3cd;
            color: #856404;
            border: 1px solid #ffeaa7;
        }
        .badge-status-diproses {
            background-color: #d1ecf1;
            color: #0c5460;
            border: 1px solid #bee5eb;
        }
        .badge-status-selesai {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .badge-status-dibatalkan {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .badge-status-pending {
            background-color: #e2e3e5;
            color: #383d41;
            border: 1px solid #d6d8db;
        }
        .badge-status-retur {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .badge-status-dikirim {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .badge-status-ditolak {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        /* ========================================
         * TABLE COMPONENTS
         * ======================================== */
        .table-container {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
            margin-bottom: 1.5rem;
        }
        .table-header {
            background: #f8f9fa;
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }
        .table-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        .table-actions {
            display: flex;
            gap: 0.5rem;
            align-items: center;
            flex-wrap: wrap;
        }
        .table {
            width: 100%;
            margin-bottom: 0;
            background: #fff;
            border-collapse: collapse;
        }
        .table th {
            background: #f8f9fa;
            color: #333;
            font-weight: 600;
            padding: 12px 16px;
            border-bottom: 2px solid #dee2e6;
            text-align: left;
            vertical-align: middle;
            font-size: 14px;
        }
        .table td {
            padding: 12px 16px;
            border-bottom: 1px solid #dee2e6;
            vertical-align: middle;
            color: #333;
            font-size: 14px;
        }
        .table tbody tr:hover {
            background: #f8f9fa;
        }

        /* ========================================
         * SEARCH & FILTER COMPONENTS
         * ======================================== */
        .search-filter-container {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex-wrap: wrap;
            margin-bottom: 1rem;
        }
        .search-box {
            position: relative;
            min-width: 250px;
        }
        .search-box input {
            width: 100%;
            padding: 8px 12px 8px 35px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
        }
        .search-box i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #6c757d;
        }
        .filter-dropdown {
            min-width: 150px;
        }
        .filter-dropdown select {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 14px;
            background: #fff;
        }

        /* ========================================
         * PAGINATION COMPONENTS
         * ======================================== */
        .pagination-container {
            display: flex;
            justify-content: flex-end;
            align-items: flex-end;
            flex-wrap: wrap;
            gap: 0.5rem;
            position: relative;
        }
        .pagination {
            display: flex;
            gap: 0.25rem;
        }
        .pagination .btn {
            padding: 8px 12px;
            border: 1px solid #dee2e6;
            background: #fff;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
            transition: all 0.2s ease;
        }
        .pagination .btn:hover {
            background: #e9ecef;
            border-color: #adb5bd;
        }
        .pagination .btn.active {
            background: #007bff;
            color: #fff;
            border-color: #007bff;
        }
        .pagination .btn:disabled {
            background: #f8f9fa;
            color: #6c757d;
            cursor: not-allowed;
        }

        /* ========================================
         * TABLE BUTTONS
         * ======================================== */
        .table-btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }
        .table-btn.btn-sm {
            padding: 4px 8px;
            font-size: 11px;
        }
        .table-btn.btn-primary {
            background: #007bff;
            color: #fff;
        }
        .table-btn.btn-primary:hover {
            background: #0056b3;
        }
        .table-btn.btn-success {
            background: #28a745;
            color: #fff;
        }
        .table-btn.btn-success:hover {
            background: #1e7e34;
        }
        .table-btn.btn-danger {
            background: #dc3545;
            color: #fff;
        }
        .table-btn.btn-danger:hover {
            background: #c82333;
        }
        .table-btn.btn-warning {
            background: #ffc107;
            color: #212529;
        }
        .table-btn.btn-warning:hover {
            background: #e0a800;
        }
        .table-btn.btn-info {
            background: #17a2b8;
            color: #fff;
        }
        .table-btn.btn-info:hover {
            background: #138496;
        }
        .table-btn.btn-secondary {
            background: #6c757d;
            color: #fff;
        }
        .table-btn.btn-secondary:hover {
            background: #545b62;
        }

        /* ========================================
         * MODAL COMPONENTS
         * ======================================== */
        .modal {
            display: none;
            position: fixed;
            z-index: 1050;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        .modal.show {
            display: block;
        }
        .modal-content {
            background: #fff;
            margin: 5% auto;
            padding: 0;
            border: none;
            border-radius: 8px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.3);
            animation: modalSlideIn 0.3s ease;
        }
        .modal-header {
            padding: 1rem 1.5rem;
            border-bottom: 1px solid #dee2e6;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .modal-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        .modal-close {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: #6c757d;
            padding: 0;
            width: 30px;
            height: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .modal-close:hover {
            color: #333;
        }
        .modal-body {
            padding: 1.5rem;
        }
        .modal-footer {
            padding: 1rem 1.5rem;
            border-top: 1px solid #dee2e6;
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }
        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ========================================
         * EXPORT OPTIONS
         * ======================================== */
        .export-options {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
            gap: 1rem;
            margin: 1rem 0;
        }
        .export-option {
            padding: 1rem;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            text-align: center;
            cursor: pointer;
            transition: all 0.2s ease;
            background: #fff;
        }
        .export-option:hover {
            border-color: #007bff;
            background: #f8f9fa;
        }
        .export-option.selected {
            border-color: #007bff;
            background: #e3f2fd;
        }
        .export-option i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            display: block;
        }
        .export-option.excel i {
            color: #217346;
        }
        .export-option.pdf i {
            color: #dc3545;
        }
        .export-option.csv i {
            color: #6c757d;
        }

        /* ========================================
         * GLOBAL CARD STYLES
         * Card dengan lebar lebih dan jarak yang sama
         * ======================================== */
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            background: #fff;
            margin-bottom: 1rem;
        }
        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-2px);
        }
        .card-header {
            background: #fff;
            border-bottom: 1px solid #e9ecef;
            padding: 1.25rem 1.5rem;
            border-radius: 12px 12px 0 0;
        }
        .card-body {
            padding: 1.5rem;
        }
        .card-footer {
            background: #fff;
            border-top: 1px solid #e9ecef;
            padding: 1rem 1.5rem;
            border-radius: 0 0 12px 12px;
        }

        /* ========================================
         * DASHBOARD LAYOUT STYLES
         * Layout khusus untuk dashboard dengan jarak yang sama
         * ======================================== */
        .dashboard-admin {
            padding: 0 1rem;
        }
        .dashboard-admin .row {
            margin-left: -0.5rem;
            margin-right: -0.5rem;
        }
        .dashboard-admin .col-12,
        .dashboard-admin .col-md-6,
        .dashboard-admin .col-xl-3,
        .dashboard-admin .col-lg-8,
        .dashboard-admin .col-lg-4 {
            padding-left: 0.5rem;
            padding-right: 0.5rem;
        }
        .tight-widgets {
            margin-left: -0.25rem;
            margin-right: -0.25rem;
        }
        .tight-widgets .col-12,
        .tight-widgets .col-md-6,
        .tight-widgets .col-xl-3 {
            padding-left: 0.25rem;
            padding-right: 0.25rem;
        }

        /* ========================================
         * RESPONSIVE DASHBOARD
         * ======================================== */
        @media (max-width: 1200px) {
            .dashboard-admin {
                padding: 0 0.75rem;
            }
        }
        @media (max-width: 768px) {
            .dashboard-admin {
                padding: 0 0.5rem;
            }
            .dashboard-admin .row {
                margin-left: -0.25rem;
                margin-right: -0.25rem;
            }
            .dashboard-admin .col-12,
            .dashboard-admin .col-md-6,
            .dashboard-admin .col-xl-3,
            .dashboard-admin .col-lg-8,
            .dashboard-admin .col-lg-4 {
                padding-left: 0.25rem;
                padding-right: 0.25rem;
            }
        }
    </style>
    <?= $this->renderSection('head') ?>
</head>

<!-- ========================================
     BODY SECTION
     ======================================== -->
<body class="layout-fixed preload">
    <div class="wrapper">
        <!-- ========================================
             SIDEBAR SECTION
             ======================================== -->
        <div class="sidebar-wrapper">
            <?php
            // ========================================
            //  SIDEBAR SESUAI ROLE USER
            // ========================================
            $role = session('role') ?? 'admin';
            if ($role === 'admin') {
                echo $this->include('components/sidebar_admin');
            } else {
                echo $this->include('components/sidebar_user');
            }
            ?>
        </div>

        <!-- ========================================
             CONTENT SECTION
             ======================================== -->
        <div class="content-wrapper" id="contentWrapper">
            <?= $this->include('components/header') ?>
            <?= $this->renderSection('content') ?>
        </div>
    </div>
    
    <!-- ========================================
         HEADER SCRIPTS START
         (JavaScript khusus header.php)
         ======================================== -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar-wrapper');
            const sidebarToggle = document.getElementById('sidebarToggle');

            // ========================================
            //  SIDEBAR TOGGLE FUNCTION
            // ========================================
            function toggleSidebar() {
                const isOpen = sidebar.classList.toggle('open');
                localStorage.setItem('vstock-sidebar-open', isOpen);
            }

            // Event listener untuk tombol toggle
            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', toggleSidebar);
            }

            // ========================================
            //  LOAD SIDEBAR STATE
            // ========================================
            const savedState = localStorage.getItem('vstock-sidebar-open');
            
            // Defaultnya expand, kecuali secara eksplisit disimpan sebagai 'false'
            if (savedState !== 'false' && sidebar) {
                sidebar.classList.add('open');
            } else if (sidebar) {
                sidebar.classList.remove('open');
            }
            
            // ========================================
            //  DROPDOWN NOTIFICATION HANDLER
            // ========================================
            $('.dropdown-notif .dropdown-menu').on('click', function(e) {
                e.stopPropagation();
            });
        });

        // ========================================
        //  REMOVE PRELOAD CLASS
        // ========================================
        window.addEventListener('load', () => {
            document.body.classList.remove('preload');
        });
    </script>
    <!-- ========================================
         HEADER SCRIPTS END
         ======================================== -->
    
    <!-- ========================================
         GLOBAL SCRIPTS (JavaScript yang digunakan di seluruh aplikasi)
         File: app/Views/partials/scripts.php
         ======================================== -->
    <?= $this->include('partials/scripts') ?>
    
    <!-- ========================================
         PAGE SPECIFIC CSS (CSS khusus halaman)
         ======================================== -->
    <?php
    if (isset($page_css) && is_array($page_css)) {
        foreach ($page_css as $css) {
            echo '<link rel="stylesheet" href="' . base_url($css) . '">' . "\n";
        }
    }
    ?>
    
    <!-- ========================================
         PAGE SPECIFIC SCRIPTS (JavaScript khusus halaman)
         ======================================== -->
    <?php
    if (isset($page_js) && is_array($page_js)) {
        foreach ($page_js as $js) {
            echo '<script src="' . base_url($js) . '"></script>' . "\n";
        }
    }
    ?>
    
    <!-- ========================================
         ADDITIONAL PAGE SCRIPTS (Script tambahan dari view)
         ======================================== -->
    <?= $this->renderSection('scripts') ?>
</body>
</html> 