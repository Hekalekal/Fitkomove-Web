@extends('layouts.app')

@section('title', 'Edit Jadwal - Fitkomove')

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
                <h4 class="fw-bold mb-4">Edit Jadwal</h4>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 mb-4" style="background-color: #fee2e2; color: #dc2626; border-radius: 12px;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('schedules.update', $schedule) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Jadwal</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $schedule->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Aktivitas</label>
                        <select name="activity_type" class="form-control" required>
                            <option value="">Pilih jenis...</option>
                            <option value="running" {{ $schedule->activity_type == 'running' ? 'selected' : '' }}>Lari</option>
                            <option value="cycling" {{ $schedule->activity_type == 'cycling' ? 'selected' : '' }}>Bersepeda</option>
                            <option value="workout" {{ $schedule->activity_type == 'workout' ? 'selected' : '' }}>Workout</option>
                            <option value="swimming" {{ $schedule->activity_type == 'swimming' ? 'selected' : '' }}>Berenang</option>
                            <option value="walking" {{ $schedule->activity_type == 'walking' ? 'selected' : '' }}>Jalan Kaki</option>
                            <option value="yoga" {{ $schedule->activity_type == 'yoga' ? 'selected' : '' }}>Yoga</option>
                            <option value="hiit" {{ $schedule->activity_type == 'hiit' ? 'selected' : '' }}>HIIT</option>
                            <option value="strength" {{ $schedule->activity_type == 'strength' ? 'selected' : '' }}>Strength Training</option>
                            <option value="other" {{ $schedule->activity_type == 'other' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tanggal</label>
                            <div class="custom-datetime-input">
                                <input type="text" name="scheduled_date" id="scheduledDate" class="form-control" value="{{ old('scheduled_date', $schedule->scheduled_date->format('Y-m-d')) }}" placeholder="Pilih tanggal" required readonly>
                                <i class="bi bi-calendar3 input-icon"></i>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Waktu</label>
                            <div class="custom-datetime-input">
                                <input type="text" name="scheduled_time" id="scheduledTime" class="form-control" value="{{ old('scheduled_time', $schedule->formatted_time) }}" placeholder="--:--" required readonly>
                                <i class="bi bi-clock input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Durasi (menit)</label>
                        <input type="number" name="duration_minutes" class="form-control" value="{{ old('duration_minutes', $schedule->duration_minutes) }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-control">
                            <option value="pending" {{ $schedule->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="completed" {{ $schedule->status == 'completed' ? 'selected' : '' }}>Selesai</option>
                            <option value="skipped" {{ $schedule->status == 'skipped' ? 'selected' : '' }}>Dilewati</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Catatan</label>
                        <textarea name="notes" class="form-control" rows="2">{{ old('notes', $schedule->notes) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('schedules.index') }}" class="btn btn-outline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    flatpickr("#scheduledDate", {
        locale: "id",
        dateFormat: "Y-m-d",
        altInput: true,
        altFormat: "j F Y",
        disableMobile: true,
        defaultDate: document.getElementById('scheduledDate').value || null
    });

    flatpickr("#scheduledTime", {
        locale: "id",
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        disableMobile: true,
        defaultDate: document.getElementById('scheduledTime').value || null
    });
});
</script>
@endsection
