<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;

class InfoController extends Controller
{
    public function index()
    {
        $penyakits = Penyakit::orderBy('nama')->where('nama', 'not like', '%limfoma%')->get();
        return view('publik.info', compact('penyakits'));
    }
}
