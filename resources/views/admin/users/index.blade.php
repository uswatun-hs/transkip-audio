@extends('layout.master')
@section('content')
    <div class="container-fluid py-4">

        <div class="card border-0 shadow-lg rounded-4">
            <div class="card-body p-4">

                <!-- HEADER -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h4 class="fw-bold mb-1">User Management</h4>
                        <small class="text-muted">Manage all registered users</small>
                    </div>

                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="fa fa-plus me-2"></i> Add User
                    </a>
                </div>

                <!-- ALERT -->
                @if (session('success'))
                    <div class="alert alert-success border-0 shadow-sm rounded-3">
                        <i class="fa fa-check-circle me-2"></i>
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger border-0 shadow-sm rounded-3">
                        <i class="fa fa-times-circle me-2"></i>
                        {{ session('error') }}
                    </div>
                @endif

                <!-- TABLE -->
                <div class="table-responsive">
                    <table class="table table-hover align-middle">

                        <thead class="bg-light">
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $key => $user)
                                <tr>

                                    <td>{{ $key + 1 }}</td>

                                    <td>
                                        <div class="fw-semibold">
                                            {{ $user->name }}
                                        </div>
                                    </td>

                                    <td>
                                        <small class="text-muted">
                                            {{ $user->email }}
                                        </small>
                                    </td>

                                    <td>
                                        @if ($user->role == 'admin')
                                            <span class="badge bg-danger rounded-pill px-3">
                                                Admin
                                            </span>
                                        @elseif($user->role == 'staff')
                                            <span class="badge bg-info rounded-pill px-3">
                                                Staff
                                            </span>
                                        @else
                                            <span class="badge bg-success rounded-pill px-3">
                                                User
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($user->email_verified_at)
                                            <span class="badge bg-success-subtle text-success rounded-pill px-3">
                                                Active
                                            </span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning rounded-pill px-3">
                                                Pending
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $user->created_at->format('d M Y') }}
                                    </td>

                                    <td class="text-center">
                                        @if (auth()->user()->role == 'admin')
                                            <a href="{{ route('admin.users.edit', $user->id) }}"
                                                class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                                <i class="fa fa-edit me-1"></i>
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-sm btn-outline-danger rounded-pill px-3">
                                                    <i class="fa fa-trash me-1"></i>
                                                    Delete
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted small">View Only</span>
                                        @endif

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
@endsection
