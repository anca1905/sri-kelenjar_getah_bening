@extends('layouts.admin')

@section('page_title', 'Basis Pengetahuan')
@section('breadcrumb', 'Admin Panel / Basis Pengetahuan')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; margin-bottom: 24px; align-items: center; flex-wrap: wrap; gap: 16px;">
        <h2 class="page-title"><i class="bi bi-diagram-3"></i> Basis Pengetahuan (Aturan CF)</h2>
        <button class="btn-primary" onclick="openModal('addModal')">
            <i class="bi bi-gear"></i> Atur Gejala Pakar
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
                    {{ $p->nama }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="btn-outline">Filter</button>
        @if(request('search') || request('penyakit_id'))
            <a href="{{ route('admin.pengetahuan.index') }}" class="btn-outline" style="color: #ef4444; border-color: #fca5a5;"><i class="bi bi-x-lg"></i></a>
        @endif
    </form>

    @php
        $rowspans = [];
        $currentPid = null;
        $spanCount = 0;
        $spanStartIndex = 0;
        
        foreach ($rules as $index => $rule) {
            if ($rule->penyakit_id !== $currentPid) {
                if ($spanCount > 0) {
                    $rowspans[$spanStartIndex] = $spanCount;
                }
                $currentPid = $rule->penyakit_id;
                $spanCount = 1;
                $spanStartIndex = $index;
            } else {
                $spanCount++;
            }
        }
        if ($spanCount > 0) {
            $rowspans[$spanStartIndex] = $spanCount;
        }
    @endphp

    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th style="width: 60px; text-align: center;">No</th>
                    <th style="text-align: center;">Penyakit</th>
                    <th>Gejala</th>
                    <th style="text-align: center; width: 100px;">MB</th>
                    <th style="text-align: center; width: 100px;">MD</th>
                    <th style="text-align: center; width: 120px;">CF Pakar</th>
                    <th style="width: 120px; text-align: center;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($rules as $index => $rule)
                <tr>
                    <td style="text-align: center; color: var(--muted); font-weight: 500;">{{ $rules->firstItem() + $index }}</td>
                    
                    @if(isset($rowspans[$index]))
                    <td rowspan="{{ $rowspans[$index] }}" style="vertical-align: middle; text-align: center; border-right: 1px solid var(--border);">
                        <div style="display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px;">
                            <span style="font-weight: 700; color: var(--navy); font-size: 1rem;">{{ $rule->penyakit->nama }}</span>
                        </div>
                    </td>
                    @endif
                    
                    <td>
                        <div style="margin-bottom: 4px;">
                            <span style="font-size: 0.75rem; background: #f1f5f9; color: #475569; padding: 2px 6px; border-radius: 4px; font-weight: 600; margin-right: 5px;">{{ $rule->gejala->kode }}</span>
                            <span style="color: #334155;">{{ $rule->gejala->nama }}</span>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <span style="font-weight: 700; color: var(--teal); font-size: 1.05rem;">{{ $rule->mb }}</span>
                    </td>
                    <td style="text-align: center;">
                        <span style="font-weight: 700; color: #f59e0b; font-size: 1.05rem;">{{ $rule->md }}</span>
                    </td>
                    <td style="text-align: center;">
                        <span style="font-weight: 700; color: #3b82f6; font-size: 1.05rem;">{{ $rule->cf_pakar }}</span>
                    </td>
                    <td>
                        <div style="display: flex; gap: 8px; justify-content: center;">
                            <button type="button" class="btn-icon edit" title="Edit Data" onclick="editRule({{ $rule->id }}, {{ $rule->penyakit_id }}, {{ $rule->gejala_id }}, {{ $rule->mb }}, {{ $rule->md }})">
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
                    <td colspan="7">
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

<div id="addModal" class="modal-overlay">
    <div class="modal-content" style="max-width: 800px; padding: 0; overflow: hidden; border-radius: 8px;">
        <div class="modal-header" style="background: #5a67d8; padding: 16px 24px; display: flex; justify-content: space-between; align-items: center; border-bottom: none; margin: 0;">
            <h3 class="modal-title" style="color: white; font-size: 1.1rem; font-weight: 600; margin: 0;">Atur Gejala Pakar</h3>
            <button type="button" class="modal-close" onclick="closeModal('addModal')" style="color: white; opacity: 0.8; margin: 0; padding: 0;">&times;</button>
        </div>
        <form action="{{ route('admin.pengetahuan.store_bulk') }}" method="POST" style="margin: 0;">
            @csrf
            <div class="modal-body" style="padding: 24px;">
                <div style="margin-bottom: 24px;">
                    <label class="form-label" style="font-weight: 700; color: #1e3a8a; margin-bottom: 8px; display: block;">1. Pilih Jenis Penyakit:</label>
                    <select name="penyakit_id" id="bulk_penyakit_id" class="form-control" required onchange="loadPenyakitRules(this.value)">
                        <option value="">-- Pilih Jenis --</option>
                        @foreach($penyakits as $p)
                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div style="margin-bottom: 12px;">
                    <label class="form-label" style="font-weight: 700; color: #1e3a8a; margin-bottom: 8px; display: block;">2. Pilih Gejala & Isi Nilai MB:</label>
                </div>
                <div style="max-height: 400px; overflow-y: auto; border: 1px solid #e2e8f0; border-radius: 8px;">
                    <table class="table" style="margin: 0; border: none;">
                        <thead style="position: sticky; top: 0; z-index: 1; background: #f8fafc; box-shadow: 0 1px 2px rgba(0,0,0,0.05);">
                            <tr>
                                <th style="width: 80px; text-align: center; border-bottom: 2px solid #e2e8f0; font-size: 0.85rem;">Pilih</th>
                                <th style="border-bottom: 2px solid #e2e8f0; font-size: 0.85rem;">Gejala</th>
                                <th style="width: 200px; border-bottom: 2px solid #e2e8f0; font-size: 0.85rem;">Nilai MB</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($gejalas as $g)
                            <tr style="border-bottom: 1px solid #f1f5f9;">
                                <td style="text-align: center; vertical-align: middle; padding: 12px;">
                                    <input type="checkbox" name="gejala_id[]" value="{{ $g->id }}" id="check_{{ $g->id }}" class="gejala-checkbox" style="width: 18px; height: 18px; cursor: pointer; accent-color: #5a67d8;">
                                </td>
                                <td style="vertical-align: middle; padding: 12px;">
                                    <label for="check_{{ $g->id }}" style="cursor: pointer; margin: 0; display: block; font-size: 0.95rem; color: #475569;">
                                        <span style="font-weight: 700; color: #64748b; margin-right: 6px;">[{{ $g->kode }}]</span>
                                        {{ $g->nama }}
                                    </label>
                                </td>
                                <td style="padding: 12px;">
                                    <select name="mb[{{ $g->id }}]" class="form-control mb-select" disabled style="padding: 8px 12px; font-size: 0.9rem; height: auto; background-color: #f8fafc;">
                                        <option value="">-- Pilih Nilai --</option>
                                        @for($i = 2; $i <= 9; $i++)
                                            <option value="0.{{ $i }}">0.{{ $i }}</option>
                                        @endfor
                                    </select>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer" style="padding: 16px 24px 24px 24px; border-top: none; background: white;">
                <button type="submit" class="btn-primary" style="width: 100%; background: #5a67d8; border-color: #5a67d8; padding: 14px; font-size: 1rem; border-radius: 8px; font-weight: 600;">Simpan Basis Pengetahuan</button>
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
                <div style="display: flex; gap: 16px;">
                    <div style="flex: 1;">
                        <label class="form-label">Measure of Belief (MB) <span style="color:#ef4444;">*</span></label>
                        <input type="number" step="0.01" min="0" max="1" name="mb" id="edit_mb" class="form-control" required>
                    </div>
                    <div style="flex: 1;">
                        <label class="form-label">Measure of Disbelief (MD) <span style="color:#ef4444;">*</span></label>
                        <input type="number" step="0.01" min="0" max="1" name="md" id="edit_md" class="form-control" required>
                    </div>
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
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.gejala-checkbox').forEach(cb => {
            cb.addEventListener('change', function() {
                const select = this.closest('tr').querySelector('.mb-select');
                if(this.checked) {
                    select.disabled = false;
                    select.required = true;
                } else {
                    select.disabled = true;
                    select.required = false;
                    select.value = '';
                }
            });
        });
    });

    function loadPenyakitRules(penyakitId) {
        document.querySelectorAll('.gejala-checkbox').forEach(cb => {
            cb.checked = false;
            const select = cb.closest('tr').querySelector('.mb-select');
            select.disabled = true;
            select.required = false;
            select.value = '';
        });

        if(!penyakitId) return;

        fetch(`{{ url('admin/pengetahuan/get-rules') }}/${penyakitId}`)
            .then(res => res.json())
            .then(data => {
                for (const [gejalaId, mb] of Object.entries(data)) {
                    const cb = document.getElementById('check_' + gejalaId);
                    if(cb) {
                        cb.checked = true;
                        const select = cb.closest('tr').querySelector('.mb-select');
                        select.disabled = false;
                        select.required = true;
                        select.value = parseFloat(mb).toString();
                    }
                }
            });
    }

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
    
    function editRule(id, penyakit_id, gejala_id, mb, md) {
        document.getElementById('editForm').action = "{{ url('admin/pengetahuan') }}/" + id;
        document.getElementById('edit_penyakit_id').value = penyakit_id;
        document.getElementById('edit_gejala_id').value = gejala_id;
        document.getElementById('edit_mb').value = mb;
        document.getElementById('edit_md').value = md;
        openModal('editModal');
    }
</script>
@endpush
@endsection
