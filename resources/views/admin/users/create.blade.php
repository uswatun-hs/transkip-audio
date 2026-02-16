@extends('layout.master')

@section('content')

<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="card border-0 shadow rounded-4">
                <div class="card-body p-5">

                    <!-- Header -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-inline-flex align-items-center justify-content-center" style="width:70px;height:70px;">
                                <i class="ti ti-user-plus fs-3"></i>
                            </div>
                        </div>
                        <h4 class="fw-bold">Add New User</h4>
                        <p class="text-muted small mb-0">Create a new account for system access</p>
                    </div>

                    <!-- Error Alert -->
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Form -->
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name"
                                class="form-control rounded-3"
                                value="{{ old('name') }}"
                                placeholder="Enter full name">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email"
                                class="form-control rounded-3"
                                value="{{ old('email') }}"
                                placeholder="example@email.com">
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Password</label>
                            <input type="password" name="password"
                                class="form-control rounded-3"
                                placeholder="Minimum 6 characters">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Role</label>
                            <select name="role" class="form-select rounded-3">
                                <option value="user">User</option>
                                <option value="staff">Staff</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.users.index') }}"
                                class="btn btn-light rounded-3 px-4">
                                Cancel
                            </a>

                            <button type="submit"
                            <a href="{{ route('admin.users.store') }}"
                                class="btn btn-primary rounded-3 px-4">
                                Save User
                                </a>
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>

@endsection
