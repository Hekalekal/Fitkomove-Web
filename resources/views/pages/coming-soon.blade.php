@extends('layouts.app')

@section('title', $title ?? 'Coming Soon' . ' - Fitkomove')

@section('content')
<section class="coming-soon-section">
    <div class="container">
        <div class="coming-soon-content">
            <!-- Animated Background Elements -->
            <div class="floating-shapes">
                <div class="shape shape-1"></div>
                <div class="shape shape-2"></div>
                <div class="shape shape-3"></div>
                <div class="shape shape-4"></div>
            </div>

            <!-- Main Content -->
            <div class="text-center position-relative">
                <!-- Icon -->
                <div class="coming-soon-icon mx-auto mb-4">
                    <i class="bi {{ $icon ?? 'bi-rocket-takeoff' }}"></i>
                </div>

                <!-- Badge -->
                <span class="badge-minimal d-inline-block">{{ $badge ?? 'Coming Soon' }}</span>

                <!-- Title -->
                <h1 class="display-4 fw-bold mt-3 mb-4">
                    {{ $heading ?? 'Segera Hadir!' }}
                </h1>

                <!-- Description -->
                <p class="lead mb-5 mx-auto" style="max-width: 600px;">
                    {{ $description ?? 'Kami sedang bekerja keras untuk menghadirkan fitur ini. Nantikan update terbaru dari kami!' }}
                </p>

                <!-- Countdown or Progress -->
                <div class="progress-wrapper mb-5">
                    <div class="progress-bar-custom">
                        <div class="progress-fill" style="width: {{ $progress ?? 65 }}%;"></div>
                    </div>
                    <p class="text-secondary small mt-2">Progress Pengembangan: {{ $progress ?? 65 }}%</p>
                </div>

                <!-- Features Preview -->
                @if(isset($features) && count($features) > 0)
                <div class="features-preview mb-5">
                    <h5 class="fw-semibold mb-4">Yang Akan Datang:</h5>
                    <div class="row g-3 justify-content-center">
                        @foreach($features as $feature)
                        <div class="col-md-4">
                            <div class="preview-card">
                                <i class="bi {{ $feature['icon'] }} mb-2"></i>
                                <span>{{ $feature['text'] }}</span>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Action Buttons -->
                <div class="d-flex gap-3 justify-content-center flex-wrap">
                    <a href="{{ route('home') }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-house me-2"></i>Kembali ke Beranda
                    </a>
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn btn-outline btn-lg">
                        <i class="bi bi-speedometer2 me-2"></i>Dashboard
                    </a>
                    @else
                    <a href="{{ route('register') }}" class="btn btn-outline btn-lg">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </a>
                    @endauth
                </div>

                <!-- Social Links -->
                <div class="social-links mt-5">
                    <p class="text-secondary small mb-3">Ikuti kami untuk update terbaru:</p>
                    <div class="d-flex gap-3 justify-content-center">
                        <a href="#" class="social-link"><i class="bi bi-twitter-x"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social-link"><i class="bi bi-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .coming-soon-section {
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
        padding: 4rem 0;
        position: relative;
        overflow: hidden;
    }

    .coming-soon-content {
        position: relative;
        z-index: 1;
    }

    /* Floating Shapes */
    .floating-shapes {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        pointer-events: none;
        overflow: hidden;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.1;
    }

    .shape-1 {
        width: 400px;
        height: 400px;
        background: linear-gradient(135deg, var(--primary), #ff5449);
        top: -100px;
        right: -100px;
        animation: float1 8s ease-in-out infinite;
    }

    .shape-2 {
        width: 300px;
        height: 300px;
        background: linear-gradient(135deg, #ff5449, var(--primary));
        bottom: -50px;
        left: -50px;
        animation: float2 10s ease-in-out infinite;
    }

    .shape-3 {
        width: 150px;
        height: 150px;
        background: var(--primary);
        top: 30%;
        left: 10%;
        animation: float3 6s ease-in-out infinite;
    }

    .shape-4 {
        width: 100px;
        height: 100px;
        background: #ff5449;
        bottom: 30%;
        right: 15%;
        animation: float4 7s ease-in-out infinite;
    }

    @keyframes float1 {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(-30px, 30px) rotate(10deg); }
    }

    @keyframes float2 {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        50% { transform: translate(30px, -30px) rotate(-10deg); }
    }

    @keyframes float3 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(20px, -20px) scale(1.1); }
    }

    @keyframes float4 {
        0%, 100% { transform: translate(0, 0) scale(1); }
        50% { transform: translate(-20px, 20px) scale(0.9); }
    }

    /* Icon */
    .coming-soon-icon {
        width: 120px;
        height: 120px;
        border-radius: 30px;
        background: linear-gradient(135deg, var(--primary), #ff5449);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        box-shadow: 0 20px 60px rgba(186, 26, 26, 0.3);
        animation: pulse-icon 2s ease-in-out infinite;
    }

    @keyframes pulse-icon {
        0%, 100% { transform: scale(1); box-shadow: 0 20px 60px rgba(186, 26, 26, 0.3); }
        50% { transform: scale(1.05); box-shadow: 0 25px 70px rgba(186, 26, 26, 0.4); }
    }

    /* Progress Bar */
    .progress-wrapper {
        max-width: 400px;
        margin: 0 auto;
    }

    .progress-bar-custom {
        height: 8px;
        background: var(--bg-secondary);
        border-radius: 10px;
        overflow: hidden;
        border: 1px solid var(--border);
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary), #ff5449);
        border-radius: 10px;
        animation: progress-glow 2s ease-in-out infinite;
    }

    @keyframes progress-glow {
        0%, 100% { box-shadow: 0 0 10px rgba(186, 26, 26, 0.3); }
        50% { box-shadow: 0 0 20px rgba(186, 26, 26, 0.5); }
    }

    /* Preview Cards */
    .preview-card {
        background: var(--card-bg);
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s ease;
    }

    .preview-card:hover {
        border-color: var(--primary);
        transform: translateY(-2px);
    }

    .preview-card i {
        font-size: 1.25rem;
        color: var(--primary);
    }

    .preview-card span {
        font-size: 0.9rem;
        color: var(--text);
    }

    /* Social Links */
    .social-link {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-secondary);
        font-size: 1.1rem;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .social-link:hover {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
        transform: translateY(-3px);
    }

    /* Text color fixes for coming-soon page */
    [data-theme="dark"] .coming-soon-section h1,
    [data-theme="dark"] .coming-soon-section h5,
    [data-theme="dark"] .coming-soon-section .fw-bold,
    [data-theme="dark"] .coming-soon-section .fw-semibold {
        color: #f5f5f5 !important;
    }

    [data-theme="light"] .coming-soon-section h1,
    [data-theme="light"] .coming-soon-section h5,
    [data-theme="light"] .coming-soon-section .fw-bold,
    [data-theme="light"] .coming-soon-section .fw-semibold {
        color: #1a1a1a !important;
    }

    [data-theme="dark"] .coming-soon-section .lead,
    [data-theme="dark"] .coming-soon-section .text-secondary {
        color: #b0b0b0 !important;
    }

    [data-theme="light"] .coming-soon-section .lead,
    [data-theme="light"] .coming-soon-section .text-secondary {
        color: #6c757d !important;
    }

    [data-theme="dark"] .preview-card span {
        color: #e0e0e0;
    }

    [data-theme="light"] .preview-card span {
        color: #1a1a1a;
    }
</style>
@endsection
