<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Riwayat;
use App\Services\CertaintyFactorService;
use Illuminate\Http\Request;

class KonsultasiController extends Controller
{
    public function __construct(private CertaintyFactorService $cfService) {}

    public function biodata()
    {
        return view('publik.biodata');
    }

    public function simpanBiodata(Request $request)
    {
        $request->validate([
            'nama_pasien'   => 'required|string|max:255',
            'umur'          => 'required|integer|min:1|max:150',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        session([
            'biodata' => $request->only('nama_pasien', 'umur', 'jenis_kelamin')
        ]);

        return redirect()->route('konsultasi');
    }

    public function index()
    {
        if (!session()->has('biodata')) {
            return redirect()->route('konsultasi.biodata')->with('info', 'Silakan isi biodata terlebih dahulu sebelum memulai konsultasi.');
        }

        $gejalas = Gejala::orderBy('kode')->get()->groupBy('kategori');
        return view('publik.konsultasi', compact('gejalas'));
    }

    public function proses(Request $request)
    {
        // Validate that all gejala are answered
        $gejalas = Gejala::orderBy('kode')->get();
        $rules = [];
        foreach ($gejalas as $g) {
            $rules['gejala_' . $g->id] = 'required|numeric|min:0|max:1';
        }
        $request->validate($rules, array_fill_keys(
            array_map(fn($k) => $k . '.required', array_keys($rules)),
            'Semua gejala wajib diisi.'
        ));

        // Build gejala input: [gejala_id => cf_user]
        $gejalaInput = [];
        foreach ($gejalas as $g) {
            $gejalaInput[$g->id] = (float) $request->input('gejala_' . $g->id, 0);
        }

        // Run CF diagnosis
        $hasil = $this->cfService->diagnosa($gejalaInput);

        if (empty($hasil)) {
            return back()->with('info', 'Tidak ada penyakit yang terdeteksi berdasarkan gejala yang dimasukkan.')->withInput();
        }

        // Save to riwayat
        $kodeSesi = $this->cfService->generateKodeSesi();

        // Build detail gejala (for display)
        $detailGejala = [];
        foreach ($gejalas as $g) {
            $cfVal = $gejalaInput[$g->id];
            if ($cfVal > 0) {
                $label = match((string)$cfVal) {
                    '1'   => 'Sangat Yakin',
                    '0.8' => 'Yakin',
                    '0.4' => 'Mungkin',
                    default => 'Tidak Ada'
                };
                $detailGejala[] = ['kode' => $g->kode, 'nama' => $g->nama, 'cf_user' => $cfVal, 'label' => $label];
            }
        }

        // Build detail hasil
        $detailHasil = array_map(fn($h) => [
            'penyakit'  => $h['penyakit']->nama,
            'cf'        => $h['cf'],
            'cf_persen' => $h['cf_persen'],
            'deskripsi' => $h['penyakit']->deskripsi,
            'solusi'    => $h['penyakit']->solusi,
        ], $hasil);

        $biodata = session('biodata', []);
        Riwayat::create([
            'kode_sesi'       => $kodeSesi,
            'nama_pasien'     => $biodata['nama_pasien'] ?? 'Anonim',
            'umur'            => $biodata['umur'] ?? null,
            'jenis_kelamin'   => $biodata['jenis_kelamin'] ?? null,
            'diagnosis_utama' => $hasil[0]['penyakit']->nama,
            'nilai_cf'        => $hasil[0]['cf'],
            'detail_hasil'    => $detailHasil,
            'detail_gejala'   => $detailGejala,
        ]);

        // Opsional: Hapus sesi biodata jika ingin satu kali pakai
        // session()->forget('biodata');

        // Pass hasil to view
        return view('publik.hasil', compact('hasil', 'kodeSesi', 'detailGejala'));
    }
}