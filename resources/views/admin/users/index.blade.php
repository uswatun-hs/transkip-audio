<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    .custom-table thead {
    background-color: #f8f9fa;
    font-weight: 600;
}

.custom-table tbody tr {
    transition: all 0.2s ease;
}

.custom-table tbody tr:hover {
    background-color: #f1f3f7;
}

.avatar-circle {
    width: 45px;
    height: 45px;
    border-radius: 50%;
    background: linear-gradient(135deg, #5e72e4, #825ee4);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
}

</style>
<body>

    <div class="card-body">

        <div class="card border-0 shadow rounded-4">
    <div class="card-body p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="fw-bold mb-1">User Management</h4>
                <p class="text-muted small mb-0">Manage all registered users</p>
            </div>
            <a href="#" class="btn btn-primary rounded-3 px-3">
                <i class="ti ti-plus me-1"></i> Add User
            </a>
        </div>

        <div class="table-responsive">
            <table id="userTable" class="table table-hover align-middle custom-table">

            {{-- <table id="userTable" class="table align-middle custom-table"> --}}
                <thead>
                    <tr>
                        <th>#</th>
                        <th>User</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th class="text-end">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $key => $user)
                    <tr>
                        <td>{{ $key + 1 }}</td>

                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">
                                    {{ strtoupper(substr($user->name,0,1)) }}
                                </div>
                                <div>
                                    <h6 class="mb-0 fw-semibold">{{ $user->name }}</h6>
                                    <small class="text-muted">{{ $user->email }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            @if($user->role == 'admin')
                                <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                    Admin
                                </span>
                            @elseif($user->role == 'staff')
                                <span class="badge bg-info-subtle text-info px-3 py-2 rounded-pill">
                                    Staff
                                </span>
                            @else
                                <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                    User
                                </span>
                            @endif
                        </td>

                        <td>
                            @if($user->email_verified_at)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>

                        <td>
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                        <td class="text-end">
                            <button class="btn btn-sm btn-light-primary rounded-3">
                                <i class="ti ti-edit"></i>
                            </button>
                            <button class="btn btn-sm btn-light-danger rounded-3">
                                <i class="ti ti-trash"></i>
                            </button>
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
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#userTable').DataTable();
});
</script>

</body>
</html>
