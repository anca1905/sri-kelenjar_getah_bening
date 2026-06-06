@extends('layouts.admin')

@section('page_title', 'Basis Pengetahuan')
@section('breadcrumb', 'Admin Panel / Basis Pengetahuan')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; margin-bottom: 24px; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h2 class="page-title"><i class="bi bi-diagram-3"></i> Basis Pengetahuan (Aturan CF)</h2>
        <button class="btn-primary" onclick="openModal('addModal')">
            <i class="bi bi-plus-lg"></i> Tambah Aturan
        </button>
    </div>

    <form method="GET" action="{{ route('admin.pengetahuan.index') }}" style="display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;">
        <div style="position: relative; flex: 1; max-width: 300px;">
            <i class="bi bi-search" style="position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: var(--muted);"></i>
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari gejala..." class="form-control" style="padding-left: 40px;">
        </div>
        <select name="penyakit_id" class="form-control" style="max-width: 250px;" onchange="this.form.submit()">
            <option value="">Semua Penyakit</option>
            @foreach($penyakits as $p)
                <option value="{{ $p->id }}" {{ request('penyakit_id') == $p->id ? 'selected' : '' }}>
                    {{ $p->kode }} - {{ $p->nama }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn-outline">Filter</button>
        @if(request('search') || request('penyakit_id'))
            <a href="{{ route('admin.pengetahuan.index') }}" class="btn-outline" style="color: #ef4444; border-color: #fca5a5;"><i class="bi bi-x-lg"></i></a>
        @endif
    </form>

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 60px; text-align: center;">No</th>
                    <th>Penyakit</th>
                    <th>Gejala</th>
                    <th style="text-align: center; width: 150px;">Nilai CF (MB)</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rules as $index => $rule)
                <tr>
                    <td style="text-align: center; color: var(--muted); font-weight: 500;">{{ $rules->firstItem() + $index }}</td>
                    <td>
                        <span style="font-size: 0.75rem; background: #e0f2fe; color: #0284c7; padding: 2px 6px; border-radius: 4px; font-weight: 600; margin-right: 5px;">{{ $rule->penyakit->kode }}</span>
                        <span style="font-weight: 600; color: var(--navy);">{{ $rule->penyakit->nama }}</span>
                    </td>
                    <td>
                        <div style="margin-bottom: 4px;">
                            <span style="font-size: 0.75rem; background: #f1f5f9; color: #475569; padding: 2px 6px; border-radius: 4px; font-weight: 600; margin-right: 5px;">{{ $rule->gejala->kode }}</span>
                            <span style="color: #334155;">{{ $rule->gejala->nama }}</span>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <span style="font-weight: 700; color: var(--teal); font-size: 1.05rem;">{{ $rule->mb }}</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <button type="button" class="btn-icon edit" title="Edit Data" onclick="editRule({{ $rule->id }}, {{ $rule->penyakit_id }}, {{ $rule->gejala_id }}, {{ $rule->mb }})">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <form action="{{ route('admin.pengetahuan.destroy', $rule->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus aturan ini?');" style="margin: 0;">
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
                            <i class="bi bi-diagram-2"></i>
                            <h4>Belum Ada Aturan</h4>
                            <p>Tambahkan basis pengetahuan dengan memetakan gejala ke penyakit beserta nilai kepastiannya.</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if($rules->hasPages())
    <div style="margin-top: 24px;">
        {{ $rules->links() }}
    </div>
    @endif
</div>

<!-- Modal Tambah -->
<div id="addModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Tambah Aturan Baru</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')">&times;</button>
        </div>
        <form action="{{ route('admin.pengetahuan.store') }}" method="POST">
            @csrf
            <div class="modal-body">
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Penyakit <span style="color:#ef4444;">*</span></label>
                    <select name="penyakit_id" class="form-control" required>
                        <option value="">-- Pilih Penyakit --</option>
                        @foreach($penyakits as $p)
                            <option value="{{ $p->id }}">{{ $p->kode }} - {{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Gejala <span style="color:#ef4444;">*</span></label>
                    <select name="gejala_id" class="form-control" required>
                        <option value="">-- Pilih Gejala --</option>
                        @foreach($gejalas as $g)
                            <option value="{{ $g->id }}">{{ $g->kode }} - {{ $g->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Nilai CF Pakar (MB) <span style="color:#ef4444;">*</span></label>
                    <input type="number" step="0.01" min="0" max="1" name="mb" class="form-control" required placeholder="Contoh: 0.8 (0 sampai 1)">
                    <small style="color: var(--muted); margin-top: 4px; display: block;">Masukkan tingkat kepastian pakar (0 = tidak pasti sama sekali, 1 = sangat pasti).</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline" onclick="closeModal('addModal')">Batal</button>
                <button type="submit" class="btn-primary">Simpan Aturan</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Edit -->
<div id="editModal" class="modal-overlay">
    <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Edit Aturan</h3>
            <button type="button" class="modal-close" onclick="closeModal('editModal')">&times;</button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Penyakit <span style="color:#ef4444;">*</span></label>
                    <select name="penyakit_id" id="edit_penyakit_id" class="form-control" required>
                        @foreach($penyakits as $p)
                            <option value="{{ $p->id }}">{{ $p->kode }} - {{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div style="margin-bottom: 20px;">
                    <label class="form-label">Gejala <span style="color:#ef4444;">*</span></label>
                    <select name="gejala_id" id="edit_gejala_id" class="form-control" required>
                        @foreach($gejalas as $g)
                            <option value="{{ $g->id }}">{{ $g->kode }} - {{ $g->nama }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="form-label">Nilai CF Pakar (MB) <span style="color:#ef4444;">*</span></label>
                    <input type="number" step="0.01" min="0" max="1" name="mb" id="edit_mb" class="form-control" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-outline" onclick="closeModal('editModal')">Batal</button>
                <button type="submit" class="btn-primary">Perbarui Aturan</button>
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
    
    function editRule(id, penyakit_id, gejala_id, mb) {
        document.getElementById('editForm').action = "{{ url('admin/pengetahuan') }}/" + id;
        document.getElementById('edit_penyakit_id').value = penyakit_id;
        document.getElementById('edit_gejala_id').value = gejala_id;
        document.getElementById('edit_mb').value = mb;
        openModal('editModal');
    }
</script>
@endpush
@endsection
