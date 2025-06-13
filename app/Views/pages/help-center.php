<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Help Center - Inventrack</title>
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
        .feature-icon {
            font-size: 2.5rem;
            color: #8f5aff;
            margin-bottom: 1rem;
        }
        .help-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }
        .help-card:hover {
            transform: translateY(-5px);
        }
        .search-box {
            max-width: 600px;
            margin: 0 auto;
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
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('help-center') ?>">Help Center</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('documentation') ?>">Documentation</a></li>
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
                <h1 class="hero-title">How can we help you?</h1>
                <p class="lead">Find answers to common questions and learn how to use Inventrack effectively</p>
                <div class="search-box mt-4">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search for help...">
                        <button class="btn btn-inventrack text-white">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-5">
        <div class="container">
            <!-- Getting Started -->
            <h2 class="mb-4">Getting Started</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="help-card p-4 bg-white">
                        <i class="fas fa-rocket feature-icon"></i>
                        <h3>Quick Start Guide</h3>
                        <p>Learn the basics of Inventrack and get started in minutes.</p>
                        <a href="#" class="btn btn-link p-0">Read more →</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="help-card p-4 bg-white">
                        <i class="fas fa-user-plus feature-icon"></i>
                        <h3>Account Setup</h3>
                        <p>Set up your account and configure your preferences.</p>
                        <a href="#" class="btn btn-link p-0">Read more →</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="help-card p-4 bg-white">
                        <i class="fas fa-cog feature-icon"></i>
                        <h3>Basic Settings</h3>
                        <p>Configure your inventory settings and preferences.</p>
                        <a href="#" class="btn btn-link p-0">Read more →</a>
                    </div>
                </div>
            </div>

            <!-- Common Questions -->
            <h2 class="mb-4 mt-5">Common Questions</h2>
            <div class="accordion" id="faqAccordion">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            How do I add new inventory items?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            To add new inventory items, navigate to the Inventory section and click the "Add New Item" button. Fill in the required information and click "Save".
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            How do I generate reports?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Go to the Reports section, select the type of report you want to generate, set your parameters, and click "Generate Report".
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            How do I set up alerts?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            Navigate to Settings > Alerts, and configure your preferred alert conditions and notification methods.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Support -->
            <div class="text-center mt-5">
                <h2>Still need help?</h2>
                <p class="lead">Our support team is here to help you</p>
                <a href="<?= base_url('contact') ?>" class="btn btn-inventrack text-white">Contact Support</a>
            </div>
        </div>
    </section>

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