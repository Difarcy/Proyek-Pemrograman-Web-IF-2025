<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Contact Us - Inventrack</title>
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
        .contact-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        .contact-card:hover {
            transform: translateY(-5px);
        }
        .contact-icon {
            font-size: 2rem;
            color: #8f5aff;
            margin-bottom: 1rem;
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
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('documentation') ?>">Documentation</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('api-reference') ?>">API Reference</a></li>
                    <li class="nav-item"><a class="nav-link" href="<?= base_url('community') ?>">Community</a></li>
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('contact') ?>">Contact Us</a></li>
                </ul>
                <div>
                    <a href="<?= base_url('login') ?>" class="btn btn-link">Sign in</a>
                    <a href="<?= base_url('login') ?>" class="btn btn-inventrack text-white ms-2">Get Started</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="hero-title">Contact Us</h1>
                <p class="lead">We're here to help. Get in touch with our support team.</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5">
        <div class="row">
            <!-- Contact Information -->
            <div class="col-md-4 mb-4">
                <div class="contact-card p-4 bg-white h-100">
                    <h3 class="mb-4">Contact Information</h3>
                    
                    <div class="mb-4">
                        <i class="fas fa-envelope contact-icon"></i>
                        <h5>Email</h5>
                        <p class="text-muted">support@inventrack.com</p>
                    </div>

                    <div class="mb-4">
                        <i class="fas fa-phone contact-icon"></i>
                        <h5>Phone</h5>
                        <p class="text-muted">+1 (555) 123-4567</p>
                    </div>

                    <div class="mb-4">
                        <i class="fas fa-clock contact-icon"></i>
                        <h5>Business Hours</h5>
                        <p class="text-muted">Monday - Friday: 9:00 AM - 6:00 PM EST</p>
                    </div>

                    <div>
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <h5>Office Location</h5>
                        <p class="text-muted">123 Tech Street<br>San Francisco, CA 94107<br>United States</p>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="col-md-8">
                <div class="contact-card p-4 bg-white">
                    <h3 class="mb-4">Send us a Message</h3>
                    <form>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" class="form-control" id="subject" required>
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select" id="category" required>
                                <option value="">Select a category</option>
                                <option value="technical">Technical Support</option>
                                <option value="billing">Billing & Account</option>
                                <option value="sales">Sales Inquiry</option>
                                <option value="feedback">Feedback</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-inventrack text-white">Send Message</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- FAQ Section -->
        <div class="row mt-5">
            <div class="col-12">
                <div class="contact-card p-4 bg-white">
                    <h3 class="mb-4">Frequently Asked Questions</h3>
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    What is your typical response time?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We typically respond to all inquiries within 24 hours during business days. For urgent technical issues, we recommend checking our Help Center or Community forums for immediate assistance.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Do you offer 24/7 support?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we offer 24/7 support for enterprise customers. Standard support is available during business hours, but our Help Center and Community forums are accessible 24/7.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    How can I track my support ticket?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Once you submit a support ticket, you'll receive a confirmation email with a ticket number. You can track your ticket status through your account dashboard or by replying to the confirmation email.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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