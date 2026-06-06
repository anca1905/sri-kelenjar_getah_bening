<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') — Sistem Pakar KGB</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        :root {
            --sidebar-w: 230px;
            --navy: #1a3c6e;
            --navy-dark: #132d54;
            --teal: #0ea5b0;
            --bg: #f0f4f9;
            --card-bg: #ffffff;
            --border: #dde5f0;
            --text: #2d3748;
            --muted: #718096;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Segoe UI', Arial, sans-serif; background: var(--bg); color: var(--text); font-size: 14px; }
        a { text-decoration: none; color: inherit; }

        /* SIDEBAR */
        .sidebar { position: fixed; top: 0; left: 0; width: var(--sidebar-w); height: 100vh; background: var(--navy); display: flex; flex-direction: column; z-index: 200; overflow-y: auto; }
        .sb-brand { padding: 16px 18px; border-bottom: 1px solid rgba(255,255,255,0.08); display: flex; align-items: center; gap: 10px; }
        .sb-brand-icon { width: 34px; height: 34px; background: var(--teal); border-radius: 7px; display: flex; align-items: center; justify-content: center; font-size: 1rem; color: white; flex-shrink: 0; }
        .sb-brand-text { font-weight: 700; font-size: 0.9rem; color: white; line-height: 1.2; }
        .sb-brand-sub { font-size: 0.7rem; color: rgba(255,255,255,0.45); font-weight: 400; }
        .sb-section { font-size: 0.65rem; text-transform: uppercase; letter-spacing: 0.9px; color: rgba(255,255,255,0.3); padding: 16px 18px 4px; }
        .sb-nav { list-style: none; padding: 0; }
        .sb-nav li a { display: flex; align-items: center; gap: 10px; padding: 9px 18px; font-size: 0.86rem; color: rgba(255,255,255,0.72); border-left: 3px solid transparent; transition: all 0.15s; }
        .sb-nav li a:hover { color: white; background: rgba(255,255,255,0.07); }
        .sb-nav li a.aktif { color: white; background: rgba(255,255,255,0.1); border-left-color: var(--teal); font-weight: 600; }
        .sb-nav li a i { font-size: 1rem; width: 18px; flex-shrink: 0; }
        .sb-footer { margin-top: auto; padding: 14px 18px; border-top: 1px solid rgba(255,255,255,0.08); }
        .sb-user { display: flex; align-items: center; gap: 10px; margin-bottom: 12px; }
        .sb-avatar { width: 34px; height: 34px; background: rgba(255,255,255,0.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 1rem; flex-shrink: 0; }
        .sb-username { font-size: 0.82rem; font-weight: 600; color: white; }
        .sb-role { font-size: 0.7rem; color: rgba(255,255,255,0.45); }
        .sb-logout { display: flex; align-items: center; gap: 8px; color: rgba(255,255,255,0.5); font-size: 0.82rem; cursor: pointer; }
        .sb-logout:hover { color: #fca5a5; }

        /* MAIN */
        .main { margin-left: var(--sidebar-w); min-height: 100vh; display: flex; flex-direction: column; }
        .topbar { background: white; border-bottom: 1px solid var(--border); padding: 12px 24px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 50; }
        .topbar-title { font-size: 0.93rem; font-weight: 700; color: var(--navy); }
        .topbar-breadcrumb { font-size: 0.75rem; color: var(--muted); margin-top: 1px; }
        .content { padding: 22px 24px; flex: 1; }
        .content-footer { padding: 14px 24px; border-top: 1px solid var(--border); background: white; font-size: 0.75rem; color: var(--muted); display: flex; justify-content: space-between; }

        /* CARDS */
        .card { background: white; border: 1px solid var(--border); border-radius: 12px; padding: 24px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); }
        .page-title { font-size: 1.25rem; font-weight: 700; color: var(--navy); margin: 0; display: flex; align-items: center; gap: 10px; }
        
        /* TABLE */
        .table-wrapper { overflow-x: auto; margin-top: 20px; border-radius: 8px; border: 1px solid var(--border); }
        table.table { width: 100%; border-collapse: collapse; margin-bottom: 0; }
        table.table thead th { background: #f8fafc; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.5px; color: var(--muted); padding: 14px 18px; border-bottom: 2px solid var(--border); font-weight: 700; }
        table.table tbody td { padding: 16px 18px; border-bottom: 1px solid #f1f5f9; font-size: 0.9rem; color: #334155; vertical-align: middle; }
        table.table tbody tr:last-child td { border-bottom: none; }
        table.table tbody tr:hover { background: #f8fafc; }
        
        /* BUTTONS */
        .btn-primary { background: var(--navy); color: white; border: none; padding: 10px 18px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s; display: inline-flex; align-items: center; gap: 8px; cursor: pointer; }
        .btn-primary:hover { background: var(--navy-dark); transform: translateY(-1px); box-shadow: 0 4px 10px rgba(26, 60, 110, 0.2); color: white;}
        .btn-outline { background: white; color: var(--navy); border: 1px solid #cbd5e1; padding: 9px 16px; border-radius: 8px; font-weight: 600; font-size: 0.9rem; transition: all 0.2s; cursor: pointer; }
        .btn-outline:hover { background: #f8fafc; border-color: #94a3b8; }
        
        .btn-icon { width: 34px; height: 34px; display: inline-flex; justify-content: center; align-items: center; border-radius: 6px; border: 1px solid transparent; cursor: pointer; transition: all 0.2s; color: var(--muted); background: white; }
        .btn-icon.edit { border-color: #e2e8f0; color: #0284c7; }
        .btn-icon.edit:hover { background: #f0f9ff; border-color: #bae6fd; }
        .btn-icon.delete { border-color: #e2e8f0; color: #ef4444; }
        .btn-icon.delete:hover { background: #fef2f2; border-color: #fecaca; }

        /* FORM ELEMENTS */
        .form-control { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; color: #334155; transition: border-color 0.15s, box-shadow 0.15s; }
        .form-control:focus { outline: none; border-color: var(--teal); box-shadow: 0 0 0 3px rgba(14, 165, 176, 0.15); }
        .form-label { display: block; font-weight: 600; margin-bottom: 6px; color: var(--navy); font-size: 0.9rem; }
        
        /* MODAL */
        .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px); z-index: 1000; justify-content: center; align-items: center; opacity: 0; transition: opacity 0.3s; }
        .modal-content { background: white; border-radius: 16px; width: 100%; max-width: 550px; box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04); transform: translateY(20px); transition: transform 0.3s; overflow: hidden; }
        .modal-header { padding: 20px 24px; border-bottom: 1px solid var(--border); display: flex; justify-content: space-between; align-items: center; background: #fafcfe; }
        .modal-title { margin: 0; font-size: 1.15rem; font-weight: 700; color: var(--navy); }
        .modal-close { background: none; border: none; font-size: 1.5rem; color: var(--muted); cursor: pointer; line-height: 1; padding: 0; }
        .modal-close:hover { color: #ef4444; }
        .modal-body { padding: 24px; max-height: 70vh; overflow-y: auto; }
        .modal-footer { padding: 16px 24px; border-top: 1px solid var(--border); display: flex; justify-content: flex-end; gap: 12px; background: #fafcfe; }

        /* EMPTY STATE */
        .empty-state { text-align: center; padding: 60px 20px; color: var(--muted); }
        .empty-state i { font-size: 3rem; color: #cbd5e1; margin-bottom: 16px; display: block; }
        .empty-state h4 { font-size: 1.1rem; color: var(--navy); font-weight: 600; margin-bottom: 8px; }
        .empty-state p { font-size: 0.9rem; max-width: 400px; margin: 0 auto; }
        
        /* ALERTS */
        .alert-flash { border-radius: 8px; padding: 12px 18px; font-size: 0.9rem; margin-bottom: 20px; box-shadow: 0 2px 4px rgba(0,0,0,0.02); display: flex; align-items: center; }
    </style>
    @stack('styles')
</head>
<body>

<!-- SIDEBAR -->
<nav class="sidebar">
    <div class="sb-brand">
        <div class="sb-brand-icon"><i class="bi bi-heart-pulse"></i></div>
        <div>
            <div class="sb-brand-text">LymphCare Admin</div>
            <div class="sb-brand-sub">Sistem Pakar KGB</div>
        </div>
    </div>

    <div class="sb-section">Menu Utama</div>
    <ul class="sb-nav">
        <li><a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'aktif' : '' }}">
            <i class="bi bi-grid-1x2"></i> Dashboard
        </a></li>
    </ul>

    <div class="sb-section">Data Master</div>
    <ul class="sb-nav">
        <li><a href="{{ route('admin.penyakit.index') }}" class="{{ request()->routeIs('admin.penyakit.*') ? 'aktif' : '' }}">
            <i class="bi bi-virus2"></i> Data Penyakit
        </a></li>
        <li><a href="{{ route('admin.gejala.index') }}" class="{{ request()->routeIs('admin.gejala.*') ? 'aktif' : '' }}">
            <i class="bi bi-clipboard2-pulse"></i> Data Gejala
        </a></li>
        <li><a href="{{ route('admin.pengetahuan.index') }}" class="{{ request()->routeIs('admin.pengetahuan.*') ? 'aktif' : '' }}">
            <i class="bi bi-diagram-3"></i> Basis Pengetahuan
        </a></li>
    </ul>

    <div class="sb-section">Laporan & Lainnya</div>
    <ul class="sb-nav">
        <li><a href="{{ route('admin.riwayat.index') }}" class="{{ request()->routeIs('admin.riwayat.*') ? 'aktif' : '' }}">
            <i class="bi bi-journal-text"></i> Riwayat Konsultasi
        </a></li>
        <li><a href="{{ route('konsultasi') }}" target="_blank">
            <i class="bi bi-box-arrow-up-right"></i> Lihat Situs Publik
        </a></li>
    </ul>

    <div class="sb-footer">
        <div class="sb-user">
            <div class="sb-avatar"><i class="bi bi-person"></i></div>
            <div>
                <div class="sb-username">{{ session('admin_username', 'Admin') }}</div>
                <div class="sb-role">{{ ucfirst(session('admin_role', 'Administrator')) }}</div>
            </div>
        </div>
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="sb-logout" style="background:none;border:none;width:100%;text-align:left;">
                <i class="bi bi-box-arrow-left"></i> Keluar dari Panel
            </button>
        </form>
    </div>
</nav>

<!-- MAIN AREA -->
<div class="main">
    <div class="topbar">
        <div>
            <div class="topbar-title">@yield('page_title', 'Dashboard')</div>
            <div class="topbar-breadcrumb">@yield('breadcrumb', 'Admin Panel')</div>
        </div>
        <div style="display:flex;align-items:center;gap:12px;">
            <span style="font-size:0.78rem;color:var(--muted);background:var(--bg);padding:5px 10px;border-radius:5px;">
                <i class="bi bi-calendar3 me-1"></i>
                <span id="tglHariIni"></span>
            </span>
            @yield('topbar_actions')
        </div>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert alert-success alert-flash"><i class="bi bi-check-circle me-2"></i>{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-flash"><i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-flash">
                <i class="bi bi-exclamation-triangle me-2"></i>
                @foreach($errors->all() as $error) {{ $error }}<br> @endforeach
            </div>
        @endif

        @yield('content')
    </div>

    <div class="content-footer">
        <span>Sistem Pakar KGB &mdash; Panel Administrasi</span>
        <span>Sesi login aktif &mdash; {{ session('admin_username') }}</span>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Date display
    const tgl = new Date();
    const opsi = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
    document.getElementById('tglHariIni').textContent = tgl.toLocaleDateString('id-ID', opsi);
</script>
@stack('scripts')
</body>
</html>