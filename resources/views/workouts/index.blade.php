@extends('layouts.app')

@section('title', 'Workout Sessions - Fitkomove')

@section('content')
<div class="container py-5">
    <!-- Header with Streak -->
    <div class="row mb-5">
        <div class="col-lg-8">
            <h1 class="display-5 fw-bold mb-2">Workout Sessions</h1>
            <p class="text-secondary">Catat dan pantau sesi latihan Anda</p>
        </div>
        <div class="col-lg-4">
            <!-- Streak Card -->
            <div class="card-minimal streak-card">
                <div class="d-flex align-items-center gap-3">
                    <div class="streak-icon {{ $user->hasActivityToday() ? 'active' : '' }}">
                        <i class="bi bi-fire"></i>
                    </div>
                    <div>
                        <div class="streak-number">{{ $user->current_streak ?? 0 }}</div>
                        <div class="streak-label">Day Streak</div>
                    </div>
                    <div class="ms-auto text-end">
                        <small class="text-secondary d-block">Best: {{ $user->longest_streak ?? 0 }} days</small>
                        @if($user->streak_freezes > 0)
                            <small class="text-info"><i class="bi bi-snow me-1"></i>{{ $user->streak_freezes }} freeze</small>
                        @endif
                    </div>
                </div>
                @if(!$user->hasActivityToday())
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-warning"><i class="bi bi-exclamation-triangle me-1"></i>Selesaikan latihan hari ini untuk menjaga streak!</small>
                    </div>
                @else
                    <div class="mt-3 pt-3 border-top">
                        <small class="text-success"><i class="bi bi-check-circle me-1"></i>Streak hari ini sudah tercatat!</small>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="d-flex gap-3 mb-4">
        <a href="{{ route('workouts.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-2"></i>Mulai Latihan Baru
        </a>
    </div>

    <!-- Sessions List -->
    @if($sessions->count() > 0)
        <div class="row g-4">
            @foreach($sessions as $session)
                <div class="col-md-6 col-lg-4">
                    <div class="card-minimal h-100">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h5 class="fw-semibold mb-1">{{ $session->name }}</h5>
                                <small class="text-secondary">{{ $session->created_at->format('d M Y, H:i') }}</small>
                            </div>
                            @if($session->is_active)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-secondary">Selesai</span>
                            @endif
                        </div>

                        <div class="d-flex gap-4 mb-3">
                            <div>
                                <div class="fw-bold" style="color: var(--primary);">{{ $session->exercises->count() }}</div>
                                <small class="text-secondary">Latihan</small>
                            </div>
                            <div>
                                <div class="fw-bold" style="color: var(--primary);">{{ $session->total_sets }}</div>
                                <small class="text-secondary">Set</small>
                            </div>
                            <div>
                                <div class="fw-bold" style="color: var(--primary);">{{ $session->formatted_duration }}</div>
                                <small class="text-secondary">Durasi</small>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            @if($session->is_active)
                                <a href="{{ route('workouts.track', $session) }}" class="btn btn-primary btn-sm flex-grow-1">
                                    <i class="bi bi-play-fill me-1"></i>Lanjutkan
                                </a>
                            @else
                                <a href="{{ route('workouts.show', $session) }}" class="btn btn-outline btn-sm flex-grow-1">
                                    <i class="bi bi-eye me-1"></i>Lihat Detail
                                </a>
                            @endif
                            <form action="{{ route('workouts.destroy', $session) }}" method="POST" onsubmit="return confirm('Hapus sesi ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline btn-sm text-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $sessions->links() }}
        </div>
    @else
        <div class="card-minimal text-center py-5">
            <div class="mb-4">
                <i class="bi bi-clipboard-data display-1 text-secondary"></i>
            </div>
            <h4 class="fw-semibold mb-2">Belum ada sesi latihan</h4>
            <p class="text-secondary mb-4">Mulai sesi latihan pertama Anda dan bangun streak!</p>
            <a href="{{ route('workouts.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-2"></i>Mulai Latihan
            </a>
        </div>
    @endif
</div>

<style>
    .streak-card {
        background: linear-gradient(135deg, var(--card-bg) 0%, var(--bg-secondary) 100%);
        border: 2px solid var(--border);
    }

    .streak-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: var(--bg-secondary);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.75rem;
        color: var(--text-secondary);
        transition: all 0.3s ease;
    }

    .streak-icon.active {
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }

    .streak-number {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary);
        line-height: 1;
    }

    .streak-label {
        font-size: 0.85rem;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endsection
