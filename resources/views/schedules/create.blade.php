@extends('layouts.app')

@section('title', 'Buat Jadwal - Fitkomove')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="mb-4">
                <a href="{{ route('schedules.index') }}" class="text-decoration-none text-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="card-minimal">
                <h4 class="fw-bold mb-4">Buat Jadwal Baru</h4>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 mb-4" style="background-color: #fee2e2; color: #dc2626; border-radius: 12px;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('schedules.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Jadwal</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Lari Pagi" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Aktivitas</label>
                        <select name="activity_type" class="form-control" required>
                            <option value="">Pilih jenis...</option>
                            <option value="running" {{ old('activity_type') == 'running' ? 'selected' : '' }}>Lari</option>
                            <option value="cycling" {{ old('activity_type') == 'cycling' ? 'selected' : '' }}>Bersepeda</option>
                            <option value="workout" {{ old('activity_type') == 'workout' ? 'selected' : '' }}>Workout</option>
                            <option value="swimming" {{ old('activity_type') == 'swimming' ? 'selected' : '' }}>Berenang</option>
                            <option value="walking" {{ old('activity_type') == 'walking' ? 'selected' : '' }}>Jalan Kaki</option>
                            <option value="yoga" {{ old('activity_type') == 'yoga' ? 'selected' : '' }}>Yoga</option>
                            <option value="hiit" {{ old('activity_type') == 'hiit' ? 'selected' : '' }}>HIIT</option>
                            <option value="strength" {{ old('activity_type') == 'strength' ? 'selected' : '' }}>Strength Training</option>
                            <option value="other" {{ old('activity_type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="scheduled_date" class="form-control" value="{{ old('scheduled_date', date('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Waktu</label>
                            <input type="time" name="scheduled_time" class="form-control" value="{{ old('scheduled_time', '08:00') }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Durasi (menit)</label>
                        <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes') }}" placeholder="30">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="2" placeholder="Catatan tambahan...">{{ old('notes') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Simpan Jadwal
                        </button>
                        <a href="{{ route('schedules.index') }}" class="btn btn-outline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
