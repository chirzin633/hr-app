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
                        Handle leave request employee
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
                        <a href="{{ route('leave-request.create') }}" class="btn btn-primary mb-3 ms-auto">New Leave
                            Request</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($leave_requests as $leave_request)
                                <tr>
                                    <td>{{ $leave_request->employee->fullname }}</td>
                                    <td>{{ ucfirst($leave_request->leave_type) }}</td>
                                    <td>{{ $leave_request->start_date }}</td>
                                    <td>{{ $leave_request->end_date }}</td>
                                    <td>
                                        @switch($leave_request->status)
                                            @case('approved')
                                                <span class="text-success">Approved</span>
                                            @break

                                            @case('pending')
                                                <span class="text-warning">Pending</span>
                                            @break

                                            @case('rejected')
                                                <span class="text-danger">Reject</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>

                                        @if ($leave_request->status == 'pending')
                                            <form action="{{ route('leave-request.confirm', $leave_request->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="badge bg-success">Confirm</button>
                                            </form>

                                            <form action="{{ route('leave-request.reject', $leave_request->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="badge bg-secondary">Reject</button>
                                            </form>
                                        @elseif ($leave_request->status == 'rejected')
                                            <form action="{{ route('leave-request.confirm', $leave_request->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="badge bg-success">Confirm</button>
                                            </form>
                                        @else
                                            <form action="{{ route('leave-request.reject', $leave_request->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="badge bg-secondary">Reject</button>
                                            </form>
                                        @endif

                                        <a href="{{ route('leave-request.edit', $leave_request->id) }}"
                                            class="badge bg-warning">Edit</a>

                                        <form action="{{ route('leave-request.destroy', $leave_request->id) }}"
                                            method="POST" class="d-inline">
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
