<?php

namespace App\Http\Controllers;

use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatPublikController extends Controller
{
    public function index()
    {
        $riwayats = Riwayat::latest()->paginate(10);
        return view('publik.riwayat', compact('riwayats'));
    }
}
