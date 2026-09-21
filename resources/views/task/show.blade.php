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
                        <label for="" class="fw-bold">Title</label>
                        <p>{{ $task->employee->fullname }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Due Date</label>
                        <p>{{ \Carbon\Carbon::parse($task->due_date)->format('d F Y') }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Status</label>
                        <p>
                            @if ($task->status == 'pending')
                                <span class="text-danger">Pending</span>
                            @elseif ($task->status == 'in_progress')
                                <span class="text-warning">On Progress</span>
                            @elseif ($task->status == 'completed')
                                <span class="text-success">Done</span>
                            @endif
                        </p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Description</label>
                        <p>{{ $task->description }}</p>
                    </div>

                    <a href="{{ route('task.index') }}" class="btn btn-secondary">Back to list</a>

                </div>
            </div>
        </section>
    </div>
@endsection
