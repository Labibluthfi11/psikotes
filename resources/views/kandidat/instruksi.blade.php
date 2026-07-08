<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instruksi Tes | Psikotes</title>
    <style>
        :root { --bg: #f8fafc; --text: #000; --accent: #2563eb; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #fff; color: var(--text); padding: 40px; margin: 0; display: flex; justify-content: center; align-items: center; min-height: 100vh; }
        .container { max-width: 600px; width: 100%; border: 2px solid #000; padding: 40px; text-align: center; }

        /* Typography */
        h1 { margin: 0 0 20px 0; text-transform: uppercase; letter-spacing: 1px; font-size: 1.5rem; }
        p { font-weight: 600; text-transform: uppercase; font-size: 0.9rem; }

        /* Info */
        .info { border: 2px solid #000; padding: 20px; margin: 30px 0; text-align: left; background: #eee; }
        .info p { font-size: 0.8rem; line-height: 1.6; }

        /* Button */
        .btn-mulai { background: #000; color: #fff; border: 2px solid #000; font-weight: 900; text-transform: uppercase; cursor: pointer; padding: 15px 30px; font-size: 1rem; text-decoration: none; display: inline-block; transition: all 0.2s; }
        .btn-mulai:hover { background: #fff; color: #000; }

        /* Animation */
        .container { animation: appear 0.6s ease-out; }
        @keyframes appear { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <div class="container">
        @if(session('error'))
            <div style="background: #ef4444; color: #fff; padding: 10px; margin-bottom: 20px;">{{ session('error') }}</div>
        @endif

        <h1>Halo, {{ Auth::guard('kandidat')->user()->nama }}</h1>
        <p>Posisi yang dilamar: <strong>{{ Auth::guard('kandidat')->user()->posisi }}</strong></p>

        <div class="info">
            <p><strong>Instruksi Tes:</strong></p>
            <p>Tes ini terdiri dari 2 bagian: 50 soal kepribadian (skala 1-5) dan 15 soal logika pilihan ganda. Kerjakan dengan jujur, tidak ada jawaban benar/salah untuk bagian kepribadian. Pastikan koneksi internet stabil sebelum mulai.</p>
            
            <p style="margin-top: 15px; font-size: 1.2rem; font-weight: bold;">
                Sisa Waktu Ujian: <span id="kandidat-timer" style="color: #2563eb;">--:--</span>
            </p>
        </div>

        <form action="/tes/mulai" method="POST">
            @csrf
            <button type="submit" class="btn-mulai">Mulai Tes Sekarang</button>
        </form>
    </div>

    <script>
        function updateTimer() {
            fetch('/admin/ujian/sisa-waktu', {
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                let remaining = Math.max(0, Math.floor(data.remaining));
                const minutes = Math.floor(remaining / 60);
                const seconds = remaining % 60;
                document.getElementById('kandidat-timer').textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}`;
            });
        }
        setInterval(updateTimer, 1000);
        updateTimer();
    </script>
</body>
</html>
