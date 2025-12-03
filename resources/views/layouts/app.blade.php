<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Fitkomove')</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        /* --- MINIMALIST GLOBAL THEME --- */
        :root {
            --primary: #FC5200;
            --primary-hover: #e04800;
            --text-primary: #1a1a1a;
            --text-secondary: #6b7280;
            --bg-primary: #ffffff;
            --bg-secondary: #f9fafb;
            --border: #e5e7eb;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            font-size: 16px;
            line-height: 1.6;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        /* --- TYPOGRAPHY --- */
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            line-height: 1.2;
            color: var(--text-primary);
        }

        .display-1 { font-size: 4.5rem; font-weight: 700; }
        .display-2 { font-size: 3.5rem; font-weight: 700; }
        
        p { color: var(--text-secondary); }

        /* --- NAVBAR MINIMALIST --- */
        .navbar {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--text-primary) !important;
            letter-spacing: -0.02em;
        }

        .navbar-brand span {
            color: var(--primary);
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-size: 0.9375rem;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: var(--text-primary) !important;
        }

        /* --- BUTTONS MINIMALIST --- */
        .btn {
            font-weight: 500;
            font-size: 0.9375rem;
            padding: 0.625rem 1.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
            border: none;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }

        .btn-outline {
            background-color: transparent;
            border: 1.5px solid var(--border);
            color: var(--text-primary);
        }

        .btn-outline:hover {
            border-color: var(--text-primary);
            background-color: var(--bg-secondary);
        }

        /* --- CARDS MINIMALIST --- */
        .card-minimal {
            background-color: var(--bg-primary);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            transition: all 0.3s ease;
        }

        .card-minimal:hover {
            box-shadow: var(--shadow-lg);
            transform: translateY(-2px);
        }

        /* --- FORMS --- */
        .form-control {
            border: 1.5px solid var(--border);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            font-size: 0.9375rem;
            transition: all 0.2s ease;
            background-color: var(--bg-primary);
        }

        .form-control:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(252, 82, 0, 0.1);
        }

        .form-label {
            font-weight: 500;
            font-size: 0.875rem;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        /* --- SECTIONS --- */
        .section-padding {
            padding: 6rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: var(--text-secondary);
            max-width: 600px;
        }

        /* --- FOOTER --- */
        footer {
            background-color: var(--bg-secondary);
            border-top: 1px solid var(--border);
            padding: 3rem 0 2rem;
            margin-top: 6rem;
        }

        .footer-link {
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 0.9375rem;
            transition: color 0.2s ease;
        }

        .footer-link:hover {
            color: var(--text-primary);
        }

        /* --- UTILITIES --- */
        .text-secondary { color: var(--text-secondary) !important; }
        .bg-secondary { background-color: var(--bg-secondary) !important; }
        .badge-minimal {
            background-color: var(--bg-secondary);
            color: var(--text-secondary);
            padding: 0.375rem 0.875rem;
            border-radius: 6px;
            font-weight: 500;
            font-size: 0.875rem;
        }

        /* --- ANIMATIONS --- */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
    </style>
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                Fit<span>komove</span>
            </a>
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center gap-2">
                    @auth
                        <li class="nav-item">
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary">Dashboard</a>
                        </li>
                    @else
                        <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Sign in</a></li>
                        <li class="nav-item"><a href="{{ route('register') }}" class="btn btn-primary">Get started</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT -->
    <main style="padding-top: 80px;">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <footer>
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-4">
                    <h5 class="fw-bold mb-3">Fitkomove</h5>
                    <p class="text-secondary small mb-4">
                        Track your fitness journey with precision and simplicity.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="footer-link"><i class="bi bi-instagram fs-5"></i></a>
                        <a href="#" class="footer-link"><i class="bi bi-twitter-x fs-5"></i></a>
                        <a href="#" class="footer-link"><i class="bi bi-youtube fs-5"></i></a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h6 class="fw-semibold mb-3">Product</h6>
                    <div class="d-flex flex-column gap-2">
                        <a href="#" class="footer-link">Features</a>
                        <a href="#" class="footer-link">Pricing</a>
                        <a href="#" class="footer-link">Download</a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h6 class="fw-semibold mb-3">Company</h6>
                    <div class="d-flex flex-column gap-2">
                        <a href="#" class="footer-link">About</a>
                        <a href="#" class="footer-link">Blog</a>
                        <a href="#" class="footer-link">Careers</a>
                    </div>
                </div>
                <div class="col-lg-2 col-6">
                    <h6 class="fw-semibold mb-3">Support</h6>
                    <div class="d-flex flex-column gap-2">
                        <a href="#" class="footer-link">Help Center</a>
                        <a href="#" class="footer-link">Contact</a>
                        <a href="#" class="footer-link">Privacy</a>
                    </div>
                </div>
            </div>
            <div class="border-top mt-5 pt-4 text-center">
                <small class="text-secondary">&copy; {{ date('Y') }} Fitkomove. All rights reserved.</small>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>