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
                    <h3>Employee</h3>
                    <p class="text-subtitle text-muted">
                        Handle employee data
                    </p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/dashboard">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item" aria-current="page">
                                Employee
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">
                                New
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('employee.store') }}" method="POST">
                        @csrf

                        <div class="mb-2">
                            <label for="fullname" class="form-label">Fullname</label>
                            <input type="text" class="form-control @error('fullname') is-invalid @enderror"
                                name="fullname" value="{{ old('fullname') }}">
                            @error('fullname')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="phone_number" class="form-label">Phone
                                Number</label>
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                name="phone_number" value="{{ old('phone_number') }}">
                            @error('phone_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" name="address" id="address" cols="30"
                                rows="10">{{ old('address') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="birth_date" class="form-label">Birth Date</label>
                            <input type="date" value="{{ old('birth_date') }}"
                                class="form-control datetime @error('birth_date') is-invalid @enderror" name="birth_date">
                            @error('birth_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="hire_date" class="form-label">Hire Date</label>
                            <input type="date" value="{{ old('hire_date') }}"
                                class="form-control datetime @error('hire_date') is-invalid @enderror" name="hire_date">
                            @error('hire_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="department_id" class="form-label">Department</label>
                            <select name="department_id" id="department_id"
                                class="form-control @error('department_id') is-invalid @enderror">
                                <option value="" disabled selected>-- Choose Department --</option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="role_id" class="form-label">Role</label>
                            <select name="role_id" id="role_id"
                                class="form-control @error('role_id') is-invalid @enderror">
                                <option value="" disabled selected>-- Choose Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->title }}</option>
                                @endforeach
                            </select>
                            @error('role_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status"
                                class="form-control @error('status') is-invalid @enderror">
                                <option value="" disabled selected>-- Choose Status --</option>
                                <option value="active">Active</option>
                                <option value="suspended">Suspended</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-2">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" class="form-control @error('salary') is-invalid @enderror"
                                name="salary" value="{{ old('salary') }}">
                            @error('salary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create Employee</button>
                        <a href="{{ route('employee.index') }}" class="btn btn-secondary">Back To List</a>
                    </form>

                </div>
            </div>
        </section>
    </div>
@endsection
