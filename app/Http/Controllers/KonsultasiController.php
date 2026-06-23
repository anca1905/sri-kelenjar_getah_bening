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

        // Validasi minimal ada 3 gejala yang dipilih
        $gejalaInput = [];
        foreach ($gejalas as $g) {
            $val = $request->input('gejala_' . $g->id);
            // Bobot user adalah 1.0 jika dicentang, 0.0 jika tidak
            $gejalaInput[$g->id] = ($val !== null && $val == '1') ? 1.0 : 0.0;
        }

        $jumlahGejalaDipilih = collect($gejalaInput)->filter(fn($v) => $v > 0)->count();
        if ($jumlahGejalaDipilih < 3) {
            return back()->with('error', 'Pilih minimal tiga gejala yang Anda rasakan sebelum melanjutkan.')->withInput();
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
                $label = 'Dicentang';
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
            'foto'      => $h['penyakit']->foto,
        ], $hasil);

        // Simpan ke riwayat
        $biodata = session('biodata', []);
        Riwayat::create([
            'kode_sesi'       => $kodeSesi,
            'nama_pasien'     => $biodata['nama_pasien'] ?? 'Anonim',
            'umur'            => $biodata['umur'] ?? null,
            'jenis_kelamin'   => $biodata['jenis_kelamin'] ?? null,
            'penyakit_id'     => $hasil[0]['penyakit']->id,
            'diagnosis_utama' => $hasil[0]['penyakit']->nama,
            'nilai_cf'        => $hasil[0]['cf'],
            'detail_hasil'    => $detailHasil,
            'detail_gejala'   => $detailGejala,
        ]);

        return view('publik.hasil', compact('hasil', 'kodeSesi', 'detailGejala'));
    }
}