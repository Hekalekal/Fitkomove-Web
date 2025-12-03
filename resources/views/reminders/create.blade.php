@extends('layouts.app')

@section('title', 'Buat Pengingat - Fitkomove')

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
                <h4 class="fw-bold mb-4">Buat Pengingat Baru</h4>

                @if ($errors->any())
                    <div class="alert alert-danger border-0 mb-4" style="background-color: #fee2e2; color: #dc2626; border-radius: 12px;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('reminders.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Judul Pengingat</label>
                        <input type="text" name="title" class="form-control" value="{{ old('title') }}" placeholder="Contoh: Waktu Olahraga!" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Jenis Pengingat</label>
                        <select name="type" class="form-control" required>
                            <option value="">Pilih jenis...</option>
                            <option value="workout" {{ old('type') == 'workout' ? 'selected' : '' }}>Olahraga</option>
                            <option value="rest" {{ old('type') == 'rest' ? 'selected' : '' }}>Istirahat</option>
                            <option value="hydration" {{ old('type') == 'hydration' ? 'selected' : '' }}>Minum Air</option>
                            <option value="meal" {{ old('type') == 'meal' ? 'selected' : '' }}>Makan</option>
                            <option value="custom" {{ old('type') == 'custom' ? 'selected' : '' }}>Custom</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Waktu Pengingat</label>
                        <input type="time" name="reminder_time" class="form-control" value="{{ old('reminder_time', '08:00') }}" required>
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
                            @endphp
                            @foreach($days as $key => $label)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="days[]" value="{{ $key }}" id="day_{{ $key }}"
                                       {{ in_array($key, old('days', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="day_{{ $key }}">{{ $label }}</label>
                            </div>
                            @endforeach
                        </div>
                        <small class="text-secondary">Kosongkan untuk aktif setiap hari</small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Pesan (opsional)</label>
                        <textarea name="message" class="form-control" rows="2" placeholder="Pesan tambahan...">{{ old('message') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Simpan Pengingat
                        </button>
                        <a href="{{ route('reminders.index') }}" class="btn btn-outline">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
