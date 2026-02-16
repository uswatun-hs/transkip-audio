@extends('layout.master')

@section('content')

    <div class="container py-5">

        <div class="row justify-content-center">
            <div class="col-lg-7">

                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-5">

                        <!-- HEADER -->
                        <div class="mb-4 text-center">
                            <h4 class="fw-bold mb-1">Edit User</h4>
                            <p class="text-muted small mb-0">
                                Update user information below
                            </p>
                        </div>

                        <!-- ERROR -->
                        @if ($errors->any())
                            <div class="alert alert-danger rounded-3 shadow-sm">
                                <ul class="mb-0 small">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- NAME -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                                    class="form-control form-control-lg rounded-3" required>
                            </div>

                            <!-- EMAIL -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                    class="form-control form-control-lg rounded-3" required>
                            </div>

                            <!-- PASSWORD -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">
                                    Password
                                    <small class="text-muted">(Leave blank if unchanged)</small>
                                </label>
                                <input type="password" name="password" class="form-control form-control-lg rounded-3">
                            </div>

                            <!-- ROLE -->
                            <div class="mb-5">
                                <label class="form-label fw-semibold">User Role</label>
                                <select name="role" class="form-select form-select-lg rounded-3">
                                    <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                                    <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                                    <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                </select>
                            </div>

                            <!-- BUTTON -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4 rounded-3">
                                    ← Back
                                </a>

                                <button type="submit" class="btn btn-primary px-4 rounded-3">
                                    Update User
                                </button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection
