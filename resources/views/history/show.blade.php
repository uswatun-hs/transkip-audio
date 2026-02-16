@extends('layout.master')

@section('content')
<div class="container-fluid py-4">

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <h5 class="fw-bold mb-3">{{ $data->file_name }}</h5>

            <p class="text-muted">
                Oleh: {{ $data->user->name }} ({{ $data->user->role }})
            </p>

            <hr>

            <div style="white-space: pre-line">
                {{ $data->result }}
            </div>

            <a href="{{ route('history.index') }}" class="btn btn-light mt-3">
                Kembali
            </a>

        </div>
    </div>

</div>
@endsection
