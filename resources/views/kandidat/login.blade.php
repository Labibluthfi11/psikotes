<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kandidat | Psikotes</title>
    <style>
        body { font-family: sans-serif; padding: 40px; }
        .container { max-width: 400px; margin: 0 auto; border: 2px solid #000; padding: 40px; }
        h1 { text-align: center; }
        .form-group { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; }
        select, input { width: 100%; padding: 10px; border: 2px solid #000; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #000; color: #fff; border: none; cursor: pointer; }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        <form action="/login-kandidat" method="POST">
            @csrf
            <div class="form-group">
                <label>Pilih Nama</label>
                <select name="nama" required>
                    <option value="">-- Pilih Nama Anda --</option>
                    @foreach(\App\Models\Kandidat::orderBy('nama')->get() as $kandidat)
                        <option value="{{ $kandidat->nama }}">{{ $kandidat->nama }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Masukkan PIN</label>
                <input type="password" name="pin" required maxlength="6">
            </div>
            <button type="submit">Masuk</button>
        </form>
    </div>
</body>
</html>
