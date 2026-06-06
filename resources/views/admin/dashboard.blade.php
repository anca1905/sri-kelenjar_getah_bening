@extends('layouts.admin')

@section('page_title', 'Dashboard')
@section('breadcrumb', 'Admin Panel / Dashboard Utama')

@push('styles')
<style>
    .welcome-section { 
        background: linear-gradient(135deg, #1a3c6e 0%, #0ea5b0 100%); 
        border-radius: 12px; 
        padding: 28px 24px; 
        color: white;
        margin-bottom: 24px;
        box-shadow: 0 8px 16px rgba(14, 165, 176, 0.15);
        position: relative;
        overflow: hidden;
    }
    .welcome-section::after {
        content: '';
        position: absolute;
        top: -50px; right: -50px;
        width: 200px; height: 200px;
        background: rgba(255,255,255,0.1);
        border-radius: 50%;
    }
    .welcome-section h1 { font-size: 1.5rem; font-weight: 700; margin-bottom: 6px; position: relative; z-index: 2; }
    .welcome-section p { font-size: 0.95rem; opacity: 0.9; margin: 0; position: relative; z-index: 2; }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 20px;
        margin-bottom: 24px;
    }
    .stat-card {
        background: white;
        border: 1px solid var(--border);
        border-radius: 12px;
        padding: 24px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .stat-card:hover { transform: translateY(-4px); box-shadow: 0 10px 20px rgba(0,0,0,0.06); }
    .stat-info { display: flex; flex-direction: column; }
    .stat-title { font-size: 0.85rem; color: var(--muted); font-weight: 700; text-transform: uppercase; margin-bottom: 8px; letter-spacing: 0.5px; }
    .stat-value { font-size: 2rem; font-weight: 800; color: var(--navy); line-height: 1; margin-bottom: 12px; }
    .stat-trend { font-size: 0.75rem; padding: 4px 10px; border-radius: 6px; display: inline-flex; align-items: center; gap: 6px; font-weight: 600; width: fit-content; }
    .stat-trend.primary { background: #e0f2fe; color: #0284c7; }
    .stat-trend.success { background: #d1fae5; color: #059669; }
    .stat-trend.warning { background: #fef3c7; color: #d97706; }
    
    .stat-icon {
        width: 60px; height: 60px;
        border-radius: 16px;
        display: flex; justify-content: center; align-items: center;
        font-size: 1.8rem; color: white;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .bg-teal { background: linear-gradient(135deg, #0ea5b0, #067c85); }
    .bg-blue { background: linear-gradient(135deg, #3b82f6, #1d4ed8); }
    .bg-orange { background: linear-gradient(135deg, #f59e0b, #b45309); }

    .dashboard-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 20px;
        margin-bottom: 24px;
    }
    @media (max-width: 992px) {
        .dashboard-grid { grid-template-columns: 1fr; }
    }
    
    .card { background: white; border: 1px solid var(--border); border-radius: 12px; padding: 22px; box-shadow: 0 2px 10px rgba(0,0,0,0.02); height: 100%; }
    .card-title { font-size: 1.05rem; font-weight: 700; color: var(--navy); margin-bottom: 20px; display: flex; align-items: center; gap: 10px; }
    
    .quick-links { display: flex; flex-direction: column; gap: 12px; }
    .quick-link { display: flex; align-items: center; gap: 14px; padding: 14px 18px; border-radius: 10px; border: 1px solid var(--border); color: var(--navy); font-weight: 600; font-size: 0.95rem; transition: all 0.2s; background: #fafcfe; }
    .quick-link i { font-size: 1.3rem; }
    .quick-link:hover { background: #f0f7ff; border-color: #93c5fd; transform: translateX(5px); }
    .quick-link.primary { background: var(--navy); color: white; border-color: var(--navy); }
    .quick-link.primary:hover { background: var(--navy-dark); transform: translateX(5px); color: white; border-color: var(--navy-dark); }

    .riwayat-list { margin: 0; padding: 0; list-style: none; }
    .riwayat-item { display: flex; justify-content: space-between; align-items: center; padding: 14px 0; border-bottom: 1px dashed var(--border); }
    .riwayat-item:last-child { border-bottom: none; }
    .riwayat-item .kode { font-family: monospace; font-weight: 700; color: var(--navy); font-size: 0.9rem; }
    .riwayat-item .waktu { font-size: 0.8rem; color: var(--muted); margin-top: 4px; }
    .riwayat-item .hasil { font-size: 0.9rem; font-weight: 700; margin-bottom: 4px; }
    
    .chart-container { position: relative; height: 320px; width: 100%; }
</style>
@endpush

@section('content')
<div class="welcome-section">
    <h1><i class="bi bi-stars me-2"></i> Selamat Datang, {{ session('admin_username', 'Admin') }}!</h1>
    <p>Kelola data sistem pakar diagnosis penyakit leher dan pantau riwayat konsultasi pasien hari ini.</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <div class="stat-info">
            <div class="stat-title">Total Penyakit</div>
            <div class="stat-value">{{ $total_penyakit }}</div>
            <div class="stat-trend primary"><i class="bi bi-journal-medical"></i> Basis Pengetahuan</div>
        </div>
        <div class="stat-icon bg-teal"><i class="bi bi-virus2"></i></div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <div class="stat-title">Total Gejala</div>
            <div class="stat-value">{{ $total_gejala }}</div>
            <div class="stat-trend warning"><i class="bi bi-clipboard2-pulse"></i> Variabel Diagnosis</div>
        </div>
        <div class="stat-icon bg-orange"><i class="bi bi-thermometer-half"></i></div>
    </div>

    <div class="stat-card">
        <div class="stat-info">
            <div class="stat-title">Total Konsultasi</div>
            <div class="stat-value">{{ $total_riwayat }}</div>
            <div class="stat-trend success"><i class="bi bi-people"></i> Pengguna Sistem</div>
        </div>
        <div class="stat-icon bg-blue"><i class="bi bi-heart-pulse"></i></div>
    </div>
</div>

<div class="dashboard-grid">
    <!-- Chart Section -->
    <div class="card">
        <div class="card-title"><i class="bi bi-graph-up-arrow text-primary"></i> Grafik Konsultasi (14 Hari Terakhir)</div>
        <div class="chart-container">
            <canvas id="konsultasiChart"></canvas>
        </div>
    </div>

    <!-- Quick Links -->
    <div style="display: flex; flex-direction: column; gap: 20px;">
        <div class="card">
            <div class="card-title"><i class="bi bi-lightning-charge text-warning"></i> Akses Cepat</div>
            <div class="quick-links">
                <a href="{{ route('admin.penyakit.index') }}" class="quick-link">
                    <i class="bi bi-virus2" style="color: #0ea5b0;"></i> Kelola Data Penyakit
                </a>
                <a href="{{ route('admin.gejala.index') }}" class="quick-link">
                    <i class="bi bi-clipboard2-pulse" style="color: #f59e0b;"></i> Kelola Data Gejala
                </a>
                <a href="{{ route('admin.pengetahuan.index') }}" class="quick-link">
                    <i class="bi bi-diagram-3" style="color: #3b82f6;"></i> Atur Basis Aturan
                </a>
                <a href="{{ route('admin.riwayat.index') }}" class="quick-link primary">
                    <i class="bi bi-journal-text"></i> Laporan Konsultasi
                </a>
            </div>
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <div class="card">
        <div class="card-title" style="margin-bottom: 10px;">
            <div style="display:flex; justify-content:space-between; width:100%; align-items:center;">
                <span><i class="bi bi-clock-history text-secondary"></i> Riwayat Konsultasi Terbaru</span>
                <a href="{{ route('admin.riwayat.index') }}" class="btn-tambah" style="font-size:0.8rem; padding:5px 10px; background:var(--bg); color:var(--navy); border:1px solid var(--border);">Lihat Semua</a>
            </div>
        </div>
        
        @if($riwayatTerbaru->isEmpty())
            <div style="text-align:center; padding:40px 0; color:var(--muted);">
                <i class="bi bi-inbox" style="font-size:2.5rem; margin-bottom:12px; display:block; opacity:0.5;"></i>
                Belum ada data konsultasi.
            </div>
        @else
            <ul class="riwayat-list">
                @foreach($riwayatTerbaru as $r)
                <li class="riwayat-item">
                    <div>
                        <div class="kode">#{{ $r->kode_sesi }}</div>
                        <div class="waktu">{{ $r->created_at->diffForHumans() }} &mdash; {{ $r->created_at->format('d M Y') }}</div>
                    </div>
                    <div style="text-align:right;">
                        <div class="hasil" style="color:{{ $r->diagnosis_utama ? 'var(--navy)' : 'var(--muted)' }}">
                            {{ $r->diagnosis_utama ?: 'Tidak Ditemukan' }}
                        </div>
                        <div style="font-size:0.8rem; background: #e0f2fe; color: #0284c7; padding:3px 8px; border-radius:6px; display:inline-block; font-weight:700;">
                            {{ round($r->nilai_cf * 100) }}%
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="card">
        <div class="card-title"><i class="bi bi-pie-chart text-success"></i> Distribusi Diagnosis</div>
        <div class="chart-container" style="height: 280px; display:flex; justify-content:center; align-items:center;">
            @if(count($distribusi) == 0)
                <div style="text-align:center; color:var(--muted);">
                    <i class="bi bi-pie-chart" style="font-size:2.5rem; display:block; margin-bottom:10px; opacity:0.3;"></i>
                    Belum ada data distribusi.
                </div>
            @else
                <canvas id="distribusiChart"></canvas>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Data dari Controller
    const konsultasiData = @json($konsultasiHarian);
    const distribusiData = @json($distribusi);

    // Chart Konsultasi
    const ctxKonsultasi = document.getElementById('konsultasiChart');
    if (ctxKonsultasi) {
        new Chart(ctxKonsultasi, {
            type: 'line',
            data: {
                labels: konsultasiData.map(d => d.label),
                datasets: [{
                    label: 'Jumlah Konsultasi',
                    data: konsultasiData.map(d => d.jumlah),
                    borderColor: '#0ea5b0',
                    backgroundColor: 'rgba(14, 165, 176, 0.12)',
                    borderWidth: 3,
                    tension: 0.35,
                    fill: true,
                    pointBackgroundColor: '#ffffff',
                    pointBorderColor: '#0ea5b0',
                    pointBorderWidth: 2,
                    pointRadius: 4,
                    pointHoverRadius: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: '#1a3c6e',
                        padding: 12,
                        titleFont: { size: 13 },
                        bodyFont: { size: 14, weight: 'bold' },
                        displayColors: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 },
                        grid: { color: '#f0f4f9' }
                    },
                    x: {
                        grid: { display: false }
                    }
                }
            }
        });
    }

    // Chart Distribusi
    const ctxDistribusi = document.getElementById('distribusiChart');
    if (ctxDistribusi && distribusiData.length > 0) {
        const labels = distribusiData.map(d => d.diagnosis_utama);
        const data = distribusiData.map(d => d.jumlah);
        const bgColors = [
            '#0ea5b0', '#1a3c6e', '#f59e0b', '#3b82f6', '#10b981', '#8b5cf6', '#ef4444'
        ];

        new Chart(ctxDistribusi, {
            type: 'doughnut',
            data: {
                labels: labels,
                datasets: [{
                    data: data,
                    backgroundColor: bgColors.slice(0, labels.length),
                    borderWidth: 2,
                    borderColor: '#ffffff',
                    hoverOffset: 6
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            boxWidth: 12,
                            usePointStyle: true,
                            font: { family: "'Segoe UI', Arial, sans-serif" }
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1a3c6e',
                        padding: 12,
                        callbacks: {
                            label: function(context) {
                                let label = context.label || '';
                                if (label) { label += ': '; }
                                label += context.raw + ' pasien';
                                return label;
                            }
                        }
                    }
                }
            }
        });
    }
</script>
@endpush
