@extends('layouts.pasien')

@section('content')
<div class="card">
    <h3 style="margin-bottom: 1.5rem; color: var(--public-dark); border-bottom: 1px solid var(--border-color); padding-bottom: 10px;">
        <i class="fa-solid fa-user-pen"></i> Form Data Pasien
    </h3>

    <form action="{{ url('/pasien/gejala') }}" method="GET">
        <div class="form-group">
            <label class="form-label">Nama Pasien :</label>
            <input type="text" name="nama" class="form-input" placeholder="Masukkan nama..." required>
        </div>

        <div class="form-group">
            <label class="form-label">Umur (Tahun) :</label>
            <input type="number" name="umur" class="form-input" placeholder="Contoh: 25" required>
        </div>

        <div class="form-group">
            <label class="form-label">Jenis Kelamin :</label>
            <div style="display: flex; gap: 20px; margin-top: 10px;">
                <label style="cursor: pointer;"><input type="radio" name="jk" value="L" required> Laki-laki</label>
                <label style="cursor: pointer;"><input type="radio" name="jk" value="P" required> Perempuan</label>
            </div>
        </div>

        <div style="text-align: right; margin-top: 2rem;">
            <button type="submit" class="btn btn-primary">Lanjut Konsultasi <i class="fa-solid fa-arrow-right"></i></button>
        </div>
    </form>
</div>
@endsection