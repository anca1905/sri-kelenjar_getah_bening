<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class RuleSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('rules')->truncate();

        $p = DB::table('penyakits')->pluck('id', 'nama');
        $g = DB::table('gejalas')->pluck('id', 'kode');

        $rules = [

            // =====================================================================
            // LIMFADENITIS
            // Gejala: G001-G015
            // =====================================================================
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G001'], 'mb' => 0.80, 'md' => 0.10], // Demam naik turun
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G002'], 'mb' => 0.90, 'md' => 0.05], // Benjolan di leher
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G003'], 'mb' => 0.70, 'md' => 0.10], // Teraba keras
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G004'], 'mb' => 0.85, 'md' => 0.05], // Nyeri saat ditekan
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G005'], 'mb' => 0.60, 'md' => 0.20], // Batuk
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G006'], 'mb' => 0.55, 'md' => 0.15], // Mual
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G007'], 'mb' => 0.50, 'md' => 0.20], // Muntah
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G008'], 'mb' => 0.80, 'md' => 0.05], // Benjolan tampak merah
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G009'], 'mb' => 0.50, 'md' => 0.20], // Pusing
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G010'], 'mb' => 0.75, 'md' => 0.10], // Nyeri menelan
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G011'], 'mb' => 0.55, 'md' => 0.15], // Sesak napas
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G012'], 'mb' => 0.65, 'md' => 0.15], // Badan lemas
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G013'], 'mb' => 0.85, 'md' => 0.05], // Luka bernanah
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G014'], 'mb' => 0.60, 'md' => 0.20], // Nafsu makan menurun
            ['penyakit_id' => $p['Limfadenitis'], 'gejala_id' => $g['G015'], 'mb' => 0.65, 'md' => 0.15], // Flu

            // =====================================================================
            // LIMFADENOPATI
            // Gejala: G001(demam), G018, G016, G017, G019-G028
            // =====================================================================
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G016'], 'mb' => 0.70, 'md' => 0.10], // Mulut tidak bisa dibuka
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G017'], 'mb' => 0.65, 'md' => 0.15], // Nyeri pada gigi
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G001'], 'mb' => 0.75, 'md' => 0.15], // Demam naik turun (shared)
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G018'], 'mb' => 0.85, 'md' => 0.05], // Benjolan di leher tidak nyeri
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G019'], 'mb' => 0.60, 'md' => 0.15], // Batuk berdahak
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G020'], 'mb' => 0.50, 'md' => 0.20], // Muntah
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G021'], 'mb' => 0.60, 'md' => 0.15], // Nyeri perut
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G022'], 'mb' => 0.65, 'md' => 0.10], // Bengkak pada wajah
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G023'], 'mb' => 0.60, 'md' => 0.15], // Sesak napas berulang
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G024'], 'mb' => 0.70, 'md' => 0.10], // Penurunan berat badan
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G025'], 'mb' => 0.65, 'md' => 0.15], // Nafsu makan menurun berkepanjangan
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G026'], 'mb' => 0.55, 'md' => 0.15], // Sulit tidur
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G027'], 'mb' => 0.60, 'md' => 0.20], // Menggigil
            ['penyakit_id' => $p['Limfadenopati'], 'gejala_id' => $g['G028'], 'mb' => 0.65, 'md' => 0.10], // Kemerahan dan nyeri

            // =====================================================================
            // GONDOK
            // Gejala: G029-G037
            // =====================================================================
            ['penyakit_id' => $p['Gondok'], 'gejala_id' => $g['G029'], 'mb' => 0.95, 'md' => 0.05], // Benjolan pada leher terus membesar
            ['penyakit_id' => $p['Gondok'], 'gejala_id' => $g['G030'], 'mb' => 0.70, 'md' => 0.10], // Keringat berlebihan
            ['penyakit_id' => $p['Gondok'], 'gejala_id' => $g['G031'], 'mb' => 0.80, 'md' => 0.10], // Nyeri saat menelan
            ['penyakit_id' => $p['Gondok'], 'gejala_id' => $g['G032'], 'mb' => 0.55, 'md' => 0.20], // Muntah
            ['penyakit_id' => $p['Gondok'], 'gejala_id' => $g['G033'], 'mb' => 0.65, 'md' => 0.15], // Nyeri dada
            ['penyakit_id' => $p['Gondok'], 'gejala_id' => $g['G034'], 'mb' => 0.70, 'md' => 0.10], // Sesak nafas
            ['penyakit_id' => $p['Gondok'], 'gejala_id' => $g['G035'], 'mb' => 0.75, 'md' => 0.10], // Gemetar seluruh tubuh
            ['penyakit_id' => $p['Gondok'], 'gejala_id' => $g['G036'], 'mb' => 0.60, 'md' => 0.10], // Penurunan kesadaran
            ['penyakit_id' => $p['Gondok'], 'gejala_id' => $g['G037'], 'mb' => 0.55, 'md' => 0.20], // Mual berkepanjangan

            // =====================================================================
            // TONSILITIS
            // Gejala: G038-G045
            // =====================================================================
            ['penyakit_id' => $p['Tonsilitis'], 'gejala_id' => $g['G038'], 'mb' => 0.90, 'md' => 0.05], // Nyeri saat menelan makanan
            ['penyakit_id' => $p['Tonsilitis'], 'gejala_id' => $g['G039'], 'mb' => 0.80, 'md' => 0.10], // Demam berulang
            ['penyakit_id' => $p['Tonsilitis'], 'gejala_id' => $g['G040'], 'mb' => 0.70, 'md' => 0.15], // Hidung tersumbat
            ['penyakit_id' => $p['Tonsilitis'], 'gejala_id' => $g['G041'], 'mb' => 0.75, 'md' => 0.10], // Batuk berulang
            ['penyakit_id' => $p['Tonsilitis'], 'gejala_id' => $g['G042'], 'mb' => 0.65, 'md' => 0.15], // Flu berulang
            ['penyakit_id' => $p['Tonsilitis'], 'gejala_id' => $g['G043'], 'mb' => 0.55, 'md' => 0.20], // Muntah saat batuk
            ['penyakit_id' => $p['Tonsilitis'], 'gejala_id' => $g['G044'], 'mb' => 0.75, 'md' => 0.10], // Nyeri pada leher
            ['penyakit_id' => $p['Tonsilitis'], 'gejala_id' => $g['G045'], 'mb' => 0.85, 'md' => 0.05], // Nyeri menelan ludah

            // =====================================================================
            // LIMFOMA
            // Gejala: G046-G057
            // =====================================================================
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G046'], 'mb' => 0.85, 'md' => 0.05], // Lemas / kelelahan ekstrem
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G047'], 'mb' => 0.60, 'md' => 0.20], // Muntah
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G048'], 'mb' => 0.75, 'md' => 0.10], // Nafsu makan menurun drastis
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G049'], 'mb' => 0.90, 'md' => 0.05], // Benjolan tidak hilang
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G050'], 'mb' => 0.80, 'md' => 0.10], // Demam naik turun berkepanjangan
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G051'], 'mb' => 0.65, 'md' => 0.15], // Batuk berdahak terus-menerus
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G052'], 'mb' => 0.60, 'md' => 0.15], // Flu tak kunjung sembuh
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G053'], 'mb' => 0.70, 'md' => 0.10], // Sesak nafas saat istirahat
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G054'], 'mb' => 0.75, 'md' => 0.05], // Badan menjadi kuning
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G055'], 'mb' => 0.70, 'md' => 0.10], // Nyeri ulu hati
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G056'], 'mb' => 0.65, 'md' => 0.10], // Nyeri terus-menerus
            ['penyakit_id' => $p['Limfoma'], 'gejala_id' => $g['G057'], 'mb' => 0.70, 'md' => 0.10], // Nyeri dada saat bernafas

            // =====================================================================
            // HYPERTIROID
            // Gejala: G058-G069
            // =====================================================================
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G058'], 'mb' => 0.70, 'md' => 0.15], // Sesak nafas saat aktivitas ringan
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G059'], 'mb' => 0.75, 'md' => 0.10], // Lemas seluruh badan
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G060'], 'mb' => 0.65, 'md' => 0.15], // Nyeri dada sebelah
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G061'], 'mb' => 0.60, 'md' => 0.20], // Lender berlebihan
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G062'], 'mb' => 0.90, 'md' => 0.05], // Jantung berdebar-debar
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G063'], 'mb' => 0.75, 'md' => 0.10], // Susah tidur
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G064'], 'mb' => 0.80, 'md' => 0.05], // Berat badan menurun
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G065'], 'mb' => 0.60, 'md' => 0.20], // Mual tanpa muntah
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G066'], 'mb' => 0.85, 'md' => 0.05], // Teraba keras di leher
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G067'], 'mb' => 0.85, 'md' => 0.05], // Tampak benjolan di leher depan
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G068'], 'mb' => 0.65, 'md' => 0.20], // Nafsu makan menurun/berubah
            ['penyakit_id' => $p['Hypertiroid'], 'gejala_id' => $g['G069'], 'mb' => 0.70, 'md' => 0.10], // Nyeri pada leher bagian depan
        ];

        foreach ($rules as $rule) {
            $rule['created_at'] = now();
            $rule['updated_at'] = now();
            DB::table('rules')->insert($rule);
        }
    }
}
