<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidate Login | {{ config('app.name', 'PT Ansel Muda Berkarya') }}</title>
    <style>
        body { 
            margin: 0;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: #000;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-wrapper {
            width: 100%;
            max-width: 400px;
            padding: 20px;
        }

        .login-card {
            background: #fff;
            color: #000;
            padding: 40px;
            border: 4px solid #fff;
            box-shadow: 10px 10px 0px rgba(255,255,255,0.2);
            animation: fadeIn 0.8s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: scale(0.95); }
            to { opacity: 1; transform: scale(1); }
        }

        h1 { 
            font-size: 2rem; 
            margin: 0 0 30px 0; 
            text-transform: uppercase;
            letter-spacing: -1px;
            border-bottom: 4px solid #000;
            padding-bottom: 10px;
        }

        .form-group { margin-bottom: 20px; }

        label { 
            display: block; 
            font-size: 0.7rem; 
            font-weight: 900; 
            text-transform: uppercase; 
            margin-bottom: 5px; 
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #000;
            font-size: 1rem;
            box-sizing: border-box;
        }

        input:focus {
            outline: none;
            background: #000;
            color: #fff;
        }

        button {
            width: 100%;
            padding: 15px;
            background: #000;
            color: #fff;
            border: 2px solid #000;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
            margin-top: 10px;
            transition: all 0.2s;
        }

        button:hover {
            background: #fff;
            color: #000;
        }

        .error {
            margin-top: 20px;
            padding: 10px;
            background: #ffcccc;
            color: #cc0000;
            font-size: 0.8rem;
            text-align: center;
            font-weight: bold;
        }

        .note {
            text-align: center;
            font-size: 0.75rem;
            color: #666;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <h1>Login</h1>
            <form action="/login-kandidat" method="POST">
                @csrf
                <div class="form-group">
                    <label>Email Address</label>
                    <input type="email" name="email" required autocomplete="email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required autocomplete="current-password">
                </div>
                <button type="submit">Login</button>
            </form>
            @if ($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif
            <p class="note">Akun login diberikan oleh HRD.</p>
        </div>
    </div>
</body>
</html>
