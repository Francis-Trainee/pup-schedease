<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Student\DashboardController as StudentDashboardController;

Route::get('/', function () {
    return view('landingpage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ================= ADMIN ROUTES =================
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/facultymanagement', [AdminDashboardController::class, 'faculty_management'])->name('faculty_management');
        Route::get('/subjectmanagement', [AdminDashboardController::class, 'subject_management'])->name('subject_management');
        Route::get('/roommanagement', [AdminDashboardController::class, 'room_management'])->name('room_management');
        Route::get('/sectionmanagement', [AdminDashboardController::class, 'section_management'])->name('section_management');

        // Creating Schedule Management Route
        Route::get('/schedulemanagement', [AdminDashboardController::class, 'schedule_management'])->name('schedule_management');
        
        Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
        Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');

        Route::get('/reports', [AdminDashboardController::class, 'reports'])->name('reports');
    });

// ================= STUDENT ROUTES =================
Route::middleware(['auth', 'role:student'])
    ->prefix('student')
    ->name('student.')
    ->group(function () {
        Route::get('/dashboard', [StudentDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/class_schedule', [StudentDashboardController::class, 'class_schedule'])->name('class_schedule');
        Route::get('/laboratory', [StudentDashboardController::class, 'laboratory'])->name('laboratory');
    });

require __DIR__ . '/auth.php';
