<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>API Reference - Inventrack</title>
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
        .api-card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            transition: transform 0.3s ease;
        }
        .api-card:hover {
            transform: translateY(-5px);
        }
        pre {
            background: #f8f9fa;
            padding: 1rem;
            border-radius: 5px;
        }
        .method {
            padding: 0.25rem 0.5rem;
            border-radius: 3px;
            font-weight: bold;
        }
        .method.get { background: #e3f2fd; color: #1976d2; }
        .method.post { background: #e8f5e9; color: #2e7d32; }
        .method.put { background: #fff3e0; color: #f57c00; }
        .method.delete { background: #ffebee; color: #c62828; }
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
                    <li class="nav-item"><a class="nav-link active" href="<?= base_url('api-reference') ?>">API Reference</a></li>
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

    <!-- Main Content -->
    <div class="container py-5">
        <h1 class="hero-title mb-4">API Reference</h1>
        <p class="lead mb-5">Integrate Inventrack with your applications using our RESTful API.</p>

        <!-- Authentication -->
        <section class="mb-5">
            <h2>Authentication</h2>
            <div class="api-card p-4 bg-white">
                <p>All API requests require authentication using an API key. Include your API key in the request header:</p>
                <pre><code>Authorization: Bearer YOUR_API_KEY</code></pre>
                <p>You can generate an API key from your account settings.</p>
            </div>
        </section>

        <!-- Endpoints -->
        <section class="mb-5">
            <h2>Endpoints</h2>
            
            <!-- Inventory Items -->
            <div class="api-card p-4 bg-white">
                <h3>Inventory Items</h3>
                <div class="mb-4">
                    <span class="method get">GET</span>
                    <code>/api/v1/items</code>
                    <p class="mt-2">Retrieve a list of inventory items</p>
                    <pre><code>{
    "items": [
        {
            "id": 1,
            "name": "Product Name",
            "quantity": 100,
            "price": 29.99
        }
    ]
}</code></pre>
                </div>

                <div class="mb-4">
                    <span class="method post">POST</span>
                    <code>/api/v1/items</code>
                    <p class="mt-2">Create a new inventory item</p>
                    <pre><code>{
    "name": "New Product",
    "quantity": 50,
    "price": 19.99
}</code></pre>
                </div>
            </div>

            <!-- Reports -->
            <div class="api-card p-4 bg-white">
                <h3>Reports</h3>
                <div class="mb-4">
                    <span class="method get">GET</span>
                    <code>/api/v1/reports/inventory</code>
                    <p class="mt-2">Generate inventory reports</p>
                    <pre><code>{
    "report": {
        "total_items": 150,
        "total_value": 15000.00,
        "low_stock_items": 5
    }
}</code></pre>
                </div>
            </div>
        </section>

        <!-- Rate Limiting -->
        <section class="mb-5">
            <h2>Rate Limiting</h2>
            <div class="api-card p-4 bg-white">
                <p>API requests are limited to 1000 requests per hour per API key. The current rate limit status is included in the response headers:</p>
                <pre><code>X-RateLimit-Limit: 1000
X-RateLimit-Remaining: 999
X-RateLimit-Reset: 1612345678</code></pre>
            </div>
        </section>
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