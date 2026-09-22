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
                    <h3>Department</h3>
                    <p class="text-subtitle text-muted">
                        Handle department
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Department
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
                        <a href="{{ route('department.create') }}" class="btn btn-primary mb-3 ms-auto">New Department</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <table class="table table-striped" id="table1">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($departments as $department)
                                <tr>
                                    <td>{{ $department->name }}</td>
                                    <td>
                                        {{ $department->description }}
                                    </td>
                                    <td>
                                        @switch($department->status)
                                            @case('inactive')
                                                <span class="text-danger">inactive</span>
                                            @break

                                            @case('active')
                                                <span class="text-success">Active</span>
                                            @break
                                        @endswitch
                                    </td>
                                    <td>
                                        <a href="{{ route('department.show', $department->id) }}"
                                            class="badge bg-info">View</a>
                                        <a href="{{ route('department.edit', $department->id) }}"
                                            class="badge bg-warning">Edit</a>
                                        <form action="{{ route('department.destroy', $department->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="badge bg-danger">Delete</button>
                                        </form>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
