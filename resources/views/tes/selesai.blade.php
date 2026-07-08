<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Selesai | Psikotes</title>
    <style>
        :root { --bg: #f8fafc; --text: #000; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #fff; color: var(--text); padding: 40px; margin: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { max-width: 600px; width: 100%; border: 2px solid #000; padding: 60px; text-align: center; }

        h1 { margin: 0 0 20px 0; text-transform: uppercase; letter-spacing: 1px; font-size: 2rem; }
        p { font-weight: 600; text-transform: uppercase; font-size: 0.9rem; line-height: 1.8; margin-bottom: 30px; }

        .icon { font-size: 4rem; margin-bottom: 20px; }

        a { background: #000; color: #fff; border: 2px solid #000; font-weight: 900; text-transform: uppercase; cursor: pointer; padding: 15px 30px; font-size: 1rem; text-decoration: none; display: inline-block; transition: all 0.2s; }
        a:hover { background: #fff; color: #000; }

        /* Animation */
        .container { animation: appear 0.8s ease-out; }
        @keyframes appear { from { opacity: 0; transform: scale(0.9); } to { opacity: 1; transform: scale(1); } }
    </style>
</head>
<body>
    <div class="container">
        <h1>Tes Selesai</h1>
        <p>Terima kasih telah menyelesaikan tes ini.<br>Data jawaban Anda telah berhasil tersimpan dalam sistem kami.<br>Silakan tunggu informasi selanjutnya dari tim HR kami.</p>
        <a href="/logout-kandidat">Keluar</a>
    </div>
</body>
</html>
