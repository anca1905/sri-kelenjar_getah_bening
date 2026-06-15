<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rule;
use App\Models\Penyakit;
use App\Models\Gejala;
use Illuminate\Http\Request;

class PengetahuanController extends Controller
{
    public function index(Request $request)
    {
        $search   = $request->get('search', '');
        $penyakitFilter = $request->get('penyakit_id', '');

        $rules = Rule::with(['penyakit', 'gejala'])
            ->when($penyakitFilter, fn($q) => $q->where('penyakit_id', $penyakitFilter))
            ->when($search, fn($q) => $q->whereHas('gejala', fn($q2) => $q2->where('nama', 'like', "%{$search}%")))
            ->paginate(10)
            ->withQueryString();

        $penyakits = Penyakit::orderBy('nama')->get();
        $gejalas   = Gejala::orderBy('kode')->get();

        return view('admin.pengetahuan.index', compact('rules', 'penyakits', 'gejalas', 'search', 'penyakitFilter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penyakit_id' => 'required|exists:penyakits,id',
            'gejala_id'   => 'required|exists:gejalas,id',
            'mb'          => 'required|numeric|min:0|max:1',
            'md'          => 'required|numeric|min:0|max:1',
        ], [
            'penyakit_id.required' => 'Penyakit wajib dipilih.',
            'gejala_id.required'   => 'Gejala wajib dipilih.',
        ]);

        // Check for duplicate
        $exists = Rule::where('penyakit_id', $request->penyakit_id)
            ->where('gejala_id', $request->gejala_id)->exists();
        if ($exists) {
            return back()->withErrors(['aturan' => 'Aturan untuk pasangan penyakit dan gejala ini sudah ada.']);
        }

        $data = $request->only('penyakit_id', 'gejala_id', 'mb', 'md');
        Rule::create($data);
        return back()->with('success', 'Aturan CF berhasil ditambahkan.');
    }

    public function update(Request $request, Rule $rule)
    {
        $request->validate([
            'penyakit_id' => 'required|exists:penyakits,id',
            'gejala_id'   => 'required|exists:gejalas,id',
            'mb'          => 'required|numeric|min:0|max:1',
            'md'          => 'required|numeric|min:0|max:1',
        ]);

        $data = $request->only('penyakit_id', 'gejala_id', 'mb', 'md');
        $rule->update($data);
        return back()->with('success', 'Aturan CF berhasil diperbarui.');
    }

    public function destroy(Rule $rule)
    {
        $rule->delete();
        return back()->with('success', 'Aturan CF berhasil dihapus.');
    }
}
