<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Community - Inventrack</title>
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
        .community-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }
        .community-card:hover {
            transform: translateY(-5px);
        }
        .topic-card {
            border-left: 4px solid #8f5aff;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
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
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('community') ?>">Community</a></li>
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
                <h1 class="hero-title">Join Our Community</h1>
                <p class="lead">Connect with other Inventrack users, share experiences, and get help</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container py-5">
        <!-- Community Stats -->
        <div class="row mb-5">
            <div class="col-md-3">
                <div class="community-card p-4 bg-white text-center">
                    <i class="fas fa-users feature-icon"></i>
                    <h3>10K+</h3>
                    <p class="text-muted">Community Members</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="community-card p-4 bg-white text-center">
                    <i class="fas fa-comments feature-icon"></i>
                    <h3>50K+</h3>
                    <p class="text-muted">Discussions</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="community-card p-4 bg-white text-center">
                    <i class="fas fa-lightbulb feature-icon"></i>
                    <h3>5K+</h3>
                    <p class="text-muted">Solutions</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="community-card p-4 bg-white text-center">
                    <i class="fas fa-star feature-icon"></i>
                    <h3>4.8/5</h3>
                    <p class="text-muted">User Rating</p>
                </div>
            </div>
        </div>

        <!-- Discussion Topics -->
        <h2 class="mb-4">Popular Topics</h2>
        <div class="row">
            <div class="col-md-8">
                <!-- Topic List -->
                <div class="community-card p-4 bg-white mb-3 topic-card">
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="User" class="user-avatar me-3">
                        <div class="flex-grow-1">
                            <h5 class="mb-1">How to optimize inventory management?</h5>
                            <p class="text-muted mb-0">Posted by John Doe • 2 hours ago</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary">15 replies</span>
                        </div>
                    </div>
                </div>

                <div class="community-card p-4 bg-white mb-3 topic-card">
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="User" class="user-avatar me-3">
                        <div class="flex-grow-1">
                            <h5 class="mb-1">Best practices for inventory tracking</h5>
                            <p class="text-muted mb-0">Posted by Jane Smith • 5 hours ago</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary">8 replies</span>
                        </div>
                    </div>
                </div>

                <div class="community-card p-4 bg-white mb-3 topic-card">
                    <div class="d-flex align-items-center">
                        <img src="https://via.placeholder.com/40" alt="User" class="user-avatar me-3">
                        <div class="flex-grow-1">
                            <h5 class="mb-1">API integration tips and tricks</h5>
                            <p class="text-muted mb-0">Posted by Mike Johnson • 1 day ago</p>
                        </div>
                        <div class="text-end">
                            <span class="badge bg-primary">23 replies</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="col-md-4">
                <div class="community-card p-4 bg-white">
                    <h4>Start a Discussion</h4>
                    <p>Have a question or want to share your experience? Start a new discussion!</p>
                    <a href="#" class="btn btn-inventrack text-white w-100">New Topic</a>
                </div>

                <div class="community-card p-4 bg-white mt-4">
                    <h4>Community Guidelines</h4>
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Be respectful</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Stay on topic</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Share knowledge</li>
                        <li class="mb-2"><i class="fas fa-check text-success me-2"></i>Help others</li>
                    </ul>
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