<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - Sistem Pakar KGB</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { background: #eef2f7; font-family: 'Segoe UI', Arial, sans-serif; min-height: 100vh; display: flex; flex-direction: column; }
        .login-wrap { flex: 1; display: flex; align-items: center; justify-content: center; padding: 40px 16px; }
        .login-card { background: white; border-radius: 8px; border: 1px solid #dde3ea; width: 100%; max-width: 400px; overflow: hidden; }
        .login-header { background: #1a3c6e; color: white; padding: 24px 28px; text-align: center; }
        .login-header .logo-box { width: 56px; height: 56px; background: rgba(255,255,255,0.15); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin: 0 auto 12px; font-size: 1.6rem; }
        .login-header h2 { font-size: 1.1rem; font-weight: 700; margin: 0 0 4px; }
        .login-header p { font-size: 0.82rem; opacity: 0.75; margin: 0; }
        .login-body { padding: 28px; }
        .form-label { font-size: 0.85rem; font-weight: 600; color: #444; margin-bottom: 5px; }
        .form-control { font-size: 0.9rem; border: 1px solid #ccc; border-radius: 5px; padding: 9px 12px; }
        .form-control:focus { border-color: #1a3c6e; box-shadow: 0 0 0 3px rgba(26,60,110,0.12); }
        .btn-masuk { background: #1a3c6e; color: white; border: none; width: 100%; padding: 10px; border-radius: 5px; font-size: 0.9rem; font-weight: 600; margin-top: 8px; cursor: pointer; transition: background 0.2s; }
        .btn-masuk:hover { background: #2563a8; }
        .back-link { text-align: center; margin-top: 16px; font-size: 0.84rem; color: #666; }
        .back-link a { color: #1a3c6e; text-decoration: none; }
        .back-link a:hover { text-decoration: underline; }
        footer { background: #1a2e4a; color: rgba(255,255,255,0.5); text-align: center; padding: 14px; font-size: 0.78rem; }
    </style>
</head>
<body>

<div class="login-wrap">
    <div>
        <div class="login-card">
            <div class="login-header">
                <div class="logo-box"><i class="bi bi-heart-pulse"></i></div>
                <h2>Panel Admin</h2>
                <p>Sistem Pakar Kelenjar Getah Bening</p>
            </div>
            <div class="login-body">
                @if(session('success'))
                    <div class="alert alert-success" style="font-size:0.85rem;padding:10px 14px;margin-bottom:14px;">
                        <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
                    </div>
                @endif

                @if($errors->has('login'))
                    <div class="alert alert-danger" style="font-size:0.85rem;padding:10px 14px;margin-bottom:14px;">
                        <i class="bi bi-x-circle me-1"></i> {{ $errors->first('login') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.post') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label" for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username"
                               value="{{ old('username') }}"
                               placeholder="Masukkan username" autocomplete="username" required>
                        @error('username')
                            <div style="color:#c0392b;font-size:0.78rem;margin-top:4px;">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="password">Password</label>
                        <div style="position:relative;">
                            <input type="password" class="form-control" id="password" name="password"
                                   placeholder="Masukkan password" autocomplete="current-password"
                                   required style="padding-right:40px;">
                            <button type="button" onclick="togglePass()" style="position:absolute;top:50%;right:10px;transform:translateY(-50%);background:none;border:none;color:#888;cursor:pointer;font-size:1rem;">
                                <i class="bi bi-eye" id="ikonMata"></i>
                            </button>
                        </div>
                        <div style="font-size:0.78rem;color:#888;margin-top:4px;">Demo: username <strong>admin</strong>, password <strong>admin123</strong></div>
                    </div>
                    <button type="submit" class="btn-masuk">
                        <i class="bi bi-box-arrow-in-right me-1"></i> Masuk
                    </button>
                </form>

                <div class="back-link">
                    <a href="{{ route('konsultasi') }}"><i class="bi bi-arrow-left me-1"></i>Kembali ke Halaman Konsultasi</a>
                </div>
            </div>
        </div>
    </div>
</div>

<footer>Sistem Pakar KGB &mdash; Hak Akses Terbatas</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function togglePass() {
        const inp = document.getElementById('password');
        const ikon = document.getElementById('ikonMata');
        if (inp.type === 'password') { inp.type = 'text'; ikon.className = 'bi bi-eye-slash'; }
        else { inp.type = 'password'; ikon.className = 'bi bi-eye'; }
    }
</script>
</body>
</html>
