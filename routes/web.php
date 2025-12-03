<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ReminderController;

// Halaman Depan (Accessible by everyone including guests)
Route::get('/', function () {
    return view('welcome');
})->name('home');

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
});