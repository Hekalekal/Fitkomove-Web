@extends('layouts.app')

@section('title', 'Pengingat - Fitkomove')

@section('content')
<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 fw-bold mb-1">Pengingat</h1>
            <p class="text-secondary mb-0">Atur pengingat untuk olahraga dan istirahat</p>
        </div>
        <a href="{{ route('reminders.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Tambah Pengingat
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

    @if($reminders->count() > 0)
    <div class="row g-4">
        @foreach($reminders as $reminder)
        <div class="col-md-6 col-lg-4">
            <div class="card-minimal h-100 {{ !$reminder->is_active ? 'opacity-50' : '' }}">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="rounded-3 p-3" style="background-color: rgba(252, 82, 0, 0.1);">
                        <i class="bi {{ $reminder->type_icon }} fs-4" style="color: var(--primary);"></i>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline" data-bs-toggle="dropdown">
                            <i class="bi bi-three-dots-vertical"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form action="{{ route('reminders.toggle', $reminder) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi {{ $reminder->is_active ? 'bi-pause' : 'bi-play' }} me-2"></i>
                                        {{ $reminder->is_active ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                </form>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('reminders.edit', $reminder) }}"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                            <li>
                                <form action="{{ route('reminders.destroy', $reminder) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pengingat ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger"><i class="bi bi-trash me-2"></i>Hapus</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>

                <h5 class="fw-semibold mb-1">{{ $reminder->title }}</h5>
                <p class="text-secondary small mb-3">{{ $reminder->type_label }}</p>

                <div class="d-flex align-items-center gap-2 mb-2">
                    <i class="bi bi-clock text-secondary"></i>
                    <span class="fw-semibold">{{ $reminder->formatted_time }}</span>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <i class="bi bi-calendar-week text-secondary"></i>
                    <small class="text-secondary">{{ $reminder->days_display }}</small>
                </div>

                @if($reminder->message)
                <p class="text-secondary small mt-3 mb-0">{{ $reminder->message }}</p>
                @endif

                <div class="mt-3 pt-3 border-top">
                    <span class="badge {{ $reminder->is_active ? 'bg-success' : 'bg-secondary' }}">
                        {{ $reminder->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="text-center py-5">
        <i class="bi bi-bell text-secondary fs-1 mb-3 d-block"></i>
        <h5 class="fw-semibold mb-2">Belum ada pengingat</h5>
        <p class="text-secondary mb-4">Buat pengingat untuk membantu rutinitas olahraga Anda</p>
        <a href="{{ route('reminders.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Buat Pengingat
        </a>
    </div>
    @endif
</div>
@endsection
