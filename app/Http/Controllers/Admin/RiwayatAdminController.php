<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Riwayat;
use Illuminate\Http\Request;

class RiwayatAdminController extends Controller
{
    public function index(Request $request)
    {
        $search    = $request->get('search', '');
        $diagnosis = $request->get('diagnosis', '');
        $tanggal   = $request->get('tanggal', '');

        $riwayats = Riwayat::when($search, fn($q) => $q->where('kode_sesi', 'like', "%{$search}%"))
            ->when($diagnosis, fn($q) => $q->where('diagnosis_utama', $diagnosis))
            ->when($tanggal, fn($q) => $q->whereDate('created_at', $tanggal))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $diagnosisList = Riwayat::selectRaw('diagnosis_utama')->distinct()->pluck('diagnosis_utama')->filter()->sort();

        return view('admin.riwayat.index', compact('riwayats', 'diagnosisList', 'search', 'diagnosis', 'tanggal'));
    }

    public function show(Riwayat $riwayat)
    {
        return response()->json($riwayat);
    }

    public function destroy(Riwayat $riwayat)
    {
        $riwayat->delete();
        return back()->with('success', 'Riwayat konsultasi berhasil dihapus.');
    }
}
