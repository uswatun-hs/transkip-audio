@extends('layout.master')

@section('content')
    <div class="container-fluid py-4">

        <div class="card shadow-sm border-0">
            <div class="card-body">

                <h5 class="fw-bold mb-3">Edit Transkrip</h5>

                <form action="{{ route('history.update', $data->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <textarea name="result" class="form-control" rows="10">{{ $data->result }}</textarea>
                    </div>

                    <button class="btn btn-primary">
                        Update
                    </button>

                    <a href="{{ route('history.index') }}" class="btn btn-light">
                        Batal
                    </a>

                </form>

            </div>
        </div>

    </div>
@endsection
