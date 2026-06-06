@extends('layouts.admin')

@section('page_title', 'Data Penyakit')
@section('breadcrumb', 'Admin Panel / Data Penyakit')

@push('styles')
@endpush

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; margin-bottom: 24px; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h2 class="page-title"><i class="bi bi-virus2"></i> Kelola Data Penyakit</h2>
        <button class="btn-primary" onclick="openModal('addModal')">
            <i class="bi bi-plus-lg"></i> Tambah Penyakit
        </button>
    </div>

    <form method="GET" action="{{ route('admin.penyakit.index') }}" style="display: flex; gap: 12px; margin-bottom: 24px; max-width: 400px;">
        <div style="position: relative; flex: 1;">
            <i class="bi bi-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted);"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama penyakit..." class="form-control" style="padding-left: 40px;">
        </div>
        <button type="submit" class="btn-outline">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.penyakit.index') }}" class="btn-outline" style="color: #ef4444; border-color: #fca5a5;"><i class="bi bi-x-lg"></i></a>
        @endif
    </form>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 60px; text-align: center;">No</th>
                    <th>Nama Penyakit</th>
                    <th>Deskripsi Singkat</th>
                    <th>Solusi / Saran Penanganan</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($penyakits as $index => $p)
                <tr>
                    <td style="text-align: center; color: var(--muted); font-weight: 500;">{{ $penyakits->firstItem() + $index }}</td>
                    <td>
                        <div style="font-weight: 700; color: var(--navy); margin-bottom: 4px;">{{ $p->nama }}</div>
                        @if($p->kode)
                        <span style="font-size: 0.75rem; background: #e0f2fe; color: #0284c7; padding: 2px 6px; border-radius: 4px; font-weight: 600; letter-spacing: 0.5px;">{{ $p->kode }}</span>
                        @endif
                    </td>
                    <td>
                        <div style="font-size: 0.85rem; line-height: 1.5; color: #475569; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $p->deskripsi }}
                        </div>
                    </td>
                    <td>
                        <div style="font-size: 0.85rem; line-height: 1.5; color: #475569; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                            {{ $p->solusi }}
                        </div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <button type="button" class="btn-icon edit" title="Edit Data" onclick="editData({{ $p->id }}, '{{ addslashes($p->nama) }}', '{{ addslashes($p->deskripsi) }}', '{{ addslashes($p->solusi) }}')">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.penyakit.destroy', $p->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus penyakit ini beserta semua aturan yang terkait?');" style="margin: 0;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-icon delete" title="Hapus Data">
                                    <i class="bi bi-trash3"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-state">
                            <i class="bi bi-virus"></i>
                            <h4>Belum Ada Data Penyakit</h4>
                            <p>Data penyakit yang ditambahkan akan muncul di tabel ini dan digunakan untuk basis pengetahuan sistem pakar.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($penyakits->hasPages())
    <div style="margin-top: 24px;">
        {{ $penyakits->links() }}
    </div>
    @endif
</div>

<!-- Modal Tambah -->
<div id="addModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Penyakit Baru</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admin.penyakit.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Nama Penyakit <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="nama" class="form-control" required placeholder="Contoh: Limfadenitis">
                </div>
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Deskripsi Penyakit <span style="color:#ef4444;">*</span></label>
                    <textarea name="deskripsi" class="form-control" rows="3" required placeholder="Jelaskan secara singkat mengenai penyakit ini..."></textarea>
                </div>
                <div>
                    <label class="form-label">Solusi / Saran Penanganan <span style="color:#ef4444;">*</span></label>
                    <textarea name="solusi" class="form-control" rows="3" required placeholder="Saran medis atau penanganan awal..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline" onclick="closeModal('addModal')">Batal</button>
                <button type="submit" class="btn-primary">Simpan Data</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Data Penyakit</h3>
            <button type="button" class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Nama Penyakit <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="nama" id="edit_nama" class="form-control" required>
                </div>
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Deskripsi Penyakit <span style="color:#ef4444;">*</span></label>
                    <textarea name="deskripsi" id="edit_deskripsi" class="form-control" rows="3" required></textarea>
                </div>
                <div>
                    <label class="form-label">Solusi / Saran Penanganan <span style="color:#ef4444;">*</span></label>
                    <textarea name="solusi" id="edit_solusi" class="form-control" rows="3" required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline" onclick="closeModal('editModal')">Batal</button>
                <button type="submit" class="btn-primary">Perbarui Data</button>
            </div>
        </form>
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
    
    function editData(id, nama, deskripsi, solusi) {
        document.getElementById('editForm').action = "{{ url('admin/penyakit') }}/" + id;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_deskripsi').value = deskripsi;
        document.getElementById('edit_solusi').value = solusi;
        openModal('editModal');
    }
</script>
@endpush
@endsection
