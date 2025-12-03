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
    <!-- Flatpickr Custom Date/Time Picker -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* ===== CSS VARIABLES ===== */
        :root {
            --primary: #ba1a1a;
            --primary-hover: #991b1b;
            --primary-light: rgba(186, 26, 26, 0.1);
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
            --primary: #ff5449;
            --primary-hover: #ff897d;
            --primary-light: rgba(255, 84, 73, 0.15);
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
            color: #ffffff !important;
            font-weight: 600;
            padding: 0.75rem 1.5rem;
            border-radius: 10px;
            transition: all 0.2s ease;
        }

        .btn-primary:hover {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            color: #ffffff !important;
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
            box-shadow: 0 0 0 3px rgba(186, 26, 26, 0.15);
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
            background-color: var(--primary-light);
            color: var(--primary);
            font-weight: 600;
            font-size: 0.75rem;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            border: 1px solid transparent;
            display: inline-block;
            margin-bottom: 1rem;
        }

        /* ===== NOTIFICATION TOAST ===== */
        .notification-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            display: flex;
            flex-direction: column;
            gap: 10px;
            max-width: 380px;
        }

        .notification-toast {
            background-color: var(--card-bg);
            border: 1px solid var(--border);
            border-left: 4px solid var(--primary);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            box-shadow: 0 10px 40px var(--shadow);
            animation: slideInRight 0.4s ease;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .notification-toast.hiding {
            animation: slideOutRight 0.3s ease forwards;
        }

        .notification-toast .notification-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background-color: var(--primary-light);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .notification-toast .notification-icon i {
            color: var(--primary);
            font-size: 1.2rem;
        }

        .notification-toast .notification-content {
            flex: 1;
        }

        .notification-toast .notification-title {
            font-weight: 600;
            margin-bottom: 2px;
            color: var(--text);
        }

        .notification-toast .notification-message {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin: 0;
        }

        .notification-toast .notification-close {
            background: none;
            border: none;
            color: var(--text-secondary);
            cursor: pointer;
            padding: 0;
            font-size: 1.2rem;
            line-height: 1;
            opacity: 0.5;
            transition: opacity 0.2s;
        }

        .notification-toast .notification-close:hover {
            opacity: 1;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* Notification bell animation */
        .notification-bell {
            position: relative;
        }

        .notification-bell.has-notifications::after {
            content: '';
            position: absolute;
            top: -2px;
            right: -2px;
            width: 8px;
            height: 8px;
            background-color: #ef4444;
            border-radius: 50%;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.2); opacity: 0.8; }
        }

        /* ===== FLOATING CARD (Hero Section) ===== */
        .floating-card {
            backdrop-filter: blur(12px);
            background-color: var(--card-bg) !important;
            border: 1px solid var(--border) !important;
        }

        /* ===== TYPOGRAPHY DARK MODE FIX ===== */
        h1, h2, h3, h4, h5, h6 {
            color: var(--text) !important;
        }

        p {
            color: var(--text);
        }

        .fw-bold, .fw-semibold {
            color: var(--text) !important;
        }

        /* Ensure display headings use theme color */
        .display-1, .display-2, .display-3, .display-4, .display-5, .display-6 {
            color: var(--text) !important;
        }

        /* Fix for Bootstrap text utilities in dark mode */
        [data-theme="dark"] .text-dark {
            color: var(--text) !important;
        }

        [data-theme="light"] .text-dark {
            color: #1a1a1a !important;
        }

        [data-theme="dark"] .bg-white {
            background-color: var(--card-bg) !important;
        }

        [data-theme="dark"] .text-muted {
            color: var(--text-secondary) !important;
        }

        [data-theme="light"] .text-muted {
            color: #6c757d !important;
        }

        /* Force text colors for both modes */
        [data-theme="dark"] h1,
        [data-theme="dark"] h2,
        [data-theme="dark"] h3,
        [data-theme="dark"] h4,
        [data-theme="dark"] h5,
        [data-theme="dark"] h6 {
            color: #f5f5f5 !important;
        }

        [data-theme="light"] h1,
        [data-theme="light"] h2,
        [data-theme="light"] h3,
        [data-theme="light"] h4,
        [data-theme="light"] h5,
        [data-theme="light"] h6 {
            color: #1a1a1a !important;
        }

        /* Fix white text issue in light mode */
        [data-theme="light"] .text-white {
            color: #ffffff !important;
        }

        [data-theme="dark"] .text-white {
            color: #ffffff !important;
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
            margin-top: 0.5rem;
            color: var(--text) !important;
        }

        .section-subtitle {
            color: var(--text-secondary) !important;
            font-size: 1.1rem;
            max-width: 600px;
            margin-top: 0.5rem;
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

        .footer-links li {
            margin-bottom: 0.5rem;
        }

        .footer-social-link {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: var(--card-bg);
            border: 1px solid var(--border);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            color: var(--text-secondary) !important;
            transition: all 0.3s ease;
        }

        .footer-social-link:hover {
            background: var(--primary);
            border-color: var(--primary);
            color: white !important;
            transform: translateY(-2px);
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

        /* ===== CUSTOM FLATPICKR STYLES ===== */
        .flatpickr-calendar {
            background: var(--card-bg) !important;
            border: 1px solid var(--border) !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 40px var(--shadow) !important;
            font-family: 'Inter', sans-serif !important;
        }

        .flatpickr-calendar:before,
        .flatpickr-calendar:after {
            display: none !important;
        }

        .flatpickr-months {
            background: transparent !important;
        }

        .flatpickr-months .flatpickr-month {
            background: transparent !important;
            color: var(--text) !important;
            fill: var(--text) !important;
        }

        .flatpickr-current-month {
            color: var(--text) !important;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months {
            background: var(--bg-secondary) !important;
            color: var(--text) !important;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months option {
            background: var(--card-bg) !important;
            color: var(--text) !important;
        }

        .flatpickr-current-month input.cur-year {
            color: var(--text) !important;
            cursor: text !important;
            padding: 2px 6px !important;
            border-radius: 4px !important;
            border: 1px solid transparent !important;
            transition: all 0.2s ease !important;
        }

        .flatpickr-current-month input.cur-year:hover,
        .flatpickr-current-month input.cur-year:focus {
            border-color: var(--primary) !important;
            background: var(--bg-secondary) !important;
        }

        /* Custom year dropdown for birth date */
        .flatpickr-year-dropdown {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%23666' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 8px center;
            padding-right: 24px !important;
        }

        .flatpickr-year-dropdown:hover {
            border-color: var(--primary) !important;
        }

        .flatpickr-year-dropdown:focus {
            border-color: var(--primary) !important;
            box-shadow: 0 0 0 2px var(--primary-light) !important;
        }

        .flatpickr-year-dropdown option {
            background: var(--card-bg);
            color: var(--text);
            padding: 8px;
        }

        /* Fix flatpickr month header layout */
        .flatpickr-current-month {
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            padding-top: 5px !important;
        }

        .flatpickr-current-month .flatpickr-monthDropdown-months {
            margin: 0 !important;
            padding: 4px 24px 4px 8px !important;
            font-size: 14px !important;
        }

        .flatpickr-months .flatpickr-prev-month,
        .flatpickr-months .flatpickr-next-month {
            fill: var(--text) !important;
            color: var(--text) !important;
        }

        .flatpickr-months .flatpickr-prev-month:hover,
        .flatpickr-months .flatpickr-next-month:hover {
            color: var(--primary) !important;
        }

        .flatpickr-months .flatpickr-prev-month:hover svg,
        .flatpickr-months .flatpickr-next-month:hover svg {
            fill: var(--primary) !important;
        }

        .flatpickr-weekdays {
            background: transparent !important;
        }

        span.flatpickr-weekday {
            background: transparent !important;
            color: var(--text-secondary) !important;
            font-weight: 600 !important;
        }

        .flatpickr-days {
            border: none !important;
        }

        .flatpickr-day {
            color: var(--text) !important;
            border-radius: 8px !important;
        }

        .flatpickr-day:hover {
            background: var(--bg-secondary) !important;
            border-color: var(--bg-secondary) !important;
        }

        .flatpickr-day.today {
            background: var(--primary-light) !important;
            border-color: var(--primary-light) !important;
            color: var(--primary) !important;
        }

        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange,
        .flatpickr-day.selected:hover,
        .flatpickr-day.startRange:hover,
        .flatpickr-day.endRange:hover {
            background: var(--primary) !important;
            border-color: var(--primary) !important;
            color: white !important;
        }

        .flatpickr-day.prevMonthDay,
        .flatpickr-day.nextMonthDay {
            color: var(--text-secondary) !important;
        }

        .flatpickr-day.flatpickr-disabled {
            color: var(--text-secondary) !important;
        }

        /* Time Picker */
        .flatpickr-time {
            background: var(--bg-secondary) !important;
            border-top: 1px solid var(--border) !important;
        }

        .flatpickr-time input {
            background: var(--card-bg) !important;
            color: var(--text) !important;
        }

        .flatpickr-time input:hover,
        .flatpickr-time input:focus {
            background: var(--card-bg) !important;
        }

        .flatpickr-time .flatpickr-time-separator {
            color: var(--text) !important;
        }

        .flatpickr-time .flatpickr-am-pm {
            background: var(--card-bg) !important;
            color: var(--text) !important;
        }

        .flatpickr-time .flatpickr-am-pm:hover {
            background: var(--primary) !important;
            color: white !important;
        }

        .numInputWrapper span {
            border-color: var(--border) !important;
        }

        .numInputWrapper span:hover {
            background: var(--primary) !important;
        }

        .numInputWrapper span.arrowUp:after {
            border-bottom-color: var(--text) !important;
        }

        .numInputWrapper span.arrowDown:after {
            border-top-color: var(--text) !important;
        }

        .numInputWrapper span:hover.arrowUp:after {
            border-bottom-color: white !important;
        }

        .numInputWrapper span:hover.arrowDown:after {
            border-top-color: white !important;
        }

        /* Custom input wrapper with icon */
        .custom-datetime-input {
            position: relative;
        }

        .custom-datetime-input .form-control {
            padding-left: 2.5rem !important;
            cursor: pointer !important;
        }

        .custom-datetime-input .input-icon {
            position: absolute;
            left: 0.875rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
            pointer-events: none;
            z-index: 5;
        }

        /* ===== ADDITIONAL DARK MODE FIXES ===== */
        /* Lead text */
        .lead {
            color: var(--text-secondary) !important;
        }

        [data-theme="dark"] .lead {
            color: #b0b0b0 !important;
        }

        [data-theme="light"] .lead {
            color: #6c757d !important;
        }

        /* Small text */
        small {
            color: var(--text-secondary) !important;
        }

        [data-theme="dark"] small {
            color: #a0a0a0 !important;
        }

        [data-theme="light"] small {
            color: #6c757d !important;
        }

        /* Paragraph text fix */
        [data-theme="dark"] p {
            color: #e0e0e0;
        }

        [data-theme="light"] p {
            color: #1a1a1a;
        }

        /* Card text fix */
        [data-theme="dark"] .card-minimal p,
        [data-theme="dark"] .card-minimal .text-secondary {
            color: #b0b0b0 !important;
        }

        [data-theme="light"] .card-minimal p,
        [data-theme="light"] .card-minimal .text-secondary {
            color: #6c757d !important;
        }

        /* Feature card title fix */
        [data-theme="dark"] .card-minimal h4,
        [data-theme="dark"] .card-minimal h5,
        [data-theme="dark"] .card-minimal h6,
        [data-theme="dark"] .card-minimal .h4,
        [data-theme="dark"] .card-minimal .h5,
        [data-theme="dark"] .card-minimal .h6 {
            color: #f5f5f5 !important;
        }

        [data-theme="light"] .card-minimal h4,
        [data-theme="light"] .card-minimal h5,
        [data-theme="light"] .card-minimal h6,
        [data-theme="light"] .card-minimal .h4,
        [data-theme="light"] .card-minimal .h5,
        [data-theme="light"] .card-minimal .h6 {
            color: #1a1a1a !important;
        }

        /* Border utilities */
        .border, .border-top, .border-bottom, .border-start, .border-end {
            border-color: var(--border) !important;
        }

        /* Background primary with opacity */
        .bg-primary.bg-opacity-10 {
            background-color: rgba(186, 26, 26, 0.1) !important;
        }

        [data-theme="dark"] .bg-primary.bg-opacity-10 {
            background-color: rgba(255, 84, 73, 0.15) !important;
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
                        <a href="{{ route('workouts.index') }}" class="nav-link d-none d-md-inline">
                            <i class="bi bi-lightning-charge me-1"></i>Workout
                        </a>
                        <a href="{{ route('activities.index') }}" class="nav-link d-none d-md-inline">Aktivitas</a>
                        <a href="{{ route('schedules.index') }}" class="nav-link d-none d-md-inline">Jadwal</a>
                        <a href="{{ route('reminders.index') }}" class="nav-link d-none d-md-inline notification-bell" id="reminderBell">
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

    <!-- Notification Container -->
    <div id="notificationContainer" class="notification-container"></div>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h5 class="fw-bold mb-3" style="color: var(--primary);">Fitkomove</h5>
                    <p class="text-secondary small mb-4" style="max-width: 350px;">
                        Track your fitness journey with precision. Simple, powerful, and designed for athletes who want to achieve more.
                    </p>
                    <div class="d-flex gap-3">
                        <a href="#" class="footer-social-link"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="footer-social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="footer-social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="footer-social-link"><i class="bi bi-github"></i></a>
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-semibold mb-3">Product</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('features') }}">Features</a></li>
                        <li><a href="{{ route('coming-soon', 'pricing') }}">Pricing</a></li>
                        <li><a href="{{ route('coming-soon', 'download') }}">Download</a></li>
                    </ul>
                </div>
                <div class="col-6 col-lg-2">
                    <h6 class="fw-semibold mb-3">Company</h6>
                    <ul class="list-unstyled footer-links">
                        <li><a href="{{ route('features') }}">About</a></li>
                        <li><a href="{{ route('coming-soon', 'blog') }}">Blog</a></li>
                        <li><a href="{{ route('coming-soon', 'careers') }}">Careers</a></li>
                    </ul>
                </div>
                <div class="col-lg-3">
                    <h6 class="fw-semibold mb-3">Get Started</h6>
                    <p class="text-secondary small mb-3">Mulai perjalanan fitness Anda hari ini.</p>
                    @guest
                    <a href="{{ route('register') }}" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-person-plus me-2"></i>Daftar Gratis
                    </a>
                    @else
                    <a href="{{ route('dashboard') }}" class="btn btn-primary btn-sm w-100">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    @endguest
                </div>
            </div>
            <hr class="my-4" style="border-color: var(--border);">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <p class="text-secondary small mb-0">&copy; {{ date('Y') }} Fitkomove. All rights reserved.</p>
                <div class="d-flex gap-4">
                    <a href="#" class="text-secondary small text-decoration-none">Privacy Policy</a>
                    <a href="#" class="text-secondary small text-decoration-none">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    
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

    <!-- Live Notification System -->
    @auth
    <script>
        (function() {
            const notificationContainer = document.getElementById('notificationContainer');
            const reminderBell = document.getElementById('reminderBell');
            let triggeredReminders = JSON.parse(localStorage.getItem('triggeredReminders') || '{}');
            let reminders = [];
            let lastCheckMinute = -1;

            // Clean up old triggered reminders (older than 24 hours)
            const now = Date.now();
            Object.keys(triggeredReminders).forEach(key => {
                if (now - triggeredReminders[key] > 24 * 60 * 60 * 1000) {
                    delete triggeredReminders[key];
                }
            });
            localStorage.setItem('triggeredReminders', JSON.stringify(triggeredReminders));

            // Request notification permission immediately
            if ('Notification' in window) {
                if (Notification.permission === 'default') {
                    Notification.requestPermission();
                }
            }

            // Fetch today's reminders
            async function fetchReminders() {
                try {
                    const response = await fetch('{{ route("reminders.today") }}', {
                        cache: 'no-store',
                        headers: { 'Cache-Control': 'no-cache' }
                    });
                    if (response.ok) {
                        reminders = await response.json();
                        updateBellIndicator();
                        console.log('[Fitkomove] Loaded', reminders.length, 'reminders');
                    }
                } catch (error) {
                    console.log('[Fitkomove] Could not fetch reminders:', error);
                }
            }

            // Update bell indicator
            function updateBellIndicator() {
                if (reminderBell) {
                    const hasActiveReminders = reminders.some(r => r.is_active);
                    if (hasActiveReminders) {
                        reminderBell.classList.add('has-notifications');
                    } else {
                        reminderBell.classList.remove('has-notifications');
                    }
                }
            }

            // Show in-app notification toast
            function showToast(reminder) {
                const toast = document.createElement('div');
                toast.className = 'notification-toast';
                toast.innerHTML = `
                    <div class="notification-icon">
                        <i class="bi ${reminder.type_icon || 'bi-bell'}"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">${reminder.title}</div>
                        <p class="notification-message">${reminder.message || 'Waktunya untuk ' + reminder.title}</p>
                    </div>
                    <button class="notification-close" onclick="this.parentElement.remove()">
                        <i class="bi bi-x"></i>
                    </button>
                `;
                notificationContainer.appendChild(toast);

                // Play notification sound
                playNotificationSound();

                // Auto remove after 15 seconds
                setTimeout(() => {
                    if (toast.parentElement) {
                        toast.classList.add('hiding');
                        setTimeout(() => toast.remove(), 300);
                    }
                }, 15000);
            }

            // Show browser notification
            function showBrowserNotification(reminder) {
                if ('Notification' in window && Notification.permission === 'granted') {
                    const notification = new Notification('🔔 Fitkomove - ' + reminder.title, {
                        body: reminder.message || 'Waktunya untuk ' + reminder.title,
                        icon: '/favicon.ico',
                        badge: '/favicon.ico',
                        tag: 'reminder-' + reminder.id,
                        requireInteraction: true,
                        silent: false
                    });

                    notification.onclick = function() {
                        window.focus();
                        notification.close();
                    };

                    // Auto close after 30 seconds
                    setTimeout(() => notification.close(), 30000);
                }
            }

            // Play notification sound
            function playNotificationSound() {
                try {
                    const audioContext = new (window.AudioContext || window.webkitAudioContext)();
                    
                    // Resume audio context if suspended (required for some browsers)
                    if (audioContext.state === 'suspended') {
                        audioContext.resume();
                    }

                    const playTone = (freq, startTime, duration) => {
                        const oscillator = audioContext.createOscillator();
                        const gainNode = audioContext.createGain();
                        
                        oscillator.connect(gainNode);
                        gainNode.connect(audioContext.destination);
                        
                        oscillator.frequency.value = freq;
                        oscillator.type = 'sine';
                        gainNode.gain.setValueAtTime(0.15, startTime);
                        gainNode.gain.exponentialRampToValueAtTime(0.01, startTime + duration);
                        
                        oscillator.start(startTime);
                        oscillator.stop(startTime + duration);
                    };

                    const now = audioContext.currentTime;
                    playTone(800, now, 0.15);
                    playTone(1000, now + 0.15, 0.15);
                    playTone(1200, now + 0.3, 0.2);
                } catch (e) {
                    console.log('[Fitkomove] Audio not supported');
                }
            }

            // Parse time string to minutes since midnight
            function timeToMinutes(timeStr) {
                if (!timeStr) return -1;
                // Handle both "HH:MM" and "HH:MM:SS" formats
                const parts = timeStr.split(':');
                if (parts.length >= 2) {
                    return parseInt(parts[0], 10) * 60 + parseInt(parts[1], 10);
                }
                return -1;
            }

            // Check reminders - runs every second for precision
            function checkReminders() {
                const now = new Date();
                const currentMinutes = now.getHours() * 60 + now.getMinutes();
                const today = now.toDateString();

                // Only check once per minute to avoid duplicate notifications
                if (currentMinutes === lastCheckMinute) {
                    return;
                }
                lastCheckMinute = currentMinutes;

                const currentTimeStr = now.getHours().toString().padStart(2, '0') + ':' + 
                                       now.getMinutes().toString().padStart(2, '0');

                console.log('[Fitkomove] Checking reminders at', currentTimeStr);

                reminders.forEach(reminder => {
                    if (!reminder.is_active) return;

                    // Get reminder time - try multiple formats
                    let reminderTimeStr = reminder.formatted_time || reminder.reminder_time;
                    
                    // Normalize time format (remove seconds if present)
                    if (reminderTimeStr && reminderTimeStr.length > 5) {
                        reminderTimeStr = reminderTimeStr.substring(0, 5);
                    }

                    const reminderKey = reminder.id + '-' + today;

                    // Check if time matches and hasn't been triggered today
                    if (reminderTimeStr === currentTimeStr && !triggeredReminders[reminderKey]) {
                        console.log('[Fitkomove] 🔔 Triggering reminder:', reminder.title);
                        
                        // Mark as triggered immediately
                        triggeredReminders[reminderKey] = Date.now();
                        localStorage.setItem('triggeredReminders', JSON.stringify(triggeredReminders));

                        // Show notifications
                        showToast(reminder);
                        showBrowserNotification(reminder);
                    }
                });
            }

            // Initialize system
            async function init() {
                console.log('[Fitkomove] Initializing notification system...');
                await fetchReminders();
                
                // Check immediately
                checkReminders();
                
                // Check every 5 seconds for more responsive notifications
                setInterval(checkReminders, 5000);
                
                // Refresh reminders from server every 2 minutes
                setInterval(fetchReminders, 2 * 60 * 1000);

                // Also refresh when page becomes visible again
                document.addEventListener('visibilitychange', () => {
                    if (document.visibilityState === 'visible') {
                        console.log('[Fitkomove] Page visible, refreshing reminders...');
                        fetchReminders();
                        checkReminders();
                    }
                });

                console.log('[Fitkomove] Notification system ready!');
            }

            // Start the system
            init();
        })();
    </script>
    @endauth

    @yield('scripts')
</body>
</html>
