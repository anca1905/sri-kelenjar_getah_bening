<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Sistem Pakar KGB') — Kelenjar Getah Bening</title>
    <meta name="description" content="@yield('description', 'Sistem Pakar Diagnosis Penyakit Kelenjar Getah Bening menggunakan metode Forward Chaining dan Certainty Factor.')">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --biru-tua: #1a3c6e;
            --biru: #2563a8;
            --biru-muda: #e8f1fb;
            --aksen: #0ea5b0;
            --abu: #f5f7fa;
            --border: #dde3ea;
        }
        body { background-color: var(--abu); font-family: 'Segoe UI', Arial, sans-serif; font-size: 15px; color: #333; }
        .navbar { background-color: var(--biru-tua); padding: 0; border-bottom: 3px solid var(--aksen); }
        .navbar-brand { font-size: 1rem; font-weight: 700; padding: 14px 20px; display: flex; align-items: center; gap: 8px; color: #fff !important; }
        .navbar-brand .logo-icon { background: var(--aksen); color: white; width: 34px; height: 34px; border-radius: 6px; display: flex; align-items: center; justify-content: center; font-size: 1.1rem; }
        .navbar-nav .nav-link { color: rgba(255,255,255,0.85) !important; padding: 14px 16px !important; font-size: 0.9rem; border-bottom: 3px solid transparent; transition: border-color 0.2s, color 0.2s; }
        .navbar-nav .nav-link:hover, .navbar-nav .nav-link.active { color: #fff !important; border-bottom-color: var(--aksen); }
        .btn-login-nav { background-color: var(--aksen); color: #fff !important; border-radius: 4px; margin: 8px 16px 8px 8px; padding: 6px 16px !important; border-bottom: none !important; font-size: 0.85rem; }
        .btn-login-nav:hover { background-color: #0c8d98 !important; }
        footer { background: #1a2e4a; color: rgba(255,255,255,0.7); text-align: center; padding: 20px; font-size: 0.82rem; margin-top: 40px; }
        @yield('styles')
    </style>
    @stack('styles')
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container-fluid px-3">
        <a class="navbar-brand" href="{{ route('beranda') }}">
            <span class="logo-icon"><i class="bi bi-heart-pulse"></i></span>
            Sistem Pakar KGB
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navMenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('konsultasi') ? 'active' : '' }}" href="{{ route('konsultasi') }}">Konsultasi</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('riwayat') ? 'active' : '' }}" href="{{ route('riwayat') }}">Riwayat</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('info') ? 'active' : '' }}" href="{{ route('info') }}">Informasi Penyakit</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link btn-login-nav" href="{{ route('admin.login') }}">
                        <i class="bi bi-person-lock me-1"></i>Login Admin
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>

@yield('content')

<footer>
    <p class="mb-1">Sistem Pakar Kelenjar Getah Bening &mdash; Berbasis Metode CF dan Forward Chaining</p>
    <p class="mb-0" style="opacity:0.5;font-size:0.75rem;">Dikembangkan untuk keperluan akademis. Hasil tidak menggantikan diagnosa medis profesional.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
