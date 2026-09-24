@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="burger-btn d-block d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Leave Request</h3>
                    <p class="text-subtitle text-muted">
                        Handle employee leave request
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Leave Request
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                New
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('leave-request.store') }}" method="POST">
                        @csrf

                        <div class="mb-2">
                            <label for="employee_id" class="form-label">Employee</label>
                            <select name="employee_id" id="employee_id"
                                class="form-control @error('employee_id') is-invalid @enderror">
                                <option value="" disabled selected>-- Choose Employee --</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->fullname }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="leave_type" class="form-label">Leave Type</label>
                            <select name="leave_type" id="leave_type"
                                class="form-control @error('leave_type') is-invalid @enderror">
                                <option value="" disabled selected>-- Choose Leave Type --</option>
                                <option value="annual">Annual</option>
                                <option value="unpaid">Unpaid</option>
                                <option value="sick">Sick</option>
                                <option value="maternity">Maternity</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="start_date" class="form-label">Start Date</label>
                            <input type="date" value="{{ old('start_date') }}"
                                class="form-control date @error('start_date') is-invalid @enderror" name="start_date"
                                id="start_date">
                            @error('start_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="end_date" class="form-label">End Date</label>
                            <input type="date" value="{{ old('end_date') }}"
                                class="form-control date @error('end_date') is-invalid @enderror" name="end_date"
                                id="end_date">
                            @error('end_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Employee</button>
                        <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back To List</a>
                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
