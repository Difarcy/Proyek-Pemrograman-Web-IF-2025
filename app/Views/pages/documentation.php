<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Documentation - Inventrack</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        .hero-title {
            font-family: 'Brush Script MT', cursive, sans-serif;
            font-size: 2.8rem;
            font-weight: bold;
        }
        .btn-inventrack {
            background: #8f5aff;
            border: none;
        }
        .btn-inventrack:hover {
            background: #7a4fd6;
        }
        .doc-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }
        .doc-card:hover {
            transform: translateY(-5px);
        }
        .doc-icon {
            font-size: 2rem;
            color: #8f5aff;
            margin-bottom: 1rem;
        }
        .sidebar {
            position: sticky;
            top: 2rem;
        }
        .sidebar-link {
            color: #333;
            text-decoration: none;
            display: block;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            margin-bottom: 0.5rem;
            transition: all 0.3s ease;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: #8f5aff;
            color: white;
        }
        pre {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
            margin: 1rem 0;
        }
        code {
            color: #8f5aff;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand fw-bold" href="<?= base_url() ?>">Inventrack</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('help-center') ?>">Help Center</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('documentation') ?>">Documentation</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('api-reference') ?>">API Reference</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('community') ?>">Community</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('contact') ?>">Contact Us</a></li>
                </ul>
                <div>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-link">Sign in</a>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-inventrack text-white ms-2">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="hero-title">Documentation</h1>
                <p class="lead">Comprehensive guides and tutorials to help you get the most out of Inventrack</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar">
                    <h5 class="mb-3">Contents</h5>
                    <a href="#getting-started" class="sidebar-link active">Getting Started</a>
                    <a href="#inventory-management" class="sidebar-link">Inventory Management</a>
                    <a href="#reports-analytics" class="sidebar-link">Reports & Analytics</a>
                    <a href="#settings-configuration" class="sidebar-link">Settings & Configuration</a>
                    <a href="#api-integration" class="sidebar-link">API Integration</a>
                    <a href="#security" class="sidebar-link">Security</a>
                </div>
            </div>

            <!-- Documentation Content -->
            <div class="col-md-9">
                <!-- Getting Started -->
                <section id="getting-started" class="mb-5">
                    <h2 class="mb-4">Getting Started</h2>
                    <div class="doc-card p-4 bg-white">
                        <h3>Quick Start Guide</h3>
                        <p>Welcome to Inventrack! This guide will help you get started with our inventory management system.</p>
                        
                        <h4 class="mt-4">1. Installation</h4>
                        <p>To get started with Inventrack, follow these steps:</p>
                        <pre><code>composer require inventrack/core
php spark migrate
php spark db:seed</code></pre>

                        <h4 class="mt-4">2. Configuration</h4>
                        <p>Configure your settings in the <code>app/Config/App.php</code> file:</p>
                        <pre><code>public $baseURL = 'http://your-domain.com/';
public $defaultLocale = 'en';
public $timezone = 'UTC';</code></pre>
                    </div>
                </section>

                <!-- Inventory Management -->
                <section id="inventory-management" class="mb-5">
                    <h2 class="mb-4">Inventory Management</h2>
                    <div class="doc-card p-4 bg-white">
                        <h3>Managing Your Inventory</h3>
                        <p>Learn how to effectively manage your inventory with Inventrack's powerful features.</p>
                        
                        <h4 class="mt-4">Adding Products</h4>
                        <p>To add a new product to your inventory:</p>
                        <ol>
                            <li>Navigate to Inventory > Add Product</li>
                            <li>Fill in the product details</li>
                            <li>Upload product images</li>
                            <li>Set pricing and stock levels</li>
                            <li>Click Save</li>
                        </ol>

                        <h4 class="mt-4">Stock Management</h4>
                        <p>Track your stock levels and set up automatic reorder points:</p>
                        <pre><code>// Example of setting reorder point
$product->setReorderPoint(100);
$product->setReorderQuantity(50);</code></pre>
                    </div>
                </section>

                <!-- Reports & Analytics -->
                <section id="reports-analytics" class="mb-5">
                    <h2 class="mb-4">Reports & Analytics</h2>
                    <div class="doc-card p-4 bg-white">
                        <h3>Generating Reports</h3>
                        <p>Create and customize reports to gain insights into your inventory.</p>
                        
                        <h4 class="mt-4">Available Reports</h4>
                        <ul>
                            <li>Inventory Status Report</li>
                            <li>Sales Analysis</li>
                            <li>Stock Movement Report</li>
                            <li>Custom Reports</li>
                        </ul>

                        <h4 class="mt-4">Exporting Data</h4>
                        <p>Export your reports in various formats:</p>
                        <pre><code>// Example of exporting to CSV
$report->export('csv', 'inventory_report.csv');</code></pre>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p class="mb-0">&copy; 2025 Inventrack. All rights reserved.</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <a href="#" class="text-white me-3">Privacy Policy</a>
                    <a href="#" class="text-white me-3">Terms of Service</a>
                    <a href="#" class="text-white">Cookie Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 