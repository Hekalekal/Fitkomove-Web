@extends('layouts.app')

@section('title', 'Terms of Service - Fitkomove')

@section('content')
<section class="section-padding">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <span class="badge-minimal">Legal</span>
                    <h1 class="section-title mt-3">Terms of Service</h1>
                    <p class="text-secondary">Terakhir diperbarui: {{ date('d F Y') }}</p>
                </div>

                <div class="card-minimal">
                    <!-- Intro -->
                    <div class="mb-5">
                        <p class="lead">
                            Dengan menggunakan Fitkomove, Anda menyetujui syarat dan ketentuan berikut. Harap baca dengan seksama.
                        </p>
                    </div>

                    <!-- Section 1 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-1-circle text-primary me-2"></i>
                            Tentang Layanan
                        </h4>
                        <p class="text-secondary">
                            Fitkomove adalah platform tracking fitness yang membantu Anda mencatat aktivitas olahraga, mengatur jadwal latihan, dan memantau progress kesehatan Anda.
                        </p>
                    </div>

                    <!-- Section 2 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-2-circle text-primary me-2"></i>
                            Akun Pengguna
                        </h4>
                        <ul class="list-unstyled">
                            <li class="mb-2"><i class="bi bi-dot text-primary fs-4 me-1"></i>Anda bertanggung jawab menjaga keamanan akun Anda</li>
                            <li class="mb-2"><i class="bi bi-dot text-primary fs-4 me-1"></i>Gunakan informasi yang akurat saat mendaftar</li>
                            <li class="mb-2"><i class="bi bi-dot text-primary fs-4 me-1"></i>Satu orang hanya boleh memiliki satu akun</li>
                            <li class="mb-2"><i class="bi bi-dot text-primary fs-4 me-1"></i>Anda harus berusia minimal 13 tahun</li>
                        </ul>
                    </div>

                    <!-- Section 3 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-3-circle text-primary me-2"></i>
                            Penggunaan yang Diperbolehkan
                        </h4>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="bg-secondary rounded-3 p-3 h-100">
                                    <h6 class="fw-semibold text-success mb-2"><i class="bi bi-check-lg me-1"></i> Boleh</h6>
                                    <ul class="list-unstyled small text-secondary mb-0">
                                        <li>• Mencatat aktivitas fitness pribadi</li>
                                        <li>• Mengatur jadwal dan pengingat</li>
                                        <li>• Melihat statistik progress</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="bg-secondary rounded-3 p-3 h-100">
                                    <h6 class="fw-semibold text-danger mb-2"><i class="bi bi-x-lg me-1"></i> Tidak Boleh</h6>
                                    <ul class="list-unstyled small text-secondary mb-0">
                                        <li>• Menyalahgunakan sistem</li>
                                        <li>• Mengakses akun orang lain</li>
                                        <li>• Melakukan aktivitas ilegal</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Section 4 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-4-circle text-primary me-2"></i>
                            Konten Pengguna
                        </h4>
                        <p class="text-secondary">
                            Data yang Anda masukkan (aktivitas, jadwal, dll) adalah milik Anda. Kami hanya menyimpan dan menampilkannya untuk keperluan layanan. Anda dapat menghapus data kapan saja.
                        </p>
                    </div>

                    <!-- Section 5 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-5-circle text-primary me-2"></i>
                            Disclaimer Kesehatan
                        </h4>
                        <div class="alert border-0 p-3 rounded-3" style="background-color: #fff3cd; color: #664d03;">
                            <i class="bi bi-exclamation-triangle me-2"></i>
                            <strong>Penting:</strong> Fitkomove bukan pengganti saran medis profesional. Selalu konsultasikan dengan dokter sebelum memulai program latihan baru, terutama jika Anda memiliki kondisi kesehatan tertentu.
                        </div>
                    </div>

                    <!-- Section 6 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-6-circle text-primary me-2"></i>
                            Batasan Tanggung Jawab
                        </h4>
                        <p class="text-secondary">
                            Fitkomove disediakan "sebagaimana adanya". Kami berusaha menjaga layanan tetap berjalan, namun tidak menjamin ketersediaan 100%. Kami tidak bertanggung jawab atas cedera yang terjadi selama latihan.
                        </p>
                    </div>

                    <!-- Section 7 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-7-circle text-primary me-2"></i>
                            Perubahan Ketentuan
                        </h4>
                        <p class="text-secondary">
                            Kami dapat memperbarui ketentuan ini sewaktu-waktu. Perubahan signifikan akan diumumkan melalui aplikasi. Penggunaan berkelanjutan setelah perubahan berarti Anda menyetujui ketentuan baru.
                        </p>
                    </div>

                    <!-- Section 8 -->
                    <div class="mb-4">
                        <h4 class="fw-bold mb-3">
                            <i class="bi bi-8-circle text-primary me-2"></i>
                            Penghentian Akun
                        </h4>
                        <p class="text-secondary">
                            Anda dapat menghapus akun kapan saja. Kami juga berhak menangguhkan akun yang melanggar ketentuan ini.
                        </p>
                    </div>

                    <!-- Agreement -->
                    <div class="bg-secondary rounded-3 p-4 mt-5 text-center">
                        <i class="bi bi-hand-thumbs-up fs-1 text-primary mb-3 d-block"></i>
                        <h5 class="fw-bold mb-2">Dengan Menggunakan Fitkomove</h5>
                        <p class="text-secondary mb-0">
                            Anda menyatakan telah membaca, memahami, dan menyetujui syarat dan ketentuan di atas.
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
