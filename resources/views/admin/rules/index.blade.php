@extends('layouts.admin')

@section('content')
<div class="card">
    <div style="display: flex; justify-content: space-between; margin-bottom: 1.5rem; align-items: center;">
        <h2 class="page-title">Basis Aturan / Rule</h2>
        <button class="btn btn-primary">+ Tambah Rule Baru</button>
    </div>
    <div class="table-wrapper">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Penyakit</th>
                    <th>Gejala yang Berkaitan</th>
                    <th>Nilai CF Pakar (MB - MD)</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dummy Data -->
                <tr>
                    <td>1</td>
                    <td><strong>P001</strong> - Limfadenitis</td>
                    <td><strong>G001</strong> - Benjolan di leher</td>
                    <td>0.8</td>
                    <td>
                        <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">Edit</button>
                        <button class="btn" style="background: #fee2e2; color: #ef4444; padding: 5px 10px; font-size: 0.8rem; border-radius: 8px;">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>P001</strong> - Limfadenitis</td>
                    <td><strong>G002</strong> - Nyeri saat ditekan</td>
                    <td>0.6</td>
                    <td>
                        <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">Edit</button>
                        <button class="btn" style="background: #fee2e2; color: #ef4444; padding: 5px 10px; font-size: 0.8rem; border-radius: 8px;">Hapus</button>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><strong>P003</strong> - Limfoma</td>
                    <td><strong>G005</strong> - Berat badan menurun</td>
                    <td>0.75</td>
                    <td>
                        <button class="btn btn-outline" style="padding: 5px 10px; font-size: 0.8rem;">Edit</button>
                        <button class="btn" style="background: #fee2e2; color: #ef4444; padding: 5px 10px; font-size: 0.8rem; border-radius: 8px;">Hapus</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
