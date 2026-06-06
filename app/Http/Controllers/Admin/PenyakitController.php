<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;

class PenyakitController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search', '');
        $penyakits = Penyakit::when($search, fn($q) => $q->where('nama', 'like', "%{$search}%"))
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        return view('admin.penyakit.index', compact('penyakits', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:100|unique:penyakits,nama',
            'deskripsi'=> 'required|string',
            'solusi'   => 'required|string',
        ], [
            'nama.unique' => 'Nama penyakit sudah terdaftar.',
        ]);

        Penyakit::create($request->only('nama', 'deskripsi', 'solusi'));
        return back()->with('success', 'Data penyakit berhasil ditambahkan.');
    }

    public function update(Request $request, Penyakit $penyakit)
    {
        $request->validate([
            'nama'     => 'required|string|max:100|unique:penyakits,nama,' . $penyakit->id,
            'deskripsi'=> 'required|string',
            'solusi'   => 'required|string',
        ]);

        $penyakit->update($request->only('nama', 'deskripsi', 'solusi'));
        return back()->with('success', 'Data penyakit berhasil diperbarui.');
    }

    public function destroy(Penyakit $penyakit)
    {
        $penyakit->delete();
        return back()->with('success', 'Data penyakit berhasil dihapus.');
    }
}
