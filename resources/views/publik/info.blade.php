@extends('layouts.publik')

@section('title', 'Informasi Penyakit Kelenjar Getah Bening')
@section('description', 'Pelajari berbagai jenis penyakit kelenjar getah bening, gejala umum, dan penanganan awal yang bisa dilakukan sebelum berkonsultasi dengan dokter.')

@push('styles')
<style>
    .page-header {
        background: linear-gradient(to right, #1a3c6e, #2563a8);
        color: white;
        padding: 36px 0;
    }
    .page-header h1 { font-size: 1.55rem; font-weight: 800; margin-bottom: 6px; }
    .page-header p { font-size: 0.88rem; opacity: 0.82; margin: 0; }

    /* Search bar */
    .search-wrap {
        position: relative;
        max-width: 420px;
    }
    .search-wrap i {
        position: absolute;
        left: 12px; top: 50%;
        transform: translateY(-50%);
        color: #aaa;
        font-size: 0.9rem;
    }
    #searchInput {
        width: 100%;
        padding: 9px 14px 9px 36px;
        border: 1px solid #dde3ea;
        border-radius: 6px;
        font-size: 0.88rem;
        outline: none;
        transition: border-color 0.2s;
    }
    #searchInput:focus { border-color: #2563a8; box-shadow: 0 0 0 3px rgba(37,99,168,0.1); }

    /* Penyakit cards */
    .penyakit-card {
        background: #fff;
        border: 1px solid #dde3ea;
        border-radius: 10px;
        overflow: hidden;
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: box-shadow 0.2s, border-color 0.2s, transform 0.15s;
    }
    .penyakit-card:hover {
        box-shadow: 0 6px 20px rgba(26,60,110,0.1);
        border-color: #2563a8;
        transform: translateY(-2px);
    }
    .card-head {
        background: linear-gradient(to right, #1a3c6e, #2563a8);
        padding: 20px 20px 16px;
        color: #fff;
    }
    .card-icon {
        width: 42px; height: 42px;
        background: rgba(255,255,255,0.15);
        border-radius: 10px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.15rem;
        margin-bottom: 12px;
    }
    .card-head h5 {
        font-size: 1rem;
        font-weight: 800;
        margin: 0;
        line-height: 1.3;
    }
    .card-body-custom {
        padding: 16px 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    .section-label {
        font-size: 0.72rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.6px;
        color: #aaa;
        margin-bottom: 6px;
    }
    .desc-text {
        font-size: 0.85rem;
        color: #555;
        line-height: 1.65;
        margin-bottom: 16px;
    }
    .solusi-box {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        border-radius: 7px;
        padding: 12px 14px;
        margin-top: auto;
    }
    .solusi-box .section-label { color: #16a34a; margin-bottom: 6px; }
    .solusi-box p {
        font-size: 0.83rem;
        color: #374151;
        line-height: 1.65;
        margin: 0;
    }
    .toggle-solusi {
        background: none;
        border: none;
        color: #2563a8;
        font-size: 0.82rem;
        font-weight: 600;
        padding: 0;
        cursor: pointer;
        display: inline-flex; align-items: center; gap: 4px;
        margin-top: 10px;
    }
    .toggle-solusi:hover { text-decoration: underline; }

    /* Highlight waktu pencarian */
    mark { background: #fff3cd; padding: 0 2px; border-radius: 2px; }

    /* Empty state filter */
    #noResult {
        display: none;
        text-align: center;
        padding: 50px 20px;
        color: #aaa;
    }
    #noResult i { font-size: 2rem; display: block; margin-bottom: 12px; }

    /* Info disclaimer */
    .disclaimer {
        background: #fffbeb;
        border: 1px solid #fde68a;
        border-left: 4px solid #f59e0b;
        border-radius: 6px;
        padding: 12px 16px;
        font-size: 0.83rem;
        color: #78350f;
        display: flex;
        gap: 10px;
        align-items: flex-start;
    }
    .disclaimer i { color: #f59e0b; margin-top: 2px; flex-shrink: 0; }

    @media (max-width: 576px) {
        .card-head { padding: 16px 16px 12px; }
        .card-body-custom { padding: 14px 16px; }
    }
</style>
@endpush

@section('content')

<div class="page-header">
    <div class="container">
        <span style="display:inline-block;background:rgba(255,255,255,0.12);border:1px solid rgba(255,255,255,0.25);border-radius:20px;font-size:0.78rem;padding:4px 14px;margin-bottom:14px;">
            <i class="bi bi-book me-1"></i> Basis Pengetahuan
        </span>
        <h1>Informasi Penyakit Kelenjar Getah Bening</h1>
        <p>Pelajari berbagai jenis gangguan kelenjar getah bening yang tercakup dalam sistem ini beserta saran penanganan awalnya.</p>
    </div>
</div>

<div class="container py-4">

    {{-- Toolbar: search + jumlah --}}
    <div style="display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;margin-bottom:20px;">
        <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" placeholder="Cari nama penyakit..." oninput="filterPenyakit(this.value)">
        </div>
        <span style="font-size:0.83rem;color:#888;">
            <span id="countLabel">{{ $penyakits->count() }}</span> jenis penyakit tersedia
        </span>
    </div>

    {{-- Disclaimer --}}
    <div class="disclaimer mb-4">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>Informasi di halaman ini bersifat edukatif. Saran penanganan awal yang tercantum <strong>tidak menggantikan</strong> pemeriksaan dan diagnosis dari dokter atau tenaga medis. Segera konsultasikan ke fasilitas kesehatan jika gejala berlanjut atau memburuk.</div>
    </div>

    {{-- Grid penyakit --}}
    <div class="row g-3" id="penyakitGrid">
        @forelse($penyakits as $p)
        <div class="col-md-6 col-xl-4 penyakit-item" data-nama="{{ strtolower($p->nama) }}">
            <div class="penyakit-card">
                <div class="card-head">
                    <div class="card-icon">
                        @php
                            $icons = [
                                'limfadenopati'   => 'bi-circle-fill',
                                'limfadenitis'    => 'bi-virus2',
                                'hodgkin'         => 'bi-lungs',
                                'non-hodgkin'     => 'bi-shield-exclamation',
                                'tuberkulosis'    => 'bi-droplet-half',
                                'limfedema'       => 'bi-water',
                                'limfoma'         => 'bi-activity',
                            ];
                            $icon = 'bi-heart-pulse';
                            foreach ($icons as $key => $ic) {
                                if (str_contains(strtolower($p->nama), $key)) {
                                    $icon = $ic;
                                    break;
                                }
                            }
                        @endphp
                        <i class="bi {{ $icon }}"></i>
                    </div>
                    <h5 class="penyakit-nama">{{ $p->nama }}</h5>
                </div>
                <div class="card-body-custom">
                    <div class="section-label">Deskripsi</div>
                    <p class="desc-text penyakit-desc">{{ $p->deskripsi }}</p>

                    @if($p->solusi)
                    <div class="solusi-box">
                        <div class="section-label"><i class="bi bi-check2-circle me-1"></i>Saran Penanganan Awal</div>
                        <p class="penyakit-solusi" style="display:none;">{{ $p->solusi }}</p>
                        <button class="toggle-solusi" onclick="toggleSolusi(this)">
                            <i class="bi bi-chevron-down"></i> Lihat saran penanganan
                        </button>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div style="background:#fff;border:1px solid #dde3ea;border-radius:8px;padding:60px 20px;text-align:center;color:#aaa;">
                <i class="bi bi-database-slash" style="font-size:2rem;display:block;margin-bottom:12px;color:#ccc;"></i>
                <p style="margin-bottom:16px;font-size:0.9rem;">Belum ada data penyakit yang dimasukkan ke sistem.</p>
                <a href="{{ route('konsultasi') }}" style="color:#2563a8;font-size:0.85rem;font-weight:600;">← Kembali ke Konsultasi</a>
            </div>
        </div>
        @endforelse
    </div>

    {{-- No result saat filter --}}
    <div id="noResult">
        <i class="bi bi-search"></i>
        <p>Tidak ada penyakit yang cocok dengan pencarian Anda.</p>
    </div>

    {{-- CTA bawah --}}
    @if($penyakits->count() > 0)
    <div style="margin-top:36px;background:#f0f4ff;border:1px solid #c7d8f8;border-radius:8px;padding:24px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:16px;">
        <div>
            <div style="font-weight:700;color:#1a3c6e;font-size:0.95rem;margin-bottom:4px;">Ingin tahu penyakit mana yang mungkin Anda alami?</div>
            <div style="font-size:0.85rem;color:#555;">Isi kuesioner gejala dan biarkan sistem menganalisis hasilnya untuk Anda.</div>
        </div>
        <a href="{{ route('konsultasi') }}" style="background:#1a3c6e;color:#fff;padding:10px 22px;border-radius:6px;text-decoration:none;font-size:0.88rem;font-weight:600;display:inline-flex;align-items:center;gap:8px;white-space:nowrap;">
            <i class="bi bi-clipboard2-pulse"></i> Mulai Konsultasi
        </a>
    </div>
    @endif

</div>

@endsection

@push('scripts')
<script>
// Filter pencarian
function filterPenyakit(q) {
    const items = document.querySelectorAll('.penyakit-item');
    const keyword = q.toLowerCase().trim();
    let visible = 0;

    items.forEach(item => {
        const nama = item.dataset.nama || '';
        const desc = item.querySelector('.penyakit-desc')?.textContent.toLowerCase() || '';
        const match = nama.includes(keyword) || desc.includes(keyword);
        item.style.display = match ? '' : 'none';
        if (match) visible++;
    });

    document.getElementById('countLabel').textContent = visible;
    document.getElementById('noResult').style.display = visible === 0 ? 'block' : 'none';
}

// Toggle saran penanganan
function toggleSolusi(btn) {
    const solusiEl = btn.closest('.solusi-box').querySelector('.penyakit-solusi');
    const isOpen = solusiEl.style.display === 'block';
    solusiEl.style.display = isOpen ? 'none' : 'block';
    btn.innerHTML = isOpen
        ? '<i class="bi bi-chevron-down"></i> Lihat saran penanganan'
        : '<i class="bi bi-chevron-up"></i> Sembunyikan';
}
</script>
@endpush
