<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Penyakit;
use App\Models\Gejala;
use App\Models\Riwayat;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Mengambil jumlah data asli dari database
        $total_penyakit = Penyakit::count();
        $total_gejala = Gejala::count();
        $total_riwayat = Riwayat::count();

        // Mengirim data ke halaman view dashboard
        return view('admin.dashboard', compact('total_penyakit', 'total_gejala', 'total_riwayat'));
    }

    public function penyakit()
    {
        return view('admin.penyakit.index');
    }

    public function gejala()
    {
        return view('admin.gejala.index');
    }

    public function rules()
    {
        return view('admin.rules.index');
    }

    public function riwayat()
    {
        return view('admin.riwayat.index');
    }
}