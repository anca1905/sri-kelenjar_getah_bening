@extends('layouts.pasien')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem; align-items: center;">
        <h2 class="page-title">Riwayat Konsultasi Saya</h2>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Penyakit Hasil Diagnosis</th>
                    <th>Persentase Keyakinan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dummy Data -->
                <tr>
                    <td>10 Mei 2026</td>
                    <td><strong>P001</strong> - Limfadenitis</td>
                    <td>85.5%</td>
                    <td><span class="status-badge status-success">Selesai</span></td>
                    <td>
                        <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">Detail</button>
                    </td>
                </tr>
                <tr>
                    <td>01 Mei 2026</td>
                    <td><strong>P005</strong> - Tonsilitis</td>
                    <td>78.2%</td>
                    <td><span class="status-badge status-success">Selesai</span></td>
                    <td>
                        <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">Detail</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
