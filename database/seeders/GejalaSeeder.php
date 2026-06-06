<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class GejalaSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('gejalas')->truncate();

        DB::table('gejalas')->insert([
            // ===== LIMFADENITIS =====
            ['kode' => 'G001', 'nama' => 'Demam naik turun',                      'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G002', 'nama' => 'Benjolan di leher',                      'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G003', 'nama' => 'Teraba keras pada benjolan',              'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G004', 'nama' => 'Nyeri saat ditekan',                     'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G005', 'nama' => 'Batuk',                                  'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G006', 'nama' => 'Mual',                                   'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G007', 'nama' => 'Muntah',                                 'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G008', 'nama' => 'Benjolan tampak merah',                  'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G009', 'nama' => 'Pusing',                                 'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G010', 'nama' => 'Nyeri menelan',                          'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G011', 'nama' => 'Sesak napas',                            'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G012', 'nama' => 'Badan lemas',                            'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G013', 'nama' => 'Luka bernanah di sekitar benjolan',      'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G014', 'nama' => 'Nafsu makan menurun',                    'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G015', 'nama' => 'Flu / pilek',                            'kategori' => 'Limfadenitis', 'created_at' => now(), 'updated_at' => now()],

            // ===== LIMFADENOPATI =====
            ['kode' => 'G016', 'nama' => 'Mulut tidak bisa dibuka lebar',          'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G017', 'nama' => 'Nyeri pada gigi',                        'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G018', 'nama' => 'Benjolan di leher tidak nyeri',          'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G019', 'nama' => 'Batuk berdahak',                         'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G020', 'nama' => 'Mutah (muntah)',                         'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G021', 'nama' => 'Nyeri perut',                            'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G022', 'nama' => 'Bengkak pada wajah',                     'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G023', 'nama' => 'Sesak napas berulang',                   'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G024', 'nama' => 'Penurunan berat badan',                  'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G025', 'nama' => 'Nafsu makan menurun berkepanjangan',     'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G026', 'nama' => 'Sulit tidur',                            'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G027', 'nama' => 'Menggigil',                              'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G028', 'nama' => 'Kemerahan dan nyeri di area benjolan',   'kategori' => 'Limfadenopati', 'created_at' => now(), 'updated_at' => now()],

            // ===== GONDOK =====
            ['kode' => 'G029', 'nama' => 'Benjolan pada leher terus membesar',     'kategori' => 'Gondok',        'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G030', 'nama' => 'Keringat berlebihan',                    'kategori' => 'Gondok',        'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G031', 'nama' => 'Nyeri saat menelan',                     'kategori' => 'Gondok',        'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G032', 'nama' => 'Muntah tanpa sebab jelas',               'kategori' => 'Gondok',        'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G033', 'nama' => 'Nyeri dada',                             'kategori' => 'Gondok',        'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G034', 'nama' => 'Sesak nafas',                            'kategori' => 'Gondok',        'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G035', 'nama' => 'Gemetar seluruh tubuh',                  'kategori' => 'Gondok',        'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G036', 'nama' => 'Penurunan kesadaran tiba-tiba',          'kategori' => 'Gondok',        'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G037', 'nama' => 'Mual berkepanjangan',                    'kategori' => 'Gondok',        'created_at' => now(), 'updated_at' => now()],

            // ===== TONSILITIS =====
            ['kode' => 'G038', 'nama' => 'Nyeri saat menelan makanan',             'kategori' => 'Tonsilitis',    'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G039', 'nama' => 'Demam berulang',                         'kategori' => 'Tonsilitis',    'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G040', 'nama' => 'Hidung tersumbat',                       'kategori' => 'Tonsilitis',    'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G041', 'nama' => 'Batuk berulang',                         'kategori' => 'Tonsilitis',    'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G042', 'nama' => 'Flu / pilek berulang',                   'kategori' => 'Tonsilitis',    'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G043', 'nama' => 'Muntah saat batuk',                      'kategori' => 'Tonsilitis',    'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G044', 'nama' => 'Nyeri pada leher',                       'kategori' => 'Tonsilitis',    'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G045', 'nama' => 'Nyeri menelan ludah',                    'kategori' => 'Tonsilitis',    'created_at' => now(), 'updated_at' => now()],

            // ===== LIMFOMA =====
            ['kode' => 'G046', 'nama' => 'Lemas / kelelahan ekstrem',              'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G047', 'nama' => 'Muntah tanpa penyebab',                  'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G048', 'nama' => 'Nafsu makan menurun drastis',            'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G049', 'nama' => 'Benjolan pada leher tidak hilang',       'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G050', 'nama' => 'Demam naik turun berkepanjangan',        'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G051', 'nama' => 'Batuk berdahak terus-menerus',           'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G052', 'nama' => 'Flu / pilek yang tak kunjung sembuh',   'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G053', 'nama' => 'Sesak nafas saat beristirahat',          'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G054', 'nama' => 'Badan menjadi kuning',                   'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G055', 'nama' => 'Nyeri ulu hati',                         'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G056', 'nama' => 'Nyeri terus-menerus di tubuh',           'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G057', 'nama' => 'Nyeri dada saat bernafas',               'kategori' => 'Limfoma',       'created_at' => now(), 'updated_at' => now()],

            // ===== HYPERTIROID =====
            ['kode' => 'G058', 'nama' => 'Sesak nafas saat aktivitas ringan',      'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G059', 'nama' => 'Lemas seluruh badan',                    'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G060', 'nama' => 'Nyeri dada sebelah',                     'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G061', 'nama' => 'Lender berlebihan',                      'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G062', 'nama' => 'Jantung berdebar-debar',                 'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G063', 'nama' => 'Susah tidur / insomnia',                 'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G064', 'nama' => 'Berat badan menurun tanpa sebab',        'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G065', 'nama' => 'Mual tanpa muntah',                      'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G066', 'nama' => 'Teraba keras di leher (gondok)',         'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G067', 'nama' => 'Tampak benjolan di leher depan',         'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G068', 'nama' => 'Nafsu makan menurun atau berubah',       'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G069', 'nama' => 'Nyeri pada leher bagian depan',          'kategori' => 'Hypertiroid',   'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
