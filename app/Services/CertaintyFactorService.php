<?php

namespace App\Services;

use App\Models\Rule;
use App\Models\Penyakit;

class CertaintyFactorService
{
    /**
     * Combine two CF values using the CF combination formula:
     * CF(A,B) = CF(A) + CF(B) * (1 - CF(A))  for positive values
     */
    private function kombinasiCF(float $cfLama, float $cfBaru): float
    {
        if ($cfLama == 0) return $cfBaru;
        if ($cfBaru == 0) return $cfLama;
        return $cfLama + $cfBaru * (1 - $cfLama);
    }

    /**
     * Run the diagnosis:
     * $gejalaInput is an associative array: ['gejala_id' => cf_user_value]
     * Returns array of ['penyakit' => Penyakit, 'cf' => float] sorted by CF desc
     */
    public function diagnosa(array $gejalaInput): array
    {
        // Load all rules with their relationships
        $rules = Rule::with(['penyakit', 'gejala'])->get();

        $cfPerPenyakit = []; // penyakit_id => cf_combined

        foreach ($rules as $rule) {
            $gejalaId = $rule->gejala_id;
            $cfUser = $gejalaInput[$gejalaId] ?? 0;

            if ($cfUser <= 0) continue;

            // CF combined = CF_pakar * CF_user
            $cfPakar = round($rule->mb - $rule->md, 3);
            $cfGabung = $cfPakar * $cfUser;

            if ($cfGabung == 0) continue;

            $pid = $rule->penyakit_id;
            if (!isset($cfPerPenyakit[$pid])) {
                $cfPerPenyakit[$pid] = 0;
            }
            $cfPerPenyakit[$pid] = $this->kombinasiCF($cfPerPenyakit[$pid], $cfGabung);
        }

        // Build result array with Penyakit objects
        $hasil = [];
        foreach ($cfPerPenyakit as $pid => $cf) {
            if ($cf > 0) {
                $penyakit = Penyakit::find($pid);
                if ($penyakit) {
                    $hasil[] = [
                        'penyakit'   => $penyakit,
                        'cf'         => round($cf, 4),
                        'cf_persen'  => round($cf * 100),
                    ];
                }
            }
        }

        // Sort by CF descending
        usort($hasil, fn($a, $b) => $b['cf'] <=> $a['cf']);

        return $hasil;
    }

    /**
     * Generate a unique session code: KGB-YYYYMMDD-XXX
     */
    public function generateKodeSesi(): string
    {
        $tanggal = now()->format('Ymd');
        $count = \App\Models\Riwayat::whereDate('created_at', today())->count() + 1;
        return 'KGB-' . $tanggal . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}
