<?php

namespace App\Http\Controllers;

use App\Models\Penyakit;

class InfoController extends Controller
{
    public function index()
    {
        $penyakits = Penyakit::all();
        return view('publik.info', compact('penyakits'));
    }
}
