@extends('layouts.app')

@section('title', $schedule->title . ' - Fitkomove')

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
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">{{ $schedule->title }}</h4>
                        <span class="badge {{ $schedule->status_badge }}">{{ $schedule->status_label }}</span>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('schedules.edit', $schedule) }}"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                            <li>
                                <form action="{{ route('schedules.destroy', $schedule) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-6">
                        <div class="p-3 rounded-3" style="background-color: var(--bg-secondary);">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="bi bi-calendar text-secondary"></i>
                                <small class="text-secondary">Tanggal</small>
                            </div>
                            <div class="fw-semibold">{{ $schedule->scheduled_date->format('d M Y') }}</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="p-3 rounded-3" style="background-color: var(--bg-secondary);">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                <i class="bi bi-clock text-secondary"></i>
                                <small class="text-secondary">Waktu</small>
                            </div>
                            <div class="fw-semibold">{{ $schedule->formatted_time }}</div>
                        </div>
                    </div>
                </div>

                <div class="border-top pt-4" style="border-color: var(--border) !important;">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary">Jenis Aktivitas</span>
                                <span class="fw-medium text-capitalize">{{ str_replace('_', ' ', $schedule->activity_type) }}</span>
                            </div>
                        </div>
                        @if($schedule->duration_minutes)
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary">Durasi</span>
                                <span class="fw-medium">{{ $schedule->duration_minutes }} menit</span>
                            </div>
                        </div>
                        @endif
                        @if($schedule->is_recurring)
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary">Berulang</span>
                                <span class="fw-medium">{{ $schedule->recurring_days ?? 'Ya' }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @if($schedule->notes)
                <div class="border-top pt-4 mt-4" style="border-color: var(--border) !important;">
                    <h6 class="fw-semibold mb-2">Catatan</h6>
                    <p class="text-secondary mb-0">{{ $schedule->notes }}</p>
                </div>
                @endif

                @if($schedule->status === 'pending')
                <div class="border-top pt-4 mt-4 d-flex gap-2" style="border-color: var(--border) !important;">
                    <form action="{{ route('schedules.complete', $schedule) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-lg me-2"></i>Tandai Selesai
                        </button>
                    </form>
                    <form action="{{ route('schedules.skip', $schedule) }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline">
                            <i class="bi bi-x-lg me-2"></i>Lewati
                        </button>
                    </form>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
