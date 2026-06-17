<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;

class BerandaController extends Controller
{
    public function index()
    {
        $penyakits = Penyakit::orderBy('nama')->where('nama', 'not like', '%limfoma%')->get();
        return view('publik.beranda', compact('penyakits'));
    }
}

