@extends('layout.master')

@section('content')

<div class="pc-container">
    <div class="pc-content">
        <div class="row justify-content-center">
            <div class="col-md-5">

                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-body p-4">

                        <h4 class="mb-4 fw-bold text-center">
                            Upload Audio / Video
                        </h4>

                        <form action="{{ route('upload.process') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3 text-center">

                                <label for="file" class="border border-2 border-primary rounded-4 p-4 w-100 cursor-pointer"
                                    style="border-style:dashed;">

                                    <i class="ti ti-cloud-upload fs-1 text-primary"></i>
                                    <p class="mt-2 mb-0 text-muted">
                                        Klik untuk memilih file audio / video
                                    </p>
                                </label>

                                <input id="file" type="file" name="audio"
                                    class="form-control d-none"
                                    accept="audio/*,video/*" required>

                            </div>

                            <div class="alert alert-light text-center" id="file-name">
                                Belum ada file dipilih
                            </div>

                            <button type="submit"
                                class="btn btn-primary w-100 rounded-pill">
                                Transkripsi
                            </button>

                            @if (session('error'))
                                <div class="alert alert-danger mt-3 text-center">
                                    {{ session('error') }}
                                </div>
                            @endif

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
<script>
    const fileInput = document.getElementById('file');
    const fileName = document.getElementById('file-name');

    fileInput.addEventListener('change', function () {
        if (this.files.length > 0) {
            fileName.textContent = this.files[0].name;
        }
    });
</script>
@endsection
