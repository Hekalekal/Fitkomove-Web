<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\WorkoutSessionController;

// Halaman Depan (Accessible by everyone including guests)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Features Page
Route::get('/features', function () {
    return view('pages.features');
})->name('features');

// Coming Soon Page
Route::get('/coming-soon/{page?}', function ($page = null) {
    $pageData = [
        'pricing' => [
            'title' => 'Pricing - Fitkomove',
            'icon' => 'bi-currency-dollar',
            'badge' => 'Coming Soon',
            'heading' => 'Pricing Plans',
            'description' => 'Kami sedang menyiapkan paket harga terbaik untuk Anda. Nantikan penawaran menarik dari kami!',
            'progress' => 40,
        ],
        'download' => [
            'title' => 'Download - Fitkomove',
            'icon' => 'bi-download',
            'badge' => 'Coming Soon',
            'heading' => 'Mobile App',
            'description' => 'Aplikasi mobile Fitkomove akan segera hadir di iOS dan Android. Latihan kapan saja, di mana saja!',
            'progress' => 55,
        ],
        'blog' => [
            'title' => 'Blog - Fitkomove',
            'icon' => 'bi-journal-richtext',
            'badge' => 'Coming Soon',
            'heading' => 'Fitness Blog',
            'description' => 'Tips, trik, dan artikel seputar fitness dan kesehatan akan segera hadir di blog kami.',
            'progress' => 30,
        ],
        'careers' => [
            'title' => 'Careers - Fitkomove',
            'icon' => 'bi-briefcase',
            'badge' => 'Coming Soon',
            'heading' => 'Join Our Team',
            'description' => 'Kami sedang membangun tim yang luar biasa. Halaman karir akan segera dibuka!',
            'progress' => 25,
        ],
    ];

    $data = $pageData[$page] ?? [
        'title' => 'Coming Soon - Fitkomove',
        'icon' => 'bi-rocket-takeoff',
        'badge' => 'Coming Soon',
        'heading' => 'Segera Hadir!',
        'description' => 'Kami sedang bekerja keras untuk menghadirkan fitur ini. Nantikan update terbaru dari kami!',
        'progress' => 65,
    ];

    return view('pages.coming-soon', $data);
})->name('coming-soon');

// Demo Dashboard untuk Guest
Route::get('/demo', [DashboardController::class, 'demo'])->name('demo');

// --- MENU UNTUK TAMU (Belum Login) ---
Route::middleware('guest')->group(function () {
    // Login
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);

    // Register
    Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// --- MENU UNTUK MEMBER (Sudah Login) ---
Route::middleware('auth')->group(function () {
    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::put('/profile/update', [DashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/photo', [DashboardController::class, 'updatePhoto'])->name('profile.photo');

    // Activities CRUD
    Route::resource('activities', ActivityController::class);
    Route::get('/api/activities/chart', [ActivityController::class, 'chartData'])->name('activities.chart');

    // Schedules CRUD
    Route::resource('schedules', ScheduleController::class);
    Route::post('/schedules/{schedule}/complete', [ScheduleController::class, 'complete'])->name('schedules.complete');
    Route::post('/schedules/{schedule}/skip', [ScheduleController::class, 'skip'])->name('schedules.skip');

    // Reminders CRUD
    Route::resource('reminders', ReminderController::class);
    Route::post('/reminders/{reminder}/toggle', [ReminderController::class, 'toggle'])->name('reminders.toggle');
    Route::get('/api/reminders/today', [ReminderController::class, 'todayReminders'])->name('reminders.today');

    // Workout Sessions
    Route::get('/workouts', [WorkoutSessionController::class, 'index'])->name('workouts.index');
    Route::get('/workouts/create', [WorkoutSessionController::class, 'create'])->name('workouts.create');
    Route::post('/workouts', [WorkoutSessionController::class, 'store'])->name('workouts.store');
    Route::get('/workouts/{workout}', [WorkoutSessionController::class, 'show'])->name('workouts.show');
    Route::get('/workouts/{workout}/track', [WorkoutSessionController::class, 'track'])->name('workouts.track');
    Route::post('/workouts/{workout}/exercise', [WorkoutSessionController::class, 'addExercise'])->name('workouts.addExercise');
    Route::post('/workouts/{workout}/finish', [WorkoutSessionController::class, 'finish'])->name('workouts.finish');
    Route::delete('/workouts/{workout}', [WorkoutSessionController::class, 'destroy'])->name('workouts.destroy');
    Route::post('/exercises/{exercise}/set', [WorkoutSessionController::class, 'addSet'])->name('workouts.addSet');
    Route::delete('/exercises/{exercise}', [WorkoutSessionController::class, 'deleteExercise'])->name('workouts.deleteExercise');
    Route::put('/sets/{set}', [WorkoutSessionController::class, 'updateSet'])->name('workouts.updateSet');
    Route::delete('/sets/{set}', [WorkoutSessionController::class, 'deleteSet'])->name('workouts.deleteSet');
});