<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tes Psikologi | {{ config('app.name', 'PT Ansel Muda Berkarya') }}</title>

    <style>
        /* Brutalist Animations */
        @keyframes appear {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        body {
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background-color: #ffffff;
            color: #000000;
            padding: 20px;
            animation: appear 0.6s ease-out;
        }

        .container {
            max-width: 800px;
            margin: 40px auto;
            border: 2px solid #000;
            padding: 40px;
            transition: transform 0.2s;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #000;
            padding-bottom: 20px;
            margin-bottom: 40px;
        }

        h1 { margin: 0; font-size: 1.2rem; text-transform: uppercase; letter-spacing: 1px; }

        .btn-admin {
            padding: 8px 16px;
            background: #fff;
            color: #000;
            text-decoration: none;
            font-weight: 900;
            font-size: 0.8rem;
            text-transform: uppercase;
            border: 2px solid #000;
            transition: all 0.1s;
        }

        .btn-admin:hover { background: #000; color: #fff; }

        .main-content { text-align: center; }

        h2 {
            font-size: 4rem;
            line-height: 0.9;
            margin: 0 0 20px 0;
            text-transform: uppercase;
            animation: appear 0.8s ease-out;
        }

        p { font-size: 1.2rem; color: #333; margin-bottom: 40px; max-width: 600px; margin-left: auto; margin-right: auto; animation: appear 1s ease-out; }

        .btn {
            display: inline-block;
            padding: 20px 40px;
            background: #000;
            color: #fff;
            text-decoration: none;
            font-weight: 900;
            font-size: 1.2rem;
            text-transform: uppercase;
            border: 2px solid #000;
            transition: all 0.1s;
        }

        .btn:hover { background: #fff; color: #000; transform: scale(0.98); }

        .meta {
            margin-top: 60px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            border-top: 2px solid #000;
            padding-top: 20px;
            animation: appear 1.2s ease-out;
        }
        
        .meta-item { border: 1px solid #ccc; padding: 15px; text-align: left; }
        .meta-item b { display: block; margin-bottom: 5px; }

        @media (max-width: 600px) {
            h2 { font-size: 2.5rem; }
            .meta { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>{{ config('app.name', 'PT Ansel Muda Berkarya') }}</h1>
            <a href="{{ url('/admin/login') }}" class="btn-admin">Login Admin</a>
        </header>

        <main class="main-content">
            <h2>Tes Psikologi Pendaftar</h2>
            <p>Selesaikan tes ini dengan jujur. Hasil Anda akan menjadi pertimbangan dalam proses rekrutmen kami.</p>
            
            <a href="{{ url('/tes') }}" class="btn">Mulai Tes Sekarang</a>

            <div class="meta">
                <div class="meta-item">
                    <b>DURASI</b>
                    <span>± 30 Menit</span>
                </div>
                <div class="meta-item">
                    <b>STATUS</b>
                    <span>Siap dikerjakan</span>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
