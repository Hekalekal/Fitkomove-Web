@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 85vh;">
        <div class="col-12 col-md-5 col-lg-4">
            <div class="text-center mb-5">
                <h2 class="fw-bold mb-2">Create account</h2>
                <p class="text-secondary">Start your fitness journey today</p>
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

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <div class="mb-3">
                    <label class="form-label">Full name</label>
                    <input type="text" name="name" class="form-control" 
                           placeholder="John Doe" value="{{ old('name') }}" required autofocus>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" 
                           placeholder="you@example.com" value="{{ old('email') }}" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" 
                           placeholder="At least 8 characters" required>
                    <small class="text-secondary">Must be at least 8 characters</small>
                </div>

                <div class="mb-4">
                    <label class="form-label">Confirm password</label>
                    <input type="password" name="password_confirmation" class="form-control" 
                           placeholder="Re-enter password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">
                    Create account
                </button>

                <div class="text-center">
                    <span class="text-secondary small">Already have an account? </span>
                    <a href="{{ route('login') }}" class="text-decoration-none fw-medium" style="color: var(--primary);">Sign in</a>
                </div>
            </form>

            <div class="text-center mt-4">
                <small class="text-secondary">
                    By signing up, you agree to our 
                    <a href="#" class="text-decoration-none" style="color: var(--primary);">Terms</a> and 
                    <a href="#" class="text-decoration-none" style="color: var(--primary);">Privacy Policy</a>
                </small>
            </div>
        </div>
    </div>
</div>
@endsection