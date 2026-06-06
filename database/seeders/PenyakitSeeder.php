<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class PenyakitSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('penyakits')->truncate();

        DB::table('penyakits')->insert([
            [
                'nama'       => 'Limfadenitis',
                'deskripsi'  => 'Peradangan pada kelenjar getah bening yang biasanya disebabkan oleh infeksi bakteri atau virus. Kondisi ini menyebabkan pembengkakan dan nyeri pada area leher, ketiak, atau selangkangan, sering disertai demam dan gejala infeksi lainnya.',
                'solusi'     => 'Istirahat yang cukup dan minum air putih yang banyak. Kompres hangat pada area benjolan untuk meredakan nyeri. Jika disebabkan bakteri, dokter akan meresepkan antibiotik. Segera periksakan ke dokter jika benjolan semakin membesar, demam tidak turun setelah 3 hari, atau muncul luka bernanah.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nama'       => 'Limfadenopati',
                'deskripsi'  => 'Pembengkakan kelenjar getah bening akibat berbagai penyebab, termasuk infeksi, reaksi imun, atau kondisi sistemik. Berbeda dengan limfadenitis, limfadenopati tidak selalu disertai peradangan aktif dan benjolan cenderung tidak nyeri saat diraba.',
                'solusi'     => 'Pantau perkembangan benjolan selama 2–3 minggu. Jika benjolan tidak mengecil, semakin keras, atau disertai penurunan berat badan yang tidak disengaja, segera konsultasikan ke dokter untuk pemeriksaan lebih lanjut termasuk tes darah dan USG leher.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nama'       => 'Gondok',
                'deskripsi'  => 'Pembesaran kelenjar tiroid yang terletak di leher bagian depan. Gondok dapat disebabkan oleh kekurangan yodium, gangguan tiroid (hipotiroid atau hipertiroid), nodul tiroid, atau kondisi autoimun seperti penyakit Graves. Benjolan pada leher akan terus membesar jika tidak ditangani.',
                'solusi'     => 'Penuhi kebutuhan yodium harian dengan mengonsumsi garam beryodium dan makanan laut. Pemeriksaan fungsi tiroid (TSH, T3, T4) diperlukan untuk menentukan penyebabnya. Hindari makanan goitrogenik berlebihan seperti kol dan singkong mentah. Segera konsultasikan ke dokter spesialis penyakit dalam atau endokrinologi.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nama'       => 'Tonsilitis',
                'deskripsi'  => 'Peradangan pada amandel (tonsil) yang biasanya disebabkan oleh infeksi virus atau bakteri Streptococcus. Ditandai dengan nyeri tenggorokan yang parah, demam, dan kesulitan menelan. Tonsilitis berulang dapat berkembang menjadi kondisi kronis yang memerlukan tindakan operasi.',
                'solusi'     => 'Istirahat cukup dan konsumsi minuman hangat seperti madu-lemon atau teh jahe untuk meredakan nyeri tenggorokan. Berkumur air garam hangat 2–3 kali sehari. Jika disebabkan bakteri, diperlukan antibiotik dari dokter. Tonsilitis yang sering kambuh (lebih dari 4–5 kali setahun) perlu dikonsultasikan untuk kemungkinan tonsilektomi.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nama'       => 'Limfoma',
                'deskripsi'  => 'Kanker yang menyerang sistem limfatik, termasuk kelenjar getah bening, limpa, dan sumsum tulang. Limfoma terbagi menjadi dua jenis utama: Limfoma Hodgkin dan Non-Hodgkin. Gejalanya meliputi pembengkakan kelenjar tanpa nyeri, demam berulang, keringat malam, lemas ekstrem, dan penurunan berat badan yang tidak disengaja.',
                'solusi'     => 'Segera konsultasikan ke dokter spesialis hematologi-onkologi. Diperlukan serangkaian pemeriksaan meliputi biopsi kelenjar, CT-Scan atau PET-Scan, dan pemeriksaan darah lengkap. Penanganan dini sangat menentukan prognosis. Jangan menunda pemeriksaan jika benjolan terus membesar dan tidak hilang dalam 2–3 minggu.',
                'created_at' => now(), 'updated_at' => now(),
            ],
            [
                'nama'       => 'Hypertiroid',
                'deskripsi'  => 'Kondisi di mana kelenjar tiroid memproduksi hormon tiroid secara berlebihan, sehingga mempercepat metabolisme tubuh. Gejalanya meliputi jantung berdebar, penurunan berat badan meskipun nafsu makan normal, keringat berlebihan, dan pembesaran kelenjar tiroid (gondok) yang dapat teraba keras di leher.',
                'solusi'     => 'Periksakan kadar hormon tiroid (TSH, FT4, FT3) ke dokter. Hindari konsumsi yodium berlebihan. Penanganan dapat berupa obat antitiroid, terapi yodium radioaktif, atau operasi tergantung penyebab dan tingkat keparahannya. Kelola stres dan hindari kafein berlebihan karena dapat memperparah gejala jantung berdebar.',
                'created_at' => now(), 'updated_at' => now(),
            ],
        ]);
    }
}
