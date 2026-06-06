@extends('layouts.pasien')

@section('content')
<div class="card">
    <div style="text-align: center; margin-bottom: 2rem;">
        <div style="width: 60px; height: 60px; background: #d1fae5; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; color: #059669; margin-bottom: 1rem;">
            <i class="fa-solid fa-check-double" style="font-size: 1.5rem;"></i>
        </div>
        <h2 style="color: var(--text-dark);">Hasil Diagnosis</h2>
    </div>

    @if($hasil_akhir)
        <div style="display: flex; justify-content: space-between; border-bottom: 1px solid #e2e8f0; padding-bottom: 1rem; margin-bottom: 1.5rem;">
            <div>
                <small style="text-transform: uppercase; color: #94a3b8; font-weight: bold;">Nama Pasien</small>
                <div style="font-size: 1.1rem; font-weight: bold; color: var(--text-dark);">{{ request('nama') }}</div>
            </div>
            <div style="text-align: right;">
                <small style="text-transform: uppercase; color: #94a3b8; font-weight: bold;">Umur</small>
                <div style="font-size: 1.1rem; font-weight: bold; color: var(--text-dark);">{{ request('umur') }} Tahun</div>
            </div>
        </div>

        <div style="display: flex; gap: 2rem; align-items: center; flex-wrap: wrap;">
            <div style="position: relative; width: 150px; height: 150px; flex-shrink: 0; margin: 0 auto;">
                <svg width="150" height="150" style="transform: rotate(-90deg);">
                    <circle cx="75" cy="75" r="65" stroke="#f1f5f9" stroke-width="12" fill="transparent" />
                    <circle cx="75" cy="75" r="65" stroke="var(--public-primary)" stroke-width="12" fill="transparent" 
                            stroke-dasharray="408" stroke-dashoffset="{{ 408 - (408 * $hasil_akhir['persentase'] / 100) }}" stroke-linecap="round" />
                </svg>
                <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                    <span style="font-size: 1.5rem; font-weight: bold; color: var(--text-dark);">{{ $hasil_akhir['persentase'] }}%</span>
                    <small style="color: #94a3b8;">Keyakinan</small>
                </div>
            </div>

            <div style="flex: 1;">
                <p style="color: var(--public-primary); font-weight: 600; margin-bottom: 0.2rem;">Kemungkinan Penyakit:</p>
                <h3 style="font-size: 1.8rem; margin-bottom: 1rem; color: var(--text-dark); text-transform: uppercase;">
                    {{ $hasil_akhir['nama_penyakit'] }}
                </h3>
                
                <div style="background: #f8fafc; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                    <p style="font-weight: bold; margin-bottom: 0.5rem; font-size: 0.9rem;">Gejala yang dialami:</p>
                    <ul style="padding-left: 1.2rem; color: var(--text-light); font-size: 0.9rem; list-style-type: disc;">
                        @foreach($hasil_akhir['gejala_cocok'] as $gj)
                            <li>{{ $gejala }}</li>
                        @endforeach
                    </ul>
                </div>

                <div style="background: #fffbeb; border: 1px solid #fcd34d; padding: 1rem; border-radius: 12px; display: flex; gap: 10px;">
                    <i class="fa-solid fa-triangle-exclamation" style="color: #d97706; font-size: 1.2rem; mt-1"></i>
                    <div>
                        <strong style="display: block; color: #b45309; font-size: 0.85rem; text-transform: uppercase;">Saran Sistem:</strong>
                        <span style="color: #78350f; font-size: 0.95rem;">{{ $hasil_akhir['saran'] }}</span>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div style="text-align: center; color: #ef4444; font-weight: bold; margin-top: 2rem;">
            Tidak ada penyakit yang cocok dengan gejala yang Anda pilih.
        </div>
    @endif

    <div style="text-align: center; margin-top: 2rem; border-top: 1px solid #e2e8f0; padding-top: 1.5rem;">
        <a href="{{ url('/pasien/konsultasi') }}" class="btn btn-outline" style="margin-right: 10px;">Konsultasi Ulang</a>
        <a href="{{ url('/') }}" class="btn btn-primary">Selesai</a>
    </div>
</div>
@endsection