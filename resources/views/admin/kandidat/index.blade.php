<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kandidat | Admin</title>
    <style>
        :root { --bg: #f8fafc; --text: #000; --accent: #2563eb; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #fff; color: var(--text); padding: 40px; margin: 0; }
        .container { max-width: 1100px; margin: 0 auto; border: 2px solid #000; padding: 40px; }
        
        /* Header */
        header { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #000; padding-bottom: 20px; margin-bottom: 40px; }
        h1 { margin: 0; text-transform: uppercase; letter-spacing: 1px; font-size: 1.5rem; }
        .nav-links { display: flex; gap: 15px; }
        a { text-decoration: none; color: #000; font-weight: 800; text-transform: uppercase; font-size: 0.8rem; border: 2px solid #000; padding: 8px 16px; transition: all 0.2s; }
        a:hover { background: #000; color: #fff; }
        button { background: #000; color: #fff; border: 2px solid #000; font-weight: 900; text-transform: uppercase; cursor: pointer; padding: 8px 16px; font-size: 0.8rem; transition: all 0.2s; }
        button:hover { background: #fff; color: #000; }
        .btn-add { background: #2563eb; color: #fff; border: 2px solid #000; }
        .btn-add:hover { background: #1d4ed8; color: #fff; }
        .btn-delete { background: #e11d48; color: #fff; border: 2px solid #000; margin: 0; }
        .btn-delete:hover { background: #be123c; color: #fff; }

        /* Table */
        table { width: 100%; border-collapse: collapse; margin-top: 20px; border: 2px solid #000; }
        th, td { padding: 15px; border: 1px solid #000; text-align: left; text-transform: uppercase; font-size: 0.75rem; font-weight: 800; }
        th { background: #eee; }
        .badge { padding: 4px 8px; border: 1px solid #000; font-size: 0.7rem; }
        .bg-sukses { background: #22c55e; color: #fff; }
        .bg-belum { background: #f59e0b; color: #fff; }
        
        /* Alert */
        .alert-success { border: 2px solid #000; padding: 15px; background: #dcfce7; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; font-size: 0.8rem; }

        /* Animation */
        .container { animation: appear 0.6s ease-out; }
        @keyframes appear { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Kelola Kandidat</h1>
            <div class="nav-links">
                <a href="/admin">Kembali ke Dashboard</a>
                <a href="/admin/kandidat/create" class="btn-add">Tambah Kandidat</a>
            </div>
        </header>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        <div style="margin-bottom: 30px; padding: 20px; border: 2px solid #000; background: #eee;">
            <h2 style="margin-top: 0; font-size: 1rem;">Import Kandidat (CSV/Excel)</h2>
            <p style="font-size: 0.8rem; margin-bottom: 15px;">Upload file CSV (kolom: Nama, Posisi). Sistem akan otomatis membuat akun.</p>
            <form action="/admin/kandidat/import" method="POST" enctype="multipart/form-data" style="display:inline-block;">
                @csrf
                <input type="file" name="csv_file" accept=".csv" required style="padding: 5px; border: 1px solid #000;">
                <button type="submit" class="btn-add">Upload & Import</button>
            </form>
            <a href="/admin/kandidat/import-history" style="margin-left:10px; padding: 10px 16px; background:#fff; border:2px solid #000; font-size: 0.8rem; font-weight:bold; color:#000; text-decoration:none;">Lihat Riwayat Semua Import</a>
        </div>

        <div style="overflow-x:auto;">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Posisi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($kandidat as $index => $k)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $k->nama }}</td>
                        <td>{{ $k->email }}</td>
                        <td>{{ $k->posisi }}</td>
                        <td>
                            <span class="badge {{ $k->sudah_tes ? 'bg-sukses' : 'bg-belum' }}">
                                {{ $k->sudah_tes ? 'Sudah Tes' : 'Belum Tes' }}
                            </span>
                        </td>
                        <td>
                            <form action="/admin/kandidat/{{ $k->id }}" method="POST" onsubmit="event.preventDefault(); openDeleteModal(this);">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-delete">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @include('components.delete-modal')
</body>
</html>
