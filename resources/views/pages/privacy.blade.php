@extends('layouts.app')

@section('title', 'Privacy Policy - Fitkomove')

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="badge-minimal">Legal</span>
                    <h1 class="section-title mt-3">Privacy Policy</h1>
                    <p class="text-secondary">Terakhir diperbarui: {{ date('d F Y') }}</p>
                </div>

                <div class="card-minimal">
                    <!-- Intro -->
                    <div class="mb-5">
                        <p class="lead">
                            Privasi Anda penting bagi kami. Kebijakan ini menjelaskan bagaimana Fitkomove mengumpulkan, menggunakan, dan melindungi data Anda.
                        </p>
                    </div>

                    <!-- Section 1 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-collection text-primary me-2"></i>
                            Data yang Kami Kumpulkan
                        </h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check-circle text-primary me-2"></i><strong>Informasi Akun:</strong> Nama, email, dan password terenkripsi</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-primary me-2"></i><strong>Data Profil:</strong> Usia, berat badan, tinggi badan (opsional)</li>
                            <li class="mb-2"><i class="bi bi-check-circle text-primary me-2"></i><strong>Data Aktivitas:</strong> Riwayat latihan, kalori, dan jadwal fitness Anda</li>
                        </ul>
                    </div>

                    <!-- Section 2 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-gear text-primary me-2"></i>
                            Bagaimana Kami Menggunakan Data
                        </h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-arrow-right text-primary me-2"></i>Menyediakan layanan tracking fitness</li>
                            <li class="mb-2"><i class="bi bi-arrow-right text-primary me-2"></i>Menampilkan statistik dan progress Anda</li>
                            <li class="mb-2"><i class="bi bi-arrow-right text-primary me-2"></i>Mengirim pengingat latihan (jika diaktifkan)</li>
                            <li class="mb-2"><i class="bi bi-arrow-right text-primary me-2"></i>Meningkatkan kualitas layanan kami</li>
                        </ul>
                    </div>

                    <!-- Section 3 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-shield-lock text-primary me-2"></i>
                            Keamanan Data
                        </h4>
                        <p class="text-secondary">
                            Kami menggunakan enkripsi dan praktik keamanan standar industri untuk melindungi data Anda. Password Anda di-hash dan tidak pernah disimpan dalam bentuk teks biasa.
                        </p>
                    </div>

                    <!-- Section 4 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-share text-primary me-2"></i>
                            Berbagi Data
                        </h4>
                        <p class="text-secondary">
                            <strong>Kami tidak menjual data Anda.</strong> Data hanya dibagikan jika diwajibkan oleh hukum atau dengan persetujuan eksplisit Anda.
                        </p>
                    </div>

                    <!-- Section 5 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-person-check text-primary me-2"></i>
                            Hak Anda
                        </h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>Mengakses dan mengunduh data Anda</li>
                            <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>Memperbarui atau mengoreksi informasi</li>
                            <li class="mb-2"><i class="bi bi-check2 text-primary me-2"></i>Menghapus akun dan semua data terkait</li>
                        </ul>
                    </div>

                    <!-- Section 6 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-cookie text-primary me-2"></i>
                            Cookies
                        </h4>
                        <p class="text-secondary">
                            Kami menggunakan cookies untuk menjaga sesi login dan preferensi tema (light/dark mode). Tidak ada cookies pelacakan pihak ketiga.
                        </p>
                    </div>

                    <!-- Contact -->
                    <div class="bg-secondary rounded-3 p-4 mt-5">
                        <h5 class="fw-bold mb-2">Ada Pertanyaan?</h5>
                        <p class="text-secondary mb-0">
                            Jika Anda memiliki pertanyaan tentang kebijakan privasi ini, silakan hubungi kami melalui 
                            <a href="https://github.com/SwipeLz/fitkomove_private" target="_blank" rel="noopener noreferrer">GitHub</a>.
                        </p>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="btn btn-outline">
                        <i class="bi bi-arrow-left me-2"></i>Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
