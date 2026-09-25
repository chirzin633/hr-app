@extends('layouts.dashboard')

@section('content')
    <header class="mb-3">
        <a href="#" class="d-block burger-btn d-xl-none">
            <i class="bi bi-justify fs-3"></i>
        </a>
    </header>

    <div class="page-heading">
        <h3>Dashboard</h3>
    </div>

    <div class="page-content">
        <div class="row">
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 py-4-5 card-body">
                        <div class="row">
                            <div class="d-flex justify-content-start col-md-4 col-lg-12 col-xl-12 col-xxl-5">
                                <div class="mb-2 stats-icon purple">
                                    <i class="iconly-boldWork"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="font-semibold text-muted">Department</h6>
                                <h6 class="mb-0 font-extrabold">{{ $department }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 py-4-5 card-body">
                        <div class="row">
                            <div class="d-flex justify-content-start col-md-4 col-lg-12 col-xl-12 col-xxl-5">
                                <div class="mb-2 stats-icon blue">
                                    <i class="iconly-boldProfile"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="font-semibold text-muted">Employees</h6>
                                <h6 class="mb-0 font-extrabold">{{ $employee }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 py-4-5 card-body">
                        <div class="row">
                            <div class="d-flex justify-content-start col-md-4 col-lg-12 col-xl-12 col-xxl-5">
                                <div class="mb-2 stats-icon green">
                                    <i class="iconly-boldCalendar"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="font-semibold text-muted">Presence</h6>
                                <h6 class="mb-0 font-extrabold">{{ $presence }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-lg-3 col-md-6">
                <div class="card">
                    <div class="px-4 py-4-5 card-body">
                        <div class="row">
                            <div class="d-flex justify-content-start col-md-4 col-lg-12 col-xl-12 col-xxl-5">
                                <div class="mb-2 stats-icon red">
                                    <i class="iconly-boldWallet"></i>
                                </div>
                            </div>
                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                <h6 class="font-semibold text-muted">Payroll</h6>
                                <h6 class="mb-0 font-extrabold">{{ $payroll }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Latest Presence</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="presenceBarChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 ">
                <div class="card">
                    <div class="card-header">
                        <h4>Latest Task</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-lg">
                                <thead>
                                    <tr>
                                        <th>Employee</th>
                                        <th>Detail</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tasks as $task)
                                        <tr>
                                            <td class="col-auto">
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar avatar-md">
                                                        <img
                                                            src="https://ui-avatars.com/api/?name={{ $task->employee->fullname }}&background=random">
                                                    </div>
                                                    <p class="ms-3 mb-0 font-bold">{{ $task->employee->fullname }}</p>
                                                </div>
                                            </td>
                                            <td class="col-auto">
                                                <p class="mb-0">{{ $task->title }}</p>
                                            </td>
                                            <td class="col-auto">
                                                @switch($task->status)
                                                    @case('pending')
                                                        <span class="text-danger">Pending</span>
                                                    @break

                                                    @case('in_progress')
                                                        <span class="text-warning">In Progress</span>
                                                    @break

                                                    @case('completed')
                                                        <span class="text-success">Done</span>
                                                    @break
                                                @endswitch
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        const presenceChartEl = document.getElementById('presenceBarChart');
        if (presenceChartEl) {
            new Chart(presenceChartEl, {
                type: 'bar',
                data: {
                    labels: @json($presenceChart['labels']),
                    datasets: @json($presenceChart['datasets'])
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    },
                    scales: {
                        x: {
                            stacked: true,
                            grid: {
                                display: false
                            }
                        },
                        y: {
                            stacked: true,
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });
        }
    </script>
@endpush
