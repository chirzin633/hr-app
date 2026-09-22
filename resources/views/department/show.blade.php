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
                        <label for="" class="fw-bold">Name</label>
                        <p>{{ $department->name }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Description</label>
                        <p>{{ $department->description }}</p>
                    </div>

                    <div class="mb-3">
                        <label for="" class="fw-bold">Status</label>
                        <p>
                            @if ($department->status == 'inactive')
                                <span class="text-danger">Inactive</span>
                            @elseif ($department->status == 'active')
                                <span class="text-success">Active</span>
                            @endif
                        </p>
                    </div>

                    <a href="{{ route('department.index') }}" class="btn btn-secondary">Back to list</a>

                </div>
            </div>
        </section>
    </div>
@endsection
