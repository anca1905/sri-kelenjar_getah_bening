@extends('layouts.admin')

@section('page_title', 'Riwayat Konsultasi')
@section('breadcrumb', 'Admin Panel / Laporan Konsultasi')

@push('styles')
<style>
    .badge-cf { padding: 4px 10px; border-radius: 20px; font-size: 0.75rem; font-weight: 700; display: inline-block; }
    .badge-tinggi { background: #d1fae5; color: #065f46; }
    .badge-sedang { background: #fef3c7; color: #92400e; }
    .badge-rendah { background: #f1f5f9; color: #475569; }
    
    .detail-grid { display: grid; grid-template-columns: 140px 1fr; gap: 10px 15px; margin-bottom: 20px; }
    .detail-label { color: var(--muted); font-size: 0.85rem; font-weight: 600; }
    .detail-value { color: var(--navy); font-weight: 600; font-size: 0.95rem; }
    
    .gejala-tag { display: inline-block; background: #f1f5f9; color: #334155; border: 1px solid #e2e8f0; border-radius: 6px; padding: 4px 10px; font-size: 0.8rem; margin: 2px 4px 4px 0; }
</style>
@endpush

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; margin-bottom: 24px; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h2 class="page-title"><i class="bi bi-journal-text"></i> Laporan Konsultasi Pasien</h2>
    </div>

    <form method="GET" action="{{ route('admin.riwayat.index') }}" style="display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap; align-items: center;">
        <div style="position: relative; flex: 1; min-width: 200px;">
            <i class="bi bi-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted);"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode sesi..." class="form-control" style="padding-left: 40px;">
        </div>
        <div style="flex: 1; min-width: 200px;">
            <select name="diagnosis" class="form-control" onchange="this.form.submit()">
                <option value="">Semua Penyakit</option>
                @foreach($diagnosisList as $d)
                    <option value="{{ $d }}" {{ request('diagnosis') == $d ? 'selected' : '' }}>{{ $d }}</option>
                @endforeach
            </select>
        </div>
        <div style="flex: 1; min-width: 200px;">
            <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="form-control" onchange="this.form.submit()">
        </div>
        <button type="submit" class="btn-outline">Filter</button>
        @if(request('search') || request('diagnosis') || request('tanggal'))
            <a href="{{ route('admin.riwayat.index') }}" class="btn-outline" style="color: #ef4444; border-color: #fca5a5;"><i class="bi bi-x-lg"></i></a>
        @endif
    </form>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 60px; text-align: center;">No</th>
                    <th>Waktu Konsultasi</th>
                    <th>Sesi & Pasien</th>
                    <th>Diagnosis Utama</th>
                    <th style="text-align: center;">Tingkat CF</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($riwayats as $index => $r)
                @php
                    $persen = round($r->nilai_cf * 100);
                    $badgeClass = $persen >= 70 ? 'badge-tinggi' : ($persen >= 40 ? 'badge-sedang' : 'badge-rendah');
                @endphp
                <tr>
                    <td style="text-align: center; color: var(--muted); font-weight: 500;">{{ $riwayats->firstItem() + $index }}</td>
                    <td>
                        <div style="font-weight: 600; color: var(--navy);">{{ $r->created_at->format('d M Y') }}</div>
                        <div style="font-size: 0.8rem; color: var(--muted);">Pukul {{ $r->created_at->format('H:i') }}</div>
                    </td>
                    <td>
                        <span style="font-family: monospace; font-size: 0.95rem; background: #f8fafc; border: 1px dashed #cbd5e1; color: #475569; padding: 4px 8px; border-radius: 4px; font-weight: 600; display: inline-block; margin-bottom: 4px;">{{ $r->kode_sesi }}</span>
                        <div style="font-size: 0.82rem; color: var(--navy); font-weight: 600;">
                            <i class="bi bi-person-circle"></i> {{ $r->nama_pasien ?? 'Anonim' }}
                            @if($r->umur || $r->jenis_kelamin)
                                <span style="font-weight: normal; color: var(--muted);">({{ $r->umur ?? '-' }} th, {{ $r->jenis_kelamin ? substr($r->jenis_kelamin, 0, 1) : '-' }})</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <div style="font-weight: 700; color: var(--navy); font-size: 0.95rem;">
                            {{ $r->diagnosis_utama ?: 'Tidak Diketahui' }}
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <span class="badge-cf {{ $badgeClass }}">{{ $persen }}%</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <button type="button" class="btn-icon detail" title="Lihat Detail" onclick="lihatDetail({{ $r->id }})">
                                <i class="bi bi-eye"></i>
                            </button>
                            <form action="{{ route('admin.riwayat.destroy', $r->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data riwayat ini?');" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon delete" title="Hapus Riwayat">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <i class="bi bi-inbox"></i>
                            <h4>Belum Ada Riwayat Konsultasi</h4>
                            <p>Data konsultasi pasien akan otomatis muncul di sini setelah seseorang menggunakan sistem pakar.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($riwayats->hasPages())
    <div style="margin-top: 24px;">
        {{ $riwayats->links() }}
    </div>
    @endif
</div>

<!-- Modal Detail -->
<div id="detailModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Detail Sesi Konsultasi</h3>
            <button type="button" class="modal-close" onclick="closeModal('detailModal')">&times;</button>
        </div>
        <div class="modal-body" id="detailContent">
            <div style="text-align:center; padding:40px;">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <div style="margin-top: 10px; color: var(--muted); font-size: 0.9rem;">Memuat detail...</div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-primary" onclick="closeModal('detailModal')">Tutup</button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function openModal(id) {
        const modal = document.getElementById(id);
        modal.style.display = 'flex';
        setTimeout(() => {
            modal.style.opacity = '1';
            modal.querySelector('.modal-content').style.transform = 'translateY(0)';
        }, 10);
    }
    
    function closeModal(id) {
        const modal = document.getElementById(id);
        modal.style.opacity = '0';
        modal.querySelector('.modal-content').style.transform = 'translateY(20px)';
        setTimeout(() => {
            modal.style.display = 'none';
        }, 300);
    }
    
    function formatTanggal(dateString) {
        const date = new Date(dateString);
        return date.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric', hour: '2-digit', minute: '2-digit' });
    }

    function lihatDetail(id) {
        openModal('detailModal');
        const content = document.getElementById('detailContent');
        
        // Tampilkan loading spinner lagi
        content.innerHTML = `
            <div style="text-align:center; padding:40px;">
                <div class="spinner-border text-primary" role="status"></div>
                <div style="margin-top: 10px; color: var(--muted); font-size: 0.9rem;">Memuat detail...</div>
            </div>
        `;
        
        // Fetch data
        fetch("{{ url('admin/riwayat') }}/" + id)
            .then(res => res.json())
            .then(data => {
                let gejalaHtml = '';
                if (data.detail_gejala && Array.isArray(data.detail_gejala)) {
                    gejalaHtml = data.detail_gejala.map(g => {
                        let labelHtml = g.label ? ` <span style="font-size:0.7rem; background:#1e40af; color:white; padding:1px 5px; border-radius:10px;">${g.label}</span>` : '';
                        return `<span class="gejala-tag">${g.kode} - ${g.nama}${labelHtml}</span>`;
                    }).join('');
                } else {
                    gejalaHtml = '<span style="color:var(--muted); font-style:italic;">Data gejala tidak tersedia</span>';
                }

                let persentase = Math.round(data.nilai_cf * 100);
                
                content.innerHTML = `
                    <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:8px; padding:16px; margin-bottom:20px;">
                        <div class="detail-grid" style="margin-bottom:0;">
                            <div class="detail-label">Kode Sesi</div>
                            <div class="detail-value" style="font-family:monospace; font-size:1.1rem; color:#1e3a8a;">${data.kode_sesi}</div>
                            
                            <div class="detail-label">Waktu</div>
                            <div class="detail-value">${formatTanggal(data.created_at)}</div>
                        </div>
                    </div>

                    <h5 style="font-weight:700; color:var(--navy); margin-bottom:12px; font-size:1rem; border-bottom:1px solid var(--border); padding-bottom:8px;">Biodata Pasien</h5>
                    <div class="detail-grid">
                        <div class="detail-label">Nama Lengkap</div>
                        <div class="detail-value">${data.nama_pasien || 'Anonim'}</div>
                        
                        <div class="detail-label">Umur</div>
                        <div class="detail-value">${data.umur ? data.umur + ' Tahun' : '-'}</div>

                        <div class="detail-label">Jenis Kelamin</div>
                        <div class="detail-value">${data.jenis_kelamin || '-'}</div>
                    </div>
                    
                    <h5 style="font-weight:700; color:var(--navy); margin-bottom:12px; font-size:1rem; border-bottom:1px solid var(--border); padding-bottom:8px;">Hasil Diagnosis</h5>
                    <div class="detail-grid">
                        <div class="detail-label">Diagnosis Utama</div>
                        <div class="detail-value" style="color:#059669; font-size:1.1rem;">${data.diagnosis_utama || 'Tidak ditemukan'}</div>
                        
                        <div class="detail-label">Nilai CF</div>
                        <div class="detail-value">
                            <span class="badge-cf badge-tinggi" style="font-size:0.85rem;">${persentase}%</span>
                            <span style="font-size:0.8rem; color:var(--muted); margin-left:8px;">(Certainty Factor: ${data.nilai_cf})</span>
                        </div>
                    </div>
                    
                    <h5 style="font-weight:700; color:var(--navy); margin-bottom:12px; font-size:1rem; border-bottom:1px solid var(--border); padding-bottom:8px; margin-top:20px;">Gejala yang Dialami</h5>
                    <div style="margin-bottom:10px;">
                        ${gejalaHtml}
                    </div>
                `;
            })
            .catch(err => {
                content.innerHTML = `
                    <div style="text-align:center; padding:30px; color:#ef4444;">
                        <i class="bi bi-exclamation-triangle" style="font-size:2rem; margin-bottom:10px; display:block;"></i>
                        Gagal memuat detail riwayat. Terjadi kesalahan pada server.
                    </div>
                `;
            });
    }
</script>
@endpush
@endsection
