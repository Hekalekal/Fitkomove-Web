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
        <div class="d-flex align-items-center gap-3">
            <!-- Streak Badge -->
            <div class="streak-badge {{ (is_object($user) && method_exists($user, 'hasActivityToday') && $user->hasActivityToday()) ? 'active' : '' }}">
                <i class="bi bi-fire"></i>
                <span class="streak-count">{{ $user->current_streak ?? 0 }}</span>
            </div>
            <span class="badge-minimal">{{ date('l, F j') }}</span>
        </div>
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
                             style="width: 100px; height: 100px; background: linear-gradient(135deg, #ba1a1a, #ff5449); border: 4px solid var(--border);">
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
                            <div class="rounded-3 p-3" style="background-color: var(--primary-light);">
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
                            <div class="rounded-3 p-3" style="background-color: var(--primary-light);">
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
                            <div class="rounded-3 p-3" style="background-color: var(--primary-light);">
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

            <!-- Monthly Calendar -->
            @if(isset($calendarData))
            <div class="card-minimal mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="h5 fw-semibold mb-0">
                        <i class="bi bi-calendar3 me-2"></i>Kalender {{ $calendarData['month'] }} {{ $calendarData['year'] }}
                    </h4>
                    <div class="d-flex gap-2">
                        <span class="badge bg-success bg-opacity-10 text-success"><i class="bi bi-check-circle me-1"></i>Selesai</span>
                        <span class="badge bg-primary bg-opacity-10" style="color: var(--primary);"><i class="bi bi-star me-1"></i>Rekomendasi</span>
                    </div>
                </div>
                
                <div class="calendar-grid">
                    <!-- Weekday Headers -->
                    @foreach($calendarData['weekdays'] as $weekday)
                    <div class="calendar-header">{{ $weekday }}</div>
                    @endforeach
                    
                    <!-- Calendar Days -->
                    @foreach($calendarData['days'] as $day)
                    <div class="calendar-day {{ $day['day'] === null ? 'empty' : '' }} {{ $day['isToday'] ?? false ? 'today' : '' }} {{ $day['isPast'] ?? false ? 'past' : '' }}">
                        @if($day['day'])
                        <span class="day-number">{{ $day['day'] }}</span>
                        
                        <div class="day-indicators">
                            @if($day['hasActivity'] ?? false)
                            <span class="indicator activity" title="Aktivitas selesai"><i class="bi bi-check-circle-fill"></i></span>
                            @endif
                            
                            @if($day['recommended'] ?? false)
                            <span class="indicator recommended" title="{{ $day['recommended']['name'] ?? 'Latihan' }}">
                                <i class="bi {{ $day['recommended']['icon'] ?? 'bi-lightning' }}"></i>
                            </span>
                            @endif
                        </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                
                <!-- Legend: Keterangan Ikon Olahraga -->
                @php
                    $uniqueRecommendations = collect($calendarData['days'])
                        ->filter(fn($day) => isset($day['recommended']) && $day['recommended'])
                        ->pluck('recommended')
                        ->unique('name')
                        ->values();
                @endphp
                
                @if($uniqueRecommendations->count() > 0)
                <div class="mt-3 pt-3 border-top">
                    <small class="text-secondary d-block mb-2">
                        <i class="bi bi-list-ul me-1"></i><strong>Keterangan Ikon Rekomendasi:</strong>
                    </small>
                    <div class="d-flex flex-wrap gap-3">
                        @foreach($uniqueRecommendations as $rec)
                        <div class="d-flex align-items-center gap-2 px-3 py-2 rounded-3" style="background-color: var(--bg-secondary); border: 1px solid var(--border);">
                            <span class="indicator recommended" style="width: 24px; height: 24px; font-size: 0.75rem;">
                                <i class="bi {{ $rec['icon'] ?? 'bi-lightning' }}"></i>
                            </span>
                            <span class="fw-medium" style="font-size: 0.875rem;">{{ $rec['name'] }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="mt-3 pt-3 border-top">
                    <small class="text-secondary">
                        <i class="bi bi-info-circle me-1"></i>
                        Jadwal rekomendasi berdasarkan tujuan: <strong>{{ ucfirst($user->goal ?? 'maintain') }}</strong> 
                        dengan intensitas <strong>{{ ucfirst($user->intensity_level ?? 'medium') }}</strong>
                    </small>
                </div>
            </div>
            @endif

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
                                <button type="submit" class="btn btn-sm btn-schedule-complete" title="Tandai Selesai">
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
                            <div class="rounded-3 p-3" style="background-color: var(--primary-light);">
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
                                <div class="rounded-3 p-3" style="background-color: var(--primary-light);">
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
                                    <span class="badge-minimal d-inline-block mb-2">{{ $rec['level'] }}</span>
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
                            <span class="badge-minimal d-inline-block mb-3">{{ $food['type'] }}</span>
                            <h6 class="fw-semibold mb-2">{{ $food['name'] }}</h6>
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
                                 style="width: 80px; height: 80px; background: linear-gradient(135deg, #ba1a1a, #ff5449);">
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
                            <div class="custom-datetime-input">
                                <input type="text" name="birth_date" id="birthDate" class="form-control" value="{{ $user->birth_date?->format('Y-m-d') }}" placeholder="Pilih tanggal lahir" readonly>
                                <i class="bi bi-calendar-heart input-icon"></i>
                            </div>
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
                        <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror" accept="image/*" required>
                        @error('photo')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="text-secondary d-block mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</small>
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

<style>
    .streak-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        border-radius: 50px;
        font-weight: 600;
        color: var(--text-secondary);
        transition: all 0.3s ease;
    }

    .streak-badge.active {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        border-color: #f59e0b;
        color: white;
    }

    .streak-badge.active i {
        animation: flame 0.5s ease-in-out infinite alternate;
    }

    @keyframes flame {
        from { transform: scale(1); }
        to { transform: scale(1.2); }
    }

    .streak-count {
        font-size: 1.1rem;
    }

    /* Schedule Complete Button */
    .btn-schedule-complete {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        color: var(--text-secondary);
        transition: all 0.2s ease;
    }

    .btn-schedule-complete:hover {
        background: #d1fae5;
        border-color: #10b981;
        color: #10b981;
    }

    [data-theme="dark"] .btn-schedule-complete:hover {
        background: rgba(16, 185, 129, 0.2);
        border-color: #10b981;
        color: #34d399;
    }

    .btn-schedule-complete:focus {
        box-shadow: 0 0 0 3px var(--primary-light) !important;
        outline: none;
    }

    /* Calendar Styles */
    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 4px;
    }

    .calendar-header {
        text-align: center;
        font-weight: 600;
        font-size: 0.75rem;
        color: var(--text-secondary);
        padding: 0.5rem;
        text-transform: uppercase;
    }

    .calendar-day {
        aspect-ratio: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        position: relative;
        transition: all 0.2s ease;
        min-height: 50px;
    }

    .calendar-day:hover:not(.empty) {
        border-color: var(--primary);
        transform: scale(1.05);
    }

    .calendar-day.empty {
        background: transparent;
        border: none;
    }

    .calendar-day.today {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .calendar-day.today .day-number {
        color: white;
        font-weight: 700;
    }

    .calendar-day.past {
        opacity: 0.5;
    }

    .day-number {
        font-weight: 500;
        font-size: 0.875rem;
        color: var(--text);
    }

    .day-indicators {
        display: flex;
        gap: 2px;
        margin-top: 2px;
    }

    .indicator {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.6rem;
    }

    .indicator.activity {
        background: #22c55e;
        color: white;
    }

    .indicator.recommended {
        background: var(--primary-light);
        color: var(--primary);
    }

    .calendar-day.today .indicator.recommended {
        background: rgba(255,255,255,0.3);
        color: white;
    }

    /* Dashboard text color fixes */
    [data-theme="dark"] .card-minimal h4,
    [data-theme="dark"] .card-minimal h5,
    [data-theme="dark"] .card-minimal h6,
    [data-theme="dark"] .card-minimal .fw-bold,
    [data-theme="dark"] .card-minimal .fw-semibold {
        color: #f5f5f5 !important;
    }

    [data-theme="light"] .card-minimal h4,
    [data-theme="light"] .card-minimal h5,
    [data-theme="light"] .card-minimal h6,
    [data-theme="light"] .card-minimal .fw-bold,
    [data-theme="light"] .card-minimal .fw-semibold {
        color: #1a1a1a !important;
    }

    [data-theme="dark"] .card-minimal .text-secondary,
    [data-theme="dark"] .card-minimal small {
        color: #a0a0a0 !important;
    }

    [data-theme="light"] .card-minimal .text-secondary,
    [data-theme="light"] .card-minimal small {
        color: #6c757d !important;
    }

    /* Fix profile card text */
    [data-theme="dark"] .fw-medium {
        color: #e0e0e0 !important;
    }

    [data-theme="light"] .fw-medium {
        color: #1a1a1a !important;
    }

    /* Fix dashboard header */
    [data-theme="dark"] .h2.fw-bold {
        color: #f5f5f5 !important;
    }

    [data-theme="light"] .h2.fw-bold {
        color: #1a1a1a !important;
    }

    /* Badge spacing in dashboard */
    .badge-minimal {
        margin-bottom: 0.75rem;
    }
</style>
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
                        backgroundColor: 'rgba(186, 26, 26, 0.8)',
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

        // Birth Date Picker with custom year selector
        if (document.getElementById('birthDate')) {
            const birthPicker = flatpickr("#birthDate", {
                locale: "id",
                dateFormat: "Y-m-d",
                altInput: true,
                altFormat: "j F Y",
                disableMobile: true,
                maxDate: "today",
                defaultDate: document.getElementById('birthDate').value || null,
                monthSelectorType: "dropdown",
                onReady: function(selectedDates, dateStr, instance) {
                    if (instance.altInput) {
                        instance.altInput.classList.add('form-control');
                        instance.altInput.style.paddingLeft = '2.5rem';
                        instance.altInput.style.cursor = 'pointer';
                    }
                    
                    // Replace year input with dropdown
                    const yearInput = instance.calendarContainer.querySelector('.numInputWrapper');
                    if (yearInput) {
                        const currentYear = new Date().getFullYear();
                        const startYear = 1940;
                        const selectedYear = selectedDates[0] ? selectedDates[0].getFullYear() : currentYear - 20;
                        
                        // Create year dropdown
                        const yearSelect = document.createElement('select');
                        yearSelect.className = 'flatpickr-year-dropdown';
                        yearSelect.style.cssText = 'background: var(--bg-secondary); color: var(--text); border: 1px solid var(--border); border-radius: 6px; padding: 4px 8px; font-weight: 600; font-size: 14px; cursor: pointer; outline: none;';
                        
                        for (let year = currentYear; year >= startYear; year--) {
                            const option = document.createElement('option');
                            option.value = year;
                            option.textContent = year;
                            if (year === selectedYear) option.selected = true;
                            yearSelect.appendChild(option);
                        }
                        
                        yearSelect.addEventListener('change', function() {
                            const currentDate = instance.selectedDates[0] || new Date();
                            const newDate = new Date(currentDate);
                            newDate.setFullYear(parseInt(this.value));
                            instance.setDate(newDate, true);
                            instance.jumpToDate(newDate);
                        });
                        
                        yearInput.replaceWith(yearSelect);
                        instance._yearSelect = yearSelect;
                    }
                },
                onMonthChange: function(selectedDates, dateStr, instance) {
                    // Update year dropdown when navigating
                    if (instance._yearSelect && instance.currentYear) {
                        instance._yearSelect.value = instance.currentYear;
                    }
                },
                onYearChange: function(selectedDates, dateStr, instance) {
                    if (instance._yearSelect) {
                        instance._yearSelect.value = instance.currentYear;
                    }
                }
            });
        }
    });
</script>
@endsection