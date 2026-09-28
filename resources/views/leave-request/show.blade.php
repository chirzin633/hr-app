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
                    <p class="text-subtitle text-muted">Leave request detail</p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/dashboard">Dashboard</a></li>
                            <li class="breadcrumb-item" aria-current="page">Leave Request</li>
                            <li class="breadcrumb-item active" aria-current="page">Detail</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="fw-bold">Employee</label>
                        <p>{{ $leave_request->employee->fullname ?? '-' }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Leave Type</label>
                        <p>{{ $leave_request->leave_type }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Start Date</label>
                        <p>{{ \Carbon\Carbon::parse($leave_request->start_date)->format('d F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">End Date</label>
                        <p>{{ \Carbon\Carbon::parse($leave_request->end_date)->format('d F Y') }}</p>
                    </div>
                    <div class="mb-3">
                        <label class="fw-bold">Status</label>
                        <p>{{ ucfirst($leave_request->status) }}</p>
                    </div>
                    <a href="{{ route('leave-request.index') }}" class="btn btn-secondary">Back to list</a>
                </div>
            </div>
        </section>
    </div>
@endsection
