@extends('layouts.admin')

@section('page_title', 'Data Gejala')
@section('breadcrumb', 'Admin Panel / Data Gejala')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; margin-bottom: 24px; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h2 class="page-title"><i class="bi bi-clipboard2-pulse"></i> Kelola Data Gejala</h2>
        <button class="btn-primary" onclick="openModal('addModal')">
            <i class="bi bi-plus-lg"></i> Tambah Gejala
        </button>
    </div>

    <form method="GET" action="{{ route('admin.gejala.index') }}" style="display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;">
        <div style="position: relative; flex: 1; min-width: 200px; max-width: 350px;">
            <i class="bi bi-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted);"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari kode atau nama..." class="form-control" style="padding-left: 40px;">
        </div>
        <button type="submit" class="btn-outline">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.gejala.index') }}" class="btn-outline" style="color: #ef4444; border-color: #fca5a5;"><i class="bi bi-x-lg"></i></a>
        @endif
    </form>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 60px; text-align: center;">No</th>
                    <th style="width: 120px;">Kode Gejala</th>
                    <th>Nama Gejala</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($gejalas as $index => $g)
                <tr>
                    <td style="text-align: center; color: var(--muted); font-weight: 500;">{{ $gejalas->firstItem() + $index }}</td>
                    <td>
                        <span style="font-family: monospace; font-size: 1rem; background: #e8f1fb; color: #1e3a8a; padding: 4px 10px; border-radius: 6px; font-weight: 700; letter-spacing: 0.5px;">{{ $g->kode }}</span>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--navy); font-size: 0.95rem;">{{ $g->nama }}</div>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <button type="button" class="btn-icon edit" title="Edit Data" onclick="editData({{ $g->id }}, '{{ $g->kode }}', '{{ addslashes($g->nama) }}')">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.gejala.destroy', $g->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus gejala ini beserta semua aturan yang terkait?');" style="margin: 0;">
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
                    <td colspan="4">
                        <div class="empty-state">
                            <i class="bi bi-thermometer-half"></i>
                            <h4>Belum Ada Data Gejala</h4>
                            <p>Data gejala belum ditambahkan. Gejala digunakan sebagai pertanyaan utama saat pasien melakukan konsultasi.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($gejalas->hasPages())
    <div style="margin-top: 24px;">
        {{ $gejalas->links() }}
    </div>
    @endif
</div>

<!-- Modal Tambah -->
<div id="addModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Gejala Baru</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admin.gejala.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Kode Gejala <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="kode" class="form-control" required placeholder="Contoh: G001" maxlength="10">
                    <small style="color: var(--muted); font-size: 0.75rem; margin-top: 4px; display: block;">Kode harus unik dan tidak boleh sama.</small>
                </div>
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Nama Gejala <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="nama" class="form-control" required placeholder="Contoh: Demam tinggi">
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
            <h3 class="modal-title">Edit Data Gejala</h3>
            <button type="button" class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Kode Gejala <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="kode" id="edit_kode" class="form-control" required maxlength="10">
                </div>
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Nama Gejala <span style="color:#ef4444;">*</span></label>
                    <input type="text" name="nama" id="edit_nama" class="form-control" required>
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
    
    function editData(id, kode, nama) {
        document.getElementById('editForm').action = "{{ url('admin/gejala') }}/" + id;
        document.getElementById('edit_kode').value = kode;
        document.getElementById('edit_nama').value = nama;
        openModal('editModal');
    }
</script>
@endpush
@endsection
