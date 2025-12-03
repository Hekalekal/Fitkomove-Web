<!DOCTYPE html>
<html lang="en" data-theme="light">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Fitkomove')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* ===== CSS VARIABLES ===== */
        :root {
            --primary: #FC5200;
            --primary-hover: #e04a00;
            --bg: #ffffff;
            --bg-secondary: #f8f9fa;
            --text: #1a1a1a;
            --text-secondary: #6c757d;
            --border: #e9ecef;
            --card-bg: #ffffff;
            --shadow: rgba(0, 0, 0, 0.08);
            --navbar-bg: rgba(255, 255, 255, 0.95);
        }

        [data-theme="dark"] {
            --primary: #FF6B35;
            --primary-hover: #ff8555;
            --bg: #0f0f0f;
            --bg-secondary: #1a1a1a;
            --text: #f5f5f5;
            --text-secondary: #a0a0a0;
            --border: #2a2a2a;
            --card-bg: #1a1a1a;
            --shadow: rgba(0, 0, 0, 0.3);
            --navbar-bg: rgba(15, 15, 15, 0.95);
        }

        /* ===== BASE STYLES ===== */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background-color: var(--bg);
            color: var(--text);
            transition: background-color 0.3s ease, color 0.3s ease;
            line-height: 1.6;
        }

        /* ===== NAVBAR ===== */
        .navbar-main {
            background-color: var(--navbar-bg);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--border);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--primary) !important;
            letter-spacing: -0.5px;
        }

        .nav-link {
            color: var(--text) !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        /* ===== DARK MODE TOGGLE ===== */
        .theme-toggle {
            background: var(--bg-secondary);
            border: 1px solid var(--border);
            border-radius: 50px;
            padding: 0.5rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            transition: all 0.3s ease;
        }

        .theme-toggle:hover {
            background: var(--border);
            transform: scale(1.05);
        }

        .theme-toggle i {
            font-size: 1.2rem;
            color: var(--text);
            transition: transform 0.3s ease;
        }

        .theme-toggle:hover i {
            transform: rotate(15deg);
        }

        [data-theme="dark"] .theme-toggle .bi-moon-fill {
            display: none;
        }

        [data-theme="light"] .theme-toggle .bi-sun-fill {
            display: none;
        }

        /* ===== BUTTONS ===== */
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            transform: translateY(-1px);
        }

        .btn-outline {
            background-color: transparent;
            border: 1px solid var(--border);
            color: var(--text);
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .btn-outline:hover {
            background-color: var(--bg-secondary);
            border-color: var(--primary);
            color: var(--primary);
        }

        /* ===== CARDS ===== */
        .card-minimal {
            background-color: var(--card-bg);
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .card-minimal:hover {
            box-shadow: 0 8px 30px var(--shadow);
        }

        /* ===== FORM CONTROLS ===== */
        .form-control {
            background-color: var(--bg-secondary);
            border: 1px solid var(--border);
            color: var(--text);
            border-radius: 10px;
            padding: 0.75rem 1rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            background-color: var(--bg);
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(252, 82, 0, 0.1);
            color: var(--text);
        }

        .form-control::placeholder {
            color: var(--text-secondary);
        }

        .form-label {
            color: var(--text);
            font-weight: 500;
            margin-bottom: 0.5rem;
        }

        /* ===== BADGES ===== */
        .badge-minimal {
            background-color: var(--bg-secondary);
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            border: 1px solid var(--border);
        }

        /* ===== FLOATING CARD (Hero Section) ===== */
        .floating-card {
            backdrop-filter: blur(12px);
            background-color: var(--card-bg) !important;
            border: 1px solid var(--border) !important;
        }

        /* ===== TYPOGRAPHY DARK MODE FIX ===== */
        h1, h2, h3, h4, h5, h6 {
            color: var(--text);
        }

        p {
            color: var(--text);
        }

        .fw-bold, .fw-semibold {
            color: var(--text);
        }

        /* Ensure display headings use theme color */
        .display-1, .display-2, .display-3, .display-4, .display-5, .display-6 {
            color: var(--text);
        }

        /* Fix for Bootstrap text utilities in dark mode */
        [data-theme="dark"] .text-dark {
            color: var(--text) !important;
        }

        [data-theme="dark"] .bg-white {
            background-color: var(--card-bg) !important;
        }

        [data-theme="dark"] .text-muted {
            color: var(--text-secondary) !important;
        }

        /* Dropdown menu dark mode */
        .dropdown-menu {
            background-color: var(--card-bg);
            border: 1px solid var(--border);
        }

        .dropdown-item {
            color: var(--text);
        }

        .dropdown-item:hover {
            background-color: var(--bg-secondary);
            color: var(--text);
        }

        /* Table dark mode */
        .table {
            color: var(--text);
        }

        .table > :not(caption) > * > * {
            background-color: var(--card-bg);
            border-bottom-color: var(--border);
            color: var(--text);
        }

        /* List group dark mode */
        .list-group-item {
            background-color: var(--card-bg);
            border-color: var(--border);
            color: var(--text);
        }

        /* Form check dark mode */
        .form-check-input {
            background-color: var(--bg-secondary);
            border-color: var(--border);
        }

        .form-check-input:checked {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        .form-check-label {
            color: var(--text);
        }

        /* Form select dark mode */
        .form-select {
            background-color: var(--bg-secondary);
            border-color: var(--border);
            color: var(--text);
        }

        .form-select:focus {
            background-color: var(--bg);
            border-color: var(--primary);
            color: var(--text);
        }

        /* Pagination dark mode */
        .page-link {
            background-color: var(--card-bg);
            border-color: var(--border);
            color: var(--text);
        }

        .page-link:hover {
            background-color: var(--bg-secondary);
            border-color: var(--border);
            color: var(--primary);
        }

        .page-item.active .page-link {
            background-color: var(--primary);
            border-color: var(--primary);
        }

        /* Close button dark mode */
        [data-theme="dark"] .btn-close {
            filter: invert(1) grayscale(100%) brightness(200%);
        }

        /* ===== SECTIONS ===== */
        .section-padding {
            padding: 5rem 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: var(--text);
        }

        .section-subtitle {
            color: var(--text-secondary);
            font-size: 1.1rem;
            max-width: 600px;
        }

        .bg-secondary {
            background-color: var(--bg-secondary) !important;
        }

        .text-secondary {
            color: var(--text-secondary) !important;
        }

        /* ===== MODAL ===== */
        .modal-content {
            background-color: var(--card-bg);
            border: 1px solid var(--border);
        }

        .modal-header {
            border-bottom-color: var(--border);
        }

        .modal-footer {
            border-top-color: var(--border);
        }

        /* ===== ALERT ===== */
        .alert {
            border-radius: 12px;
        }

        /* ===== FOOTER ===== */
        .footer {
            background-color: var(--bg-secondary);
            border-top: 1px solid var(--border);
            padding: 3rem 0;
            margin-top: 4rem;
        }

        .footer h5, .footer h6 {
            color: var(--text);
        }

        .footer p {
            color: var(--text-secondary);
        }

        .footer a {
            color: var(--text-secondary) !important;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .footer a:hover {
            color: var(--primary) !important;
        }

        .footer .list-unstyled li {
            color: var(--text-secondary);
        }

        /* ===== ANIMATIONS ===== */
        .fade-in-up {
            animation: fadeInUp 0.6s ease forwards;
        }

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

        /* ===== SCROLLBAR ===== */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--bg-secondary);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--text-secondary);
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 768px) {
            .section-title {
                font-size: 2rem;
            }
            
            .section-padding {
                padding: 3rem 0;
            }
        }

        /* ===== ADDITIONAL DARK MODE FIXES ===== */
        /* Lead text */
        .lead {
            color: var(--text-secondary);
        }

        /* Small text */
        small {
            color: var(--text-secondary);
        }

        /* Border utilities */
        .border, .border-top, .border-bottom, .border-start, .border-end {
            border-color: var(--border) !important;
        }

        /* Background primary with opacity */
        .bg-primary.bg-opacity-10 {
            background-color: rgba(252, 82, 0, 0.1) !important;
        }

        [data-theme="dark"] .bg-primary.bg-opacity-10 {
            background-color: rgba(255, 107, 53, 0.15) !important;
        }

        /* Fix for any remaining white backgrounds */
        [data-theme="dark"] .bg-light {
            background-color: var(--bg-secondary) !important;
        }

        /* Ensure links are visible */
        a:not(.btn):not(.nav-link):not(.navbar-brand):not(.footer a):not(.dropdown-item) {
            color: var(--primary);
        }

        a:not(.btn):not(.nav-link):not(.navbar-brand):not(.footer a):not(.dropdown-item):hover {
            color: var(--primary-hover);
        }

        /* Fix hr element */
        hr {
            border-color: var(--border);
            opacity: 1;
        }

        /* Blockquote */
        blockquote {
            color: var(--text);
            border-left-color: var(--primary);
        }

        /* Code elements */
        code {
            color: var(--primary);
            background-color: var(--bg-secondary);
        }

        pre {
            background-color: var(--bg-secondary);
            color: var(--text);
            border: 1px solid var(--border);
        }

        /* Input group */
        .input-group-text {
            background-color: var(--bg-secondary);
            border-color: var(--border);
            color: var(--text);
        }

        /* Progress bar */
        .progress {
            background-color: var(--bg-secondary);
        }

        /* Accordion */
        .accordion-item {
            background-color: var(--card-bg);
            border-color: var(--border);
        }

        .accordion-button {
            background-color: var(--card-bg);
            color: var(--text);
        }

        .accordion-button:not(.collapsed) {
            background-color: var(--bg-secondary);
            color: var(--text);
        }

        /* Nav tabs/pills */
        .nav-tabs .nav-link {
            color: var(--text);
        }

        .nav-tabs .nav-link.active {
            background-color: var(--card-bg);
            border-color: var(--border);
            color: var(--text);
        }

        .nav-pills .nav-link {
            color: var(--text);
        }

        .nav-pills .nav-link.active {
            background-color: var(--primary);
        }

        /* Toast */
        .toast {
            background-color: var(--card-bg);
            border-color: var(--border);
            color: var(--text);
        }

        /* Offcanvas */
        .offcanvas {
            background-color: var(--card-bg);
            color: var(--text);
        }

        /* Breadcrumb */
        .breadcrumb-item a {
            color: var(--primary);
        }

        .breadcrumb-item.active {
            color: var(--text-secondary);
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: var(--text-secondary);
        }

        /* Ensure proper contrast for accessibility */
        @media (prefers-contrast: high) {
            :root {
                --text: #000000;
                --text-secondary: #333333;
            }

            [data-theme="dark"] {
                --text: #ffffff;
                --text-secondary: #cccccc;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar-main">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <a href="{{ url('/') }}" class="navbar-brand text-decoration-none">
                    Fitkomove
                </a>
                
                <div class="d-flex align-items-center gap-3">
                    @guest
                        <a href="{{ route('demo') }}" class="nav-link d-none d-md-inline">Demo</a>
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">Get Started</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="nav-link">Dashboard</a>
                        <a href="{{ route('activities.index') }}" class="nav-link d-none d-md-inline">Aktivitas</a>
                        <a href="{{ route('schedules.index') }}" class="nav-link d-none d-md-inline">Jadwal</a>
                        <a href="{{ route('reminders.index') }}" class="nav-link d-none d-md-inline">
                            <i class="bi bi-bell"></i>
                        </a>
                    @endguest
                    
                    <!-- Dark Mode Toggle -->
                    <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode" title="Toggle dark mode">
                        <i class="bi bi-moon-fill"></i>
                        <i class="bi bi-sun-fill"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3" style="color: var(--primary);">Fitkomove</h5>
                    <p class="text-secondary small">
                        Track your fitness journey with precision. Simple, powerful, and designed for athletes.
                    </p>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-semibold mb-3">Product</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">Features</a></li>
                        <li class="mb-2"><a href="#">Pricing</a></li>
                        <li class="mb-2"><a href="#">Download</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-semibold mb-3">Company</h6>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#">About</a></li>
                        <li class="mb-2"><a href="#">Blog</a></li>
                        <li class="mb-2"><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="col-lg-4">
                    <h6 class="fw-semibold mb-3">Stay Updated</h6>
                    <p class="text-secondary small mb-3">Subscribe to our newsletter for tips and updates.</p>
                    <div class="d-flex gap-2">
                        <input type="email" class="form-control" placeholder="Enter your email">
                        <button class="btn btn-primary">Subscribe</button>
                    </div>
                </div>
            </div>
            <hr class="my-4" style="border-color: var(--border);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
                <p class="text-secondary small mb-2 mb-md-0">&copy; {{ date('Y') }} Fitkomove. All rights reserved.</p>
                <div class="d-flex gap-3">
                    <a href="#" class="text-secondary"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-secondary"><i class="bi bi-facebook"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Dark Mode Script -->
    <script>
        (function() {
            const themeToggle = document.getElementById('themeToggle');
            const html = document.documentElement;
            
            // Check for saved theme preference or default to system preference
            const savedTheme = localStorage.getItem('theme');
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (savedTheme) {
                html.setAttribute('data-theme', savedTheme);
            } else if (systemPrefersDark) {
                html.setAttribute('data-theme', 'dark');
            }
            
            // Toggle theme on button click
            themeToggle.addEventListener('click', function() {
                const currentTheme = html.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                
                html.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
                
                // Add a subtle animation
                this.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
            
            // Listen for system theme changes
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function(e) {
                if (!localStorage.getItem('theme')) {
                    html.setAttribute('data-theme', e.matches ? 'dark' : 'light');
                }
            });
        })();
    </script>

    @yield('scripts')
</body>
</html>
