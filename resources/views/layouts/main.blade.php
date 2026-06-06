<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pakar Kelenjar Getah Bening - USN Kolaka</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Tambahan sedikit agar transisi halaman halus */
        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }
        
        .navbar-public {
            background: white;
            padding: 1rem 5%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: var(--shadow);
            position: sticky;
            top: 0;
            z-index: 1000;
            border-bottom: 3px solid var(--public-primary);
        }
    </style>
</head>
<body>

    <nav class="navbar-public">
        <div class="brand">
            <i class="fa-solid fa-hospital-user" style="color: var(--public-primary);"></i> 
            SiPakar <span style="font-weight: 300;">Getah Bening</span>
        </div>
        <div style="font-size: 0.85rem; color: var(--text-muted); font-weight: 600; text-transform: uppercase; letter-spacing: 1px;">
            USN Kolaka
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer style="background: white; padding: 2rem 0; border-top: 1px solid var(--border-color); margin-top: 5rem;">
        <div style="text-align: center;">
            <p style="color: var(--text-muted); font-size: 0.85rem;">
                &copy; 2026 <strong>Sri Nurlia</strong> - Tugas Akhir Sistem Informasi.
            </p>
            <p style="color: var(--text-muted); font-size: 0.75rem; margin-top: 5px;">
                Fakultas Teknologi Informasi, Universitas Sembilanbelas November Kolaka.
            </p>
        </div>
    </footer>

</body>
</html>