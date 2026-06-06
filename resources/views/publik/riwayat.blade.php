@extends('layouts.publik')

@section('title', 'Riwayat Konsultasi')
@section('description', 'Lihat riwayat hasil konsultasi sistem pakar kelenjar getah bening. Setiap sesi tersimpan dengan kode unik beserta detail gejala dan diagnosis.')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(to right, #1a3c6e, #2563a8);
        color: white;
        padding: 36px 0;
    }
    .page-header h1 { font-size: 1.55rem; font-weight: 800; margin-bottom: 6px; }
    .page-header p { font-size: 0.88rem; opacity: 0.82; margin: 0; }

    .notice-box {
        background: #fff8e1;
        border: 1px solid #ffe082;
        border-left: 4px solid #f9a825;
        border-radius: 6px;
        padding: 12px 16px;
        font-size: 0.84rem;
        color: #5d4037;
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 22px;
    }
    .notice-box i { color: #f9a825; margin-top: 2px; flex-shrink: 0; }

    .riwayat-table { width: 100%; border-collapse: collapse; font-size: 0.88rem; }
    .riwayat-table thead th {
        background: #1a3c6e;
        color: #fff;
        padding: 11px 14px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.4px;
        white-space: nowrap;
    }
    .riwayat-table thead th:first-child { border-radius: 6px 0 0 0; }
    .riwayat-table thead th:last-child { border-radius: 0 6px 0 0; }
    .riwayat-table tbody tr {
        border-bottom: 1px solid #eaecf0;
        transition: background 0.15s;
    }
    .riwayat-table tbody tr:hover { background: #f5f7ff; }
    .riwayat-table tbody td { padding: 12px 14px; color: #333; vertical-align: middle; }

    .kode-badge {
        font-family: 'Courier New', monospace;
        font-size: 0.8rem;
        background: #f0f4ff;
        color: #1a3c6e;
        padding: 3px 10px;
        border-radius: 4px;
        font-weight: 700;
        letter-spacing: 0.5px;
    }
    .diagnosis-name { font-weight: 700; color: #1a3c6e; }
    .cf-bar-wrap { display: flex; align-items: center; gap: 8px; }
    .cf-bar-bg {
        flex: 1;
        height: 6px;
        background: #e9ecef;
        border-radius: 10px;
        overflow: hidden;
        min-width: 70px;
    }
    .cf-bar-fill { height: 100%; border-radius: 10px; background: linear-gradient(to right, #2563a8, #0ea5b0); }
    .cf-text { font-size: 0.8rem; font-weight: 700; color: #1a3c6e; white-space: nowrap; }

    .btn-detail {
        background: #e8f1fb;
        color: #1a3c6e;
        border: none;
        border-radius: 5px;
        padding: 5px 12px;
        font-size: 0.8rem;
        font-weight: 600;
        cursor: pointer;
        display: inline-flex; align-items: center; gap: 5px;
        transition: background 0.2s;
    }
    .btn-detail:hover { background: #c9daf8; }

    /* Detail Panel */
    .detail-row { display: none; }
    .detail-row.open { display: table-row; }
    .detail-panel {
        background: #f9fafc;
        border-top: 2px solid #e8f1fb;
        padding: 20px 20px 16px;
    }
    .detail-panel h6 {
        font-size: 0.78rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #888;
        margin-bottom: 10px;
    }
    .gejala-chip {
        display: inline-flex; align-items: center; gap: 5px;
        background: #e8f1fb;
        color: #1a3c6e;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
        margin: 2px 3px;
    }
    .gejala-chip .cf-level {
        background: #2563a8;
        color: #fff;
        border-radius: 10px;
        padding: 1px 7px;
        font-size: 0.7rem;
    }
    .hasil-sub-item {
        background: #fff;
        border: 1px solid #dde3ea;
        border-radius: 6px;
        padding: 10px 14px;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
    }
    .hasil-sub-item:last-child { margin-bottom: 0; }
    .hasil-sub-nama { font-size: 0.87rem; font-weight: 700; color: #1a3c6e; }
    .hasil-sub-cf {
        font-size: 0.82rem;
        font-weight: 700;
        color: #0ea5b0;
        white-space: nowrap;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #aaa;
    }
    .empty-state i { font-size: 2.5rem; display: block; margin-bottom: 14px; color: #ccc; }
    .empty-state p { font-size: 0.9rem; margin-bottom: 18px; }

    @media (max-width: 768px) {
        .riwayat-table thead { display: none; }
        .riwayat-table tbody td { display: block; padding: 6px 14px; }
        .riwayat-table tbody td::before {
            content: attr(data-label);
            font-weight: 700;
            color: #888;
            font-size: 0.75rem;
            display: block;
            margin-bottom: 2px;
        }
        .riwayat-table tbody tr { display: block; border: 1px solid #dde3ea; border-radius: 8px; margin-bottom: 12px; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <span style="display:inline-block;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.25);border-radius:20px;font-size:0.78rem;padding:4px 14px;margin-bottom:14px;">
            <i class="bi bi-clock-history me-1"></i> Riwayat Sesi
        </span>
        <h1>Riwayat Konsultasi</h1>
        <p>Semua sesi konsultasi yang pernah dilakukan tercatat di sini beserta hasil diagnosisnya.</p>
    </div>
</div>

<div class="container py-4">

    <div class="notice-box">
        <i class="bi bi-info-circle-fill"></i>
        <div>Riwayat ini bersifat publik dan dapat dilihat siapa saja. Data disimpan berdasarkan sesi, bukan akun pengguna. Jangan masukkan nama atau identitas pribadi pada form konsultasi.</div>
    </div>

    @if($riwayats->count() > 0)

    <div style="background:#fff;border:1px solid #dde3ea;border-radius:8px;overflow:hidden;">
        <div style="padding:14px 20px;border-bottom:1px solid #eee;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:8px;">
            <span style="font-size:0.85rem;color:#666;">
                Menampilkan <strong>{{ $riwayats->firstItem() }}–{{ $riwayats->lastItem() }}</strong> dari <strong>{{ $riwayats->total() }}</strong> sesi konsultasi
            </span>
            <a href="{{ route('konsultasi') }}" style="font-size:0.83rem;color:#2563a8;text-decoration:none;font-weight:600;">
                <i class="bi bi-plus-circle me-1"></i>Konsultasi Baru
            </a>
        </div>

        <div style="overflow-x:auto;">
            <table class="riwayat-table">
                <thead>
                    <tr>
                        <th style="width:40px;">#</th>
                        <th>Sesi & Pasien</th>
                        <th>Diagnosis Utama</th>
                        <th>Nilai CF</th>
                        <th>Waktu</th>
                        <th style="text-align:center;">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($riwayats as $i => $r)
                    {{-- Baris utama --}}
                    <tr>
                        <td data-label="No">{{ $riwayats->firstItem() + $i }}</td>
                        <td data-label="Sesi & Pasien">
                            <span class="kode-badge" style="display:inline-block;margin-bottom:4px;">{{ $r->kode_sesi }}</span>
                            <div style="font-size: 0.8rem; color: #555; font-weight: 600;">
                                <i class="bi bi-person-circle"></i> {{ $r->nama_pasien ?? 'Anonim' }}
                                @if($r->umur || $r->jenis_kelamin)
                                    <span style="font-weight: normal; color: #888;">({{ $r->umur ?? '-' }} th, {{ $r->jenis_kelamin ? substr($r->jenis_kelamin, 0, 1) : '-' }})</span>
                                @endif
                            </div>
                        </td>
                        <td data-label="Diagnosis">
                            <span class="diagnosis-name">{{ $r->diagnosis_utama }}</span>
                        </td>
                        <td data-label="Nilai CF" style="min-width:140px;">
                            <div class="cf-bar-wrap">
                                <div class="cf-bar-bg">
                                    <div class="cf-bar-fill" style="width:{{ round($r->nilai_cf * 100) }}%;"></div>
                                </div>
                                <span class="cf-text">{{ round($r->nilai_cf * 100) }}%</span>
                            </div>
                        </td>
                        <td data-label="Waktu" style="color:#888;font-size:0.82rem;white-space:nowrap;">
                            {{ $r->created_at->format('d M Y') }}<br>
                            <span style="font-size:0.76rem;">{{ $r->created_at->format('H:i') }} WIB</span>
                        </td>
                        <td data-label="Detail" style="text-align:center;">
                            <button class="btn-detail" onclick="toggleDetail('detail-{{ $r->id }}', this)">
                                <i class="bi bi-chevron-down"></i> Lihat
                            </button>
                        </td>
                    </tr>

                    {{-- Baris detail (tersembunyi) --}}
                    <tr class="detail-row" id="detail-{{ $r->id }}">
                        <td colspan="6" style="padding:0;">
                            <div class="detail-panel">
                                <div class="row g-3">

                                    {{-- Gejala yang dilaporkan --}}
                                    <div class="col-lg-5">
                                        <h6><i class="bi bi-list-check me-1"></i>Gejala yang Dilaporkan</h6>
                                        @if(!empty($r->detail_gejala))
                                            <div>
                                                @foreach($r->detail_gejala as $g)
                                                <span class="gejala-chip">
                                                    {{ $g['nama'] }}
                                                    <span class="cf-level">{{ $g['label'] ?? '-' }}</span>
                                                </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span style="font-size:0.83rem;color:#aaa;">Tidak ada data gejala.</span>
                                        @endif
                                    </div>

                                    {{-- Seluruh hasil diagnosis --}}
                                    <div class="col-lg-7">
                                        <h6><i class="bi bi-bar-chart me-1"></i>Hasil Seluruh Diagnosis</h6>
                                        @if(!empty($r->detail_hasil))
                                            @foreach($r->detail_hasil as $h)
                                            <div class="hasil-sub-item">
                                                <div>
                                                    <div class="hasil-sub-nama">{{ $h['penyakit'] }}</div>
                                                    @if(!empty($h['deskripsi']))
                                                    <div style="font-size:0.78rem;color:#888;margin-top:3px;line-height:1.5;">
                                                        {{ Str::limit($h['deskripsi'], 100) }}
                                                    </div>
                                                    @endif
                                                </div>
                                                <span class="hasil-sub-cf">{{ round($h['cf'] * 100) }}%</span>
                                            </div>
                                            @endforeach
                                        @else
                                            <span style="font-size:0.83rem;color:#aaa;">Tidak ada detail.</span>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($riwayats->hasPages())
        <div style="padding:14px 20px;border-top:1px solid #eee;display:flex;justify-content:flex-end;">
            {{ $riwayats->links() }}
        </div>
        @endif
    </div>

    @else

    <div style="background:#fff;border:1px solid #dde3ea;border-radius:8px;">
        <div class="empty-state">
            <i class="bi bi-clipboard-x"></i>
            <p>Belum ada riwayat konsultasi yang tersimpan.</p>
            <a href="{{ route('konsultasi') }}" style="background:#1a3c6e;color:#fff;padding:10px 22px;border-radius:6px;text-decoration:none;font-size:0.88rem;font-weight:600;display:inline-flex;align-items:center;gap:8px;">
                <i class="bi bi-play-circle"></i> Mulai Konsultasi Pertama
            </a>
        </div>
    </div>

    @endif

</div>

@endsection

@push('scripts')
<script>
function toggleDetail(id, btn) {
    const row = document.getElementById(id);
    const isOpen = row.classList.contains('open');
    row.classList.toggle('open');
    btn.innerHTML = isOpen
        ? '<i class="bi bi-chevron-down"></i> Lihat'
        : '<i class="bi bi-chevron-up"></i> Tutup';
    btn.style.background = isOpen ? '' : '#c9daf8';
}
</script>
@endpush
