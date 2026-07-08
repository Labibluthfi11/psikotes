<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Import Kandidat</title>
    <style>
        body { font-family: sans-serif; padding: 40px; background: #f8fafc; }
        .container { max-width: 900px; margin: 0 auto; background: #fff; padding: 30px; border: 2px solid #000; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; border: 1px solid #000; text-align: left; }
        th { background: #eee; }
        .btn { display: inline-block; padding: 10px 20px; background: #000; color: #fff; text-decoration: none; font-weight: bold; margin-top: 20px; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Hasil Import Kandidat</h1>
        <p>Berikut adalah daftar akun yang berhasil dibuat. <strong>Pastikan data ini dicopy/disimpan</strong> karena password tidak akan ditampilkan lagi setelah halaman ini ditutup.</p>
        
        <table>
            <thead>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Posisi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kandidatBaru as $k)
                <tr>
                    <td>{{ $k['nama'] }}</td>
                    <td>{{ $k['email'] }}</td>
                    <td><code>{{ $k['password'] }}</code></td>
                    <td>{{ $k['posisi'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <a href="/admin/kandidat" class="btn">Kembali ke Daftar Kandidat</a>
    </div>
</body>
</html>
