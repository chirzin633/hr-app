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
                    <h3>Presence</h3>
                    <p class="text-subtitle text-muted">
                        Handle presence employee
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Presence
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

                    <form action="{{ route('presence.store') }}" method="POST">
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
                            <label for="date" class="form-label">Date</label>
                            <input type="date" value="{{ old('date') }}"
                                class="form-control date @error('date') is-invalid @enderror" name="date" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="check_in" class="form-label">Check In</label>
                            <input type="time" class="form-control time @error('check_in') is-invalid @enderror"
                                name="check_in" value="{{ old('check_in') }}">
                            @error('check_in')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="check_out" class="form-label">Check Out</label>
                            <input type="time" class="form-control time @error('check_out') is-invalid @enderror"
                                name="check_out" value="{{ old('check_out') }}">
                            @error('check_out')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="" disabled selected>-- Choose Status --</option>
                                <option value="present">Present</option>
                                <option value="absent">Absent</option>
                                <option value="sick">Sick</option>
                                <option value="leave">Leave</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('presence.index') }}" class="btn btn-secondary">Back To List</a>
                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
