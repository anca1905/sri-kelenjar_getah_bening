<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Rule;
use App\Models\Riwayat;

class DashboardController extends Controller
{
    public function index()
    {
        $total_penyakit = Penyakit::count();
        $total_gejala = Gejala::count();
        $total_riwayat = Riwayat::count();

        // Distribusi diagnosis (last 30 days)
        $distribusi = Riwayat::selectRaw('diagnosis_utama, COUNT(*) as jumlah')
            ->whereNotNull('diagnosis_utama')
            ->groupBy('diagnosis_utama')
            ->orderByDesc('jumlah')
            ->get();

        // Konsultasi 14 hari terakhir
        $konsultasiHarian = [];
        for ($i = 13; $i >= 0; $i--) {
            $tanggal = now()->subDays($i)->format('Y-m-d');
            $label   = now()->subDays($i)->isoFormat('D MMM');
            $konsultasiHarian[] = [
                'label'  => $label,
                'jumlah' => Riwayat::whereDate('created_at', $tanggal)->count(),
            ];
        }

        // Riwayat terbaru (5 terakhir)
        $riwayatTerbaru = Riwayat::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'total_penyakit',
            'total_gejala',
            'total_riwayat',
            'distribusi',
            'konsultasiHarian',
            'riwayatTerbaru'
        ));
    }
}
