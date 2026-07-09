<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kandidat | Admin</title>
    <style>
        :root { --bg: #f8fafc; --text: #000; --accent: #2563eb; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #fff; color: var(--text); padding: 40px; margin: 0; }
        .container { max-width: 800px; margin: 0 auto; border: 2px solid #000; padding: 40px; }

        h1 { margin: 0 0 20px 0; text-transform: uppercase; letter-spacing: 1px; font-size: 1.8rem; border-bottom: 2px solid #000; padding-bottom: 20px; }
        h2 { margin: 40px 0 20px 0; text-transform: uppercase; letter-spacing: 1px; font-size: 1.2rem; }

        /* Chart Container */
        #chartContainer { width: 100%; height: 300px; border: 2px solid #000; padding: 20px; background: #eee; margin: 20px auto 0 auto; }

        .actions { margin-top: 30px; display: flex; gap: 10px; }
        a { background: #000; color: #fff; border: 2px solid #000; font-weight: 900; text-transform: uppercase; cursor: pointer; padding: 10px 20px; font-size: 0.8rem; text-decoration: none; display: inline-block; transition: all 0.2s; }
        a:hover { background: #fff; color: #000; }
        button.btn-delete { background: #e11d48; color: #fff; border: 2px solid #000; font-weight: 900; text-transform: uppercase; cursor: pointer; padding: 10px 20px; font-size: 0.8rem; transition: all 0.2s; }
        button.btn-delete:hover { background: #be123c; color: #fff; }

        /* Animation */
        .container { animation: appear 0.6s ease-out; }
        @keyframes appear { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <h1>Detail Kandidat</h1>
        <div style="font-weight: 800; text-transform: uppercase; font-size: 0.9rem;">
            <p>Nama: {{ $hasil->nama }}</p>
            <p>Posisi: {{ $hasil->posisi }}</p>
            <p>Tanggal Tes: {{ $hasil->created_at->format('d-m-Y') }}</p>
        </div>

        <h2>Profil Kepribadian (Big Five)</h2>
        <div id="chartContainer">
            <canvas id="bigFiveChart"></canvas>
        </div>

        <h2>Skor Logika</h2>
        <p style="font-weight: 800; text-transform: uppercase; font-size: 0.9rem;">
            Skor: {{ $hasil->skor_logika }}/20 <br>
            Kategori: {{ $hasil->kat_logika }}
        </p>

        <h2 style="cursor: pointer;" onclick="document.getElementById('jawabanDetail').style.display = (document.getElementById('jawabanDetail').style.display === 'none' ? 'block' : 'none')">
            Lihat Detail Jawaban ▾
        </h2>
        <div id="jawabanDetail" style="display: none; margin-top: 20px;">
            @php
                $tesService = app('App\Services\TesService');
                $soalBigFive = $tesService->getSoalBigFive();
                $soalLogika = $tesService->getSoalLogika();
            @endphp
            <div style="background: #eee; padding: 20px; border: 2px solid #000; overflow-x: auto;">
                <h3>Bagian 1: Kepribadian</h3>
                <table style="width: 100%; border-collapse: collapse; font-size: 0.8rem; margin-bottom: 20px;">
                    <thead><tr style="background: #000; color: #fff;"><th style="padding: 10px; border: 1px solid #ccc;">No</th><th style="padding: 10px; border: 1px solid #ccc;">Pernyataan</th><th style="padding: 10px; border: 1px solid #ccc;">Skala (1-5)</th></tr></thead>
                    <tbody>
                        @foreach($soalBigFive as $i => $soal)
                        <tr>
                            <td style="padding: 10px; border: 1px solid #ccc;">{{ $i + 1 }}</td>
                            <td style="padding: 10px; border: 1px solid #ccc;">{{ $soal['teks'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">{{ $hasil->jawaban_detail['bf_' . $i] ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h3>Bagian 2: Logika</h3>
                <table style="width: 100%; border-collapse: collapse; font-size: 0.8rem;">
                    <thead><tr style="background: #000; color: #fff;">
                        <th style="padding: 10px; border: 1px solid #ccc;">No</th>
                        <th style="padding: 10px; border: 1px solid #ccc;">Soal</th>
                        <th style="padding: 10px; border: 1px solid #ccc;">Jawaban Kandidat</th>
                        <th style="padding: 10px; border: 1px solid #ccc;">Jawaban Benar</th>
                    </tr></thead>
                    <tbody>
                        @foreach($soalLogika as $i => $soal)
                        @php
                            $jawabanKandidat = $hasil->jawaban_detail['lg_' . $i] ?? '-';
                            $isBenar = ($jawabanKandidat === $soal['jawaban']);
                        @endphp
                        <tr style="background: {{ $isBenar ? '#dcfce7' : '#fee2e2' }};">
                            <td style="padding: 10px; border: 1px solid #ccc;">{{ $i + 1 }}</td>
                            <td style="padding: 10px; border: 1px solid #ccc;">{{ $soal['teks'] }}</td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center; font-weight: bold;">
                                {{ $jawabanKandidat }}
                            </td>
                            <td style="padding: 10px; border: 1px solid #ccc; text-align: center;">{{ $soal['jawaban'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="actions">
            <a href="/admin">Kembali ke Dashboard</a>
            <form action="/admin/{{ $hasil->id }}" method="POST" onsubmit="event.preventDefault(); openDeleteModal(this);">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Hapus Data</button>
            </form>
        </div>
    </div>

    @include('components.delete-modal')

    <script>
        const ctx = document.getElementById('bigFiveChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Keterbukaan', 'Kedisiplinan', 'Energi Sosial', 'Kehangatan/Kerjasama', 'Stabilitas Emosi'],
                datasets: [{
                    label: 'Skor Kepribadian',
                    data: [
                        {{ $hasil->skor_o }},
                        {{ $hasil->skor_c }},
                        {{ $hasil->skor_e }},
                        {{ $hasil->skor_a }},
                        {{ $hasil->skor_n }}
                    ],
                    backgroundColor: [
                        '#ef4444', // Red
                        '#f97316', // Orange
                        '#eab308', // Yellow
                        '#22c55e', // Green
                        '#3b82f6'  // Blue
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 50,
                        ticks: { font: { weight: 'bold' } }
                    },
                    x: {
                        ticks: { font: { weight: 'bold' } }
                    }
                },
                plugins: {
                    legend: { display: false }
                }
            }
        });
    </script>
</body>
</html>
