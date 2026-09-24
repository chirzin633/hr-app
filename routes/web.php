<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LeaveRequestController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\PresenceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {

    // 🔹 Group untuk Super Admin, HR Officer, Supervisor
    Route::middleware(['role:Super Admin, HR Officer, Supervisor'])->group(function () {
        Route::resource('employee', EmployeeController::class);
        Route::resource('department', DepartmentController::class);
        Route::resource('role', RoleController::class);
    });

    // 🔹 Group untuk Super Admin, HR Officer, Supervisor, Manager, Staff
    Route::middleware(['role:Super Admin, HR Officer, Supervisor, Manager, Staff'])->group(function () {
        Route::resource('presence', PresenceController::class);
        Route::resource('leave-request', LeaveRequestController::class);
        Route::resource('task', TaskController::class);
    });

    // 🔹 Group untuk Super Admin, HR Officer
    Route::middleware(['role:Super Admin, HR Officer'])->group(function () {
        Route::resource('payroll', PayrollController::class);
        Route::get('/payroll/{payroll}/print', [PayrollController::class, 'print'])->name('payroll.print');
    });

    // 🔹 Route khusus leave-request confirm/reject
    Route::middleware(['role:Super Admin, HR Officer, Supervisor, Manager'])->group(function () {
        Route::patch('/leave-request/{leave_request}/confirm', [LeaveRequestController::class, 'confirm'])
            ->name('leave-request.confirm');
        Route::patch('/leave-request/{leave_request}/reject', [LeaveRequestController::class, 'reject'])
            ->name('leave-request.reject');
    });

    // 🔹 Dashboard - terbuka untuk semua user login (Opsi A).
    // Cek role tetap berlaku di route resource di bawah, bukan di sini,
    // agar user tanpa employee (mis. baru register) tidak 403 saat login.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 🔹 Task update status
    Route::middleware(['role:Super Admin, HR Officer, Supervisor, Manager'])->group(function () {
        Route::patch('task/{task}/status', [TaskController::class, 'updateStatus'])->name('task.updateStatus');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
