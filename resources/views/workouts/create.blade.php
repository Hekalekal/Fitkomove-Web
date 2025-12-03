@extends('layouts.app')

@section('title', 'Mulai Latihan - Fitkomove')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card-minimal">
                <div class="text-center mb-4">
                    <div class="workout-start-icon mx-auto mb-3">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <h2 class="fw-bold mb-2">Mulai Sesi Latihan</h2>
                    <p class="text-secondary">Beri nama sesi latihan Anda dan mulai mencatat!</p>
                </div>

                <form action="{{ route('workouts.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">Nama Sesi</label>
                        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" 
                               id="name" name="name" value="{{ old('name') }}" 
                               placeholder="contoh: Leg Day, Push Day, Full Body..."
                               required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="notes" class="form-label">Catatan (opsional)</label>
                        <textarea class="form-control" id="notes" name="notes" rows="3" 
                                  placeholder="Tambahkan catatan untuk sesi ini...">{{ old('notes') }}</textarea>
                    </div>

                    <!-- Quick Templates -->
                    <div class="mb-4">
                        <label class="form-label">Template Cepat</label>
                        <div class="d-flex flex-wrap gap-2">
                            <button type="button" class="btn btn-outline btn-sm template-btn" data-name="Push Day">
                                <i class="bi bi-arrow-up-circle me-1"></i>Push Day
                            </button>
                            <button type="button" class="btn btn-outline btn-sm template-btn" data-name="Pull Day">
                                <i class="bi bi-arrow-down-circle me-1"></i>Pull Day
                            </button>
                            <button type="button" class="btn btn-outline btn-sm template-btn" data-name="Leg Day">
                                <i class="bi bi-person-walking me-1"></i>Leg Day
                            </button>
                            <button type="button" class="btn btn-outline btn-sm template-btn" data-name="Full Body">
                                <i class="bi bi-person-arms-up me-1"></i>Full Body
                            </button>
                            <button type="button" class="btn btn-outline btn-sm template-btn" data-name="Cardio">
                                <i class="bi bi-heart-pulse me-1"></i>Cardio
                            </button>
                            <button type="button" class="btn btn-outline btn-sm template-btn" data-name="Core & Abs">
                                <i class="bi bi-bullseye me-1"></i>Core & Abs
                            </button>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <a href="{{ route('workouts.index') }}" class="btn btn-outline flex-grow-1">Batal</a>
                        <button type="submit" class="btn btn-primary flex-grow-1">
                            <i class="bi bi-play-fill me-2"></i>Mulai Latihan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .workout-start-icon {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), #ff6b6b);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2.5rem;
        color: white;
    }

    .template-btn.active {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
    }
</style>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.template-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.getElementById('name').value = this.dataset.name;
            document.querySelectorAll('.template-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>
@endsection
