<!DOCTYPE html>
<html>
<head>
    <title>Hasil Transkripsi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        textarea {
            width: 100%;
            height: 300px;
            padding: 10px;
        }
        .btn {
            display: inline-block;
            padding: 10px 15px;
            margin-top: 10px;
            text-decoration: none;
            border: 1px solid #333;
        }
    </style>
</head>
<body>

<h2>Hasil Transkripsi Audio</h2>

<textarea readonly>{{ $text }}</textarea>

<br>
<a href="/" class="btn">⬅ Upload Lagi</a>

</body>
</html>
