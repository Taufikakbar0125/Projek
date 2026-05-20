<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin — UGK</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 100%);
            min-height: 100vh;
            display: flex; align-items: center; justify-content: center;
        }
        .login-card {
            background: #fff;
            border-radius: 20px;
            padding: 44px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .login-logo { width: 64px; height: 64px; object-fit: contain; }
        .login-title { font-size: 22px; font-weight: 700; color: #0f172a; }
        .login-sub   { font-size: 13px; color: #64748b; }
        .form-label  { font-size: 13px; font-weight: 600; color: #374151; }
        .form-control {
            border-radius: 10px; border: 1.5px solid #e2e8f0;
            padding: 10px 14px; font-size: 14px;
        }
        .form-control:focus {
            border-color: #1a56db;
            box-shadow: 0 0 0 3px rgba(26,86,219,0.1);
        }
        .btn-login {
            background: #1a56db; color: #fff;
            border: none; border-radius: 10px;
            padding: 11px; font-weight: 700;
            font-size: 14px; width: 100%;
            transition: background 0.2s;
        }
        .btn-login:hover { background: #1e429f; }
        .input-icon { position: relative; }
        .input-icon i {
            position: absolute; left: 13px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8; font-size: 15px;
        }
        .input-icon input { padding-left: 38px; }
        .toggle-password {
            position: absolute; right: 13px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8; cursor: pointer; background: none; border: none;
        }
        .alert-danger { background: #fee2e2; color: #991b1b; border: none; border-radius: 10px; font-size: 13px; }
    </style>
</head>
<body>
    <div class="login-card">
        <div class="text-center mb-4">
            <div class="login-title mb-1">Selamat Datang</div>
            <div class="login-sub">Masuk ke Panel Admin UGK</div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-exclamation-circle"></i>
                {{ $errors->first() }}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger d-flex align-items-center gap-2 mb-3">
                <i class="bi bi-exclamation-circle"></i>
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <div class="input-icon">
                    <i class="bi bi-envelope"></i>
                    <input type="email" id="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           value="{{ old('email') }}"
                           placeholder="admin@ugk.ac.id"
                           autofocus required>
                </div>
            </div>

            <div class="mb-4">
                <label for="password" class="form-label">Password</label>
                <div class="input-icon">
                    <i class="bi bi-lock"></i>
                    <input type="password" id="password" name="password"
                           class="form-control" placeholder="••••••••" required>
                    <button type="button" class="toggle-password" onclick="togglePass()">
                        <i class="bi bi-eye" id="eye-icon"></i>
                    </button>
                </div>
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" id="remember" name="remember">
                <label class="form-check-label" for="remember" style="font-size:13px;color:#374151;">
                    Ingat saya
                </label>
            </div>

            <button type="submit" class="btn-login">
                <i class="bi bi-box-arrow-in-right me-2"></i>Masuk
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ url('/') }}" class="text-decoration-none" style="font-size:12px;color:#64748b;">
                <i class="bi bi-arrow-left me-1"></i>Kembali ke Website
            </a>
        </div>
    </div>

    <script>
        function togglePass() {
            const input = document.getElementById('password');
            const icon  = document.getElementById('eye-icon');
            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'bi bi-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'bi bi-eye';
            }
        }
    </script>
</body>
</html>
