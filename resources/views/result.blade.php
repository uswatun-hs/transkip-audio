@extends('layout.master')

@section('content')
    <style>
        .transcript-card {
            border-radius: 18px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
            border: none;
            height: calc(100vh - 150px);
            display: flex;
            flex-direction: column;
        }

        .transcript-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            padding: 25px;
        }

        .transcript-textarea {
            flex: 1;
            resize: none;
            border-radius: 12px;
            padding: 15px;
            font-size: 14px;
            line-height: 1.6;
            border: 1px solid #e5e7eb;
        }

        .action-buttons {
            margin-top: 15px;
            display: flex;
            gap: 10px;
        }
    </style>

    <div class="container py-4">

        <div class="card transcript-card">

            <div class="card-body transcript-body">

                <h5 class="mb-3">Hasil Transkripsi</h5>

                <textarea id="transcript" class="form-control transcript-textarea">{{ $text }}</textarea>

                <div class="action-buttons">

                    <button onclick="copyText()" class="btn btn-primary">
                        <i class="fa fa-copy me-1"></i> Salin
                    </button>

                    <form action="/export-word" method="POST">
                        @csrf
                        <input type="hidden" name="text" id="wordText">
                        <button class="btn btn-success">
                            <i class="fa-solid fa-file-word me-1"></i> Word
                        </button>
                    </form>

                    <form action="/export-pdf" method="POST">
                        @csrf
                        <input type="hidden" name="text" id="pdfText">
                        <button class="btn btn-danger">
                            <i class="fa-solid fa-file-pdf me-1"></i> PDF
                        </button>
                    </form>

                </div>

            </div>

        </div>

    </div>

    <script>
        function copyText() {
            const textarea = document.getElementById("transcript");
            textarea.select();
            document.execCommand("copy");
            alert("Teks berhasil disalin");
        }

        document.querySelectorAll("form").forEach(form => {
            form.addEventListener("submit", () => {
                document.getElementById("wordText")?.value =
                    document.getElementById("pdfText")?.value =
                    document.getElementById("transcript").value;
            });
        });
    </script>
@endsection
