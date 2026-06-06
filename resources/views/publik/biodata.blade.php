@extends('layouts.publik')

@section('title', 'Isi Biodata Pasien')
@section('description', 'Pengisian biodata pasien sebelum memulai konsultasi sistem pakar.')

@push('styles')
<style>
    .page-header { background: linear-gradient(to right, #1a3c6e, #2563a8); color: white; padding: 36px 0; }
    .page-header h1 { font-size: 1.6rem; font-weight: 700; margin-bottom: 8px; }
    .page-header p { font-size: 0.9rem; opacity: 0.85; margin: 0; }
    .step-badge { display: inline-block; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); border-radius: 20px; font-size: 0.78rem; padding: 3px 12px; margin-bottom: 12px; }
    
    .form-card { background: white; border: 1px solid var(--border); border-radius: 8px; margin-bottom: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.03); overflow: hidden; }
    .form-card-header { background: var(--biru-tua); color: white; padding: 16px 24px; font-size: 1.05rem; font-weight: 600; display: flex; align-items: center; gap: 10px; }
    .form-card-body { padding: 24px; }
    
    .form-group { margin-bottom: 20px; }
    .form-label { display: block; font-weight: 600; margin-bottom: 8px; color: var(--navy); font-size: 0.9rem; }
    .form-control { width: 100%; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 8px; font-size: 0.95rem; color: #334155; transition: border-color 0.15s, box-shadow 0.15s; background: #fff; }
    .form-control:focus { outline: none; border-color: var(--biru); box-shadow: 0 0 0 3px rgba(37,99,168,0.15); }
    
    .btn-proses { background-color: var(--biru-tua); color: white; border: none; padding: 12px 28px; border-radius: 8px; font-size: 0.95rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; justify-content: center; gap: 8px; transition: background 0.2s; width: 100%; }
    .btn-proses:hover { background-color: var(--biru); }
    
    @media (max-width: 576px) { .page-header h1 { font-size: 1.3rem; } }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="container">
        <span class="step-badge"><i class="bi bi-1-circle me-1"></i> Langkah 1 dari 2</span>
        <h1>Informasi Pasien</h1>
        <p>Silakan lengkapi data diri Anda sebelum memulai sesi konsultasi dengan sistem pakar kami.</p>
    </div>
</div>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">

            @if(session('info'))
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <i class="bi bi-info-circle me-2"></i>{{ session('info') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="form-card">
                <div class="form-card-header">
                    <i class="bi bi-person-lines-fill"></i> Form Biodata Pasien
                </div>
                <div class="form-card-body">
                    <form method="POST" action="{{ route('konsultasi.biodata.post') }}">
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label" for="nama_pasien">Nama Lengkap <span style="color:#ef4444;">*</span></label>
                            <input type="text" id="nama_pasien" name="nama_pasien" class="form-control" value="{{ old('nama_pasien', session('biodata.nama_pasien')) }}" required placeholder="Masukkan nama lengkap Anda" autofocus>
                            @error('nama_pasien')
                                <div style="color:#ef4444; font-size:0.8rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="umur">Umur (Tahun) <span style="color:#ef4444;">*</span></label>
                            <input type="number" id="umur" name="umur" class="form-control" value="{{ old('umur', session('biodata.umur')) }}" required min="1" max="150" placeholder="Contoh: 35">
                            @error('umur')
                                <div style="color:#ef4444; font-size:0.8rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="jenis_kelamin">Jenis Kelamin <span style="color:#ef4444;">*</span></label>
                            <select id="jenis_kelamin" name="jenis_kelamin" class="form-control" required>
                                <option value="" disabled {{ !old('jenis_kelamin', session('biodata.jenis_kelamin')) ? 'selected' : '' }}>-- Pilih Jenis Kelamin --</option>
                                <option value="Laki-laki" {{ old('jenis_kelamin', session('biodata.jenis_kelamin')) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                <option value="Perempuan" {{ old('jenis_kelamin', session('biodata.jenis_kelamin')) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <div style="color:#ef4444; font-size:0.8rem; margin-top:5px;">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4 pt-2">
                            <button type="submit" class="btn-proses">
                                Lanjutkan ke Kuesioner <i class="bi bi-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center" style="font-size: 0.85rem; color: var(--muted);">
                <i class="bi bi-shield-lock me-1"></i> Data Anda akan disimpan dengan aman sebagai riwayat konsultasi.
            </div>
            
        </div>
    </div>
</div>
@endsection
