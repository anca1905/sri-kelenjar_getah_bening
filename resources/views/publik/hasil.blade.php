@extends('layouts.publik')

@section('title', 'Hasil Diagnosis — Sistem Pakar KGB')
@section('description', 'Hasil analisis sistem pakar kelenjar getah bening berdasarkan gejala yang Anda masukkan.')

@push('styles')
<style>
    /* ===== LAYOUT ===== */
    .hasil-page { background: #f0f4f9; min-height: 100vh; padding: 32px 0 60px; }

    /* ===== HEADER HASIL ===== */
    .hasil-header {
        background: linear-gradient(135deg, #1a3c6e 0%, #2563a8 60%, #0ea5b0 100%);
        color: white;
        border-radius: 16px;
        padding: 32px 36px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
    }
    .hasil-header::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 180px; height: 180px;
        background: rgba(255,255,255,0.06);
        border-radius: 50%;
    }
    .hasil-header::after {
        content: '';
        position: absolute;
        bottom: -60px; right: 80px;
        width: 240px; height: 240px;
        background: rgba(255,255,255,0.04);
        border-radius: 50%;
    }
    .hasil-header-top { display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 16px; position: relative; z-index: 1; }
    .hasil-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.25); border-radius: 20px; font-size: 0.78rem; padding: 4px 14px; margin-bottom: 14px; }
    .hasil-kode { font-family: 'Courier New', monospace; font-size: 0.85rem; background: rgba(0,0,0,0.2); padding: 6px 14px; border-radius: 8px; letter-spacing: 1px; font-weight: 700; }
    .hasil-header h1 { font-size: 1.7rem; font-weight: 800; margin-bottom: 6px; line-height: 1.2; }
    .hasil-header p { font-size: 0.88rem; opacity: 0.8; margin: 0; }
    .btn-print {
        display: inline-flex; align-items: center; gap: 8px;
        background: white; color: #1a3c6e;
        border: none; border-radius: 10px;
        padding: 10px 20px; font-size: 0.9rem; font-weight: 700;
        cursor: pointer; transition: all 0.2s; white-space: nowrap;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .btn-print:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(0,0,0,0.2); }

    /* ===== BIODATA CARD ===== */
    .biodata-card {
        background: white; border-radius: 12px; padding: 20px 24px;
        margin-bottom: 20px; border: 1px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.04);
        display: flex; align-items: center; gap: 20px; flex-wrap: wrap;
    }
    .biodata-avatar {
        width: 56px; height: 56px; background: linear-gradient(135deg, #1a3c6e, #2563a8);
        border-radius: 50%; display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem; color: white; flex-shrink: 0;
    }
    .biodata-name { font-size: 1.1rem; font-weight: 800; color: #1a3c6e; margin-bottom: 4px; }
    .biodata-meta { font-size: 0.85rem; color: #64748b; display: flex; gap: 16px; flex-wrap: wrap; }
    .biodata-meta span { display: flex; align-items: center; gap: 5px; }
    .biodata-tanggal { margin-left: auto; text-align: right; font-size: 0.82rem; color: #94a3b8; }
    .biodata-tanggal strong { display: block; color: #475569; font-size: 0.88rem; }

    /* ===== UTAMA (Diagnosis #1) ===== */
    .diagnosis-utama {
        background: white; border-radius: 16px; padding: 28px 32px;
        margin-bottom: 20px; border: 1px solid #e2e8f0;
        box-shadow: 0 4px 16px rgba(0,0,0,0.05);
        position: relative; overflow: hidden;
    }
    .diagnosis-utama::before {
        content: '';
        position: absolute; top: 0; left: 0; bottom: 0;
        width: 5px;
        background: linear-gradient(to bottom, #1a3c6e, #0ea5b0);
        border-radius: 16px 0 0 16px;
    }
    .utama-label { font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #0ea5b0; margin-bottom: 8px; }
    .utama-nama { font-size: 1.55rem; font-weight: 800; color: #1a3c6e; margin-bottom: 16px; }
    .cf-meter-wrap { margin-bottom: 20px; }
    .cf-meter-label { display: flex; justify-content: space-between; margin-bottom: 8px; }
    .cf-meter-label span:first-child { font-size: 0.85rem; color: #64748b; font-weight: 600; }
    .cf-meter-persen { font-size: 1.6rem; font-weight: 800; color: #1a3c6e; }
    .cf-meter-bg { height: 12px; background: #e2e8f0; border-radius: 10px; overflow: hidden; }
    .cf-meter-fill { height: 100%; background: linear-gradient(to right, #2563a8, #0ea5b0); border-radius: 10px; transition: width 1.2s cubic-bezier(0.34, 1.56, 0.64, 1); }
    .interpretasi { display: inline-flex; align-items: center; gap: 6px; padding: 5px 14px; border-radius: 20px; font-size: 0.82rem; font-weight: 700; margin-top: 12px; }
    .interpretasi.tinggi { background: #dcfce7; color: #166534; }
    .interpretasi.sedang { background: #fef9c3; color: #854d0e; }
    .interpretasi.rendah { background: #f1f5f9; color: #475569; }

    /* ===== DESKRIPSI & SOLUSI ===== */
    .info-section { margin-top: 24px; }
    .info-section h4 { font-size: 0.85rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #94a3b8; margin-bottom: 12px; display: flex; align-items: center; gap: 8px; }
    .info-section h4::after { content: ''; flex: 1; height: 1px; background: #e2e8f0; }
    .info-section p { font-size: 0.92rem; color: #475569; line-height: 1.75; }
    .solusi-list { list-style: none; padding: 0; margin: 0; }
    .solusi-list li { display: flex; gap: 12px; align-items: flex-start; font-size: 0.92rem; color: #475569; line-height: 1.65; padding: 6px 0; border-bottom: 1px dashed #f1f5f9; }
    .solusi-list li:last-child { border-bottom: none; }
    .solusi-list li::before { content: '✓'; color: #0ea5b0; font-weight: 700; flex-shrink: 0; margin-top: 2px; }

    /* ===== DIAGNOSIS LAIN ===== */
    .lain-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 16px 20px; margin-bottom: 12px; display: flex; align-items: center; gap: 16px; box-shadow: 0 2px 6px rgba(0,0,0,0.03); }
    .lain-rank { width: 32px; height: 32px; background: #f1f5f9; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.82rem; font-weight: 700; color: #64748b; flex-shrink: 0; }
    .lain-nama { font-weight: 700; color: #334155; font-size: 0.95rem; margin-bottom: 3px; }
    .lain-cf-wrap { display: flex; align-items: center; gap: 10px; }
    .lain-bar-bg { flex: 1; height: 6px; background: #e2e8f0; border-radius: 10px; min-width: 80px; overflow: hidden; }
    .lain-bar-fill { height: 100%; background: linear-gradient(to right, #94a3b8, #64748b); border-radius: 10px; }
    .lain-persen { font-size: 0.82rem; font-weight: 700; color: #64748b; white-space: nowrap; }

    /* ===== GEJALA YANG DILAPORKAN ===== */
    .gejala-chip { display: inline-flex; align-items: center; gap: 5px; background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; padding: 4px 12px; border-radius: 20px; font-size: 0.8rem; font-weight: 600; margin: 3px 4px 3px 0; }
    .gejala-chip .level-badge { background: #1e40af; color: white; border-radius: 10px; padding: 1px 7px; font-size: 0.7rem; }

    /* ===== SIDEBAR ACTIONS ===== */
    .sidebar-card { background: white; border-radius: 12px; border: 1px solid #e2e8f0; padding: 20px; margin-bottom: 16px; box-shadow: 0 2px 8px rgba(0,0,0,0.03); }
    .sidebar-card h5 { font-size: 0.85rem; font-weight: 700; color: #1a3c6e; margin-bottom: 12px; }
    .action-btn { display: flex; align-items: center; gap: 10px; width: 100%; background: none; border: 1px solid #e2e8f0; border-radius: 10px; padding: 10px 14px; font-size: 0.88rem; font-weight: 600; color: #334155; cursor: pointer; transition: all 0.2s; margin-bottom: 8px; text-decoration: none; }
    .action-btn:hover { background: #f8fafc; border-color: #94a3b8; color: #1a3c6e; }
    .action-btn i { font-size: 1.1rem; width: 22px; text-align: center; }
    .action-btn.primary { background: #1a3c6e; color: white; border-color: #1a3c6e; }
    .action-btn.primary:hover { background: #0f2647; color: white; }
    .disclaimer { background: #fff8e1; border: 1px solid #ffe082; border-radius: 10px; padding: 14px 16px; font-size: 0.82rem; color: #5d4037; line-height: 1.65; }
    .disclaimer i { color: #f9a825; }

    /* ===== PRINT STYLES ===== */
    @media print {
        body * { visibility: hidden; }
        #printArea, #printArea * { visibility: visible; }
        #printArea { position: fixed; top: 0; left: 0; width: 100%; background: white; padding: 20px; }
        .no-print, nav, footer { display: none !important; }
        .print-header { display: block !important; }
        .btn-print, .action-btn, .sidebar-card { display: none !important; }
        .diagnosis-utama::before { display: none; }
        .lain-card { box-shadow: none; border: 1px solid #ddd; }
        .hasil-header { background: #1a3c6e !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        @page { size: A4; margin: 15mm; }
    }
    .print-header { display: none; }

    @media (max-width: 768px) {
        .hasil-header { padding: 24px 20px; }
        .hasil-header h1 { font-size: 1.3rem; }
        .biodata-tanggal { display: none; }
        .utama-nama { font-size: 1.25rem; }
    }
    
    /* MODAL EDIT BIODATA */
    .modal-overlay { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); z-index: 9999; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s; }
    .modal-content { background: white; border-radius: 12px; width: 100%; max-width: 450px; padding: 24px; transform: translateY(20px); transition: transform 0.3s; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    .modal-title { font-size: 1.2rem; font-weight: 800; color: #1a3c6e; margin-bottom: 16px; border-bottom: 1px solid #e2e8f0; padding-bottom: 10px; }
    .btn-edit { background: none; border: 1px solid #cbd5e1; border-radius: 6px; padding: 4px 10px; font-size: 0.8rem; color: #475569; cursor: pointer; transition: 0.2s; position: absolute; right: 24px; top: 24px; display: inline-flex; align-items: center; gap: 5px; }
    .btn-edit:hover { background: #f1f5f9; color: #1a3c6e; border-color: #94a3b8; }
</style>
@endpush

@section('content')
@php
    $biodata = session('biodata', []);
    $utama = $hasil[0];
    $persen = $utama['cf_persen'];
    $interpretasi = $persen >= 70 ? 'tinggi' : ($persen >= 40 ? 'sedang' : 'rendah');
    $interpretasiLabel = $persen >= 70 ? 'Tingkat Kepastian Tinggi' : ($persen >= 40 ? 'Tingkat Kepastian Sedang' : 'Tingkat Kepastian Rendah');
@endphp

<div class="hasil-page">
<div class="container" id="printArea">

    {{-- ===== HEADER ===== --}}
    <div class="hasil-header">
        <div class="hasil-header-top">
            <div>
                <div class="hasil-badge"><i class="bi bi-check-circle-fill"></i> Analisis Selesai</div>
                <h1>Hasil Diagnosis Sistem Pakar</h1>
                <p>Kelenjar Getah Bening (KGB) &mdash; Certainty Factor Method</p>
            </div>
            <div style="display: flex; flex-direction: column; align-items: flex-end; gap: 8px;">
                <span class="hasil-kode">{{ $kodeSesi }}</span>
                <button class="btn-print no-print" onclick="cetakHasil()">
                    <i class="bi bi-printer-fill"></i> Cetak Hasil
                </button>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">

            {{-- ===== BIODATA ===== --}}
            @if(!empty($biodata))
            <div class="biodata-card" style="position: relative;">
                <button class="btn-edit no-print" onclick="bukaModalEdit()"><i class="bi bi-pencil-square"></i> Edit</button>
                <div class="biodata-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div>
                    <div class="biodata-name" id="bio-name-display">{{ $biodata['nama_pasien'] ?? 'Pasien' }}</div>
                    <div class="biodata-meta">
                        @if(isset($biodata['umur']))
                            <span><i class="bi bi-calendar3"></i> <span id="bio-age-display">{{ $biodata['umur'] }} Tahun</span></span>
                        @endif
                        @if(isset($biodata['jenis_kelamin']))
                            <span>
                                <i class="bi bi-gender-{{ $biodata['jenis_kelamin'] == 'Laki-laki' ? 'male' : 'female' }}" id="bio-gender-icon"></i> 
                                <span id="bio-gender-display">{{ $biodata['jenis_kelamin'] }}</span>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="biodata-tanggal">
                    <strong>{{ now()->format('d M Y') }}</strong>
                    Pukul {{ now()->format('H:i') }} WIB
                </div>
            </div>
            @endif

            {{-- ===== DIAGNOSIS UTAMA ===== --}}
            <div class="diagnosis-utama">
                <div class="utama-label"><i class="bi bi-star-fill me-1"></i> Diagnosis Utama</div>
                <div class="utama-nama">{{ $utama['penyakit']->nama }}</div>

                <div class="cf-meter-wrap">
                    <div class="cf-meter-label">
                        <span>Tingkat Keyakinan (Certainty Factor)</span>
                        <span class="cf-meter-persen">{{ $persen }}%</span>
                    </div>
                    <div class="cf-meter-bg">
                        <div class="cf-meter-fill" id="cfBar" style="width: 0%;" data-target="{{ $persen }}"></div>
                    </div>
                    <span class="interpretasi {{ $interpretasi }}">
                        @if($interpretasi == 'tinggi') <i class="bi bi-shield-check"></i>
                        @elseif($interpretasi == 'sedang') <i class="bi bi-shield-exclamation"></i>
                        @else <i class="bi bi-shield"></i>
                        @endif
                        {{ $interpretasiLabel }}
                    </span>
                </div>

                @if($utama['penyakit']->deskripsi)
                <div class="info-section">
                    <h4><i class="bi bi-info-circle me-1" style="color:#0ea5b0;"></i> Tentang Penyakit Ini</h4>
                    <p>{{ $utama['penyakit']->deskripsi }}</p>
                </div>
                @endif

                @if($utama['penyakit']->solusi)
                <div class="info-section">
                    <h4><i class="bi bi-lightbulb me-1" style="color:#f59e0b;"></i> Anjuran & Penanganan</h4>
                    <ul class="solusi-list">
                        @foreach(explode("\n", $utama['penyakit']->solusi) as $s)
                            @if(trim($s))
                                <li>{{ trim($s) }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>

            {{-- ===== DIAGNOSIS LAIN ===== --}}
            @if(count($hasil) > 1)
            <div style="margin-bottom: 20px;">
                <h3 style="font-size: 0.95rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 14px;">
                    <i class="bi bi-list-ul me-2"></i> Kemungkinan Diagnosis Lain
                </h3>
                @foreach($hasil as $i => $h)
                    @if($i == 0) @continue @endif
                    <div class="lain-card">
                        <div class="lain-rank">{{ $i + 1 }}</div>
                        <div style="flex: 1;">
                            <div class="lain-nama">{{ $h['penyakit']->nama }}</div>
                            <div class="lain-cf-wrap">
                                <div class="lain-bar-bg">
                                    <div class="lain-bar-fill" style="width: {{ $h['cf_persen'] }}%;"></div>
                                </div>
                                <span class="lain-persen">{{ $h['cf_persen'] }}%</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @endif

            {{-- ===== GEJALA YANG DILAPORKAN ===== --}}
            @if(!empty($detailGejala))
            <div class="biodata-card" style="flex-direction: column; align-items: flex-start;">
                <h3 style="font-size: 0.9rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 12px; width: 100%;">
                    <i class="bi bi-list-check me-2" style="color:#0ea5b0;"></i> Gejala yang Dilaporkan
                </h3>
                <div>
                    @foreach($detailGejala as $g)
                        <span class="gejala-chip">
                            {{ $g['nama'] }}
                            <span class="level-badge">{{ $g['label'] }}</span>
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- ===== SIDEBAR ===== --}}
        <div class="col-lg-4">

            <div class="sidebar-card no-print">
                <h5><i class="bi bi-lightning me-2" style="color:#0ea5b0;"></i>Tindakan Selanjutnya</h5>
                <button onclick="cetakHasil()" class="action-btn primary">
                    <i class="bi bi-printer-fill"></i> Cetak Hasil Diagnosis
                </button>
                <a href="{{ route('konsultasi.biodata') }}" class="action-btn" style="display: flex;">
                    <i class="bi bi-arrow-repeat"></i> Konsultasi Ulang
                </a>
                <a href="{{ route('riwayat') }}" class="action-btn" style="display: flex;">
                    <i class="bi bi-clock-history"></i> Lihat Riwayat
                </a>
                <a href="{{ route('beranda') }}" class="action-btn" style="display: flex;">
                    <i class="bi bi-house"></i> Kembali ke Beranda
                </a>
            </div>

            <div class="sidebar-card">
                <h5><i class="bi bi-card-text me-2"></i>Info Sesi</h5>
                <div style="font-size: 0.85rem; color: #64748b; line-height: 2;">
                    <div><strong>Kode Sesi:</strong><br>
                        <span style="font-family: monospace; font-size: 0.95rem; color: #1a3c6e; font-weight: 700;">{{ $kodeSesi }}</span>
                    </div>
                    <div style="margin-top: 8px;"><strong>Tanggal:</strong><br>{{ now()->format('d F Y, H:i') }} WIB</div>
                    <div style="margin-top: 8px;"><strong>Metode:</strong><br>Forward Chaining + Certainty Factor</div>
                </div>
            </div>

            <div class="disclaimer no-print">
                <p style="margin: 0; font-size: 0.82rem; line-height: 1.65;">
                    <i class="bi bi-exclamation-triangle-fill me-1"></i>
                    <strong>Perhatian:</strong> Hasil ini merupakan analisis awal berbasis sistem pakar dan <strong>bukan pengganti diagnosa dokter</strong>. Segera konsultasikan dengan tenaga medis profesional untuk penanganan lebih lanjut.
                </p>
            </div>

        </div>
    </div>

</div>
</div>

{{-- ===== PRINT TEMPLATE ===== --}}
<div id="printTemplate" style="display: none;">
    <div style="font-family: Arial, sans-serif; max-width: 210mm; margin: 0 auto; padding: 20px; color: #1a1a1a;">
        {{-- Header Cetak Resmi --}}
        <div style="border-bottom: 3px solid #1a1a1a; padding-bottom: 12px; margin-bottom: 2px; text-align: center; position: relative;">
            <div style="font-size: 26px; font-weight: 900; text-transform: uppercase; color: #1a1a1a;">WEBSITE SISTEM PAKAR</div>
            <div style="font-size: 15px; font-weight: 700; color: #333; margin-top: 4px;">DETEKSI DINI PENYAKIT PADA KELENJAR GETAH BENING</div>
            <div style="font-size: 12px; color: #444; margin-top: 5px;">Jl. Kesehatan No. 123, Kota Sehat, Provinsi Maju 12345</div>
            <div style="font-size: 12px; color: #444;">Telp: (021) 123-4567 | Email: info@klinikkesehatan.com | Web: www.klinikkesehatan.com</div>
        </div>
        <div style="border-bottom: 1px solid #1a1a1a; margin-bottom: 24px;"></div>

        <div style="text-align: center; margin-bottom: 24px;">
            <div style="font-size: 18px; font-weight: bold; text-decoration: underline; text-transform: uppercase;">Hasil Analisis Awal Gejala</div>
            <div style="font-size: 12px; margin-top: 4px;">Nomor Rekam / Sesi: <strong>{{ $kodeSesi }}</strong></div>
        </div>

        {{-- Biodata --}}
        @if(!empty($biodata))
        <div style="margin-bottom: 24px;">
            <table style="width: 100%; border-collapse: collapse; font-size: 13px;">
                <tr>
                    <td style="width: 15%; padding: 4px 0; font-weight: bold;">Nama Pasien</td>
                    <td style="width: 2%; padding: 4px 0;">:</td>
                    <td style="width: 33%; padding: 4px 0;" id="print-bio-name">{{ $biodata['nama_pasien'] ?? '-' }}</td>
                    
                    <td style="width: 15%; padding: 4px 0; font-weight: bold;">Tanggal Periksa</td>
                    <td style="width: 2%; padding: 4px 0;">:</td>
                    <td style="width: 33%; padding: 4px 0;">{{ now()->format('d F Y') }}</td>
                </tr>
                <tr>
                    <td style="padding: 4px 0; font-weight: bold;">Umur</td>
                    <td style="padding: 4px 0;">:</td>
                    <td style="padding: 4px 0;" id="print-bio-age">{{ isset($biodata['umur']) ? $biodata['umur'] . ' Tahun' : '-' }}</td>
                    
                    <td style="padding: 4px 0; font-weight: bold;">Jenis Kelamin</td>
                    <td style="padding: 4px 0;">:</td>
                    <td style="padding: 4px 0;" id="print-bio-gender">{{ $biodata['jenis_kelamin'] ?? '-' }}</td>
                </tr>
            </table>
        </div>
        @endif

        {{-- Diagnosis Utama --}}
        <div style="border: 2px solid #1a3c6e; border-radius: 10px; padding: 20px 24px; margin-bottom: 16px;">
            <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.8px; color: #0ea5b0; margin-bottom: 6px;">★ Diagnosis Utama</div>
            <div style="font-size: 22px; font-weight: 800; color: #1a3c6e; margin-bottom: 12px;">{{ $utama['penyakit']->nama }}</div>
            <div style="display: flex; align-items: center; gap: 16px; margin-bottom: 16px;">
                <div style="flex: 1; height: 10px; background: #e2e8f0; border-radius: 10px; overflow: hidden;">
                    <div style="width: {{ $persen }}%; height: 100%; background: linear-gradient(to right, #1a3c6e, #0ea5b0); border-radius: 10px;"></div>
                </div>
                <div style="font-size: 24px; font-weight: 800; color: #1a3c6e;">{{ $persen }}%</div>
            </div>

            @if($utama['penyakit']->deskripsi)
            <div style="margin-bottom: 14px;">
                <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px; margin-bottom: 8px;">Deskripsi</div>
                <p style="font-size: 12px; color: #475569; line-height: 1.7; margin: 0;">{{ $utama['penyakit']->deskripsi }}</p>
            </div>
            @endif

            @if($utama['penyakit']->solusi)
            <div>
                <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; border-bottom: 1px solid #e2e8f0; padding-bottom: 6px; margin-bottom: 8px;">Anjuran & Penanganan</div>
                @foreach(explode("\n", $utama['penyakit']->solusi) as $s)
                    @if(trim($s))
                    <div style="font-size: 12px; color: #475569; padding: 3px 0; display: flex; gap: 8px;">
                        <span style="color: #0ea5b0; font-weight: 700;">✓</span>
                        <span>{{ trim($s) }}</span>
                    </div>
                    @endif
                @endforeach
            </div>
            @endif
        </div>

        {{-- Diagnosis Lain --}}
        @if(count($hasil) > 1)
        <div style="margin-bottom: 16px;">
            <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 8px;">Kemungkinan Diagnosis Lain</div>
            <table style="width: 100%; border-collapse: collapse; font-size: 12px;">
                @foreach($hasil as $i => $h)
                    @if($i == 0) @continue @endif
                    <tr style="border-bottom: 1px solid #f1f5f9;">
                        <td style="padding: 6px 8px; width: 30px; color: #94a3b8; font-weight: 700;">{{ $i + 1 }}</td>
                        <td style="padding: 6px 8px; font-weight: 600; color: #334155;">{{ $h['penyakit']->nama }}</td>
                        <td style="padding: 6px 8px; width: 120px;">
                            <div style="height: 6px; background: #e2e8f0; border-radius: 10px; overflow: hidden;">
                                <div style="width: {{ $h['cf_persen'] }}%; height: 100%; background: #94a3b8; border-radius: 10px;"></div>
                            </div>
                        </td>
                        <td style="padding: 6px 8px; text-align: right; font-weight: 700; color: #64748b; white-space: nowrap; width: 40px;">{{ $h['cf_persen'] }}%</td>
                    </tr>
                @endforeach
            </table>
        </div>
        @endif

        {{-- Gejala --}}
        @if(!empty($detailGejala))
        <div style="margin-bottom: 16px;">
            <div style="font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #64748b; margin-bottom: 8px;">Gejala yang Dilaporkan ({{ count($detailGejala) }} Gejala)</div>
            <div>
                @foreach($detailGejala as $g)
                    <span style="display: inline-block; background: #eff6ff; color: #1e40af; border: 1px solid #bfdbfe; padding: 3px 10px; border-radius: 20px; font-size: 10px; font-weight: 600; margin: 2px 3px 2px 0;">{{ $g['nama'] }}</span>
                @endforeach
            </div>
        </div>
        @endif

        {{-- Footer --}}
        <div style="border-top: 1px solid #e2e8f0; padding-top: 12px; font-size: 10px; color: #94a3b8; text-align: center; line-height: 1.6;">
            <strong>⚠ Perhatian:</strong> Hasil ini merupakan analisis awal dari sistem pakar dan <strong>bukan pengganti diagnosa dokter</strong>. Segera konsultasikan dengan tenaga medis profesional.<br>
            Dicetak oleh Sistem Pakar KGB &bull; {{ now()->format('d F Y, H:i') }} WIB
        </div>
    </div>
</div>

{{-- MODAL EDIT BIODATA --}}
<div id="modalEdit" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-title">Edit Biodata Pasien</div>
        <form id="formEditBiodata" onsubmit="simpanEditBiodata(event)">
            @csrf
            <div style="margin-bottom: 16px;">
                <label style="display:block; margin-bottom:6px; font-weight:600; font-size:0.9rem;">Nama Lengkap</label>
                <input type="text" name="nama_pasien" id="edit_nama_pasien" value="{{ $biodata['nama_pasien'] ?? '' }}" required style="width:100%; padding:8px 12px; border:1px solid #cbd5e1; border-radius:6px; font-size:0.9rem;">
            </div>
            <div style="margin-bottom: 16px;">
                <label style="display:block; margin-bottom:6px; font-weight:600; font-size:0.9rem;">Umur (Tahun)</label>
                <input type="number" name="umur" id="edit_umur" value="{{ $biodata['umur'] ?? '' }}" required min="1" style="width:100%; padding:8px 12px; border:1px solid #cbd5e1; border-radius:6px; font-size:0.9rem;">
            </div>
            <div style="margin-bottom: 20px;">
                <label style="display:block; margin-bottom:6px; font-weight:600; font-size:0.9rem;">Jenis Kelamin</label>
                <select name="jenis_kelamin" id="edit_jenis_kelamin" required style="width:100%; padding:8px 12px; border:1px solid #cbd5e1; border-radius:6px; font-size:0.9rem; background:#fff;">
                    <option value="Laki-laki" {{ ($biodata['jenis_kelamin'] ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ ($biodata['jenis_kelamin'] ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
            </div>
            <div style="display: flex; justify-content: flex-end; gap: 10px;">
                <button type="button" onclick="tutupModalEdit()" style="background:#f1f5f9; color:#475569; border:none; padding:8px 16px; border-radius:6px; font-weight:600; cursor:pointer;">Batal</button>
                <button type="submit" id="btnSimpanBiodata" style="background:#1a3c6e; color:white; border:none; padding:8px 16px; border-radius:6px; font-weight:600; cursor:pointer;">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    // Modal Edit Biodata
    function bukaModalEdit() {
        const modal = document.getElementById('modalEdit');
        modal.style.display = 'flex';
        setTimeout(() => {
            modal.style.opacity = '1';
            modal.querySelector('.modal-content').style.transform = 'translateY(0)';
        }, 10);
    }

    function tutupModalEdit() {
        const modal = document.getElementById('modalEdit');
        modal.style.opacity = '0';
        modal.querySelector('.modal-content').style.transform = 'translateY(20px)';
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }

    function simpanEditBiodata(e) {
        e.preventDefault();
        const form = e.target;
        const btn = document.getElementById('btnSimpanBiodata');
        const formData = new FormData(form);
        
        btn.disabled = true;
        btn.innerText = 'Menyimpan...';

        fetch('{{ route("konsultasi.biodata.update", $kodeSesi) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': formData.get('_token'),
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(res => res.json())
        .then(data => {
            if(data.success) {
                // Update tampilan biodata di card
                document.getElementById('bio-name-display').innerText = data.data.nama_pasien;
                document.getElementById('bio-age-display').innerText = data.data.umur + ' Tahun';
                document.getElementById('bio-gender-display').innerText = data.data.jenis_kelamin;
                
                const iconClass = data.data.jenis_kelamin === 'Laki-laki' ? 'bi-gender-male' : 'bi-gender-female';
                document.getElementById('bio-gender-icon').className = 'bi ' + iconClass;
                
                // Update tampilan biodata di print template
                document.getElementById('print-bio-name').innerText = data.data.nama_pasien;
                document.getElementById('print-bio-age').innerText = data.data.umur + ' Tahun';
                document.getElementById('print-bio-gender').innerText = data.data.jenis_kelamin;
                
                tutupModalEdit();
                
                // Animasi flash background singkat
                const card = document.querySelector('.biodata-card');
                card.style.transition = 'background 0.3s';
                card.style.background = '#dcfce7';
                setTimeout(() => card.style.background = 'white', 500);
            } else {
                alert('Gagal menyimpan biodata');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan jaringan.');
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerText = 'Simpan Perubahan';
        });
    }

    // Animasi progress bar
    window.addEventListener('load', function() {
        const bar = document.getElementById('cfBar');
        if (bar) {
            setTimeout(() => {
                bar.style.width = bar.dataset.target + '%';
            }, 300);
        }
    });

    function cetakHasil() {
        const printContent = document.getElementById('printTemplate').innerHTML;
        const printWindow = window.open('', '_blank', 'width=900,height=700');
        
        printWindow.document.write(`
            <!DOCTYPE html>
            <html lang="id">
            <head>
                <meta charset="UTF-8">
                <title>Cetak Hasil Diagnosis</title>
                <style>
                    * { box-sizing: border-box; margin: 0; padding: 0; }
                    body { font-family: "Times New Roman", Times, serif; background: white; color: #1a1a1a; }
                    @page { size: A4; margin: 15mm; }
                    @media print { body { padding: 0; } }
                </style>
            </head>
            <body>
                <div style="max-width: 210mm; margin: 0 auto; padding: 10mm;">
                    ${printContent}
                </div>
                <script>
                    window.onload = function() {
                        setTimeout(function() {
                            window.print();
                        }, 500);
                    };
                <\/script>
            </body>
            </html>
        `);
        printWindow.document.close();
    }
</script>
@endpush
@endsection
