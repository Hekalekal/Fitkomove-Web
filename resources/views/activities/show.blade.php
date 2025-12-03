@extends('layouts.app')

@section('title', $activity->title . ' - Fitkomove')

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
                <div class="d-flex align-items-center justify-content-between mb-4">
                    <div class="d-flex align-items-center gap-3">
                        <div class="rounded-3 p-3" style="background-color: var(--primary-light);">
                            <i class="bi {{ $activity->type_icon }} fs-3" style="color: var(--primary);"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold mb-1">{{ $activity->title }}</h4>
                            <span class="text-secondary">{{ $activity->type_label }}</span>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-outline" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('activities.edit', $activity) }}"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                            <li>
                                <form action="{{ route('activities.destroy', $activity) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus aktivitas ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row g-4 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="text-center p-3 rounded-3" style="background-color: var(--bg-secondary);">
                            <div class="fs-4 fw-bold" style="color: var(--primary);">{{ $activity->calories_burned ?? 0 }}</div>
                            <small class="text-secondary">Kalori</small>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="text-center p-3 rounded-3" style="background-color: var(--bg-secondary);">
                            <div class="fs-4 fw-bold">{{ $activity->duration_minutes ?? 0 }}</div>
                            <small class="text-secondary">Menit</small>
                        </div>
                    </div>
                    @if($activity->distance_km)
                    <div class="col-6 col-md-3">
                        <div class="text-center p-3 rounded-3" style="background-color: var(--bg-secondary);">
                            <div class="fs-4 fw-bold">{{ $activity->distance_km }}</div>
                            <small class="text-secondary">Kilometer</small>
                        </div>
                    </div>
                    @endif
                    @if($activity->heart_rate_avg)
                    <div class="col-6 col-md-3">
                        <div class="text-center p-3 rounded-3" style="background-color: var(--bg-secondary);">
                            <div class="fs-4 fw-bold">{{ $activity->heart_rate_avg }}</div>
                            <small class="text-secondary">BPM</small>
                        </div>
                    </div>
                    @endif
                </div>

                <div class="border-top pt-4" style="border-color: var(--border) !important;">
                    <h6 class="fw-semibold mb-3">Detail Aktivitas</h6>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary">Tanggal</span>
                                <span class="fw-medium">{{ $activity->activity_date->format('d M Y') }}</span>
                            </div>
                        </div>
                        @if($activity->start_time)
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary">Waktu Mulai</span>
                                <span class="fw-medium">{{ date('H:i', strtotime($activity->start_time)) }}</span>
                            </div>
                        </div>
                        @endif
                        @if($activity->end_time)
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary">Waktu Selesai</span>
                                <span class="fw-medium">{{ date('H:i', strtotime($activity->end_time)) }}</span>
                            </div>
                        </div>
                        @endif
                        @if($activity->pace)
                        <div class="col-md-6">
                            <div class="d-flex justify-content-between">
                                <span class="text-secondary">Pace</span>
                                <span class="fw-medium">{{ $activity->pace }} min/km</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                @if($activity->description)
                <div class="border-top pt-4 mt-4" style="border-color: var(--border) !important;">
                    <h6 class="fw-semibold mb-2">Deskripsi</h6>
                    <p class="text-secondary mb-0">{{ $activity->description }}</p>
                </div>
                @endif

                @if($activity->notes)
                <div class="border-top pt-4 mt-4" style="border-color: var(--border) !important;">
                    <h6 class="fw-semibold mb-2">Catatan</h6>
                    <p class="text-secondary mb-0">{{ $activity->notes }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
