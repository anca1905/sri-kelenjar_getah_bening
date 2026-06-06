<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SRI Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-wrapper">
        <div class="login-card">
            <div style="margin-bottom: 2rem;">
                <div class="brand-logo" style="justify-content: center; margin-bottom: 0.5rem; font-size: 1.5rem;">
                    <i class="fa-solid fa-virus-covid"></i> SRI Admin
                </div>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Silakan masuk untuk mengelola data</p>
            </div>

            @if(session('error'))
                <div style="background: #fee2e2; color: #ef4444; padding: 12px; border-radius: 8px; margin-bottom: 1.5rem; font-size: 0.85rem; display: flex; align-items: center; gap: 10px; text-align: left;">
                    <i class="fa-solid fa-circle-exclamation"></i> 
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <form action="{{ url('/login') }}" method="POST">
                @csrf
                <div class="form-group" style="text-align: left;">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-input" placeholder="Masukkan username" required autofocus>
                </div>

                <div class="form-group" style="text-align: left; margin-bottom: 2rem;">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="••••••••" required>
                </div>

                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 14px; font-size: 1rem; background: var(--primary);">
                    Masuk ke Dashboard <i class="fa-solid fa-arrow-right" style="margin-left: 8px;"></i>
                </button>
            </form>

            <div style="margin-top: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--border-color);">
                <a href="{{ url('/') }}" style="color: var(--text-muted); font-size: 0.85rem; display: flex; align-items: center; justify-content: center; gap: 8px;">
                    <i class="fa-solid fa-house-user"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>
</html>