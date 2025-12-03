@extends('layouts.app')

@section('title', 'Features - Fitkomove')

@section('content')
<!-- Hero Section -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge-minimal">Features</span>
            <h1 class="display-4 fw-bold mt-3 mb-4">Semua yang Anda Butuhkan<br>untuk <span style="color: var(--primary);">Fitness Journey</span></h1>
            <p class="lead mx-auto" style="max-width: 700px;">
                Fitkomove menyediakan berbagai fitur lengkap untuk membantu Anda mencapai tujuan fitness dengan lebih efektif dan menyenangkan.
            </p>
        </div>
    </div>
</section>

<!-- Main Features -->
<section class="section-padding bg-secondary">
    <div class="container">
        <div class="row g-5 align-items-center mb-5">
            <div class="col-lg-6">
                <div class="feature-image-wrapper">
                    <div class="feature-icon-large">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="badge-minimal">Workout Tracking</span>
                <h2 class="h1 fw-bold mt-3 mb-4">Lacak Setiap Latihan dengan Detail</h2>
                <p class="mb-4">
                    Catat setiap set, rep, dan beban yang Anda angkat. Sistem kami akan melacak progress Anda secara real-time dan memberikan insight yang berguna.
                </p>
                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill"></i> Timer otomatis untuk setiap sesi</li>
                    <li><i class="bi bi-check-circle-fill"></i> Catat beban, repetisi, dan istirahat</li>
                    <li><i class="bi bi-check-circle-fill"></i> Hitung volume latihan secara otomatis</li>
                    <li><i class="bi bi-check-circle-fill"></i> Rest timer dengan notifikasi</li>
                </ul>
            </div>
        </div>

        <div class="row g-5 align-items-center mb-5 flex-lg-row-reverse">
            <div class="col-lg-6">
                <div class="feature-image-wrapper alt">
                    <div class="feature-icon-large">
                        <i class="bi bi-calendar-check"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="badge-minimal">Smart Scheduling</span>
                <h2 class="h1 fw-bold mt-3 mb-4">Jadwal Latihan Cerdas</h2>
                <p class="mb-4">
                    Dapatkan rekomendasi jadwal latihan berdasarkan tujuan fitness dan intensitas yang Anda inginkan. Kalender interaktif membantu Anda melihat progress bulanan.
                </p>
                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill"></i> Rekomendasi jadwal otomatis</li>
                    <li><i class="bi bi-check-circle-fill"></i> Kalender aktivitas bulanan</li>
                    <li><i class="bi bi-check-circle-fill"></i> Pengingat latihan</li>
                    <li><i class="bi bi-check-circle-fill"></i> Integrasi dengan aktivitas harian</li>
                </ul>
            </div>
        </div>

        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="feature-image-wrapper">
                    <div class="feature-icon-large">
                        <i class="bi bi-graph-up-arrow"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <span class="badge-minimal">Analytics</span>
                <h2 class="h1 fw-bold mt-3 mb-4">Analisis Progress Mendalam</h2>
                <p class="mb-4">
                    Lihat statistik lengkap tentang perjalanan fitness Anda. Dari kalori terbakar hingga streak latihan, semua data tersedia dalam visualisasi yang mudah dipahami.
                </p>
                <ul class="feature-list">
                    <li><i class="bi bi-check-circle-fill"></i> Grafik progress mingguan & bulanan</li>
                    <li><i class="bi bi-check-circle-fill"></i> Tracking kalori terbakar</li>
                    <li><i class="bi bi-check-circle-fill"></i> Streak dan achievement system</li>
                    <li><i class="bi bi-check-circle-fill"></i> BMI calculator & monitoring</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Feature Grid -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Fitur Lengkap Lainnya</h2>
            <p class="section-subtitle mx-auto">
                Berbagai fitur tambahan untuk pengalaman fitness yang lebih baik
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="card-minimal h-100 text-center feature-card">
                    <div class="feature-icon-small mx-auto mb-4">
                        <i class="bi bi-fire"></i>
                    </div>
                    <h5 class="fw-semibold mb-3">Streak System</h5>
                    <p class="text-secondary small mb-0">
                        Jaga konsistensi latihan dengan sistem streak yang memotivasi
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-minimal h-100 text-center feature-card">
                    <div class="feature-icon-small mx-auto mb-4">
                        <i class="bi bi-bell"></i>
                    </div>
                    <h5 class="fw-semibold mb-3">Smart Reminders</h5>
                    <p class="text-secondary small mb-0">
                        Pengingat cerdas untuk latihan, minum air, dan istirahat
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-minimal h-100 text-center feature-card">
                    <div class="feature-icon-small mx-auto mb-4">
                        <i class="bi bi-calculator"></i>
                    </div>
                    <h5 class="fw-semibold mb-3">BMI Calculator</h5>
                    <p class="text-secondary small mb-0">
                        Hitung dan pantau BMI Anda dengan rekomendasi yang sesuai
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-minimal h-100 text-center feature-card">
                    <div class="feature-icon-small mx-auto mb-4">
                        <i class="bi bi-egg-fried"></i>
                    </div>
                    <h5 class="fw-semibold mb-3">Food Recommendations</h5>
                    <p class="text-secondary small mb-0">
                        Rekomendasi makanan berdasarkan BMI dan tujuan fitness
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-minimal h-100 text-center feature-card">
                    <div class="feature-icon-small mx-auto mb-4">
                        <i class="bi bi-moon"></i>
                    </div>
                    <h5 class="fw-semibold mb-3">Dark Mode</h5>
                    <p class="text-secondary small mb-0">
                        Mode gelap yang nyaman untuk mata di malam hari
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-minimal h-100 text-center feature-card">
                    <div class="feature-icon-small mx-auto mb-4">
                        <i class="bi bi-stopwatch"></i>
                    </div>
                    <h5 class="fw-semibold mb-3">Rest Timer</h5>
                    <p class="text-secondary small mb-0">
                        Timer istirahat dengan preset dan notifikasi suara
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-minimal h-100 text-center feature-card">
                    <div class="feature-icon-small mx-auto mb-4">
                        <i class="bi bi-person-badge"></i>
                    </div>
                    <h5 class="fw-semibold mb-3">Profile Management</h5>
                    <p class="text-secondary small mb-0">
                        Kelola profil dengan foto, data fisik, dan preferensi
                    </p>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card-minimal h-100 text-center feature-card">
                    <div class="feature-icon-small mx-auto mb-4">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <h5 class="fw-semibold mb-3">Data Privacy</h5>
                    <p class="text-secondary small mb-0">
                        Data Anda aman dan hanya dapat diakses oleh Anda
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section-padding bg-secondary">
    <div class="container">
        <div class="card-minimal text-center" style="background: linear-gradient(135deg, #ba1a1a 0%, #ff5449 100%); border: none; padding: 4rem 2rem;">
            <h2 class="h1 fw-bold mb-3" style="color: #ffffff !important;">Siap Memulai?</h2>
            <p class="mb-4 mx-auto" style="max-width: 600px; color: rgba(255, 255, 255, 0.95) !important;">
                Bergabunglah sekarang dan rasakan semua fitur Fitkomove secara gratis!
            </p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                <a href="{{ route('register') }}" class="btn btn-lg px-5 cta-btn-primary">
                    Daftar Gratis
                </a>
                <a href="{{ route('demo') }}" class="btn btn-lg px-5" style="background-color: transparent; border: 2px solid white; color: #ffffff; font-weight: 600;">
                    Lihat Demo
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    .feature-image-wrapper {
        background: linear-gradient(135deg, var(--primary-light) 0%, var(--bg-secondary) 100%);
        border-radius: 24px;
        padding: 4rem;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 350px;
    }

    .feature-image-wrapper.alt {
        background: linear-gradient(135deg, var(--bg-secondary) 0%, var(--primary-light) 100%);
    }

    .feature-icon-large {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), #ff5449);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 4rem;
        color: white;
        box-shadow: 0 20px 60px rgba(186, 26, 26, 0.3);
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    .feature-list {
        list-style: none;
        padding: 0;
        margin: 0;
        margin-top: 1.5rem;
    }

    .feature-list li {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.6rem 0;
    }

    [data-theme="dark"] .feature-list li {
        color: #e0e0e0;
    }

    [data-theme="light"] .feature-list li {
        color: #1a1a1a;
    }

    .feature-list li i {
        color: var(--primary);
        font-size: 1.1rem;
    }

    .feature-icon-small {
        width: 70px;
        height: 70px;
        border-radius: 16px;
        background: var(--primary-light);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: var(--primary);
        transition: all 0.3s ease;
    }

    .feature-card:hover .feature-icon-small {
        background: linear-gradient(135deg, var(--primary), #ff5449);
        color: white;
        transform: scale(1.1);
    }

    /* Fix text colors for features page */
    [data-theme="dark"] .feature-card h5,
    [data-theme="dark"] .feature-card .fw-semibold {
        color: #f5f5f5 !important;
    }

    [data-theme="light"] .feature-card h5,
    [data-theme="light"] .feature-card .fw-semibold {
        color: #1a1a1a !important;
    }

    [data-theme="dark"] .feature-card .text-secondary,
    [data-theme="dark"] .feature-card p {
        color: #b0b0b0 !important;
    }

    [data-theme="light"] .feature-card .text-secondary,
    [data-theme="light"] .feature-card p {
        color: #6c757d !important;
    }

    /* Badge spacing fix */
    .badge-minimal {
        margin-bottom: 1rem !important;
    }

    /* Section title spacing */
    .section-title {
        margin-top: 0.75rem !important;
    }

    /* CTA Button Primary - White background with dark text */
    .cta-btn-primary {
        background-color: #ffffff !important;
        color: #1a1a1a !important;
        font-weight: 700 !important;
        border: none !important;
        transition: all 0.3s ease;
    }

    .cta-btn-primary:hover {
        background-color: #f0f0f0 !important;
        color: #000000 !important;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
    }
</style>
@endsection
