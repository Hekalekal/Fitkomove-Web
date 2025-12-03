@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center" style="margin-top: 3rem;">
        <div class="col-12 col-md-6 col-lg-5">
            <div class="card-minimal p-4 p-md-5">
                <div class="text-center mb-4">
                    <h2 class="fw-bold mb-2">Welcome back</h2>
                    <p class="text-secondary">Sign in to continue to your dashboard</p>
                </div>
                
                @if ($errors->any())
                    <div class="alert alert-danger border-0 shadow-sm mb-4" 
                         style="background-color: #fee2e2; color: #dc2626; border-radius: 12px;">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" 
                               placeholder="you@example.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    
                    <div class="mb-4">
                        <div class="d-flex justify-content-between mb-2">
                            <label class="form-label mb-0">Password</label>
                            <a href="#" class="text-decoration-none small" style="color: var(--primary);">Forgot?</a>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Enter password" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 mb-3">
                        Sign in
                    </button>

                    <div class="text-center">
                        <span class="text-secondary small">Don't have an account? </span>
                        <a href="{{ route('register') }}" class="text-decoration-none fw-medium" style="color: var(--primary);">Sign up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection