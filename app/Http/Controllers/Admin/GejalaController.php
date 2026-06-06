<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gejala;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class GejalaController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->get('search', '');
        $kategori = $request->get('kategori', '');

        $gejalas = Gejala::when($search, fn($q) => $q->where(function($q2) use ($search) {
                $q2->where('nama', 'like', "%{$search}%")->orWhere('kode', 'like', "%{$search}%");
            }))
            ->when($kategori, fn($q) => $q->where('kategori', $kategori))
            ->orderBy('kode')
            ->paginate(10)
            ->withQueryString();

        $penyakits = Penyakit::orderBy('nama')->get();

        return view('admin.gejala.index', compact('gejalas', 'search', 'kategori', 'penyakits'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'     => 'required|string|max:10|unique:gejalas,kode',
            'nama'     => 'required|string|max:200',
            'kategori' => 'required|string|max:100',
        ], [
            'kode.unique' => 'Kode gejala sudah digunakan.',
        ]);

        Gejala::create($request->only('kode', 'nama', 'kategori'));
        return back()->with('success', 'Data gejala berhasil ditambahkan.');
    }

    public function update(Request $request, Gejala $gejala)
    {
        $request->validate([
            'kode'     => 'required|string|max:10|unique:gejalas,kode,' . $gejala->id,
            'nama'     => 'required|string|max:200',
            'kategori' => 'required|string|max:100',
        ]);

        $gejala->update($request->only('kode', 'nama', 'kategori'));
        return back()->with('success', 'Data gejala berhasil diperbarui.');
    }

    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return back()->with('success', 'Data gejala berhasil dihapus.');
    }
}
