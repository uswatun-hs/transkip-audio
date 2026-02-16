@extends('layout.master')

@section('content')
    <style>
        .history-wrapper {
            max-width: 950px;
            margin: auto;
        }

        .history-card {
            border-radius: 14px;
            transition: 0.2s ease-in-out;
        }

        .history-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .history-title {
            font-weight: 600;
            font-size: 15px;
        }

        .history-text {
            font-size: 14px;
            color: #6c757d;
            line-height: 1.6;
        }

        .history-date {
            font-size: 12px;
            color: #999;
        }

        .action-group .btn {
            border-radius: 8px;
            padding: 5px 10px;
            font-size: 13px;
        }

        .filter-select {
            min-width: 180px;
            border-radius: 8px;
        }

        .dropdown-menu {
            z-index: 9999 !important;
        }
    </style>

    <div class="container-fluid py-4">
        <div class="history-wrapper">

            <!-- HEADER + FILTER -->
            <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">

                <h5 class="fw-bold m-0">📄 History Transkrip</h5>

                @if (auth()->user()->role == 'admin')
                    <form method="GET" action="{{ route('history.index') }}">
                        <select name="role" class="form-select filter-select" onchange="this.form.submit()">
                            <option value="">Semua Role</option>
                            <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>
                            <option value="staff" {{ request('role') == 'staff' ? 'selected' : '' }}>
                                Staff
                            </option>
                            <option value="user" {{ request('role') == 'user' ? 'selected' : '' }}>
                                User
                            </option>
                        </select>
                    </form>
                @endif

            </div>

            <!-- LIST HISTORY -->
            @forelse($transcripts as $item)
                <div class="card history-card mb-3 border-0 shadow-sm">
                    <div class="card-body d-flex justify-content-between align-items-start">

                        <!-- LEFT CONTENT -->
                        <div style="max-width: 75%;">
                            <div class="history-title">
                                {{ $item->file_name ?? 'Tanpa Nama File' }}
                            </div>

                            <div class="history-text mt-2">
                                {{ \Illuminate\Support\Str::limit($item->result, 120) }}
                            </div>

                            <div class="history-date mt-2">
                                {{ $item->created_at->format('d M Y • H:i') }}
                                • Oleh:
                                <strong>{{ $item->user->name ?? '-' }}</strong>
                                ({{ $item->user->role ?? '-' }})
                            </div>
                        </div>

                        <!-- RIGHT ACTION (ADMIN ONLY) -->
                        @if (auth()->user()->role == 'admin')
                            <div class="action-group text-end">

                                <a href="{{ route('history.show', $item->id) }}"
                                    class="btn btn-sm btn-outline-primary mb-1">
                                    <i class="fa fa-eye"></i>
                                </a>

                                <a href="{{ route('history.edit', $item->id) }}"
                                    class="btn btn-sm btn-outline-warning mb-1">
                                    <i class="fa fa-edit"></i>
                                </a>

                                <form action="{{ route('history.destroy', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin hapus history ini?')" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>

                            </div>
                        @endif

                    </div>
                </div>
            @empty
                <div class="alert alert-info text-center">
                    Belum ada history transkrip.
                </div>
            @endforelse

            <!-- PAGINATION -->
            <div class="mt-4">
                {{ $transcripts->links() }}
            </div>

        </div>
    </div>
@endsection
