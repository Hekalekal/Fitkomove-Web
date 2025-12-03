@extends('layouts.app')

@section('title', 'Tambah Aktivitas - Fitkomove')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="mb-4">
                <a href="{{ route('activities.index') }}" class="text-decoration-none text-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="card-minimal">
                <h4 class="fw-bold mb-4">Tambah Aktivitas Baru</h4>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 mb-4" style="background-color: #fee2e2; color: #dc2626; border-radius: 12px;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('activities.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Aktivitas</label>
                            <select name="type" class="form-control" required>
                                <option value="">Pilih jenis...</option>
                                <option value="running" {{ request('type') == 'running' || old('type') == 'running' ? 'selected' : '' }}>Lari</option>
                                <option value="cycling" {{ request('type') == 'cycling' || old('type') == 'cycling' ? 'selected' : '' }}>Bersepeda</option>
                                <option value="workout" {{ request('type') == 'workout' || old('type') == 'workout' ? 'selected' : '' }}>Workout</option>
                                <option value="swimming" {{ request('type') == 'swimming' || old('type') == 'swimming' ? 'selected' : '' }}>Berenang</option>
                                <option value="walking" {{ request('type') == 'walking' || old('type') == 'walking' ? 'selected' : '' }}>Jalan Kaki</option>
                                <option value="yoga" {{ request('type') == 'yoga' || old('type') == 'yoga' ? 'selected' : '' }}>Yoga</option>
                                <option value="hiit" {{ request('type') == 'hiit' || old('type') == 'hiit' ? 'selected' : '' }}>HIIT</option>
                                <option value="strength" {{ request('type') == 'strength' || old('type') == 'strength' ? 'selected' : '' }}>Strength Training</option>
                                <option value="other" {{ old('type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Judul Aktivitas</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Lari Pagi" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="activity_date" class="form-control" value="{{ old('activity_date', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Waktu Mulai</label>
                            <input type="time" name="start_time" class="form-control" value="{{ old('start_time') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Waktu Selesai</label>
                            <input type="time" name="end_time" class="form-control" value="{{ old('end_time') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Durasi (menit)</label>
                            <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes') }}" placeholder="30">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jarak (km)</label>
                            <input type="number" step="0.1" name="distance_km" class="form-control" value="{{ old('distance_km') }}" placeholder="5.0">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kalori Terbakar</label>
                            <input type="number" name="calories_burned" class="form-control" value="{{ old('calories_burned') }}" placeholder="Auto jika kosong">
                            <small class="text-secondary">Kosongkan untuk kalkulasi otomatis</small>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pace (min/km)</label>
                            <input type="text" name="pace" class="form-control" value="{{ old('pace') }}" placeholder="5:30">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rata-rata Detak Jantung</label>
                            <input type="number" name="heart_rate_avg" class="form-control" value="{{ old('heart_rate_avg') }}" placeholder="120">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="2" placeholder="Deskripsi singkat aktivitas...">{{ old('description') }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Catatan tambahan...">{{ old('notes') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Simpan Aktivitas
                        </button>
                        <a href="{{ route('activities.index') }}" class="btn btn-outline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
