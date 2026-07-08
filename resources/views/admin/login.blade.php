<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Access</title>
    <style>
        :root {
            --bg: #f8fafc;
            --text: #0f172a;
            --accent: #2563eb;
        }
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
            background: var(--bg);
            color: var(--text);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-card {
            background: #fff;
            padding: 48px;
            width: 100%;
            max-width: 400px;
            border: 2px solid #000;
            box-shadow: 8px 8px 0px #000;
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        h1 {
            font-size: 1.5rem;
            text-transform: uppercase;
            letter-spacing: -0.5px;
            margin: 0 0 30px 0;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .form-group { margin-bottom: 25px; }

        label {
            display: block;
            font-size: 0.75rem;
            font-weight: 800;
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 2px solid #000;
            outline: none;
            font-size: 1rem;
            transition: all 0.2s;
        }

        input:focus {
            background: #000;
            color: #fff;
        }

        button {
            width: 100%;
            padding: 15px;
            background: #000;
            color: #fff;
            border: none;
            font-weight: 900;
            text-transform: uppercase;
            cursor: pointer;
            transition: transform 0.1s;
        }

        button:hover {
            transform: translateY(-2px);
            background: var(--accent);
        }

        .error {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #e74c3c;
            color: #e74c3c;
            font-size: 0.8rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="login-card">
        <h1>Admin Access</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Email</label>
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
    </div>
</body>
</html>
