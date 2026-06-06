<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konsultasi Pasien - SiPakar</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Modifikasi khusus sidebar pasien agar warnanya Teal (Bukan Navy Admin) */
        .sidebar-pasien {
            background: var(--public-primary);
        }
        .sidebar-pasien .sidebar-menu li a:hover, .sidebar-pasien .sidebar-menu li a.active {
            background: rgba(255,255,255,0.2);
            border-left-color: var(--public-accent); /* Aksen kuning */
        }
    </style>
</head>
<body>

    <div class="admin-layout">
        
        <aside class="sidebar sidebar-pasien">
            <div class="sidebar-header" style="justify-content: center;">
                <div class="brand-logo" style="color: white;">
                    <i class="fa-solid fa-stethoscope" style="color: var(--public-accent);"></i> 
                    <span style="font-size: 1.1rem;">KONSULTASI</span>
                </div>
            </div>

            <ul class="sidebar-menu" style="margin-top: 1rem;">
                <li>
                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">
                        <i class="fa-solid fa-house"></i> Beranda
                    </a>
                </li>
                <li>
                    <a href="{{ url('/pasien/konsultasi') }}" class="{{ request()->is('pasien/konsultasi*') ? 'active' : '' }}">
                        <i class="fa-solid fa-user-doctor"></i> Konsultasi
                    </a>
                </li>
                <li>
                    <a href="{{ url('/pasien/riwayat') }}" class="{{ request()->is('pasien/riwayat*') ? 'active' : '' }}">
                        <i class="fa-solid fa-clock-rotate-left"></i> Riwayat Konsul
                    </a>
                </li>
            </ul>
        </aside>

        <main class="main-content" style="background: var(--public-bg);">
            <header class="topbar" style="justify-content: center; background: white; border-bottom: 2px solid var(--public-primary);">
                <h2 style="color: var(--public-primary); font-weight: 700; font-size: 1.2rem;">
                    SISTEM PAKAR PENYAKIT KELENJAR GETAH BENING
                </h2>
            </header>

            <div class="content-wrapper" style="max-width: 800px; margin: 0 auto;">
                @yield('content')
            </div>
        </main>

    </div>

</body>
</html>