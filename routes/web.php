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
    return redirect()->route('login');
});

// Dashboard
Route::group([], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Task
Route::group([], function () {
    Route::resource('task', TaskController::class);
    Route::patch('task/{task}/status', [TaskController::class, 'updateStatus'])->name('task.updateStatus');
});

// Employee
Route::group([], function () {
    Route::resource('employee', EmployeeController::class);
});

// Department
Route::group([], function () {
    Route::resource('department', DepartmentController::class);
});

// Role
Route::group([], function () {
    Route::resource('role', RoleController::class);
});

// Presence
Route::group([], function () {
    Route::resource('presence', PresenceController::class);
});

// Payroll
Route::group([], function () {
    Route::resource('payroll', PayrollController::class);
    Route::get('/payroll/{payroll}/print', [PayrollController::class, 'print'])->name('payroll.print');
});

// Leave Request
Route::group([], function () {
    Route::resource('leave-request', LeaveRequestController::class);
    Route::patch('/leave-request/{leave_request}/confirm', [LeaveRequestController::class, 'confirm'])->name('leave-request.confirm');
    Route::patch('/leave-request/{leave_request}/reject', [LeaveRequestController::class, 'reject'])->name('leave-request.reject');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
