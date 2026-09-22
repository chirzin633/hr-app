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
                    <h3>Employee</h3>
                    <p class="text-subtitle text-muted">
                        Handle employee
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Tasks
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Detail
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="fw-bold">Fullname</label>
                        <p>{{ $employee->fullname }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Email</label>
                        <p>{{ $employee->email }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Phone Number</label>
                        <p>{{ $employee->phone_number }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Address</label>
                        <p>{{ $employee->address }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Birth Date</label>
                        <p>{{ \Carbon\Carbon::parse($employee->birth_date)->format('d F Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Hire Date</label>
                        <p>{{ \Carbon\Carbon::parse($employee->hire_date)->format('d F Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Department</label>
                        <p>{{ $employee->department->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Role</label>
                        <p>{{ $employee->role->title }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Status</label>
                        <p>
                            @if ($employee->status == 'inactive')
                                <span class="text-danger">Inactive</span>
                            @elseif ($employee->status == 'suspended')
                                <span class="text-warning">Suspended</span>
                            @elseif ($employee->status == 'active')
                                <span class="text-success">Active</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Salary</label>
                        <p>Rp {{ number_format($employee->salary, 0, ',', '.') }}</p>
                    </div>

                    <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back to list</a>

                </div>
            </div>
        </section>
    </div>
@endsection
