@extends('layouts.app')

@section('title', 'Edit Aktivitas - Fitkomove')

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
                <h4 class="fw-bold mb-4">Edit Aktivitas</h4>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 mb-4" style="background-color: #fee2e2; color: #dc2626; border-radius: 12px;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('activities.update', $activity) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Jenis Aktivitas</label>
                            <select name="type" class="form-control" required>
                                <option value="">Pilih jenis...</option>
                                <option value="running" {{ $activity->type == 'running' ? 'selected' : '' }}>Lari</option>
                                <option value="cycling" {{ $activity->type == 'cycling' ? 'selected' : '' }}>Bersepeda</option>
                                <option value="workout" {{ $activity->type == 'workout' ? 'selected' : '' }}>Workout</option>
                                <option value="swimming" {{ $activity->type == 'swimming' ? 'selected' : '' }}>Berenang</option>
                                <option value="walking" {{ $activity->type == 'walking' ? 'selected' : '' }}>Jalan Kaki</option>
                                <option value="yoga" {{ $activity->type == 'yoga' ? 'selected' : '' }}>Yoga</option>
                                <option value="hiit" {{ $activity->type == 'hiit' ? 'selected' : '' }}>HIIT</option>
                                <option value="strength" {{ $activity->type == 'strength' ? 'selected' : '' }}>Strength Training</option>
                                <option value="other" {{ $activity->type == 'other' ? 'selected' : '' }}>Lainnya</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Judul Aktivitas</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title', $activity->title) }}" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" name="activity_date" class="form-control" value="{{ old('activity_date', $activity->activity_date->format('Y-m-d')) }}" required>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Waktu Mulai</label>
                            <input type="time" name="start_time" class="form-control" value="{{ old('start_time', $activity->start_time ? date('H:i', strtotime($activity->start_time)) : '') }}">
                        </div>
                        <div class="col-md-3 mb-3">
                            <label class="form-label">Waktu Selesai</label>
                            <input type="time" name="end_time" class="form-control" value="{{ old('end_time', $activity->end_time ? date('H:i', strtotime($activity->end_time)) : '') }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Durasi (menit)</label>
                            <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes', $activity->duration_minutes) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Jarak (km)</label>
                            <input type="number" step="0.1" name="distance_km" class="form-control" value="{{ old('distance_km', $activity->distance_km) }}">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="form-label">Kalori Terbakar</label>
                            <input type="number" name="calories_burned" class="form-control" value="{{ old('calories_burned', $activity->calories_burned) }}">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Pace (min/km)</label>
                            <input type="text" name="pace" class="form-control" value="{{ old('pace', $activity->pace) }}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Rata-rata Detak Jantung</label>
                            <input type="number" name="heart_rate_avg" class="form-control" value="{{ old('heart_rate_avg', $activity->heart_rate_avg) }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea name="description" class="form-control" rows="2">{{ old('description', $activity->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="2">{{ old('notes', $activity->notes) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('activities.index') }}" class="btn btn-outline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
