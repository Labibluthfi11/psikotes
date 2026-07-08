<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Psikotes | Psikotes</title>
    <style>
        :root { --bg: #f8fafc; --text: #000; --accent: #2563eb; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #fff; color: var(--text); padding: 40px; margin: 0; }
        .container { max-width: 800px; margin: 0 auto; border: 2px solid #000; padding: 40px; }
        h1 { margin: 0 0 10px 0; text-transform: uppercase; letter-spacing: 1px; font-size: 1.8rem; }
        h2 { margin: 40px 0 20px 0; text-transform: uppercase; letter-spacing: 1px; font-size: 1.2rem; border-bottom: 2px solid #000; padding-bottom: 10px; }
        .form-info { display: flex; gap: 20px; margin-bottom: 30px; border-bottom: 2px solid #000; padding-bottom: 20px; }
        .form-group { flex: 1; }
        label.field-label { display: block; margin-bottom: 5px; font-weight: 800; text-transform: uppercase; font-size: 0.7rem; }
        p.data { font-weight: 700; font-size: 1rem; margin: 0; text-transform: uppercase; }
        .soal-card { background: #eee; padding: 20px; margin-bottom: 20px; border: 2px solid #000; }
        .soal-card p { font-weight: 700; margin: 0 0 15px 0; font-size: 0.9rem; }
        .nomor { font-size: 0.75rem; color: #555; margin-bottom: 4px; font-weight: 800; }

        /* Scale radio (Big Five) */
        .scale-options { display: flex; justify-content: space-between; align-items: center; gap: 8px; }
        .scale-options .label-text { font-size: 0.65rem; font-weight: 800; white-space: nowrap; }
        .scale-options .radio-item { display: flex; flex-direction: column; align-items: center; gap: 4px; font-size: 0.8rem; font-weight: 700; }
        .scale-options input[type="radio"] { width: 18px; height: 18px; cursor: pointer; }

        /* MC radio (Logika) */
        .mc-options { display: flex; flex-direction: column; gap: 8px; margin-top: 8px; }
        .mc-options label { display: flex; align-items: center; gap: 10px; font-size: 0.85rem; font-weight: 600; cursor: pointer; padding: 8px 12px; border: 1.5px solid #bbb; background: #fff; }
        .mc-options label:hover { border-color: #000; background: #f0f0f0; }
        .mc-options input[type="radio"] { width: 16px; height: 16px; cursor: pointer; flex-shrink: 0; }

        button { width: 100%; background: #000; color: #fff; border: 2px solid #000; font-weight: 900; text-transform: uppercase; cursor: pointer; padding: 20px; font-size: 1rem; transition: all 0.2s; margin-top: 20px; }
        button:hover { background: #fff; color: #000; }
        .error-list { border: 2px solid #000; padding: 15px; background: #fee2e2; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; font-size: 0.8rem; }
        .error-list ul { margin: 0; padding-left: 20px; }
        .container { animation: appear 0.6s ease-out; }
        @keyframes appear { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <div class="container">
        <h1>Form Psikotes</h1>

        @if ($errors->any())
            <div class="error-list">
                <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif

        <form action="/tes/submit" method="POST">
            @csrf
            <div class="form-info">
                <div class="form-group">
                    <label class="field-label">Nama Lengkap</label>
                    <p class="data">{{ $kandidat->nama }}</p>
                </div>
                <div class="form-group">
                    <label class="field-label">Posisi yang Dilamar</label>
                    <p class="data">{{ $kandidat->posisi }}</p>
                </div>
            </div>

            {{-- ============ BAGIAN KEPRIBADIAN ============ --}}
            <h2>Bagian 1 — Kepribadian (50 Pernyataan)</h2>
            <p style="font-size:0.85rem; color:#555; margin-bottom:20px;">
                Pilih angka yang paling menggambarkan diri Anda.<br>
                <strong>1</strong> = Sangat Tidak Setuju &nbsp;&nbsp; <strong>5</strong> = Sangat Setuju
            </p>

            @foreach ($soalBigFive as $index => $soal)
                <div class="soal-card">
                    <div class="nomor">Pernyataan {{ $index + 1 }} dari 50</div>
                    <p>{{ $soal['teks'] }}</p>
                    <div class="scale-options">
                        <span class="label-text">Sangat Tidak Setuju</span>
                        @for ($i = 1; $i <= 5; $i++)
                            <div class="radio-item">
                                <input type="radio" name="bf_{{ $index }}" value="{{ $i }}" required>
                                {{ $i }}
                            </div>
                        @endfor
                        <span class="label-text">Sangat Setuju</span>
                    </div>
                </div>
            @endforeach

            {{-- ============ BAGIAN LOGIKA ============ --}}
            <h2>Bagian 2 — Logika (15 Soal)</h2>
            <p style="font-size:0.85rem; color:#555; margin-bottom:20px;">
                Pilih satu jawaban yang paling tepat untuk setiap soal.
            </p>

            @foreach ($soalLogika as $index => $soal)
                <div class="soal-card">
                    <div class="nomor">Soal {{ $index + 1 }} dari 15</div>
                    <p>{{ $soal['teks'] }}</p>
                    <div class="mc-options">
                        @foreach ($soal['opsi'] as $opsi)
                            <label>
                                <input type="radio" name="lg_{{ $index }}" value="{{ $opsi }}" required>
                                {{ $opsi }}
                            </label>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <button type="submit">Selesaikan Tes &rarr;</button>
        </form>
    </div>
</body>
</html>
