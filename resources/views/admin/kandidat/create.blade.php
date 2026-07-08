<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kandidat | Admin</title>
    <style>
        :root { --bg: #f8fafc; --text: #000; --accent: #2563eb; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; background: #fff; color: var(--text); padding: 40px; margin: 0; }
        .container { max-width: 600px; margin: 0 auto; border: 2px solid #000; padding: 40px; }
        
        /* Header */
        h1 { margin: 0 0 30px 0; text-transform: uppercase; letter-spacing: 1px; font-size: 1.5rem; text-align: center; border-bottom: 2px solid #000; padding-bottom: 20px; }
        
        /* Form */
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 8px; font-weight: 800; text-transform: uppercase; font-size: 0.8rem; }
        input, select { width: 100%; border: 2px solid #000; padding: 12px; font-size: 1rem; box-sizing: border-box; font-family: inherit; }
        input:focus, select:focus { outline: none; background: #eee; }
        button { width: 100%; background: #000; color: #fff; border: 2px solid #000; font-weight: 900; text-transform: uppercase; cursor: pointer; padding: 15px; font-size: 1rem; transition: all 0.2s; }
        button:hover { background: #fff; color: #000; }
        
        /* Links/Notes */
        a { text-decoration: none; color: #000; font-weight: 800; text-transform: uppercase; font-size: 0.8rem; border: 2px solid #000; padding: 8px 16px; display: inline-block; margin-bottom: 20px; transition: all 0.2s; }
        a:hover { background: #000; color: #fff; }
        .note { font-size: 0.75rem; color: #555; margin-top: 20px; text-align: center; font-weight: 600; line-height: 1.4; border: 1px solid #000; padding: 10px; }
        
        /* Errors */
        .error-list { border: 2px solid #000; padding: 15px; background: #fee2e2; font-weight: 800; margin-bottom: 20px; text-transform: uppercase; font-size: 0.8rem; }
        .error-list ul { margin: 0; padding-left: 20px; }

        /* Animation */
        .container { animation: appear 0.6s ease-out; }
        @keyframes appear { from { opacity: 0; transform: translateY(20px); } to { opacity: 1; transform: translateY(0); } }
    </style>
</head>
<body>
    <div class="container">
        <a href="/admin/kandidat">&larr; Kembali</a>
        <h1>Tambah Kandidat</h1>

        @if ($errors->any())
            <div class="error-list">
                <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
            </div>
        @endif

        <form action="/admin/kandidat" method="POST">
            @csrf
            <div class="form-group">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" value="{{ old('nama') }}" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Posisi yang Dilamar</label>
                <select name="posisi" required>
                    <option value="">-- Pilih Posisi --</option>
                    @foreach(['HRGA', 'FINANCE ACCOUNTING', 'WAREHOUSE AND LOGISTIK', 'APOTEKER', 'REGULATORY AND DEVELOPMENT', 'GENERAL AFFAIR', 'SOCIAL MEDIA SPESIALIST', 'DIGITAL MARKETING', 'ADMINISTRASI PERKANTORAN', 'KONTEN KREATOR', 'DESAIGN GRAFIS', 'QUALITY CONTROL', 'STAFF FARMASI', 'IT', 'SECURITY', 'PROCURTMEN', 'PPIC', 'DATA ANALYST', 'ADMIN'] as $posisi)
                        <option value="{{ $posisi }}" {{ old('posisi') == $posisi ? 'selected' : '' }}>{{ $posisi }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Simpan Kandidat</button>
        </form>

        <p class="note">Password ini yang akan digunakan kandidat untuk login. Kirimkan email dan password ini ke kandidat via WhatsApp atau email.</p>
    </div>
</body>
</html>
