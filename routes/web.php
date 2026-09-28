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

Route::get('/', fn() => redirect()->route('login'));

Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard')
        ->middleware('permission:dashboard.view');

    // Task
    Route::patch('task/{task}/status', [TaskController::class, 'updateStatus'])
        ->name('task.updateStatus')
        ->middleware('permission:task.edit');

    Route::resource('task', TaskController::class)
        ->middleware('permission:task.view');

    // Employee
    Route::resource('employee', EmployeeController::class)
        ->middleware('permission:employee.view');

    // Department
    Route::resource('department', DepartmentController::class)
        ->middleware('permission:department.view');

    // Role / Job Role
    Route::resource('role', RoleController::class)
        ->middleware('permission:job_role.view');

    // Presence
    Route::resource('presence', PresenceController::class)
        ->middleware('permission:presence.view');

    // Payroll
    Route::middleware('permission:payroll.view')->group(function () {
        Route::get('/payroll/{payroll}/print', [PayrollController::class, 'print'])->name('payroll.print');
        Route::resource('payroll', PayrollController::class);
    });

    // Leave Request
    Route::middleware('permission:leave_request.view')->group(function () {
        Route::patch('/leave-request/{leave_request}/confirm', [LeaveRequestController::class, 'confirm'])->name('leave-request.confirm');
        Route::patch('/leave-request/{leave_request}/reject', [LeaveRequestController::class, 'reject'])->name('leave-request.reject');
        Route::resource('leave-request', LeaveRequestController::class);
    });

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
