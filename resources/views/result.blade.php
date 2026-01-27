<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Transkripsi</title>

    <!-- Font Awesome untuk ikon -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background: #f5f7fa;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0,0,0,.08);
        }

        h2 {
            margin-top: 0;
            margin-bottom: 15px;
            color: #333;
        }

        textarea {
            width: 100%;
            min-height: 320px;
            padding: 15px;
            font-size: 14px;
            line-height: 1.6;
            border-radius: 8px;
            border: 1px solid #ccc;
            resize: vertical;
        }

        .actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .btn {
            border: none;
            padding: 10px 16px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: .2s;
            text-decoration: none;
        }

        .btn-copy {
            background: #4f46e5;
            color: #fff;
        }

        .btn-copy:hover {
            background: #4338ca;
        }

        .btn-word {
            background: #185abd;
            color: #fff;
        }

        .btn-word:hover {
            background: #134a9c;
        }

        .btn-pdf {
            background: #c62828;
            color: #fff;
        }

        .btn-pdf:hover {
            background: #a91f1f;
        }

        .btn-back {
            margin-top: 25px;
            display: inline-block;
            color: #555;
            text-decoration: none;
        }

        .btn-back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Hasil Transkripsi Audio</h2>

    <!-- EDITABLE TEXT -->
    <textarea id="transcript">{{ $text }}</textarea>

    <div class="actions">
        <!-- SALIN -->
        <button onclick="copyText()" class="btn btn-copy">
            <i class="fa-solid fa-copy"></i> Salin Teks
        </button>

        <!-- WORD -->
        <form action="/export-word" method="POST">
            @csrf
            <input type="hidden" name="text" id="wordText">
            <button class="btn btn-word">
                <i class="fa-solid fa-file-word"></i> Word
            </button>
        </form>

        <!-- PDF -->
        <form action="/export-pdf" method="POST">
            @csrf
            <input type="hidden" name="text" id="pdfText">
            <button class="btn btn-pdf">
                <i class="fa-solid fa-file-pdf"></i> PDF
            </button>
        </form>
    </div>

    <a href="/" class="btn-back">⬅ Upload Lagi</a>
</div>

<script>
function copyText() {
    const textarea = document.getElementById("transcript");
    textarea.select();
    document.execCommand("copy");
    alert("Teks berhasil disalin");
}

// kirim teks TERKINI (yang sudah diedit) ke form
document.querySelectorAll("form").forEach(form => {
    form.addEventListener("submit", () => {
        document.getElementById("wordText")?.value =
        document.getElementById("pdfText")?.value =
            document.getElementById("transcript").value;
    });
});
</script>

</body>
</html>