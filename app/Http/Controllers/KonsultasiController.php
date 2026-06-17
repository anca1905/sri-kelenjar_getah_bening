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

    public function updateBiodata(Request $request, $kodeSesi)
    {
        $request->validate([
            'nama_pasien'   => 'required|string|max:255',
            'umur'          => 'required|integer|min:1|max:150',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        $riwayat = Riwayat::where('kode_sesi', $kodeSesi)->first();
        if ($riwayat) {
            $riwayat->update($request->only('nama_pasien', 'umur', 'jenis_kelamin'));
        }

        session([
            'biodata' => $request->only('nama_pasien', 'umur', 'jenis_kelamin')
        ]);

        return response()->json([
            'success' => true,
            'data' => $request->only('nama_pasien', 'umur', 'jenis_kelamin')
        ]);
    }

    public function index()
    {
        if (!session()->has('biodata')) {
            return redirect()->route('konsultasi.biodata')->with('info', 'Silakan isi biodata terlebih dahulu sebelum memulai konsultasi.');
        }

        $gejalas = Gejala::orderBy('kode')->get();
        return view('publik.konsultasi', compact('gejalas'));
    }

    public function proses(Request $request)
    {
        // Kumpulkan semua gejala yang ada
        $gejalas = Gejala::orderBy('kode')->get();

        // Validasi minimal ada 1 gejala yang dipilih (nilai > 0)
        $gejalaInput = [];
        foreach ($gejalas as $g) {
            $val = $request->input('gejala_' . $g->id);
            $gejalaInput[$g->id] = ($val !== null && $val !== '') ? (float) $val : 0.0;
        }

        $adaGejala = collect($gejalaInput)->contains(fn($v) => $v > 0);
        if (!$adaGejala) {
            return back()->with('error', 'Pilih minimal satu gejala yang Anda rasakan sebelum melanjutkan.')->withInput();
        }

        // Jalankan diagnosa CF
        $hasil = $this->cfService->diagnosa($gejalaInput);

        if (empty($hasil)) {
            return back()->with('info', 'Tidak ada penyakit yang terdeteksi berdasarkan gejala yang dimasukkan.')->withInput();
        }

        $kodeSesi = $this->cfService->generateKodeSesi();

        // Detail gejala yang dipilih (untuk tampilan hasil)
        $detailGejala = [];
        foreach ($gejalas as $g) {
            $cfVal = $gejalaInput[$g->id];
            if ($cfVal > 0) {
                $label = match((string)$cfVal) {
                    '1'   => 'Sangat Yakin',
                    '0.8' => 'Yakin',
                    '0.4' => 'Cukup yakin',
                    '0.2' => 'Tidak yakin',
                    default => 'Tidak Ada'
                };
                $detailGejala[] = ['kode' => $g->kode, 'nama' => $g->nama, 'cf_user' => $cfVal, 'label' => $label];
            }
        }

        // Detail hasil diagnosa
        $detailHasil = array_map(fn($h) => [
            'penyakit'  => $h['penyakit']->nama,
            'cf'        => $h['cf'],
            'cf_persen' => $h['cf_persen'],
            'deskripsi' => $h['penyakit']->deskripsi,
            'solusi'    => $h['penyakit']->solusi,
        ], $hasil);

        // Simpan ke riwayat
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

        return view('publik.hasil', compact('hasil', 'kodeSesi', 'detailGejala'));
    }
}