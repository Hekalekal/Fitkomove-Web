@extends('layouts.app')

@section('title', 'Dashboard - Fitkomove')

@section('content')
<div class="container py-5">

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

    <!-- Header -->
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div>
            <h1 class="h2 fw-bold mb-1">Dashboard</h1>
            <p class="text-secondary mb-0">Welcome back, {{ $user->name }}</p>
        </div>
        <span class="badge-minimal">{{ date('l, F j') }}</span>
    </div>

    <div class="row g-4">
        
        <!-- Profile Card -->
        <div class="col-lg-4">
            <div class="card-minimal sticky-top" style="top: 100px;">
                <div class="text-center mb-4">
                    <div class="mx-auto mb-3 d-flex align-items-center justify-content-center rounded-circle border" 
                         style="width: 100px; height: 100px; background: linear-gradient(135deg, #FC5200, #ff6b35); border: 4px solid var(--border) !important;">
                        <span class="display-5 fw-bold text-white">{{ substr($user->name, 0, 1) }}</span>
                    </div>
                    
                    <h4 class="fw-semibold mb-1">{{ $user->name }}</h4>
                    <p class="text-secondary small mb-0">{{ $user->email }}</p>
                </div>
                
                <div class="border-top pt-4 mt-4">
                    <div class="row g-3 mb-4">
                        <div class="col-6">
                            <div class="text-center p-3 bg-secondary rounded-3">
                                <h5 class="fw-bold mb-0">{{ $user->age ?? '—' }}</h5>
                                <small class="text-secondary">Age</small>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="text-center p-3 bg-secondary rounded-3">
                                <h5 class="fw-bold mb-0">{{ $user->gender ?? '—' }}</h5>
                                <small class="text-secondary">Gender</small>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <small class="text-secondary d-block mb-1">Occupation</small>
                        <p class="fw-medium mb-0">{{ $user->job ?? 'Not set' }}</p>
                    </div>
                </div>

                <div class="border-top pt-4 mt-4">
                    <button type="button" class="btn btn-outline w-100 mb-2" data-bs-toggle="modal" data-bs-target="#editProfileModal">
                        <i class="bi bi-pencil me-2"></i>Edit Profile
                    </button>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn w-100" style="background-color: var(--bg-secondary); color: var(--text-secondary);">
                            <i class="bi bi-box-arrow-right me-2"></i>Sign out
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-8">
            
            <!-- Quick Stats -->
            <div class="row g-3 mb-5">
                <div class="col-md-4">
                    <div class="card-minimal">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-fire fs-4" style="color: var(--primary);"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">450</h4>
                                <small class="text-secondary">Calories</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-minimal">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-clock fs-4" style="color: var(--primary);"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">45m</h4>
                                <small class="text-secondary">Duration</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card-minimal">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary bg-opacity-10 rounded-3 p-3">
                                <i class="bi bi-trophy fs-4" style="color: var(--primary);"></i>
                            </div>
                            <div>
                                <h4 class="fw-bold mb-0">12</h4>
                                <small class="text-secondary">Workouts</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Today's Schedule -->
            <div class="mb-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="h5 fw-semibold mb-0">Today's Schedule</h4>
                    <button class="btn btn-sm btn-outline">
                        <i class="bi bi-plus-lg me-1"></i>Add
                    </button>
                </div>

                <div class="d-flex flex-column gap-3">
                    @forelse($schedules as $schedule)
                    <div class="card-minimal">
                        <div class="d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center gap-3">
                                <div class="text-center" style="min-width: 70px;">
                                    <div class="fw-semibold">{{ $schedule['time'] }}</div>
                                    <small class="text-secondary">AM</small>
                                </div>
                                <div class="border-start ps-3">
                                    <h6 class="fw-semibold mb-1">{{ $schedule['activity'] }}</h6>
                                    <small class="text-secondary">{{ $schedule['status'] }}</small>
                                </div>
                            </div>
                            <button class="btn btn-sm btn-outline">
                                <i class="bi bi-check-lg"></i>
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-5">
                        <i class="bi bi-calendar-x text-secondary fs-1 mb-3 d-block"></i>
                        <p class="text-secondary mb-0">No schedule for today</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Recommended Workouts -->
            <div>
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="h5 fw-semibold mb-0">Recommended for You</h4>
                    <a href="#" class="text-decoration-none" style="color: var(--primary); font-weight: 500;">View all</a>
                </div>

                <div class="row g-3">
                    @foreach($recommendations as $rec)
                    <div class="col-md-6">
                        <div class="card-minimal h-100">
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div>
                                    <span class="badge-minimal mb-2">{{ $rec['level'] }}</span>
                                    <h5 class="h6 fw-semibold mb-1">{{ $rec['title'] }}</h5>
                                    <small class="text-secondary">{{ $rec['duration'] }}</small>
                                </div>
                                <i class="bi bi-heart text-secondary fs-5" style="cursor: pointer;"></i>
                            </div>
                            <button class="btn btn-outline w-100">
                                Start Workout
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Profile Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg" style="border-radius: 16px;">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-semibold">Edit Profile</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="form-label">Age</label>
                            <input type="number" name="age" class="form-control" value="{{ $user->age }}">
                        </div>
                        <div class="col-6 mb-3">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select...</option>
                                <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Occupation</label>
                        <input type="text" name="job" class="form-control" value="{{ $user->job }}">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-outline" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection