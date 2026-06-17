@extends('layouts.publik')

@section('title', 'Konsultasi Kelenjar Getah Bening')
@section('description', 'Form konsultasi sistem pakar untuk diagnosis penyakit kelenjar getah bening menggunakan metode Certainty Factor.')

@push('styles')
<style>
    .page-header { background: linear-gradient(to right, #1a3c6e, #2563a8); color: white; padding: 36px 0; }
    .page-header h1 { font-size: 1.6rem; font-weight: 700; margin-bottom: 8px; }
    .page-header p { font-size: 0.9rem; opacity: 0.85; margin: 0; }
    .step-badge { display: inline-block; background: rgba(255,255,255,0.15); border: 1px solid rgba(255,255,255,0.3); border-radius: 20px; font-size: 0.78rem; padding: 3px 12px; margin-bottom: 12px; }
    .info-box { background: #fff3cd; border: 1px solid #ffc107; border-radius: 6px; padding: 12px 16px; font-size: 0.85rem; margin-bottom: 20px; display: flex; gap: 10px; align-items: flex-start; }
    .info-box i { color: #856404; margin-top: 2px; }
    .form-card { background: white; border: 1px solid var(--border); border-radius: 8px; margin-bottom: 20px; }
    .form-card-header { background: var(--biru-tua); color: white; border-radius: 8px 8px 0 0; padding: 12px 20px; font-size: 0.9rem; font-weight: 600; display: flex; align-items: center; gap: 8px; }
    .form-card-body { padding: 0 20px; }
    .gejala-row { display: grid; grid-template-columns: 1fr 200px; gap: 16px; align-items: center; padding: 16px 0; border-bottom: 1px solid var(--border); }
    .gejala-row:last-child { border-bottom: none; }
    .gejala-label { display: flex; gap: 10px; }
    .gejala-no { flex-shrink: 0; width: 26px; height: 26px; background: var(--biru-muda); color: var(--biru-tua); border-radius: 50%; font-size: 0.8rem; font-weight: 700; display: flex; align-items: center; justify-content: center; margin-top: 2px; }
    .gejala-nama { font-size: 0.9rem; font-weight: 600; color: #222; margin-bottom: 3px; }
    .gejala-desc { font-size: 0.82rem; color: #666; }
    .form-select-custom { font-size: 0.85rem; padding: 7px 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%; background-color: #fafafa; }
    .form-select-custom:focus { border-color: var(--biru); outline: none; box-shadow: 0 0 0 3px rgba(37,99,168,0.15); }
    .btn-proses { background-color: var(--biru-tua); color: white; border: none; padding: 10px 28px; border-radius: 5px; font-size: 0.9rem; font-weight: 600; cursor: pointer; display: inline-flex; align-items: center; gap: 8px; transition: background 0.2s; }
    .btn-proses:hover { background-color: var(--biru); }
    .btn-reset { background: #fff; color: #555; border: 1px solid #ccc; padding: 10px 20px; border-radius: 5px; font-size: 0.9rem; cursor: pointer; display: inline-flex; align-items: center; gap: 6px; }
    .btn-reset:hover { background: #f0f0f0; }
    .kategori-label { font-size: 0.78rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; color: #888; margin-top: 12px; margin-bottom: 0; padding: 12px 0 4px; }
    @media (max-width: 576px) { .gejala-row { grid-template-columns: 1fr; } .page-header h1 { font-size: 1.3rem; } }
</style>
@endpush

@section('content')
<div class="page-header">
    <div class="container">
        <span class="step-badge"><i class="bi bi-2-circle me-1"></i> Langkah 2 dari 2</span>
        <h1>Konsultasi Kelenjar Getah Bening</h1>
        <p>Isi kuesioner gejala di bawah ini untuk mendapatkan analisis awal penyakit kelenjar getah bening. Hasil bersifat informatif, bukan pengganti diagnosa dokter.</p>
    </div>
</div>

<div class="container py-4">
    <div class="row">
        <div class="col-lg-8">

            @if(session('info'))
                <div class="alert alert-info"><i class="bi bi-info-circle me-2"></i>{{ session('info') }}</div>
            @endif

            <div class="info-box">
                <i class="bi bi-info-circle-fill"></i>
                <div>Pilih <strong>tingkat keyakinan</strong> Anda terhadap gejala yang Anda rasakan. Pilih minimal <strong>satu gejala</strong> sebelum menekan tombol Analisis. Gejala yang tidak Anda rasakan tidak perlu dipilih.</div>
            </div>

            <div class="form-card">
                <div class="form-card-header">
                    <i class="bi bi-clipboard2-check"></i> Form Isian Gejala
                </div>
                <div class="form-card-body">
                    <form id="formDiagnosa" method="POST" action="{{ route('konsultasi.proses') }}">
                        @csrf

                        @foreach($gejalas as $idx => $gejala)
                        <div class="gejala-row">
                            <div class="gejala-label">
                                <span class="gejala-no">{{ $loop->iteration }}</span>
                                <div>
                                    <div class="gejala-nama">{{ $gejala->nama }}</div>
                                    <div class="gejala-desc">Kode: {{ $gejala->kode }}</div>
                                </div>
                            </div>
                            <select class="form-select-custom" name="gejala_{{ $gejala->id }}">
                                <option value="" selected disabled>-- Pilih --</option>
                                <option value="1" {{ old('gejala_'.$gejala->id) == '1' ? 'selected' : '' }}>Sangat Yakin</option>
                                <option value="0.8" {{ old('gejala_'.$gejala->id) == '0.8' ? 'selected' : '' }}>Yakin</option>
                                <option value="0.4" {{ old('gejala_'.$gejala->id) == '0.4' ? 'selected' : '' }}>Cukup yakin</option>
                                <option value="0.2" {{ old('gejala_'.$gejala->id) == '0.2' ? 'selected' : '' }}>Tidak yakin</option>
                            </select>
                        </div>
                        @endforeach

                        <div class="py-3 d-flex gap-2 flex-wrap">
                            <button type="submit" class="btn-proses">
                                <i class="bi bi-play-circle"></i> Mulai Analisis
                            </button>
                            <button type="reset" class="btn-reset">
                                <i class="bi bi-arrow-counterclockwise"></i> Reset
                            </button>
                        </div>

                        @if(session('error'))
                        <div style="color:#c0392b;font-size:0.85rem;margin-bottom:12px;">
                            <i class="bi bi-exclamation-circle me-1"></i> {{ session('error') }}
                        </div>
                        @endif

                        @if($errors->any())
                        <div style="color:#c0392b;font-size:0.85rem;margin-bottom:12px;">
                            <i class="bi bi-exclamation-circle me-1"></i> Pilih minimal satu gejala yang Anda rasakan sebelum melanjutkan.
                        </div>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="form-card">
                <div class="form-card-header" style="background:#4a5568;">
                    <i class="bi bi-question-circle"></i> Petunjuk Pengisian
                </div>
                <div class="p-3" style="font-size:0.85rem;color:#444;line-height:1.7;">
                    <p><strong>Sangat Yakin</strong><br>Gejala ini jelas Anda rasakan dan sudah dipastikan.</p>
                    <p><strong>Yakin</strong><br>Gejala ini Anda rasakan dengan cukup pasti.</p>
                    <p><strong>Cukup yakin</strong><br>Gejala ini Anda rasakan, namun masih agak ragu.</p>
                    <p class="mb-0"><strong>Tidak yakin</strong><br>Gejala ini Anda rasakan tapi sangat ragu.</p>
                </div>
            </div>

            <div class="form-card mt-3">
                <div class="form-card-header" style="background:#4a5568;">
                    <i class="bi bi-book"></i> Tentang Metode
                </div>
                <div class="p-3" style="font-size:0.85rem;color:#444;line-height:1.7;">
                    <p>Sistem ini menggunakan metode <strong>Forward Chaining</strong> untuk menelusuri aturan-aturan logika berbasis gejala, dikombinasikan dengan <strong>Certainty Factor (CF)</strong> untuk mengukur tingkat kepastian setiap kemungkinan penyakit.</p>
                    <p class="mb-0">Hasil yang ditampilkan merupakan kalkulasi berdasarkan nilai CF Pakar yang telah dimasukkan oleh dokter ke dalam sistem.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
