@extends('layouts.app')

@section('title', 'Edit Pengingat - Fitkomove')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="mb-4">
                <a href="{{ route('reminders.index') }}" class="text-decoration-none text-secondary">
                    <i class="bi bi-arrow-left me-2"></i>Kembali
                </a>
            </div>

            <div class="card-minimal">
                <h4 class="fw-bold mb-4">Edit Pengingat</h4>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 mb-4" style="background-color: #fee2e2; color: #dc2626; border-radius: 12px;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reminders.update', $reminder) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Pengingat</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title', $reminder->title) }}" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Pengingat</label>
                        <select name="type" class="form-control" required>
                            <option value="">Pilih jenis...</option>
                            <option value="workout" {{ $reminder->type == 'workout' ? 'selected' : '' }}>Olahraga</option>
                            <option value="rest" {{ $reminder->type == 'rest' ? 'selected' : '' }}>Istirahat</option>
                            <option value="hydration" {{ $reminder->type == 'hydration' ? 'selected' : '' }}>Minum Air</option>
                            <option value="meal" {{ $reminder->type == 'meal' ? 'selected' : '' }}>Makan</option>
                            <option value="custom" {{ $reminder->type == 'custom' ? 'selected' : '' }}>Custom</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Waktu Pengingat</label>
                        <div class="custom-datetime-input">
                            <input type="text" name="reminder_time" id="reminderTime" class="form-control" value="{{ old('reminder_time', $reminder->formatted_time) }}" placeholder="--:--" required readonly>
                            <i class="bi bi-clock input-icon"></i>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Hari Aktif</label>
                        <div class="d-flex flex-wrap gap-2">
                            @php
                                $days = [
                                    'mon' => 'Senin',
                                    'tue' => 'Selasa',
                                    'wed' => 'Rabu',
                                    'thu' => 'Kamis',
                                    'fri' => 'Jumat',
                                    'sat' => 'Sabtu',
                                    'sun' => 'Minggu',
                                ];
                                $selectedDays = old('days', $reminder->days_array);
                            @endphp
                            @foreach($days as $key => $label)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="days[]" value="{{ $key }}" id="day_{{ $key }}"
                                       {{ in_array($key, $selectedDays) ? 'checked' : '' }}>
                                <label class="form-check-label" for="day_{{ $key }}">{{ $label }}</label>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-secondary">Kosongkan untuk aktif setiap hari</small>
                    </div>

                    <div class="mb-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1"
                                   {{ old('is_active', $reminder->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">Pengingat Aktif</label>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Pesan (opsional)</label>
                        <textarea name="message" class="form-control" rows="2">{{ old('message', $reminder->message) }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ route('reminders.index') }}" class="btn btn-outline">Batal</a>
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
    flatpickr("#reminderTime", {
        locale: "id",
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
        disableMobile: true,
        defaultDate: document.getElementById('reminderTime').value || null
    });
});
</script>
@endsection
