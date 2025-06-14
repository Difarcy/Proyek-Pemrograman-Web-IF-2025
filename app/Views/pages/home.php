<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventrack – Smart Inventory, Seamless Tracking</title>
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
        html {
            scroll-behavior: smooth;
        }
        section {
            min-height: 100vh;
            padding: 80px 0;
        }
        .section-title {
            font-size: 2.5rem;
            margin-bottom: 2rem;
            text-align: center;
        }
        .feature-card {
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
            height: 100%;
        }
        .feature-card:hover {
            transform: translateY(-5px);
        }
        .feature-icon {
            font-size: 2.5rem;
            color: #8f5aff;
            margin-bottom: 1rem;
        }
        .footer {
            background: #1a1a1a;
            color: #fff;
            padding: 4rem 0 2rem;
        }
        .footer-title {
            color: #fff;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
        }
        .footer-link {
            color: #b3b3b3;
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            transition: color 0.3s ease;
        }
        .footer-link:hover {
            color: #fff;
        }
        .social-icon {
            color: #fff;
            font-size: 1.5rem;
            margin-right: 1rem;
            transition: color 0.3s ease;
        }
        .social-icon:hover {
            color: #8f5aff;
        }
        .footer-bottom {
            border-top: 1px solid #333;
            padding-top: 2rem;
            margin-top: 3rem;
        }
        .stat-card {
            background: #fff;
            border-radius: 10px;
            padding: 1.5rem;
            text-align: center;
            margin-bottom: 1rem;
        }
        .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #8f5aff;
        }
        .navbar-nav .nav-link {
            position: relative;
            transition: color 0.3s, transform 0.2s;
        }
        .navbar-nav .nav-link::after {
            content: '';
            display: block;
            position: absolute;
            left: 0;
            bottom: 0;
            width: 0;
            height: 3px;
            background: #8f5aff;
            border-radius: 2px;
            transition: width 0.3s;
        }
        .navbar-nav .nav-link:hover::after, .navbar-nav .nav-link:focus::after {
            width: 100%;
        }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link:focus {
            color: #8f5aff !important;
            background: none;
            transform: scale(1.08);
        }
        .btn-inventrack, .btn-link {
            transition: background 0.3s, color 0.3s, box-shadow 0.3s, transform 0.2s;
        }
        .btn-inventrack:hover, .btn-inventrack:focus {
            background: #7a4fd6;
            color: #fff;
            box-shadow: 0 4px 16px rgba(143,90,255,0.15);
            transform: scale(1.05);
        }
        .btn-link:hover, .btn-link:focus {
            color: #8f5aff;
            text-decoration: underline;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Inventrack</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item"><a class="nav-link" href="<?= base_url() ?>">Home</a></li> -->
                    <li class="nav-item"><a class="nav-link" href="#overview">Overview</a></li>
                    <li class="nav-item"><a class="nav-link" href="#inventory">Inventory</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#reports">Reports</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
                <div>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-link">Sign in</a>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-inventrack text-white ms-2">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Overview Section -->
    <section id="overview" class="py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 text-start">
                    <h1 class="hero-title mb-3">
                        Finally, a modern inventory system
                    </h1>
                    <p class="lead mb-4">
                        Take full control of your inventory with Inventrack. Effortlessly monitor stock levels, streamline your operations, and gain instant insights—anytime, anywhere. Experience smarter inventory management designed for growing businesses.
                    </p>
                    <a href="<?= base_url('auth/login') ?>" class="btn btn-inventrack text-white px-4">Get Started</a>
                </div>
                <div class="col-md-6 text-center">
                    <img src="/assets/gambar-beranda.jpg" alt="Inventrack Dashboard" class="img-fluid rounded" style="max-height:560px;object-fit:cover;margin-top:32px;">
                </div>
            </div>
        </div>
    </section>

    <!-- Inventory Section -->
    <section id="inventory" class="bg-light">
        <div class="container">
            <h2 class="section-title">Inventory Management</h2>
            <div class="row mb-5">
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-boxes feature-icon"></i>
                        <div class="stat-number">10K+</div>
                        <p>Items Tracked</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-warehouse feature-icon"></i>
                        <div class="stat-number">500+</div>
                        <p>Warehouses</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-sync feature-icon"></i>
                        <div class="stat-number">99.9%</div>
                        <p>Accuracy Rate</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="stat-card">
                        <i class="fas fa-users feature-icon"></i>
                        <div class="stat-number">1K+</div>
                        <p>Active Users</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-card bg-white">
                        <i class="fas fa-chart-line feature-icon"></i>
                        <h3>Real-time Tracking</h3>
                        <p>Monitor your inventory levels in real-time with our intuitive dashboard. Get instant updates on stock movements and alerts for low inventory.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-card bg-white">
                        <i class="fas fa-tags feature-icon"></i>
                        <h3>Smart Organization</h3>
                        <p>Easily categorize and organize your inventory with customizable tags and categories. Find what you need, when you need it.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features">
        <div class="container">
            <h2 class="section-title">Key Features</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card bg-white">
                        <i class="fas fa-bell feature-icon"></i>
                        <h3>Automated Alerts</h3>
                        <p>Set up custom alerts for low stock, expiring items, and important inventory events.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card bg-white">
                        <i class="fas fa-mobile-alt feature-icon"></i>
                        <h3>Mobile Access</h3>
                        <p>Access your inventory from anywhere with our mobile-friendly interface.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card bg-white">
                        <i class="fas fa-barcode feature-icon"></i>
                        <h3>Barcode Support</h3>
                        <p>Scan and track items easily with built-in barcode support.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Reports Section -->
    <section id="reports" class="bg-light">
        <div class="container">
            <h2 class="section-title">Comprehensive Reports</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-card bg-white">
                        <i class="fas fa-chart-bar feature-icon"></i>
                        <h3>Analytics Dashboard</h3>
                        <p>Get detailed insights into your inventory performance with customizable reports and analytics.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-card bg-white">
                        <i class="fas fa-file-export feature-icon"></i>
                        <h3>Export Options</h3>
                        <p>Export your data in various formats for easy sharing and analysis.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="bg-light">
        <div class="container">
            <h2 class="section-title">About Us</h2>
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="feature-card bg-white">
                        <i class="fas fa-building feature-icon"></i>
                        <h3>Our Story</h3>
                        <p>Inventrack was founded with a simple mission: to make inventory management easier and more efficient for businesses of all sizes. Our team of experts combines years of industry experience with cutting-edge technology to deliver a solution that truly makes a difference.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-card bg-white">
                        <i class="fas fa-bullseye feature-icon"></i>
                        <h3>Our Mission</h3>
                        <p>We're committed to helping businesses streamline their inventory processes, reduce costs, and make better decisions through real-time data and insights. Our platform is designed to grow with your business, adapting to your needs as you expand.</p>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-4">
                    <div class="feature-card bg-white">
                        <i class="fas fa-users feature-icon"></i>
                        <h3>Our Team</h3>
                        <p>A dedicated team of professionals committed to your success, providing support and expertise every step of the way.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card bg-white">
                        <i class="fas fa-handshake feature-icon"></i>
                        <h3>Our Values</h3>
                        <p>Integrity, innovation, and customer success drive everything we do. We believe in building lasting relationships with our clients.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card bg-white">
                        <i class="fas fa-chart-line feature-icon"></i>
                        <h3>Our Growth</h3>
                        <p>From startups to enterprises, we've helped thousands of businesses optimize their inventory management processes.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <h2 class="section-title">Get in Touch</h2>
            <div class="row">
                <div class="col-md-6">
                    <div class="feature-card bg-white">
                        <h3>Contact Information</h3>
                        <p class="mb-4">Have questions? We're here to help. Reach out to us through any of these channels:</p>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt feature-icon me-3"></i>
                            <div>
                                <h5 class="mb-0">Address</h5>
                                <p class="mb-0">Jl. Raya Pangalengan No. 123<br>Pangalengan, Bandung 40378</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-phone feature-icon me-3"></i>
                            <div>
                                <h5 class="mb-0">Phone</h5>
                                <p class="mb-0">+62 21 727 0003</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-envelope feature-icon me-3"></i>
                            <div>
                                <h5 class="mb-0">Email</h5>
                                <p class="mb-0">inventrack@ui.ac.id</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="feature-card bg-white">
                        <h3>Send us a Message</h3>
                        <form>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Your Name" required>
                            </div>
                            <div class="mb-3">
                                <input type="email" class="form-control" placeholder="Your Email" required>
                            </div>
                            <div class="mb-3">
                                <input type="text" class="form-control" placeholder="Subject" required>
                            </div>
                            <div class="mb-3">
                                <textarea class="form-control" rows="4" placeholder="Your Message" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-inventrack text-white w-100">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="footer-title">About Inventrack</h5>
                    <p class="text-white">Smart inventory management solution for modern businesses. Streamline your operations and gain real-time insights.</p>
                    <div class="mt-4">
                        <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="footer-title">Quick Links</h5>
                    <a href="#overview" class="footer-link">Overview</a>
                    <a href="#inventory" class="footer-link">Inventory</a>
                    <a href="#features" class="footer-link">Features</a>
                    <a href="#reports" class="footer-link">Reports</a>
                    <a href="#about" class="footer-link">About</a>
                    <a href="#contact" class="footer-link">Contact</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="footer-title">Support</h5>
                    <a href="<?= base_url('help-center') ?>" class="footer-link">Help Center</a>
                    <a href="<?= base_url('documentation') ?>" class="footer-link">Documentation</a>
                    <a href="<?= base_url('api-reference') ?>" class="footer-link">API Reference</a>
                    <a href="<?= base_url('community') ?>" class="footer-link">Community</a>
                    <a href="<?= base_url('contact') ?>" class="footer-link">Contact Us</a>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-md-0">
                    <h5 class="footer-title">Contact</h5>
                    <p class="text-white">
                        <i class="fas fa-map-marker-alt me-2 text-white"></i> Jl. Raya Pangalengan No. 123<br>
                        Pangalengan, Bandung 40378
                    </p>
                    <p class="text-white">
                        <i class="fas fa-phone me-2 text-white"></i> +62 21 727 0003
                    </p>
                    <p class="text-white">
                        <i class="fas fa-envelope me-2 text-white"></i> inventrack@ui.ac.id
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-white mb-0">&copy; 2025 Inventrack. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="#" class="footer-link d-inline-block me-3">Privacy Policy</a>
                        <a href="#" class="footer-link d-inline-block me-3">Terms of Service</a>
                        <a href="#" class="footer-link d-inline-block">Cookie Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 