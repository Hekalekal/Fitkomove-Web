@extends('layouts.app')

@section('title', 'Fitkomove - Track Your Fitness Journey')

@section('content')

<!-- HERO SECTION -->
<section class="section-padding">
    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-6 fade-in-up">
                <h1 class="display-1 mb-4">
                    Track your<br>
                    fitness<br>
                    <span style="color: var(--primary);">journey</span>
                </h1>
                <p class="lead text-secondary mb-5">
                    Simple, powerful fitness tracking. Monitor your progress, set goals, and achieve more.
                </p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                        Get started free
                    </a>
                    <a href="{{ route('demo') }}" class="btn btn-outline btn-lg">
                        <i class="bi bi-play-circle me-2"></i>Lihat Demo
                    </a>
                </div>
                <div class="mt-5">
                    <div class="d-flex gap-4 text-center text-lg-start">
                        <div>
                            <h3 class="fw-bold mb-0">10K+</h3>
                            <small class="text-secondary">Active users</small>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0">50M+</h3>
                            <small class="text-secondary">Workouts tracked</small>
                        </div>
                        <div>
                            <h3 class="fw-bold mb-0">4.9</h3>
                            <small class="text-secondary">App rating</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1571019614242-c5c5dee9f50b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                         class="img-fluid rounded-3 shadow-lg" alt="Fitness tracking">
                    <div class="position-absolute bottom-0 start-0 m-4 card-minimal p-3 shadow-lg floating-card">
                        <div class="d-flex align-items-center gap-3">
                            <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                <i class="bi bi-fire text-white fs-4"></i>
                            </div>
                            <div>
                                <h6 class="mb-0 fw-bold">450 kcal</h6>
                                <small class="text-secondary">Burned today</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FEATURES SECTION -->
<section id="features" class="section-padding bg-secondary">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge-minimal">Features</span>
            <h2 class="section-title mt-3">Everything you need</h2>
            <p class="section-subtitle mx-auto mt-3">
                Powerful tools to help you reach your fitness goals, all in one place.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="card-minimal h-100">
                    <div class="bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3 mb-4">
                        <i class="bi bi-heart-pulse fs-3" style="color: var(--primary);"></i>
                    </div>
                    <h4 class="h5 fw-semibold mb-3">Real-time tracking</h4>
                    <p class="text-secondary mb-0">
                        Monitor your heart rate, calories, and activity in real-time with precision.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-minimal h-100">
                    <div class="bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3 mb-4">
                        <i class="bi bi-graph-up-arrow fs-3" style="color: var(--primary);"></i>
                    </div>
                    <h4 class="h5 fw-semibold mb-3">Progress insights</h4>
                    <p class="text-secondary mb-0">
                        Get detailed analytics and insights about your fitness journey.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-minimal h-100">
                    <div class="bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3 mb-4">
                        <i class="bi bi-people fs-3" style="color: var(--primary);"></i>
                    </div>
                    <h4 class="h5 fw-semibold mb-3">Social features</h4>
                    <p class="text-secondary mb-0">
                        Connect with friends, share achievements, and stay motivated together.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-minimal h-100">
                    <div class="bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3 mb-4">
                        <i class="bi bi-trophy fs-3" style="color: var(--primary);"></i>
                    </div>
                    <h4 class="h5 fw-semibold mb-3">Goal setting</h4>
                    <p class="text-secondary mb-0">
                        Set personalized goals and track your progress towards achieving them.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-minimal h-100">
                    <div class="bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3 mb-4">
                        <i class="bi bi-calendar-check fs-3" style="color: var(--primary);"></i>
                    </div>
                    <h4 class="h5 fw-semibold mb-3">Workout plans</h4>
                    <p class="text-secondary mb-0">
                        Follow curated workout plans tailored to your fitness level and goals.
                    </p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="card-minimal h-100">
                    <div class="bg-primary bg-opacity-10 rounded-3 d-inline-flex p-3 mb-4">
                        <i class="bi bi-phone fs-3" style="color: var(--primary);"></i>
                    </div>
                    <h4 class="h5 fw-semibold mb-3">Cross-platform</h4>
                    <p class="text-secondary mb-0">
                        Access your data anywhere, on any device. iOS, Android, and web.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- HOW IT WORKS -->
<section class="section-padding">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge-minimal">How it works</span>
            <h2 class="section-title mt-3">Start in minutes</h2>
            <p class="section-subtitle mx-auto mt-3">
                Getting started is simple. Just three steps to begin your journey.
            </p>
        </div>

        <div class="row g-5">
            <div class="col-lg-4">
                <div class="text-center">
                    <div class="mx-auto bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3" style="color: var(--primary);">1</span>
                    </div>
                    <h4 class="h5 fw-semibold mb-3">Create account</h4>
                    <p class="text-secondary">
                        Sign up in seconds with just your email. No credit card required.
                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="text-center">
                    <div class="mx-auto bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3" style="color: var(--primary);">2</span>
                    </div>
                    <h4 class="h5 fw-semibold mb-3">Set your goals</h4>
                    <p class="text-secondary">
                        Tell us about your fitness goals and let us customize your experience.
                    </p>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="text-center">
                    <div class="mx-auto bg-primary bg-opacity-10 rounded-circle d-flex align-items-center justify-content-center mb-4" style="width: 80px; height: 80px;">
                        <span class="fw-bold fs-3" style="color: var(--primary);">3</span>
                    </div>
                    <h4 class="h5 fw-semibold mb-3">Start tracking</h4>
                    <p class="text-secondary">
                        Begin your first workout and watch your progress unfold.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="section-padding bg-secondary">
    <div class="container">
        <div class="text-center mb-5">
            <span class="badge-minimal">Testimonials</span>
            <h2 class="section-title mt-3">Loved by thousands</h2>
            <p class="section-subtitle mx-auto mt-3">
                See what our users have to say about their experience.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-lg-4">
                <div class="card-minimal">
                    <div class="d-flex mb-4">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="text-secondary mb-4">
                        "The interface is so clean and intuitive. I love how easy it is to track my workouts and see my progress over time."
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://i.pravatar.cc/100?img=1" alt="User" class="rounded-circle" width="48" height="48">
                        <div>
                            <h6 class="mb-0 fw-semibold">Sarah Johnson</h6>
                            <small class="text-secondary">Marathon Runner</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-minimal">
                    <div class="d-flex mb-4">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="text-secondary mb-4">
                        "Finally, a fitness app that doesn't overcomplicate things. It just works, and I can focus on my workouts."
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://i.pravatar.cc/100?img=12" alt="User" class="rounded-circle" width="48" height="48">
                        <div>
                            <h6 class="mb-0 fw-semibold">Michael Chen</h6>
                            <small class="text-secondary">Fitness Enthusiast</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-minimal">
                    <div class="d-flex mb-4">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                    </div>
                    <p class="text-secondary mb-4">
                        "The analytics and insights have helped me understand my fitness journey better than ever before."
                    </p>
                    <div class="d-flex align-items-center gap-3">
                        <img src="https://i.pravatar.cc/100?img=25" alt="User" class="rounded-circle" width="48" height="48">
                        <div>
                            <h6 class="mb-0 fw-semibold">Emily Rodriguez</h6>
                            <small class="text-secondary">Yoga Instructor</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA SECTION -->
<section class="section-padding">
    <div class="container">
        <div class="card-minimal text-center" style="background: linear-gradient(135deg, #ba1a1a 0%, #ff5449 100%); border: none; padding: 4rem 2rem;">
            <h2 class="section-title mb-3" style="color: #ffffff !important;">Ready to start your journey?</h2>
            <p class="mb-4 mx-auto" style="max-width: 600px; color: rgba(255, 255, 255, 0.95) !important;">
                Join thousands of athletes who are already tracking their fitness with Fitkomove.
            </p>
            <a href="{{ route('register') }}" class="btn btn-lg px-5" style="background-color: #ffffff; color: #1a1a1a !important; font-weight: 700;">
                Get started free
            </a>
        </div>
    </div>
</section>

@endsection