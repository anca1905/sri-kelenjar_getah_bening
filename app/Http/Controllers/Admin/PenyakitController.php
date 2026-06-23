<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penyakit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.unique' => 'Nama penyakit sudah terdaftar.',
        ]);

        $data = $request->only('nama', 'deskripsi', 'solusi');

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('penyakit_fotos', 'public');
        }

        Penyakit::create($data);
        return back()->with('success', 'Data penyakit berhasil ditambahkan.');
    }

    public function update(Request $request, Penyakit $penyakit)
    {
        $request->validate([
            'nama'     => 'required|string|max:100|unique:penyakits,nama,' . $penyakit->id,
            'deskripsi'=> 'required|string',
            'solusi'   => 'required|string',
            'foto'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('nama', 'deskripsi', 'solusi');

        if ($request->hasFile('foto')) {
            if ($penyakit->foto) {
                Storage::disk('public')->delete($penyakit->foto);
            }
            $data['foto'] = $request->file('foto')->store('penyakit_fotos', 'public');
        }

        $penyakit->update($data);
        return back()->with('success', 'Data penyakit berhasil diperbarui.');
    }

    public function destroy(Penyakit $penyakit)
    {
        if ($penyakit->foto) {
            Storage::disk('public')->delete($penyakit->foto);
        }
        $penyakit->delete();
        return back()->with('success', 'Data penyakit berhasil dihapus.');
    }
}
