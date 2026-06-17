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
            ['kode' => 'G001', 'nama' => 'Benjolan dileher', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G002', 'nama' => 'Muntah', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G003', 'nama' => 'Nyeri menelan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G004', 'nama' => 'Nafsu makan menurun', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G005', 'nama' => 'Sesak nafas', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G006', 'nama' => 'Demam naik turun', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G007', 'nama' => 'Mual', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G008', 'nama' => 'Badan lemas', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G009', 'nama' => 'Flu', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G010', 'nama' => 'Nyeri dada', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G011', 'nama' => 'Teraba keras', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G012', 'nama' => 'Batuk', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G013', 'nama' => 'Batuk berdahak', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G014', 'nama' => 'Penurunan berat badan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G015', 'nama' => 'Sulit tidur', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G016', 'nama' => 'Nyeri pada leher', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G017', 'nama' => 'Nyeri saat ditekan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G018', 'nama' => 'Benjolan tampak merah', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G019', 'nama' => 'Pusing', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G020', 'nama' => 'Luka nanah', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G021', 'nama' => 'Mulut sulit dibuka', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G022', 'nama' => 'Nyeri pada gigi', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G023', 'nama' => 'Menggigil', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G024', 'nama' => 'Benjolan pada leher terus membesar', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G025', 'nama' => 'Keringat berlebihan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G026', 'nama' => 'Gemetar seluruh tubuh', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G027', 'nama' => 'Penurunan kesadaran tiba-tiba', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G028', 'nama' => 'Demam berulang', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G029', 'nama' => 'Hidung tersumbat', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G030', 'nama' => 'Lendir berlebihan', 'created_at' => now(), 'updated_at' => now()],
            ['kode' => 'G031', 'nama' => 'Jantung berdebar-debar', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
