@extends('layouts.app')

@section('title', 'Aktivitas Saya - Fitkomove')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 fw-bold mb-1">Aktivitas Saya</h1>
            <p class="text-secondary mb-0">Riwayat semua aktivitas fisik Anda</p>
        </div>
        <a href="{{ route('activities.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Tambah Aktivitas
        </a>
    </div>

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

    @if($activities->count() > 0)
    <div class="d-flex flex-column gap-3">
        @foreach($activities as $activity)
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
                <div class="d-flex align-items-center gap-4">
                    <div class="text-end d-none d-md-block">
                        @if($activity->distance_km)
                        <div class="fw-semibold">{{ $activity->distance_km }} km</div>
                        <small class="text-secondary">Jarak</small>
                        @endif
                    </div>
                    <div class="text-end d-none d-md-block">
                        <div class="fw-semibold">{{ $activity->duration_minutes }} menit</div>
                        <small class="text-secondary">Durasi</small>
                    </div>
                    <div class="text-end">
                        <div class="fw-semibold" style="color: var(--primary);">{{ $activity->calories_burned }} kal</div>
                        <small class="text-secondary">Kalori</small>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline" data-bs-toggle="dropdown">
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
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $activities->links() }}
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-activity text-secondary fs-1 mb-3 d-block"></i>
        <h5 class="fw-semibold mb-2">Belum ada aktivitas</h5>
        <p class="text-secondary mb-4">Mulai catat aktivitas fisik pertama Anda</p>
        <a href="{{ route('activities.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Tambah Aktivitas
        </a>
    </div>
    @endif
</div>
@endsection
