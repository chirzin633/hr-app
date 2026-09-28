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

    // Task: baca untuk semua, tulis hanya manage; update status butuh task.edit
    Route::patch('task/{task}/status', [TaskController::class, 'updateStatus'])
        ->name('task.updateStatus')
        ->middleware('permission:task.edit');

    Route::resource('task', TaskController::class)
        ->only(['index', 'show'])
        ->middleware('permission:task.view');

    Route::resource('task', TaskController::class)
        ->except(['index', 'show'])
        ->middleware('permission:task.manage');

    // Employee: baca untuk role view, tulis hanya manage (anti self-promote)
    Route::resource('employee', EmployeeController::class)
        ->only(['index', 'show'])
        ->middleware('permission:employee.view');

    Route::resource('employee', EmployeeController::class)
        ->except(['index', 'show'])
        ->middleware('permission:employee.manage');

    // Department
    Route::resource('department', DepartmentController::class)
        ->only(['index', 'show'])
        ->middleware('permission:department.view');

    Route::resource('department', DepartmentController::class)
        ->except(['index', 'show'])
        ->middleware('permission:department.manage');

    // Role / Job Role
    Route::resource('role', RoleController::class)
        ->only(['index', 'show'])
        ->middleware('permission:job_role.view');

    Route::resource('role', RoleController::class)
        ->except(['index', 'show'])
        ->middleware('permission:job_role.manage');

    // Presence: lihat + catat sendiri untuk semua, kelola hanya manage
    Route::resource('presence', PresenceController::class)
        ->only(['index', 'show', 'create', 'store'])
        ->middleware('permission:presence.view');

    Route::resource('presence', PresenceController::class)
        ->except(['index', 'show', 'create', 'store'])
        ->middleware('permission:presence.manage');

    // Payroll
    Route::middleware('permission:payroll.view')->group(function () {
        Route::get('/payroll/{payroll}/print', [PayrollController::class, 'print'])->name('payroll.print');
        Route::resource('payroll', PayrollController::class);
    });

    // Leave Request: baca + ajukan untuk semua, approve hanya yang berhak.
    // edit/update/destroy diizinkan untuk pemilik record (dicek di controller)
    // atau pemegang leave_request.approve.
    Route::middleware('permission:leave_request.approve')->group(function () {
        Route::patch('/leave-request/{leave_request}/confirm', [LeaveRequestController::class, 'confirm'])->name('leave-request.confirm');
        Route::patch('/leave-request/{leave_request}/reject', [LeaveRequestController::class, 'reject'])->name('leave-request.reject');
    });

    Route::resource('leave-request', LeaveRequestController::class)
        ->middleware('permission:leave_request.view');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
