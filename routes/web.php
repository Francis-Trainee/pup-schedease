<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

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
        Route::get('/schedulemanagement', [AdminDashboardController::class, 'schedule_management'])->name('schedule_management');
        Route::get('/reports', [AdminDashboardController::class, 'reports'])->name('reports');
    });

require __DIR__ . '/auth.php';
