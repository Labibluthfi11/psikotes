<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        :root { --bg: #f8fafc; --text: #000; --accent: #2563eb; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #fff; color: var(--text); padding: 40px; margin: 0; }
        .container { max-width: 1100px; margin: 0 auto; border: 2px solid #000; padding: 40px; }

        /* Header */
        header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #000; padding-bottom: 20px; margin-bottom: 40px; }
        h1 { margin: 0; text-transform: uppercase; letter-spacing: 1px; font-size: 1.5rem; }
        .nav-links { display: flex; gap: 15px; }
        a { text-decoration: none; color: #000; font-weight: 800; text-transform: uppercase; font-size: 0.8rem; border: 2px solid #000; padding: 8px 16px; }
        a:hover { background: #000; color: #fff; }
        button { background: #000; color: #fff; border: 2px solid #000; font-weight: 900; text-transform: uppercase; cursor: pointer; padding: 8px 16px; font-size: 0.8rem; }
        button:hover { background: #fff; color: #000; }

        /* Stats & Charts */
        .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .stat-card { border: 2px solid #000; padding: 20px; background: #eee; text-align: center; }
        .stat-card h3 { margin: 0; font-size: 0.8rem; text-transform: uppercase; }
        .stat-card p { margin: 10px 0 0 0; font-size: 2rem; font-weight: 900; }
        .chart-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 40px; }
        .chart-card { border: 2px solid #000; padding: 20px; height: 300px; }

        /* Table */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; border: 2px solid #000; }
        th, td { padding: 15px; border: 1px solid #000; text-align: left; text-transform: uppercase; font-size: 0.75rem; font-weight: 800; }
        th { background: #eee; }
        .badge { padding: 4px 8px; border: 1px solid #000; font-size: 0.7rem; }
        .bg-sukses { background: #22c55e; color: #fff; }
        .bg-belum { background: #f59e0b; color: #fff; }

        /* Animation */
        .container { animation: appear 0.6s ease-out; }
        @keyframes appear { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="container">
        <header>
            <h1>Dashboard Admin</h1>
            <div class="nav-links">
                <!-- Kontrol Ujian -->
                <form action="/admin/ujian/status" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="status" value="running">
                    <button type="submit" style="background:#22c55e;">Start Ujian</button>
                </form>
                <form action="/admin/ujian/status" method="POST" style="display:inline;">
                    @csrf
                    <input type="hidden" name="status" value="paused">
                    <button type="submit" style="background:#ef4444;">Pause Ujian</button>
                </form>
                
                <a href="/admin/kandidat">Kelola Kandidat</a>
                <form action="/admin/logout" method="POST">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </div>
        </header>

        <div class="dashboard-grid">
            <div class="stat-card"><h3>Total Kandidat</h3><p>{{ $stats['total'] }}</p></div>
            <div class="stat-card"><h3>Rata-Rata Skor Logika</h3><p>{{ $stats['avg_logika'] }}</p></div>
        </div>

        <div class="chart-grid">
            <div class="chart-card"><canvas id="radarChart"></canvas></div>
            <div class="chart-card"><canvas id="barChart"></canvas></div>
        </div>

        <form action="/admin" method="GET" style="margin-bottom: 20px; display: flex; gap: 10px;">
            <input type="text" name="search" placeholder="Cari nama..." value="{{ request('search') }}" style="border: 2px solid #000; padding: 8px; flex-grow: 1;">
            <button type="submit">Cari</button>
        </form>

        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Posisi</th>
                        <th>Tanggal</th>
                        <th>Keterbukaan</th>
                        <th>Kedisiplinan</th>
                        <th>Energi Sosial</th>
                        <th>Kerjasama</th>
                        <th>Stabilitas Emosi</th>
                        <th>Logika</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($hasilTes as $index => $h)
                    <tr>
                        <td>{{ $hasilTes->firstItem() + $index }}</td>
                        <td>{{ $h->nama }}</td>
                        <td>{{ $h->posisi }}</td>
                        <td>{{ $h->created_at->format('d-m-Y') }}</td>
                        @foreach(['o', 'c', 'e', 'a', 'n'] as $dim)
                            <td>
                                {{ $h->{"skor_" . $dim} }}
                                <span class="badge {{ $h->{"kat_" . $dim} == 'Tinggi' ? 'bg-sukses' : 'bg-belum' }}">{{ $h->{"kat_" . $dim} }}</span>
                            </td>
                        @endforeach
                        <td>{{ $h->skor_logika }}</td>
                        <td><a href="/admin/{{ $h->id }}">Detail</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;">{{ $hasilTes->links() }}</div>
    </div>

    <script>
        // Radar Chart
        new Chart(document.getElementById('radarChart'), {
            type: 'radar',
            data: {
                labels: ['Keterbukaan', 'Kedisiplinan', 'Energi Sosial', 'Kerjasama', 'Stabilitas Emosi'],
                datasets: [{
                    label: 'Profil Rata-rata',
                    data: [{{ implode(',', $stats['big_five']) }}],
                    backgroundColor: 'rgba(0,0,0,0.2)',
                    borderColor: '#000',
                    borderWidth: 2
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });

        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Kurang', 'Cukup', 'Baik'],
                datasets: [{
                    label: 'Distribusi Skor Logika',
                    data: [{{ $stats['logika_dist']['Kurang'] }}, {{ $stats['logika_dist']['Cukup'] }}, {{ $stats['logika_dist']['Baik'] }}],
                    backgroundColor: ['#ef4444', '#f97316', '#22c55e']
                }]
            },
            options: { responsive: true, maintainAspectRatio: false }
        });
    </script>
</body>
</html>
