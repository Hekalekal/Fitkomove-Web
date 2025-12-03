@extends('layouts.app')

@section('title', $workout->name . ' - Fitkomove')

@section('content')
<div class="container py-5">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-start mb-4">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('workouts.index') }}">Workouts</a></li>
                    <li class="breadcrumb-item active">{{ $workout->name }}</li>
                </ol>
            </nav>
            <h1 class="h2 fw-bold mb-2">{{ $workout->name }}</h1>
            <div class="d-flex gap-3 text-secondary">
                <span><i class="bi bi-calendar me-1"></i>{{ $workout->created_at->format('d M Y') }}</span>
                <span><i class="bi bi-clock me-1"></i>{{ $workout->formatted_duration }}</span>
            </div>
        </div>
        <form action="{{ route('workouts.destroy', $workout) }}" method="POST" onsubmit="return confirm('Hapus sesi ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-outline text-danger">
                <i class="bi bi-trash me-2"></i>Hapus
            </button>
        </form>
    </div>

    <!-- Summary Cards -->
    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card-minimal text-center">
                <div class="display-5 fw-bold" style="color: var(--primary);">{{ $workout->exercises->count() }}</div>
                <div class="text-secondary">Latihan</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-minimal text-center">
                <div class="display-5 fw-bold" style="color: var(--primary);">{{ $workout->total_sets }}</div>
                <div class="text-secondary">Total Set</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-minimal text-center">
                <div class="display-5 fw-bold" style="color: var(--primary);">{{ $workout->completed_sets }}</div>
                <div class="text-secondary">Set Selesai</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-minimal text-center">
                @php
                    $totalVolume = $workout->exercises->sum(fn($e) => $e->total_volume);
                @endphp
                <div class="display-5 fw-bold" style="color: var(--primary);">{{ number_format($totalVolume) }}</div>
                <div class="text-secondary">Volume (kg)</div>
            </div>
        </div>
    </div>

    <!-- Exercises -->
    <h4 class="fw-semibold mb-4">Detail Latihan</h4>
    
    @foreach($workout->exercises as $exercise)
        <div class="card-minimal mb-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="fw-semibold mb-0">{{ $exercise->exercise_name }}</h5>
                @if($exercise->best_set)
                    <span class="badge bg-primary bg-opacity-10" style="color: var(--primary);">
                        <i class="bi bi-trophy me-1"></i>Best: {{ $exercise->best_set->weight }}kg x {{ $exercise->best_set->reps }}
                    </span>
                @endif
            </div>

            <div class="table-responsive">
                <table class="table table-borderless mb-0">
                    <thead>
                        <tr class="text-secondary small">
                            <th>SET</th>
                            <th>BERAT</th>
                            <th>REPS</th>
                            <th>VOLUME</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exercise->sets as $set)
                            <tr class="{{ $set->is_completed ? '' : 'text-secondary' }}">
                                <td>
                                    <span class="set-badge">{{ $set->set_number }}</span>
                                </td>
                                <td>{{ $set->formatted_weight }}</td>
                                <td>{{ $set->reps ?? '-' }}</td>
                                <td>{{ ($set->weight ?? 0) * ($set->reps ?? 0) }} kg</td>
                                <td>
                                    @if($set->is_completed)
                                        <span class="text-success"><i class="bi bi-check-circle-fill"></i></span>
                                    @else
                                        <span class="text-secondary"><i class="bi bi-circle"></i></span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-3 pt-3 border-top">
                <small class="text-secondary">
                    Total Volume: <strong>{{ number_format($exercise->total_volume) }} kg</strong>
                </small>
            </div>
        </div>
    @endforeach

    @if($workout->notes)
        <div class="card-minimal">
            <h6 class="fw-semibold mb-2">Catatan</h6>
            <p class="text-secondary mb-0">{{ $workout->notes }}</p>
        </div>
    @endif
</div>

<style>
    .set-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--primary-light);
        color: var(--primary);
        font-weight: 600;
        font-size: 0.875rem;
    }
</style>
@endsection
