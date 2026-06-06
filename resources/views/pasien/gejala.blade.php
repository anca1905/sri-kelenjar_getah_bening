@extends('layouts.pasien')

@section('content')
<div class="card">
    <div style="background: #f8fafc; padding: 15px; border-radius: 8px; margin-bottom: 2rem; border-left: 4px solid var(--public-primary);">
        <table style="width: 100%; font-size: 0.95rem;">
            <tr><td style="width: 150px; font-weight: bold;">Nama Pasien</td><td>: {{ request('nama') }}</td></tr>
            <tr><td style="font-weight: bold;">Umur</td><td>: {{ request('umur') }} Tahun</td></tr>
            <tr><td style="font-weight: bold;">Jenis Kelamin</td><td>: {{ request('jk') == 'L' ? 'Laki-laki' : 'Perempuan' }}</td></tr>
        </table>
    </div>

    <h3 style="margin-bottom: 1rem; color: var(--public-dark);">Pilih Gejala:</h3>
    <form action="{{ url('/pasien/hasil') }}" method="POST">
        @csrf
        <input type="hidden" name="nama" value="{{ request('nama') }}">
        <input type="hidden" name="umur" value="{{ request('umur') }}">
        <input type="hidden" name="jk" value="{{ request('jk') }}">

        <div style="display: flex; flex-direction: column; gap: 10px;">
            <label class="checkbox-card"><input type="checkbox" name="gejala[]" value="G001"> Pembengkakan di leher</label>
            <label class="checkbox-card"><input type="checkbox" name="gejala[]" value="G002"> Nyeri saat ditekan</label>
            <label class="checkbox-card"><input type="checkbox" name="gejala[]" value="G003"> Demam</label>
            <label class="checkbox-card"><input type="checkbox" name="gejala[]" value="G016"> Benjolan keras</label>
            <label class="checkbox-card"><input type="checkbox" name="gejala[]" value="G005"> Berat badan turun</label>
            <label class="checkbox-card"><input type="checkbox" name="gejala[]" value="G017"> Mudah lelah</label>
            <label class="checkbox-card"><input type="checkbox" name="gejala[]" value="G006"> Jantung berdebar</label>
            <label class="checkbox-card"><input type="checkbox" name="gejala[]" value="G004"> Sakit tenggorokan</label>
        </div>

        <div style="text-align: right; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Proses <i class="fa-solid fa-gears"></i></button>
        </div>
    </form>
</div>
@endsection