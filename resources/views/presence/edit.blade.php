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
                                Edit
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('presence.update', $presence->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-2">
                            <label for="employee_id" class="form-label">Employee</label>
                            <select name="employee_id" id="employee_id"
                                class="form-control @error('employee_id') is-invalid @enderror">
                                <option value="" disabled>-- Choose Employee --</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}" @selected(old('employee_id', $presence->employee_id) == $employee->id)>
                                        {{ $employee->fullname }}</option>
                                @endforeach
                            </select>
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="date" class="form-label">Date</label>
                            <input type="date" value="{{ old('date', $presence->date) }}"
                                class="form-control date @error('date') is-invalid @enderror" name="date" required>
                            @error('date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="check_in" class="form-label">Check In</label>
                            <input type="time" class="form-control time @error('check_in') is-invalid @enderror"
                                name="check_in" value="{{ old('check_in', $presence->check_in) }}">
                            @error('check_in')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="check_out" class="form-label">Check Out</label>
                            <input type="time" class="form-control time @error('check_out') is-invalid @enderror"
                                name="check_out" value="{{ old('check_out', $presence->check_out) }}">
                            @error('check_out')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="" disabled>-- Choose Status --</option>
                                <option value="present" @selected(old('status', $presence->status) == 'present')>Present</option>
                                <option value="absent"@selected(old('status', $presence->status) == 'absenr')>Absent</option>
                                <option value="late" @selected(old('status', $presence->status) == 'late')>Late</option>
                                <option value="leave" @selected(old('status', $presence->status) == 'leave')>Leave</option>
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
