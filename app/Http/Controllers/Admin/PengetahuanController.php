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

        $rules = Rule::select('rules.*')
            ->join('penyakits', 'penyakits.id', '=', 'rules.penyakit_id')
            ->join('gejalas', 'gejalas.id', '=', 'rules.gejala_id')
            ->with(['penyakit', 'gejala'])
            ->when($penyakitFilter, fn($q) => $q->where('rules.penyakit_id', $penyakitFilter))
            ->when($search, fn($q) => $q->where('gejalas.nama', 'like', "%{$search}%"))
            ->orderBy('penyakits.nama')
            ->orderBy('gejalas.kode')
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

    public function getRulesByPenyakit(Penyakit $penyakit)
    {
        return response()->json($penyakit->rules()->pluck('mb', 'gejala_id'));
    }

    public function storeBulk(Request $request)
    {
        $request->validate([
            'penyakit_id' => 'required|exists:penyakits,id',
            'gejala_id'   => 'nullable|array',
            'gejala_id.*' => 'exists:gejalas,id',
            'mb'          => 'nullable|array',
        ]);

        $penyakitId = $request->penyakit_id;
        $gejalaIds = $request->gejala_id ?? [];
        $mbValues = $request->mb ?? [];

        // Hapus rule lama untuk penyakit ini agar direplace dengan yang baru dipilih
        Rule::where('penyakit_id', $penyakitId)->delete();

        foreach ($gejalaIds as $gId) {
            $mb = floatval($mbValues[$gId] ?? 0);
            $md = 1 - $mb;
            
            Rule::create([
                'penyakit_id' => $penyakitId,
                'gejala_id'   => $gId,
                'mb'          => $mb,
                'md'          => $md,
            ]);
        }

        return back()->with('success', 'Basis pengetahuan berhasil diatur secara massal.');
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
