@extends('layouts.app')

@section('title', isset($isDemo) ? 'Demo Dashboard - Fitkomove' : 'Dashboard - Fitkomove')

@section('content')
<div class="container py-5">

    @if(isset($isDemo))
    <div class="alert border-0 shadow-sm d-flex align-items-center justify-content-between mb-4" 
         style="background-color: #fef3c7; color: #92400e; border-radius: 12px;">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-info-circle-fill"></i>
            <span><strong>Mode Demo:</strong> Ini adalah preview dashboard. <a href="{{ route('register') }}" style="color: #92400e; font-weight: 600;">Daftar sekarang</a> untuk menyimpan data Anda.</span>
        </div>
    </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success border-0 shadow-sm d-flex align-items-center justify-content-between mb-4" 
             style="background-color: #d1fae5; color: #047857; border-radius: 12px;">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" style="opacity: 0.5;"></button>
        </div>
    @endif

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 fw-bold mb-1">Dashboard</h1>
            <p class="text-secondary mb-0">Welcome back, {{ $user->name }}</p>
        </div>
        <span class="badge-minimal">{{ date('l, F j') }}</span>
    </div>

    <div class="row g-4">
        
        <!-- Profile Card -->
        <div class="col-lg-4">
            <div class="card-minimal sticky-top" style="top: 100px;">
                <!-- Profile Photo -->
                <div class="text-center mb-4">
                    @if($user->profile_photo_url)
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" 
                             class="rounded-circle mb-3" style="width: 100px; height: 100px; object-fit: cover; border: 4px solid var(--border);">
                    @else
                        <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" 
                             style="width: 100px; height: 100px; background: linear-gradient(135deg, #FC5200, #ff6b35); border: 4px solid var(--border);">
                            <span class="display-5 fw-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif
                    
                    <h4 class="fw-semibold mb-1">{{ $user->name }}</h4>
                    <p class="text-secondary small mb-0">{{ $user->email }}</p>
                </div>
                
                <!-- BMI Card -->
                @if($user->bmi)
                <div class="p-3 rounded-3 mb-4" style="background: linear-gradient(135deg, {{ $user->bmi_color }}20, {{ $user->bmi_color }}10); border: 1px solid {{ $user->bmi_color }}30;">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <small class="text-secondary">BMI Anda</small>
                            <h3 class="fw-bold mb-0" style="color: {{ $user->bmi_color }};">{{ $user->bmi }}</h3>
                        </div>
                        <div class="text-end">
                            <span class="badge" style="background-color: {{ $user->bmi_color }}; color: white;">{{ $user->bmi_category }}</span>
                        </div>
                    </div>
                </div>
                @endif

                <div class="border-top pt-4 mt-4">
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="text-center p-3 rounded-3" style="background-color: var(--bg-secondary);">
                                <h5 class="fw-bold mb-0">{{ $user->age ?? '—' }}</h5>
                                <small class="text-secondary">Usia</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 rounded-3" style="background-color: var(--bg-secondary);">
                                <h5 class="fw-bold mb-0">{{ $user->gender ?? '—' }}</h5>
                                <small class="text-secondary">Gender</small>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="text-center p-3 rounded-3" style="background-color: var(--bg-secondary);">
                                <h5 class="fw-bold mb-0">{{ $user->height ? $user->height . ' cm' : '—' }}</h5>
                                <small class="text-secondary">Tinggi</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 rounded-3" style="background-color: var(--bg-secondary);">
                                <h5 class="fw-bold mb-0">{{ $user->weight ? $user->weight . ' kg' : '—' }}</h5>
                                <small class="text-secondary">Berat</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-secondary d-block mb-1">Pekerjaan</small>
                        <p class="fw-medium mb-0">{{ $user->job ?? 'Belum diatur' }}</p>
                    </div>
                </div>

                @if(!isset($isDemo))
                <div class="border-top pt-4 mt-4">
                    <button type="button" class="btn btn-outline w-100 mb-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil me-2"></i>Edit Profile
                    </button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn w-100" style="background-color: var(--bg-secondary); color: var(--text-secondary);">
                            <i class="bi bi-box-arrow-right me-2"></i>Sign out
                        </button>
                    </form>
                </div>
                @else
                <div class="border-top pt-4 mt-4">
                    <a href="{{ route('register') }}" class="btn btn-primary w-100 mb-2">
                        <i class="bi bi-person-plus me-2"></i>Daftar Sekarang
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-outline w-100">
                        <i class="bi bi-box-arrow-in-right me-2"></i>Login
                    </a>
                </div>
                @endif
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8">
            
            <!-- Quick Stats -->
            <div class="row g-3 mb-5">
                <div class="col-md-4">
                    <div class="card-minimal">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-3" style="background-color: rgba(252, 82, 0, 0.1);">
                                <i class="bi bi-fire fs-4" style="color: var(--primary);"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">{{ number_format($weeklyStats['calories']) }}</h4>
                                <small class="text-secondary">Kalori Minggu Ini</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-minimal">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-3" style="background-color: rgba(252, 82, 0, 0.1);">
                                <i class="bi bi-clock fs-4" style="color: var(--primary);"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">{{ $weeklyStats['duration'] }}m</h4>
                                <small class="text-secondary">Durasi Minggu Ini</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-minimal">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-3 p-3" style="background-color: rgba(252, 82, 0, 0.1);">
                                <i class="bi bi-trophy fs-4" style="color: var(--primary);"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">{{ $weeklyStats['activities'] }}</h4>
                                <small class="text-secondary">Aktivitas Minggu Ini</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Chart -->
            <div class="card-minimal mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="h5 fw-semibold mb-0">Grafik Aktivitas Mingguan</h4>
                </div>
                <div style="position: relative; height: 250px; width: 100%;">
                    <canvas id="activityChart"></canvas>
                </div>
            </div>

            <!-- Today's Schedule -->
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="h5 fw-semibold mb-0">Jadwal Hari Ini</h4>
                    @if(!isset($isDemo))
                    <a href="{{ route('schedules.create') }}" class="btn btn-sm btn-outline">
                        <i class="bi bi-plus-lg me-1"></i>Tambah
                    </a>
                    @endif
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($schedules as $schedule)
                    <div class="card-minimal">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-center" style="min-width: 70px;">
                                    <div class="fw-semibold">{{ is_object($schedule) ? (isset($schedule->formatted_time) ? $schedule->formatted_time : date('H:i', strtotime($schedule->scheduled_time))) : $schedule['time'] }}</div>
                                </div>
                                <div class="border-start ps-3" style="border-color: var(--border) !important;">
                                    <h6 class="fw-semibold mb-1">{{ is_object($schedule) ? $schedule->title : $schedule['activity'] }}</h6>
                                    <small class="text-secondary">{{ is_object($schedule) ? $schedule->status_label : $schedule['status'] }}</small>
                                </div>
                            </div>
                            @if(!isset($isDemo) && is_object($schedule) && $schedule->status === 'pending')
                            <form action="{{ route('schedules.complete', $schedule) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-outline" title="Tandai Selesai">
                                    <i class="bi bi-check-lg"></i>
                                </button>
                            </form>
                            @endif
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-x text-secondary fs-1 mb-3 d-block"></i>
                        <p class="text-secondary mb-0">Tidak ada jadwal untuk hari ini</p>
                        @if(!isset($isDemo))
                        <a href="{{ route('schedules.create') }}" class="btn btn-primary mt-3">
                            <i class="bi bi-plus-lg me-1"></i>Buat Jadwal
                        </a>
                        @endif
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Reminders -->
            @if($reminders->count() > 0)
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="h5 fw-semibold mb-0"><i class="bi bi-bell me-2"></i>Pengingat Hari Ini</h4>
                    @if(!isset($isDemo))
                    <a href="{{ route('reminders.index') }}" class="text-decoration-none" style="color: var(--primary); font-weight: 500;">Kelola</a>
                    @endif
                </div>
                <div class="row g-3">
                    @foreach($reminders as $reminder)
                    <div class="col-md-6">
                        <div class="card-minimal d-flex align-items-center gap-3">
                            <div class="rounded-3 p-3" style="background-color: rgba(252, 82, 0, 0.1);">
                                <i class="bi {{ $reminder->type_icon }} fs-4" style="color: var(--primary);"></i>
                            </div>
                            <div>
                                <h6 class="fw-semibold mb-0">{{ $reminder->title }}</h6>
                                <small class="text-secondary">{{ $reminder->formatted_time }}</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recent Activities -->
            @if($recentActivities->count() > 0)
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="h5 fw-semibold mb-0">Aktivitas Terakhir</h4>
                    @if(!isset($isDemo))
                    <a href="{{ route('activities.index') }}" class="text-decoration-none" style="color: var(--primary); font-weight: 500;">Lihat Semua</a>
                    @endif
                </div>
                <div class="d-flex flex-column gap-3">
                    @foreach($recentActivities as $activity)
                    <div class="card-minimal">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-3 p-3" style="background-color: rgba(252, 82, 0, 0.1);">
                                    <i class="bi {{ $activity->type_icon }} fs-4" style="color: var(--primary);"></i>
                                </div>
                                <div>
                                    <h6 class="fw-semibold mb-1">{{ $activity->title }}</h6>
                                    <small class="text-secondary">{{ $activity->type_label }} • {{ $activity->activity_date->format('d M Y') }}</small>
                                </div>
                            </div>
                            <div class="text-end">
                                <div class="fw-semibold">{{ $activity->calories_burned }} kal</div>
                                <small class="text-secondary">{{ $activity->duration_minutes }} menit</small>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Recommended Workouts -->
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="h5 fw-semibold mb-0">Rekomendasi Olahraga</h4>
                </div>

                <div class="row g-3">
                    @foreach($recommendations as $rec)
                    <div class="col-md-6">
                        <div class="card-minimal h-100">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div>
                                    <span class="badge-minimal mb-2">{{ $rec['level'] }}</span>
                                    <h5 class="h6 fw-semibold mb-1">{{ $rec['title'] }}</h5>
                                    <small class="text-secondary">{{ $rec['duration'] }}</small>
                                    @if(isset($rec['description']))
                                    <p class="text-secondary small mt-2 mb-0">{{ $rec['description'] }}</p>
                                    @endif
                                </div>
                            </div>
                            @if(!isset($isDemo))
                            <a href="{{ route('activities.create') }}?type={{ $rec['type'] ?? 'workout' }}" class="btn btn-outline w-100">
                                Mulai Workout
                            </a>
                            @else
                            <button class="btn btn-outline w-100" disabled>Mulai Workout</button>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Food Recommendations -->
            <div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="h5 fw-semibold mb-0"><i class="bi bi-egg-fried me-2"></i>Rekomendasi Makanan</h4>
                </div>

                <div class="row g-3">
                    @foreach($foodRecommendations as $food)
                    <div class="col-md-6 col-lg-3">
                        <div class="card-minimal h-100 text-center">
                            <span class="badge-minimal mb-2">{{ $food['type'] }}</span>
                            <h6 class="fw-semibold mb-1">{{ $food['name'] }}</h6>
                            <p class="text-secondary small mb-2">{{ $food['calories'] }} kal</p>
                            <small class="text-secondary">{{ $food['benefit'] }}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@if(!isset($isDemo))
<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; background-color: var(--card-bg);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-semibold">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <!-- Photo Upload -->
                    <div class="text-center mb-4">
                        @if($user->profile_photo_url)
                            <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" 
                                 class="rounded-circle mb-3" style="width: 80px; height: 80px; object-fit: cover;">
                        @else
                            <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle" 
                                 style="width: 80px; height: 80px; background: linear-gradient(135deg, #FC5200, #ff6b35);">
                                <span class="fs-3 fw-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <button type="button" class="btn btn-sm btn-outline" data-bs-toggle="modal" data-bs-target="#uploadPhotoModal">
                            <i class="bi bi-camera me-1"></i>Ubah Foto
                        </button>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control" value="{{ $user->birth_date?->format('Y-m-d') }}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Usia</label>
                            <input type="number" name="age" class="form-control" value="{{ $user->age }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Pilih...</option>
                                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Pekerjaan</label>
                            <input type="text" name="job" class="form-control" value="{{ $user->job }}">
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    <h6 class="fw-semibold mb-3">Data Fisik (untuk BMI)</h6>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Tinggi Badan (cm)</label>
                            <input type="number" step="0.1" name="height" class="form-control" value="{{ $user->height }}" placeholder="170">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Berat Badan (kg)</label>
                            <input type="number" step="0.1" name="weight" class="form-control" value="{{ $user->weight }}" placeholder="70">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Target Berat (kg)</label>
                            <input type="number" step="0.1" name="target_weight" class="form-control" value="{{ $user->target_weight }}" placeholder="65">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tujuan Fitness</label>
                            <select name="goal" class="form-control">
                                <option value="">Pilih...</option>
                                <option value="lose" {{ $user->goal == 'lose' ? 'selected' : '' }}>Menurunkan Berat</option>
                                <option value="maintain" {{ $user->goal == 'maintain' ? 'selected' : '' }}>Menjaga Berat</option>
                                <option value="gain" {{ $user->goal == 'gain' ? 'selected' : '' }}>Menaikkan Berat</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Intensitas Latihan</label>
                            <select name="intensity_level" class="form-control">
                                <option value="">Pilih...</option>
                                <option value="low" {{ $user->intensity_level == 'low' ? 'selected' : '' }}>Rendah (1-2x/minggu)</option>
                                <option value="medium" {{ $user->intensity_level == 'medium' ? 'selected' : '' }}>Sedang (3-4x/minggu)</option>
                                <option value="high" {{ $user->intensity_level == 'high' ? 'selected' : '' }}>Tinggi (5-7x/minggu)</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Upload Photo Modal -->
<div class="modal fade" id="uploadPhotoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px; background-color: var(--card-bg);">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-semibold">Upload Foto Profil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.photo') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Pilih Foto</label>
                        <input type="file" name="photo" class="form-control" accept="image/*" required>
                        <small class="text-secondary">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.1/dist/chart.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Activity Chart
        const canvas = document.getElementById('activityChart');
        if (canvas) {
            const ctx = canvas.getContext('2d');
            const chartData = @json($chartData);
            
            // Destroy existing chart if any
            if (window.activityChartInstance) {
                window.activityChartInstance.destroy();
            }
            
            window.activityChartInstance = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: chartData.labels,
                    datasets: [{
                        label: 'Kalori Terbakar',
                        data: chartData.calories,
                        backgroundColor: 'rgba(252, 82, 0, 0.8)',
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    animation: {
                        duration: 1000,
                        easing: 'easeOutQuart'
                    },
                    plugins: {
                        legend: {
                            display: false
                        },
                        tooltip: {
                            backgroundColor: 'rgba(0,0,0,0.8)',
                            padding: 12,
                            cornerRadius: 8,
                            callbacks: {
                                label: function(context) {
                                    return context.parsed.y + ' kalori';
                                }
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.05)'
                            },
                            ticks: {
                                callback: function(value) {
                                    return value + ' kal';
                                }
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        }

        // Browser Notification for Reminders
        if ('Notification' in window && Notification.permission === 'default') {
            Notification.requestPermission();
        }
    });
</script>
@endsection