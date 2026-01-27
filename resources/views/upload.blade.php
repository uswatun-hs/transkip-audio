<!DOCTYPE html>
<html>
<head>
    <title>Upload Audio / Video</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        .box {
            max-width: 500px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
        }
        input, button {
            width: 100%;
            margin-top: 10px;
            padding: 10px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Upload Audio / Video</h2>

    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif

    <form action="/transcribe" method="POST" enctype="multipart/form-data">
    @csrf

        <input type="file" name="audio" required>

        <button type="submit">Transkripsi</button>
    </form>
</div>

</body>
</html>
