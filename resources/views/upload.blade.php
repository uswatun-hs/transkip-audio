<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Upload Audio / Video</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: #f4f6f8;
        }

        .container {
            height: 330px;
            width: 320px;
            border-radius: 10px;
            box-shadow: 4px 4px 30px rgba(0, 0, 0, .2);
            display: flex;
            flex-direction: column;
            padding: 15px;
            gap: 10px;
            background-color: rgba(0, 110, 255, 0.041);
        }

        .header {
            flex: 1;
            border: 2px dashed royalblue;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            cursor: pointer;
        }

        .header svg {
            height: 90px;
        }

        .header p {
            text-align: center;
            color: #000;
            font-size: 14px;
        }

        .footer {
            background-color: rgba(0, 110, 255, 0.075);
            height: 40px;
            padding: 8px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            font-size: 13px;
        }

        button {
            height: 40px;
            border: none;
            border-radius: 8px;
            background: royalblue;
            color: white;
            cursor: pointer;
            font-weight: bold;
        }

        button:hover {
            background: #1f4ed8;
        }

        #file {
            display: none;
        }

        .error {
            color: red;
            font-size: 13px;
            text-align: center;
        }
    </style>
</head>

<body>

    <form class="container" action="/upload" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="file" class="header">
            <svg viewBox="0 0 24 24" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M7 10V9C7 6.23858 9.23858 4 12 4C14.7614 4 17 6.23858 17 9V10C19.2091 10 21 11.7909 21 14C21 15.4806 20.1956 16.8084 19 17.5M7 10C4.79086 10 3 11.7909 3 14C3 15.4806 3.8044 16.8084 5 17.5M12 12V21M12 12L15 15M12 12L9 15"
                    stroke="#000" stroke-width="1.5"
                    stroke-linecap="round" stroke-linejoin="round" />
            </svg>
            <p id="file-text">Klik untuk memilih file audio / video</p>
        </label>

        <input id="file" type="file" name="audio" accept="audio/*,video/*" required>

        <div class="footer" id="file-name">
            Belum ada file dipilih
        </div>

        <button type="submit">Transkripsi</button>

        @if (session('error'))
            <div class="error">{{ session('error') }}</div>
        @endif
    </form>

    <script>
        const fileInput = document.getElementById('file');
        const fileName = document.getElementById('file-name');

        fileInput.addEventListener('change', function () {
            if (this.files.length > 0) {
                fileName.textContent = this.files[0].name;
            }
        });
    </script>

</body>
</html>
