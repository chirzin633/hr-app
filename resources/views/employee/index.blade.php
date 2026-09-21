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
                    <h3>Employees</h3>
                    <p class="text-subtitle text-muted">
                        Handle employee data or profile
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Employees
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Index
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <a href="{{ route('employee.create') }}" class="btn btn-primary mb-3 ms-auto">New Employee</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Fullname</th>
                                <th>Email</th>

                                <th>Department</th>
                                <th>Role</th>
                                <th>Status</th>

                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td>{{ $employee->fullname }}</td>
                                    <td>{{ $employee->email }}</td>

                                    <td>{{ $employee->department->name }}</td>
                                    <td>{{ $employee->role->title }}</td>
                                    <td>
                                        @if ($employee->status == 'active')
                                            <span class="text-success">Active</span>
                                        @elseif ($employee->status == 'suspended')
                                            <span class="text-warning">Supended</span>
                                        @else
                                            <span class="text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('employee.show', $employee->id) }}" class="badge bg-info">View</a>
                                        <a href="{{ route('employee.edit', $employee->id) }}"
                                            class="badge bg-warning">Edit</a>
                                        <form action="{{ route('employee.destroy', $employee->id) }}" class="d-inline"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge bg-danger">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
