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

        $gejalas = Gejala::when($search, fn($q) => $q->where(function($q2) use ($search) {
                $q2->where('nama', 'like', "%{$search}%")->orWhere('kode', 'like', "%{$search}%");
            }))
            ->orderBy('kode')
            ->paginate(10)
            ->withQueryString();

        return view('admin.gejala.index', compact('gejalas', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode'     => 'required|string|max:10|unique:gejalas,kode',
            'nama'     => 'required|string|max:200',
        ], [
            'kode.unique' => 'Kode gejala sudah digunakan.',
        ]);

        Gejala::create($request->only('kode', 'nama'));
        return back()->with('success', 'Data gejala berhasil ditambahkan.');
    }

    public function update(Request $request, Gejala $gejala)
    {
        $request->validate([
            'kode'     => 'required|string|max:10|unique:gejalas,kode,' . $gejala->id,
            'nama'     => 'required|string|max:200',
        ]);

        $gejala->update($request->only('kode', 'nama'));
        return back()->with('success', 'Data gejala berhasil diperbarui.');
    }

    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return back()->with('success', 'Data gejala berhasil dihapus.');
    }
}
