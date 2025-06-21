<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Verifikasi Email Pendaftaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
            background: #f8f8f8;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 8px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .button {
            display: inline-block;
            background-color: #38a169;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 20px;
        }
        .footer {
            font-size: 0.9rem;
            color: #888;
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Halo {{ $nama }},</h2>
        <p>Terima kasih telah mendaftar. Untuk melanjutkan proses pendaftaran, silakan verifikasi email kamu dengan mengklik tombol di bawah ini:</p>

        <a href="{{ $url }}" class="button">Verifikasi Email</a>

        <p>Jika tombol di atas tidak berfungsi, kamu bisa salin dan buka link ini di browser:</p>
        <p><a href="{{ $url }}">{{ $url }}</a></p>

        <p class="footer">Email ini dikirim secara otomatis, mohon untuk tidak membalasnya.</p>
    </div>
</body>
</html>
