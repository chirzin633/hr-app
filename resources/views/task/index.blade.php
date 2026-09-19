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
                    <h3>Tasks</h3>
                    <p class="text-subtitle text-muted">
                        Handle employee task
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
                        <a href="{{ route('task.create') }}" class="btn btn-primary mb-3 ms-auto">New Task</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Assigned To</th>
                                <th>Due Date</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $task->title }}</td>
                                    <td>
                                        {{ $task->employee->fullname }}
                                    </td>
                                    <td>{{ $task->due_date }}</td>
                                    <td>
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
                                    <td>
                                        <a href="#" class="badge bg-info">View</a>
                                        <a href="#" class="badge bg-light">Edit</a>
                                        <a href="#" class="badge bg-danger">Delete</a>

                                        @switch($task->status)
                                            @case('pending')
                                                <a href="#" class="badge bg-success">Done</a>
                                            @break

                                            @case('in_progress')
                                                <a href="#" class="badge bg-success">Mark Completed</a>
                                            @break

                                            @case('completed')
                                                <a href="#" class="badge bg-warning">Reopen</a>
                                            @break
                                        @endswitch
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
