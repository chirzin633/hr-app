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
                    <h3>Payroll</h3>
                    <p class="text-subtitle text-muted">
                        Handle payroll employee
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Payroll
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="employee_id" class="fw-bolder">Employee</label>
                                <p>{{ $payroll->employee->fullname }}</p>
                            </div>

                            <div class="mb-2">
                                <label for="salary" class="fw-bolder">Salary</label>
                                <p>Rp {{ number_format($payroll->salary, 0, ',', '.') }}</p>
                            </div>

                            <div class="mb-2">
                                <label for="bonuses" class="fw-bolder">Bonus</label>
                                <p>Rp {{ number_format($payroll->bonuses, 0, ',', '.') }}</p>
                            </div>

                            <div class="mb-2">
                                <label for="deductions" class="fw-bolder">Deduction</label>
                                <p>Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-2">
                                <label for="net_salary" class="fw-bolder">Net Salary</label>
                                <p>Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</p>
                            </div>

                            <div class="mb-2">
                                <label for="pay_date" class="fw-bolder">Pay Date</label>
                                <p>{{ \Carbon\Carbon::parse($payroll->pay_date)->format('d F Y') }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('payroll.print', $payroll->id) }}" target="_blank" class="btn btn-primary">
                        <i class="bi bi-printer-fill me-1"></i>Print
                    </a>
                    <a href="{{ route('payroll.index') }}" class="btn btn-secondary">Back To List</a>
                </div>
            </div>
        </section>
    </div>
@endsection
