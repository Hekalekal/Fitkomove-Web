@extends('layouts.app')

@section('title', 'Jadwal Olahraga - Fitkomove')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 fw-bold mb-1">Jadwal Olahraga</h1>
            <p class="text-secondary mb-0">Kelola jadwal latihan Anda</p>
        </div>
        <a href="{{ route('schedules.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Tambah Jadwal
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

    @if($schedules->count() > 0)
    <div class="d-flex flex-column gap-3">
        @foreach($schedules as $schedule)
        <div class="card-minimal {{ $schedule->is_today ? 'border-start border-4' : '' }}" style="{{ $schedule->is_today ? 'border-left-color: var(--primary) !important;' : '' }}">
            <div class="d-flex align-items-center justify-content-between">
                <div class="d-flex align-items-center gap-3">
                    <div class="text-center" style="min-width: 80px;">
                        <div class="fw-bold" style="color: var(--primary);">{{ $schedule->scheduled_date->format('d') }}</div>
                        <small class="text-secondary">{{ $schedule->scheduled_date->format('M Y') }}</small>
                    </div>
                    <div class="border-start ps-3" style="border-color: var(--border) !important;">
                        <h6 class="fw-semibold mb-1">{{ $schedule->title }}</h6>
                        <small class="text-secondary">
                            <i class="bi bi-clock me-1"></i>{{ $schedule->formatted_time }}
                            @if($schedule->duration_minutes)
                            • {{ $schedule->duration_minutes }} menit
                            @endif
                        </small>
                    </div>
                </div>
                <div class="d-flex align-items-center gap-3">
                    <span class="badge {{ $schedule->status_badge }}">{{ $schedule->status_label }}</span>
                    
                    @if($schedule->status === 'pending')
                    <div class="d-flex gap-1">
                        <form action="{{ route('schedules.complete', $schedule) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline" title="Selesai">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </form>
                        <form action="{{ route('schedules.skip', $schedule) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline" title="Lewati">
                                <i class="bi bi-x-lg"></i>
                            </button>
                        </form>
                    </div>
                    @endif

                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline" data-bs-toggle="dropdown">
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
            </div>
        </div>
        @endforeach
    </div>

    <div class="mt-4">
        {{ $schedules->links() }}
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-calendar-plus text-secondary fs-1 mb-3 d-block"></i>
        <h5 class="fw-semibold mb-2">Belum ada jadwal</h5>
        <p class="text-secondary mb-4">Buat jadwal latihan untuk membantu konsistensi Anda</p>
        <a href="{{ route('schedules.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Buat Jadwal
        </a>
    </div>
    @endif
</div>
@endsection
