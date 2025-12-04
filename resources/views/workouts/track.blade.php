@extends('layouts.app')

@section('title', $workout->name . ' - Fitkomove')

@section('content')
<div class="container py-4">
    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">{{ $workout->name }}</h1>
            <div class="d-flex align-items-center gap-3">
                <span class="text-secondary">
                    <i class="bi bi-clock me-1"></i>
                    <span id="timer">00:00:00</span>
                </span>
                <span class="badge bg-success">Aktif</span>
            </div>
        </div>
        <div class="d-flex gap-2">
            <form action="{{ route('workouts.finish', $workout) }}" method="POST" id="finishForm">
                @csrf
                <button type="submit" class="btn btn-primary" onclick="return confirm('Selesaikan sesi latihan ini?')">
                    <i class="bi bi-check-lg me-2"></i>Selesai
                </button>
            </form>
        </div>
    </div>

    <div class="row g-4">
        <!-- Main Content - Exercises -->
        <div class="col-lg-8">
            <!-- Add Exercise -->
            <div class="card-minimal mb-4">
                <form id="addExerciseForm" class="d-flex gap-3">
                    @csrf
                    <input type="text" class="form-control" id="exerciseName" name="exercise_name" 
                           placeholder="Nama latihan (contoh: Bench Press, Squat...)" required>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-plus-lg me-2"></i>Tambah
                    </button>
                </form>
            </div>

            <!-- Exercises List -->
            <div id="exercisesList">
                @foreach($workout->exercises as $exercise)
                    <div class="card-minimal mb-3 exercise-card" data-exercise-id="{{ $exercise->id }}">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h5 class="fw-semibold mb-0">{{ $exercise->exercise_name }}</h5>
                            <button type="button" class="btn btn-sm text-danger delete-exercise-btn" 
                                    data-exercise-id="{{ $exercise->id }}">
                                <i class="bi bi-trash"></i>
                            </button>
                        </div>

                        <!-- Sets Table -->
                        <div class="table-responsive">
                            <table class="table table-borderless mb-0 sets-table">
                                <thead>
                                    <tr class="text-secondary small">
                                        <th style="width: 60px;">SET</th>
                                        <th style="width: 100px;">BERAT</th>
                                        <th style="width: 80px;">REPS</th>
                                        <th style="width: 100px;">ISTIRAHAT</th>
                                        <th style="width: 60px;"></th>
                                        <th style="width: 40px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exercise->sets as $set)
                                        <tr class="set-row {{ $set->is_completed ? 'completed' : '' }}" data-set-id="{{ $set->id }}">
                                            <td>
                                                <span class="set-number">{{ $set->set_number }}</span>
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="number" class="form-control weight-input" 
                                                           value="{{ $set->weight }}" placeholder="0" step="0.5">
                                                    <span class="input-group-text">kg</span>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="number" class="form-control form-control-sm reps-input" 
                                                       value="{{ $set->reps }}" placeholder="0">
                                            </td>
                                            <td>
                                                <div class="input-group input-group-sm">
                                                    <input type="number" class="form-control rest-input" 
                                                           value="{{ $set->rest_seconds }}" placeholder="60">
                                                    <span class="input-group-text">s</span>
                                                </div>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button type="button" class="btn btn-sm action-btn complete-set-btn {{ $set->is_completed ? 'btn-completed' : 'btn-incomplete' }}">
                                                    <i class="bi bi-check-lg"></i>
                                                </button>
                                            </td>
                                            <td class="text-center align-middle">
                                                <button type="button" class="btn btn-sm action-btn delete-set-btn btn-delete">
                                                    <i class="bi bi-x-lg"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <button type="button" class="btn btn-outline btn-sm mt-2 add-set-btn" data-exercise-id="{{ $exercise->id }}">
                            <i class="bi bi-plus me-1"></i>Tambah Set
                        </button>
                    </div>
                @endforeach
            </div>

            @if($workout->exercises->count() === 0)
                <div class="card-minimal text-center py-5" id="emptyState">
                    <i class="bi bi-clipboard-plus display-4 text-secondary mb-3"></i>
                    <h5 class="fw-semibold mb-2">Belum ada latihan</h5>
                    <p class="text-secondary">Tambahkan latihan pertama Anda di atas</p>
                </div>
            @endif
        </div>

        <!-- Sidebar - Rest Timer & Stats -->
        <div class="col-lg-4">
            <!-- Rest Timer -->
            <div class="card-minimal mb-4">
                <h6 class="fw-semibold mb-3"><i class="bi bi-stopwatch me-2"></i>Rest Timer</h6>
                <div class="rest-timer-display text-center mb-3">
                    <span id="restTimer" class="display-4 fw-bold">00:00</span>
                </div>
                <div class="d-flex gap-2 mb-3">
                    <button type="button" class="btn btn-outline btn-sm flex-grow-1 rest-preset" data-seconds="30">30s</button>
                    <button type="button" class="btn btn-outline btn-sm flex-grow-1 rest-preset" data-seconds="60">1m</button>
                    <button type="button" class="btn btn-outline btn-sm flex-grow-1 rest-preset" data-seconds="90">1.5m</button>
                    <button type="button" class="btn btn-outline btn-sm flex-grow-1 rest-preset" data-seconds="120">2m</button>
                </div>
                <div class="d-flex gap-2">
                    <button type="button" class="btn btn-primary flex-grow-1" id="startRestBtn">
                        <i class="bi bi-play-fill me-1"></i>Start
                    </button>
                    <button type="button" class="btn btn-outline" id="resetRestBtn">
                        <i class="bi bi-arrow-counterclockwise"></i>
                    </button>
                </div>
            </div>

            <!-- Session Stats -->
            <div class="card-minimal">
                <h6 class="fw-semibold mb-3"><i class="bi bi-bar-chart me-2"></i>Statistik Sesi</h6>
                <div class="row g-3">
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="stat-value" id="totalExercises">{{ $workout->exercises->count() }}</div>
                            <div class="stat-label">Latihan</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="stat-value" id="totalSets">{{ $workout->total_sets }}</div>
                            <div class="stat-label">Total Set</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="stat-value" id="completedSets">{{ $workout->completed_sets }}</div>
                            <div class="stat-label">Set Selesai</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="stat-value" id="totalVolume">0</div>
                            <div class="stat-label">Volume (kg)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .exercise-card {
        border-left: 4px solid var(--primary);
    }

    .set-row {
        transition: all 0.2s ease;
    }

    .set-row.completed {
        background: var(--primary-light);
    }

    .set-row.completed .set-number {
        color: var(--primary);
        font-weight: 600;
    }

    .set-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: var(--bg-secondary);
        font-weight: 600;
        font-size: 0.875rem;
    }

    .sets-table input {
        text-align: center;
    }

    .rest-timer-display {
        padding: 1.5rem;
        background: var(--bg-secondary);
        border-radius: 12px;
    }

    #restTimer {
        color: var(--primary);
    }

    #restTimer.warning {
        color: #f59e0b;
        animation: blink 0.5s infinite;
    }

    @keyframes blink {
        50% { opacity: 0.5; }
    }

    .stat-box {
        text-align: center;
        padding: 1rem;
        background: var(--bg-secondary);
        border-radius: 12px;
    }

    .stat-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--primary);
    }

    .stat-label {
        font-size: 0.75rem;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    /* Action Buttons */
    .action-btn {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .action-btn:focus {
        box-shadow: 0 0 0 3px var(--primary-light) !important;
        outline: none;
    }

    /* Complete Button - Incomplete State */
    .btn-incomplete {
        background: var(--bg-secondary);
        border: 1px solid var(--border);
        color: var(--text-secondary);
    }

    .btn-incomplete:hover {
        background: var(--primary-light);
        border-color: var(--primary);
        color: var(--primary);
    }

    /* Complete Button - Completed State */
    .btn-completed {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }

    .btn-completed:hover {
        background: var(--primary-hover);
        border-color: var(--primary-hover);
        color: white;
    }

    /* Delete Button */
    .btn-delete {
        background: transparent;
        border: 1px solid var(--border);
        color: var(--text-secondary);
    }

    .btn-delete:hover {
        background: #fee2e2;
        border-color: #fca5a5;
        color: #dc2626;
    }

    [data-theme="dark"] .btn-delete:hover {
        background: rgba(220, 38, 38, 0.2);
        border-color: #dc2626;
        color: #f87171;
    }

    /* Remove default blue focus for all buttons */
    .btn:focus,
    .btn:active,
    .btn:focus-visible {
        box-shadow: 0 0 0 3px var(--primary-light) !important;
        outline: none !important;
    }

    /* Rest preset buttons active state */
    .rest-preset.active {
        background: var(--primary);
        border-color: var(--primary);
        color: white;
    }
</style>

@endsection

@section('scripts')
<script>
    // Workout Timer - use ISO format for proper parsing
    const startTime = new Date('{{ $workout->started_at->toISOString() }}');
    function updateTimer() {
        const now = new Date();
        let diff = Math.floor((now - startTime) / 1000);
        
        // Ensure diff is not negative
        if (diff < 0) diff = 0;
        
        const hours = Math.floor(diff / 3600).toString().padStart(2, '0');
        const minutes = Math.floor((diff % 3600) / 60).toString().padStart(2, '0');
        const seconds = (diff % 60).toString().padStart(2, '0');
        document.getElementById('timer').textContent = `${hours}:${minutes}:${seconds}`;
    }
    setInterval(updateTimer, 1000);
    updateTimer();

    // Rest Timer
    let restSeconds = 60;
    let restInterval = null;
    let restRunning = false;

    const restTimerEl = document.getElementById('restTimer');
    const startRestBtn = document.getElementById('startRestBtn');
    const resetRestBtn = document.getElementById('resetRestBtn');

    function updateRestDisplay() {
        const mins = Math.floor(restSeconds / 60).toString().padStart(2, '0');
        const secs = (restSeconds % 60).toString().padStart(2, '0');
        restTimerEl.textContent = `${mins}:${secs}`;
        
        if (restSeconds <= 5 && restSeconds > 0) {
            restTimerEl.classList.add('warning');
        } else {
            restTimerEl.classList.remove('warning');
        }
    }

    document.querySelectorAll('.rest-preset').forEach(btn => {
        btn.addEventListener('click', function() {
            restSeconds = parseInt(this.dataset.seconds);
            updateRestDisplay();
            document.querySelectorAll('.rest-preset').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });

    startRestBtn.addEventListener('click', function() {
        if (restRunning) {
            clearInterval(restInterval);
            restRunning = false;
            this.innerHTML = '<i class="bi bi-play-fill me-1"></i>Start';
        } else {
            restRunning = true;
            this.innerHTML = '<i class="bi bi-pause-fill me-1"></i>Pause';
            restInterval = setInterval(() => {
                if (restSeconds > 0) {
                    restSeconds--;
                    updateRestDisplay();
                    if (restSeconds === 0) {
                        playRestEndSound();
                        clearInterval(restInterval);
                        restRunning = false;
                        startRestBtn.innerHTML = '<i class="bi bi-play-fill me-1"></i>Start';
                    }
                }
            }, 1000);
        }
    });

    resetRestBtn.addEventListener('click', function() {
        clearInterval(restInterval);
        restRunning = false;
        restSeconds = 60;
        updateRestDisplay();
        startRestBtn.innerHTML = '<i class="bi bi-play-fill me-1"></i>Start';
    });

    function playRestEndSound() {
        try {
            const ctx = new AudioContext();
            [523.25, 659.25, 783.99].forEach((freq, i) => {
                const osc = ctx.createOscillator();
                const gain = ctx.createGain();
                osc.connect(gain);
                gain.connect(ctx.destination);
                osc.frequency.value = freq;
                osc.type = 'sine';
                gain.gain.setValueAtTime(0.1, ctx.currentTime + i * 0.15);
                gain.gain.exponentialRampToValueAtTime(0.01, ctx.currentTime + i * 0.15 + 0.3);
                osc.start(ctx.currentTime + i * 0.15);
                osc.stop(ctx.currentTime + i * 0.15 + 0.3);
            });
        } catch(e) {}
    }

    // Add Exercise
    document.getElementById('addExerciseForm').addEventListener('submit', async function(e) {
        e.preventDefault();
        const name = document.getElementById('exerciseName').value;
        if (!name) return;

        const response = await fetch('{{ route("workouts.addExercise", $workout) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ exercise_name: name })
        });

        if (response.ok) {
            location.reload();
        }
    });

    // Add Set
    document.querySelectorAll('.add-set-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            const exerciseId = this.dataset.exerciseId;
            const response = await fetch(`/exercises/${exerciseId}/set`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                location.reload();
            }
        });
    });

    // Complete Set
    document.querySelectorAll('.complete-set-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            const row = this.closest('.set-row');
            const setId = row.dataset.setId;
            const isCompleted = !row.classList.contains('completed');
            
            const weight = row.querySelector('.weight-input').value;
            const reps = row.querySelector('.reps-input').value;
            const rest = row.querySelector('.rest-input').value;

            const response = await fetch(`/sets/${setId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    weight: weight,
                    reps: reps,
                    rest_seconds: rest,
                    is_completed: isCompleted
                })
            });

            if (response.ok) {
                row.classList.toggle('completed');
                this.classList.toggle('btn-completed');
                this.classList.toggle('btn-incomplete');
                updateStats();
                
                // Auto start rest timer
                if (isCompleted) {
                    restSeconds = parseInt(rest) || 60;
                    updateRestDisplay();
                    if (!restRunning) {
                        startRestBtn.click();
                    }
                }
            }
        });
    });

    // Delete Set
    document.querySelectorAll('.delete-set-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            if (!confirm('Hapus set ini?')) return;
            const row = this.closest('.set-row');
            const setId = row.dataset.setId;

            const response = await fetch(`/sets/${setId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                row.remove();
                updateStats();
            }
        });
    });

    // Delete Exercise
    document.querySelectorAll('.delete-exercise-btn').forEach(btn => {
        btn.addEventListener('click', async function() {
            if (!confirm('Hapus latihan ini beserta semua set-nya?')) return;
            const exerciseId = this.dataset.exerciseId;
            const card = this.closest('.exercise-card');

            const response = await fetch(`/exercises/${exerciseId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });

            if (response.ok) {
                card.remove();
                updateStats();
            }
        });
    });

    // Update Stats
    function updateStats() {
        const exercises = document.querySelectorAll('.exercise-card').length;
        const sets = document.querySelectorAll('.set-row').length;
        const completed = document.querySelectorAll('.set-row.completed').length;
        
        let volume = 0;
        document.querySelectorAll('.set-row.completed').forEach(row => {
            const weight = parseFloat(row.querySelector('.weight-input').value) || 0;
            const reps = parseInt(row.querySelector('.reps-input').value) || 0;
            volume += weight * reps;
        });

        document.getElementById('totalExercises').textContent = exercises;
        document.getElementById('totalSets').textContent = sets;
        document.getElementById('completedSets').textContent = completed;
        document.getElementById('totalVolume').textContent = volume.toFixed(0);
    }

    // Auto-save on input change
    document.querySelectorAll('.weight-input, .reps-input, .rest-input').forEach(input => {
        input.addEventListener('change', async function() {
            const row = this.closest('.set-row');
            const setId = row.dataset.setId;
            
            const weight = row.querySelector('.weight-input').value;
            const reps = row.querySelector('.reps-input').value;
            const rest = row.querySelector('.rest-input').value;
            const isCompleted = row.classList.contains('completed');

            await fetch(`/sets/${setId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    weight: weight,
                    reps: reps,
                    rest_seconds: rest,
                    is_completed: isCompleted
                })
            });

            updateStats();
        });
    });

    updateStats();
</script>
@endsection
