<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Psikotes | {{ $hasil->nama }}</title>
    <style>
        :root { --bg: #f8fafc; --text: #000; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #fff; color: var(--text); padding: 40px; margin: 0; }
        .container { max-width: 900px; margin: 0 auto; border: 2px solid #000; padding: 40px; }

        h1 { margin: 0 0 20px 0; text-transform: uppercase; letter-spacing: 1px; font-size: 1.8rem; border-bottom: 2px solid #000; padding-bottom: 20px; }
        h2 { margin: 40px 0 20px 0; text-transform: uppercase; letter-spacing: 1px; font-size: 1.2rem; }

        table { width: 100%; border-collapse: collapse; margin-top: 20px; border: 2px solid #000; }
        th, td { padding: 15px; border: 1px solid #000; text-align: left; text-transform: uppercase; font-size: 0.8rem; font-weight: 800; }
        th { background: #eee; }

        .badge { padding: 4px 8px; border: 1px solid #000; font-size: 0.7rem; text-transform: uppercase; }
        .bg-tinggi { background: #facc15; } /* Kuning */
        .bg-sedang { background: #9ca3af; color: #fff; } /* Abu-abu */
        .bg-rendah { background: #7dd3fc; } /* Biru muda */

        .disclaimer { border: 1px solid #000; padding: 15px; margin-top: 40px; font-size: 0.75rem; font-style: italic; }

        .actions { margin-top: 20px; display: flex; gap: 10px; }
        button, a { background: #000; color: #fff; border: 2px solid #000; font-weight: 900; text-transform: uppercase; cursor: pointer; padding: 10px 20px; font-size: 0.8rem; text-decoration: none; display: inline-block; transition: all 0.2s; }
        button:hover, a:hover { background: #fff; color: #000; }

        /* Animation */
        .container { animation: appear 0.6s ease-out; }
        @keyframes appear { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }

        @media print { .actions { display: none; } }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hasil Psikotes</h1>
        <div style="font-weight: 800; text-transform: uppercase; font-size: 0.9rem;">
            <p>Nama: {{ $hasil->nama }}</p>
            <p>Posisi: {{ $hasil->posisi }}</p>
            <p>Tanggal Tes: {{ $hasil->created_at->format('d-m-Y') }}</p>
        </div>

        <h2>Dimensi Kepribadian</h2>
        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>Dimensi</th>
                        <th>Skor</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $dimensiMap = [
                            'o' => 'Openness (Keterbukaan)',
                            'c' => 'Conscientiousness (Kedisiplinan)',
                            'e' => 'Extraversion (Energi Sosial)',
                            'a' => 'Agreeableness (Kehangatan/Kerjasama)',
                            'n' => 'Neuroticism (Stabilitas Emosi)',
                        ];
                    @endphp
                    @foreach(['o', 'c', 'e', 'a', 'n'] as $dim)
                        <tr>
                            <td>{{ $dimensiMap[$dim] }}</td>
                            <td>{{ $hasil->{"skor_$dim"} }}/50</td>
                            <td><span class="badge bg-{{ strtolower($hasil->{"kat_$dim"}) }}">{{ $hasil->{"kat_$dim"} }}</span></td>
                            <td style="text-transform: none; font-weight: 400;">{{ $hasil->{"desk_$dim"} }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <h2>Skor Logika</h2>
        <p style="font-weight: 800; text-transform: uppercase; font-size: 0.9rem;">
            Skor: {{ $hasil->skor_logika }}/15 <br>
            Kategori: {{ $hasil->kat_logika }} <br>
            <span style="font-weight: 400; text-transform: none;">
                @if ($hasil->skor_logika >= 12)
                    Kemampuan logika sangat baik.
                @elseif ($hasil->skor_logika >= 8)
                    Kemampuan logika cukup baik.
                @else
                    Kemampuan logika perlu digali lebih lanjut saat interview.
                @endif
            </span>
        </p>

        <div class="disclaimer">
            Disclaimer: Hasil ini adalah alat bantu screening awal, bukan diagnosis psikologis formal. Gunakan sebagai salah satu data poin dikombinasikan dengan interview.
        </div>

        <div class="actions">
            <button onclick="window.print()">Cetak Hasil</button>
            <a href="/admin">Kembali ke Dashboard</a>
        </div>
    </div>
</body>
</html>
