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
                        <a href="{{ route('payroll.create') }}" class="btn btn-primary mb-3 ms-auto">New Payroll</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Salary</th>
                                <th>Bonuses</th>
                                <th>Deduction</th>
                                <th>Net Salary</th>
                                <th>Pay Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($payrolls as $payroll)
                                <tr>
                                    <td>{{ $payroll->employee->fullname }}</td>
                                    <td>Rp {{ number_format($payroll->salary, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($payroll->bonuses, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($payroll->deductions, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($payroll->net_salary, 0, ',', '.') }}</td>
                                    <td>{{ $payroll->pay_date }}</td>
                                    <td>
                                        <a href="{{ route('payroll.show', $payroll->id) }}" class="badge bg-info">Salary
                                            Slip</a>
                                        <a href="{{ route('payroll.edit', $payroll->id) }}"
                                            class="badge bg-warning">Edit</a>
                                        <form action="{{ route('payroll.destroy', $payroll->id) }}" method="POST"
                                            class="d-inline">
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
